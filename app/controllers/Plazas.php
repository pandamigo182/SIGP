<?php
class Plazas extends Controller {
    public function __construct(){
        $this->plazaModel = $this->model('Plaza');
        $this->userModel = $this->model('User');
    }

    public function index(){
        $plazas = $this->plazaModel->getPlazas();
        $data = ['plazas' => $plazas];
        $this->view('plazas/index', $data);
    }

    // Gestionar plazas propias (Para Empresa)
    public function manage(){
        if($_SESSION['user_role'] != 4){ // 4 = Empresa
            header('location: ' . URLROOT . '/dashboard'); 
            exit;
        }

        $plazas = $this->plazaModel->getPlazasByEmpresa($_SESSION['user_id']);

        $data = [
            'plazas' => $plazas
        ];

        $this->view('plazas/manage', $data);
    }

    // Crear nueva plaza
    public function add(){
        if($_SESSION['user_role'] != 4){
            header('location: ' . URLROOT . '/dashboard'); 
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'titulo' => trim($_POST['titulo']),
                'descripcion' => trim($_POST['descripcion']),
                'requisitos' => trim($_POST['requisitos']),
                'fecha_limite' => trim($_POST['fecha_limite']),
                'empresa_id' => $_SESSION['user_id'],
                'titulo_err' => '',
                'descripcion_err' => '',
                'fecha_err' => ''
            ];

            // Validate
            if(empty($data['titulo'])){ $data['titulo_err'] = 'Por favor ingrese un título'; }
            if(empty($data['descripcion'])){ $data['descripcion_err'] = 'Por favor ingrese una descripción'; }
            if(empty($data['fecha_limite'])){ $data['fecha_err'] = 'Ingrese fecha límite'; }

            if(empty($data['titulo_err']) && empty($data['descripcion_err']) && empty($data['fecha_err'])){
                 if($this->plazaModel->addPlaza($data)){
                     flash('plaza_message', 'Plaza publicada correctamente');
                     redirect('plazas/manage');
                 } else {
                     die('Error al guardar');
                 }
            } else {
                $this->view('plazas/create', $data);
            }

        } else {
            $data = [
                'titulo' => '',
                'descripcion' => '',
                'requisitos' => '',
                'fecha_limite' => '',
                'titulo_err' => '',
                'descripcion_err' => '',
                'fecha_err' => ''
            ];
            $this->view('plazas/create', $data);
        }
    }

    public function edit($id){
        if($_SESSION['user_role'] != 4){
            header('location: ' . URLROOT . '/dashboard');
            exit;
        }

        $plaza = $this->plazaModel->getPlazaById($id);

        if($plaza->empresa_id != $_SESSION['user_id']){
            header('location: ' . URLROOT . '/plazas/manage');
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
             // Sanitize
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'titulo' => trim($_POST['titulo']),
                'descripcion' => trim($_POST['descripcion']),
                'requisitos' => trim($_POST['requisitos']),
                'fecha_limite' => trim($_POST['fecha_limite']),
                'estado' => trim($_POST['estado']),
                'empresa_id' => $_SESSION['user_id'],
                'titulo_err' => '',
                'descripcion_err' => '',
                'fecha_err' => ''
            ];

            if(empty($data['titulo'])){ $data['titulo_err'] = 'Por favor ingrese un título'; }
            if(empty($data['descripcion'])){ $data['descripcion_err'] = 'Por favor ingrese una descripción'; }
            if(empty($data['fecha_limite'])){ $data['fecha_err'] = 'Ingrese fecha límite'; }

             if(empty($data['titulo_err']) && empty($data['descripcion_err']) && empty($data['fecha_err'])){
                 if($this->plazaModel->updatePlaza($data)){
                     flash('plaza_message', 'Plaza actualizada correctamente');
                     redirect('plazas/manage');
                 } else {
                     die('Error al actualizar');
                 }
            } else {
                $this->view('plazas/edit', $data);
            }

        } else {
            $data = [
                'id' => $id,
                'titulo' => $plaza->titulo,
                'descripcion' => $plaza->descripcion,
                'requisitos' => $plaza->requisitos,
                'fecha_limite' => $plaza->fecha_limite,
                'estado' => $plaza->estado,
                'titulo_err' => '',
                'descripcion_err' => '',
                'fecha_err' => ''
            ];

            $this->view('plazas/edit', $data);
        }
    }

    // Ver detalles de una plaza (Publico/Estudiante)
    public function show($id){
        $plaza = $this->plazaModel->getPlazaById($id);
        
        // Verificar si el estudiante ya aplicó
        $yaAplico = false;
        if(isLoggedIn() && $_SESSION['user_role'] == 5){ // Estudiante
             $postulacionModel = $this->model('Postulacion');
             $yaAplico = $postulacionModel->verificarPostulacion($_SESSION['user_id'], $id);
        }

        $data = [
            'plaza' => $plaza,
            'yaAplico' => $yaAplico
        ];

        $this->view('plazas/show', $data);
    }

    // Aplicar a una plaza (Estudiante)
    public function apply($id){
        if(!isLoggedIn() || $_SESSION['user_role'] != 5){
            redirect('auth/login');
        }

        $postulacionModel = $this->model('Postulacion');

        if($postulacionModel->verificarPostulacion($_SESSION['user_id'], $id)){
            // Ya aplicó
            flash('plaza_message', 'Ya te has postulado a esta pasantía', 'alert alert-warning');
            redirect('plazas/show/' . $id);
        }

        $data = [
            'plaza_id' => $id,
            'estudiante_id' => $_SESSION['user_id']
        ];

        if($postulacionModel->agregarPostulacion($data)){
            flash('plaza_message', '¡Te has postulado exitosamente!', 'alert alert-success');
            redirect('plazas/show/' . $id);
        } else {
            die('Error al aplicar');
        }
    }

    // Ver postulantes (Empresa)
    public function applicants($id){
        if($_SESSION['user_role'] != 4){
            redirect('dashboard');
        }

        $plaza = $this->plazaModel->getPlazaById($id);

        // Security check: plaza must belong to logged company
        if($plaza->empresa_id != $_SESSION['user_id']){
            redirect('plazas/manage');
        }

        $postulacionModel = $this->model('Postulacion');
        $candidatos = $postulacionModel->getPostulantesPorPlaza($id);

        $data = [
            'plaza' => $plaza,
            'candidatos' => $candidatos
        ];

        $this->view('plazas/applicants', $data);
    }

    public function accept_applicant($plazaId, $postulacionId){
        $this->update_applicant_status($plazaId, $postulacionId, 'aceptado');
    }

    public function reject_applicant($plazaId, $postulacionId){
        $this->update_applicant_status($plazaId, $postulacionId, 'rechazado');
    }

    private function update_applicant_status($plazaId, $postulacionId, $status){
         if($_SESSION['user_role'] != 4){ redirect('dashboard'); }
         
         // Verify ownership of plaza
         $plaza = $this->plazaModel->getPlazaById($plazaId);
         if($plaza->empresa_id != $_SESSION['user_id']){ redirect('plazas/manage'); }

         $postulacionModel = $this->model('Postulacion');
         if($postulacionModel->actualizarEstado($postulacionId, $status)){
             flash('plaza_message', 'Estado del candidato actualizado');
             redirect('plazas/applicants/' . $plazaId);
         } else {
             die('Error al actualizar');
         }
    }
}

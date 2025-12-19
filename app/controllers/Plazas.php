<?php
class Plazas extends Controller {
    public function __construct(){
        $this->plazaModel = $this->model('Plaza');
        $this->userModel = $this->model('User');
        $this->empresaModel = $this->model('Empresa'); // Cargar modelo Empresa para filtros
        $this->bitacoraModel = $this->model('Bitacora');
    }

    public function index(){
        $filters = [
            'q' => isset($_GET['q']) ? trim($_GET['q']) : '',
            'rubro' => isset($_GET['rubro']) ? trim($_GET['rubro']) : '',
            'departamento_id' => isset($_GET['departamento_id']) ? $_GET['departamento_id'] : '',
            'municipio_id' => isset($_GET['municipio_id']) ? $_GET['municipio_id'] : ''
        ];
        
        // Pagination
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10; // Requested 10 per page
        $offset = ($page - 1) * $limit;

        $plazas = $this->plazaModel->getPlazas($filters, $limit, $offset);
        $totalPlazas = $this->plazaModel->getPlazasCount($filters);
        $totalPages = ceil($totalPlazas / $limit);

        $rubros = $this->empresaModel->getRubros();
        $departamentos = $this->empresaModel->getDepartamentos();

        $data = [
            'title' => 'Pasantías Disponibles',
            'plazas' => $plazas,
            'rubros' => $rubros,
            'departamentos' => $departamentos,
            'pagination' => [
                'current_page' => $page,
                'total_pages' => $totalPages,
                'total_items' => $totalPlazas
            ]
        ];
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
            if(!validateCsrfToken($_POST['csrf_token'])){
                die('Error de seguridad: Token CSRF inválido');
            }
            // Sanitize
            $_POST = filter_input_array(INPUT_POST, [
                 'titulo' => FILTER_UNSAFE_RAW,
                 'descripcion' => FILTER_UNSAFE_RAW,
                 'requisitos' => FILTER_UNSAFE_RAW,
                 'competencias_requeridas' => FILTER_UNSAFE_RAW,
                 'modalidad' => FILTER_UNSAFE_RAW,
                 'cantidad_vacantes' => FILTER_SANITIZE_NUMBER_INT,
                 'fecha_limite' => FILTER_UNSAFE_RAW
            ]);

            $data = [
                'titulo' => sanitizeString($_POST['titulo']),
                'descripcion' => sanitizeString($_POST['descripcion']),
                'requisitos' => sanitizeString($_POST['requisitos']),
                'competencias_requeridas' => sanitizeString($_POST['competencias_requeridas']),
                'modalidad' => trim($_POST['modalidad']),
                'cantidad_vacantes' => trim($_POST['cantidad_vacantes']),
                'fecha_limite' => trim($_POST['fecha_limite']),
                'duracion' => trim($_POST['duracion']),
                'empresa_id' => $_SESSION['user_id'],
                'titulo_err' => '',
                'descripcion_err' => '',
                'competencias_err' => '',
                'vacantes_err' => '',
                'fecha_err' => '',
                'duracion_err' => ''
            ];

            // Validate
            if(empty($data['titulo'])){ $data['titulo_err'] = 'Por favor ingrese un título'; }
            if(empty($data['descripcion'])){ $data['descripcion_err'] = 'Por favor ingrese una descripción'; }
            if(empty($data['fecha_limite'])){ $data['fecha_err'] = 'Ingrese fecha límite'; }
            if(empty($data['duracion'])){ $data['duracion_err'] = 'Ingrese la duración'; }

            if(empty($data['titulo_err']) && empty($data['descripcion_err']) && empty($data['fecha_err']) && empty($data['duracion_err'])){
                 if($this->plazaModel->addPlaza($data)){
                     // Registro de Creación
                     $this->bitacoraModel->log($_SESSION['user_id'], 'CREATE_PLAZA', 'Publicó plaza: ' . $data['titulo']);

                     flash('plaza_message', 'Plaza publicada correctamente');
                     redirect('plazas/manage');
                 } else {
                     die('Error al guardar');
                 }
            } else {
                $this->view('plazas/create', $data);
            }

        } else {
            // Inicializar datos con valores por defecto
            $data = [
                'titulo' => '',
                'descripcion' => '',
                'requisitos' => '',
                'competencias_requeridas' => '',
                'modalidad' => 'Presencial', // Valor predeterminado
                'cantidad_vacantes' => 1,
                'fecha_limite' => '',
                'duracion' => '6 meses',
                // Variables para mensajes de error
                'titulo_err' => '',
                'descripcion_err' => '',
                'competencias_err' => '',
                'vacantes_err' => '',
                'fecha_err' => '',
                'duracion_err' => ''
            ];
            // Cargar la vista de creación con los datos vacíos
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
             if(!validateCsrfToken($_POST['csrf_token'])){
                die('Error de seguridad: Token CSRF inválido');
            }
             // Sanitize
            $_POST = filter_input_array(INPUT_POST, [
                 'titulo' => FILTER_UNSAFE_RAW,
                 'descripcion' => FILTER_UNSAFE_RAW,
                 'requisitos' => FILTER_UNSAFE_RAW,
                 'competencias_requeridas' => FILTER_UNSAFE_RAW,
                 'modalidad' => FILTER_UNSAFE_RAW,
                 'cantidad_vacantes' => FILTER_SANITIZE_NUMBER_INT,
                 'fecha_limite' => FILTER_UNSAFE_RAW,
                 'estado' => FILTER_UNSAFE_RAW
            ]);

            $data = [
                'id' => $id,
                'titulo' => sanitizeString($_POST['titulo']),
                'descripcion' => sanitizeString($_POST['descripcion']),
                'requisitos' => sanitizeString($_POST['requisitos']),
                'competencias_requeridas' => sanitizeString($_POST['competencias_requeridas']),
                'modalidad' => trim($_POST['modalidad']),
                'cantidad_vacantes' => trim($_POST['cantidad_vacantes']),
                'fecha_limite' => trim($_POST['fecha_limite']),
                'duracion' => trim($_POST['duracion']),
                'estado' => trim($_POST['estado']),
                'empresa_id' => $_SESSION['user_id'],
                'titulo_err' => '',
                'descripcion_err' => '',
                'competencias_err' => '',
                'vacantes_err' => '',
                'fecha_err' => '',
                'duracion_err' => ''
            ];

            if(empty($data['titulo'])){ $data['titulo_err'] = 'Por favor ingrese un título'; }
            if(empty($data['descripcion'])){ $data['descripcion_err'] = 'Por favor ingrese una descripción'; }
            if(empty($data['fecha_limite'])){ $data['fecha_err'] = 'Ingrese fecha límite'; }
            if(empty($data['duracion'])){ $data['duracion_err'] = 'Ingrese la duración'; }

             if(empty($data['titulo_err']) && empty($data['descripcion_err']) && empty($data['fecha_err']) && empty($data['duracion_err'])){
                 if($this->plazaModel->updatePlaza($data)){
                      // Registro de Actualización
                     $this->bitacoraModel->log($_SESSION['user_id'], 'UPDATE_PLAZA', 'Actualizó plaza: ' . $data['titulo'] . ' (ID: ' . $id . ')');

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
                'competencias_requeridas' => $plaza->competencias_requeridas,
                'modalidad' => $plaza->modalidad,
                'cantidad_vacantes' => $plaza->cantidad_vacantes,
                'fecha_limite' => $plaza->fecha_limite,
                'duracion' => $plaza->duracion ?? '6 meses',
                'estado' => $plaza->estado,
                'titulo_err' => '',
                'descripcion_err' => '',
                'fecha_err' => '',
                'duracion_err' => ''
            ];

            $this->view('plazas/edit', $data);
        }
    }

    // Ver detalles de una plaza (Publico/Estudiante)
    public function show($id){
        $plaza = $this->plazaModel->getPlazaById($id);
        
        if(!$plaza){
            redirect('pages/notFound');
        }

        // Verificar si el estudiante ya aplicó o lo tiene en favoritos
        $yaAplico = false;
        $esFavorito = false;
        
        if(isLoggedIn() && $_SESSION['user_role'] == 5){ // Estudiante
             $postulacionModel = $this->model('Postulacion');
             // Verificación rápida usando nuevos métodos si están disponibles o implementar lógica
             // Por ahora asumir lógica extendida del modelo Plaza si está disponible, o SQL directo si es rápido
             $yaAplico = $this->plazaModel->checkApplied($_SESSION['user_id'], $id);
             $esFavorito = $this->plazaModel->checkFavorite($_SESSION['user_id'], $id);
        }

        // Similares (mismo rubro)
        $similares = $this->plazaModel->getSimilarPlazas($id, $plaza->rubro ?? 'Tecnología'); // Rubro por defecto

        $data = [
            'plaza' => $plaza,
            'yaAplico' => $yaAplico,
            'esFavorito' => $esFavorito,
            'similares' => $similares
        ];

        $this->view('plazas/show', $data);
    }

    public function toggle_favorite($id){
        if(!isLoggedIn() || $_SESSION['user_role'] != 5){
             echo json_encode(['status' => 'error', 'message' => 'No autorizado']);
             return;
        }
        
        if($this->plazaModel->toggleFavorite($_SESSION['user_id'], $id)){
             $esFavorito = $this->plazaModel->checkFavorite($_SESSION['user_id'], $id);
             echo json_encode(['status' => 'success', 'favorito' => $esFavorito]);
        } else {
             echo json_encode(['status' => 'error']);
        }
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

    // Ver postulantes (Empresa/Admin)
    public function applicants($id){
        // Permitir Empresa (4) y Admin (1)
        if($_SESSION['user_role'] != 4 && $_SESSION['user_role'] != 1){
            redirect('dashboard');
        }

        $plaza = $this->plazaModel->getPlazaById($id);
        
        if(!$plaza){ redirect('plazas/manage'); }

        // Verificación de seguridad: la plaza debe pertenecer a la empresa conectada (omitir para Admin)
        if($_SESSION['user_role'] == 4 && $plaza->empresa_id != $_SESSION['user_id']){
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
         if($_SESSION['user_role'] != 4 && $_SESSION['user_role'] != 1){ redirect('dashboard'); }
         
         // Verificar propiedad de la plaza (omitir para Admin)
         $plaza = $this->plazaModel->getPlazaById($plazaId);
         if($_SESSION['user_role'] == 4 && $plaza->empresa_id != $_SESSION['user_id']){ redirect('plazas/manage'); }

         $postulacionModel = $this->model('Postulacion');
         if($postulacionModel->actualizarEstado($postulacionId, $status)){
             // Registro de Cambio de Estado
             $this->bitacoraModel->log($_SESSION['user_id'], 'UPDATE_APPLICANT', 'Usuario ' . $_SESSION['user_id'] . ' cambió estado de postulación ' . $postulacionId . ' a: ' . $status);

             // SI ES ACEPTADO -> CREAR PASANTIA
             if($status == 'aceptada' || $status == 'aceptado'){ 
                 $postulacion = $postulacionModel->getPostulacionById($postulacionId);
                 
                 if($postulacion){
                     $pasantiaModel = $this->model('Pasantia');
                     $userModel = $this->model('User');
                     $userInfo = $userModel->getUserById($_SESSION['user_id']);

                     $dataPasantia = [
                         'estudiante_id' => $postulacion->estudiante_id,
                         'empresa_id' => $userInfo->empresa_id,
                         'tutor_id' => null, // Coordinador asignará
                         'institucion_id' => 1,
                         'proyecto_asociado' => 'Pasantía - ' . $plaza->titulo,
                         'fecha_inicio' => date('Y-m-d'),
                         'fecha_fin' => date('Y-m-d', strtotime('+6 months')),
                         'estado' => 'activa'
                     ];
                     $pasantiaModel->addPasantia($dataPasantia);
                 }
             }

             flash('plaza_message', 'Estado del candidato actualizado');
             redirect('plazas/applicants/' . $plazaId);
         } else {
             die('Error al actualizar');
         }
    }
}

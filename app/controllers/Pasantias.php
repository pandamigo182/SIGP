<?php
class Pasantias extends Controller {
    public function __construct(){
        if(!isLoggedIn()){
            redirect('auth/login');
        }
        $this->pasantiaModel = $this->model('Pasantia');
        $this->userModel = $this->model('User');
        $this->empresaModel = $this->model('Empresa');
        $this->institucionModel = $this->model('Institucion');
        $this->notificationModel = $this->model('Notification');
    }

    public function index(){
        $pasantias = $this->pasantiaModel->getPasantias();
        $data = [
            'pasantias' => $pasantias
        ];
        $this->view('admin/pasantias/index', $data);
    }

    public function add(){
        // Fetch dropdown data
        // Students (Role 5)
        $students = $this->userModel->getUsers(); 
        $students = array_filter($students, function($u){ return $u->role_id == 5; });
        
        // Companies
        $empresas = $this->empresaModel->getEmpresas();

        // Tutors (Role 3) - Pending Filter by Company?
        $tutors = $this->userModel->getUsers();
        $tutors = array_filter($tutors, function($u){ return $u->role_id == 3; });

        // Institutions
        $instituciones = $this->institucionModel->getInstituciones();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'estudiante_id' => trim($_POST['estudiante_id']),
                'empresa_id' => trim($_POST['empresa_id']),
                'tutor_id' => trim($_POST['tutor_id']),
                'institucion_id' => trim($_POST['institucion_id']),
                'proyecto_asociado' => trim($_POST['proyecto']),
                'fecha_inicio' => trim($_POST['fecha_inicio']),
                'fecha_fin' => trim($_POST['fecha_fin']),
                'estado' => 'Activa'
            ];

            if($this->pasantiaModel->addPasantia($data)){
                // Notify Student
                $this->notificationModel->addNotification($data['estudiante_id'], 'Se te ha asignado una nueva pasantía: ' . $data['proyecto_asociado'], 'success');
                
                flash('admin_message', 'Pasantía registrada exitosamente');
                redirect('pasantias/index');
            } else {
                die('Error al registrar');
            }
        } else {
             $data = [
                'students' => $students,
                'empresas' => $empresas,
                'tutors' => $tutors,
                'instituciones' => $instituciones
            ];
            $this->view('admin/pasantias/add', $data);
        }
    }
}

<?php
class Coordinador extends Controller {
    public function __construct(){
        if(!isLoggedIn() || $_SESSION['user_role'] != 2){ // 2 = Coordinador
            redirect('dashboard');
        }
        $this->pasantiaModel = $this->model('Pasantia');
        $this->userModel = $this->model('User');
        $this->bitacoraModel = $this->model('Bitacora');
    }

    public function index(){
        $this->assign();
    }

    // Listar pasantías aceptadas para asignar tutor
    public function assign(){
        $pasantias = $this->pasantiaModel->getPasantiasPorEstado('activa'); // Pasantías aceptadas/activas
        
        // Obtener lista de tutores
        $tutores = $this->userModel->getUsersByRole(3); // 3 = Tutor

        $data = [
            'pasantias' => $pasantias,
            'tutores' => $tutores
        ];

        $this->view('coordinador/assign', $data);
    }

    // Procesar asignación
    public function procesar_asignacion(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $pasantia_id = filter_input(INPUT_POST, 'pasantia_id', FILTER_SANITIZE_NUMBER_INT);
            $tutor_id = filter_input(INPUT_POST, 'tutor_id', FILTER_SANITIZE_NUMBER_INT);

            if($this->pasantiaModel->asignarTutor($pasantia_id, $tutor_id)){
                // Audit
                $this->bitacoraModel->log($_SESSION['user_id'], 'ASSIGN_TUTOR', "Asignó tutor (ID: $tutor_id) a pasantía (ID: $pasantia_id)");
                
                flash('coordinador_message', 'Tutor asignado correctamente');
            } else {
                flash('coordinador_message', 'Error al asignar tutor', 'alert alert-danger');
            }
            redirect('coordinador/assign');
        }
    }
}

<?php
class Postulaciones extends Controller {
    public function __construct(){
        if(!isLoggedIn()){
            redirect('auth/login');
        }
        $this->postulacionModel = $this->model('Postulacion');
        $this->plazaModel = $this->model('Plaza');
    }

    // Listar mis postulaciones
    public function index(){
        // Validar rol Estudiante
        if($_SESSION['user_role'] != 5){
            redirect('dashboard');
        }

        $postulaciones = $this->postulacionModel->getPostulacionesPorEstudiante($_SESSION['user_id']);

        $data = [
            'postulaciones' => $postulaciones
        ];

        $this->view('postulaciones/index', $data);
    }
}

<?php
class Tutor extends Controller {
    public function __construct(){
        if(!isLoggedIn() || $_SESSION['user_role'] != 3){ // 3 = Tutor
            redirect('auth/login');
        }
        $this->pasantiaModel = $this->model('Pasantia');
        $this->reporteModel = $this->model('Reporte');
        $this->bitacoraModel = $this->model('Bitacora');
    }

    public function index(){
        $pasantias = $this->pasantiaModel->getPasantiasByTutor($_SESSION['user_id']);
        
        $data = [
            'pasantias' => $pasantias
        ];

        $this->view('tutor/index', $data);
    }

    public function view_reports($pasantia_id){
        // Verify assignment
        $pasantia = $this->pasantiaModel->getPasantiaById($pasantia_id);
        if($pasantia->tutor_id != $_SESSION['user_id']){
            redirect('tutor/index');
        }

        $reportes = $this->reporteModel->getReportesPorPasantia($pasantia_id);

        $data = [
            'pasantia' => $pasantia,
            'reportes' => $reportes
        ];

        $this->view('tutor/reports', $data);
    }

    public function save_feedback(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $reporte_id = filter_input(INPUT_POST, 'reporte_id', FILTER_SANITIZE_NUMBER_INT);
            $pasantia_id = filter_input(INPUT_POST, 'pasantia_id', FILTER_SANITIZE_NUMBER_INT);
            $feedback = trim($_POST['retroalimentacion']);

            // Verify Ownership via Pasantia (Optional but strict)
            // ...

            if($this->reporteModel->updateRetroalimentacion($reporte_id, $feedback)){
                 $this->bitacoraModel->log($_SESSION['user_id'], 'REVIEW_REPORT', "Revisó reporte $reporte_id");
                 flash('tutor_message', 'Retroalimentación guardada.');
            } else {
                 flash('tutor_message', 'Error al guardar.', 'alert alert-danger');
            }
            redirect('tutor/view_reports/' . $pasantia_id);
        }
    }
}

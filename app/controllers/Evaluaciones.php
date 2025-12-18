<?php
class Evaluaciones extends Controller {
    public function __construct(){
        if(!isLoggedIn()){
            redirect('auth/login');
        }
        $this->evaluacionModel = $this->model('Evaluacion');
        $this->pasantiaModel = $this->model('Pasantia');
        $this->bitacoraModel = $this->model('Bitacora');
    }

    // Formulario de Evaluación (Empresa)
    public function evaluar($pasantia_id){
        if($_SESSION['user_role'] != 4){ // 4 = Empresa
            redirect('dashboard');
        }

        $pasantia = $this->pasantiaModel->getPasantiaById($pasantia_id);
        
        // Security check
        if($pasantia->empresa_id != $_SESSION['user_id']){
            redirect('dashboard');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $calificacion = (floatval($_POST['responsabilidad']) + floatval($_POST['conocimientos']) + floatval($_POST['trabajo_equipo'])) / 3;

            $data = [
                'empresa_id' => $_SESSION['user_id'],
                'estudiante_id' => $pasantia->estudiante_id,
                'pasantia_id' => $pasantia_id,
                'calificacion_general' => round($calificacion, 2),
                'responsabilidad' => trim($_POST['responsabilidad']),
                'conocimientos' => trim($_POST['conocimientos']),
                'trabajo_equipo' => trim($_POST['trabajo_equipo']),
                'comentarios' => trim($_POST['comentarios'])
            ];

            if($this->evaluacionModel->addEvaluacion($data)){
                // Update Pasantia Status to Finalizada
                $this->pasantiaModel->actualizarEstado($pasantia_id, 'finalizada');
                
                // Log
                $this->bitacoraModel->log($_SESSION['user_id'], 'EVALUATE_INTERN', "Evaluó pasantía $pasantia_id. Nota: " . $data['calificacion_general']);

                flash('plaza_message', 'Evaluación registrada correctamente. Pasantía finalizada.');
                redirect('plazas/manage'); // Or dashboard
            } else {
                die('Error al guardar evaluación');
            }

        } else {
            $data = [
                'pasantia' => $pasantia
            ];
            $this->view('evaluaciones/create', $data);
        }
    }
}

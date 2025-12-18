<?php
class Reportes extends Controller {
    public function __construct(){
        if(!isLoggedIn()){
            redirect('auth/login');
        }
        $this->reporteModel = $this->model('Reporte');
        $this->pasantiaModel = $this->model('Pasantia');
        $this->bitacoraModel = $this->model('Bitacora');
    }

    public function index(){
        // Access for Admin
        if($_SESSION['user_role'] == 1){ 
            $reportes = $this->reporteModel->getAllReportes();
            $data = ['reportes' => $reportes];
            $this->view('reportes/admin_index', $data);
            return;
        }

        if($_SESSION['user_role'] != 5){ // Estudiante
            redirect('dashboard');
        }

        // Obtener pasantia activa del estudiante
        // TODO: Implement getActivePasantiaByStudent in Pasantia Model
        // For now, assume logic or create method
        $pasantia = $this->pasantiaModel->getPasantiaActivaPorusuario($_SESSION['user_id']);
        
        if(!$pasantia){
            // No tiene pasantia activa
            $data = ['error' => 'No tienes una pasantía activa.'];
            $this->view('reportes/error', $data);
            return;
        }

        $reportes = $this->reporteModel->getReportesPorPasantia($pasantia->id);

        $data = [
            'pasantia' => $pasantia,
            'reportes' => $reportes
        ];

        $this->view('reportes/index', $data);
    }

    public function create($pasantia_id = null){
        if($_SESSION['user_role'] != 5){ redirect('dashboard'); }
        
        // Auto resolve active internship if not provided
        if(!$pasantia_id){
             $pasantia = $this->pasantiaModel->getPasantiaActivaPorusuario($_SESSION['user_id']);
             if($pasantia) $pasantia_id = $pasantia->id;
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            // Handle File Upload
            $archivo = '';
            if(isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK){
                 $uploadDir = 'uploads/reportes/';
                 if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
                 
                 $filename = uniqid() . '_' . basename($_FILES['archivo']['name']);
                 // Validate ext (pdf, docx)
                 $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                 if(in_array($ext, ['pdf', 'doc', 'docx'])){
                     if(move_uploaded_file($_FILES['archivo']['tmp_name'], $uploadDir . $filename)){
                         $archivo = $uploadDir . $filename;
                     }
                 }
            }

            // Fetch Pasantia info to get tutor_id
            $pasantiaInfo = $this->pasantiaModel->getPasantiaById($pasantia_id);

            $data = [
                'pasantia_id' => $pasantia_id,
                'estudiante_id' => $_SESSION['user_id'],
                'tutor_id' => $pasantiaInfo->tutor_id,
                'titulo' => trim($_POST['titulo']),
                'contenido' => trim($_POST['contenido']),
                'semana' => trim($_POST['semana']),
                'archivo' => $archivo
            ];

            if($this->reporteModel->addReporte($data)){
                $this->bitacoraModel->log($_SESSION['user_id'], 'SUBMIT_REPORT', "Envió reporte semana: " . $data['semana']);
                flash('reporte_message', 'Reporte enviado correctamente');
                redirect('reportes/index');
            } else {
                die('Error al guardar reporte');
            }

        } else {
            $data = [
                'pasantia_id' => $pasantia_id
            ];
            $this->view('reportes/create', $data);
        }
    }
}

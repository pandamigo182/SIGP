<?php
require_once APPROOT . '/lib/fpdf.php';

class Certificados extends Controller {
    public function __construct(){
        $this->pasantiaModel = $this->model('Pasantia');
        $this->userModel = $this->model('User');
        $this->certificadoModel = $this->model('Certificado'); // Logic for templates
    }

    // Admin: List Templates
    public function index(){
        if($_SESSION['user_role'] != 1 && $_SESSION['user_role'] != 2){ redirect('dashboard'); }
        
        $templates = $this->certificadoModel->getTemplates();
        $data = [
            'templates' => $templates
        ];
        $this->view('admin/certificados/index', $data);
    }

    // Admin: Upload Template
    public function upload(){
        if($_SESSION['user_role'] != 1 && $_SESSION['user_role'] != 2){ redirect('dashboard'); }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(!validateCsrfToken($_POST['csrf_token'])){
                 die('Error de seguridad: Token CSRF inválido');
            }
            $data = [
                'nombre' => trim($_POST['nombre']),
                'monitor_err' => ''
            ];

            // Handle File Upload
            if(!empty($_FILES['plantilla']['name'])){
                $target_dir = APPROOT . '/../public/img/certificados/';
                if(!is_dir($target_dir)){ mkdir($target_dir, 0777, true); }
                
                $file_ext = strtolower(pathinfo($_FILES['plantilla']['name'], PATHINFO_EXTENSION));
                $filename = uniqid('cert_bg_') . '.' . $file_ext;
                $target_file = $target_dir . $filename;

                if($file_ext != 'jpg' && $file_ext != 'png' && $file_ext != 'jpeg'){
                    flash('cert_message', 'Solo se permiten archivos JPG o PNG', 'alert alert-danger');
                    redirect('certificados/index');
                }

                if(move_uploaded_file($_FILES['plantilla']['tmp_name'], $target_file)){
                    if($this->certificadoModel->addTemplate($data['nombre'], $filename)){
                        flash('cert_message', 'Plantilla subida correctamente');
                        redirect('certificados/index');
                    }
                } else {
                    die('Error al subir archivo');
                }
            } else {
                flash('cert_message', 'Seleccione un archivo', 'alert alert-danger');
                redirect('certificados/index');
            }
        }
    }

    // Generate PDF
    public function generate($pasantiaId){
        if(!isLoggedIn()){ redirect('auth/login'); }

        $pasantia = $this->pasantiaModel->getPasantiaById($pasantiaId);
        
        // Security: Only Student, Company, or Admin can see
        if($_SESSION['user_id'] != $pasantia->estudiante_id && 
           $_SESSION['user_id'] != $pasantia->empresa_id && 
           $_SESSION['user_role'] != 1){
            redirect('dashboard');
        }

        if($pasantia->estado != 'finalizada'){
            die('La pasantía no está finalizada.');
        }

        // Student Check: Feedback Required
        if($_SESSION['user_role'] == 5){
             if(!$this->pasantiaModel->checkFeedbackEstudiante($pasantiaId)){
                 flash('feedback_message', 'Debes completar el feedback a la empresa para descargar tu constancia.');
                 redirect('pasantias/feedback/' . $pasantiaId);
             }
        }

        // Get Active Template (or default)
        $template = $this->certificadoModel->getActiveTemplate();
        $bgPath = APPROOT . '/../public/img/certificados/' . $template->archivo_fondo;

        // FPDF Generation
        $pdf = new FPDF('L', 'mm', 'A4'); // Landscape
        $pdf->AddPage();
        
        // Background
        if(file_exists($bgPath)){
            $pdf->Image($bgPath, 0, 0, 297, 210);
        }

        // Text Configuration (Adjust coordinates based on your template design)
        // Title
        $pdf->SetFont('Arial', 'B', 30);
        $pdf->SetTextColor(0, 51, 102);
        // $pdf->SetXY(0, 80);
        // $pdf->Cell(297, 10, utf8_decode('CERTIFICADO DE FINALIZACIÓN'), 0, 1, 'C');

        // Student Name
        $pdf->SetFont('Arial', 'B', 24);
        $pdf->SetXY(0, 95);
        $pdf->Cell(297, 10, utf8_decode($pasantia->nombre_estudiante), 0, 1, 'C');

        // Body Text
        $pdf->SetFont('Arial', '', 14);
        $pdf->SetXY(40, 115);
        $texto = "Por haber completado satisfactoriamente su pasantía profesional en la empresa " . $pasantia->nombre_empresa . 
                 ", participando en el proyecto " . $pasantia->proyecto_asociado . ".";
        $pdf->MultiCell(217, 8, utf8_decode($texto), 0, 'C');

        // Dates
        $pdf->SetXY(0, 145);
        $pdf->SetFont('Arial', 'I', 12);
        $fecha = "Dado el " . date('d') . " de " . date('M') . " del " . date('Y');
        $pdf->Cell(297, 10, utf8_decode($fecha), 0, 1, 'C');

        $pdf->Output('I', 'Certificado_' . $pasantia->nombre_estudiante . '.pdf');
    }
}

<?php
class Reportes extends Controller {
    public function __construct(){
        if(!isLoggedIn()){
            redirect('auth/login');
        }
        $this->reporteModel = $this->model('Reporte');
    }

    // Listar reportes (Estudiante)
    public function index(){
        if($_SESSION['user_role'] == 5){ // Estudiante
            $reportes = $this->reporteModel->getReportesByStudent($_SESSION['user_id']);
            $data = ['reportes' => $reportes];
            $this->view('reportes/index', $data);
        } elseif($_SESSION['user_role'] == 3) { // Tutor
             // Para simplificar, el tutor ve TODOS los reportes por ahora
             // Idealmente filtraría por estudiantes asignados
             $reportes = $this->reporteModel->getAllReportes();
             $data = ['reportes' => $reportes];
             $this->view('tutor/reportes_list', $data);
        } else {
            redirect('dashboard');
        }
    }

    // Crear reporte (Estudiante)
    public function create(){
        if($_SESSION['user_role'] != 5){
            redirect('dashboard');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'estudiante_id' => $_SESSION['user_id'],
                'titulo' => trim($_POST['titulo']),
                'descripcion' => trim($_POST['descripcion']),
                'horas' => trim($_POST['horas']),
                'archivo' => '',
                'titulo_err' => '',
                'descripcion_err' => '',
                'horas_err' => ''
            ];

            // Handle File Upload
            if(!empty($_FILES['archivo']['name'])){
                $uploadDir = dirname(APPROOT) . '/public/uploads/reportes/';
                
                // Create dir if not exists
                if(!is_dir($uploadDir)){
                    mkdir($uploadDir, 0755, true);
                }

                $fileName = time() . '_' . basename($_FILES['archivo']['name']);
                $targetPath = $uploadDir . $fileName;

                // Validate file type (basic)
                $fileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
                $allowed = ['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx'];

                if(in_array($fileType, $allowed)){
                    if(move_uploaded_file($_FILES['archivo']['tmp_name'], $targetPath)){
                        $data['archivo'] = $fileName;
                    } else {
                        // Error submitting file, but we'll continue with empty file for now or handle error
                        // flash('reporte_message', 'Error al subir archivo', 'alert alert-danger');
                    }
                } else {
                     // Invalid file type
                     // We could set an error here
                }
            }

            if(empty($data['titulo'])){ $data['titulo_err'] = 'Ingrese el título'; }
            if(empty($data['descripcion'])){ $data['descripcion_err'] = 'Ingrese detalle'; }
            if(empty($data['horas'])){ $data['horas_err'] = 'Ingrese horas'; }

            if(empty($data['titulo_err']) && empty($data['descripcion_err']) && empty($data['horas_err'])){
                if($this->reporteModel->addReporte($data)){
                    flash('reporte_message', 'Reporte enviado correctamente');
                    redirect('reportes/index');
                } else {
                    die('Error al guardar');
                }
            } else {
                $this->view('reportes/create', $data);
            }

        } else {
            $data = [
                'titulo' => '',
                'descripcion' => '',
                'horas' => '',
                'titulo_err' => '',
                'descripcion_err' => '',
                'horas_err' => ''
            ];
            $this->view('reportes/create', $data);
        }
    }

    public function show($id){
        $reporte = $this->reporteModel->getReporteById($id);

        if($_SESSION['user_role'] == 5 && $reporte->estudiante_id != $_SESSION['user_id']){
            redirect('reportes/index');
        }

        if($_SESSION['user_role'] != 5 && $_SESSION['user_role'] != 3 && $_SESSION['user_role'] != 2){ 
            // Allow Student (owner), Tutor, Coordinator
             redirect('dashboard');
        }

        $userModel = $this->model('User');
        $estudiante = $userModel->getUserById($reporte->estudiante_id);

        $data = [
            'reporte' => $reporte,
            'estudiante' => $estudiante
        ];

        $this->view('reportes/show', $data);
    }
}

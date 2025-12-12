<?php
class Dashboard extends Controller {
    public function __construct(){
        // Restringir acceso solo a usuarios logueados
        if(!isLoggedIn()){
            header('location: ' . URLROOT . '/auth/login');
            exit;
        }
    }

    public function index(){
        $roleId = $_SESSION['user_role'];
        
        $data = [
            'title' => 'Dashboard',
            'role_name' => $this->getRoleName($roleId)
        ];

        // Cargar vista según el rol
        // 1: Admin, 2: Coordinator, 3: Tutor, 4: Company, 5: Student
        
        switch($roleId){
            case 1:
                $this->view('admin/dashboard', $data);
                break;
            case 2:
                // Coordinator Logic
                $institucionId = isset($_SESSION['user_institucion']) ? $_SESSION['user_institucion'] : null;
                
                // Models
                $studentModel = $this->model('Student');

                // Get students from this institution
                if($institucionId){
                    $data['myStudents'] = $studentModel->getStudentsByInstitucion($institucionId);
                } else {
                    $data['myStudents'] = [];
                }
                
                $data['institucion_id'] = $institucionId;
                $this->view('coordinator/dashboard', $data);
                break;
            case 3:
                $this->view('tutor/dashboard', $data);
                break;
            case 4:
                $this->view('company/dashboard', $data);
                break;
            case 5:
                $postulacionModel = $this->model('Postulacion');
                $data['postulaciones'] = $postulacionModel->getPostulacionesByEstudiante($_SESSION['user_id']);
                $this->view('student/dashboard', $data);
                break;
            default:
                $this->view('dashboard/index', $data);
                break;
        }
    }

    private function getRoleName($id){
        switch($id){
            case 1: return 'Administrador';
            case 2: return 'Coordinador';
            case 3: return 'Tutor Académico';
            case 4: return 'Empresa';
            case 5: return 'Estudiante';
            default: return 'Usuario';
        }
    }
}

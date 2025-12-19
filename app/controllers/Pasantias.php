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
        // Verify Admin Role
        if($_SESSION['user_role'] != 1 && $_SESSION['user_role'] != 2){ 
             redirect('dashboard');
        }

        $pasantias = $this->pasantiaModel->getPasantias();
        $data = [
            'pasantias' => $pasantias
        ];
        $this->view('admin/pasantias/index', $data);
    }
    
    // Student: Feedback Form
    public function feedback($id){
        if(!isLoggedIn()){ redirect('auth/login'); }
        // Access Check
        $pasantia = $this->pasantiaModel->getPasantiaById($id);
        if($pasantia->estudiante_id != $_SESSION['user_id']){
            redirect('dashboard');
        }
        
        // If already submitted, redirect to download?
        if($this->pasantiaModel->checkFeedbackEstudiante($id)){
             flash('pasantia_message', 'Ya has enviado tu feedback. Puedes descargar tu certificado.');
             // Where to redirect? Maybe dashboard.
             redirect('student/index');
        }
        
        $data = [
            'pasantia' => $pasantia,
            'id' => $id
        ];
        
        $this->view('pasantias/feedback', $data);
    }
    
    public function store_feedback($id){
        if($_SERVER['REQUEST_METHOD'] != 'POST'){ redirect('student/index'); }

        if(!validateCsrfToken($_POST['csrf_token'] ?? '')){
             flash('pasantia_message', 'Error de seguridad: Token CSRF inválido', 'alert alert-danger');
             redirect('student/index'); // Redirect seguro
             return;
        }
        
        $data = [
            'pasantia_id' => $id,
            'estudiante_id' => $_SESSION['user_id'],
            'empresa_id' => trim($_POST['empresa_id'] ?? ''), 
            'rating' => trim($_POST['rating'] ?? ''),
            'comentarios' => sanitizeString($_POST['comentarios'] ?? ''),
            'satisfaccion' => trim($_POST['satisfaccion'] ?? ''), // Si existe en form
            'recomienda' => trim($_POST['recomienda'] ?? ''),   // Si existe en form
            'rating_err' => ''
        ];
        
        if(empty($data['rating'])){ $data['rating_err'] = 'Por favor califica a la empresa'; }
        
        if(empty($data['rating_err'])){
            if($this->pasantiaModel->addEvaluacionEstudiante($data)){
                flash('student_message', 'Gracias por tu feedback. Ahora puedes descargar tu certificado.', 'alert alert-success');
                redirect('student/index');
            } else {
                die('Error al guardar feedback');
            }
        } else {
             $pasantia = $this->pasantiaModel->getPasantiaById($id);
             $data['pasantia'] = $pasantia;
             $data['id'] = $id;
             $this->view('pasantias/feedback', $data);
        }
    }

    // Company: Manage Internships
    public function company_index(){
        if($_SESSION['user_role'] != 4){ redirect('dashboard'); }
        
        $userId = $_SESSION['user_id'];
        // Get Company ID from User ID (assuming 1-to-1 or stored in session, checking Plaza logic it used user_id as company_id directly or via table)
        // Plaza logic: $plaza->empresa_id = $_SESSION['user_id'] (User ID IS Company ID in this system architecture?)
        // Let's verify: In Plazas.php: $plazas = $this->plazaModel->getPlazasByEmpresa($_SESSION['user_id']);
        // So yes, User ID is treated as the link.
        
        // We need a method in Pasantia Model: getPasantiasByEmpresa($empresaId)
        // Currently we only have getPasantiasByTutor. I'll add getPasantiasByEmpresa to Model first.
        $pasantias = $this->pasantiaModel->getPasantiasByEmpresa($userId);
        
        $data = [
            'pasantias' => $pasantias
        ];
        
        $this->view('pasantias/company_index', $data);
    }
    
    // Company: Finalize Internship
    public function finalize($id){
        if($_SESSION['user_role'] != 4){ redirect('dashboard'); }

        $pasantia = $this->pasantiaModel->getPasantiaById($id);
        
        // Ownership Check
        // Note: pasantia has empresa_id. We need to check if that matches current user's associated empresa_id.
        // If User ID == Empresa ID (as seen in Plazas), then check:
        // Wait, User table has `empresa_id` column?
        // Let's check User Model or Login Session.
        // In Plazas::add, 'empresa_id' => $_SESSION['user_id'].
        // So User (Role 4) IS the Company Record ID? Or User has ID and is linked to Company Table?
        // Plaza Model Join: INNER JOIN usuarios ON plazas.empresa_id = usuarios.id
        // So plazas.empresa_id IS user.id.
        // Pasantias table has `empresa_id`.
        
        if($pasantia->empresa_id != $_SESSION['user_id']){
            flash('pasantia_message', 'No tienes permiso para gestionar esta pasantía', 'alert alert-danger');
            redirect('pasantias/company_index');
        }

        if($pasantia->estado == 'finalizada'){
             flash('pasantia_message', 'Esta pasantía ya fue finalizada', 'alert alert-info');
             redirect('pasantias/company_index');
        }

        $data = [
            'pasantia' => $pasantia,
            'id' => $id
        ];

        $this->view('pasantias/finalize', $data);
    }

    public function process_finalization($id){
        if($_SERVER['REQUEST_METHOD'] != 'POST'){ redirect('pasantias/company_index'); }
        if($_SESSION['user_role'] != 4){ redirect('dashboard'); }

        if(!validateCsrfToken($_POST['csrf_token'] ?? '')){
             flash('pasantia_message', 'Error de seguridad: Token CSRF inválido', 'alert alert-danger');
             redirect('pasantias/company_index');
             return;
        }

        // Validate Ownership again
        $pasantia = $this->pasantiaModel->getPasantiaById($id);
        if($pasantia->empresa_id != $_SESSION['user_id']){
             redirect('pasantias/company_index');
        }
        
        // Collect Data
        $data = [
            'pasantia_id' => $id,
            'empresa_id' => $_SESSION['user_id'],
            'rating' => trim($_POST['rating'] ?? ''),
            'comentarios' => sanitizeString($_POST['comentarios'] ?? ''),
            'criterios' => json_encode($_POST['criterios'] ?? []),
            'rating_err' => '',
            'comentarios_err' => ''
        ];

        // Validation
        if(empty($data['rating'])){ $data['rating_err'] = 'Calificación requerida'; }
        if(empty($data['comentarios'])){ $data['comentarios_err'] = 'Comentarios requeridos'; }

        if(empty($data['rating_err']) && empty($data['comentarios_err'])){
            // 1. Save Evaluation
            if($this->pasantiaModel->addEvaluacionEmpresa($data)){
                // 2. Update Status
                $this->pasantiaModel->finalizarPasantia($id);
                // 3. Notify Student
                $this->notificationModel->addNotification($pasantia->estudiante_id, 'Tu pasantía ha sido finalizada. Por favor completa el feedback para descargar tu certificado.', 'info');
                
                flash('pasantia_message', 'Pasantía finalizada correctamente', 'alert alert-success');
                redirect('pasantias/company_index');
            } else {
                die('Error al guardar evaluación');
            }
        } else {
            $data['pasantia'] = $pasantia;
            $data['id'] = $id;
            $this->view('pasantias/finalize', $data);
        }
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
            
            // Validar CSRF
            if(!validateCsrfToken($_POST['csrf_token'] ?? '')){
                flash('admin_message', 'Error de seguridad: Token CSRF inválido', 'alert alert-danger');
                redirect('pasantias/add');
                return;
            }

            // Sanitización Moderna (Reemplaza FILTER_SANITIZE_STRING)
            $data = [
                'estudiante_id' => trim($_POST['estudiante_id'] ?? ''),
                'empresa_id' => trim($_POST['empresa_id'] ?? ''),
                'tutor_id' => trim($_POST['tutor_id'] ?? ''),
                'institucion_id' => trim($_POST['institucion_id'] ?? ''),
                'proyecto_asociado' => sanitizeString($_POST['proyecto'] ?? ''),
                'fecha_inicio' => trim($_POST['fecha_inicio'] ?? ''),
                'fecha_fin' => trim($_POST['fecha_fin'] ?? ''),
                'estado' => 'Activa'
            ];

            // Validar campos requeridos básicos (si no se hizo ya en el form)
            if(empty($data['estudiante_id']) || empty($data['empresa_id']) || empty($data['fecha_inicio']) || empty($data['proyecto_asociado'])){
                flash('admin_message', 'Por favor complete todos los campos obligatorios', 'alert alert-warning');
                $this->view('admin/pasantias/add', [
                    'students' => $students,
                    'empresas' => $empresas,
                    'tutors' => $tutors,
                    'instituciones' => $instituciones
                ]);
                return;
            }

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

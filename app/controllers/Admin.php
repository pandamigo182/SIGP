<?php
class Admin extends Controller {
    public function __construct(){
        if(!isLoggedIn() || $_SESSION['user_role'] != 1){ // 1 = Admin
            redirect('auth/login');
        }

        $this->userModel = $this->model('User');
        $this->carreraModel = $this->model('Carrera');
        $this->studentModel = $this->model('Student');
        $this->empresaModel = $this->model('Empresa');
        $this->bitacoraModel = $this->model('Bitacora');
        $this->settingsModel = $this->model('Settings');
        $this->plazaModel = $this->model('Plaza');
    }

    public function index(){
        $this->dashboard();
    }

    public function dashboard(){
        // Consultas de Métricas
        // Usando 'plazas' para conteo de vacantes.
        $totalPlazas = $this->db_count('plazas');
        
        // Pasantías Activas: Plazas publicadas en los últimos 60 días
        $activePasantias = $this->db_count('plazas', "WHERE fechaPublicacion > DATE_SUB(NOW(), INTERVAL 60 DAY)"); 
        
        // Estudiantes: Rol 5
        $totalStudents = $this->db_count('usuarios', "WHERE role_id = 5"); 
        
        $totalCompanies = $this->db_count('empresas');

        $data = [
            'totalPlazas' => $totalPlazas,
            'activePasantias' => $activePasantias,
            'totalStudents' => $totalStudents,
            'totalCompanies' => $totalCompanies
        ];

        $this->view('admin/dashboard', $data);
    }
    
    // Auxiliar para conteos
    private function db_count($table, $where = ''){
        $db = new Database;
        try {
            $db->query("SELECT COUNT(*) as count FROM $table $where");
            $row = $db->single();
            return $row ? $row->count : 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    // --- Bitacora Implementation ---
    // --- Implementación de Bitácora ---
    public function logs($page = 1){
        $limit = 50;
        $offset = ($page - 1) * $limit;

        $filters = [
            'search' => isset($_GET['search']) ? trim($_GET['search']) : '',
            'accion' => isset($_GET['accion']) ? trim($_GET['accion']) : '',
            'fecha_inicio' => isset($_GET['fecha_inicio']) ? trim($_GET['fecha_inicio']) : '',
            'fecha_fin' => isset($_GET['fecha_fin']) ? trim($_GET['fecha_fin']) : ''
        ];

        $logs = $this->bitacoraModel->getLogs($filters, $limit, $offset);
        $totalLogs = $this->bitacoraModel->countLogs($filters);
        $totalPages = ceil($totalLogs / $limit);
        
        $actions = $this->bitacoraModel->getActions();

        $data = [
            'logs' => $logs,
            'page' => $page,
            'totalPages' => $totalPages,
            'filters' => $filters,
            'actions' => $actions
        ];
        $this->view('admin/logs/index', $data);
    }

    // --- Plazas (Pasantías) Implementation ---
    // --- Implementación de Plazas (Pasantías) ---
    public function plazas($page = 1){
        $limit = 10;
        $offset = ($page - 1) * $limit;
        
        $filters = [
            'search' => isset($_GET['search']) ? trim($_GET['search']) : '',
            'empresa_id' => isset($_GET['empresa_id']) ? trim($_GET['empresa_id']) : ''
        ];

        $plazas = $this->plazaModel->getAllPlazasWithStats($filters, $limit, $offset);
        $totalPlazas = $this->plazaModel->countAllPlazas($filters);
        $totalPages = ceil($totalPlazas / $limit);
        
        // Obtener Empresas para Filtro
        $empresas = $this->empresaModel->getEmpresas(1000); // Get all (or limit high)

        $data = [
            'plazas' => $plazas,
            'page' => $page,
            'totalPages' => $totalPages,
            'filters' => $filters,
            'empresas' => $empresas
        ];

        $this->view('admin/plazas/index', $data);
    }

    // --- Implementación de Empresas ---
    public function empresas($page = 1){
        $limit = 10;
        $offset = ($page - 1) * $limit;
        
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        
        $empresas = $this->empresaModel->getEmpresas($limit, $offset, $search);
        $totalEmpresas = $this->empresaModel->countEmpresas($search);
        $totalPages = ceil($totalEmpresas / $limit);

        $data = [
            'empresas' => $empresas,
            'page' => $page,
            'totalPages' => $totalPages,
            'search' => $search
        ];
        $this->view('admin/empresas/index', $data);
    }
    
    public function empresas_add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            // Validar CSRF
            $this->verifyCsrf();

            // Sanitización y Recolección de Datos
            $data = [
                'nombre' => sanitizeString($_POST['nombre'] ?? ''),
                'descripcion' => sanitizeString($_POST['descripcion'] ?? ''),
                'direccion' => sanitizeString($_POST['direccion'] ?? ''),
                'telefono' => sanitizeString($_POST['telefono'] ?? ''),
                'website' => sanitizeString($_POST['website'] ?? ''),
                'latitud' => sanitizeString($_POST['latitud'] ?? ''),
                'longitud' => sanitizeString($_POST['longitud'] ?? ''),
                'nit' => sanitizeString($_POST['nit'] ?? ''),
                'email_contacto' => trim($_POST['email_contacto'] ?? ''),
                'representante_legal' => sanitizeString($_POST['representante_legal'] ?? ''),
                'rubro' => sanitizeString($_POST['rubro'] ?? ''),
                'departamento_id' => sanitizeString($_POST['departamento_id'] ?? ''),
                'municipio_id' => sanitizeString($_POST['municipio_id'] ?? ''),
                'distrito_id' => sanitizeString($_POST['distrito_id'] ?? ''),
                'logo_path' => 'default_logo.png', // Default
                'logo_err' => '',
                'nombre_err' => '',
                'email_err' => '',
                'website_err' => '',
                'telefono_err' => ''
            ];

            // Validaciones
            if(empty($data['nombre'])){ $data['nombre_err'] = 'Ingrese el nombre de la empresa'; }
            if(!empty($data['email_contacto']) && !validateEmail($data['email_contacto'])){ $data['email_err'] = 'Email inválido'; }
            if(!empty($data['website']) && !validateUrl($data['website'])){ $data['website_err'] = 'URL inválida (incluya http/https)'; }
            if(!empty($data['telefono']) && !validatePhone($data['telefono'])){ $data['telefono_err'] = 'Formato de teléfono inválido'; }

            // Manejo de Subida de Archivos
            if(isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK){
                $fileTmpPath = $_FILES['logo']['tmp_name'];
                $fileName = $_FILES['logo']['name'];
                $fileSize = $_FILES['logo']['size'];
                $fileType = $_FILES['logo']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                if(in_array($fileExtension, $allowedExtensions)){
                    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                    $uploadFileDir = dirname(APPROOT) . '/public/img/logos/';
                    
                    if (!file_exists($uploadFileDir)) {
                        mkdir($uploadFileDir, 0755, true);
                    }
                    $dest_path = $uploadFileDir . $newFileName;
                    if(move_uploaded_file($fileTmpPath, $dest_path)){
                        $data['logo_path'] = $newFileName;
                    }
                } else {
                    $data['logo_err'] = 'Formato de imagen no válido';
                }
            }

            if(empty($data['nombre_err']) && empty($data['email_err']) && empty($data['website_err']) && empty($data['telefono_err']) && empty($data['logo_err'])){
                if($this->empresaModel->addEmpresa($data)){
                    $this->bitacoraModel->log($_SESSION['user_id'], 'CREATE_EMPRESA', 'Registró empresa: ' . $data['nombre']);
                    flash('admin_message', 'Empresa registrada exitosamente');
                    redirect('admin/empresas');
                } else {
                    die('Error al registrar la empresa en la base de datos');
                }
            } else {
                // Volver a la vista con errores
                 $departamentos = $this->empresaModel->getDepartamentos();
                 $data['departamentos'] = $departamentos;
                 $this->view('admin/empresas/add', $data);
            }

        } else {
             $departamentos = $this->empresaModel->getDepartamentos();
             $data = [
                 'departamentos' => $departamentos,
                 'nombre' => '', 'descripcion' => '', 'direccion' => '', 'telefono' => '', 'website' => '',
                 'latitud' => '', 'longitud' => '', 'nit' => '', 'email_contacto' => '', 'representante_legal' => '', 'rubro' => '',
                 'departamento_id' => '', 'municipio_id' => '', 'distrito_id' => '',
                 'nombre_err' => '', 'email_err' => '', 'website_err' => '', 'telefono_err' => '', 'logo_err' => ''
             ];
             $this->view('admin/empresas/add', $data);
        }
    }

    public function get_municipios($departamento_id){
        $municipios = $this->empresaModel->getMunicipios($departamento_id);
        header('Content-Type: application/json');
        echo json_encode($municipios);
    }

    public function get_distritos($municipio_id){
        $distritos = $this->empresaModel->getDistritos($municipio_id);
        header('Content-Type: application/json');
        echo json_encode($distritos);
    }

    public function empresas_edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            // Validar CSRF
            $this->verifyCsrf();

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            // Manejo de Subida de Archivos
            $logoPath = $_POST['current_logo'];
            if(isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK){
                $fileTmpPath = $_FILES['logo']['tmp_name'];
                $fileName = $_FILES['logo']['name'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $uploadFileDir = dirname(APPROOT) . '/public/img/logos/';
                
                if (!file_exists($uploadFileDir)) mkdir($uploadFileDir, 0755, true);

                $dest_path = $uploadFileDir . $newFileName;
                
                if(move_uploaded_file($fileTmpPath, $dest_path)){
                    $logoPath = $newFileName;
                }
            }

            $data = [
                'id' => $id,
                'nombre' => trim($_POST['nombre']),
                'descripcion' => trim($_POST['descripcion']),
                'direccion' => trim($_POST['direccion']),
                'telefono' => trim($_POST['telefono']),
                'website' => trim($_POST['website']),
                'latitud' => trim($_POST['latitud']),
                'longitud' => trim($_POST['longitud']),
                'nit' => trim($_POST['nit']),
                'email_contacto' => trim($_POST['email_contacto']),
                'representante_legal' => trim($_POST['representante_legal']),
                'rubro' => trim($_POST['rubro']),
                'departamento_id' => trim($_POST['departamento_id']),
                'municipio_id' => trim($_POST['municipio_id']),
                'distrito_id' => trim($_POST['distrito_id']),
                'logo_path' => $logoPath,
                'logo' => $logoPath 
            ];
            
            if($this->empresaModel->updateEmpresa($data)){
                // Log Update
                $this->bitacoraModel->log($_SESSION['user_id'], 'UPDATE_EMPRESA', 'Actualizó empresa: ' . $data['nombre']);
                flash('admin_message', 'Empresa actualizada');
                redirect('admin/empresas');
            } else {
                die('Error al actualizar la empresa');
            }
        } else {
             $empresa = $this->empresaModel->getEmpresaById($id);
             $departamentos = $this->empresaModel->getDepartamentos();
             
             // Pre-fetch municipios/distritos for current selection to populate dropdowns?
             // Or rely on JS? We should ideally pass them or JS fetches them based on selected id.
             // For simplicity, we pass default lists or rely on load.
             // We'll pass the empresa data and departments.
             
             $data = [
                 'empresa' => $empresa,
                 'departamentos' => $departamentos
             ];
             $this->view('admin/empresas/edit', $data);
        }
    }

    public function empresas_delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $empresa = $this->empresaModel->getEmpresaById($id);
            if($this->empresaModel->deleteEmpresa($id)){
                $this->bitacoraModel->log($_SESSION['user_id'], 'DELETE_EMPRESA', 'Eliminó empresa: ' . $empresa->nombre);
                flash('admin_message', 'Empresa eliminada');
            } else {
                flash('admin_message', 'Error al eliminar empresa', 'alert alert-danger');
            }
            redirect('admin/empresas');
        } else {
            redirect('admin/empresas');
        }
    }

    // Listar todos los usuarios (Paginado)
    public function users($page = 1){
        $limit = 10;
        $offset = ($page - 1) * $limit;
        
        $users = $this->userModel->getUsers($limit, $offset);
        $totalUsers = $this->userModel->countUsers();
        $totalPages = ceil($totalUsers / $limit);

        $data = [
            'users' => $users,
            'page' => $page,
            'totalPages' => $totalPages
        ];

        $this->view('admin/users/index', $data);
    }

    // Agregar Usuario
    public function users_add(){
        $carreras = $this->carreraModel->getCarreras();
        $habilidades = $this->studentModel->getAllSkills();
        $empresas = $this->empresaModel->getEmpresas();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            // Validar CSRF
            if(!validateCsrfToken($_POST['csrf_token'] ?? '')){
                flash('admin_message', 'Error de seguridad: Token inválido', 'alert alert-danger');
                redirect('admin/users');
                return;
            }
            
            // Sanitize
            $_POST = filter_input_array(INPUT_POST, [
                'nombre' => FILTER_UNSAFE_RAW,
                'email' => FILTER_SANITIZE_EMAIL,
                'password' => FILTER_UNSAFE_RAW,
                'confirm_password' => FILTER_UNSAFE_RAW,
                'role_id' => FILTER_SANITIZE_NUMBER_INT,
                'matricula' => FILTER_UNSAFE_RAW,
                'carrera_id' => FILTER_SANITIZE_NUMBER_INT,
                'dui' => FILTER_UNSAFE_RAW,
                'edad' => FILTER_SANITIZE_NUMBER_INT,
                'genero' => FILTER_UNSAFE_RAW,
                'estado_civil' => FILTER_UNSAFE_RAW,
                'telefono' => FILTER_UNSAFE_RAW,
                'direccion' => FILTER_UNSAFE_RAW,
                'departamento' => FILTER_UNSAFE_RAW,
                'municipio' => FILTER_UNSAFE_RAW,
                'institucion' => FILTER_UNSAFE_RAW,
                'nivel_academico' => FILTER_UNSAFE_RAW,
                'estado_ocupacional' => FILTER_UNSAFE_RAW
            ]);

            $data = [
                'nombre' => sanitizeString($_POST['nombre']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'role_id' => trim($_POST['role_id']),
                // Student Fields
                'matricula' => sanitizeString($_POST['matricula']),
                'carrera_id' => trim($_POST['carrera_id']),
                'dui' => sanitizeString($_POST['dui']),
                'edad' => trim($_POST['edad']),
                'genero' => sanitizeString($_POST['genero']),
                'estado_civil' => sanitizeString($_POST['estado_civil']),
                'telefono' => sanitizeString($_POST['telefono']),
                'direccion' => sanitizeString($_POST['direccion']),
                'departamento' => sanitizeString($_POST['departamento']),
                'municipio' => sanitizeString($_POST['municipio']),
                'institucion' => sanitizeString($_POST['institucion']),
                'nivel_academico' => sanitizeString($_POST['nivel_academico']),
                'estado_ocupacional' => sanitizeString($_POST['estado_ocupacional']),
                'habilidades' => isset($_POST['habilidades']) ? $_POST['habilidades'] : [],
                'estado_ocupacional' => trim($_POST['estado_ocupacional']),
                'habilidades' => isset($_POST['habilidades']) ? $_POST['habilidades'] : [],
                'empresa_id' => trim($_POST['empresa_id'] ?? ''),
                'carreras' => $carreras,
                'skills_list' => $habilidades,
                'empresas_list' => $empresas,
                'nombre_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Validaciones (similar a registro)
            if(empty($data['email'])){
                $data['email_err'] = 'Ingrese email';
            } else {
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err'] = 'Email ya registrado';
                }
            }
            if(empty($data['nombre'])){ $data['nombre_err'] = 'Ingrese nombre'; }
            if(empty($data['password'])){ $data['password_err'] = 'Ingrese contraseña'; }
            elseif(strlen($data['password']) < 6){ $data['password_err'] = 'Mínimo 6 caracteres'; }
            if($data['password'] != $data['confirm_password']){ $data['confirm_password_err'] = 'Contraseñas no coinciden'; }

            if(empty($data['email_err']) && empty($data['nombre_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if($this->userModel->register($data)){
                     // Handle Extended Student Profile
                     if($data['role_id'] == 5){
                        $userId = $this->userModel->findUserByEmail($data['email']) ? $this->userModel->getUserById($this->userModel->findUserByEmail($data['email'])) : null; 
                        // Note: register doesn't return ID directly in this implement without modifying User model return. 
                        // But User model register returns true. So we need to fetch ID or modify User model.
                        // Actually User model register uses lastInsertId but doesn't return it.
                        // Quick fix: User model already creates empty profile in 'register'. We UPDATE it here.
                        
                        // We need the ID. Let's fetch by email since it's unique.
                        // Wait, creating a helper in User model to get ID after register would be better, but fetching by email is safe here.
                         $newUser = $this->userModel->login($data['email'], $data['password']); // Login returns user row (obj)
                         // Wait, Login needs unhashed password. $data['password'] is hashed.
                         // Alternative: Login logic in Model returns row.
                         // Let's use database->lastInsertId() inside the model? 
                         // Check User.php: register() returns true.
                         // Let's modify User.php to return ID? No, let's fetch by email.
                         
                         $this->db = new Database;
                         $this->db->query("SELECT id FROM usuarios WHERE email = :email");
                         $this->db->bind(':email', $data['email']);
                         $userRow = $this->db->single();
                         $userId = $userRow->id;

                         if($userId){
                             $this->studentModel->updateProfile($userId, $data);
                             $this->studentModel->syncSkills($userId, $data['habilidades']);
                             
                             // Handle CV Upload
                             if(isset($_FILES['cv_file']) && $_FILES['cv_file']['error'] === UPLOAD_ERR_OK){
                                 $uploadDir = 'uploads/cvs/';
                                 if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                                 $filename = uniqid() . '_' . basename($_FILES['cv_file']['name']);
                                 move_uploaded_file($_FILES['cv_file']['tmp_name'], $uploadDir . $filename);
                                 $this->studentModel->updateCV($userId, $filename);
                             }
                         }
                     }
                    // Log Creation
                    $this->bitacoraModel->log($_SESSION['user_id'], 'CREATE_USER', 'Creó usuario: ' . $data['email'] . ' (Rol: ' . $data['role_id'] . ')');
                    
                    flash('admin_message', 'Usuario agregado correctamente');
                    redirect('admin/users');
                } else {
                    die('Error al registrar');
                }
            } else {
                $this->view('admin/users/add', $data);
            }

        } else {
            $data = [
                'nombre' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'role_id' => '',
                'matricula' => '',
                'carrera_id' => '',
                
                'dui' => '', 'edad' => '', 'genero' => '', 'estado_civil' => '',
                'telefono' => '', 'direccion' => '', 'departamento' => '', 'municipio' => '',
                'institucion' => '', 'nivel_academico' => '', 'estado_ocupacional' => '',
                'habilidades' => [],
                
                'carreras' => $carreras,
                'skills_list' => $habilidades,
                'nombre_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            $this->view('admin/users/add', $data);
        }
    }

    // Editar Usuario
    public function users_edit($id){
        $carreras = $this->carreraModel->getCarreras();
        $habilidades = $this->studentModel->getAllSkills();
        $empresas = $this->empresaModel->getEmpresas();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'nombre' => trim($_POST['nombre']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']), // Opcional
                'role_id' => trim($_POST['role_id']),
                // Student Fields
                'matricula' => trim($_POST['matricula']),
                'carrera_id' => trim($_POST['carrera_id']),
                'dui' => trim($_POST['dui']),
                'edad' => trim($_POST['edad']),
                'genero' => trim($_POST['genero']),
                'estado_civil' => trim($_POST['estado_civil']),
                'telefono' => trim($_POST['telefono']),
                'direccion' => trim($_POST['direccion']),
                'departamento_id' => trim($_POST['departamento_id']),
                'municipio_id' => trim($_POST['municipio_id']),
                'distrito_id' => trim($_POST['distrito_id']),
                'institucion' => trim($_POST['institucion']),
                'nivel_academico' => trim($_POST['nivel_academico']),
                'estado_ocupacional' => trim($_POST['estado_ocupacional']),
                'habilidades' => isset($_POST['habilidades']) ? $_POST['habilidades'] : [],
                'empresa_id' => trim($_POST['empresa_id'] ?? ''),
                'carreras' => $carreras,
                'skills_list' => $habilidades,
                'empresas_list' => $empresas,
                'departamentos_list' => $this->empresaModel->getDepartamentos(),
                'nombre_err' => '',
                'email_err' => '',
                'password_err' => ''
            ];

            if(empty($data['email'])){ $data['email_err'] = 'Ingrese email'; }
            if(empty($data['nombre'])){ $data['nombre_err'] = 'Ingrese nombre'; }
            // Password opcional, si viene vacío no se cambia

            if(empty($data['email_err']) && empty($data['nombre_err'])){
                // Si hay pass, hash
                if(!empty($data['password'])){
                    if(strlen($data['password']) < 6){
                        $data['password_err'] = 'Mínimo 6 caracteres';
                    } else {
                         $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                    }
                }

                if(empty($data['password_err'])){
                    if($this->userModel->updateUser($data)){
                        // Update Student Profile
                        if($data['role_id'] == 5){
                             $this->studentModel->updateProfile($id, $data);
                             $this->studentModel->syncSkills($id, $data['habilidades']);
                             
                             // Handle CV Upload
                             if(isset($_FILES['cv_file']) && $_FILES['cv_file']['error'] === UPLOAD_ERR_OK){
                                 $uploadDir = 'uploads/cvs/';
                                 if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                                 $filename = uniqid() . '_' . basename($_FILES['cv_file']['name']);
                                 move_uploaded_file($_FILES['cv_file']['tmp_name'], $uploadDir . $filename);
                                 $this->studentModel->updateCV($id, $filename);
                             }
                        }
                        
                        flash('admin_message', 'Usuario actualizado');
                        redirect('admin/users');
                    } else {
                        die('Error al actualizar');
                    }
                } else {
                    $this->view('admin/users/edit', $data);
                }
            } else {
                $this->view('admin/users/edit', $data);
            }

        } else {
            $user = $this->userModel->getUserById($id);
            // Si es estudiante, obtener perfil
            $sProfile = null;
            $sSkills = [];
            $sExperience = [];
            $sCerts = [];
            
            if($user->role_id == 5){
                $sProfile = $this->studentModel->getProfile($id);
                $sSkills = $this->studentModel->getStudentSkills($id);
                $sExperience = $this->studentModel->getExperience($id); // Not used in main form yet
                $sCerts = $this->studentModel->getCertificates($id); // Not used in main form yet
            }

            $currentSkillsIds = [];
            foreach($sSkills as $sk){ $currentSkillsIds[] = $sk->id; }

            $data = [
                'id' => $id,
                'nombre' => $user->nombre,
                'email' => $user->email,
                'password' => '', // Clean field
                'role_id' => $user->role_id,
                'empresa_id' => isset($user->empresa_id) ? $user->empresa_id : '',
                // Pre-fill
                'matricula' => $sProfile ? $sProfile->matricula : '',
                'carrera_id' => $sProfile ? $sProfile->carrera_id : '',
                'dui' => $sProfile ? $sProfile->dui : '',
                'edad' => $sProfile ? $sProfile->edad : '',
                'genero' => $sProfile ? $sProfile->genero : '',
                'estado_civil' => $sProfile ? $sProfile->estado_civil : '',
                'telefono' => $sProfile ? $sProfile->telefono : '',
                'direccion' => $sProfile && isset($sProfile->direccion) ? $sProfile->direccion : '',
                'departamento_id' => $sProfile && isset($sProfile->departamento_id) ? $sProfile->departamento_id : '',
                'municipio_id' => $sProfile && isset($sProfile->municipio_id) ? $sProfile->municipio_id : '',
                'distrito_id' => $sProfile && isset($sProfile->distrito_id) ? $sProfile->distrito_id : '',
                'institucion' => $sProfile && isset($sProfile->institucion) ? $sProfile->institucion : '',
                'nivel_academico' => $sProfile && isset($sProfile->nivel_academico) ? $sProfile->nivel_academico : '',
                'estado_ocupacional' => $sProfile && isset($sProfile->estado_ocupacional) ? $sProfile->estado_ocupacional : '',
                'cv_path' => $sProfile && isset($sProfile->cv_path) ? $sProfile->cv_path : '',
                'habilidades' => $currentSkillsIds,
                // Lists
                'carreras' => $carreras,
                'skills_list' => $habilidades,
                'empresas_list' => $empresas,
                'departamentos_list' => $this->empresaModel->getDepartamentos(),
                'experiences' => $sExperience,
                'certificates' => $sCerts,
                
                'nombre_err' => '',
                'email_err' => '',
                'password_err' => ''
            ];
            $this->view('admin/users/edit', $data);
        }
    }

    // Eliminar Usuario
    public function users_delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->userModel->deleteUser($id)){
                flash('admin_message', 'Usuario eliminado');
                redirect('admin/users');
            } else {
                die('Error al eliminar');
            }
        } else {
            redirect('admin/users');
        }
    }
    // --- Gestión de Sub-Entidades ---

    public function users_experience_add($userId){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'usuario_id' => $userId,
                'empresa' => trim($_POST['empresa']),
                'cargo' => trim($_POST['cargo']),
                'fecha_inicio' => trim($_POST['fecha_inicio']),
                'fecha_fin' => trim($_POST['fecha_fin']),
                'descripcion' => trim($_POST['descripcion'])
            ];
            $this->studentModel->addExperience($data);
            redirect('admin/users_edit/' . $userId);
        }
    }

    public function users_experience_delete($userId, $expId){
         $this->studentModel->deleteExperience($expId);
         redirect('admin/users_edit/' . $userId);
    }

    public function users_certificate_add($userId){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
             if(isset($_FILES['cert_file']) && $_FILES['cert_file']['error'] === UPLOAD_ERR_OK){
                 $uploadDir = 'uploads/certificates/';
                 if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                 $filename = uniqid() . '_' . basename($_FILES['cert_file']['name']);
                 move_uploaded_file($_FILES['cert_file']['tmp_name'], $uploadDir . $filename);
                 
                 $name = trim($_POST['nombre']);
                 $this->studentModel->addCertificate($userId, $name, $filename);
             }
             redirect('admin/users_edit/' . $userId);
        }
    }

    public function users_certificate_delete($userId, $certId){
        $this->studentModel->deleteCertificate($certId);
        redirect('admin/users_edit/' . $userId);
    }

    // Settings
    public function settings(){
        // Obtener configuración actual
        $settings = $this->settingsModel->getSettings();
        if(!$settings){
             $settings = (object)[
                 'id' => 1, 'nombre_sistema' => '', 'nombre_empresa' => '', 'direccion' => '', 
                 'departamento_id' => '', 'municipio_id' => '', 'distrito_id' => '',
                 'email' => '', 'telefono' => '', 'whatsapp' => '', 
                 'logo_path' => '', 'favicon_path' => '', 'map_embed_url' => '',
                 'email_alertas' => '', 'email_smtp_host' => '', 'email_smtp_user' => '', 'email_smtp_pass' => '', 'email_smtp_port' => ''
             ];
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            // Prepare Data with NULL for empty integers
            $depId = !empty($_POST['departamento_id']) ? $_POST['departamento_id'] : null;
            $munId = !empty($_POST['municipio_id']) ? $_POST['municipio_id'] : null;
            $distId = !empty($_POST['distrito_id']) ? $_POST['distrito_id'] : null;

            // Enforce Static Logos as per user request
            $logoPath = 'logo.svg';
            $faviconPath = 'favicon.svg';
            
            // Map Logic: Extract src from iframe if needed
            $mapVal = trim($_POST['map_embed_url']);
            if (preg_match('/src="([^"]+)"/', $mapVal, $match)) {
                $mapVal = $match[1];
            }

            $data = [
                'id' => $settings->id,
                'nombre_sistema' => trim($_POST['nombre_sistema']),
                'nombre_empresa' => trim($_POST['nombre_empresa']),
                'direccion' => trim($_POST['direccion']),
                'departamento_id' => $depId,
                'municipio_id' => $munId,
                'distrito_id' => $distId,
                'email' => trim($_POST['email']),
                'telefono' => trim($_POST['telefono']),
                'whatsapp' => trim($_POST['whatsapp']),
                'map_embed_url' => $mapVal,
                'email_alertas' => trim($_POST['email_alertas']),
                'email_smtp_host' => trim($_POST['email_smtp_host']),
                'email_smtp_user' => trim($_POST['email_smtp_user']),
                'email_smtp_pass' => trim($_POST['email_smtp_pass']),
                'email_smtp_port' => trim($_POST['email_smtp_port']),
                'logo_path' => $logoPath,
                'favicon_path' => $faviconPath
            ];

            if($this->settingsModel->updateSettings($data)){
                $this->bitacoraModel->log($_SESSION['user_id'], 'UPDATE_SETTINGS', 'Actualizó configuración del sistema');
                flash('msg_success', 'Configuración actualizada correctamente');
                redirect('admin/settings');
            } else {
                die('Error al actualizar configuración');
            }

        } else {
            $departamentos = $this->empresaModel->getDepartamentos();
            $data = [
                'settings' => $settings,
                'departamentos' => $departamentos
            ];
            $this->view('admin/settings/index', $data);
        }
    }


}

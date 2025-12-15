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
    }

    public function index(){
        $this->users();
    }

    // --- Empresas Implementation ---
    public function empresas(){
        $empresas = $this->empresaModel->getEmpresas();
        $data = [
            'empresas' => $empresas
        ];
        $this->view('admin/empresas/index', $data);
    }
    
    public function empresas_add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            // Handle File Upload
            $logoPath = 'default_logo.png';
            if(isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK){
                $fileTmpPath = $_FILES['logo']['tmp_name'];
                $fileName = $_FILES['logo']['name'];
                $fileSize = $_FILES['logo']['size'];
                $fileType = $_FILES['logo']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $uploadFileDir = dirname(APPROOT) . '/public/img/logos/';
                
                // Create directory if it doesn't exist
                if (!file_exists($uploadFileDir)) {
                    mkdir($uploadFileDir, 0755, true);
                }

                $dest_path = $uploadFileDir . $newFileName;
                
                if(move_uploaded_file($fileTmpPath, $dest_path)){
                    $logoPath = $newFileName;
                }
            }

            $data = [
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
            
            if($this->empresaModel->addEmpresa($data)){
                flash('admin_message', 'Empresa registrada');
                redirect('admin/empresas');
            } else {
                die('Error al registrar la empresa');
            }
        } else {
             $departamentos = $this->empresaModel->getDepartamentos();
             $data = [
                 'departamentos' => $departamentos
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

    // Listar todos los usuarios
    public function users($filterRole = null){
        $users = $this->userModel->getUsers();
        
        // Filtro opcional por rol
        if($filterRole){
            $users = array_filter($users, function($user) use ($filterRole){
                return $user->role_id == $filterRole;
            });
        }

        $data = [
            'users' => $users,
            'filterRole' => $filterRole
        ];

        $this->view('admin/users/index', $data);
    }

    // Agregar Usuario
    public function users_add(){
        $carreras = $this->carreraModel->getCarreras();
        $habilidades = $this->studentModel->getAllSkills();
        $empresas = $this->empresaModel->getEmpresas();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'nombre' => trim($_POST['nombre']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
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
                'departamento' => trim($_POST['departamento']),
                'municipio' => trim($_POST['municipio']),
                'institucion' => trim($_POST['institucion']),
                'nivel_academico' => trim($_POST['nivel_academico']),
                'estado_ocupacional' => trim($_POST['estado_ocupacional']),
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

                    flash('admin_message', 'Usuario creado correctamente');
                    redirect('admin/users');
                } else {
                    die('Error al crear');
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
                'departamento' => trim($_POST['departamento']),
                'municipio' => trim($_POST['municipio']),
                'institucion' => trim($_POST['institucion']),
                'nivel_academico' => trim($_POST['nivel_academico']),
                'estado_ocupacional' => trim($_POST['estado_ocupacional']),
                'habilidades' => isset($_POST['habilidades']) ? $_POST['habilidades'] : [],
                'empresa_id' => trim($_POST['empresa_id'] ?? ''),
                'carreras' => $carreras,
                'skills_list' => $habilidades,
                'empresas_list' => $empresas,
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
                'direccion' => $sProfile ? $sProfile->direccion : '',
                'departamento' => $sProfile ? $sProfile->departamento : '',
                'municipio' => $sProfile ? $sProfile->municipio : '',
                'institucion' => $sProfile ? $sProfile->institucion : '',
                'nivel_academico' => $sProfile ? $sProfile->nivel_academico : '',
                'estado_ocupacional' => $sProfile ? $sProfile->estado_ocupacional : '',
                'cv_path' => $sProfile ? $sProfile->cv_path : '',
                'habilidades' => $currentSkillsIds,
                // Lists
                'carreras' => $carreras,
                'skills_list' => $habilidades,
                'empresas_list' => $empresas,
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
    // --- Sub-Entities Management ---

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
        $data = [
            'title' => 'Configuración del Sistema'
        ];
        $this->view('admin/settings', $data);
    }

    // Logs
    public function logs(){
        $data = [
            'title' => 'Registros del Sistema'
        ];
        $this->view('admin/logs', $data);
    }
}

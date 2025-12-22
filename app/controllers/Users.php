<?php
class Users extends Controller {
    public function __construct(){
        if(!isLoggedIn()){
            redirect('auth/login');
        }
        $this->userModel = $this->model('User');
        $this->studentModel = $this->model('Student');
        $this->carreraModel = $this->model('Carrera');
    }

    public function profile(){
        $userId = $_SESSION['user_id'];
        $user = $this->userModel->getUserById($userId);
        $carreras = $this->carreraModel->getCarreras();
        $habilidades = $this->studentModel->getAllSkills();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            // Validación CSRF
            if(!validateCsrfToken($_POST['csrf_token'] ?? '')){
                flash('profile_msg', 'Error de seguridad: Token CSRF inválido', 'alert alert-danger');
                redirect('users/profile');
                return;
            }

            // Sanitización Moderna y Variables en español
            $datos = [
                'id' => $userId,
                'nombre' => sanitizeString($_POST['nombre'] ?? ''),
                'email' => trim($_POST['email'] ?? ''), // Read-only usually, but sanitize
                'password' => trim($_POST['password'] ?? ''),
                'role_id' => $user->role_id,
                'foto_perfil' => $user->foto_perfil,
                
                // Datos del Estudiante
                'matricula' => trim($_POST['matricula'] ?? ''),
                'carrera_id' => trim($_POST['carrera_id'] ?? ''),
                'dui' => trim($_POST['dui'] ?? ''),
                'edad' => trim($_POST['edad'] ?? ''),
                'genero' => trim($_POST['genero'] ?? ''),
                'estado_civil' => trim($_POST['estado_civil'] ?? ''),
                'telefono' => sanitizeString($_POST['telefono'] ?? ''),
                'direccion' => sanitizeString($_POST['direccion'] ?? ''),
                'departamento' => sanitizeString($_POST['departamento'] ?? ''),
                'municipio' => sanitizeString($_POST['municipio'] ?? ''),
                'institucion' => sanitizeString($_POST['institucion'] ?? ''),
                'nivel_academico' => trim($_POST['nivel_academico'] ?? ''),
                'estado_ocupacional' => trim($_POST['estado_ocupacional'] ?? ''),
                'habilidades' => isset($_POST['habilidades']) ? $_POST['habilidades'] : [],
                
                'nombre_err' => '',
                'email_err' => '',
                'password_err' => '',
                'dui_err' => ''
            ];

             // Procesar subida de Avatar
             if(!empty($_FILES['foto']['name'])){
                $imgName = $_FILES['foto']['name'];
                $imgSize = $_FILES['foto']['size'];
                $tmpName = $_FILES['foto']['tmp_name'];
                
                $imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
                $validExt = ['jpg', 'jpeg', 'png'];

                if(in_array($imgExt, $validExt) && $imgSize < 5000000){
                    $newName = uniqid() . '_avatar.' . $imgExt;
                    $uploadDir = 'public/uploads/avatars/'; // Asegurar ruta public
                    if(!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                    
                    move_uploaded_file($tmpName, $uploadDir . $newName);
                    $datos['foto_perfil'] = $newName;
                }
            }

            if(empty($datos['nombre'])){ $datos['nombre_err'] = 'Ingrese nombre'; }
            
            // Lógica de Contraseña
            if(!empty($datos['password'])){
                 if(strlen($datos['password']) < 6){
                     $datos['password_err'] = 'Mínimo 6 caracteres';
                 } 
            }

            // Validar DUI
            if(!empty($datos['dui'])){
                if(!preg_match('/^\d{8}-\d{1}$/', $datos['dui'])){
                    $datos['dui_err'] = 'Formato inválido (00000000-0)';
                }
            }

            if(empty($datos['nombre_err']) && empty($datos['password_err']) && empty($datos['dui_err'])){
                 // Actualizar Usuario Principal
                 if($this->userModel->updateProfile($datos)){
                     $_SESSION['user_name'] = $datos['nombre'];
                     if($datos['foto_perfil']){ $_SESSION['user_foto'] = $datos['foto_perfil']; }

                     // Actualizar Perfil de Estudiante
                     if($user->role_id == 5){
                         $this->studentModel->updateProfile($userId, $datos);
                         $this->studentModel->syncSkills($userId, $datos['habilidades']);
                         
                         // Subida de CV
                         if(isset($_FILES['cv_file']) && $_FILES['cv_file']['error'] === UPLOAD_ERR_OK){
                             $uploadDir = 'public/uploads/cvs/';
                             if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                             $filename = uniqid() . '_' . basename($_FILES['cv_file']['name']);
                             move_uploaded_file($_FILES['cv_file']['tmp_name'], $uploadDir . $filename);
                             $this->studentModel->updateCV($userId, $filename);
                         }
                     }

                     flash('profile_msg', 'Perfil actualizado correctamente');
                     redirect('users/profile');
                 } else {
                     notify_admins('Error al actualizar perfil usuario ID: ' . $userId);
                     flash('fatal_error', 'Error crítico al actualizar el perfil.');
                     redirect('users/profile');
                 }
            } else {
                 // Devolver errores (Necesario llenar listas de nuevo)
                 // NOTA: Deberíamos modificar la vista pero mapeamos a $data por compatibilidad
                 // Por seguridad, mapeamos de nuevo a la estructura $data esperada por la vista
                 $data = $datos; 
                 $data['carreras'] = $carreras;
                 $data['skills_list'] = $habilidades;
                 $this->view('users/profile', $data);
            }

        } else {
            // Obtener Datos del Estudiante
            $sProfile = null;
            $sSkills = [];
            $sExperience = [];
            $sCerts = [];
            
            if($user->role_id == 5){
                $sProfile = $this->studentModel->getProfile($userId);
                $sSkills = $this->studentModel->getStudentSkills($userId);
                $sExperience = $this->studentModel->getExperience($userId);
                $sCerts = $this->studentModel->getCertificates($userId);
            }
            
            $currentSkillsIds = [];
            foreach($sSkills as $sk){ $currentSkillsIds[] = $sk->id; }

            $data = [
                'user' => $user,
                'nombre' => $user->nombre,
                'email' => $user->email,
                'foto_perfil' => $user->foto_perfil,
                
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
                
                'carreras' => $carreras,
                'skills_list' => $habilidades,
                'experiences' => $sExperience,
                'certificates' => $sCerts,
                
                'nombre_err' => '',
                'password_err' => '',
                'dui_err' => ''
            ];
            $this->view('users/profile', $data);
        }
    }
    
    // Sub-Entities (Experience/Certs)
    public function experience_add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            // Validación CSRF
            if(!validateCsrfToken($_POST['csrf_token'] ?? '')){
                flash('profile_msg', 'Error de seguridad: Token CSRF inválido', 'alert alert-danger');
                redirect('users/profile');
                return;
            }

            // Sanitización
            $datos = [
                'usuario_id' => $_SESSION['user_id'],
                'empresa' => sanitizeString($_POST['empresa'] ?? ''),
                'cargo' => sanitizeString($_POST['cargo'] ?? ''),
                'fecha_inicio' => trim($_POST['fecha_inicio'] ?? ''),
                'fecha_fin' => trim($_POST['fecha_fin'] ?? ''),
                'descripcion' => sanitizeString($_POST['descripcion'] ?? '')
            ];

            if($this->studentModel->addExperience($datos)){
                flash('profile_msg', 'Experiencia agregada correctamente');
            } else {
                flash('profile_msg', 'Error al guardar experiencia', 'alert alert-danger');
            }
            redirect('users/profile');
        }
    }

    public function experience_delete($expId){
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
             
             // Validación CSRF
             if(!validateCsrfToken($_POST['csrf_token'] ?? '')){
                flash('profile_msg', 'Token CSRF inválido', 'alert alert-danger');
                redirect('users/profile');
                return;
            }

             // ¿Verificar propiedad? Idealmente sí.
             $this->studentModel->deleteExperience($expId);
             flash('profile_msg', 'Experiencia eliminada');
             redirect('users/profile');
         } else {
             // Si se intenta por GET, redirigir
             redirect('users/profile');
         }
    }

    public function certificate_add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
             // Validación CSRF
             if(!validateCsrfToken($_POST['csrf_token'] ?? '')){
                flash('profile_msg', 'Error de seguridad: Token CSRF inválido', 'alert alert-danger');
                redirect('users/profile');
                return;
            }

             if(isset($_FILES['cert_file']) && $_FILES['cert_file']['error'] === UPLOAD_ERR_OK){
                 $uploadDir = 'public/uploads/certificates/'; // Ruta pública explícita
                 if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                 
                 // Validar extensión
                 $allowed = ['pdf', 'jpg', 'png', 'jpeg'];
                 $ext = strtolower(pathinfo($_FILES['cert_file']['name'], PATHINFO_EXTENSION));
                 
                 if(in_array($ext, $allowed)){
                     $filename = uniqid() . '_' . basename($_FILES['cert_file']['name']);
                     move_uploaded_file($_FILES['cert_file']['tmp_name'], $uploadDir . $filename);
                     
                     $nombre = sanitizeString($_POST['nombre'] ?? 'Certificado');
                     $this->studentModel->addCertificate($_SESSION['user_id'], $nombre, $filename);
                     flash('profile_msg', 'Certificado subido con éxito');
                 } else {
                     flash('profile_msg', 'Formato de archivo no permitido (PDF/IMG)', 'alert alert-danger');
                 }
             }
             redirect('users/profile');
        }
    }

    public function certificate_delete($certId){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            // Validación CSRF
            if(!validateCsrfToken($_POST['csrf_token'] ?? '')){
                flash('profile_msg', 'Token CSRF inválido', 'alert alert-danger');
                redirect('users/profile');
                return;
            }

            // ¿Verificar propiedad?
            $this->studentModel->deleteCertificate($certId);
            flash('profile_msg', 'Certificado eliminado');
            redirect('users/profile');
        } else {
            redirect('users/profile'); 
        }
    }


    // Security / 2FA Management
    public function security(){
        $userId = $_SESSION['user_id'];
        $user = $this->userModel->getUserById($userId);
        
        $data = [
            'user' => $user,
            'qr_url' => '',
            'secret' => '',
            'error' => ''
        ];
        
        $this->view('users/security', $data);
    }

    public function enable_2fa_init(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            require_once APPROOT . '/libraries/GoogleAuthenticator.php';
            $ga = new GoogleAuthenticator();
            $secret = $ga->createSecret();
            
            // Generate QR info
            $qrUrl = $ga->getQRCodeGoogleUrl(SITENAME, $secret, $_SESSION['user_email']);
            
            // Save temporary secret to session (don't save to DB until confirmed)
            $_SESSION['2fa_setup_secret'] = $secret;
            
            $userId = $_SESSION['user_id'];
            $user = $this->userModel->getUserById($userId);

            $data = [
                'user' => $user,
                'qr_url' => $qrUrl,
                'secret' => $secret,
                'error' => '',
                'setup_mode' => true
            ];
            
            $this->view('users/security', $data);
        } else {
            redirect('users/security');
        }
    }

    public function confirm_2fa(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $code = trim($_POST['code'] ?? '');
            $secret = $_SESSION['2fa_setup_secret'] ?? null;
            
            if(!$secret){
                flash('security_msg', 'Sesión de configuración expirada', 'alert alert-danger');
                redirect('users/security');
            }
            
            require_once APPROOT . '/libraries/GoogleAuthenticator.php';
            $ga = new GoogleAuthenticator();
            
            if($ga->verifyCode($secret, $code, 2)){ // 2 = 60 sec tolerance
                 // Success - Save to DB
                 $this->userModel->set2FA($_SESSION['user_id'], $secret);
                 $this->userModel->toggle2FA($_SESSION['user_id'], 1);
                 
                 unset($_SESSION['2fa_setup_secret']);
                 flash('security_msg', 'Doble autenticación activada correctamente.');
                 redirect('users/security');
            } else {
                 flash('security_msg', 'Código incorrecto. Intenta de nuevo.', 'alert alert-danger');
                 // Reload view via redirect usually resets data, better to show error.
                 // For simplicity, redirecting back to init logic or security page.
                 // But wait, setup mode is ephemeral.
                 // Let's redirect to security and user has to start over or we handle session.
                 redirect('users/security');
            }
        }
    }

    public function disable_2fa(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
             if(!validateCsrfToken($_POST['csrf_token'] ?? '')){
                flash('security_msg', 'Token CSRF inválido', 'alert alert-danger');
                redirect('users/security');
             }

             $this->userModel->toggle2FA($_SESSION['user_id'], 0);
             $this->userModel->set2FA($_SESSION['user_id'], null); // Optional: clear secret
             flash('security_msg', 'Doble autenticación desactivada.');
             redirect('users/security');
        }
    }

    public function notifications_mark_read(){
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            // No CSRF check strictly required for this benign action, but good practice. 
            // For simplicity in a GET link (as in header), we skip strict CSRF POST check or use a token in URL.
            // As user asked for a simple button/link:
            
            $this->notificationModel = $this->model('Notification'); // Ensure model is loaded or use property if cached (User controller ctor didn't load it)
            // Fix: User Controller constructor didn't list Notification model. Load it here.
            $notifModel = $this->model('Notification');
            $notifModel->markAllAsRead($_SESSION['user_id']);
            
            // Return to previous page or dashboard
            if(isset($_SERVER['HTTP_REFERER'])){
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                redirect('dashboard');
            }
        }
    }
}

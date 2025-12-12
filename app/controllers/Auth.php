<?php
class Auth extends Controller {
    public function __construct(){
        $this->userModel = $this->model('User');
    }

    public function register(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'nombre' => trim($_POST['nombre']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'role_id' => trim($_POST['role_id']),
                'nombre_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Validar Email
            if(empty($data['email'])){
                $data['email_err'] = 'Por favor ingrese su email';
            } else {
                // Check email
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err'] = 'El email ya está registrado';
                }
            }

            // Validar Nombre
            if(empty($data['nombre'])){
                $data['nombre_err'] = 'Por favor ingrese su nombre';
            }

            // Validar Password
            if(empty($data['password'])){
                $data['password_err'] = 'Por favor ingrese una contraseña';
            } elseif(strlen($data['password']) < 6){
                $data['password_err'] = 'La contraseña debe tener al menos 6 caracteres';
            }

            // Validar Confirmar Password
            if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'Por favor confirme la contraseña';
            } else {
                if($data['password'] != $data['confirm_password']){
                    $data['confirm_password_err'] = 'Las contraseñas no coinciden';
                }
            }

            // Make sure errors are empty
            if(empty($data['email_err']) && empty($data['nombre_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
                // Validated
                
                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register User
                if($this->userModel->register($data)){
                    flash('register_success', 'Estás registrado y puedes iniciar sesión');
                    header('location: ' . URLROOT . '/auth/login');
                } else {
                    die('Algo salió mal');
                }

            } else {
                // Load view with errors
                $this->view('auth/register', $data);
            }

        } else {
            // Init data
            $data = [
                'nombre' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'role_id' => '',
                'nombre_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Load view
            $this->view('auth/register', $data);
        }
    }

    public function login(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',      
            ];

            // Validar Email
            if(empty($data['email'])){
                $data['email_err'] = 'Por favor ingrese su email';
            }

            // Validar Password
            if(empty($data['password'])){
                $data['password_err'] = 'Por favor ingrese su contraseña';
            }

            // Check for user/email
            if($this->userModel->findUserByEmail($data['email'])){
                // User found
            } else {
                $data['email_err'] = 'Usuario no encontrado';
            }

            // Make sure errors are empty
            if(empty($data['email_err']) && empty($data['password_err'])){
                // Validated
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if($loggedInUser){
                    // Create Session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Contraseña incorrecta';
                    $this->view('auth/login', $data);
                }
            } else {
                // Load view with errors
                $this->view('auth/login', $data);
            }

        } else {
            // Init data
            $data = [    
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',        
            ];

            // Load view
            $this->view('auth/login', $data);
        }
    }

    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->nombre;
        $_SESSION['user_role'] = $user->role_id;
        $_SESSION['user_foto'] = $user->foto_perfil;
        $_SESSION['user_empresa'] = $user->empresa_id;
        $_SESSION['user_institucion'] = isset($user->institucion_id) ? $user->institucion_id : null;
        
        // Redireccionar al Dashboard correspondiente según Rol
        header('location: ' . URLROOT . '/dashboard');
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_role']);
        session_destroy();
        header('location: ' . URLROOT . '/auth/login');
    }
}

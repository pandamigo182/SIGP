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
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'id' => $userId,
                'nombre' => trim($_POST['nombre']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'role_id' => $user->role_id,
                'foto_perfil' => $user->foto_perfil,
                
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
                
                'nombre_err' => '',
                'email_err' => '',
                'password_err' => ''
            ];

             // Handle Avatar Upload
             if(!empty($_FILES['foto']['name'])){
                $imgName = $_FILES['foto']['name'];
                $imgSize = $_FILES['foto']['size'];
                $tmpName = $_FILES['foto']['tmp_name'];
                
                $imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
                $validExt = ['jpg', 'jpeg', 'png'];

                if(in_array($imgExt, $validExt) && $imgSize < 5000000){
                    $newName = uniqid() . '_avatar.' . $imgExt;
                    $uploadDir = 'uploads/avatars/';
                    if(!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                    
                    move_uploaded_file($tmpName, $uploadDir . $newName);
                    $data['foto_perfil'] = $newName;
                }
            }

            if(empty($data['nombre'])){ $data['nombre_err'] = 'Ingrese nombre'; }
            
            // Password logic
            if(!empty($data['password'])){
                 if(strlen($data['password']) < 6){
                     $data['password_err'] = 'Mínimo 6 caracteres';
                 } 
                 // Model handles hashing
            }

            if(empty($data['nombre_err']) && empty($data['password_err'])){
                 // Update Main User
                 if($this->userModel->updateProfile($data)){
                     $_SESSION['user_name'] = $data['nombre'];
                     if($data['foto_perfil']){ $_SESSION['user_foto'] = $data['foto_perfil']; }

                     // Update Student Profile
                     if($user->role_id == 5){
                         $this->studentModel->updateProfile($userId, $data);
                         $this->studentModel->syncSkills($userId, $data['habilidades']);
                         
                         // CV Upload
                         if(isset($_FILES['cv_file']) && $_FILES['cv_file']['error'] === UPLOAD_ERR_OK){
                             $uploadDir = 'uploads/cvs/';
                             if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                             $filename = uniqid() . '_' . basename($_FILES['cv_file']['name']);
                             move_uploaded_file($_FILES['cv_file']['tmp_name'], $uploadDir . $filename);
                             $this->studentModel->updateCV($userId, $filename);
                         }
                     }

                     flash('profile_msg', 'Perfil actualizado correctamente');
                     redirect('users/profile');
                 } else {
                     die('Error al actualizar');
                 }
            } else {
                // Return errors (Need to fill lists again)
                 $data['carreras'] = $carreras;
                 $data['skills_list'] = $habilidades;
                 $this->view('users/profile', $data);
            }

        } else {
            // Get Student Data
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
                'password_err' => ''
            ];
            $this->view('users/profile', $data);
        }
    }
    
    // Sub-Entities (Experience/Certs)
    public function experience_add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'usuario_id' => $_SESSION['user_id'],
                'empresa' => trim($_POST['empresa']),
                'cargo' => trim($_POST['cargo']),
                'fecha_inicio' => trim($_POST['fecha_inicio']),
                'fecha_fin' => trim($_POST['fecha_fin']),
                'descripcion' => trim($_POST['descripcion'])
            ];
            $this->studentModel->addExperience($data);
            redirect('users/profile');
        }
    }

    public function experience_delete($expId){
         // Verify ownership? Ideally yes.
         $this->studentModel->deleteExperience($expId);
         redirect('users/profile');
    }

    public function certificate_add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
             if(isset($_FILES['cert_file']) && $_FILES['cert_file']['error'] === UPLOAD_ERR_OK){
                 $uploadDir = 'uploads/certificates/';
                 if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                 $filename = uniqid() . '_' . basename($_FILES['cert_file']['name']);
                 move_uploaded_file($_FILES['cert_file']['tmp_name'], $uploadDir . $filename);
                 
                 $name = trim($_POST['nombre']);
                 $this->studentModel->addCertificate($_SESSION['user_id'], $name, $filename);
             }
             redirect('users/profile');
        }
    }

    public function certificate_delete($certId){
        // Verify ownership?
        $this->studentModel->deleteCertificate($certId);
        redirect('users/profile');
    }
}

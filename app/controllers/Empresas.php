<?php
class Empresas extends Controller {
    public function __construct(){
        $this->empresaModel = $this->model('Empresa');
        $this->userModel = $this->model('User');
    }

    // Default method - List or Redirect
    public function index(){
        redirect('dashboard');
    }

    // Public Profile
    public function profile($id = null){
        // If no ID provided, try to load own profile (for Company User)
        if($id == null){
            if(!isLoggedIn() || $_SESSION['user_role'] != 4){
                redirect('dashboard');
            }
            if(!empty($_SESSION['user_empresa'])){
                $id = $_SESSION['user_empresa'];
            } else {
                // If company user has no profile yet
                 $data = [
                    'nombre' => '',
                    'descripcion' => '',
                    'direccion' => '',
                    'telefono' => '',
                    'website' => '',
                    'latitud' => '',
                    'longitud' => '',
                    'nombre_err' => '',
                    'descripcion_err' => ''
                ];
                $this->view('empresas/create', $data);
                return;
            }
        }

        $empresa = $this->empresaModel->getEmpresaById($id);
        
        if(!$empresa){
            flash('date_msg', 'Empresa no encontrada', 'alert alert-danger');
            redirect('dashboard');
        }

        $data = [
            'empresa' => $empresa
        ];

        $this->view('empresas/profile', $data);
    }

    // Edit Profile (Company User)
    public function edit(){
        if(!isLoggedIn() || $_SESSION['user_role'] != 4){
            redirect('dashboard');
        }

        // Get current company
        $empresaId = $_SESSION['user_empresa'];
        
        // If not exists, should go to create first (handled in profile/create flow, but here we assume exists or we create)
        // Let's make 'edit' handle both for simplicity if ID is missing? No, stricter.
        
        if($empresaId == null){
             // Create mode
             $this->create();
             return;
        }

        $empresa = $this->empresaModel->getEmpresaById($empresaId);

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $empresaId,
                'nombre' => trim($_POST['nombre']),
                'descripcion' => trim($_POST['descripcion']),
                'direccion' => trim($_POST['direccion']),
                'telefono' => trim($_POST['telefono']),
                'website' => trim($_POST['website']),
                'latitud' => trim($_POST['latitud']),
                'longitud' => trim($_POST['longitud']),
                'logo' => $empresa->logo,
                'nombre_err' => '',
                'descripcion_err' => ''
            ];

             // Handle Logo Upload
             if(!empty($_FILES['logo']['name'])){
                $imgName = $_FILES['logo']['name'];
                $imgSize = $_FILES['logo']['size'];
                $tmpName = $_FILES['logo']['tmp_name'];
                
                $imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
                $validExt = ['jpg', 'jpeg', 'png'];

                if(in_array($imgExt, $validExt)){
                    if($imgSize < 5000000){
                        $newName = uniqid() . '.' . $imgExt;
                        $uploadDir = 'public/uploads/logos/';
                        if(!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                        
                        move_uploaded_file($tmpName, $uploadDir . $newName);
                        $data['logo'] = $newName;
                    } 
                }
            }

            if(empty($data['nombre'])){ $data['nombre_err'] = 'Ingrese nombre de la empresa'; }
            if(empty($data['descripcion'])){ $data['descripcion_err'] = 'Ingrese una descripción'; }

            if(empty($data['nombre_err']) && empty($data['descripcion_err'])){
                if($this->empresaModel->updateEmpresa($data)){
                    flash('profile_msg', 'Perfil de empresa actualizado');
                    redirect('empresas/profile');
                } else {
                    die('Error al actualizar');
                }
            } else {
                $this->view('empresas/edit', $data);
            }

        } else {
            $data = [
                'id' => $empresa->id,
                'nombre' => $empresa->nombre,
                'descripcion' => $empresa->descripcion,
                'direccion' => $empresa->direccion,
                'telefono' => $empresa->telefono,
                'website' => $empresa->website,
                'latitud' => $empresa->latitud,
                'longitud' => $empresa->longitud,
                'logo' => $empresa->logo,
                'nombre_err' => '',
                'descripcion_err' => ''
            ];
            $this->view('empresas/edit', $data);
        }
    }

    public function create(){
         if(!isLoggedIn() || $_SESSION['user_role'] != 4){ redirect('dashboard'); }
         
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'nombre' => trim($_POST['nombre']),
                'descripcion' => trim($_POST['descripcion']),
                'direccion' => trim($_POST['direccion']),
                'telefono' => trim($_POST['telefono']),
                'website' => trim($_POST['website']),
                'latitud' => trim($_POST['latitud']),
                'longitud' => trim($_POST['longitud']),
                'logo' => 'default_logo.png',
                'nombre_err' => '',
                'descripcion_err' => ''
            ];

             // Handle Logo Upload
             if(!empty($_FILES['logo']['name'])){
                $imgName = $_FILES['logo']['name'];
                $tmpName = $_FILES['logo']['tmp_name'];
                $imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
                $validExt = ['jpg', 'jpeg', 'png'];
                if(in_array($imgExt, $validExt)){
                        $newName = uniqid() . '.' . $imgExt;
                        $uploadDir = 'public/uploads/logos/';
                        if(!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                        move_uploaded_file($tmpName, $uploadDir . $newName);
                        $data['logo'] = $newName;
                }
            }

            if(empty($data['nombre'])){ $data['nombre_err'] = 'Ingrese nombre'; }

            if(empty($data['nombre_err'])){
                $newId = $this->empresaModel->addEmpresa($data);
                if($newId){
                    // Update User to link to this company
                    // Note: accessing DB directly or adding method in User model would be better.
                    // But for now, we assume we need to update session as well.
                    // We need a method in User model to setEmpresaId
                    $this->userModel->setEmpresaId($_SESSION['user_id'], $newId);
                    
                    $_SESSION['user_empresa'] = $newId; // Update session
                    flash('profile_msg', 'Empresa creada correctamente');
                    redirect('empresas/profile');
                } else {
                    die('Error al crear');
                }
            } else {
                $this->view('empresas/create', $data);
            }

         } else {
             $data = [
                'nombre' => '',
                'descripcion' => '',
                'direccion' => '',
                'telefono' => '',
                'website' => '',
                'latitud' => '',
                'longitud' => '',
                'nombre_err' => '',
                'descripcion_err' => ''
            ];
            $this->view('empresas/create', $data);
         }
    }
}

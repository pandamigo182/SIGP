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
            
            // CSRF Validation
            if(!validateCsrfToken($_POST['csrf_token'] ?? '')){
                 flash('profile_msg', 'Token seguridad inválido', 'alert alert-danger');
                 redirect('empresas/edit');
                 return;
            }

            // Modern Sanitization
            $data = [
                'id' => $empresaId,
                'nombre' => sanitizeString($_POST['nombre'] ?? ''),
                'descripcion' => sanitizeString($_POST['descripcion'] ?? ''),
                'direccion' => sanitizeString($_POST['direccion'] ?? ''),
                'telefono' => sanitizeString($_POST['telefono'] ?? ''),
                'website' => sanitizeString($_POST['website'] ?? ''), // Could use validateUrl too
                'latitud' => trim($_POST['latitud'] ?? ''),
                'longitud' => trim($_POST['longitud'] ?? ''),
                'logo' => $empresa->logo,
                'nit' => sanitizeString($_POST['nit'] ?? ''),
                'nombre_err' => '',
                'descripcion_err' => '',
                'nit_err' => ''
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
            
            // Validar NIT
            if(!empty($data['nit'])){
                if(!preg_match('/^\d{4}-\d{6}-\d{3}-\d{1}$/', $data['nit'])){
                    $data['nit_err'] = 'Formato NIT inválido (0000-000000-000-0)';
                }
            }

            if(empty($data['nombre_err']) && empty($data['descripcion_err']) && empty($data['nit_err'])){
                if($this->empresaModel->updateEmpresa($data)){
                    flash('profile_msg', 'Perfil de empresa actualizado');
                    redirect('empresas/profile');
                } else {
                    notify_admins('Error al actualizar empresa ID: ' . $empresaId);
                    flash('fatal_error', 'Error crítico al actualizar la empresa.');
                    redirect('empresas/edit');
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
                'nit' => $empresa->nit,
                'nombre_err' => '',
                'descripcion_err' => '',
                'nit_err' => ''
            ];
            $this->view('empresas/edit', $data);
        }
    }

    public function create(){
         if(!isLoggedIn() || $_SESSION['user_role'] != 4){ redirect('dashboard'); }
         
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            // CSRF Validation
            if(!validateCsrfToken($_POST['csrf_token'] ?? '')){
                 flash('profile_msg', 'Error de seguridad: Token inválido', 'alert alert-danger');
                 redirect('empresas/create'); // or dashboard
                 return;
            }

            // Modern Sanitization
            $data = [
                'nombre' => sanitizeString($_POST['nombre'] ?? ''),
                'descripcion' => sanitizeString($_POST['descripcion'] ?? ''),
                'direccion' => sanitizeString($_POST['direccion'] ?? ''),
                'telefono' => sanitizeString($_POST['telefono'] ?? ''),
                'website' => sanitizeString($_POST['website'] ?? ''),
                'latitud' => trim($_POST['latitud'] ?? ''),
                'longitud' => trim($_POST['longitud'] ?? ''),
                'logo' => 'default_logo.png',
                'nit' => sanitizeString($_POST['nit'] ?? ''),
                'nombre_err' => '',
                'descripcion_err' => '',
                'nit_err' => ''
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
            
            // Validar NIT
            if(!empty($data['nit'])){
                if(!preg_match('/^\d{4}-\d{6}-\d{3}-\d{1}$/', $data['nit'])){
                     $data['nit_err'] = 'Formato NIT inválido (0000-000000-000-0)';
                }
            }

            if(empty($data['nombre_err']) && empty($data['nit_err'])){
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
                    notify_admins('Error al crear empresa');
                    flash('fatal_error', 'Error crítico al crear la empresa.');
                    redirect('empresas/create');
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
                'nit' => '',
                'nombre_err' => '',
                'descripcion_err' => '',
                'nit_err' => ''
            ];
            $this->view('empresas/create', $data);
         }
    }
}

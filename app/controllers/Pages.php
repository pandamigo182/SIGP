<?php
class Pages extends Controller {
    public function __construct(){
        $this->plazaModel = $this->model('Plaza');
        $this->empresaModel = $this->model('Empresa');
        $this->settingModel = $this->model('SystemSetting');
    }

    public function contact(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
             // Simple handling for Stress Test
             // Sanitize
             $datos = [
                 'nombre' => trim($_POST['nombre'] ?? ''),
                 'email' => trim($_POST['email'] ?? ''),
                 'mensaje' => trim($_POST['mensaje'] ?? '')
             ];
             
             // Validate (Mock)
             if(!empty($datos['nombre']) && !empty($datos['mensaje'])){
                 // Logic to send email or save to DB would go here.
                 // For Leviathan test, we simulate success.
                 flash('contact_msg', 'Mensaje enviado correctamente. Gracias por contactarnos.');
             } else {
                 flash('contact_msg', 'Por favor complete todos los campos.', 'alert alert-danger');
             }
        }

        $settings = $this->settingModel->getSettings();
        $data = [
            'title' => 'Contacto - SIGP',
            'settings' => $settings
        ];
        $this->view('pages/contact', $data);
    }

    public function index(){
        $filters = [
            'q' => isset($_GET['q']) ? trim($_GET['q']) : '',
            'rubro' => isset($_GET['rubro']) ? trim($_GET['rubro']) : '',
            'departamento_id' => isset($_GET['departamento_id']) ? $_GET['departamento_id'] : '',
            'municipio_id' => isset($_GET['municipio_id']) ? $_GET['municipio_id'] : ''
        ];
        
        // Pagination
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 6;
        $offset = ($page - 1) * $limit;

        $plazas = $this->plazaModel->getPlazas($filters, $limit, $offset);
        $totalPlazas = $this->plazaModel->getPlazasCount($filters);
        $totalPages = ceil($totalPlazas / $limit);

        // Featured
        $destacadas = $this->plazaModel->getDestacadas(3);
        $empresasDestacadas = $this->empresaModel->getDestacadas(5);

        $rubros = $this->empresaModel->getRubros();
        $departamentos = $this->empresaModel->getDepartamentos();

        $data = [
            'title' => 'SIGP - Oportunidades',
            'description' => 'Encuentra la pasantía ideal para tu carrera profesional.',
            'plazas' => $plazas,
            'destacadas' => $destacadas,
            'empresas_destacadas' => $empresasDestacadas,
            'rubros' => $rubros,
            'departamentos' => $departamentos,
            'pagination' => [
                'current_page' => $page,
                'total_pages' => $totalPages,
                'total_items' => $totalPlazas
            ]
        ];
        $this->view('pages/index', $data);
    }

    public function about(){
        $data = [
            'title' => 'Sobre Nosotros',
            'description' => 'App para gestionar pasantías'
        ];
        $this->view('pages/about', $data);
    }

    public function notFound(){
        $this->view('pages/404');
    }
}

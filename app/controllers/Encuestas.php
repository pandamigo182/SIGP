<?php
class Encuestas extends Controller {
    public function __construct(){
        if(!isLoggedIn()){
            redirect('auth/login');
        }
        $this->encuestaModel = $this->model('Encuesta');
    }

    public function index(){
        $data = [
            'titulo' => 'Encuesta de Satisfacción del Cliente (ISO 9001)',
            'descripcion' => 'Tu opinión nos ayuda a cumplir con los estándares de calidad.'
        ];
        $this->view('encuestas/encuesta', $data);
    }

    public function enviar(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            // Sanitizar POST
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Determinar tipo de usuario basado en rol
            $tipoUsuario = 'estudiante'; // default
            if($_SESSION['user_role'] == 2) $tipoUsuario = 'empresa';

            $data = [
                'usuario_id' => $_SESSION['user_id'],
                'tipo_usuario' => $tipoUsuario,
                'nivel_satisfaccion' => trim($_POST['nivel_satisfaccion']),
                'facilidad_uso' => trim($_POST['facilidad_uso']),
                'calidad_soporte' => trim($_POST['calidad_soporte']),
                'comentarios' => trim($_POST['comentarios'])
            ];

            // Validar que no esten vacios (excepto comentarios)
            if(empty($data['nivel_satisfaccion']) || empty($data['facilidad_uso']) || empty($data['calidad_soporte'])){
                 die('Por favor complete todos los campos obligatorios.');
            }

            if($this->encuestaModel->agregarEncuesta($data)){
                // Redirigir con mensaje de exito (usando session helper si existe o parametro GET)
                // Asumiendo que existe flash o redireccion simple
                redirect('dashboard?msg=encuesta_enviada');
            } else {
                die('Algo salió mal. Intente de nuevo.');
            }

        } else {
            redirect('encuestas');
        }
    }
}

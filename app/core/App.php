<?php
/*
 *  Clase App Principal
 *  Crea URLs del tipo /controlador/metodo/parametros
 */
class App {
    protected $currentController = 'Pages'; // Controlador por defecto
    protected $currentMethod = 'index';     // Método por defecto
    protected $params = [];

    public function __construct(){
        $url = $this->getUrl();

        // 1. Buscar Controlador
        if(isset($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }
        
        // Requerir el controlador
        require_once '../app/controllers/' . $this->currentController . '.php';
        
        // Instanciar la clase controlador
        $this->currentController = new $this->currentController;

        // 2. Buscar Método
        if(isset($url[1])){
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        // 3. Obtener Parámetros
        $this->params = $url ? array_values($url) : [];

        // Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        return [];
    }
}

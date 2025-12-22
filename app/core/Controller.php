<?php
/*
 *  Controlador Principal Base
 *  Carga Modelos y Vistas
 */
class Controller {
    // Cargar Modelo
    public function model($model){
        // Requerir archivo de modelo
        if(file_exists('../app/models/' . $model . '.php')){
            require_once '../app/models/' . $model . '.php';
            // Instanciar modelo
            return new $model();
        } else {
            die("El modelo no existe.");
        }
    }

    // Cargar Vista
    public function view($view, $data = []){
        // Chequear si el archivo vista existe
        if(file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        } else {
            // Si no existe tal vista
            die("La vista no existe.");
        }
    }

    // Método seguro para validar CSRF y POST
    protected function verifyCsrf(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(!validateCsrfToken($_POST['csrf_token'] ?? '')){
                die('Error de seguridad: Token CSRF inválido.');
            }
        }
    }
}

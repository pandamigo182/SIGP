<?php
class Pages extends Controller {
    public function __construct(){
        $this->plazaModel = $this->model('Plaza');
    }

    public function index(){
        $plazas = $this->plazaModel->getPlazas();

        $data = [
            'title' => 'SIGP - Oportunidades',
            'description' => 'Encuentra la pasantía ideal para tu carrera profesional.',
            'plazas' => $plazas
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
}

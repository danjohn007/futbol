<?php
/**
 * Controlador de la página principal
 */
class HomeController extends Controller {
    
    public function index() {
        $torneoModel = $this->model('Torneo');
        $partidoModel = $this->model('Partido');
        $configuracionModel = $this->model('Configuracion');
        
        $data = [
            'title' => 'Inicio',
            'torneos' => $torneoModel->getPublicosActivos(),
            'proximos_partidos' => $partidoModel->getProximos(5),
            'config' => $configuracionModel->getAllGrouped()
        ];
        
        $this->view('layouts/header', $data);
        $this->view('public/home', $data);
        $this->view('layouts/footer');
    }
}

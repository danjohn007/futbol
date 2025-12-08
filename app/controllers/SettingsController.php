<?php
/**
 * Controlador de Configuración del Sistema
 */
class SettingsController extends Controller {
    
    public function index() {
        $this->checkRole(['SUPERADMIN']);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $configuracionModel = $this->model('Configuracion');
            
            // Actualizar todas las configuraciones
            foreach ($_POST as $key => $value) {
                if ($key !== 'submit') {
                    $configuracionModel->setValue($key, $value);
                }
            }
            
            $this->setFlash('success', 'Configuración actualizada exitosamente');
            $this->redirect('settings');
        }
        
        $configuracionModel = $this->model('Configuracion');
        $config = $configuracionModel->getAllGrouped();
        
        $data = [
            'title' => 'Configuración del Sistema',
            'user' => $this->getCurrentUser(),
            'config' => $config,
            'flash' => $this->getFlash()
        ];
        
        $this->view('layouts/header', $data);
        $this->view('layouts/sidebar', $data);
        $this->view('settings/index', $data);
        $this->view('layouts/footer');
    }
}

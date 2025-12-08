<?php
/**
 * Controlador del Dashboard
 */
class DashboardController extends Controller {
    
    public function index() {
        $this->checkRole();
        
        $user = $this->getCurrentUser();
        $configuracionModel = $this->model('Configuracion');
        
        // Obtener estadísticas según el rol
        $stats = $this->getStatsByRole($user);
        
        $data = [
            'title' => 'Dashboard',
            'user' => $user,
            'stats' => $stats,
            'flash' => $this->getFlash(),
            'config' => $configuracionModel->getAllGrouped()
        ];
        
        $this->view('layouts/header', $data);
        $this->view('layouts/sidebar', $data);
        $this->view('dashboard/index', $data);
        $this->view('layouts/footer');
    }
    
    private function getStatsByRole($user) {
        $stats = [];
        
        switch ($user['rol_nombre']) {
            case 'SUPERADMIN':
                $torneoModel = $this->model('Torneo');
                $equipoModel = $this->model('Equipo');
                $sedeModel = $this->model('Sede');
                $userModel = $this->model('Usuario');
                
                $stats['torneos'] = $torneoModel->count();
                $stats['equipos'] = $equipoModel->count();
                $stats['sedes'] = $sedeModel->count();
                $stats['usuarios'] = $userModel->count();
                break;
                
            case 'ORGANIZADOR':
                $torneoModel = $this->model('Torneo');
                $stats['torneos'] = $torneoModel->count(['organizador_id' => $user['id']]);
                break;
                
            case 'DELEGADO':
                $equipoModel = $this->model('Equipo');
                $stats['equipos'] = $equipoModel->count(['delegado_id' => $user['id']]);
                break;
        }
        
        return $stats;
    }
}

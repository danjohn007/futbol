<?php
/**
 * Controlador de Equipos
 */
class EquiposController extends Controller {
    
    public function index() {
        $this->checkRole();
        
        $equipoModel = $this->model('Equipo');
        $user = $this->getCurrentUser();
        
        // Si es delegado, solo ver sus equipos
        if ($user['rol_nombre'] === 'DELEGADO') {
            $equipos = $equipoModel->getByDelegado($user['id']);
        } else {
            $equipos = $equipoModel->query(
                "SELECT e.*, u.nombre as delegado_nombre, u.email as delegado_email
                FROM equipos e
                INNER JOIN usuarios u ON e.delegado_id = u.id
                ORDER BY e.nombre ASC"
            );
        }
        
        $data = [
            'title' => 'Equipos',
            'user' => $user,
            'equipos' => $equipos,
            'flash' => $this->getFlash()
        ];
        
        $this->view('layouts/header', $data);
        $this->view('layouts/sidebar', $data);
        $this->view('equipos/index', $data);
        $this->view('layouts/footer');
    }
    
    public function detalle($id) {
        $equipoModel = $this->model('Equipo');
        $equipo = $equipoModel->getConDelegado($id);
        
        if (!$equipo) {
            $this->setFlash('error', 'Equipo no encontrado');
            $this->redirect('equipos');
        }
        
        $plantilla = $equipoModel->getPlantilla($id);
        
        $data = [
            'title' => $equipo['nombre'],
            'user' => $this->getCurrentUser(),
            'equipo' => $equipo,
            'plantilla' => $plantilla
        ];
        
        $this->view('layouts/header', $data);
        $this->view('layouts/sidebar', $data);
        $this->view('equipos/view', $data);
        $this->view('layouts/footer');
    }
}

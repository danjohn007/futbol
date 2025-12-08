<?php
/**
 * Controlador de Usuarios (solo SUPERADMIN)
 */
class UsuariosController extends Controller {
    
    public function index() {
        $this->checkRole(['SUPERADMIN']);
        
        $usuarioModel = $this->model('Usuario');
        
        $usuarios = $usuarioModel->query(
            "SELECT u.*, r.nombre as rol_nombre
            FROM usuarios u
            INNER JOIN roles r ON u.rol_id = r.id
            ORDER BY u.created_at DESC"
        );
        
        $data = [
            'title' => 'Usuarios',
            'user' => $this->getCurrentUser(),
            'usuarios' => $usuarios,
            'flash' => $this->getFlash()
        ];
        
        $this->view('layouts/header', $data);
        $this->view('layouts/sidebar', $data);
        $this->view('usuarios/index', $data);
        $this->view('layouts/footer');
    }
}

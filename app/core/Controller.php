<?php
/**
 * Controlador base para todos los controladores
 */
class Controller {
    
    /**
     * Cargar una vista
     */
    protected function view($view, $data = []) {
        extract($data);
        
        $viewFile = APP_PATH . '/views/' . $view . '.php';
        
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("Vista no encontrada: $view");
        }
    }
    
    /**
     * Cargar un modelo
     */
    protected function model($model) {
        $modelFile = APP_PATH . '/models/' . $model . '.php';
        
        if (file_exists($modelFile)) {
            require_once $modelFile;
            return new $model();
        } else {
            die("Modelo no encontrado: $model");
        }
    }
    
    /**
     * Redireccionar a una URL
     */
    protected function redirect($url) {
        header('Location: ' . BASE_URL . '/' . ltrim($url, '/'));
        exit;
    }
    
    /**
     * Verificar si el usuario está autenticado
     */
    protected function isAuthenticated() {
        return isset($_SESSION['user_id']);
    }
    
    /**
     * Obtener datos del usuario actual
     */
    protected function getCurrentUser() {
        if (!$this->isAuthenticated()) {
            return null;
        }
        
        if (!isset($_SESSION['user_data'])) {
            $userModel = $this->model('Usuario');
            $_SESSION['user_data'] = $userModel->findById($_SESSION['user_id']);
        }
        
        return $_SESSION['user_data'];
    }
    
    /**
     * Verificar permisos por rol
     */
    protected function checkRole($allowedRoles = []) {
        if (!$this->isAuthenticated()) {
            $this->redirect('auth/login');
            return false;
        }
        
        $user = $this->getCurrentUser();
        
        if (!empty($allowedRoles) && !in_array($user['rol_nombre'], $allowedRoles)) {
            $this->redirect('dashboard');
            return false;
        }
        
        return true;
    }
    
    /**
     * Respuesta JSON
     */
    protected function json($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    
    /**
     * Obtener mensaje flash
     */
    protected function setFlash($type, $message) {
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message
        ];
    }
    
    /**
     * Obtener y limpiar mensaje flash
     */
    protected function getFlash() {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }
}

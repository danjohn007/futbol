<?php
/**
 * Controlador de Autenticación
 */
class AuthController extends Controller {
    
    public function login() {
        // Si ya está autenticado, redirigir al dashboard
        if ($this->isAuthenticated()) {
            $this->redirect('dashboard');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            
            if (empty($email) || empty($password)) {
                $error = 'Por favor complete todos los campos';
            } else {
                $userModel = $this->model('Usuario');
                $user = $userModel->authenticate($email, $password);
                
                if ($user) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['nombre'];
                    $_SESSION['user_role'] = $user['rol_nombre'];
                    $_SESSION['user_email'] = $user['email'];
                    
                    $this->setFlash('success', 'Bienvenido ' . $user['nombre']);
                    $this->redirect('dashboard');
                } else {
                    $error = 'Credenciales incorrectas';
                }
            }
        }
        
        $data = [
            'title' => 'Iniciar Sesión',
            'error' => $error ?? null
        ];
        
        $this->view('layouts/header', $data);
        $this->view('auth/login', $data);
        $this->view('layouts/footer');
    }
    
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $apellidos = $_POST['apellidos'] ?? '';
            $email = $_POST['email'] ?? '';
            $telefono = $_POST['telefono'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';
            
            $errors = [];
            
            if (empty($nombre)) $errors[] = 'El nombre es requerido';
            if (empty($email)) $errors[] = 'El email es requerido';
            if (empty($password)) $errors[] = 'La contraseña es requerida';
            if ($password !== $confirm_password) $errors[] = 'Las contraseñas no coinciden';
            if (strlen($password) < 6) $errors[] = 'La contraseña debe tener al menos 6 caracteres';
            
            $userModel = $this->model('Usuario');
            
            if ($userModel->emailExists($email)) {
                $errors[] = 'El email ya está registrado';
            }
            
            if (empty($errors)) {
                // Registrar como AFICIONADO por defecto (rol_id = 7)
                $userId = $userModel->register([
                    'nombre' => $nombre,
                    'apellidos' => $apellidos,
                    'email' => $email,
                    'telefono' => $telefono,
                    'password' => $password,
                    'rol_id' => 7
                ]);
                
                if ($userId) {
                    $this->setFlash('success', 'Registro exitoso. Por favor inicia sesión.');
                    $this->redirect('auth/login');
                } else {
                    $errors[] = 'Error al registrar usuario';
                }
            }
        }
        
        $data = [
            'title' => 'Registrarse',
            'errors' => $errors ?? []
        ];
        
        $this->view('layouts/header', $data);
        $this->view('auth/register', $data);
        $this->view('layouts/footer');
    }
    
    public function logout() {
        session_destroy();
        $this->redirect('auth/login');
    }
}

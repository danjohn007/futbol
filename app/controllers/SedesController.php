<?php
/**
 * Controlador de Sedes
 */
class SedesController extends Controller {
    
    public function index() {
        $this->checkRole(['SUPERADMIN', 'ADMIN_SEDE']);
        
        $sedeModel = $this->model('Sede');
        $user = $this->getCurrentUser();
        
        // Si es admin de sede, solo ver sus sedes asignadas
        if ($user['rol_nombre'] === 'ADMIN_SEDE') {
            $sedes = $sedeModel->getByAdmin($user['id']);
        } else {
            $sedes = $sedeModel->all([], 'nombre ASC');
        }
        
        $data = [
            'title' => 'Sedes',
            'user' => $user,
            'sedes' => $sedes,
            'flash' => $this->getFlash()
        ];
        
        $this->view('layouts/header', $data);
        $this->view('layouts/sidebar', $data);
        $this->view('sedes/index', $data);
        $this->view('layouts/footer');
    }
    
    public function view($id) {
        $this->checkRole(['SUPERADMIN', 'ADMIN_SEDE']);
        
        $sedeModel = $this->model('Sede');
        $sede = $sedeModel->getWithCanchas($id);
        
        if (!$sede) {
            $this->setFlash('error', 'Sede no encontrada');
            $this->redirect('sedes');
        }
        
        $data = [
            'title' => 'Detalles de Sede',
            'user' => $this->getCurrentUser(),
            'sede' => $sede
        ];
        
        $this->view('layouts/header', $data);
        $this->view('layouts/sidebar', $data);
        $this->view('sedes/view', $data);
        $this->view('layouts/footer');
    }
    
    public function create() {
        $this->checkRole(['SUPERADMIN']);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'] ?? '',
                'direccion' => $_POST['direccion'] ?? '',
                'ciudad' => $_POST['ciudad'] ?? '',
                'estado' => $_POST['estado'] ?? '',
                'codigo_postal' => $_POST['codigo_postal'] ?? '',
                'telefono' => $_POST['telefono'] ?? '',
                'email' => $_POST['email'] ?? '',
                'latitud' => $_POST['latitud'] ?? null,
                'longitud' => $_POST['longitud'] ?? null,
                'activo' => 1
            ];
            
            $sedeModel = $this->model('Sede');
            $sedeId = $sedeModel->insert($data);
            
            if ($sedeId) {
                $this->setFlash('success', 'Sede creada exitosamente');
                $this->redirect('sedes');
            } else {
                $error = 'Error al crear la sede';
            }
        }
        
        $data = [
            'title' => 'Crear Sede',
            'user' => $this->getCurrentUser(),
            'error' => $error ?? null
        ];
        
        $this->view('layouts/header', $data);
        $this->view('layouts/sidebar', $data);
        $this->view('sedes/create', $data);
        $this->view('layouts/footer');
    }
    
    public function edit($id) {
        $this->checkRole(['SUPERADMIN']);
        
        $sedeModel = $this->model('Sede');
        $sede = $sedeModel->findById($id);
        
        if (!$sede) {
            $this->setFlash('error', 'Sede no encontrada');
            $this->redirect('sedes');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'] ?? '',
                'direccion' => $_POST['direccion'] ?? '',
                'ciudad' => $_POST['ciudad'] ?? '',
                'estado' => $_POST['estado'] ?? '',
                'codigo_postal' => $_POST['codigo_postal'] ?? '',
                'telefono' => $_POST['telefono'] ?? '',
                'email' => $_POST['email'] ?? '',
                'latitud' => $_POST['latitud'] ?? null,
                'longitud' => $_POST['longitud'] ?? null,
                'activo' => $_POST['activo'] ?? 1
            ];
            
            if ($sedeModel->update($id, $data)) {
                $this->setFlash('success', 'Sede actualizada exitosamente');
                $this->redirect('sedes');
            } else {
                $error = 'Error al actualizar la sede';
            }
        }
        
        $data = [
            'title' => 'Editar Sede',
            'user' => $this->getCurrentUser(),
            'sede' => $sede,
            'error' => $error ?? null
        ];
        
        $this->view('layouts/header', $data);
        $this->view('layouts/sidebar', $data);
        $this->view('sedes/edit', $data);
        $this->view('layouts/footer');
    }
    
    public function delete($id) {
        $this->checkRole(['SUPERADMIN']);
        
        $sedeModel = $this->model('Sede');
        
        if ($sedeModel->delete($id)) {
            $this->setFlash('success', 'Sede eliminada exitosamente');
        } else {
            $this->setFlash('error', 'Error al eliminar la sede');
        }
        
        $this->redirect('sedes');
    }
}

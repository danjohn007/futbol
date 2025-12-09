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
            'plantilla' => $plantilla,
            'flash' => $this->getFlash()
        ];
        
        $this->view('layouts/header', $data);
        $this->view('layouts/sidebar', $data);
        $this->view('equipos/view', $data);
        $this->view('layouts/footer');
    }
    
    public function editar($id) {
        $this->checkRole(['SUPERADMIN', 'DELEGADO']);
        
        $equipoModel = $this->model('Equipo');
        $equipo = $equipoModel->findById($id);
        
        if (!$equipo) {
            $this->setFlash('error', 'Equipo no encontrado');
            $this->redirect('equipos');
        }
        
        $user = $this->getCurrentUser();
        
        // Si es delegado, solo puede editar sus equipos
        if ($user['rol_nombre'] === 'DELEGADO' && $equipo['delegado_id'] != $user['id']) {
            $this->setFlash('error', 'No tienes permiso para editar este equipo');
            $this->redirect('equipos');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'] ?? '',
                'color_primario' => $_POST['color_primario'] ?? '',
                'color_secundario' => $_POST['color_secundario'] ?? '',
                'telefono' => $_POST['telefono'] ?? '',
                'email' => $_POST['email'] ?? ''
            ];
            
            // Manejar subida de logo
            if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'public/uploads/equipos/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                $extension = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
                $filename = 'equipo_' . $id . '_' . time() . '.' . $extension;
                $uploadPath = $uploadDir . $filename;
                
                if (move_uploaded_file($_FILES['logo']['tmp_name'], $uploadPath)) {
                    $data['logo'] = $uploadPath;
                }
            }
            
            if ($equipoModel->update($id, $data)) {
                $this->setFlash('success', 'Equipo actualizado exitosamente');
                $this->redirect('equipos/detalle/' . $id);
            } else {
                $error = 'Error al actualizar el equipo';
            }
        }
        
        $data = [
            'title' => 'Editar Equipo',
            'user' => $user,
            'equipo' => $equipo,
            'error' => $error ?? null
        ];
        
        $this->view('layouts/header', $data);
        $this->view('layouts/sidebar', $data);
        $this->view('equipos/edit', $data);
        $this->view('layouts/footer');
    }
    
    public function agregarJugador($equipoId) {
        $this->checkRole(['SUPERADMIN', 'DELEGADO']);
        
        $equipoModel = $this->model('Equipo');
        $equipo = $equipoModel->findById($equipoId);
        
        if (!$equipo) {
            $this->setFlash('error', 'Equipo no encontrado');
            $this->redirect('equipos');
        }
        
        $user = $this->getCurrentUser();
        
        // Si es delegado, solo puede agregar jugadores a sus equipos
        if ($user['rol_nombre'] === 'DELEGADO' && $equipo['delegado_id'] != $user['id']) {
            $this->setFlash('error', 'No tienes permiso para agregar jugadores a este equipo');
            $this->redirect('equipos/detalle/' . $equipoId);
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $jugadorModel = $this->model('Jugador');
            
            // Crear el jugador
            $jugadorData = [
                'nombre' => $_POST['nombre'] ?? '',
                'apellidos' => $_POST['apellidos'] ?? '',
                'fecha_nacimiento' => $_POST['fecha_nacimiento'] ?: null,
                'numero_camisa' => $_POST['numero_camisa'] ?: null,
                'posicion' => $_POST['posicion'] ?? '',
                'activo' => 1
            ];
            
            $jugadorId = $jugadorModel->insert($jugadorData);
            
            if ($jugadorId) {
                // Agregar a la plantilla del equipo
                $sql = "INSERT INTO plantilla (equipo_id, jugador_id, fecha_alta, status) 
                        VALUES (:equipo_id, :jugador_id, :fecha_alta, :status)";
                
                $db = Database::getInstance()->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':equipo_id', $equipoId);
                $stmt->bindValue(':jugador_id', $jugadorId);
                $stmt->bindValue(':fecha_alta', date('Y-m-d'));
                $stmt->bindValue(':status', 'ACTIVO');
                $stmt->execute();
                
                $this->setFlash('success', 'Jugador agregado exitosamente');
                $this->redirect('equipos/detalle/' . $equipoId);
            } else {
                $error = 'Error al agregar el jugador';
            }
        }
        
        $data = [
            'title' => 'Agregar Jugador',
            'user' => $user,
            'equipo' => $equipo,
            'error' => $error ?? null
        ];
        
        $this->view('layouts/header', $data);
        $this->view('layouts/sidebar', $data);
        $this->view('equipos/agregar_jugador', $data);
        $this->view('layouts/footer');
    }
}

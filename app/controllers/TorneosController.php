<?php
/**
 * Controlador de Torneos
 */
class TorneosController extends Controller {
    
    public function index() {
        $this->checkRole();
        
        $torneoModel = $this->model('Torneo');
        $user = $this->getCurrentUser();
        
        // Si es organizador, solo ver sus torneos
        if ($user['rol_nombre'] === 'ORGANIZADOR') {
            $torneos = $torneoModel->all(['organizador_id' => $user['id']], 'fecha_inicio DESC');
        } else {
            $torneos = $torneoModel->query(
                "SELECT t.*, c.nombre as categoria_nombre, s.nombre as sede_nombre, u.nombre as organizador_nombre
                FROM torneos t
                LEFT JOIN categorias c ON t.categoria_id = c.id
                LEFT JOIN sedes s ON t.sede_id = s.id
                INNER JOIN usuarios u ON t.organizador_id = u.id
                ORDER BY t.fecha_inicio DESC"
            );
        }
        
        $data = [
            'title' => 'Torneos',
            'user' => $user,
            'torneos' => $torneos,
            'flash' => $this->getFlash()
        ];
        
        $this->view('layouts/header', $data);
        $this->view('layouts/sidebar', $data);
        $this->view('torneos/index', $data);
        $this->view('layouts/footer');
    }
    
    public function detalle($id) {
        $torneoModel = $this->model('Torneo');
        $torneo = $torneoModel->getCompleto($id);
        
        if (!$torneo) {
            $this->setFlash('error', 'Torneo no encontrado');
            $this->redirect('torneos');
        }
        
        $equipos = $torneoModel->getEquiposInscritos($id);
        $tabla = $torneoModel->getTablaPosiciones($id);
        
        $partidoModel = $this->model('Partido');
        $partidos = $partidoModel->getByTorneo($id);
        
        $data = [
            'title' => $torneo['nombre'],
            'user' => $this->getCurrentUser(),
            'torneo' => $torneo,
            'equipos' => $equipos,
            'tabla' => $tabla,
            'partidos' => $partidos
        ];
        
        $this->view('layouts/header', $data);
        $this->view('layouts/sidebar', $data);
        $this->view('torneos/view', $data);
        $this->view('layouts/footer');
    }
    
    public function create() {
        $this->checkRole(['SUPERADMIN', 'ORGANIZADOR']);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->getCurrentUser();
            
            $data = [
                'nombre' => $_POST['nombre'] ?? '',
                'descripcion' => $_POST['descripcion'] ?? '',
                'tipo' => $_POST['tipo'] ?? 'LIGA',
                'categoria_id' => $_POST['categoria_id'] ?: null,
                'sede_id' => $_POST['sede_id'] ?: null,
                'organizador_id' => $user['id'],
                'fecha_inicio' => $_POST['fecha_inicio'] ?? null,
                'fecha_fin' => $_POST['fecha_fin'] ?? null,
                'num_equipos' => $_POST['num_equipos'] ?? 0,
                'puntos_victoria' => $_POST['puntos_victoria'] ?? 3,
                'puntos_empate' => $_POST['puntos_empate'] ?? 1,
                'puntos_derrota' => $_POST['puntos_derrota'] ?? 0,
                'status' => 'INSCRIPCIONES',
                'publico' => isset($_POST['publico']) ? 1 : 0
            ];
            
            $torneoModel = $this->model('Torneo');
            $torneoId = $torneoModel->insert($data);
            
            if ($torneoId) {
                $this->setFlash('success', 'Torneo creado exitosamente');
                $this->redirect('torneos');
            } else {
                $error = 'Error al crear el torneo';
            }
        }
        
        // Obtener categorías y sedes para el formulario
        $categoriaModel = $this->model('Categoria');
        $sedeModel = $this->model('Sede');
        
        $data = [
            'title' => 'Crear Torneo',
            'user' => $this->getCurrentUser(),
            'categorias' => $categoriaModel->all([], 'nombre ASC'),
            'sedes' => $sedeModel->getActivas(),
            'error' => $error ?? null
        ];
        
        $this->view('layouts/header', $data);
        $this->view('layouts/sidebar', $data);
        $this->view('torneos/create', $data);
        $this->view('layouts/footer');
    }
}

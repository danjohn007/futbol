<?php
/**
 * Controlador de Partidos
 */
class PartidosController extends Controller {
    
    public function index() {
        $this->checkRole();
        
        $partidoModel = $this->model('Partido');
        
        // Obtener partidos próximos y recientes
        $proximos = $partidoModel->getProximos(20);
        
        $recientes = $partidoModel->query(
            "SELECT p.*, 
            el.nombre as equipo_local, el.logo as logo_local,
            ev.nombre as equipo_visitante, ev.logo as logo_visitante,
            t.nombre as torneo_nombre,
            c.nombre as cancha_nombre
            FROM partidos p
            INNER JOIN equipos el ON p.equipo_local_id = el.id
            INNER JOIN equipos ev ON p.equipo_visitante_id = ev.id
            INNER JOIN torneos t ON p.torneo_id = t.id
            LEFT JOIN canchas c ON p.cancha_id = c.id
            WHERE p.status = 'FINALIZADO'
            ORDER BY p.fecha_hora DESC
            LIMIT 20"
        );
        
        $data = [
            'title' => 'Calendario de Partidos',
            'user' => $this->getCurrentUser(),
            'proximos' => $proximos,
            'recientes' => $recientes
        ];
        
        $this->view('layouts/header', $data);
        $this->view('layouts/sidebar', $data);
        $this->view('partidos/index', $data);
        $this->view('layouts/footer');
    }
    
    public function view($id) {
        $partidoModel = $this->model('Partido');
        $partido = $partidoModel->getDetalle($id);
        
        if (!$partido) {
            $this->setFlash('error', 'Partido no encontrado');
            $this->redirect('partidos');
        }
        
        $data = [
            'title' => 'Detalles del Partido',
            'user' => $this->getCurrentUser(),
            'partido' => $partido
        ];
        
        $this->view('layouts/header', $data);
        $this->view('layouts/sidebar', $data);
        $this->view('partidos/view', $data);
        $this->view('layouts/footer');
    }
}

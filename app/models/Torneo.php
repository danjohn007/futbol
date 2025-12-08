<?php
/**
 * Modelo de Torneo
 */
class Torneo extends Model {
    protected $table = 'torneos';
    
    /**
     * Obtener torneos públicos activos
     */
    public function getPublicosActivos() {
        $sql = "SELECT t.*, c.nombre as categoria_nombre, s.nombre as sede_nombre, 
                u.nombre as organizador_nombre
                FROM torneos t
                LEFT JOIN categorias c ON t.categoria_id = c.id
                LEFT JOIN sedes s ON t.sede_id = s.id
                INNER JOIN usuarios u ON t.organizador_id = u.id
                WHERE t.publico = 1 AND t.status IN ('INSCRIPCIONES', 'ACTIVO')
                ORDER BY t.fecha_inicio DESC";
        
        return $this->query($sql);
    }
    
    /**
     * Obtener torneo completo
     */
    public function getCompleto($id) {
        $sql = "SELECT t.*, c.nombre as categoria_nombre, c.genero,
                s.nombre as sede_nombre, s.ciudad, s.estado,
                u.nombre as organizador_nombre, u.email as organizador_email
                FROM torneos t
                LEFT JOIN categorias c ON t.categoria_id = c.id
                LEFT JOIN sedes s ON t.sede_id = s.id
                INNER JOIN usuarios u ON t.organizador_id = u.id
                WHERE t.id = :id
                LIMIT 1";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    /**
     * Obtener equipos inscritos
     */
    public function getEquiposInscritos($torneoId) {
        $sql = "SELECT e.*, i.status as inscripcion_status, i.grupo
                FROM equipos e
                INNER JOIN inscripciones i ON e.id = i.equipo_id
                WHERE i.torneo_id = :torneo_id
                ORDER BY i.grupo, e.nombre ASC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':torneo_id', $torneoId);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    /**
     * Obtener tabla de posiciones
     */
    public function getTablaPosiciones($torneoId) {
        $sql = "SELECT tp.*, e.nombre as equipo_nombre, e.logo
                FROM tabla_posiciones tp
                INNER JOIN equipos e ON tp.equipo_id = e.id
                WHERE tp.torneo_id = :torneo_id
                ORDER BY tp.puntos DESC, tp.diferencia_goles DESC, tp.goles_favor DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':torneo_id', $torneoId);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
}

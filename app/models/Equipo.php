<?php
/**
 * Modelo de Equipo
 */
class Equipo extends Model {
    protected $table = 'equipos';
    
    /**
     * Obtener equipo con delegado
     */
    public function getConDelegado($id) {
        $sql = "SELECT e.*, u.nombre as delegado_nombre, u.email as delegado_email, u.telefono as delegado_telefono
                FROM equipos e
                INNER JOIN usuarios u ON e.delegado_id = u.id
                WHERE e.id = :id
                LIMIT 1";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    /**
     * Obtener plantilla del equipo
     */
    public function getPlantilla($equipoId) {
        $sql = "SELECT j.*, p.status as plantilla_status, p.fecha_alta, p.fecha_baja
                FROM jugadores j
                INNER JOIN plantilla p ON j.id = p.jugador_id
                WHERE p.equipo_id = :equipo_id
                ORDER BY j.numero_camisa ASC, j.apellidos ASC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':equipo_id', $equipoId);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    /**
     * Obtener equipos de un delegado
     */
    public function getByDelegado($delegadoId) {
        return $this->all(['delegado_id' => $delegadoId, 'activo' => 1], 'nombre ASC');
    }
}

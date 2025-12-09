<?php
/**
 * Modelo de Jugador
 */
class Jugador extends Model {
    protected $table = 'jugadores';
    
    /**
     * Obtener jugador con información de usuario
     */
    public function getConUsuario($id) {
        $sql = "SELECT j.*, u.email
                FROM jugadores j
                LEFT JOIN usuarios u ON j.usuario_id = u.id
                WHERE j.id = :id
                LIMIT 1";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    /**
     * Verificar si un jugador ya está en un equipo
     */
    public function estaEnEquipo($jugadorId, $equipoId) {
        $sql = "SELECT COUNT(*) as total FROM plantilla 
                WHERE jugador_id = :jugador_id 
                AND equipo_id = :equipo_id 
                AND status != 'BAJA'";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':jugador_id', $jugadorId);
        $stmt->bindValue(':equipo_id', $equipoId);
        $stmt->execute();
        
        $result = $stmt->fetch();
        return $result['total'] > 0;
    }
}

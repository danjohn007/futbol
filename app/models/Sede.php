<?php
/**
 * Modelo de Sede
 */
class Sede extends Model {
    protected $table = 'sedes';
    
    /**
     * Obtener sedes activas
     */
    public function getActivas() {
        return $this->all(['activo' => 1], 'nombre ASC');
    }
    
    /**
     * Obtener sede con sus canchas
     */
    public function getWithCanchas($id) {
        $sede = $this->findById($id);
        
        if ($sede) {
            $sql = "SELECT * FROM canchas WHERE sede_id = :sede_id AND activo = 1 ORDER BY nombre ASC";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':sede_id', $id);
            $stmt->execute();
            
            $sede['canchas'] = $stmt->fetchAll();
        }
        
        return $sede;
    }
    
    /**
     * Obtener sedes de un administrador
     */
    public function getByAdmin($adminId) {
        $sql = "SELECT s.* FROM sedes s
                INNER JOIN admin_sede ads ON s.id = ads.sede_id
                WHERE ads.usuario_id = :admin_id AND s.activo = 1
                ORDER BY s.nombre ASC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':admin_id', $adminId);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
}

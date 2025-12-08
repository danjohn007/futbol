<?php
/**
 * Modelo de Partido
 */
class Partido extends Model {
    protected $table = 'partidos';
    
    /**
     * Obtener partidos de un torneo
     */
    public function getByTorneo($torneoId, $status = null) {
        $sql = "SELECT p.*, 
                el.nombre as equipo_local, el.logo as logo_local,
                ev.nombre as equipo_visitante, ev.logo as logo_visitante,
                c.nombre as cancha_nombre, s.nombre as sede_nombre,
                u.nombre as arbitro_nombre
                FROM partidos p
                INNER JOIN equipos el ON p.equipo_local_id = el.id
                INNER JOIN equipos ev ON p.equipo_visitante_id = ev.id
                LEFT JOIN canchas c ON p.cancha_id = c.id
                LEFT JOIN sedes s ON c.sede_id = s.id
                LEFT JOIN usuarios u ON p.arbitro_id = u.id
                WHERE p.torneo_id = :torneo_id";
        
        if ($status) {
            $sql .= " AND p.status = :status";
        }
        
        $sql .= " ORDER BY p.fecha_hora ASC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':torneo_id', $torneoId);
        
        if ($status) {
            $stmt->bindValue(':status', $status);
        }
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    /**
     * Obtener detalle completo del partido
     */
    public function getDetalle($id) {
        $partido = $this->query(
            "SELECT p.*, 
            el.nombre as equipo_local, el.logo as logo_local,
            ev.nombre as equipo_visitante, ev.logo as logo_visitante,
            c.nombre as cancha_nombre, s.nombre as sede_nombre,
            u.nombre as arbitro_nombre,
            t.nombre as torneo_nombre
            FROM partidos p
            INNER JOIN equipos el ON p.equipo_local_id = el.id
            INNER JOIN equipos ev ON p.equipo_visitante_id = ev.id
            INNER JOIN torneos t ON p.torneo_id = t.id
            LEFT JOIN canchas c ON p.cancha_id = c.id
            LEFT JOIN sedes s ON c.sede_id = s.id
            LEFT JOIN usuarios u ON p.arbitro_id = u.id
            WHERE p.id = :id
            LIMIT 1",
            [':id' => $id]
        );
        
        if (!empty($partido)) {
            $partido = $partido[0];
            
            // Obtener goles
            $partido['goles'] = $this->query(
                "SELECT g.*, j.nombre, j.apellidos, e.nombre as equipo_nombre
                FROM goles g
                INNER JOIN jugadores j ON g.jugador_id = j.id
                INNER JOIN equipos e ON g.equipo_id = e.id
                WHERE g.partido_id = :partido_id
                ORDER BY g.minuto ASC",
                [':partido_id' => $id]
            );
            
            // Obtener tarjetas
            $partido['tarjetas'] = $this->query(
                "SELECT t.*, j.nombre, j.apellidos
                FROM tarjetas t
                INNER JOIN jugadores j ON t.jugador_id = j.id
                WHERE t.partido_id = :partido_id
                ORDER BY t.minuto ASC",
                [':partido_id' => $id]
            );
            
            return $partido;
        }
        
        return null;
    }
    
    /**
     * Obtener próximos partidos
     */
    public function getProximos($limit = 10) {
        $sql = "SELECT p.*, 
                el.nombre as equipo_local, el.logo as logo_local,
                ev.nombre as equipo_visitante, ev.logo as logo_visitante,
                t.nombre as torneo_nombre,
                c.nombre as cancha_nombre
                FROM partidos p
                INNER JOIN equipos el ON p.equipo_local_id = el.id
                INNER JOIN equipos ev ON p.equipo_visitante_id = ev.id
                INNER JOIN torneos t ON p.torneo_id = t.id
                LEFT JOIN canchas c ON p.cancha_id = c.id
                WHERE p.status = 'PROGRAMADO' AND p.fecha_hora >= NOW()
                ORDER BY p.fecha_hora ASC
                LIMIT :limit";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
}

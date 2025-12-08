<?php
/**
 * Modelo de Configuración
 */
class Configuracion extends Model {
    protected $table = 'configuracion';
    
    /**
     * Obtener valor de configuración por clave
     */
    public function getValue($clave, $default = null) {
        $config = $this->findOne(['clave' => $clave]);
        return $config ? $config['valor'] : $default;
    }
    
    /**
     * Actualizar valor de configuración
     */
    public function setValue($clave, $valor) {
        $config = $this->findOne(['clave' => $clave]);
        
        if ($config) {
            return $this->update($config['id'], ['valor' => $valor]);
        } else {
            return $this->insert([
                'clave' => $clave,
                'valor' => $valor
            ]);
        }
    }
    
    /**
     * Obtener todas las configuraciones agrupadas
     */
    public function getAllGrouped() {
        $configs = $this->all([], 'clave ASC');
        $grouped = [];
        
        foreach ($configs as $config) {
            $grouped[$config['clave']] = $config['valor'];
        }
        
        return $grouped;
    }
}

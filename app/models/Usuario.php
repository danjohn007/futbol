<?php
/**
 * Modelo de Usuario
 */
class Usuario extends Model {
    protected $table = 'usuarios';
    
    /**
     * Autenticar usuario
     */
    public function authenticate($email, $password) {
        $sql = "SELECT u.*, r.nombre as rol_nombre 
                FROM usuarios u 
                INNER JOIN roles r ON u.rol_id = r.id 
                WHERE u.email = :email AND u.activo = 1 
                LIMIT 1";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        
        return false;
    }
    
    /**
     * Registrar nuevo usuario
     */
    public function register($data) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $this->insert($data);
    }
    
    /**
     * Obtener usuario con rol
     */
    public function findById($id) {
        $sql = "SELECT u.*, r.nombre as rol_nombre 
                FROM usuarios u 
                INNER JOIN roles r ON u.rol_id = r.id 
                WHERE u.id = :id 
                LIMIT 1";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    /**
     * Verificar si el email existe
     */
    public function emailExists($email, $excludeId = null) {
        $sql = "SELECT COUNT(*) as count FROM usuarios WHERE email = :email";
        
        if ($excludeId) {
            $sql .= " AND id != :id";
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        
        if ($excludeId) {
            $stmt->bindValue(':id', $excludeId);
        }
        
        $stmt->execute();
        $result = $stmt->fetch();
        
        return $result['count'] > 0;
    }
    
    /**
     * Actualizar contraseña
     */
    public function updatePassword($id, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        return $this->update($id, ['password' => $hashedPassword]);
    }
    
    /**
     * Obtener usuarios por rol
     */
    public function getByRole($roleId) {
        $sql = "SELECT u.*, r.nombre as rol_nombre 
                FROM usuarios u 
                INNER JOIN roles r ON u.rol_id = r.id 
                WHERE u.rol_id = :role_id AND u.activo = 1 
                ORDER BY u.nombre ASC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':role_id', $roleId);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
}

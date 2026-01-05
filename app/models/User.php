<?php
class User {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    // Registrar Usuario
    public function register($data){
        // Preparar Query
        $this->db->query('INSERT INTO usuarios (nombre, email, password, role_id, empresa_id, institucion_id) VALUES(:nombre, :email, :password, :role_id, :empresa_id, :institucion_id)');

        // Vincular valores
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':email', $data['email']);
        // SEGURIDAD ISO: Uso de Argon2id
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_ARGON2ID));
        $this->db->bind(':role_id', $data['role_id']);
        $this->db->bind(':empresa_id', !empty($data['empresa_id']) ? $data['empresa_id'] : null);
        $this->db->bind(':institucion_id', !empty($data['institucion_id']) ? $data['institucion_id'] : null);

        // Ejecutar
        if($this->db->execute()){
            // Obtener el ID del usuario insertado
            $userId = $this->db->lastInsertId();

            // Si es estudiante, crear perfil
            if($data['role_id'] == 5){
                $this->db->query('INSERT INTO perfil_estudiantes (usuario_id, matricula, carrera_id) VALUES(:usuario_id, :matricula, :carrera_id)');
                $this->db->bind(':usuario_id', $userId);
                $this->db->bind(':matricula', isset($data['matricula']) ? $data['matricula'] : 'PENDIENTE'); 
                $this->db->bind(':carrera_id', isset($data['carrera_id']) ? $data['carrera_id'] : 1);
                $this->db->execute();
            }

            return true;
        } else {
            return false;
        }
    }

    // Login Usuario
    public function login($email, $password){
        $this->db->query('SELECT * FROM usuarios WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if($row){
             $hashed_password = $row->password;
             if(password_verify($password, $hashed_password)){
                 // SEGURIDAD: Rehash automático si el algoritmo es viejo (Bcrypt -> Argon2id)
                 if (password_needs_rehash($hashed_password, PASSWORD_ARGON2ID)) {
                     $newHash = password_hash($password, PASSWORD_ARGON2ID);
                     $this->db->query('UPDATE usuarios SET password = :password WHERE id = :id');
                     $this->db->bind(':password', $newHash);
                     $this->db->bind(':id', $row->id);
                     $this->db->execute();
                 }
                 return $row;
             }
        }
        return false;
    }

    // Encontrar usuario por email
    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM usuarios WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // Check row
        if($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }
    // Obtener usuario por ID
    public function getUserById($id){
        $this->db->query('SELECT * FROM usuarios WHERE id = :id');
        $this->db->bind(':id', $id);

        return $this->db->single();
    }

    // Obtener todos los usuarios (para Admin) con Paginación
    public function getUsers($limit = 100, $offset = 0){
        $this->db->query('SELECT * FROM usuarios ORDER BY created_at DESC LIMIT :limit OFFSET :offset');
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        return $this->db->resultSet();
    }

    // Contar total de usuarios
    public function countUsers(){
         $this->db->query('SELECT COUNT(*) as total FROM usuarios');
         $row = $this->db->single();
         return $row->total;
    }

    // Actualizar Usuario
    public function updateUser($data){
        // Si hay password, actualizar todo, si no, mantener password
        if(!empty($data['password'])){
             $this->db->query('UPDATE usuarios SET nombre = :nombre, email = :email, password = :password, role_id = :role_id, empresa_id = :empresa_id, institucion_id = :institucion_id WHERE id = :id');
             $this->db->bind(':password', password_hash($data['password'], PASSWORD_ARGON2ID));
        } else {
             $this->db->query('UPDATE usuarios SET nombre = :nombre, email = :email, role_id = :role_id, empresa_id = :empresa_id, institucion_id = :institucion_id WHERE id = :id');
        }

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':role_id', $data['role_id']);
        $this->db->bind(':empresa_id', !empty($data['empresa_id']) ? $data['empresa_id'] : null);
        $this->db->bind(':institucion_id', !empty($data['institucion_id']) ? $data['institucion_id'] : null);

        if($this->db->execute()){
            // Update Student Profile if Role is 5
            if($data['role_id'] == 5){
                 // Check if profile exists
                 $this->db->query('SELECT * FROM perfil_estudiantes WHERE usuario_id = :id');
                 $this->db->bind(':id', $data['id']);
                 $profile = $this->db->single();

                 if($profile){
                     $this->db->query('UPDATE perfil_estudiantes SET matricula = :matricula, carrera_id = :carrera_id WHERE usuario_id = :id');
                 } else {
                     $this->db->query('INSERT INTO perfil_estudiantes (usuario_id, matricula, carrera_id) VALUES(:id, :matricula, :carrera_id)');
                 }
                 $this->db->bind(':id', $data['id']);
                 $this->db->bind(':matricula', isset($data['matricula']) ? $data['matricula'] : 'PENDIENTE');
                 $this->db->bind(':carrera_id', isset($data['carrera_id']) ? $data['carrera_id'] : 1);
                 $this->db->execute();
            }
            return true;
        } else {
            return false;
        }
    }

    // Eliminar Usuario
    public function deleteUser($id){
        $this->db->query('DELETE FROM usuarios WHERE id = :id');
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
    // Link User to Empresa
    public function setEmpresaId($userId, $empresaId){
        $this->db->query('UPDATE usuarios SET empresa_id = :empresa_id WHERE id = :id');
        $this->db->bind(':empresa_id', $empresaId);
        $this->db->bind(':id', $userId);
        return $this->db->execute();
    }
    // Actualizar Perfil (Usuario)
    public function updateProfile($data){
        if(!empty($data['password'])){
             $this->db->query('UPDATE usuarios SET nombre = :nombre, email = :email, password = :password, foto_perfil = :foto_perfil WHERE id = :id');
             $this->db->bind(':password', password_hash($data['password'], PASSWORD_ARGON2ID));
        } else {
             $this->db->query('UPDATE usuarios SET nombre = :nombre, email = :email, foto_perfil = :foto_perfil WHERE id = :id');
        }

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':foto_perfil', $data['foto_perfil']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
    // Obtener perfil de estudiante
    public function getStudentProfile($userId){
        $this->db->query('SELECT * FROM perfil_estudiantes WHERE usuario_id = :id');
        $this->db->bind(':id', $userId);
        return $this->db->single();
    }

    // Obtener usuarios por rol
    public function getUsersByRole($roleId){
        $this->db->query('SELECT * FROM usuarios WHERE role_id = :role_id');
        $this->db->bind(':role_id', $roleId);
        return $this->db->resultSet();
    }

    // Guardar Token de Reset
    public function saveResetToken($email, $token){
        // Limpiar tokens anteriores
        $this->db->query('DELETE FROM password_resets WHERE email = :email');
        $this->db->bind(':email', $email);
        $this->db->execute();

        // Insertar nuevo token
        $this->db->query('INSERT INTO password_resets (email, token, created_at) VALUES (:email, :token, NOW())');
        $this->db->bind(':email', $email);
        $this->db->bind(':token', $token);
        
        return $this->db->execute();
    }

    // Verificar Token
    public function verifyResetToken($email, $token){
        $this->db->query('SELECT * FROM password_resets WHERE email = :email AND token = :token');
        $this->db->bind(':email', $email);
        $this->db->bind(':token', $token);
        
        $row = $this->db->single();
        if($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }

    // Reset Password Final
    public function resetPassword($email, $password){
        // 1. Update User Password
        $this->db->query('UPDATE usuarios SET password = :password WHERE email = :email');
        $this->db->bind(':password', password_hash($password, PASSWORD_ARGON2ID)); 
        $this->db->bind(':email', $email);
        
        if($this->db->execute()){
            // 2. Delete Token
            $this->db->query('DELETE FROM password_resets WHERE email = :email');
            $this->db->bind(':email', $email);
            $this->db->execute();
            return true;
        } else {
            return false;
        }
    }

    // Seguridad 2FA
    public function set2FA($id, $secret){
        $this->db->query('UPDATE usuarios SET secret_2fa = :secret WHERE id = :id');
        $this->db->bind(':secret', $secret);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function toggle2FA($id, $status){
        // Status: 1 = Activo, 0 = Inactivo
        $this->db->query('UPDATE usuarios SET enable_2fa = :status WHERE id = :id');
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}

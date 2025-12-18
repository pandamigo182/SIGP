<?php
class Plaza {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getPlazas($filters = [], $limit = null, $offset = null){
        $sql = "SELECT DISTINCT plazas.*, 
                plazas.id as plazaId, 
                empresas.id as empresaId,
                empresas.nombre as nombreEmpresa,
                empresas.logo_path as logoEmpresa,
                departamentos.departamento as nombreDepartamento,
                municipios.municipio as nombreMunicipio,
                plazas.es_remunerada,
                plazas.beneficios,
                plazas.created_at as fechaPublicacion
                FROM plazas 
                INNER JOIN usuarios 
                ON plazas.empresa_id = usuarios.id 
                INNER JOIN empresas
                ON usuarios.empresa_id = empresas.id
                LEFT JOIN departamentos
                ON empresas.departamento_id = departamentos.id_departamento
                LEFT JOIN municipios
                ON empresas.municipio_id = municipios.id_municipio
                WHERE plazas.estado = 'abierta'";

        // Filters
        if(!empty($filters['q'])){
            $sql .= " AND (plazas.titulo LIKE :q OR empresas.nombre LIKE :q)";
        }
        if(!empty($filters['rubro'])){
             $sql .= " AND empresas.rubro LIKE :rubro";
        }
        if(!empty($filters['departamento_id'])){
             $sql .= " AND empresas.departamento_id = :dept";
        }
        if(!empty($filters['municipio_id'])){
             $sql .= " AND empresas.municipio_id = :muni";
        }

        $sql .= " ORDER BY plazas.created_at DESC";

        if($limit){
            $sql .= " LIMIT $limit";
        }
        
        if($offset){
            $sql .= " OFFSET $offset";
        }

        $this->db->query($sql);

        // Bindings
        if(!empty($filters['q'])){
            $this->db->bind(':q', '%' . $filters['q'] . '%');
        }
        if(!empty($filters['rubro'])){
            $this->db->bind(':rubro', '%' . $filters['rubro'] . '%');
        }
        if(!empty($filters['departamento_id'])){
            $this->db->bind(':dept', $filters['departamento_id']);
        }
        if(!empty($filters['municipio_id'])){
            $this->db->bind(':muni', $filters['municipio_id']);
        }

        return $this->db->resultSet();
    }

    public function getPlazasCount($filters = []){
        $sql = "SELECT COUNT(*) as count 
                FROM plazas 
                INNER JOIN usuarios ON plazas.empresa_id = usuarios.id 
                INNER JOIN empresas ON usuarios.empresa_id = empresas.id
                WHERE plazas.estado = 'abierta'";

        if(!empty($filters['q'])){
             $sql .= " AND (plazas.titulo LIKE :q OR empresas.nombre LIKE :q)";
        }
        if(!empty($filters['rubro'])){
             $sql .= " AND empresas.rubro LIKE :rubro";
        }
        if(!empty($filters['departamento_id'])){
             $sql .= " AND empresas.departamento_id = :dept";
        }
        if(!empty($filters['municipio_id'])){
             $sql .= " AND empresas.municipio_id = :muni";
        }

        $this->db->query($sql);

        if(!empty($filters['q'])){
            $this->db->bind(':q', '%' . $filters['q'] . '%');
        }
        if(!empty($filters['rubro'])){
            $this->db->bind(':rubro', '%' . $filters['rubro'] . '%');
        }
        if(!empty($filters['departamento_id'])){
            $this->db->bind(':dept', $filters['departamento_id']);
        }
        if(!empty($filters['municipio_id'])){
            $this->db->bind(':muni', $filters['municipio_id']);
        }
        
        $row = $this->db->single();
        return $row->count;
    }

    public function getDestacadas($limit = 3){
         $sql = "SELECT plazas.*, 
                plazas.id as plazaId, 
                empresas.nombre as nombreEmpresa,
                empresas.logo_path as logoEmpresa,
                departamentos.departamento as nombreDepartamento,
                municipios.municipio as nombreMunicipio
                FROM plazas 
                INNER JOIN usuarios ON plazas.empresa_id = usuarios.id 
                INNER JOIN empresas ON usuarios.empresa_id = empresas.id
                LEFT JOIN departamentos ON empresas.departamento_id = departamentos.id_departamento
                LEFT JOIN municipios ON empresas.municipio_id = municipios.id_municipio
                WHERE plazas.estado = 'abierta'
                ORDER BY rand() ASC LIMIT :limit"; 
         
         $this->db->query($sql);
         $this->db->bind(':limit', $limit);
         return $this->db->resultSet();
    }

    public function getPlazasByEmpresa($id){
        $this->db->query("SELECT * FROM plazas WHERE empresa_id = :id ORDER BY created_at DESC");
        $this->db->bind(':id', $id);
        return $this->db->resultSet();
    }

    public function addPlaza($data){
        $this->db->query('INSERT INTO plazas (empresa_id, titulo, descripcion, requisitos, competencias_requeridas, modalidad, cantidad_vacantes, fecha_limite, duracion) VALUES(:empresa_id, :titulo, :descripcion, :requisitos, :competencias_requeridas, :modalidad, :cantidad_vacantes, :fecha_limite, :duracion)');
        $this->db->bind(':empresa_id', $data['empresa_id']);
        $this->db->bind(':titulo', $data['titulo']);
        $this->db->bind(':descripcion', $data['descripcion']);
        $this->db->bind(':requisitos', $data['requisitos']);
        $this->db->bind(':competencias_requeridas', $data['competencias_requeridas']);
        $this->db->bind(':modalidad', $data['modalidad']);
        $this->db->bind(':cantidad_vacantes', $data['cantidad_vacantes']);
        $this->db->bind(':fecha_limite', $data['fecha_limite']);
        $this->db->bind(':duracion', $data['duracion']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function getPlazaById($id){
        $this->db->query('SELECT plazas.*, 
                          empresas.nombre as nombreEmpresa, 
                          empresas.logo_path as logoEmpresa,
                          empresas.descripcion as descripcionEmpresa,
                          empresas.website as websiteEmpresa,
                          departamentos.departamento as nombreDepartamento,
                          municipios.municipio as nombreMunicipio,
                          plazas.created_at as fechaPublicacion
                          FROM plazas 
                          INNER JOIN usuarios ON plazas.empresa_id = usuarios.id 
                          INNER JOIN empresas ON usuarios.empresa_id = empresas.id
                          LEFT JOIN departamentos ON empresas.departamento_id = departamentos.id_departamento
                          LEFT JOIN municipios ON empresas.municipio_id = municipios.id_municipio
                          WHERE plazas.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    // Application & Favorites Logic
    public function checkApplied($userId, $plazaId){
        $this->db->query('SELECT * FROM postulaciones WHERE user_id = :user_id AND plaza_id = :plaza_id');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':plaza_id', $plazaId);
        $this->db->single();
        return $this->db->rowCount() > 0;
    }

    public function checkFavorite($userId, $plazaId){
         $this->db->query('SELECT * FROM favoritos WHERE user_id = :user_id AND plaza_id = :plaza_id');
         $this->db->bind(':user_id', $userId);
         $this->db->bind(':plaza_id', $plazaId);
         $this->db->single();
         return $this->db->rowCount() > 0;
    }

    public function toggleFavorite($userId, $plazaId){
        if($this->checkFavorite($userId, $plazaId)){
            $this->db->query('DELETE FROM favoritos WHERE user_id = :user_id AND plaza_id = :plaza_id');
        } else {
            $this->db->query('INSERT INTO favoritos (user_id, plaza_id) VALUES(:user_id, :plaza_id)');
        }
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':plaza_id', $plazaId);
        return $this->db->execute();
    }

    public function apply($data){
        // Assuming simple application for now
        $this->db->query('INSERT INTO postulaciones (user_id, plaza_id, cv_id, estado) VALUES(:user_id, :plaza_id, :cv_id, "pendiente")');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':plaza_id', $data['plaza_id']);
        $this->db->bind(':cv_id', $data['cv_id'] ?? 0); // 0 if no CV selected (should be handled)
        return $this->db->execute();
    }

    public function getSimilarPlazas($plazaId, $rubro){
        $this->db->query("SELECT plazas.*, empresas.nombre as nombreEmpresa, empresas.logo_path as logoEmpresa 
                          FROM plazas 
                          INNER JOIN usuarios ON plazas.empresa_id = usuarios.id
                          INNER JOIN empresas ON usuarios.empresa_id = empresas.id 
                          WHERE empresas.rubro = :rubro AND plazas.id != :id AND plazas.estado = 'abierta'
                          LIMIT 4");
        $this->db->bind(':rubro', $rubro);
        $this->db->bind(':id', $plazaId);
        return $this->db->resultSet();
    }

    public function updatePlaza($data){
        $this->db->query('UPDATE plazas SET titulo = :titulo, descripcion = :descripcion, requisitos = :requisitos, fecha_limite = :fecha_limite, duracion = :duracion, estado = :estado WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':titulo', $data['titulo']);
        $this->db->bind(':descripcion', $data['descripcion']);
        $this->db->bind(':requisitos', $data['requisitos']);
        $this->db->bind(':fecha_limite', $data['fecha_limite']);
        $this->db->bind(':duracion', $data['duracion']);
        $this->db->bind(':estado', $data['estado']);

        return $this->db->execute();
    }

    // Admin: Get All Plazas with Stats
    public function getAllPlazasWithStats($limit = 10, $offset = 0){
        $sql = "SELECT p.*, e.nombre as empresa_nombre, e.logo_path as empresa_logo, 
                (SELECT COUNT(*) FROM postulaciones WHERE plaza_id = p.id) as total_postulaciones
                FROM plazas p
                JOIN usuarios u ON p.empresa_id = u.id
                JOIN empresas e ON u.empresa_id = e.id
                ORDER BY p.created_at DESC LIMIT :limit OFFSET :offset";
        $this->db->query($sql);
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        return $this->db->resultSet();
    }

    public function countAllPlazas(){
        $this->db->query("SELECT COUNT(*) as total FROM plazas");
        $row = $this->db->single();
        return $row->total;
    }
}

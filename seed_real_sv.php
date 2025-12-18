<?php
// seed_real_sv.php
require_once __DIR__ . '/app/config/config.php';
require_once __DIR__ . '/app/core/Database.php';

class RealSeederSV {
    private $db;
    private $companies = [];
    private $students = [];
    private $tutors = [];

    // Real Data Arrays
    private $rubros = ['Tecnología', 'Banca', 'Industria', 'Comercio', 'Salud', 'Telecomunicaciones', 'Educación'];
    
    private $real_companies = [
        ['name' => 'Banco Agrícola', 'rubro' => 'Banca', 'email' => 'rrhh@bancoagricola.com.sv'],
        ['name' => 'Tigo El Salvador', 'rubro' => 'Telecomunicaciones', 'email' => 'talent@tigo.com.sv'],
        ['name' => 'Aeroman', 'rubro' => 'Industria', 'email' => 'info@aeroman.com.sv'],
        ['name' => 'Siman', 'rubro' => 'Comercio', 'email' => 'reclutamiento@siman.com'],
        ['name' => 'ASIT S.A. de C.V.', 'rubro' => 'Tecnología', 'email' => 'info@asit.com.sv'],
        ['name' => 'Universidad Don Bosco', 'rubro' => 'Educación', 'email' => 'rrhh@udb.edu.sv'],
        ['name' => 'Hospital de Diagnóstico', 'rubro' => 'Salud', 'email' => 'rrhh@hdiagnostico.com.sv'],
        ['name' => 'Holcim El Salvador', 'rubro' => 'Industria', 'email' => 'info@holcim.com.sv'],
        ['name' => 'Banco Cuscatlán', 'rubro' => 'Banca', 'email' => 'talento@bancocuscatlan.com'],
        ['name' => 'Claro El Salvador', 'rubro' => 'Telecomunicaciones', 'email' => 'jobs@claro.com.sv'],
        ['name' => 'Super Selectos', 'rubro' => 'Comercio', 'email' => 'seleccion@superselectos.com.sv'],
        ['name' => 'Applaudo Studios', 'rubro' => 'Tecnología', 'email' => 'careers@applaudo.com'],
        ['name' => 'Telus International', 'rubro' => 'Tecnología', 'email' => 'join@telus.com'],
        ['name' => 'Industrias La Constancia', 'rubro' => 'Industria', 'email' => 'info@laconstancia.com'],
        ['name' => 'AES El Salvador', 'rubro' => 'Industria', 'email' => 'info@aes.com.sv'],
        ['name' => 'Grupo Q', 'rubro' => 'Comercio', 'email' => 'rrhh@grupoq.com'],
        ['name' => 'Davivienda', 'rubro' => 'Banca', 'email' => 'talento@davivienda.com.sv'],
        ['name' => 'Unicomer', 'rubro' => 'Comercio', 'email' => 'jobs@unicomer.com'],
        ['name' => 'Avianca', 'rubro' => 'Industria', 'email' => 'people@avianca.com'],
        ['name' => 'Teleperformance', 'rubro' => 'Tecnología', 'email' => 'careers@teleperformance.com']
    ];

    private $plazas_titles = [
        'Desarrollador Java Junior', 'Pasante de Contabilidad', 'Asistente Administrativo', 
        'Analista de Datos', 'Diseñador UI/UX Junior', 'Soporte Técnico Nivel 1', 
        'Pasante de Recursos Humanos', 'Auxiliar de Mercadeo', 'Desarrollador Frontend React',
        'Ingeniero de Redes Junior'
    ];

    public function __construct(){
        $this->db = new Database;
        echo "Starting Real Seeder (SV Data)...\n";
        $this->seedUsersAndProfiles();
        $this->seedPlazas();
        // $this->seedApplications(); // Skip complex flow seed for now to keep it clean or invoke if needed
        echo "Seeding Completed.\n";
    }

    private function seedUsersAndProfiles(){
        // 1. Tutors (5)
        for($i=1; $i<=5; $i++){
            $this->createUser("Tutor Académico $i", "tutor$i@test.com", 3);
        }

        // 2. Companies (Real Names)
        foreach($this->real_companies as $idx => $comp){
            // Ensure unique email if re-running
            // Check if user exists
            $this->db->query("SELECT id FROM usuarios WHERE email = :email");
            $this->db->bind(':email', $comp['email']);
            if($this->db->single()) continue; // Skip if exists

            $uid = $this->createUser($comp['name'], $comp['email'], 4);
            $this->companies[] = $uid;

            // Create Profile in 'empresas'
            // Map Dept/Muni (Simplification: 1=SS, 2=LL)
            $deptId = ($idx % 2 == 0) ? 1 : 2; 

            $sql = "INSERT INTO empresas (nombre, descripcion, email_contacto, rubro, telefono, direccion, departamento_id, municipio_id, distrito_id)
                    VALUES (:nom, :desc, :email, :rubro, '2222-2222', 'San Salvador, El Salvador', :dept, 1, 1)";
            $this->db->query($sql);
            $this->db->bind(':nom', $comp['name']);
            $this->db->bind(':desc', "Empresa líder en el sector de " . $comp['rubro']);
            $this->db->bind(':email', $comp['email']);
            $this->db->bind(':rubro', $comp['rubro']);
            $this->db->bind(':dept', $deptId);
            $this->db->execute();
            $empId = $this->db->lastInsertId();

            // Link User
            $this->db->query("UPDATE usuarios SET empresa_id = :eid WHERE id = :uid");
            $this->db->bind(':eid', $empId);
            $this->db->bind(':uid', $uid);
            $this->db->execute();
        }

        // 3. Students (20)
        for($i=1; $i<=20; $i++){
            $email = "estudiante$i@udb.edu.sv";
            $this->db->query("SELECT id FROM usuarios WHERE email = :email");
            $this->db->bind(':email', $email);
            if($this->db->single()) continue;

            $uid = $this->createUser("Estudiante $i", $email, 5);
            
            // Profile
            $sql = "INSERT INTO perfil_estudiantes (usuario_id, matricula, carrera_id, telefono) VALUES (:uid, :mat, 1, '7777-7777')";
            $this->db->query($sql);
            $this->db->bind(':uid', $uid);
            $this->db->bind(':mat', "AC" . (202000 + $i));
            $this->db->execute();
        }
    }

    private function createUser($name, $email, $role){
        // Check exists
        $this->db->query("SELECT id FROM usuarios WHERE email = :email");
        $this->db->bind(':email', $email);
        $existing = $this->db->single();
        if($existing){
            return $existing->id;
        }

        $pass = password_hash('123456', PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nombre, email, password, role_id, created_at) VALUES (:name, :email, :pass, :role, NOW())";
        $this->db->query($sql);
        $this->db->bind(':name', $name);
        $this->db->bind(':email', $email);
        $this->db->bind(':pass', $pass);
        $this->db->bind(':role', $role);
        $this->db->execute();
        return $this->db->lastInsertId();
    }

    private function seedPlazas(){
        // Get Users who are Companies (Role 4)
        $this->db->query("SELECT id, empresa_id FROM usuarios WHERE role_id = 4");
        $empUsers = $this->db->resultSet();

        foreach($empUsers as $user){
            // 2 Plazas per company user
            for($k=0; $k<2; $k++){
                $title = $this->plazas_titles[array_rand($this->plazas_titles)];
                
                // Use User ID for empresa_id column in Plazas (as per FK)
                $sql = "INSERT INTO plazas (empresa_id, titulo, descripcion, requisitos, fecha_limite, cantidad_vacantes, modalidad, estado, created_at)
                        VALUES (:uid, :tit, :desc, :req, DATE_ADD(NOW(), INTERVAL 30 DAY), 2, 'Híbrida', 'abierta', NOW())";
                $this->db->query($sql);
                $this->db->bind(':uid', $user->id);
                $this->db->bind(':tit', $title);
                $this->db->bind(':desc', "Buscamos un $title proactivo y con ganas de aprender.");
                $this->db->bind(':req', "Estudiante de 4to año en adelante.");
                $this->db->execute();
            }
        }
    }
}

new RealSeederSV();

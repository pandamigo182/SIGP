<?php
class Reportes extends Controller {
    public function __construct(){
        // ¿Solo Administrador o tal vez Empresa? El usuario dijo "Admin... Reportes" lo que implica Admin.
        // Asumiendo Admin por ahora.
        if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 1){
             redirect('auth/login');
        }
        $this->reporteModel = $this->model('Reporte');
    }

    public function index(){
        $totalStudents = $this->reporteModel->getTotalStudents();
        $totalPlazas = $this->reporteModel->getTotalPlazas();
        $totalEmpresas = $this->reporteModel->getTotalEmpresas();
        $genderStats = $this->reporteModel->getGenderStats();
        $deptStatsRaw = $this->reporteModel->getDepartmentStats();
        $rubroStats = $this->reporteModel->getEmpresasByRubro();

        // Procesar datos de departamentos para Highmaps (sv-all.js)
        // Claves: sv-ah (Ahuachapán), sv-ca (Cabañas), sv-ch (Chalatenango), sv-cu (Cuscatlán), 
        // sv-li (La Libertad), sv-pa (La Paz), sv-un (La Unión), sv-mo (Morazán), 
        // sv-sm (San Miguel), sv-ss (San Salvador), sv-sv (San Vicente), sv-sa (Santa Ana), 
        // sv-so (Sonsonate), sv-us (Usulután)
        
        $mapData = [];
        $keyMap = [
            'AHUACHAPAN' => 'sv-ah', 'AHUACHAPÁN' => 'sv-ah',
            'CABANAS' => 'sv-ca', 'CABAÑAS' => 'sv-ca',
            'CHALATENANGO' => 'sv-ch',
            'CUSCATLAN' => 'sv-cu', 'CUSCATLÁN' => 'sv-cu',
            'LA LIBERTAD' => 'sv-li',
            'LA PAZ' => 'sv-pa',
            'LA UNION' => 'sv-un', 'LA UNIÓN' => 'sv-un',
            'MORAZAN' => 'sv-mo', 'MORAZÁN' => 'sv-mo',
            'SAN MIGUEL' => 'sv-sm',
            'SAN SALVADOR' => 'sv-ss',
            'SAN VICENTE' => 'sv-sv',
            'SANTA ANA' => 'sv-sa',
            'SONSONATE' => 'sv-so',
            'USULUTAN' => 'sv-us', 'USULUTÁN' => 'sv-us'
        ];

        foreach($deptStatsRaw as $row){
            $name = mb_strtoupper(trim($row->departamento), 'UTF-8');
            if(isset($keyMap[$name])){
                $code = $keyMap[$name];
                // Verificar si la clave ya existe (agregar si hay variaciones)
                $found = false;
                foreach($mapData as &$md){
                    if($md[0] == $code){
                        $md[1] += $row->total;
                        $found = true;
                        break;
                    }
                }
                if(!$found){
                    $mapData[] = [$code, $row->total];
                }
            }
        }

        $data = [
            'total_students' => $totalStudents,
            'total_plazas' => $totalPlazas,
            'total_empresas' => $totalEmpresas,
            'gender_stats' => json_encode($genderStats),
            'map_data' => json_encode($mapData),
            'rubro_stats' => json_encode($rubroStats)
        ];

        $this->view('reportes/index', $data);
    }
}

<?php
class Reportes extends Controller {
    public function __construct(){
        // Only Admin or maybe Empresa? User said "Admin... Reports" implies Admin.
        // Assuming Admin for now.
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

        // Process Department Data for Highmaps (sv-all.js)
        // Keys: sv-ah (Ahuachapan), sv-ca (Cabanas), sv-ch (Chalatenango), sv-cu (Cuscatlan), 
        // sv-li (La Libertad), sv-pa (La Paz), sv-un (La Union), sv-mo (Morazan), 
        // sv-sm (San Miguel), sv-ss (San Salvador), sv-sv (San Vicente), sv-sa (Santa Ana), 
        // sv-so (Sonsonate), sv-us (Usulutan)
        
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
                // Check if key already exists (aggregate if variations)
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

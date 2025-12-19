<?php require APPROOT . '/views/layouts/header.php'; ?>

<!-- Libraries -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/maps/modules/map.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/mapdata/countries/sv/sv-all.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<div class="container-fluid mb-5" id="report-container">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-0"><i class="fas fa-chart-line me-2 text-primary"></i>Reportes y Analíticas</h2>
            <p class="text-muted">Visualización de datos demográficos y métricas del sistema.</p>
        </div>
        <div>
            <div class="btn-group">
                <button onclick="exportPDF()" class="btn btn-danger shadow-sm"><i class="fas fa-file-pdf me-2"></i>Exportar PDF</button>
                <button onclick="exportExcel()" class="btn btn-success shadow-sm"><i class="fas fa-file-excel me-2"></i>Exportar Excel</button>
            </div>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm border-start border-4 border-primary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle text-primary me-3">
                            <i class="fas fa-user-graduate fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="text-muted text-uppercase mb-1 small fw-bold">Estudiantes Activos</h6>
                            <h2 class="mb-0 fw-bold text-dark"><?php echo $data['total_students']; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm border-start border-4 border-success h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle text-success me-3">
                            <i class="fas fa-briefcase fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="text-muted text-uppercase mb-1 small fw-bold">Pasantías Abiertas</h6>
                            <h2 class="mb-0 fw-bold text-dark"><?php echo $data['total_plazas']; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm border-start border-4 border-info h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle text-info me-3">
                            <i class="fas fa-building fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="text-muted text-uppercase mb-1 small fw-bold">Empresas Registradas</h6>
                            <h2 class="mb-0 fw-bold text-dark"><?php echo $data['total_empresas']; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 1: Map and Gender -->
    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <h5 class="fw-bold text-dark mb-0">Distribución Geográfica de Estudiantes</h5>
                </div>
                <div class="card-body">
                    <div id="map-container" style="height: 500px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
             <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <h5 class="fw-bold text-dark mb-0">Género</h5>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div id="gender-chart" style="height: 300px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 2: Companies -->
    <div class="row mb-4">
        <div class="col-12">
             <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                     <h5 class="fw-bold text-dark mb-0">Empresas por Rubro</h5>
                </div>
                <div class="card-body">
                    <div id="rubro-chart" style="height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Header/Logo for Print Only -->
    <div id="print-header" class="d-none">
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="<?php echo URLROOT; ?>/img/logo-completo.svg" style="height: 60px;">
            <h2 style="margin-top: 10px;">Reporte Ejecutivo SIGP</h2>
            <p>Generado el: <?php echo date('d/m/Y H:i'); ?></p>
        </div>
    </div>

</div>

<script>
    // Data Preparation
    const mapData = <?php echo $data['map_data']; ?>;
    const genderDataRaw = <?php echo $data['gender_stats']; ?>;
    const rubroDataRaw = <?php echo $data['rubro_stats']; ?>;

    // Process Pie Data
    const genderSeries = genderDataRaw.map(item => ({
        name: item.genero,
        y: parseInt(item.total)
    }));

    // Process Bar Data
    const rubroCategories = rubroDataRaw.map(item => item.rubro);
    const rubroSeries = rubroDataRaw.map(item => parseInt(item.total));

    document.addEventListener('DOMContentLoaded', function () {
        
        // 1. Highmaps El Salvador
        Highcharts.mapChart('map-container', {
            chart: { map: 'countries/sv/sv-all', backgroundColor: 'transparent' },
            title: { text: '' },
            mapNavigation: { enabled: true, buttonOptions: { verticalAlign: 'bottom' } },
            colorAxis: { min: 0, minColor: '#E6F3FF', maxColor: '#0056b3' },
            series: [{
                data: mapData,
                name: 'Estudiantes',
                states: { hover: { color: '#BADA55' } },
                dataLabels: { enabled: true, format: '{point.name}' }
            }]
        });

        // 2. Gender Pie Chart
        Highcharts.chart('gender-chart', {
            chart: { type: 'pie', backgroundColor: 'transparent' },
            title: { text: '' },
            tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>' },
            plotOptions: {
                pie: { allowPointSelect: true, cursor: 'pointer', dataLabels: { enabled: true, format: '<b>{point.name}</b>: {point.y}' }, showInLegend: true }
            },
            series: [{ name: 'Estudiantes', colorByPoint: true, data: genderSeries }]
        });

        // 3. Rubro Bar Chart
        Highcharts.chart('rubro-chart', {
            chart: { type: 'column', backgroundColor: 'transparent' },
            title: { text: '' },
            xAxis: { categories: rubroCategories, crosshair: true },
            yAxis: { min: 0, title: { text: 'Cantidad' } },
            tooltip: { headerFormat: '<span style="font-size:10px">{point.key}</span><table>', pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td><td style="padding:0"><b>{point.y}</b></td></tr>', footerFormat: '</table>', shared: true, useHTML: true },
            plotOptions: { column: { pointPadding: 0.2, borderWidth: 0 } },
            series: [{ name: 'Empresas', data: rubroSeries, color: '#17a2b8' }]
        });
    });

    // Export Functions
    function exportPDF() {
        const element = document.getElementById('report-container');
        const header = document.getElementById('print-header');
        
        // Show Header strictly for the clone or temporary
        // html2pdf is tricky with visibility. Better to prepend custom HTML in content.
        
        const opt = {
            margin:       0.5,
            filename:     'Reporte_SIGP_<?php echo date("Ymd"); ?>.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape' }
        };

        // Trick: Add header to container momentarily
        header.classList.remove('d-none');
        
        html2pdf().set(opt).from(element).save().then(() => {
             header.classList.add('d-none');
        });
    }

    function exportExcel() {
        // Collect Data
        let wb = XLSX.utils.book_new();
        
        // 1. Summary Sheet
        let summaryData = [
            ['Reporte General SIGP', ''],
            ['Fecha', '<?php echo date("d/m/Y"); ?>'],
            ['', ''],
            ['Métrica', 'Total'],
            ['Estudiantes Activos', <?php echo $data['total_students']; ?>],
            ['Pasantías Abiertas', <?php echo $data['total_plazas']; ?>],
            ['Empresas Registradas', <?php echo $data['total_empresas']; ?>]
        ];
        let wsSummary = XLSX.utils.aoa_to_sheet(summaryData);
        XLSX.utils.book_append_sheet(wb, wsSummary, "Resumen");

        // 2. Gender Sheet
        let genderData = [['Género', 'Cantidad']];
        genderDataRaw.forEach(g => genderData.push([g.genero, parseInt(g.total)]));
        let wsGender = XLSX.utils.aoa_to_sheet(genderData);
        XLSX.utils.book_append_sheet(wb, wsGender, "Género");

        // 3. Departments Sheet
        let mapDataArr = [['Código', 'Cantidad']]; // Map data is crude [code, val]
        mapData.forEach(m => mapDataArr.push(m));
        let wsMap = XLSX.utils.aoa_to_sheet(mapDataArr);
        XLSX.utils.book_append_sheet(wb, wsMap, "Ubicación");
        
        // 4. Rubros Sheet
        let rubroData = [['Rubro', 'Cantidad']];
        rubroDataRaw.forEach(r => rubroData.push([r.rubro, parseInt(r.total)]));
        let wsRubro = XLSX.utils.aoa_to_sheet(rubroData);
        XLSX.utils.book_append_sheet(wb, wsRubro, "Rubros Empresas");

        XLSX.writeFile(wb, 'Reporte_SIGP_Data.xlsx');
    }
</script>

<?php require APPROOT . '/views/layouts/footer.php'; ?>

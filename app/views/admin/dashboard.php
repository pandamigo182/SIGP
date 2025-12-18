<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row mb-4">
    <div class="col-md-12">
        <h1><i class="fas fa-tachometer-alt"></i> Dashboard Administrativo</h1>
        <p class="text-muted">Resumen de actividad del Sistema Integral de Gestión de Pasantías.</p>
    </div>
</div>

<div class="row mb-4">
    <!-- Active Internships -->
    <div class="col-md-3">
        <div class="card bg-primary text-white shadow h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-0">Pasantías Activas</h6>
                        <h2 class="display-4 fw-bold mb-0"><?php echo $data['activePasantias']; ?></h2>
                    </div>
                    <i class="fas fa-briefcase fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Students -->
    <div class="col-md-3">
        <div class="card bg-success text-white shadow h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-0">Estudiantes</h6>
                        <h2 class="display-4 fw-bold mb-0"><?php echo $data['totalStudents']; ?></h2>
                    </div>
                    <i class="fas fa-user-graduate fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Companies -->
    <div class="col-md-3">
        <div class="card bg-info text-white shadow h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-0">Empresas</h6>
                        <h2 class="display-4 fw-bold mb-0"><?php echo $data['totalCompanies']; ?></h2>
                    </div>
                    <i class="fas fa-building fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Plazas -->
    <div class="col-md-3">
        <div class="card bg-warning text-white shadow h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-0">Plazas Ofertadas</h6>
                        <h2 class="display-4 fw-bold mb-0"><?php echo $data['totalPlazas']; ?></h2>
                    </div>
                    <i class="fas fa-search-dollar fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12 mb-3">
        <h4 class="fw-bold text-secondary"><i class="fas fa-th-large me-2"></i>Módulos de Gestión</h4>
    </div>
    
    <!-- Module: Usuarios -->
    <div class="col-md-4 mb-4">
        <a href="<?php echo URLROOT; ?>/admin/users" class="text-decoration-none">
            <div class="card h-100 shadow-sm border-0 hover-scale">
                <div class="card-body text-center p-4">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-users-cog fa-2x"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Gestión de Usuarios</h5>
                    <p class="text-muted small mb-0">Administrar estudiantes, empresas, tutores y personal administrativo.</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Module: Empresas -->
    <div class="col-md-4 mb-4">
        <a href="<?php echo URLROOT; ?>/admin/empresas" class="text-decoration-none">
            <div class="card h-100 shadow-sm border-0 hover-scale">
                <div class="card-body text-center p-4">
                    <div class="bg-info bg-opacity-10 text-info rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-building fa-2x"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Gestión de Empresas</h5>
                    <p class="text-muted small mb-0">Verificar y administrar convenios y perfiles de empresas.</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Module: Plazas/Pasantías -->
    <div class="col-md-4 mb-4">
        <a href="<?php echo URLROOT; ?>/admin/plazas" class="text-decoration-none">
            <div class="card h-100 shadow-sm border-0 hover-scale">
                <div class="card-body text-center p-4">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-briefcase fa-2x"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Ofertas de Pasantías</h5>
                    <p class="text-muted small mb-0">Supervisar las plazas ofertadas y publicadas.</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Module: Bitácora -->
    <div class="col-md-4 mb-4">
        <a href="<?php echo URLROOT; ?>/admin/logs" class="text-decoration-none">
            <div class="card h-100 shadow-sm border-0 hover-scale">
                <div class="card-body text-center p-4">
                    <div class="bg-dark bg-opacity-10 text-dark rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-history fa-2x"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Bitácora de Sistema</h5>
                    <p class="text-muted small mb-0">Auditoría de acciones y seguridad.</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Module: Reportes -->
    <div class="col-md-4 mb-4">
        <a href="<?php echo URLROOT; ?>/reportes" class="text-decoration-none">
            <div class="card h-100 shadow-sm border-0 hover-scale">
                <div class="card-body text-center p-4">
                    <div class="bg-success bg-opacity-10 text-success rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-chart-line fa-2x"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Reportes y Estadísticas</h5>
                    <p class="text-muted small mb-0">Generar informes de gestión y resultados.</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4 mb-4">
        <a href="<?php echo URLROOT; ?>/admin/settings" class="text-decoration-none">
            <div class="card h-100 shadow-sm border-0 hover-scale">
                <div class="card-body text-center p-4">
                    <div class="bg-secondary bg-opacity-10 text-secondary rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-cogs fa-2x"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Configuración</h5>
                    <p class="text-muted small mb-0">Parámetros generales del sistema.</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Module: Certificados -->
    <div class="col-md-4 mb-4">
        <a href="<?php echo URLROOT; ?>/certificados/index" class="text-decoration-none">
            <div class="card h-100 shadow-sm border-0 hover-scale">
                <div class="card-body text-center p-4">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-certificate fa-2x"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Diplomas y Certificados</h5>
                    <p class="text-muted small mb-0">Gestionar plantillas de diplomas.</p>
                </div>
            </div>
        </a>
    </div>
</div>

<style>
    .hover-scale { transition: transform 0.2s; }
    .hover-scale:hover { transform: translateY(-5px); cursor: pointer; }
</style>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

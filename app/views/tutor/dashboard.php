<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12 mb-4">
            <h2 class="fw-bold text-dark"><i class="fas fa-chalkboard-teacher me-2"></i>Panel del Tutor Académico</h2>
            <p class="text-muted">Supervisa el progreso de tus estudiantes asignados.</p>
        </div>
    </div>

    <div class="row">
        <!-- Mis Estudiantes -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-light p-3 rounded-circle me-3">
                            <i class="fas fa-user-graduate fa-2x text-primary"></i>
                        </div>
                        <h4 class="card-title mb-0">Mis Estudiantes</h4>
                    </div>
                    <p class="card-text text-muted">Listado de estudiantes actualmente bajo tu supervisión.</p>
                    <a href="#" class="btn btn-primary rounded-pill">Ver Listado</a>
                </div>
            </div>
        </div>

        <!-- Revisiones Pendientes -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-light p-3 rounded-circle me-3">
                            <i class="fas fa-clipboard-check fa-2x text-warning"></i>
                        </div>
                        <h4 class="card-title mb-0">Reportes Pendientes</h4>
                    </div>
                    <p class="card-text text-muted">Revisa las actividades semanales de tus estudiantes.</p>
                    <a href="<?php echo URLROOT; ?>/reportes/index" class="btn btn-warning rounded-pill text-dark">Ir a Revisiones</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12 mb-4">
            <h2 class="fw-bold text-danger"><i class="fas fa-shield-alt me-2"></i>Panel de Administrador</h2>
            <p class="text-muted">Control total del sistema y configuración.</p>
        </div>
    </div>

    <div class="row">
        <!-- Usuarios -->
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                    <div class="mb-3 text-primary">
                        <i class="fas fa-users-cog fa-3x"></i>
                    </div>
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-text small text-muted">Administrar todos los usuarios y roles.</p>
                    <a href="<?php echo URLROOT; ?>/admin/users" class="btn btn-primary w-100 rounded-pill">Gestionar</a>
                </div>
            </div>
        </div>

        <!-- Empresas -->
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                    <div class="mb-3 text-secondary">
                        <i class="fas fa-building fa-3x"></i>
                    </div>
                    <h5 class="card-title">Empresas</h5>
                    <p class="card-text small text-muted">Gestión específica de empresas.</p>
                    <a href="<?php echo URLROOT; ?>/admin/empresas" class="btn btn-outline-secondary w-100 rounded-pill">Ver Empresas</a>
                </div>
            </div>
        </div>

        <!-- Pasantias -->
        <div class="col-md-3 mb-4">
             <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                    <div class="mb-3 text-warning">
                        <i class="fas fa-file-contract fa-3x"></i>
                    </div>
                    <h5 class="card-title">Pasantías</h5>
                    <p class="card-text small text-muted">Gestión de pasantías.</p>
                    <a href="<?php echo URLROOT; ?>/pasantias" class="btn btn-outline-warning w-100 rounded-pill">Gestionar</a>
                </div>
            </div>
        </div>

        <!-- Configuración -->
        <div class="col-md-3 mb-4">
             <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                    <div class="mb-3 text-dark">
                        <i class="fas fa-cogs fa-3x"></i>
                    </div>
                    <h5 class="card-title">Configuración</h5>
                    <p class="card-text small text-muted">Ajustes generales del sistema.</p>
                    <a href="<?php echo URLROOT; ?>/admin/settings" class="btn btn-outline-dark w-100 rounded-pill">Ajustes</a>
                </div>
            </div>
        </div>

        <!-- Logs/Reportes -->
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                    <div class="mb-3 text-success">
                        <i class="fas fa-file-alt fa-3x"></i>
                    </div>
                    <h5 class="card-title">Logs System</h5>
                    <p class="card-text small text-muted">Ver actividad reciente.</p>
                    <a href="<?php echo URLROOT; ?>/admin/logs" class="btn btn-outline-success w-100 rounded-pill">Ver Logs</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

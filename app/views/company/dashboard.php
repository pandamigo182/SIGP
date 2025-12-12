<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12 mb-4">
            <h2 class="fw-bold text-dark"><i class="fas fa-briefcase me-2"></i>Panel de Empresa</h2>
            <p class="text-muted">Gestiona tus ofertas de pasantía y evalúa a los candidatos.</p>
        </div>
    </div>

    <div class="row">
        <!-- Nueva Plaza -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0 bg-primary text-white">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-plus-circle fa-4x text-white-50"></i>
                    </div>
                    <h4 class="card-title">Publicar Plaza</h4>
                    <p class="card-text">Crea una nueva oferta de pasantía para los estudiantes.</p>
                    <a href="<?php echo URLROOT; ?>/plazas/add" class="btn btn-light rounded-pill px-4 text-primary fw-bold">Crear Oferta</a>
                </div>
            </div>
        </div>

        <!-- Mis Plazas -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                    <div class="mb-3 text-primary">
                        <i class="fas fa-list-alt fa-3x"></i>
                    </div>
                    <h5 class="card-title">Mis Publicaciones</h5>
                    <p class="card-text text-muted">Administra tus ofertas activas y cerradas.</p>
                    <a href="<?php echo URLROOT; ?>/plazas/manage" class="btn btn-outline-primary w-100 rounded-pill">Ver Listado</a>
                </div>
            </div>
        </div>

        <!-- Candidatos -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                    <div class="mb-3 text-success">
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                    <h5 class="card-title">Candidatos</h5>
                    <p class="card-text text-muted">Revisa las postulaciones recibidas.</p>
                    <a href="<?php echo URLROOT; ?>/plazas/manage" class="btn btn-outline-success w-100 rounded-pill">Ver Candidatos</a>
                </div>
            </div>
        </div>

        <!-- Mi Empresa (Perfil) -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                    <div class="mb-3 text-warning">
                        <i class="fas fa-building fa-3x"></i>
                    </div>
                    <h5 class="card-title">Mi Empresa</h5>
                    <p class="card-text text-muted">Gestiona el perfil, logo y ubicación.</p>
                    <a href="<?php echo URLROOT; ?>/empresas/profile" class="btn btn-outline-warning w-100 rounded-pill">Editar Perfil</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

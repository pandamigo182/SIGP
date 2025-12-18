<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="container d-flex flex-column justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="text-center">
        <h1 class="display-1 fw-bold text-primary">404</h1>
        <h2 class="mb-4">Página no encontrada</h2>
        <p class="lead text-muted mb-5">Lo sentimos, la página que estás buscando no existe o ha sido movida.</p>
        <a href="<?php echo URLROOT; ?>" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm">
            <i class="fas fa-home me-2"></i>Volver al Inicio
        </a>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>

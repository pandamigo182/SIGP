<?php require APPROOT . '/views/layouts/header.php'; ?>

<!-- Hero Section -->
<div class="hero-section text-center">
    <h1 class="display-4 mb-3"><?php echo $data['title']; ?></h1>
    <p class="lead text-muted mb-4"><?php echo $data['description']; ?></p>
    <?php if(!isset($_SESSION['user_id'])) : ?>
        <div class="d-flex justify-content-center gap-3">
            <a class="btn btn-primary btn-lg shadow-sm" href="<?php echo URLROOT; ?>/auth/login" role="button">
                <i class="fas fa-sign-in-alt me-2"></i>Ingresar
            </a>
            <a class="btn btn-outline-secondary btn-lg shadow-sm" href="<?php echo URLROOT; ?>/auth/register" role="button">
                <i class="fas fa-user-plus me-2"></i>Registrarse
            </a>
        </div>
    <?php else : ?>
        <a class="btn btn-primary btn-lg shadow-sm" href="<?php echo URLROOT; ?>/dashboard" role="button">
            <i class="fas fa-tachometer-alt me-2"></i>Ir a mi Dashboard
        </a>
    <?php endif; ?>
</div>

<!-- Section: Plazas Disponibles -->
<div class="container mb-5">
    <div class="row mb-4">
        <div class="col-md-12 text-center">
            <h2 class="fw-bold text-dark"><i class="fas fa-briefcase me-2"></i>Últimas Ofertas de Pasantía</h2>
            <p class="text-muted">Explora las oportunidades más recientes publicadas por nuestras empresas aliadas.</p>
        </div>
    </div>

    <div class="row">
        <?php if(empty($data['plazas'])) : ?>
            <div class="col-md-12">
                <div class="alert alert-secondary text-center p-4 rounded-3" role="alert">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <h4>Aún no hay plazas publicadas.</h4>
                    <p>Mantente atento, las empresas publicarán nuevas oportunidades pronto.</p>
                </div>
            </div>
        <?php else : ?>
            <?php foreach($data['plazas'] as $plaza) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card card-plaza h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $plaza->titulo; ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <i class="fas fa-building me-1"></i> <?php echo $plaza->nombre; // Nombre empresa ?>
                            </h6>
                            <p class="card-text text-truncate" style="max-height: 4.5em; overflow: hidden;">
                                <?php echo substr($plaza->descripcion, 0, 100) . '...'; ?>
                            </p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="badge badge-custom">
                                    <i class="far fa-clock me-1"></i> <?php echo date('d/m/Y', strtotime($plaza->fechaPublicacion)); ?>
                                </span>
                                <a href="<?php echo URLROOT; ?>/plazas/show/<?php echo $plaza->plazaId; ?>" class="btn btn-outline-primary btn-sm">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>

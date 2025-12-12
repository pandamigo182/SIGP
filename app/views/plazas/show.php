<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-md-10 mx-auto mt-4">
        <a href="<?php echo URLROOT; ?>/pages/index" class="btn btn-outline-secondary mb-3"><i class="fas fa-arrow-left"></i> Volver a Oportunidades</a>
        
        <?php flash('plaza_message'); ?>

        <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
            <div class="card-header bg-primary text-white p-4">
                <h2 class="mb-0 fw-bold"><?php echo $data['plaza']->titulo; ?></h2>
                <span class="badge bg-light text-primary mt-2">Publicado: <?php echo date('d/m/Y', strtotime($data['plaza']->created_at)); ?></span>
            </div>
            <div class="card-body p-5">
                <div class="alert alert-light border-start border-4 border-primary shadow-sm mb-4">
                    <h5 class="text-primary fw-bold"><i class="fas fa-bullhorn me-2"></i>Descripción del Puesto</h5>
                    <p class="mb-0 text-muted" style="white-space: pre-wrap;"><?php echo $data['plaza']->descripcion; ?></p>
                </div>

                <div class="alert alert-light border-start border-4 border-info shadow-sm mb-4">
                     <h5 class="text-info fw-bold"><i class="fas fa-check-circle me-2"></i>Requisitos</h5>
                     <p class="mb-0 text-muted" style="white-space: pre-wrap;"><?php echo $data['plaza']->requisitos; ?></p>
                </div>

                <div class="row text-center mt-5">
                    <?php if(!isLoggedIn()): ?>
                        <div class="col-12">
                            <div class="alert alert-warning">
                                Debes <a href="<?php echo URLROOT; ?>/auth/login" class="fw-bold text-dark">iniciar sesión</a> como Estudiante para postularte.
                            </div>
                        </div>
                    <?php elseif($_SESSION['user_role'] == 5): // Estudiante ?>
                        <div class="col-12">
                            <?php if($data['yaAplico']): ?>
                                <button class="btn btn-success btn-lg disabled w-50 rounded-pill"><i class="fas fa-check-double"></i> Ya te has postulado</button>
                            <?php else: ?>
                                <form action="<?php echo URLROOT; ?>/plazas/apply/<?php echo $data['plaza']->id; ?>" method="post">
                                    <button type="submit" class="btn btn-primary btn-lg w-50 rounded-pill shadow-lg hover-effect">
                                        <i class="fas fa-paper-plane me-2"></i> Postularme Ahora
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="col-12 text-muted">
                            <small>Vista de detalle (Modo: <?php echo $_SESSION['user_name']; ?>)</small>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-footer bg-light p-3 text-center text-muted">
                Cierre de convocatoria: <strong><?php echo date('d/m/Y', strtotime($data['plaza']->fecha_limite)); ?></strong>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row mb-3">
    <div class="col-md-6">
        <h1>Mis Plazas Publicadas</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/plazas/add" class="btn btn-primary float-end">
            <i class="fas fa-plus"></i> Nueva Plaza
        </a>
    </div>
</div>

<?php flash('plaza_message'); ?>

<div class="row">
    <?php if(empty($data['plazas'])) : ?>
        <div class="col-md-12">
            <div class="alert alert-info">No tienes plazas activas. ¡Crea una nueva!</div>
        </div>
    <?php else: ?>
        <?php foreach($data['plazas'] as $plaza) : ?>
            <div class="col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <span class="badge <?php echo ($plaza->estado == 'abierta') ? 'bg-success' : 'bg-secondary'; ?>">
                            <?php echo ucfirst($plaza->estado); ?>
                        </span>
                        <small class="text-muted">Publicado: <?php echo date('d/m/Y', strtotime($plaza->created_at)); ?></small>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $plaza->titulo; ?></h4>
                        <p class="card-text text-truncate"><?php echo $plaza->descripcion; ?></p>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="<?php echo URLROOT; ?>/plazas/edit/<?php echo $plaza->id; ?>" class="btn btn-secondary btn-sm">Editar</a>
                            <a href="<?php echo URLROOT; ?>/plazas/applicants/<?php echo $plaza->id; ?>" class="btn btn-info btn-sm text-white">
                                <i class="fas fa-users"></i> Ver Postulantes
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

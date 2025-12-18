<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row mb-3">
    <div class="col-md-6">
        <h1>Mis Postulaciones</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow border-0">
            <div class="card-body">
                <?php if(empty($data['postulaciones'])): ?>
                    <p class="text-center text-muted">No te has postulado a ninguna pasantía aún.</p>
                    <div class="text-center">
                        <a href="<?php echo URLROOT; ?>/plazas" class="btn btn-primary">Ver Plazas Disponibles</a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Plaza</th>
                                    <th>Empresa</th>
                                    <th>Fecha Aplicación</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data['postulaciones'] as $postulacion): ?>
                                    <tr>
                                        <td><?php echo $postulacion->plaza_titulo; ?></td>
                                        <td><?php echo $postulacion->empresa_nombre; ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($postulacion->created_at)); ?></td>
                                        <td>
                                            <?php 
                                            // Badges de estado
                                            $estado = strtolower($postulacion->estado);
                                            $badgeClass = 'bg-secondary';
                                            if($estado == 'aceptado') $badgeClass = 'bg-success';
                                            if($estado == 'rechazado') $badgeClass = 'bg-danger';
                                            if($estado == 'pendiente') $badgeClass = 'bg-warning text-dark';
                                            ?>
                                            <span class="badge <?php echo $badgeClass; ?>"><?php echo ucfirst($postulacion->estado); ?></span>
                                        </td>
                                        <td>
                                            <a href="<?php echo URLROOT; ?>/plazas/show/<?php echo $postulacion->plaza_id; ?>" class="btn btn-sm btn-outline-primary">Ver Plaza</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>

<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="row">
    <div class="col-md-12">
        <h2 class="mb-4 text-primary fw-bold"><i class="fas fa-user-graduate me-2"></i> Gestión de Pasantías</h2>
        <?php flash('pasantia_message'); ?>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <?php if(empty($data['pasantias'])): ?>
                    <div class="alert alert-info py-4 text-center">
                        <i class="fas fa-info-circle fa-2x mb-3"></i>
                        <h5>No tienes pasantes activos actualmente</h5>
                        <p>Cuando aceptes postulaciones en tus Plazas, aparecerán aquí.</p>
                        <a href="<?php echo URLROOT; ?>/plazas/manage" class="btn btn-primary mt-2">Ir a mis Plazas</a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th>Estudiante</th>
                                    <th>Proyecto / Plaza</th>
                                    <th>Fecha Inicio</th>
                                    <th>Estado</th>
                                    <th class="text-end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data['pasantias'] as $pasantia): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                    <span class="fw-bold"><?php echo substr($pasantia->nombre_estudiante, 0, 1); ?></span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 fw-bold"><?php echo $pasantia->nombre_estudiante; ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?php echo $pasantia->proyecto_asociado; ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($pasantia->fecha_inicio)); ?></td>
                                        <td>
                                            <?php if($pasantia->estado == 'activa' || $pasantia->estado == 'Activa' || $pasantia->estado == 'aceptado'): ?>
                                                <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> Activa</span>
                                            <?php elseif($pasantia->estado == 'finalizada'): ?>
                                                <span class="badge bg-secondary"><i class="fas fa-flag-checkered me-1"></i> Finalizada</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning text-dark"><?php echo $pasantia->estado; ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-end">
                                            <?php if($pasantia->estado == 'activa' || $pasantia->estado == 'Activa' || $pasantia->estado == 'aceptado'): ?>
                                                <a href="<?php echo URLROOT; ?>/pasantias/finalize/<?php echo $pasantia->id; ?>" class="btn btn-danger btn-sm rounded-pill shadow-sm" onclick="return confirm('¿Estás seguro de querer finalizar esta pasantía? Se requerirá una evaluación final.');">
                                                    <i class="fas fa-flag-checkered me-1"></i> Finalizar Estadia
                                                </a>
                                            <?php else: ?>
                                                <button class="btn btn-secondary btn-sm rounded-pill" disabled>Finalizado</button>
                                            <?php endif; ?>
                                            
                                            <!-- Future: Link to Weekly Reports -->
                                            <!-- <a href="#" class="btn btn-outline-primary btn-sm rounded-pill ms-1"><i class="fas fa-book"></i> Bitácoras</a> -->
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

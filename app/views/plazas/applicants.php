<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-md-12 mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="<?php echo URLROOT; ?>/plazas/manage" class="btn btn-outline-secondary btn-sm mb-2"><i class="fas fa-arrow-left"></i> Volver</a>
                <h3>Candidatos para: <span class="text-primary"><?php echo $data['plaza']->titulo; ?></span></h3>
            </div>
            <span class="badge bg-info text-dark"><?php echo count($data['candidatos']); ?> Postulantes</span>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <?php if(empty($data['candidatos'])): ?>
                    <p class="text-center text-muted py-5">Aún no hay postulantes para esta plaza.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Nombre Estudiante</th>
                                    <th>Email</th>
                                    <th>Fecha Postulación</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data['candidatos'] as $candidato): ?>
                                    <tr>
                                        <td class="fw-bold"><?php echo $candidato->nombreEstudiante; ?></td>
                                        <td><a href="mailto:<?php echo $candidato->emailEstudiante; ?>"><?php echo $candidato->emailEstudiante; ?></a></td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($candidato->fechaPostulacion)); ?></td>
                                        <td>
                                            <span class="badge <?php echo ($candidato->estado == 'pendiente') ? 'bg-warning' : (($candidato->estado == 'aceptado') ? 'bg-success' : 'bg-danger'); ?>">
                                                <?php echo ucfirst($candidato->estado); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <!-- Botones para aceptar/rechazar -->
                                            <?php if($candidato->estado == 'pendiente'): ?>
                                                <a href="<?php echo URLROOT; ?>/plazas/accept_applicant/<?php echo $data['plaza']->id; ?>/<?php echo $candidato->postulacionId; ?>" class="btn btn-sm btn-outline-success" onclick="return confirm('¿Estás seguro de aceptar a este candidato?');"><i class="fas fa-check"></i></a>
                                                <a href="<?php echo URLROOT; ?>/plazas/reject_applicant/<?php echo $data['plaza']->id; ?>/<?php echo $candidato->postulacionId; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Estás seguro de rechazar a este candidato?');"><i class="fas fa-times"></i></a>
                                            <?php else: ?>
                                                <span class="text-muted"><small>Procesado</small></span>
                                            <?php endif; ?>
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

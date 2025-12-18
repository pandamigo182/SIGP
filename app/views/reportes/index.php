<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row mb-4">
    <div class="col-md-8">
        <h1>Bitácora Académica</h1>
        <p class="text-muted">
            Pasantía: <strong><?php echo $data['pasantia']->nombre_empresa; ?></strong> <br>
            Supervisor: <span class="badge bg-secondary">Pendiente</span> <!-- TODO: Add Supervisor Name -->
        </p>
    </div>
    <div class="col-md-4 text-end">
        <a href="<?php echo URLROOT; ?>/reportes/create" class="btn btn-success"><i class="fas fa-plus"></i> Nuevo Reporte</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow border-0">
            <div class="card-body">
                <?php if(empty($data['reportes'])): ?>
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-book fa-3x mb-3"></i>
                        <p>No has enviado ningún reporte todavía.</p>
                        <a href="<?php echo URLROOT; ?>/reportes/create" class="btn btn-outline-primary">Comenzar Bitácora</a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Semana</th>
                                    <th>Título</th>
                                    <th>Fecha Envío</th>
                                    <th>Adjunto</th>
                                    <th>Estado / Feedback</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data['reportes'] as $reporte): ?>
                                    <tr>
                                        <td class="text-center fw-bold">#<?php echo $reporte->semana; ?></td>
                                        <td>
                                            <strong><?php echo $reporte->titulo; ?></strong><br>
                                            <small class="text-muted"><?php echo substr($reporte->contenido, 0, 50) . '...'; ?></small>
                                        </td>
                                        <td><?php echo date('d/m/Y', strtotime($reporte->created_at)); ?></td>
                                        <td>
                                            <?php if($reporte->archivo_adjunto): ?>
                                                <a href="<?php echo URLROOT . '/' . $reporte->archivo_adjunto; ?>" target="_blank" class="btn btn-sm btn-outline-info">
                                                    <i class="fas fa-paperclip"></i> Ver
                                                </a>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($reporte->retroalimentacion): ?>
                                                <div class="alert alert-info p-1 mb-0 small">
                                                    <i class="fas fa-comment"></i> <?php echo $reporte->retroalimentacion; ?>
                                                </div>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Sin revisión</span>
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

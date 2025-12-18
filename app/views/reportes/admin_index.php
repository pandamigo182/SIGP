<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row mb-3">
    <div class="col-md-6">
        <h1>Reportes de Pasantía</h1>
    </div>
    <div class="col-md-6 text-end">
        <a href="<?php echo URLROOT; ?>/dashboard" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <?php if(empty($data['reportes'])): ?>
            <p class="text-center p-3">No hay reportes enviados aún.</p>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Estudiante</th>
                        <th>Semana</th>
                        <th>Título</th>
                        <th>Fecha Envío</th>
                        <th>Retroalimentación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['reportes'] as $reporte): ?>
                        <tr>
                            <td><?php echo $reporte->estudiante_nombre; ?></td>
                            <td>Semana <?php echo $reporte->semana; ?></td>
                            <td><?php echo $reporte->titulo; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($reporte->created_at)); ?></td>
                            <td>
                                <?php if($reporte->retroalimentacion): ?>
                                    <span class="badge bg-success">Revisado</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($reporte->archivo_adjunto): ?>
                                    <a href="<?php echo URLROOT . '/' . $reporte->archivo_adjunto; ?>" class="btn btn-sm btn-info" target="_blank" title="Ver Archivo">
                                        <i class="fas fa-file-download"></i>
                                    </a>
                                <?php endif; ?>
                                <!-- Add feedback modal trigger here if implemented -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>

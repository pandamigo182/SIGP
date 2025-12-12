<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Mis Reportes de Pasantía</h2>
        <a href="<?php echo URLROOT; ?>/reportes/create" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Nuevo Reporte</a>
    </div>

    <?php flash('reporte_message'); ?>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <?php if(empty($data['reportes'])): ?>
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-file-alt fa-3x mb-3"></i>
                    <p>No has enviado ningún reporte aún.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Título</th>
                                <th>Horas</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['reportes'] as $reporte): ?>
                                <tr>
                                    <td><?php echo date('d/m/Y', strtotime($reporte->created_at)); ?></td>
                                    <td class="fw-bold"><?php echo $reporte->titulo; ?></td>
                                    <td><?php echo $reporte->horas_registradas; ?> hrs</td>
                                    <td>
                                        <span class="badge bg-secondary">Enviado</span>
                                        <!-- Aquí luego pondremos si fue revisado -->
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-info"><i class="fas fa-eye"></i></a>
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
<?php require APPROOT . '/views/layouts/footer.php'; ?>

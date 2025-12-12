<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-chalkboard-teacher me-2"></i>Supervisión de Reportes</h2>
        <a href="<?php echo URLROOT; ?>/dashboard" class="btn btn-outline-secondary">Volver al Panel</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <?php if(empty($data['reportes'])): ?>
                <div class="alert alert-info">No hay reportes enviados por estudiantes recientemente.</div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Estudiante</th>
                                <th>Título Reporte</th>
                                <th>Fecha</th>
                                <th>Horas</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['reportes'] as $reporte): ?>
                                <tr>
                                    <td class="fw-bold"><?php echo $reporte->nombreEstudiante; ?></td>
                                    <td><?php echo $reporte->titulo; ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($reporte->fechaReporte)); ?></td>
                                    <td><span class="badge bg-light text-dark border"><?php echo $reporte->horas_registradas; ?> hrs</span></td>
                                    <td>
                                        <a href="<?php echo URLROOT; ?>/reportes/show/<?php echo $reporte->reporteId; ?>" class="btn btn-sm btn-primary" title="Ver Detalles"><i class="fas fa-eye"></i> Revisar</a>
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

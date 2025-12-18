<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row mb-3">
    <div class="col-md-12">
        <h1><i class="fas fa-chalkboard-teacher"></i> Portal del Tutor</h1>
        <p class="text-muted">Gestione los estudiantes asignados y revise sus bitácoras semanales.</p>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0">Mis Estudiantes Asignados</h5>
            </div>
            <div class="card-body">
                <?php if(empty($data['pasantias'])): ?>
                    <p class="text-muted text-center py-5">No tiene estudiantes asignados o activos actualmente.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Estudiante</th>
                                    <th>Empresa</th>
                                    <th>Proyecto</th>
                                    <th>Fecha Inicio</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data['pasantias'] as $pasantia): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle me-2 bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; border-radius: 50%;">
                                                    <?php echo strtoupper(substr($pasantia->nombre_estudiante, 0, 1)); ?>
                                                </div>
                                                <strong><?php echo $pasantia->nombre_estudiante; ?></strong>
                                            </div>
                                        </td>
                                        <td><?php echo $pasantia->nombre_empresa; ?></td>
                                        <td><?php echo $pasantia->proyecto_asociado; ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($pasantia->fecha_inicio)); ?></td>
                                        <td>
                                            <a href="<?php echo URLROOT; ?>/tutor/view_reports/<?php echo $pasantia->id; ?>" class="btn btn-primary btn-sm">
                                                <i class="fas fa-book-open"></i> Revisar Bitácora
                                            </a>
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

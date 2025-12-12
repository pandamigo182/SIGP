<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2><i class="fas fa-file-contract me-2"></i>Gestión de Pasantías</h2>
        <a href="<?php echo URLROOT; ?>/pasantias/add" class="btn btn-primary"><i class="fas fa-plus"></i> Nueva Pasantía</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Estudiante</th>
                            <th>Empresa</th>
                            <th>Proyecto</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($data['pasantias'])): ?>
                            <tr>
                                <td colspan="5" class="text-center p-4 text-muted">No hay pasantías registradas.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($data['pasantias'] as $pasantia): ?>
                                <tr>
                                    <td>
                                        <div class="fw-bold"><?php echo $pasantia->nombre_estudiante; ?></div>
                                    </td>
                                    <td>
                                        <?php echo $pasantia->nombre_empresa; ?>
                                        <br>
                                        <small class="text-muted"><?php echo $pasantia->nombre_institucion; ?></small>
                                    </td>
                                    <td><?php echo $pasantia->proyecto_asociado; ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo ($pasantia->estado == 'Activa' ? 'success' : 'secondary'); ?>">
                                            <?php echo $pasantia->estado; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="mt-3">
        <a href="<?php echo URLROOT; ?>/dashboard" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

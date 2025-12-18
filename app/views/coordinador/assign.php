<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row mb-3">
    <div class="col-md-6">
        <h1>Asignación de Tutores</h1>
        <p class="text-muted">Asigne un Tutor Académico a las pasantías activas.</p>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow border-0">
            <div class="card-body">
                <?php if(empty($data['pasantias'])): ?>
                    <p class="text-center text-muted">No hay pasantías activas pendientes de asignación.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Estudiante</th>
                                    <th>Empresa</th>
                                    <th>Fecha Inicio</th>
                                    <th>Tutor Actual</th>
                                    <th>Asignar Nuevo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data['pasantias'] as $pasantia): ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo $pasantia->nombre_estudiante; ?></strong>
                                        </td>
                                        <td><?php echo $pasantia->nombre_empresa; ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($pasantia->fecha_inicio)); ?></td>
                                        <td>
                                            <?php if($pasantia->nombre_tutor): ?>
                                                <span class="badge bg-success"><?php echo $pasantia->nombre_tutor; ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Sin Asignar</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <form action="<?php echo URLROOT; ?>/coordinador/procesar_asignacion" method="post" class="d-flex gap-2">
                                                <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
                                                <input type="hidden" name="pasantia_id" value="<?php echo $pasantia->id; ?>">
                                                
                                                <select name="tutor_id" class="form-select form-select-sm" required>
                                                    <option value="">Seleccionar...</option>
                                                    <?php foreach($data['tutores'] as $tutor): ?>
                                                        <option value="<?php echo $tutor->id; ?>" <?php echo ($pasantia->tutor_id == $tutor->id) ? 'selected' : ''; ?>>
                                                            <?php echo $tutor->nombre; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                                            </form>
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

<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-md-8 mx-auto mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">
                <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Registrar Pasantía</h4>
            </div>
            <div class="card-body">
                <form action="<?php echo URLROOT; ?>/pasantias/add" method="post">
                    <div class="mb-3">
                        <label>Estudiante:</label>
                        <select name="estudiante_id" class="form-select" required>
                            <option value="">-- Seleccionar --</option>
                            <?php foreach($data['students'] as $student): ?>
                                <option value="<?php echo $student->id; ?>"><?php echo $student->nombre; ?> (<?php echo $student->email; ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Empresa:</label>
                            <select name="empresa_id" class="form-select" required>
                                <option value="">-- Seleccionar --</option>
                                <?php foreach($data['empresas'] as $empresa): ?>
                                    <option value="<?php echo $empresa->id; ?>"><?php echo $empresa->nombre; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                         <div class="col-md-6 mb-3">
                            <label>Institución:</label>
                             <select name="institucion_id" class="form-select">
                                <option value="">-- Seleccionar (Opcional) --</option>
                                <?php if(isset($data['instituciones'])): ?>
                                    <?php foreach($data['instituciones'] as $inst): ?>
                                        <option value="<?php echo $inst->id; ?>"><?php echo $inst->nombre; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Proyecto Asociado:</label>
                        <input type="text" name="proyecto" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                         <label>Tutor Empresarial:</label>
                         <select name="tutor_id" class="form-select">
                            <option value="">-- Seleccionar --</option>
                             <?php foreach($data['tutors'] as $tutor): ?>
                                <option value="<?php echo $tutor->id; ?>"><?php echo $tutor->nombre; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Fecha Inicio:</label>
                            <input type="date" name="fecha_inicio" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Fecha Fin:</label>
                            <input type="date" name="fecha_fin" class="form-control">
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">Registrar Pasantía</button>
                        <a href="<?php echo URLROOT; ?>/pasantias" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

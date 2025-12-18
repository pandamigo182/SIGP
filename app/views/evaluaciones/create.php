<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0 mt-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Evaluación Final de Pasantía</h4>
            </div>
            <div class="card-body">
                <p>Estudiante: <strong><?php echo $data['pasantia']->nombre_estudiante; ?></strong></p>
                <p class="text-muted">Por favor califique el desempeño del pasante en las siguientes áreas (1-10).</p>
                
                <form action="<?php echo URLROOT; ?>/evaluaciones/evaluar/<?php echo $data['pasantia']->id; ?>" method="post">
                    <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Responsabilidad</label>
                            <input type="number" name="responsabilidad" class="form-control" min="1" max="10" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Conocimientos</label>
                            <input type="number" name="conocimientos" class="form-control" min="1" max="10" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Trabajo en Equipo</label>
                            <input type="number" name="trabajo_equipo" class="form-control" min="1" max="10" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Comentarios Finales</label>
                        <textarea name="comentarios" class="form-control" rows="4" placeholder="Observaciones generales sobre el pasante..."></textarea>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg" onclick="return confirm('¿Está seguro? Al enviar esta evaluación, la pasantía se marcará como FINALIZADA.');">
                            <i class="fas fa-check-circle"></i> Enviar Evaluación y Finalizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

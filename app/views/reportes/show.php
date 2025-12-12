<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-md-8 mx-auto mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="<?php echo URLROOT; ?>/reportes/index" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
            <span class="badge bg-primary">Semana: <?php echo $data['reporte']->titulo; ?></span>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h4 class="mb-0">Detalle del Reporte</h4>
                <small class="text-muted">Enviado por: <strong><?php echo $data['estudiante']->nombre; ?></strong> el <?php echo date('d/m/Y H:i', strtotime($data['reporte']->created_at)); ?></small>
            </div>
            <div class="card-body">
                <h5 class="text-primary mb-3">Actividades Realizadas</h5>
                <div class="p-3 bg-light rounded text-dark">
                    <?php echo nl2br($data['reporte']->descripcion); ?>
                </div>
                
                <hr>
                
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="alert alert-info py-2">
                            <i class="fas fa-clock me-2"></i><strong>Horas Registradas:</strong> <?php echo $data['reporte']->horas_registradas; ?> hrs
                        </div>
                    </div>
                    <?php if(!empty($data['reporte']->archivo_adjunto)): ?>
                    <div class="col-md-6">
                        <div class="alert alert-secondary py-2">
                            <i class="fas fa-paperclip me-2"></i><strong>Archivo:</strong> <a href="#">Descargar Adjunto</a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if($_SESSION['user_role'] == 3 || $_SESSION['user_role'] == 2): // Tutor o Coord ?>
                    <hr>
                    <h5>Evaluación del Reporte</h5>
                    <form action="#" method="post">
                        <div class="form-group mb-3">
                            <label>Comentarios / Retroalimentación:</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <button type="button" class="btn btn-success"><i class="fas fa-check"></i> Aprobar Horas</button>
                        <button type="button" class="btn btn-danger"><i class="fas fa-times"></i> Rechazar</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

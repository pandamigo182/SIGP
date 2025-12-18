<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row mb-3">
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/tutor/index" class="btn btn-light"><i class="fas fa-arrow-left"></i> Volver</a>
    </div>
    <div class="col-md-6 text-end">
        <h4><?php echo $data['pasantia']->nombre_estudiante; ?></h4>
        <span class="badge bg-secondary"><?php echo $data['pasantia']->nombre_empresa; ?></span>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php foreach($data['reportes'] as $reporte): ?>
            <div class="card mb-3 shadow-sm border-0">
                <div class="card-header d-flex justify-content-between align-items-center <?php echo ($reporte->estado == 'pendiente') ? 'bg-warning bg-opacity-10' : 'bg-success bg-opacity-10'; ?>">
                    <strong>Semana <?php echo $reporte->semana; ?>: <?php echo $reporte->titulo; ?></strong>
                    <small class="text-muted"><?php echo date('d/m/Y H:i', strtotime($reporte->created_at)); ?></small>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo nl2br($reporte->contenido); ?></p>
                    
                    <?php if($reporte->archivo_adjunto): ?>
                        <div class="mb-3">
                            <a href="<?php echo URLROOT . '/' . $reporte->archivo_adjunto; ?>" target="_blank" class="btn btn-outline-info btn-sm">
                                <i class="fas fa-paperclip"></i> Ver Archivo Adjunto
                            </a>
                        </div>
                    <?php endif; ?>

                    <hr>

                    <form action="<?php echo URLROOT; ?>/tutor/save_feedback" method="post">
                        <input type="hidden" name="reporte_id" value="<?php echo $reporte->id; ?>">
                        <input type="hidden" name="pasantia_id" value="<?php echo $data['pasantia']->id; ?>">
                        
                        <div class="mb-2">
                            <label class="form-label fw-bold"><i class="fas fa-comment-dots"></i> Retroalimentación del Tutor</label>
                            <textarea name="retroalimentacion" class="form-control" rows="2" placeholder="Escriba sus comentarios aquí..."><?php echo $reporte->retroalimentacion; ?></textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success btn-sm">Guardar Revisión</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>

        <?php if(empty($data['reportes'])): ?>
            <div class="alert alert-info text-center">
                El estudiante aún no ha enviado reportes.
            </div>
        <?php endif; ?>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

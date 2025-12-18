<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row mb-3">
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/reportes/index" class="btn btn-light"><i class="fas fa-arrow-left"></i> Volver al historial</a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Nuevo Reporte Semanal</h3>
                
                <form action="<?php echo URLROOT; ?>/reportes/create" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="pasantia_id" value="<?php echo $data['pasantia_id']; ?>">
                    
                    <div class="mb-3">
                        <label for="semana" class="form-label">Número de Semana <span class="text-danger">*</span></label>
                        <input type="number" name="semana" id="semana" class="form-control" min="1" max="52" required placeholder="Ej: 1, 2, 3...">
                    </div>

                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título del Reporte <span class="text-danger">*</span></label>
                        <input type="text" name="titulo" id="titulo" class="form-control" required placeholder="Resumen de actividades">
                    </div>

                    <div class="mb-3">
                        <label for="contenido" class="form-label">Descripción de Actividades <span class="text-danger">*</span></label>
                        <textarea name="contenido" id="contenido" rows="5" class="form-control" required placeholder="Describe las tareas realizadas, logros y dificultades..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="archivo" class="form-label">Adjuntar Archivo (PDF/DOCX) <small class="text-muted">(Opcional)</small></label>
                        <input type="file" name="archivo" id="archivo" class="form-control" accept=".pdf,.doc,.docx">
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Enviar Reporte</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

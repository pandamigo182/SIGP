<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0"><i class="fas fa-cogs me-2"></i>Configuración del Sistema</h4>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Nombre del Sitio (SITENAME):</label>
                        <input type="text" class="form-control" value="<?php echo SITENAME; ?>" disabled>
                        <small class="text-muted">Definido en config.php</small>
                    </div>
                     <div class="mb-3">
                        <label class="form-label">URL Base (URLROOT):</label>
                        <input type="text" class="form-control" value="<?php echo URLROOT; ?>" disabled>
                        <small class="text-muted">Definido en config.php</small>
                    </div>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Para cambiar estos valores, edite el archivo <code>app/config/config.php</code>.
                    </div>
                    <a href="<?php echo URLROOT; ?>/dashboard" class="btn btn-secondary">Volver</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

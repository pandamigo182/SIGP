<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="container mt-4">
    <h2 class="mb-3"><i class="fas fa-file-alt me-2 text-success"></i>Registros del Sistema</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Fecha/Hora</th>
                            <th>Nivel</th>
                            <th>Usuario</th>
                            <th>Acción</th>
                            <th>Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5" class="text-center text-muted p-4">
                                <i class="fas fa-history fa-2x mb-2"></i><br>
                                No hay registros disponibles en este momento.<br>
                                <small>(El sistema de logs se implementará en la próxima actualización)</small>
                            </td>
                        </tr>
                        <!-- Future: Loop through logs -->
                    </tbody>
                </table>
            </div>
            <a href="<?php echo URLROOT; ?>/dashboard" class="btn btn-secondary mt-3">Volver</a>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-md-8 mx-auto mt-4">
        <div class="card shadow-sm border-0">
             <div class="card-header bg-white">
                <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Registrar Nueva Empresa</h4>
            </div>
            <div class="card-body">
                <form action="<?php echo URLROOT; ?>/admin/empresas_add" method="post">
                    <div class="mb-3">
                        <label>Nombre de la Empresa:</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Descripción:</label>
                        <textarea name="descripcion" class="form-control" rows="3"></textarea>
                    </div>
                     <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Teléfono:</label>
                            <input type="text" name="telefono" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Sitio Web:</label>
                            <input type="text" name="website" class="form-control">
                        </div>
                    </div>
                        <div class="col-md-6 mb-3">
                            <label>Dirección:</label>
                            <input type="text" name="direccion" class="form-control">
                        </div>
                         <div class="col-md-6 mb-3">
                            <label>Logo (URL o Archivo - *Pending Logic*):</label>
                             <input type="text" name="logo" class="form-control" placeholder="URL del logo">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Latitud:</label>
                            <input type="text" name="latitud" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Longitud:</label>
                            <input type="text" name="longitud" class="form-control">
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">Registrar Empresa</button>
                        <a href="<?php echo URLROOT; ?>/admin/empresas" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

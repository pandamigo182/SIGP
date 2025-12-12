<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-8 mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-building me-2"></i>Registrar Empresa</h4>
            </div>
            <div class="card-body bg-light">
                <p>Complete el perfil de su empresa para comenzar a publicar pasantías.</p>
                <form action="<?php echo URLROOT; ?>/empresas/create" method="post" enctype="multipart/form-data">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre">Nombre de la Empresa <sup>*</sup></label>
                            <input type="text" name="nombre" class="form-control <?php echo (!empty($data['nombre_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['nombre']; ?>">
                            <span class="invalid-feedback"><?php echo $data['nombre_err']; ?></span>
                        </div>
                        <div class="col-md-6 mb-3">
                             <label for="telefono">Teléfono</label>
                             <input type="text" name="telefono" class="form-control" value="<?php echo $data['telefono']; ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="direccion">Dirección Física</label>
                        <input type="text" name="direccion" class="form-control" value="<?php echo $data['direccion']; ?>" placeholder="Ej: Calle Principal #123, Ciudad">
                    </div>

                    <div class="row">
                         <div class="col-md-6 mb-3">
                            <label for="latitud">Latitud (Opcional)</label>
                            <input type="text" name="latitud" class="form-control" value="<?php echo $data['latitud']; ?>" placeholder="ej: 13.6929">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="longitud">Longitud (Opcional)</label>
                            <input type="text" name="longitud" class="form-control" value="<?php echo $data['longitud']; ?>" placeholder="ej: -89.2182">
                        </div>
                        <div class="col-12 form-text text-muted mb-3">
                            Puede obtener estas coordenadas desde Google Maps (click derecho -> ¿Qué hay aquí?).
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="website">Sitio Web</label>
                        <input type="text" name="website" class="form-control" value="<?php echo $data['website']; ?>" placeholder="https://example.com">
                    </div>

                    <div class="mb-3">
                        <label for="descripcion">Descripción <sup>*</sup></label>
                        <textarea name="descripcion" class="form-control <?php echo (!empty($data['descripcion_err'])) ? 'is-invalid' : ''; ?>" rows="5"><?php echo $data['descripcion']; ?></textarea>
                         <span class="invalid-feedback"><?php echo $data['descripcion_err']; ?></span>
                    </div>

                    <div class="mb-3">
                         <label for="logo">Logo de la Empresa (Imagen)</label>
                         <input type="file" name="logo" class="form-control">
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?php echo URLROOT; ?>/dashboard" class="btn btn-secondary">Cancelar</a>
                        <input type="submit" value="Guardar Perfil" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-8 mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0"><i class="fas fa-building me-2"></i>Editar Datos de Empresa</h4>
            </div>
            <div class="card-body bg-light">
                <form action="<?php echo URLROOT; ?>/empresas/edit" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="nombre">Nombre de la Empresa <sup>*</sup></label>
                            <input type="text" name="nombre" class="form-control <?php echo (!empty($data['nombre_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['nombre']; ?>">
                            <span class="invalid-feedback"><?php echo $data['nombre_err']; ?></span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="nit">NIT (0000-000000-000-0)</label>
                            <input type="text" name="nit" class="form-control <?php echo (!empty($data['nit_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['nit']; ?>" placeholder="0000-000000-000-0">
                            <span class="invalid-feedback"><?php echo $data['nit_err']; ?></span>
                        </div>
                        <div class="col-md-4 mb-3">
                             <label for="telefono">Teléfono</label>
                             <input type="text" name="telefono" class="form-control" value="<?php echo $data['telefono']; ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="direccion">Dirección Física</label>
                        <input type="text" name="direccion" class="form-control" value="<?php echo $data['direccion']; ?>">
                    </div>

                    <div class="row">
                         <div class="col-md-6 mb-3">
                            <label for="latitud">Latitud</label>
                            <input type="text" name="latitud" class="form-control" value="<?php echo $data['latitud']; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="longitud">Longitud</label>
                            <input type="text" name="longitud" class="form-control" value="<?php echo $data['longitud']; ?>">
                        </div>
                         <div class="col-12 form-text text-muted mb-3">
                            Actualice las coordenadas si cambió de ubicación.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="website">Sitio Web</label>
                        <input type="text" name="website" class="form-control" value="<?php echo $data['website']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="descripcion">Descripción <sup>*</sup></label>
                        <textarea name="descripcion" class="form-control <?php echo (!empty($data['descripcion_err'])) ? 'is-invalid' : ''; ?>" rows="5"><?php echo $data['descripcion']; ?></textarea>
                         <span class="invalid-feedback"><?php echo $data['descripcion_err']; ?></span>
                    </div>

                    <div class="mb-3">
                         <label for="logo">Actualizar Logo (Deja en blanco para mantener actual)</label>
                         <input type="file" name="logo" class="form-control">
                         <?php if(!empty($data['logo'])): ?>
                            <div class="mt-2">
                                <small>Logo actual:</small><br>
                                <img src="<?php echo URLROOT; ?>/uploads/logos/<?php echo $data['logo']; ?>" alt="Current Logo" style="height: 50px;">
                            </div>
                         <?php endif; ?>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?php echo URLROOT; ?>/empresas/profile" class="btn btn-secondary">Cancelar</a>
                        <input type="submit" value="Actualizar Datos" class="btn btn-warning">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

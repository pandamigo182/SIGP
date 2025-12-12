<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-body bg-light mt-4 shadow-sm">
            <h2 class="mb-4">Publicar Nueva Plaza</h2>
            <p>Complete el formulario para ofertar una vacante de pasantía.</p>
            <form action="<?php echo URLROOT; ?>/plazas/add" method="post">
                <div class="form-group mb-3">
                    <label for="titulo">Título del Puesto: <sup>*</sup></label>
                    <input type="text" name="titulo" class="form-control form-control-lg <?php echo (!empty($data['titulo_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['titulo']; ?>" placeholder="Ej: Desarrollador Backend Junior">
                    <span class="invalid-feedback"><?php echo $data['titulo_err']; ?></span>
                </div>
                
                <div class="form-group mb-3">
                    <label for="descripcion">Descripción del Puesto: <sup>*</sup></label>
                    <textarea name="descripcion" class="form-control form-control-lg <?php echo (!empty($data['descripcion_err'])) ? 'is-invalid' : ''; ?>" rows="4" placeholder="Describa las responsabilidades..."><?php echo $data['descripcion']; ?></textarea>
                    <span class="invalid-feedback"><?php echo $data['descripcion_err']; ?></span>
                </div>

                <div class="form-group mb-3">
                    <label for="requisitos">Requisitos (Opcional):</label>
                    <textarea name="requisitos" class="form-control form-control-lg" rows="3" placeholder="Habilidades requeridas..."><?php echo $data['requisitos']; ?></textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="fecha_limite">Fecha Límite de Postulación: <sup>*</sup></label>
                    <input type="date" name="fecha_limite" class="form-control form-control-lg <?php echo (!empty($data['fecha_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['fecha_limite']; ?>">
                    <span class="invalid-feedback"><?php echo $data['fecha_err']; ?></span>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="<?php echo URLROOT; ?>/plazas/manage" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Publicar Plaza</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

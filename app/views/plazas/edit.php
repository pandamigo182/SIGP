<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-body bg-light mt-4 shadow-sm">
            <h2 class="mb-4">Editar Plaza</h2>
            <form action="<?php echo URLROOT; ?>/plazas/edit/<?php echo $data['id']; ?>" method="post">
                <div class="form-group mb-3">
                    <label for="titulo">Título del Puesto: <sup>*</sup></label>
                    <input type="text" name="titulo" class="form-control form-control-lg <?php echo (!empty($data['titulo_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['titulo']; ?>">
                    <span class="invalid-feedback"><?php echo $data['titulo_err']; ?></span>
                </div>
                
                <div class="form-group mb-3">
                    <label for="descripcion">Descripción del Puesto: <sup>*</sup></label>
                    <textarea name="descripcion" class="form-control form-control-lg <?php echo (!empty($data['descripcion_err'])) ? 'is-invalid' : ''; ?>" rows="4"><?php echo $data['descripcion']; ?></textarea>
                    <span class="invalid-feedback"><?php echo $data['descripcion_err']; ?></span>
                </div>

                <div class="mb-3">
                    <label for="modalidad" class="form-label">Modalidad: <sup>*</sup></label>
                    <select name="modalidad" class="form-control <?php echo (!empty($data['modalidad_err'])) ? 'is-invalid' : ''; ?>">
                        <option value="Presencial" <?php echo ($data['modalidad'] == 'Presencial') ? 'selected' : ''; ?>>Presencial</option>
                        <option value="Híbrida" <?php echo ($data['modalidad'] == 'Híbrida') ? 'selected' : ''; ?>>Híbrida</option>
                        <option value="Remota" <?php echo ($data['modalidad'] == 'Remota') ? 'selected' : ''; ?>>Remota</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="cantidad_vacantes" class="form-label">Cantidad de Vacantes: <sup>*</sup></label>
                    <input type="number" name="cantidad_vacantes" min="1" class="form-control <?php echo (!empty($data['vacantes_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['cantidad_vacantes']; ?>">
                    <span class="invalid-feedback"><?php echo $data['vacantes_err']; ?></span>
                </div>

                <div class="mb-3">
                    <label for="competencias_requeridas" class="form-label">Competencias Requeridas (Opcional):</label>
                    <textarea name="competencias_requeridas" class="form-control <?php echo (!empty($data['competencias_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['competencias_requeridas']; ?></textarea>
                    <small class="text-muted">Describa las habilidades técnicas o blandas necesarias.</small>
                    <span class="invalid-feedback"><?php echo $data['competencias_err']; ?></span>
                </div>

                <div class="form-group mb-3">
                    <label for="requisitos">Requisitos (Opcional):</label>
                    <textarea name="requisitos" class="form-control form-control-lg" rows="3"><?php echo $data['requisitos']; ?></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="fecha_limite">Fecha Límite: <sup>*</sup></label>
                        <input type="date" name="fecha_limite" class="form-control form-control-lg <?php echo (!empty($data['fecha_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['fecha_limite']; ?>">
                        <span class="invalid-feedback"><?php echo $data['fecha_err']; ?></span>
                    </div>
                    <div class="col-md-6 mb-3">
                         <label for="duracion">Duración: <sup>*</sup></label>
                         <input type="text" name="duracion" class="form-control form-control-lg <?php echo (!empty($data['duracion_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['duracion']; ?>" placeholder="Ej: 6 meses">
                        <span class="invalid-feedback"><?php echo $data['duracion_err']; ?></span>
                    </div>
                </div>

                <div class="form-group mb-3">
                     <label for="estado">Estado:</label>
                     <select name="estado" class="form-select">
                         <option value="abierta" <?php echo ($data['estado'] == 'abierta') ? 'selected' : ''; ?>>Abierta</option>
                         <option value="cerrada" <?php echo ($data['estado'] == 'cerrada') ? 'selected' : ''; ?>>Cerrada</option>
                     </select>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="<?php echo URLROOT; ?>/plazas/manage" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

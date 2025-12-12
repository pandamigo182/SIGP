<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-md-8 mx-auto mt-4">
        <div class="card card-body bg-light shadow-sm">
            <h2>Nuevo Reporte Semanal</h2>
            <p>Registra tus actividades y horas realizadas durante la semana.</p>
            <form action="<?php echo URLROOT; ?>/reportes/create" method="post" enctype="multipart/form-data">
                <div class="form-group mb-3">
                    <label for="titulo">Título/Semana: <sup>*</sup></label>
                    <input type="text" name="titulo" class="form-control form-control-lg <?php echo (!empty($data['titulo_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['titulo']; ?>" placeholder="Ej: Semana 1 - Análisis de Requerimientos">
                    <span class="invalid-feedback"><?php echo $data['titulo_err']; ?></span>
                </div>
                
                <div class="form-group mb-3">
                    <label for="horas">Horas Realizadas: <sup>*</sup></label>
                    <input type="number" name="horas" class="form-control form-control-lg <?php echo (!empty($data['horas_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['horas']; ?>" placeholder="Ej: 20">
                    <span class="invalid-feedback"><?php echo $data['horas_err']; ?></span>
                </div>

                <div class="form-group mb-3">
                    <label for="descripcion">Actividades Realizadas: <sup>*</sup></label>
                    <textarea name="descripcion" class="form-control form-control-lg <?php echo (!empty($data['descripcion_err'])) ? 'is-invalid' : ''; ?>" rows="5" placeholder="Detalla las tareas completadas..."><?php echo $data['descripcion']; ?></textarea>
                    <span class="invalid-feedback"><?php echo $data['descripcion_err']; ?></span>
                </div>

                <div class="form-group mb-3">
                    <label for="archivo">Evidencia (PDF/IMG) - Opcional:</label>
                    <input type="file" name="archivo" class="form-control">
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="<?php echo URLROOT; ?>/reportes/index" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Enviar Reporte</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

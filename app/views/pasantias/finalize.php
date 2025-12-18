<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0 mt-4">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0 fw-bold"><i class="fas fa-clipboard-check me-2"></i> Evaluación Final de Pasantía</h4>
            </div>
            <div class="card-body p-4">
                <div class="alert alert-info">
                     <i class="fas fa-info-circle me-1"></i>
                     Estás por finalizar la pasantía de <strong><?php echo $data['pasantia']->nombre_estudiante; ?></strong>. 
                     Por favor, complete la siguiente evaluación para cerrar el proceso.
                </div>

                <form action="<?php echo URLROOT; ?>/pasantias/process_finalization/<?php echo $data['id']; ?>" method="POST">
                    
                    <h5 class="border-bottom pb-2 mb-3 text-primary">Evaluación General</h5>
                    
                    <div class="mb-4 text-center">
                        <label class="form-label d-block fw-bold mb-2">Calificación Global</label>
                        <div class="rating-css">
                            <div class="star-icon">
                                <input type="radio" name="rating" value="5" id="rating5" checked>
                                <label for="rating5" class="fa fa-star"></label>
                                <input type="radio" name="rating" value="4" id="rating4">
                                <label for="rating4" class="fa fa-star"></label>
                                <input type="radio" name="rating" value="3" id="rating3">
                                <label for="rating3" class="fa fa-star"></label>
                                <input type="radio" name="rating" value="2" id="rating2">
                                <label for="rating2" class="fa fa-star"></label>
                                <input type="radio" name="rating" value="1" id="rating1">
                                <label for="rating1" class="fa fa-star"></label>
                            </div>
                        </div>
                        <span class="text-danger small"><?php echo $data['rating_err']; ?></span>
                    </div>

                    <h5 class="border-bottom pb-2 mb-3 text-primary">Competencias Específicas</h5>
                    <div class="row mb-4">
                        <?php 
                        $criterios = ['Responsabilidad', 'Proactividad', 'Trabajo en Equipo', 'Conocimiento Técnico', 'Puntualidad'];
                        foreach($criterios as $criterio):
                        ?>
                        <div class="col-md-6 mb-3">
                             <label class="form-label small fw-bold"><?php echo $criterio; ?></label>
                             <select name="criterios[<?php echo $criterio; ?>]" class="form-select form-select-sm">
                                 <option value="5">Excelente</option>
                                 <option value="4">Muy Bueno</option>
                                 <option value="3">Bueno</option>
                                 <option value="2">Regular</option>
                                 <option value="1">Deficiente</option>
                             </select>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <h5 class="border-bottom pb-2 mb-3 text-primary">Comentarios Finales</h5>
                    <div class="mb-4">
                        <label for="comentarios" class="form-label">Feedback para el estudiante:</label>
                        <textarea name="comentarios" class="form-control <?php echo (!empty($data['comentarios_err'])) ? 'is-invalid' : ''; ?>" rows="4" placeholder="Describa el desempeño del estudiante, fortalezas y áreas de mejora."><?php echo isset($_POST['comentarios']) ? $_POST['comentarios'] : ''; ?></textarea>
                        <span class="invalid-feedback"><?php echo $data['comentarios_err']; ?></span>
                    </div>

                    <div class="d-flex justify-content-between">
                         <a href="<?php echo URLROOT; ?>/pasantias/company_index" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
                         <button type="submit" class="btn btn-success btn-lg px-5 shadow"><i class="fas fa-check-circle me-1"></i> Finalizar Pasantía</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Simple Star Rating CSS */
.rating-css div {
    color: #ffe400;
    font-size: 30px;
    font-family: sans-serif;
    font-weight: 800;
    text-align: center;
    text-transform: uppercase;
    padding: 20px 0;
}
.rating-css input {
    display: none;
}
.rating-css input + label {
    font-size: 40px;
    text-shadow: 1px 1px 0 #8f8420;
    cursor: pointer;
}
.rating-css input:checked + label ~ label {
    color: #b4b4b4;
}
.rating-css label:active {
    transform: scale(0.8);
    transition: 0.3s all;
}
</style>

<?php require APPROOT . '/views/layouts/footer.php'; ?>

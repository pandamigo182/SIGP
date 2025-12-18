<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0 mt-4">
            <div class="card-header bg-success text-white py-3">
                <h4 class="mb-0 fw-bold"><i class="fas fa-comment-dots me-2"></i> Feedback de Pasantía</h4>
            </div>
            <div class="card-body p-4">
                <div class="alert alert-success">
                     <h5 class="alert-heading"><i class="fas fa-check-circle"></i> ¡Felicidades!</h5>
                     <p>Tu pasantía ha sido finalizada por la empresa. Para obtener tu certificado, por favor completa esta breve encuesta anónima sobre tu experiencia.</p>
                </div>

                <form action="<?php echo URLROOT; ?>/pasantias/store_feedback/<?php echo $data['id']; ?>" method="POST">
                    <input type="hidden" name="empresa_id" value="<?php echo $data['pasantia']->empresa_id; ?>">

                    <div class="mb-4 text-center">
                        <label class="form-label d-block fw-bold mb-2">¿Cómo calificarías tu experiencia en <?php echo $data['pasantia']->nombre_empresa; ?>?</label>
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

                    <div class="mb-4">
                        <label for="comentarios" class="form-label fw-bold">Comentarios (Anónimo):</label>
                        <textarea name="comentarios" class="form-control" rows="4" placeholder="¿Qué fue lo mejor? ¿Qué podría mejorar la empresa?"></textarea>
                        <div class="form-text">Tus comentarios ayudarán a futuros pasantes. La empresa no ver tu nombre asociado a este comentario.</div>
                    </div>

                    <div class="d-flex justify-content-end">
                         <button type="submit" class="btn btn-primary btn-lg px-5 shadow"><i class="fas fa-paper-plane me-1"></i> Enviar y Descargar Certificado</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Reuse Rating CSS */
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

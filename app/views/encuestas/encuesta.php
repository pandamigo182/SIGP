<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white p-4">
                    <h3 class="card-title fw-bold mb-0">
                        <i class="fas fa-poll me-2"></i><?php echo $data['titulo']; ?>
                    </h3>
                    <p class="mb-0 mt-2 text-white-50"><?php echo $data['descripcion']; ?></p>
                </div>
                <div class="card-body p-5 bg-light">
                    
                    <form action="<?php echo URLROOT; ?>/encuestas/enviar" method="POST">
                        
                        <!-- 1. Nivel de Satisfacción General -->
                        <div class="mb-4 text-center">
                            <label class="form-label fw-bold h5 text-dark">¿Qué tan satisfecho estás con SIGP en general?</label><br>
                            <div class="rating-group mt-2">
                                <?php for($i=1; $i<=5; $i++): ?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="nivel_satisfaccion" id="sat<?php echo $i; ?>" value="<?php echo $i; ?>" required>
                                        <label class="form-check-label fw-bold" for="sat<?php echo $i; ?>"><?php echo $i; ?></label>
                                    </div>
                                <?php endfor; ?>
                                <div class="text-muted small mt-1">(1 = Muy Insatisfecho, 5 = Muy Satisfecho)</div>
                            </div>
                        </div>
                        <hr>

                        <!-- 2. Facilidad de Uso (ISO 25010 Usability) -->
                        <div class="mb-4 text-center">
                            <label class="form-label fw-bold h5 text-dark">¿Qué tan fácil fue usar la plataforma?</label><br>
                            <div class="rating-group mt-2">
                                <?php for($i=1; $i<=5; $i++): ?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="facilidad_uso" id="usab<?php echo $i; ?>" value="<?php echo $i; ?>" required>
                                        <label class="form-check-label fw-bold" for="usab<?php echo $i; ?>"><?php echo $i; ?></label>
                                    </div>
                                <?php endfor; ?>
                                <div class="text-muted small mt-1">(1 = Muy Difícil, 5 = Muy Fácil)</div>
                            </div>
                        </div>
                        <hr>

                        <!-- 3. Calidad del Soporte -->
                        <div class="mb-4 text-center">
                            <label class="form-label fw-bold h5 text-dark">Si usaste soporte, ¿cómo calificarías la atención?</label><br>
                            <div class="rating-group mt-2">
                                <?php for($i=1; $i<=5; $i++): ?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="calidad_soporte" id="sup<?php echo $i; ?>" value="<?php echo $i; ?>" required>
                                        <label class="form-check-label fw-bold" for="sup<?php echo $i; ?>"><?php echo $i; ?></label>
                                    </div>
                                <?php endfor; ?>
                                <div class="text-muted small mt-1">(1 = Mala, 5 = Excelente)</div>
                            </div>
                        </div>
                        <hr>

                        <!-- 4. Comentarios Abiertos -->
                        <div class="mb-4">
                            <label for="comentarios" class="form-label fw-bold">Comentarios o Sugerencias de Mejora</label>
                            <textarea class="form-control" id="comentarios" name="comentarios" rows="3" placeholder="Tu opinión es valiosa para nosotros..."></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm hover-scale">
                                <i class="fas fa-paper-plane me-2"></i>Enviar Encuesta
                            </button>
                            <a href="<?php echo URLROOT; ?>/dashboard" class="btn btn-outline-secondary rounded-pill">Cancelar</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-scale:hover { transform: scale(1.02); transition: 0.2s; }
</style>

<?php require APPROOT . '/views/layouts/footer.php'; ?>

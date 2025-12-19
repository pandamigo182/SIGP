<?php require APPROOT . '/views/layouts/header.php'; ?>

<!-- Premium Hero Contact -->
<div class="position-relative overflow-hidden mb-5 text-center" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); padding: 6rem 0;">
    <!-- Abstract Shapes -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="opacity: 0.1;">
        <svg viewBox="0 0 100 100" preserveAspectRatio="none" style="width: 100%; height: 100%;">
            <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white"></path>
        </svg>
    </div>
    
    <div class="container position-relative z-index-1">
        <span class="badge bg-white text-primary rounded-pill px-3 py-2 mb-3 shadow-sm fw-bold text-uppercase tracking-wider">
            <i class="fas fa-headset me-2"></i> Soporte 24/7
        </span>
        <h1 class="display-3 fw-bold text-white mb-3" style="text-shadow: 0 4px 15px rgba(0,0,0,0.2);">
            Hablemos
        </h1>
        <p class="lead text-white-50 mx-auto" style="max-width: 600px; font-weight: 300;">
            ¿Tienes preguntas sobre el proceso de pasantías? Estamos aquí para guiarte en cada paso de tu camino profesional.
        </p>
    </div>
    
    <!-- Wave Border Bottom -->
    <div class="position-absolute bottom-0 start-0 w-100" style="line-height: 0;">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" style="width: 100%; height: 60px; fill: var(--bg-body);">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"></path>
        </svg>
    </div>
</div>

<div class="container mb-5">
    <div class="row">
        <!-- Contact Info -->
        <div class="col-lg-5 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <h3 class="fw-bold mb-4 text-primary">Información de Contacto</h3>
                    <?php $sys = get_system_settings(); ?>
                    
                    <div class="d-flex mb-4">
                        <div class="me-3">
                            <span class="fa-stack fa-lg text-primary">
                                <i class="fas fa-circle fa-stack-2x opacity-25"></i>
                                <i class="fas fa-map-marker-alt fa-stack-1x"></i>
                            </span>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Nuestra Ubicación</h5>
                            <p class="text-muted mb-0"><?php echo $sys->direccion; ?></p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                         <div class="me-3">
                            <span class="fa-stack fa-lg text-primary">
                                <i class="fas fa-circle fa-stack-2x opacity-25"></i>
                                <i class="fas fa-phone-alt fa-stack-1x"></i>
                            </span>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Llámanos</h5>
                            <p class="text-muted mb-0"><?php echo $sys->telefono; ?></p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                         <div class="me-3">
                            <span class="fa-stack fa-lg text-success">
                                <i class="fas fa-circle fa-stack-2x opacity-25"></i>
                                <i class="fab fa-whatsapp fa-stack-1x"></i>
                            </span>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">WhatsApp</h5>
                            <p class="text-muted mb-0">
                                <a href="https://wa.me/<?php echo $sys->whatsapp; ?>" target="_blank" class="text-decoration-none text-muted">
                                    Enviar mensaje direct
                                </a>
                            </p>
                        </div>
                    </div>

                    <div class="d-flex">
                         <div class="me-3">
                            <span class="fa-stack fa-lg text-primary">
                                <i class="fas fa-circle fa-stack-2x opacity-25"></i>
                                <i class="fas fa-envelope fa-stack-1x"></i>
                            </span>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Correo Electrónico</h5>
                            <p class="text-muted mb-0">
                                <a href="mailto:<?php echo $sys->email; ?>" class="text-decoration-none text-muted"><?php echo $sys->email; ?></a>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Map -->
        <div class="col-lg-7 mb-4">
            <div class="card shadow-sm border-0 h-100 overflow-hidden">
                <?php if(!empty($sys->map_embed_url)): ?>
                    <iframe src="<?php echo $sys->map_embed_url; ?>" width="100%" height="100%" style="border:0; min-height: 400px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <?php else: ?>
                    <div class="d-flex align-items-center justify-content-center bg-light h-100" style="min-height: 400px;">
                        <div class="text-center text-muted">
                            <i class="fas fa-map-marked-alt fa-4x mb-3 opacity-50"></i>
                            <h5>Mapa no configurado</h5>
                            <p>La ubicación se mostrará cuando el administrador configure el mapa.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>

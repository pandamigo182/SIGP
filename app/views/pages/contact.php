<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="position-relative p-5 text-center bg-light mb-5" style="background: linear-gradient(rgba(0, 51, 102, 0.8), rgba(0, 51, 102, 0.8)), url('<?php echo URLROOT; ?>/img/hero-bg.jpg') no-repeat center center; background-size: cover; color: white;">
    <div class="container py-5">
        <h1 class="fw-bold display-4 mb-3">Contáctanos</h1>
        <p class="lead mb-0 text-white-50">Estamos aquí para ayudarte. Ponte en contacto con nosotros.</p>
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

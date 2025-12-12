<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <!-- Main Content -->
    <div class="col-md-8 mx-auto mt-4">
        <?php flash('profile_msg'); ?>
        <div class="card shadow border-0 mb-4">
            
            <!-- Cover / Header -->
            <div class="card-header bg-white p-4 border-0 d-flex align-items-center">
                <?php 
                    $logoUrl = isset($data['empresa']->logo) && $data['empresa']->logo != 'default_logo.png' 
                            ? URLROOT . '/uploads/logos/' . $data['empresa']->logo 
                            : 'https://ui-avatars.com/api/?name=' . urlencode($data['empresa']->nombre) . '&background=random&size=128';
                ?>
                <img src="<?php echo $logoUrl; ?>" alt="Logo" class="rounded me-4 shadow-sm" style="width: 100px; height: 100px; object-fit: cover;">
                <div class="flex-grow-1">
                    <h2 class="fw-bold mb-1"><?php echo $data['empresa']->nombre; ?></h2>
                    <?php if(!empty($data['empresa']->website)): ?>
                        <a href="<?php echo $data['empresa']->website; ?>" target="_blank" class="text-decoration-none text-muted"><i class="fas fa-globe me-1"></i> <?php echo $data['empresa']->website; ?></a>
                    <?php endif; ?>
                    <div class="mt-2">
                         <span class="badge bg-light text-dark"><i class="fas fa-map-marker-alt me-1 text-danger"></i> <?php echo $data['empresa']->direccion; ?></span>
                         <?php if(!empty($data['empresa']->telefono)): ?>
                            <span class="badge bg-light text-dark ms-2"><i class="fas fa-phone me-1 text-success"></i> <?php echo $data['empresa']->telefono; ?></span>
                         <?php endif; ?>
                    </div>
                </div>
                <!-- Action Buttons -->
                <div>
                     <?php if(isLoggedIn() && isset($_SESSION['user_empresa']) && $_SESSION['user_empresa'] == $data['empresa']->id): ?>
                        <a href="<?php echo URLROOT; ?>/empresas/edit" class="btn btn-outline-primary"><i class="fas fa-edit"></i> Editar Entidad</a>
                    <?php endif; ?>
                     <a href="javascript:history.back()" class="btn btn-outline-secondary ms-2"><i class="fas fa-arrow-left"></i> Volver</a>
                </div>
            </div>

            <div class="card-body p-4">
                <h5 class="fw-bold">Sobre Nosotros</h5>
                <p class="text-muted"><?php echo nl2br($data['empresa']->descripcion); ?></p>
                
                <hr class="my-4">
                
                <!-- Map / Location -->
                <?php if(!empty($data['empresa']->latitud) && !empty($data['empresa']->longitud)): ?>
                    <h5 class="fw-bold mb-3"><i class="fas fa-map-marked-alt me-2 text-primary"></i>Nuestra Ubicación</h5>
                    <div class="ratio ratio-16x9 border rounded overflow-hidden shadow-sm">
                        <!-- Google Maps Embed (using q=lat,long) -->
                        <iframe 
                            src="https://maps.google.com/maps?q=<?php echo $data['empresa']->latitud; ?>,<?php echo $data['empresa']->longitud; ?>&hl=es&z=15&output=embed"
                            width="600" 
                            height="450" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                <?php else: ?>
                    <div class="alert alert-secondary">
                        <i class="fas fa-info-circle me-2"></i> La ubicación en mapa no ha sido configurada.
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

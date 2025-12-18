    </div>

    <!-- Footer -->
    <?php $sys = get_system_settings(); ?>
    <footer class="text-white py-5 mt-auto mt-5 w-100" style="background-color: #0d1b2a;">
        <div class="container">
            <div class="row mb-4">
                <!-- Col 1: Brand -->
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="d-flex align-items-center mb-3">
                         <?php if(!empty($sys->logo_path)): ?>
                            <img src="<?php echo URLROOT; ?>/img/<?php echo $sys->logo_path; ?>" alt="Logo" height="50" class="me-2 p-1">
                         <?php else: ?>
                            <img src="<?php echo URLROOT; ?>/img/logo-blanco.svg" alt="SIGP" height="50" class="me-2 p-1">
                         <?php endif; ?>
                        <h4 class="mb-0 fw-bold"><?php echo !empty($sys->nombre_sistema) ? substr($sys->nombre_sistema, 0, 10) : 'SIGP'; ?>...</h4>
                    </div>
                    <p class="small text-white-50">
                        <?php echo !empty($sys->nombre_sistema) ? $sys->nombre_sistema : 'Plataforma integral para la gestión y vinculación de pasantías.'; ?>
                    </p>
                    <div class="d-flex gap-3">
                        <?php if($sys->facebook): ?><a href="<?php echo $sys->facebook; ?>" class="text-white-50 hover-white"><i class="fab fa-facebook-f"></i></a><?php endif; ?>
                        <?php if($sys->twitter): ?><a href="<?php echo $sys->twitter; ?>" class="text-white-50 hover-white"><i class="fab fa-twitter"></i></a><?php endif; ?>
                        <?php if($sys->linkedin): ?><a href="<?php echo $sys->linkedin; ?>" class="text-white-50 hover-white"><i class="fab fa-linkedin-in"></i></a><?php endif; ?>
                        <?php if($sys->instagram): ?><a href="<?php echo $sys->instagram; ?>" class="text-white-50 hover-white"><i class="fab fa-instagram"></i></a><?php endif; ?>
                    </div>
                </div>

                <!-- Col 2: Quick Links / Modules -->
                <div class="col-md-4 mb-4 mb-md-0">
                     <h5 class="fw-bold mb-3 border-bottom border-primary pb-2 d-inline-block">
                        <?php echo isset($_SESSION['user_id']) ? 'Módulos' : 'Enlaces Rápidos'; ?>
                    </h5>
                    <ul class="list-unstyled">
                        <?php if(isset($_SESSION['user_role'])): ?>
                            <!-- Validar Rol -->
                            <?php if($_SESSION['user_role'] == 1): // Admin ?>
                                <li class="mb-2"><a href="<?php echo URLROOT; ?>/admin" class="text-white-50 text-decoration-none hover-white"><i class="fas fa-angle-right me-2 text-primary"></i>Dashboard</a></li>
                                <li class="mb-2"><a href="<?php echo URLROOT; ?>/admin/users" class="text-white-50 text-decoration-none hover-white"><i class="fas fa-angle-right me-2 text-primary"></i>Usuarios</a></li>
                                <li class="mb-2"><a href="<?php echo URLROOT; ?>/admin/empresas" class="text-white-50 text-decoration-none hover-white"><i class="fas fa-angle-right me-2 text-primary"></i>Empresas</a></li>
                                <li class="mb-2"><a href="<?php echo URLROOT; ?>/admin/logs" class="text-white-50 text-decoration-none hover-white"><i class="fas fa-angle-right me-2 text-primary"></i>Bitácora</a></li>
                            <?php elseif($_SESSION['user_role'] == 2): // Empresa ?>
                                <li class="mb-2"><a href="<?php echo URLROOT; ?>/dashboard" class="text-white-50 text-decoration-none hover-white"><i class="fas fa-angle-right me-2 text-primary"></i>Dashboard</a></li>
                                <li class="mb-2"><a href="<?php echo URLROOT; ?>/plazas/manage" class="text-white-50 text-decoration-none hover-white"><i class="fas fa-angle-right me-2 text-primary"></i>Mis Plazas</a></li>
                                <li class="mb-2"><a href="<?php echo URLROOT; ?>/usuarios/postulaciones_recibidas" class="text-white-50 text-decoration-none hover-white"><i class="fas fa-angle-right me-2 text-primary"></i>Candidatos</a></li>
                            <?php elseif($_SESSION['user_role'] == 3 || $_SESSION['user_role'] == 5): // Estudiante ?>
                                <li class="mb-2"><a href="<?php echo URLROOT; ?>/dashboard" class="text-white-50 text-decoration-none hover-white"><i class="fas fa-angle-right me-2 text-primary"></i>Dashboard</a></li>
                                <li class="mb-2"><a href="<?php echo URLROOT; ?>/plazas" class="text-white-50 text-decoration-none hover-white"><i class="fas fa-angle-right me-2 text-primary"></i>Pasantías</a></li>
                                <li class="mb-2"><a href="<?php echo URLROOT; ?>/postulaciones/mis_postulaciones" class="text-white-50 text-decoration-none hover-white"><i class="fas fa-angle-right me-2 text-primary"></i>Mis Postulaciones</a></li>
                                <li class="mb-2"><a href="<?php echo URLROOT; ?>/users/profile" class="text-white-50 text-decoration-none hover-white"><i class="fas fa-angle-right me-2 text-primary"></i>Hoja de Vida</a></li>
                            <?php else: ?>
                                <!-- Default Authenticated -->
                                <li class="mb-2"><a href="<?php echo URLROOT; ?>/dashboard" class="text-white-50 text-decoration-none hover-white"><i class="fas fa-angle-right me-2 text-primary"></i>Dashboard</a></li>
                            <?php endif; ?>
                        <?php else: ?>
                            <!-- Guest -->
                            <li class="mb-2"><a href="<?php echo URLROOT; ?>" class="text-white-50 text-decoration-none hover-white"><i class="fas fa-angle-right me-2 text-primary"></i>Inicio</a></li>
                            <li class="mb-2"><a href="<?php echo URLROOT; ?>/plazas" class="text-white-50 text-decoration-none hover-white"><i class="fas fa-angle-right me-2 text-primary"></i>Pasantías</a></li>
                            <li class="mb-2"><a href="<?php echo URLROOT; ?>/auth/login" class="text-white-50 text-decoration-none hover-white"><i class="fas fa-angle-right me-2 text-primary"></i>Iniciar Sesión</a></li>
                            <li class="mb-2"><a href="<?php echo URLROOT; ?>/auth/register" class="text-white-50 text-decoration-none hover-white"><i class="fas fa-angle-right me-2 text-primary"></i>Registrarse</a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Col 3: Contact -->
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3 border-bottom border-primary pb-2 d-inline-block">Contacto</h5>
                    <ul class="list-unstyled text-white-50">
                        <li class="mb-3 d-flex"><i class="fas fa-map-marker-alt mt-1 me-3 text-primary"></i> <span><?php echo $sys->direccion; ?></span></li>
                        <li class="mb-3 d-flex"><i class="fas fa-envelope mt-1 me-3 text-primary"></i> <span><?php echo $sys->email; ?></span></li>
                        <li class="mb-3 d-flex"><i class="fas fa-phone-alt mt-1 me-3 text-primary"></i> <span><?php echo $sys->telefono; ?></span></li>
                        <?php if($sys->whatsapp): ?>
                            <li class="mb-3 d-flex"><i class="fab fa-whatsapp mt-1 me-3 text-success"></i> <span><?php echo $sys->whatsapp; ?></span></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <hr class="border-secondary opacity-50">

            <div class="row align-items-center">
                <div class="col-md-12 text-center text-md-center">
                    <p class="mb-0 small text-white-50">&copy; <?php echo date('Y'); ?> <?php echo !empty($sys->nombre_empresa) ? $sys->nombre_empresa : 'SIGP'; ?> - Todos los Derechos Reservados.</p>
                </div>
            </div>
        </div>
    </footer>
    
    <style>
        .hover-white:hover { color: #fff !important; transition: color 0.3s; }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo URLROOT; ?>/js/main.js"></script>
</body>
</html>

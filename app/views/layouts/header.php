<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php $sys = function_exists('get_system_settings') ? get_system_settings() : null; ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
    <link rel="icon" href="<?php echo URLROOT; ?>/img/favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/introjs.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title><?php echo ($sys && !empty($sys->nombre_sistema)) ? $sys->nombre_sistema : SITENAME; ?></title>
</head>
<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-custom-primary d-flex align-items-center" href="<?php echo URLROOT; ?>">
                <?php if($sys && !empty($sys->logo_path)): ?>
                    <img src="<?php echo URLROOT; ?>/img/logo.svg" alt="Logo" height="35" class="me-2">
                <?php else: ?>
                    <img src="<?php echo URLROOT; ?>/img/logo-azul.svg" alt="SIGP" height="35" class="me-2"> 
                <?php endif; ?>
                <?php echo ($sys && !empty($sys->nombre_sistema)) ? $sys->nombre_sistema : 'SIGP - Sistema Integral de Gestión de Pasantías'; ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-label="Alternar navegación">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Theme Toggle -->
                    <li class="nav-item">
                        <button id="themeToggleBtn" class="theme-toggle-btn m-2" onclick="toggleTheme()" aria-label="Cambiar Tema">
                            <i class="fas fa-moon"></i>
                        </button>
                    </li>
                </ul>

                <!-- Navigation Link: Pasantías -->
                <div class="d-flex align-items-center me-3">
                    <a class="nav-link fw-bold text-custom-primary" href="<?php echo URLROOT; ?>/plazas"><i class="fas fa-briefcase me-1"></i> Pasantías</a>
                    <a class="nav-link fw-bold text-custom-primary ms-3" href="<?php echo URLROOT; ?>/pages/contact"><i class="fas fa-envelope me-1"></i> Contacto</a>
                </div>

                <ul class="navbar-nav ms-auto">
                    <?php if(isset($_SESSION['user_id'])) : ?>
                        <!-- Notifications -->
                        <?php 
                            $notifs = function_exists('get_unread_notifications') ? get_unread_notifications() : []; 
                            $notifCount = count($notifs);
                        ?>
                        <li class="nav-item dropdown me-3">
                            <a class="nav-link text-secondary position-relative" href="#" id="notifDropdown" data-bs-toggle="dropdown" aria-label="Notificaciones">
                                <i class="fas fa-bell fa-lg"></i>
                                <?php if($notifCount > 0): ?>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        <?php echo $notifCount; ?>
                                    </span>
                                <?php endif; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="notifDropdown" style="width: 320px;">
                                <li class="dropdown-header text-uppercase fw-bold text-muted small">Notificaciones</li>
                                <?php if($notifCount > 0): ?>
                                    <?php foreach($notifs as $notif): ?>
                                        <li class="border-bottom">
                                            <a class="dropdown-item py-2 text-wrap" href="#">
                                                <div class="d-flex align-items-start">
                                                    <i class="fas fa-info-circle text-info mt-1 me-2"></i>
                                                    <div>
                                                        <?php echo $notif->mensaje; ?>
                                                        <div class="small text-muted mt-1" style="font-size: 0.75rem;"><?php echo $notif->created_at; ?></div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                    <li><a class="dropdown-item text-center small text-primary fw-bold py-2" href="<?php echo URLROOT; ?>/users/notifications_mark_read">Marcar todas como leídas</a></li>
                                <?php else: ?>
                                    <li class="dropdown-item text-muted text-center py-3 small">
                                        <i class="far fa-bell-slash fa-2x mb-2 d-block"></i>
                                        No hay notificaciones nuevas
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <!-- User Avatar -->
                                <?php 
                                    $avatar = URLROOT . '/uploads/avatars/hombre.svg'; // Default Fallback
                                    
                                    if(isset($_SESSION['user_foto']) && !empty($_SESSION['user_foto']) && $_SESSION['user_foto'] != 'default.png') {
                                        $avatar = URLROOT . '/uploads/avatars/' . $_SESSION['user_foto'];
                                    } else {
                                        // Dynamic Default based on Role
                                        if(isset($_SESSION['user_role'])) {
                                            if($_SESSION['user_role'] == 2) { // Empresa
                                                $avatar = URLROOT . '/uploads/avatars/empresa.svg';
                                            } elseif ($_SESSION['user_role'] == 3 || $_SESSION['user_role'] == 5) { // Estudiante (3 or 5)
                                                if(isset($_SESSION['user_genero']) && $_SESSION['user_genero'] == 'F') {
                                                    $avatar = URLROOT . '/uploads/avatars/mujer.svg';
                                                } else {
                                                    $avatar = URLROOT . '/uploads/avatars/hombre.svg';
                                                }
                                            }
                                        }
                                    }
                                ?>
                                <img src="<?php echo $avatar; ?>" alt="Avatar" class="rounded-circle me-2" style="width: 30px; height: 30px; object-fit: cover;" loading="lazy">
                                <span><?php echo $_SESSION['user_name']; ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                <li><a class="dropdown-item" href="<?php echo URLROOT; ?>/dashboard"><i class="fas fa-tachometer-alt me-2 text-custom-primary"></i> Dashboard</a></li>
                                <?php if($_SESSION['user_role'] == 4): // Empresa ?>
                                    <li><a class="dropdown-item" href="<?php echo URLROOT; ?>/pasantias/company_index"><i class="fas fa-user-graduate me-2 text-primary"></i> Mis Pasantes</a></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="<?php echo URLROOT; ?>/users/profile"><i class="fas fa-user-cog me-2 text-secondary"></i> Mi Perfil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="<?php echo URLROOT; ?>/auth/logout"><i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión</a></li>
                            </ul>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-sm btn-outline-primary px-3 ms-2 mb-2 mb-lg-0 rounded-pill" href="<?php echo URLROOT; ?>/auth/register">Registrarse</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-sm btn-primary text-white px-3 ms-2 rounded-pill shadow-sm" href="<?php echo URLROOT; ?>/auth/login">Iniciar Sesión</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div style="margin-top: 80px;"></div>

    <script>
        // Simple Clock
        function updateClock() {
            const now = new Date();
            const options = { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' };
            // Short format for mobile
            if(window.innerWidth < 992) {
                 options.weekday = undefined;
                 options.year = undefined;
            } else {
                 options.weekday = 'short';
                 options.year = 'numeric';
            }
            document.getElementById('current-time').textContent = now.toLocaleDateString('es-ES', options);
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
    <div class="container">

<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row justify-content-center align-items-center min-vh-75 mt-5">
    <div class="col-md-5 col-lg-4">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <img src="<?php echo URLROOT; ?>/img/logo-completo.svg" alt="SIGP Logo" class="img-fluid mb-3" style="height: 80px;">
                    <h4 class="fw-bold text-dark">Bienvenido de nuevo</h4>
                    <p class="text-muted small">Ingrese sus credenciales para acceder</p>
                </div>

                <?php flash('register_success'); ?>

                <form action="<?php echo URLROOT; ?>/auth/login" method="post">
                    <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
                    
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" id="email" placeholder="name@example.com" value="<?php echo $data['email']; ?>">
                        <label for="email"><i class="fas fa-envelope me-2 text-primary"></i>Correo Electrónico</label>
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" id="password" placeholder="Password" value="<?php echo $data['password']; ?>">
                        <label for="password"><i class="fas fa-lock me-2 text-primary"></i>Contraseña</label>
                        <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                    </div>

                    <div class="d-flex justify-content-end mb-4">
                        <a href="<?php echo URLROOT; ?>/auth/forgot_password" class="text-decoration-none small text-muted hover-primary">¿Olvidaste tu contraseña?</a>
                    </div>

                    <div class="d-grid gap-2">
                        <input type="submit" value="Iniciar Sesión" class="btn btn-primary btn-lg rounded-pill fw-bold">
                        <a href="<?php echo URLROOT; ?>/auth/register" class="btn btn-outline-secondary btn-lg rounded-pill">Registrarse</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="<?php echo URLROOT; ?>" class="text-muted text-decoration-none small"><i class="fas fa-arrow-left me-1"></i> Volver al Inicio</a>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

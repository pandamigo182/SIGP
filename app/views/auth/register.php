<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row justify-content-center align-items-center min-vh-75 mt-4">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                     <img src="<?php echo URLROOT; ?>/img/logo-completo.svg" alt="SIGP Logo" class="img-fluid mb-3" style="height: 70px;">
                    <h4 class="fw-bold text-dark">Crear una Cuenta</h4>
                    <p class="text-muted small">Únete a nosotros llenando el siguiente formulario</p>
                </div>

                <form action="<?php echo URLROOT; ?>/auth/register" method="post">
                    <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
                    
                    <div class="form-floating mb-3">
                        <input type="text" name="nombre" class="form-control <?php echo (!empty($data['nombre_err'])) ? 'is-invalid' : ''; ?>" id="nombre" placeholder="Nombre Completo" value="<?php echo $data['nombre']; ?>">
                        <label for="nombre"><i class="fas fa-user me-2 text-primary"></i>Nombre Completo</label>
                        <span class="invalid-feedback"><?php echo $data['nombre_err']; ?></span>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" id="email" placeholder="name@example.com" value="<?php echo $data['email']; ?>">
                        <label for="email"><i class="fas fa-envelope me-2 text-primary"></i>Correo Electrónico</label>
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" name="password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" id="password" placeholder="Contraseña" value="<?php echo $data['password']; ?>">
                                <label for="password"><i class="fas fa-lock me-2 text-primary"></i>Contraseña</label>
                                <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" id="confirm_password" placeholder="Confirmar" value="<?php echo $data['confirm_password']; ?>">
                                <label for="confirm_password"><i class="fas fa-lock me-2 text-primary"></i>Confirmar</label>
                                <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2 mt-4">
                        <input type="submit" value="Registrarse" class="btn btn-primary btn-lg rounded-pill fw-bold">
                        <a href="<?php echo URLROOT; ?>/auth/login" class="btn btn-outline-secondary btn-lg rounded-pill">¿Ya tienes cuenta? Ingresa</a>
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

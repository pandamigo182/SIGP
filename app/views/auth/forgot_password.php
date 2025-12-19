<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card border-0 shadow-lg mt-5">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <i class="fas fa-lock fa-3x text-primary mb-3"></i>
                    <h2 class="fw-bold">Recuperar Contraseña</h2>
                    <p class="text-muted">Ingresa tu correo electrónico y te enviaremos instrucciones para restablecer tu contraseña.</p>
                </div>

                <form action="<?php echo URLROOT; ?>/auth/forgot_password" method="post">
                    <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
                    
                    <div class="form-group mb-4">
                        <label for="email" class="form-label fw-bold">Correo Electrónico</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                            <input type="email" name="email" class="form-control bg-light border-start-0 <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>" placeholder="ejemplo@correo.com">
                            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <input type="submit" value="Enviar Enlace de Recuperación" class="btn btn-primary btn-lg shadow-sm">
                        <a href="<?php echo URLROOT; ?>/auth/login" class="btn btn-light btn-lg text-muted">Volver al Inicio de Sesión</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>
<script>
    <?php if(isset($data['smtp_error']) && !empty($data['smtp_error'])): ?>
        Swal.fire({
            icon: 'error',
            title: 'Error de Envío',
            text: '<?php echo $data['smtp_error']; ?>',
            confirmButtonColor: '#d33',
            confirmButtonText: 'Entendido'
        });
    <?php endif; ?>
</script>

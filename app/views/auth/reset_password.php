<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card border-0 shadow-lg mt-5">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <i class="fas fa-key fa-3x text-primary mb-3"></i>
                    <h2 class="fw-bold">Nueva Contraseña</h2>
                    <p class="text-muted">Crea una nueva contraseña segura para tu cuenta.</p>
                </div>

                <form action="<?php echo URLROOT; ?>/auth/reset_password_action" method="post">
                    <input type="hidden" name="token" value="<?php echo $_GET['token'] ?? ''; ?>">
                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email'] ?? ''); ?>">
                    
                    <div class="form-group mb-3">
                        <label for="password" class="form-label fw-bold">Nueva Contraseña</label>
                        <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" placeholder="Mínimo 6 caracteres">
                        <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                    </div>

                    <div class="form-group mb-4">
                        <label for="confirm_password" class="form-label fw-bold">Confirmar Contraseña</label>
                        <input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" placeholder="Repite la contraseña">
                        <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg shadow-sm">Cambiar Contraseña</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

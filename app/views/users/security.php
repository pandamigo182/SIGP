<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-8 mt-4">
        
        <?php flash('security_msg'); ?>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom">
                <h4 class="mb-0 text-primary"><i class="fas fa-shield-alt me-2"></i>Seguridad de la Cuenta</h4>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5>Doble Autenticación (2FA)</h5>
                        <p class="text-muted mb-0">Protege tu cuenta solicitando un código adicional al iniciar sesión.</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <?php if($data['user']->enable_2fa): ?>
                            <span class="badge bg-success mb-2">Activado</span>
                            <form action="<?php echo URLROOT; ?>/users/disable_2fa" method="post" onsubmit="return confirm('¿Seguro que deseas desactivar la protección?');">
                                <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
                                <button type="submit" class="btn btn-outline-danger btn-sm">Desactivar</button>
                            </form>
                        <?php else: ?>
                            <span class="badge bg-secondary mb-2">Desactivado</span>
                            <?php if(!isset($data['setup_mode'])): ?>
                                <form action="<?php echo URLROOT; ?>/users/enable_2fa_init" method="post">
                                     <button type="submit" class="btn btn-primary btn-sm">Activar Ahora</button>
                                </form>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if(isset($data['setup_mode']) && $data['setup_mode']): ?>
                    <hr class="my-4">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h5 class="text-info font-weight-bold">Configuración de Doble Factor</h5>
                            <p>1. Escanea el siguiente código QR con tu aplicación de autenticación (Google Authenticator, Authy, etc).</p>
                            
                            <div class="bg-light p-3 d-inline-block rounded border mb-3">
                                <img src="<?php echo $data['qr_url']; ?>" alt="QR Code" class="img-fluid">
                            </div>
                            
                            <p>2. Ingresa el código de 6 dígitos que genera la aplicación para confirmar.</p>
                            
                            <form action="<?php echo URLROOT; ?>/users/confirm_2fa" method="post" class="d-inline-block text-start" style="max-width: 300px;">
                                <div class="mb-3">
                                    <input type="text" name="code" class="form-control text-center form-control-lg" placeholder="000 000" autocomplete="off" required>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success">Verificar y Activar</button>
                                </div>
                            </form>
                            
                            <div class="mt-3">
                                <a href="<?php echo URLROOT; ?>/users/security" class="text-muted small">Cancelar configuración</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
            <div class="card-footer bg-light">
                <a href="<?php echo URLROOT; ?>/users/profile" class="btn btn-sm btn-light"><i class="fas fa-arrow-left me-1"></i> Volver al Perfil</a>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

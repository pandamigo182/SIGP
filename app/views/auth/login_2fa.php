<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="font-weight-light my-2">Verificación de Dos Pasos</h3>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <i class="fas fa-shield-alt fa-3x text-primary"></i>
                        <p class="mt-2 text-muted">Ingresa el código de 6 dígitos de tu aplicación autenticadora.</p>
                    </div>
                    
                    <?php if(!empty($data['error'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $data['error']; ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo URLROOT; ?>/auth/login_2fa" method="post">
                        <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
                        
                        <div class="form-floating mb-3">
                            <input class="form-control text-center text-primary font-weight-bold" 
                                   id="code" type="text" name="code" 
                                   placeholder="000 000" autocomplete="off" required 
                                   style="letter-spacing: 5px; font-size: 1.5rem;" autofocus>
                            <label for="code">Código de Verificación</label>
                        </div>
                        
                        <div class="d-grid gap-2 mt-4 mb-0">
                            <button class="btn btn-primary" type="submit">Verificar</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    <div class="small"><a href="<?php echo URLROOT; ?>/auth/logout">Cancelar y volver al inicio</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card card-body bg-light mt-5">
            <h2>Crear una Cuenta</h2>
            <p>Por favor llena este formulario para registrarte con nosotros</p>
            <form action="<?php echo URLROOT; ?>/auth/register" method="post">
                    <select name="role_id" class="form-select form-control-lg">
                        <option value="5">Estudiante</option>
                        <option value="4">Empresa</option>
                        <option value="3">Tutor</option>
                        <!-- Admin y Coordinador no deberían registrarse públicamente, pero lo dejamos abierto por simplicidad de la demo -->
                        <option value="2">Coordinador</option>
                        <option value="1">Administrador</option>
                    </select>
                </div>
                
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Registrarse" class="btn btn-success btn-block w-100">
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT; ?>/auth/login" class="btn btn-light btn-block w-100">¿Ya tienes cuenta? Ingresa</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

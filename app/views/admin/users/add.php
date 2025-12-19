<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-8 mx-auto mt-4">
        <div class="card card-body bg-light mt-2 shadow-sm">
            <h3><i class="fas fa-user-plus me-2"></i>Crear Nuevo Usuario</h3>
            <p>Complete el formulario para registrar un usuario en el sistema.</p>
            <form action="<?php echo URLROOT; ?>/admin/users_add" method="post" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre">Nombre Completo: <sup>*</sup></label>
                        <input type="text" name="nombre" class="form-control" value="<?php echo $data['nombre']; ?>">
                        <span class="invalid-feedback"><?php echo $data['nombre_err']; ?></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email">Email: <sup>*</sup></label>
                        <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>">
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                         <label for="role_id">Rol de Usuario: <sup>*</sup></label>
                         <select name="role_id" id="role_id" class="form-select">
                             <option value="5" <?php echo ($data['role_id'] == 5) ? 'selected' : ''; ?>>Estudiante</option>
                             <option value="4" <?php echo ($data['role_id'] == 4) ? 'selected' : ''; ?>>Representante Empresa</option>
                             <option value="3" <?php echo ($data['role_id'] == 3) ? 'selected' : ''; ?>>Tutor Académico</option>
                             <option value="2" <?php echo ($data['role_id'] == 2) ? 'selected' : ''; ?>>Coordinador</option>
                             <option value="1" <?php echo ($data['role_id'] == 1) ? 'selected' : ''; ?>>Administrador</option>
                         </select>
                    </div>
                </div>

                <!-- Company Selector (Hidden by default) -->
                <div id="company-field" style="display: none;" class="mb-3">
                    <label for="empresa_id">Asignar a Empresa:</label>
                    <select name="empresa_id" id="empresa_id" class="form-select">
                        <option value="">-- Seleccionar Empresa --</option>
                        <?php if(isset($data['empresas_list'])): ?>
                            <?php foreach($data['empresas_list'] as $empresa): ?>
                                <option value="<?php echo $empresa->id; ?>" <?php echo (isset($data['empresa_id']) && $data['empresa_id'] == $empresa->id) ? 'selected' : ''; ?>>
                                    <?php echo $empresa->nombre; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password">Contraseña: <sup>*</sup></label>
                        <input type="password" name="password" class="form-control" value="<?php echo $data['password']; ?>">
                         <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="confirm_password">Confirmar: <sup>*</sup></label>
                        <input type="password" name="confirm_password" class="form-control" value="<?php echo $data['confirm_password']; ?>">
                    </div>
                </div>

                <!-- Student Fields (Hidden by default) -->
                <div id="student-fields" style="display: none;" class="bg-white p-3 border rounded mt-3">
                    <h5 class="text-primary border-bottom pb-2"><i class="fas fa-user-graduate me-2"></i>Perfil de Estudiante</h5>

                    <!-- 1. Personal -->
                    <h6 class="mt-3 text-muted">Información Personal</h6>
                    <div class="row">
                         <div class="col-md-3 mb-2">
                             <label>DUI:</label>
                             <input type="text" name="dui" class="form-control form-control-sm" value="<?php echo $data['dui']; ?>">
                         </div>
                         <div class="col-md-2 mb-2">
                             <label>Edad:</label>
                             <input type="number" name="edad" class="form-control form-control-sm" value="<?php echo $data['edad']; ?>">
                         </div>
                         <div class="col-md-2 mb-2">
                             <label>Género:</label>
                             <select name="genero" class="form-select form-select-sm">
                                 <option value="">--</option>
                                 <option value="Masculino">Masculino</option>
                                 <option value="Femenino">Femenino</option>
                                 <option value="Otro">Otro</option>
                             </select>
                         </div>
                         <div class="col-md-2 mb-2">
                             <label>Estado Civil:</label>
                             <select name="estado_civil" class="form-select form-select-sm">
                                 <option value="">--</option>
                                 <option value="Soltero">Soltero/a</option>
                                 <option value="Casado">Casado/a</option>
                             </select>
                         </div>
                         <div class="col-md-3 mb-2">
                             <label>Teléfono:</label>
                             <input type="text" name="telefono" class="form-control form-control-sm" value="<?php echo $data['telefono']; ?>">
                         </div>
                    </div>

                    <!-- 2. Ubicación -->
                    <h6 class="mt-3 text-muted">Ubicación</h6>
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label>Dirección:</label>
                            <input type="text" name="direccion" class="form-control form-control-sm" value="<?php echo $data['direccion']; ?>">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Departamento:</label>
                            <input type="text" name="departamento" class="form-control form-control-sm" value="<?php echo $data['departamento']; ?>">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Municipio:</label>
                            <input type="text" name="municipio" class="form-control form-control-sm" value="<?php echo $data['municipio']; ?>">
                        </div>
                    </div>

                    <!-- 3. Académico -->
                    <h6 class="mt-3 text-muted">Académico & Ocupacional</h6>
                    <div class="row">
                        <div class="col-md-3 mb-2">
                             <label for="matricula">Matrícula:</label>
                             <input type="text" name="matricula" class="form-control form-control-sm" value="<?php echo $data['matricula']; ?>">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="carrera_id">Carrera:</label>
                            <select name="carrera_id" class="form-select form-select-sm">
                                <option value="">Seleccione</option>
                                <?php if(isset($data['carreras'])): ?>
                                    <?php foreach($data['carreras'] as $carrera): ?>
                                        <option value="<?php echo $carrera->id; ?>" <?php echo ($data['carrera_id'] == $carrera->id) ? 'selected' : ''; ?>>
                                            <?php echo $carrera->nombre; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                             <label>Institución:</label>
                             <input type="text" name="institucion" class="form-control form-control-sm" value="<?php echo $data['institucion']; ?>">
                        </div>
                        <div class="col-md-3 mb-2">
                             <label>Nivel Académico:</label>
                             <input type="text" name="nivel_academico" class="form-control form-control-sm" value="<?php echo $data['nivel_academico']; ?>">
                        </div>
                        <div class="col-md-4 mb-2">
                             <label>Estado Ocupacional:</label>
                             <select name="estado_ocupacional" class="form-select form-select-sm">
                                 <option value="">--</option>
                                 <option value="Estudia">Solo Estudia</option>
                                 <option value="Trabaja">Solo Trabaja</option>
                                 <option value="Ambos">Estudia y Trabaja</option>
                             </select>
                        </div>
                    </div>

                    <!-- 4. Habilidades y Archivos -->
                    <h6 class="mt-3 text-muted">Habilidades & Archivos</h6>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>Habilidades (Seleccionar múltiples):</label>
                            <div class="card card-body p-2" style="max-height: 150px; overflow-y: auto;">
                                <?php if(isset($data['skills_list'])): ?>
                                    <?php foreach($data['skills_list'] as $skill): ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="habilidades[]" value="<?php echo $skill->id; ?>" id="skill_<?php echo $skill->id; ?>">
                                            <label class="form-check-label" for="skill_<?php echo $skill->id; ?>">
                                                <?php echo $skill->nombre; ?> <small class="text-muted">(<?php echo $skill->tipo; ?>)</small>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Curriculum Vitae (PDF/IMG):</label>
                            <input type="file" name="cv_file" class="form-control form-control-sm" accept=".pdf,.png,.jpg">
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="<?php echo URLROOT; ?>/admin/users" class="btn btn-secondary">Cancelar</a>
                    <input type="submit" value="Crear Usuario" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.querySelector('select[name="role_id"]');
        const studentFields = document.getElementById('student-fields');
        const companyField = document.getElementById('company-field');

        function toggleStudentFields() {
            // Hide all first
            studentFields.style.display = 'none';
            if(companyField) companyField.style.display = 'none';

            if(roleSelect.value == '5'){ // 5 = Estudiante
                studentFields.style.display = 'block';
            } else if(roleSelect.value == '4'){ // 4 = Empresa Rep
                if(companyField) companyField.style.display = 'block';
            }
        }

        roleSelect.addEventListener('change', toggleStudentFields);
        toggleStudentFields(); // Run on load
    });
</script>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-8 mx-auto mt-4">
        <div class="card card-body bg-light mt-2 shadow-sm mb-4">
            <h3><i class="fas fa-user-edit me-2"></i>Editar Usuario</h3>
            <p>Modifique la información del usuario.</p>
            <form action="<?php echo URLROOT; ?>/admin/users_edit/<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">
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
                        <label for="role_id">Rol de Usuario: <sup>*</sup></label>
                        <select name="role_id" id="role_id" class="form-select">
                            <option value="5" <?php echo ($data['role_id'] == 5) ? 'selected' : ''; ?>>Estudiante</option>
                            <option value="4" <?php echo ($data['role_id'] == 4) ? 'selected' : ''; ?>>Representante Empresa</option>
                            <option value="3" <?php echo ($data['role_id'] == 3) ? 'selected' : ''; ?>>Tutor Académico</option>
                            <option value="2" <?php echo ($data['role_id'] == 2) ? 'selected' : ''; ?>>Coordinador</option>
                            <option value="1" <?php echo ($data['role_id'] == 1) ? 'selected' : ''; ?>>Administrador</option>
                        </select>
                    </div>
                     <div class="col-md-6 mb-3">
                        <label for="password">Contraseña (Dejar en blanco para no cambiar):</label>
                        <input type="password" name="password" class="form-control" value="" placeholder="Nueva contraseña (opcional)">
                        <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                    </div>
                </div>

                <!-- Student Fields -->
                <div id="student-fields" style="display: <?php echo ($data['role_id'] == 5) ? 'block' : 'none'; ?>;" class="bg-white p-3 border rounded mt-3">
                    <h5 class="text-primary border-bottom pb-2"><i class="fas fa-user-graduate me-2"></i>Perfil de Estudiante</h5>

                    <!-- Tabs -->
                    <ul class="nav nav-tabs mb-3" id="studentTab" role="tablist">
                      <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab">Personal</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="location-tab" data-bs-toggle="tab" data-bs-target="#location" type="button" role="tab">Ubicación</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="academic-tab" data-bs-toggle="tab" data-bs-target="#academic" type="button" role="tab">Académico</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="skills-tab" data-bs-toggle="tab" data-bs-target="#skills" type="button" role="tab">Habilidades & CV</button>
                      </li>
                    </ul>
                    
                    <div class="tab-content" id="studentTabContent">
                        <!-- Personal -->
                        <div class="tab-pane fade show active" id="personal" role="tabpanel">
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
                                         <option value="Masculino" <?php echo ($data['genero'] == 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                                         <option value="Femenino" <?php echo ($data['genero'] == 'Femenino') ? 'selected' : ''; ?>>Femenino</option>
                                         <option value="Otro" <?php echo ($data['genero'] == 'Otro') ? 'selected' : ''; ?>>Otro</option>
                                     </select>
                                 </div>
                                 <div class="col-md-2 mb-2">
                                     <label>Estado Civil:</label>
                                     <select name="estado_civil" class="form-select form-select-sm">
                                         <option value="">--</option>
                                         <option value="Soltero" <?php echo ($data['estado_civil'] == 'Soltero') ? 'selected' : ''; ?>>Soltero/a</option>
                                         <option value="Casado" <?php echo ($data['estado_civil'] == 'Casado') ? 'selected' : ''; ?>>Casado/a</option>
                                     </select>
                                 </div>
                                 <div class="col-md-3 mb-2">
                                     <label>Teléfono:</label>
                                     <input type="text" name="telefono" class="form-control form-control-sm" value="<?php echo $data['telefono']; ?>">
                                 </div>
                            </div>
                        </div>
                        
                        <!-- Location -->
                        <div class="tab-pane fade" id="location" role="tabpanel">
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label>Dirección:</label>
                                    <input type="text" name="direccion" class="form-control form-control-sm" value="<?php echo $data['direccion']; ?>">
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Departamento:</label>
                                    <select name="departamento_id" id="departamento_id" class="form-select form-select-sm">
                                        <option value="">Seleccione</option>
                                        <?php if(isset($data['departamentos_list'])): ?>
                                            <?php foreach($data['departamentos_list'] as $dep): ?>
                                                <option value="<?php echo $dep->id; ?>" <?php echo ($data['departamento_id'] == $dep->id) ? 'selected' : ''; ?>>
                                                    <?php echo $dep->nombre; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Municipio:</label>
                                    <select name="municipio_id" id="municipio_id" class="form-select form-select-sm" data-selected="<?php echo $data['municipio_id']; ?>">
                                        <option value="">Seleccione Departamento primero</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Distrito:</label>
                                    <select name="distrito_id" id="distrito_id" class="form-select form-select-sm" data-selected="<?php echo $data['distrito_id']; ?>">
                                        <option value="">Seleccione Municipio primero</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Academic -->
                        <div class="tab-pane fade" id="academic" role="tabpanel">
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
                                         <option value="Estudia" <?php echo ($data['estado_ocupacional'] == 'Estudia') ? 'selected' : ''; ?>>Solo Estudia</option>
                                         <option value="Trabaja" <?php echo ($data['estado_ocupacional'] == 'Trabaja') ? 'selected' : ''; ?>>Solo Trabaja</option>
                                         <option value="Ambos" <?php echo ($data['estado_ocupacional'] == 'Ambos') ? 'selected' : ''; ?>>Estudia y Trabaja</option>
                                     </select>
                                </div>
                            </div>
                        </div>

                        <!-- Skills & CV -->
                        <div class="tab-pane fade" id="skills" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label>Habilidades (Seleccionar múltiples):</label>
                                    <div class="card card-body p-2" style="max-height: 200px; overflow-y: auto;">
                                        <?php if(isset($data['skills_list'])): ?>
                                            <?php foreach($data['skills_list'] as $skill): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="habilidades[]" value="<?php echo $skill->id; ?>" id="skill_<?php echo $skill->id; ?>"
                                                    <?php echo in_array($skill->id, $data['habilidades']) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="skill_<?php echo $skill->id; ?>">
                                                        <?php echo $skill->nombre; ?> <small class="text-muted">(<?php echo $skill->tipo; ?>)</small>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Actualizar CV (PDF/IMG):</label>
                                    <input type="file" name="cv_file" class="form-control form-control-sm" accept=".pdf,.png,.jpg">
                                    <?php if(!empty($data['cv_path'])): ?>
                                        <div class="mt-2">
                                            <a href="<?php echo URLROOT; ?>/uploads/cvs/<?php echo $data['cv_path']; ?>" target="_blank" class="btn btn-sm btn-outline-info">
                                                <i class="fas fa-eye"></i> Ver CV Actual
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="<?php echo URLROOT; ?>/admin/users" class="btn btn-secondary">Cancelar</a>
                    <input type="submit" value="Actualizar Usuario" class="btn btn-warning">
                </div>
            </form>
        </div>

        <?php if($data['role_id'] == 5): // Show only for students ?>
            <!-- Experience Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-briefcase me-2"></i>Experiencia Laboral</h5>
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addExpModal"><i class="fas fa-plus"></i> Agregar</button>
                </div>
                <div class="card-body">
                    <?php if(!empty($data['experiences'])): ?>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead><tr><th>Empresa</th><th>Cargo</th><th>Periodo</th><th>Acciones</th></tr></thead>
                                <tbody>
                                    <?php foreach($data['experiences'] as $exp): ?>
                                        <tr>
                                            <td><?php echo $exp->empresa; ?></td>
                                            <td><?php echo $exp->cargo; ?></td>
                                            <td><?php echo $exp->fecha_inicio . ' - ' . ($exp->fecha_fin ? $exp->fecha_fin : 'Actual'); ?></td>
                                            <td>
                                                <a href="<?php echo URLROOT; ?>/admin/users_experience_delete/<?php echo $data['id']; ?>/<?php echo $exp->id; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Eliminar?');"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted text-center">No hay experiencia registrada.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Certificates Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                     <h5 class="mb-0"><i class="fas fa-certificate me-2"></i>Certificados</h5>
                     <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addCertModal"><i class="fas fa-plus"></i> Aggregar</button>
                </div>
                <div class="card-body">
                    <?php if(!empty($data['certificates'])): ?>
                         <div class="row">
                             <?php foreach($data['certificates'] as $cert): ?>
                                 <div class="col-md-4 mb-3">
                                     <div class="card h-100 border">
                                         <div class="card-body text-center">
                                             <i class="fas fa-file-pdf fa-3x text-danger mb-2"></i>
                                             <h6 class="card-title"><?php echo $cert->nombre; ?></h6>
                                             <a href="<?php echo URLROOT; ?>/uploads/certificates/<?php echo $cert->archivo_path; ?>" target="_blank" class="btn btn-sm btn-outline-primary mb-2">Ver</a>
                                             <a href="<?php echo URLROOT; ?>/admin/users_certificate_delete/<?php echo $data['id']; ?>/<?php echo $cert->id; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Eliminar?');">Eliminar</a>
                                         </div>
                                     </div>
                                 </div>
                             <?php endforeach; ?>
                         </div>
                    <?php else: ?>
                        <p class="text-muted text-center">No hay certificados.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Modals -->
            <!-- Add Experience Modal -->
            <div class="modal fade" id="addExpModal" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form action="<?php echo URLROOT; ?>/admin/users_experience_add/<?php echo $data['id']; ?>" method="post">
                      <div class="modal-header">
                        <h5 class="modal-title">Agregar Experiencia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                           <div class="mb-2"><label>Empresa:</label><input type="text" name="empresa" class="form-control" required></div>
                           <div class="mb-2"><label>Cargo:</label><input type="text" name="cargo" class="form-control" required></div>
                           <div class="row">
                               <div class="col-6 mb-2"><label>Inicio:</label><input type="date" name="fecha_inicio" class="form-control" required></div>
                               <div class="col-6 mb-2"><label>Fin (Dejar vacio si actual):</label><input type="date" name="fecha_fin" class="form-control"></div>
                           </div>
                           <div class="mb-2"><label>Descripción:</label><textarea name="descripcion" class="form-control"></textarea></div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Add Certificate Modal -->
            <div class="modal fade" id="addCertModal" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form action="<?php echo URLROOT; ?>/admin/users_certificate_add/<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">
                      <div class="modal-header">
                        <h5 class="modal-title">Agregar Certificado</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                           <div class="mb-2"><label>Nombre:</label><input type="text" name="nombre" class="form-control" required></div>
                           <div class="mb-2"><label>Archivo:</label><input type="file" name="cert_file" class="form-control" required></div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
        <?php endif; ?>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle Student Fields
        const roleSelect = document.querySelector('select[name="role_id"]');
        const studentFields = document.getElementById('student-fields');
        const companyField = document.getElementById('company-field');

        function toggleStudentFields() {
            studentFields.style.display = 'none';
            if(companyField) companyField.style.display = 'none';

            if(roleSelect.value == '5'){ // 5 = Estudiante
                studentFields.style.display = 'block';
            } else if(roleSelect.value == '4'){ // 4 = Empresa Rep
                if(companyField) companyField.style.display = 'block';
            }
        }

        if(roleSelect){
            roleSelect.addEventListener('change', toggleStudentFields);
            toggleStudentFields();
        }

        // Dependent Dropdowns (Location)
        const depSelect = document.getElementById('departamento_id');
        const munSelect = document.getElementById('municipio_id');
        const disSelect = document.getElementById('distrito_id');

        function loadMunicipios(depId, selectedMunId = null) {
            if(!depId) {
                munSelect.innerHTML = '<option value="">Seleccione Departamento primero</option>';
                disSelect.innerHTML = '<option value="">Seleccione Municipio primero</option>';
                return;
            }
            munSelect.innerHTML = '<option value="">Cargando...</option>';
            fetch('<?php echo URLROOT; ?>/admin/get_municipios/' + depId)
                .then(response => response.json())
                .then(data => {
                    munSelect.innerHTML = '<option value="">Seleccione</option>';
                    data.forEach(m => {
                        let isSelected = (selectedMunId && selectedMunId == m.id) ? 'selected' : '';
                        munSelect.innerHTML += `<option value="${m.id}" ${isSelected}>${m.nombre}</option>`;
                    });
                    // Create even if event change not triggered, we might want to load distritos if mun is pre-selected
                    if(selectedMunId) {
                         loadDistritos(selectedMunId, disSelect.getAttribute('data-selected'));
                    }
                })
                .catch(err => console.error(err));
        }

        function loadDistritos(munId, selectedDisId = null) {
            if(!munId) {
                disSelect.innerHTML = '<option value="">Seleccione Municipio primero</option>';
                return;
            }
            disSelect.innerHTML = '<option value="">Cargando...</option>';
            fetch('<?php echo URLROOT; ?>/admin/get_distritos/' + munId) 
                .then(response => response.json())
                .then(data => {
                    disSelect.innerHTML = '<option value="">Seleccione</option>';
                    data.forEach(d => {
                        let isSelected = (selectedDisId && selectedDisId == d.id) ? 'selected' : '';
                        disSelect.innerHTML += `<option value="${d.id}" ${isSelected}>${d.nombre}</option>`;
                    });
                })
                .catch(err => console.error(err));
        }

        if(depSelect) {
            depSelect.addEventListener('change', function() {
                loadMunicipios(this.value);
                disSelect.innerHTML = '<option value="">Seleccione Municipio primero</option>';
            });
            
            // Initial load check
            if(depSelect.value) {
                loadMunicipios(depSelect.value, munSelect.getAttribute('data-selected'));
            }
        }

        if(munSelect) {
            munSelect.addEventListener('change', function() {
                loadDistritos(this.value);
            });
        }
    });
</script>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

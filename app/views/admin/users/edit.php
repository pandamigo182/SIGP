<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-10 mx-auto mt-4">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
             <div>
                <h3 class="fw-bold text-dark"><i class="fas fa-user-edit me-2"></i>Editar Usuario</h3>
                <p class="text-muted mb-0">Modifique la información del usuario.</p>
            </div>
            <a href="<?php echo URLROOT; ?>/admin/users" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Volver</a>
        </div>

        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4">
                 <form action="<?php echo URLROOT; ?>/admin/users_edit/<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">
                    
                    <!-- Unified Tabs -->
                    <ul class="nav nav-pills mb-4" id="userTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab"><i class="fas fa-info-circle me-2"></i>General</button>
                        </li>
                        <!-- Student Tabs (Hidden by default, controlled by JS) -->
                        <li class="nav-item student-tab" role="presentation">
                             <button class="nav-link" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab"><i class="fas fa-id-card me-2"></i>Personal</button>
                        </li>
                        <li class="nav-item student-tab" role="presentation">
                             <button class="nav-link" id="location-tab" data-bs-toggle="tab" data-bs-target="#location" type="button" role="tab"><i class="fas fa-map-marker-alt me-2"></i>Ubicación</button>
                        </li>
                        <li class="nav-item student-tab" role="presentation">
                             <button class="nav-link" id="academic-tab" data-bs-toggle="tab" data-bs-target="#academic" type="button" role="tab"><i class="fas fa-graduation-cap me-2"></i>Académico</button>
                        </li>
                        <li class="nav-item student-tab" role="presentation">
                             <button class="nav-link" id="skills-tab" data-bs-toggle="tab" data-bs-target="#skills" type="button" role="tab"><i class="fas fa-star me-2"></i>Habilidades</button>
                        </li>
                        <li class="nav-item student-tab" role="presentation">
                             <button class="nav-link" id="experience-tab" data-bs-toggle="tab" data-bs-target="#experience" type="button" role="tab"><i class="fas fa-briefcase me-2"></i>Experiencia</button>
                        </li>
                        <li class="nav-item student-tab" role="presentation">
                             <button class="nav-link" id="certificates-tab" data-bs-toggle="tab" data-bs-target="#certificates" type="button" role="tab"><i class="fas fa-certificate me-2"></i>Certificados</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="userTabContent">
                        
                        <!-- General Tab -->
                        <div class="tab-pane fade show active" id="general" role="tabpanel">
                             <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre" class="form-label">Nombre Completo: <span class="text-danger">*</span></label>
                                    <input type="text" name="nombre" class="form-control" value="<?php echo $data['nombre']; ?>" required>
                                    <span class="invalid-feedback <?php echo (!empty($data['nombre_err'])) ? 'd-block' : ''; ?>"><?php echo $data['nombre_err']; ?></span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email: <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>" required>
                                    <span class="invalid-feedback <?php echo (!empty($data['email_err'])) ? 'd-block' : ''; ?>"><?php echo $data['email_err']; ?></span>
                                </div>
                            </div>
                            
                            <div class="row">
                                 <div class="col-md-6 mb-3">
                                    <label for="role_id" class="form-label">Rol de Usuario: <span class="text-danger">*</span></label>
                                    <select name="role_id" id="role_id" class="form-select">
                                        <option value="5" <?php echo ($data['role_id'] == 5) ? 'selected' : ''; ?>>Estudiante</option>
                                        <option value="4" <?php echo ($data['role_id'] == 4) ? 'selected' : ''; ?>>Representante Empresa</option>
                                        <option value="3" <?php echo ($data['role_id'] == 3) ? 'selected' : ''; ?>>Tutor Académico</option>
                                        <option value="2" <?php echo ($data['role_id'] == 2) ? 'selected' : ''; ?>>Coordinador</option>
                                        <option value="1" <?php echo ($data['role_id'] == 1) ? 'selected' : ''; ?>>Administrador</option>
                                    </select>
                                </div>
                                 <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Contraseña:</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-lock text-secondary"></i></span>
                                        <input type="password" name="password" class="form-control" placeholder="Dejar en blanco para mantener">
                                    </div>
                                    <span class="invalid-feedback d-block"><?php echo $data['password_err']; ?></span>
                                </div>
                            </div>

                            <!-- Company Selector (Dynamic) -->
                            <div id="company-field" style="display: none;" class="mb-3 p-3 bg-light rounded">
                                <label for="empresa_id" class="form-label fw-bold"><i class="fas fa-building me-2"></i>Asignar a Empresa:</label>
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
                        </div>

                        <!-- STUDENT TABS START -->
                        
                        <!-- Personal -->
                        <div class="tab-pane fade" id="personal" role="tabpanel">
                            <h5 class="mb-3 text-primary border-bottom pb-2">Información Personal</h5>
                            <div class="row">
                                 <div class="col-md-3 mb-3">
                                     <label class="form-label">DUI</label>
                                     <input type="text" name="dui" class="form-control" value="<?php echo $data['dui']; ?>" maxlength="10">
                                 </div>
                                 <div class="col-md-2 mb-3">
                                     <label class="form-label">Edad</label>
                                     <input type="number" name="edad" class="form-control" value="<?php echo $data['edad']; ?>">
                                 </div>
                                 <div class="col-md-2 mb-3">
                                     <label class="form-label">Género</label>
                                     <select name="genero" class="form-select">
                                         <option value="">--</option>
                                         <option value="Masculino" <?php echo ($data['genero'] == 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                                         <option value="Femenino" <?php echo ($data['genero'] == 'Femenino') ? 'selected' : ''; ?>>Femenino</option>
                                         <option value="Otro" <?php echo ($data['genero'] == 'Otro') ? 'selected' : ''; ?>>Otro</option>
                                     </select>
                                 </div>
                                 <div class="col-md-2 mb-3">
                                     <label class="form-label">Estado Civil</label>
                                     <select name="estado_civil" class="form-select">
                                         <option value="">--</option>
                                         <option value="Soltero" <?php echo ($data['estado_civil'] == 'Soltero') ? 'selected' : ''; ?>>Soltero/a</option>
                                         <option value="Casado" <?php echo ($data['estado_civil'] == 'Casado') ? 'selected' : ''; ?>>Casado/a</option>
                                     </select>
                                 </div>
                                 <div class="col-md-3 mb-3">
                                     <label class="form-label">Teléfono</label>
                                     <input type="text" name="telefono" class="form-control" value="<?php echo $data['telefono']; ?>">
                                 </div>
                            </div>
                        </div>
                        
                        <!-- Location -->
                        <div class="tab-pane fade" id="location" role="tabpanel">
                            <h5 class="mb-3 text-primary border-bottom pb-2">Ubicación Residencial</h5>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Dirección Exacta</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-map-marker-alt text-secondary"></i></span>
                                        <input type="text" name="direccion" class="form-control" value="<?php echo $data['direccion']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Departamento</label>
                                    <select name="departamento_id" id="departamento_id" class="form-select">
                                        <option value="">Seleccione</option>
                                        <?php if(isset($data['departamentos_list'])): ?>
                                            <?php foreach($data['departamentos_list'] as $dep): ?>
                                                <option value="<?php echo $dep->id_departamento; ?>" <?php echo ($data['departamento_id'] == $dep->id_departamento) ? 'selected' : ''; ?>>
                                                    <?php echo $dep->departamento; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Municipio</label>
                                    <select name="municipio_id" id="municipio_id" class="form-select" data-selected="<?php echo $data['municipio_id']; ?>">
                                        <option value="">Seleccione Departamento</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Distrito</label>
                                    <select name="distrito_id" id="distrito_id" class="form-select" data-selected="<?php echo $data['distrito_id']; ?>">
                                        <option value="">Seleccione Municipio</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Academic -->
                        <div class="tab-pane fade" id="academic" role="tabpanel">
                             <h5 class="mb-3 text-primary border-bottom pb-2">Datos Académicos</h5>
                             <div class="row">
                                <div class="col-md-3 mb-3">
                                     <label class="form-label">Matrícula (Carnet)</label>
                                     <input type="text" name="matricula" class="form-control" value="<?php echo $data['matricula']; ?>">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Carrera Universitaria</label>
                                    <select name="carrera_id" class="form-select">
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
                                <div class="col-md-3 mb-3">
                                     <label class="form-label">Institución</label>
                                     <input type="text" name="institucion" class="form-control" value="<?php echo $data['institucion']; ?>">
                                </div>
                                <div class="col-md-2 mb-3">
                                     <label class="form-label">Nivel</label>
                                     <input type="text" name="nivel_academico" class="form-control" value="<?php echo $data['nivel_academico']; ?>" placeholder="Ej: 4to Año">
                                </div>
                                <div class="col-md-4 mb-3">
                                     <label class="form-label">Estado Ocupacional</label>
                                     <select name="estado_ocupacional" class="form-select">
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
                            <h5 class="mb-3 text-primary border-bottom pb-2">Habilidades y CV</h5>
                            <div class="row">
                                <div class="col-md-7 mb-4">
                                    <label class="form-label">Habilidades (Seleccionar múltiples)</label>
                                    <div class="card card-body p-2 border bg-light" style="max-height: 250px; overflow-y: auto;">
                                        <?php if(isset($data['skills_list'])): ?>
                                            <?php foreach($data['skills_list'] as $skill): ?>
                                                <div class="form-check mb-1">
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
                                <div class="col-md-5 mb-4">
                                    <label class="form-label">Hoja de Vida (CV)</label>
                                    <div class="card card-body text-center border-dashed">
                                        <?php if(!empty($data['cv_path'])): ?>
                                            <div class="mb-3">
                                                <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                                <p class="small text-muted mt-1">CV Actual Cursado</p>
                                                <a href="<?php echo URLROOT; ?>/uploads/cvs/<?php echo $data['cv_path']; ?>" target="_blank" class="btn btn-sm btn-info text-white"><i class="fas fa-eye me-1"></i>Ver Documento</a>
                                            </div>
                                            <hr>
                                        <?php endif; ?>
                                        <label class="form-label small text-muted">Subir nuevo archivo (PDF/IMG)</label>
                                        <input type="file" name="cv_file" class="form-control form-control-sm" accept=".pdf,.png,.jpg">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Experience Tab -->
                        <div class="tab-pane fade" id="experience" role="tabpanel">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0 text-primary">Historial Laboral</h5>
                                <button type="button" class="btn btn-sm btn-success rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#addExpModal"><i class="fas fa-plus me-1"></i> Agregar</button>
                            </div>
                            <?php if(!empty($data['experiences'])): ?>
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead class="table-light"><tr><th>Empresa</th><th>Cargo</th><th>Periodo</th><th class="text-end">Acciones</th></tr></thead>
                                        <tbody>
                                            <?php foreach($data['experiences'] as $exp): ?>
                                                <tr>
                                                    <td class="fw-bold"><?php echo $exp->empresa; ?></td>
                                                    <td><?php echo $exp->cargo; ?></td>
                                                    <td><span class="badge bg-light text-dark border"><?php echo $exp->fecha_inicio; ?> - <?php echo ($exp->fecha_fin ? $exp->fecha_fin : 'Actual'); ?></span></td>
                                                    <td class="text-end">
                                                        <a href="<?php echo URLROOT; ?>/admin/users_experience_delete/<?php echo $data['id']; ?>/<?php echo $exp->id; ?>" class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Eliminar?');"><i class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <div class="text-center py-4 bg-light rounded border-dashed">
                                    <i class="fas fa-briefcase text-muted fa-2x mb-2"></i>
                                    <p class="text-muted mb-0">No se ha registrado experiencia laboral.</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Certificates Tab -->
                        <div class="tab-pane fade" id="certificates" role="tabpanel">
                             <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0 text-primary">Certificaciones y Diplomas</h5>
                                <button type="button" class="btn btn-sm btn-success rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#addCertModal"><i class="fas fa-plus me-1"></i> Agregar</button>
                            </div>
                            <?php if(!empty($data['certificates'])): ?>
                                 <div class="row g-3">
                                     <?php foreach($data['certificates'] as $cert): ?>
                                         <div class="col-md-4 col-lg-3">
                                             <div class="card h-100 border shadow-sm hover-shadow transition-all">
                                                 <div class="card-body text-center p-3 position-relative">
                                                     <a href="<?php echo URLROOT; ?>/admin/users_certificate_delete/<?php echo $data['id']; ?>/<?php echo $cert->id; ?>" class="position-absolute top-0 end-0 m-2 text-danger" onclick="return confirm('Eliminar?');"><i class="fas fa-times-circle"></i></a>
                                                     <i class="fas fa-award fa-3x text-warning mb-3"></i>
                                                     <h6 class="card-title text-truncate fw-bold mb-2" title="<?php echo $cert->nombre; ?>"><?php echo $cert->nombre; ?></h6>
                                                     <a href="<?php echo URLROOT; ?>/uploads/certificates/<?php echo $cert->archivo_path; ?>" target="_blank" class="btn btn-sm btn-outline-primary w-100 rounded-pill mt-2">Ver Certificado</a>
                                                 </div>
                                             </div>
                                         </div>
                                     <?php endforeach; ?>
                                 </div>
                            <?php else: ?>
                                <div class="text-center py-4 bg-light rounded border-dashed">
                                    <i class="fas fa-certificate text-muted fa-2x mb-2"></i>
                                    <p class="text-muted mb-0">No hay certificados registrados.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4 fw-bold"><i class="fas fa-save me-2"></i>Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
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
               <div class="mb-3"><label class="form-label">Empresa</label><input type="text" name="empresa" class="form-control" required></div>
               <div class="mb-3"><label class="form-label">Cargo</label><input type="text" name="cargo" class="form-control" required></div>
               <div class="row">
                   <div class="col-6 mb-3"><label class="form-label">Inicio</label><input type="date" name="fecha_inicio" class="form-control" required></div>
                   <div class="col-6 mb-3"><label class="form-label">Fin <small class="text-muted">(Opcional)</small></label><input type="date" name="fecha_fin" class="form-control"></div>
               </div>
               <div class="mb-3"><label class="form-label">Descripción</label><textarea name="descripcion" class="form-control" rows="2"></textarea></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
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
               <div class="mb-3"><label class="form-label">Nombre del Certificado</label><input type="text" name="nombre" class="form-control" required></div>
               <div class="mb-3"><label class="form-label">Archivo (PDF/IMG)</label><input type="file" name="cert_file" class="form-control" required></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
      </form>
    </div>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle Student/Company Fields
        const roleSelect = document.getElementById('role_id');
        const companyField = document.getElementById('company-field');
        const studentTabs = document.querySelectorAll('.student-tab');
        
        function toggleRoleFields() {
            let role = roleSelect ? roleSelect.value : '';
            
            // Toggle Company Field
            if(companyField) {
                companyField.style.display = (role == '4') ? 'block' : 'none'; // 4 = Empresa
            }

            // Toggle Student Tabs
            let isStudent = (role == '5'); // 5 = Student
            studentTabs.forEach(tab => {
                tab.style.display = isStudent ? 'block' : 'none';
            });
            
            // If active tab is hidden, switch to General
            let activeTab = document.querySelector('.nav-link.active');
            if(activeTab && activeTab.closest('.student-tab') && !isStudent) {
                let generalTabBtn = document.getElementById('general-tab');
                if(generalTabBtn) {
                     var tab = new bootstrap.Tab(generalTabBtn);
                     tab.show();
                }
            }
        }

        if(roleSelect){
            roleSelect.addEventListener('change', toggleRoleFields);
            toggleRoleFields(); // Initial check
        }
        
        // --- Location Dependent Dropdowns (Same as before) ---
        const depSelect = document.getElementById('departamento_id');
        const munSelect = document.getElementById('municipio_id');
        const disSelect = document.getElementById('distrito_id');

        function clearSelect(select, defaultText) {
            select.innerHTML = `<option value="">${defaultText}</option>`;
        }

        function loadMunicipios(depId, selectedMunId = null) {
            if(!depId) {
                clearSelect(munSelect, 'Seleccione Departamento primero');
                clearSelect(disSelect, 'Seleccione Municipio primero');
                return;
            }
            munSelect.innerHTML = '<option value="">Cargando...</option>';
            
            fetch('<?php echo URLROOT; ?>/admin/get_municipios/' + depId)
                .then(response => response.json())
                .then(data => {
                    clearSelect(munSelect, 'Seleccione');
                    data.forEach(m => {
                        let isSelected = (selectedMunId && selectedMunId == m.id_municipio) ? 'selected' : '';
                        munSelect.innerHTML += `<option value="${m.id_municipio}" ${isSelected}>${m.municipio}</option>`;
                    });
                     if(selectedMunId) {
                         loadDistritos(selectedMunId, disSelect.getAttribute('data-selected'));
                    }
                });
        }

        function loadDistritos(munId, selectedDisId = null) {
             if(!munId) {
                clearSelect(disSelect, 'Seleccione Municipio primero');
                return;
            }
            disSelect.innerHTML = '<option value="">Cargando...</option>';
            
            fetch('<?php echo URLROOT; ?>/admin/get_distritos/' + munId)
                .then(response => response.json())
                .then(data => {
                    clearSelect(disSelect, 'Seleccione');
                    data.forEach(d => {
                        let isSelected = (selectedDisId && selectedDisId == d.id_distrito) ? 'selected' : '';
                        disSelect.innerHTML += `<option value="${d.id_distrito}" ${isSelected}>${d.distrito}</option>`;
                    });
                });
        }

        if(depSelect) {
            depSelect.addEventListener('change', function() {
                loadMunicipios(this.value);
                clearSelect(disSelect, 'Seleccione Municipio primero');
            });
            if(depSelect.value) {
                loadMunicipios(depSelect.value, munSelect.getAttribute('data-selected'));
            }
        }
        if(munSelect) {
            munSelect.addEventListener('change', function() {
                loadDistritos(this.value);
            });
        }

        // DUI Formatting
         const duiInput = document.querySelector('input[name="dui"]');
        if(duiInput){
            duiInput.addEventListener('input', function(e){
                let value = e.target.value.replace(/\D/g, ''); 
                let formatted = '';
                if(value.length > 0) formatted += value.substring(0, 8);
                if(value.length > 8) formatted += '-' + value.substring(8, 9);
                e.target.value = formatted;
            });
            duiInput.maxLength = 10; 
        }
    });
</script>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

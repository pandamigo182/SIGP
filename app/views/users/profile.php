<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-9 mx-auto mt-4">
        
        <?php flash('profile_msg'); ?>

        <div class="card card-body bg-light mt-2 shadow-sm mb-4">
            <div class="d-flex align-items-center mb-3">
                <?php if(!empty($data['foto_perfil'])): ?>
                    <img src="<?php echo URLROOT; ?>/uploads/avatars/<?php echo $data['foto_perfil']; ?>" alt="Perfil" class="rounded-circle me-3" style="width: 80px; height: 80px; object-fit: cover;">
                <?php else: ?>
                    <div class="bg-secondary rounded-circle me-3 d-flex align-items-center justify-content-center text-white" style="width: 80px; height: 80px; font-size: 2rem;">
                        <?php echo strtoupper(substr($data['nombre'], 0, 1)); ?>
                    </div>
                <?php endif; ?>
                <div>
                    <h3><i class="fas fa-id-card me-2"></i>Mi Perfil</h3>
                    <p class="mb-0 text-muted">Gestiona tu información personal y profesional.</p>
                </div>
            </div>

            <form action="<?php echo URLROOT; ?>/users/profile" method="post" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
                
                <!-- Basic Info -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre">Nombre Completo:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $data['nombre']; ?>">
                        <span class="invalid-feedback"><?php echo $data['nombre_err']; ?></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email">Email:</label>
                        <input type="text" name="email" id="email" class="form-control" value="<?php echo $data['email']; ?>" readonly>
                        <small class="text-muted">El email no se puede cambiar.</small>
                    </div>
                </div>

                <div class="row">
                     <div class="col-md-6 mb-3">
                        <label for="foto">Foto de Perfil:</label>
                        <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                    </div>
                     <div class="col-md-6 mb-3">
                        <label for="password">Nueva Contraseña (Opcional):</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Dejar en blanco para mantener actual">
                        <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                    </div>
                </div>

                <?php if($data['user']->role_id == 5): // Student Fields ?>
                    <div class="bg-white p-3 border rounded mt-3">
                        <h5 class="text-primary border-bottom pb-2"><i class="fas fa-user-graduate me-2"></i>Datos de Estudiante</h5>

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
                                         <label for="dui">DUI:</label>
                                         <input type="text" name="dui" id="dui" class="form-control form-control-sm <?php echo (!empty($data['dui_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['dui']; ?>" placeholder="00000000-0">
                                         <span class="invalid-feedback"><?php echo $data['dui_err']; ?></span>
                                     </div>
                                     <div class="col-md-2 mb-2">
                                         <label for="edad">Edad:</label>
                                         <input type="number" name="edad" id="edad" class="form-control form-control-sm" value="<?php echo $data['edad']; ?>">
                                     </div>
                                     <div class="col-md-2 mb-2">
                                         <label for="genero">Género:</label>
                                         <select name="genero" id="genero" class="form-select form-select-sm">
                                             <option value="">--</option>
                                             <option value="Masculino" <?php echo ($data['genero'] == 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                                             <option value="Femenino" <?php echo ($data['genero'] == 'Femenino') ? 'selected' : ''; ?>>Femenino</option>
                                             <option value="Otro" <?php echo ($data['genero'] == 'Otro') ? 'selected' : ''; ?>>Otro</option>
                                         </select>
                                     </div>
                                     <div class="col-md-2 mb-2">
                                         <label for="estado_civil">Estado Civil:</label>
                                         <select name="estado_civil" id="estado_civil" class="form-select form-select-sm">
                                             <option value="">--</option>
                                             <option value="Soltero" <?php echo ($data['estado_civil'] == 'Soltero') ? 'selected' : ''; ?>>Soltero/a</option>
                                             <option value="Casado" <?php echo ($data['estado_civil'] == 'Casado') ? 'selected' : ''; ?>>Casado/a</option>
                                         </select>
                                     </div>
                                     <div class="col-md-3 mb-2">
                                         <label for="telefono">Teléfono:</label>
                                         <input type="text" name="telefono" id="telefono" class="form-control form-control-sm" value="<?php echo $data['telefono']; ?>">
                                     </div>
                                </div>
                            </div>
                            
                            <!-- Location -->
                            <div class="tab-pane fade" id="location" role="tabpanel">
                                 <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <label for="direccion">Dirección:</label>
                                        <input type="text" name="direccion" id="direccion" class="form-control form-control-sm" value="<?php echo $data['direccion']; ?>">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label for="departamento">Departamento:</label>
                                        <input type="text" name="departamento" id="departamento" class="form-control form-control-sm" value="<?php echo $data['departamento']; ?>">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label for="municipio">Municipio:</label>
                                        <input type="text" name="municipio" id="municipio" class="form-control form-control-sm" value="<?php echo $data['municipio']; ?>">
                                    </div>
                                </div>
                            </div>

                            <!-- Academic -->
                            <div class="tab-pane fade" id="academic" role="tabpanel">
                                 <div class="row">
                                    <div class="col-md-3 mb-2">
                                         <label for="matricula">Matrícula:</label>
                                         <input type="text" name="matricula" id="matricula" class="form-control form-control-sm" value="<?php echo $data['matricula']; ?>">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label for="carrera_id">Carrera:</label>
                                        <select name="carrera_id" id="carrera_id" class="form-select form-select-sm">
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
                                         <label for="institucion">Institución:</label>
                                         <input type="text" name="institucion" id="institucion" class="form-control form-control-sm" value="<?php echo $data['institucion']; ?>">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                         <label for="nivel_academico">Nivel Académico:</label>
                                         <input type="text" name="nivel_academico" id="nivel_academico" class="form-control form-control-sm" value="<?php echo $data['nivel_academico']; ?>">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                         <label for="estado_ocupacional">Estado Ocupacional:</label>
                                         <select name="estado_ocupacional" id="estado_ocupacional" class="form-select form-select-sm">
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
                                        <label for="cv_file">Actualizar CV (PDF/IMG):</label>
                                        <input type="file" name="cv_file" id="cv_file" class="form-control form-control-sm" accept=".pdf,.png,.jpg">
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
                <?php endif; ?>

                <div class="d-grid gap-2 mt-4">
                    <input type="submit" value="Guardar Cambios" class="btn btn-primary btn-lg">
                </div>
            </form>
        </div>

        <?php if($data['user']->role_id == 5): ?>
            <!-- Experience & Certs Sections -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Experiencia</h5>
                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addExpModal"><i class="fas fa-plus"></i></button>
                        </div>
                        <div class="card-body p-0">
                            <?php if(!empty($data['experiences'])): ?>
                                <ul class="list-group list-group-flush">
                                    <?php foreach($data['experiences'] as $exp): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong><?php echo $exp->empresa; ?></strong><br>
                                                <small class="text-muted"><?php echo $exp->cargo; ?></small>
                                            </div>
                                            <form action="<?php echo URLROOT; ?>/users/experience_delete/<?php echo $exp->id; ?>" method="post" class="d-inline" onsubmit="return confirm('¿Eliminar experiencia?');">
                                                <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
                                                <button type="submit" class="btn btn-link text-danger p-0 border-0"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p class="text-muted text-center p-3 m-0">Sin registros.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-sm mb-4">
                         <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Certificados</h5>
                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addCertModal"><i class="fas fa-plus"></i></button>
                        </div>
                        <div class="card-body p-0">
                             <?php if(!empty($data['certificates'])): ?>
                                <ul class="list-group list-group-flush">
                                    <?php foreach($data['certificates'] as $cert): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-file-pdf text-danger me-2"></i> 
                                                <a href="<?php echo URLROOT; ?>/uploads/certificates/<?php echo $cert->archivo_path; ?>" target="_blank" class="text-decoration-none text-dark"><?php echo $cert->nombre; ?></a>
                                            </div>
                                            <form action="<?php echo URLROOT; ?>/users/certificate_delete/<?php echo $cert->id; ?>" method="post" class="d-inline" onsubmit="return confirm('¿Eliminar certificado?');">
                                                <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
                                                <button type="submit" class="btn btn-link text-danger p-0 border-0"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p class="text-muted text-center p-3 m-0">Sin certificados.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modals -->
             <!-- Add Experience Modal -->
            <div class="modal fade" id="addExpModal" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form action="<?php echo URLROOT; ?>/users/experience_add" method="post">
                      <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
                      <div class="modal-header">
                        <h5 class="modal-title">Agregar Experiencia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                           <div class="mb-2"><label>Empresa:</label><input type="text" name="empresa" class="form-control" required></div>
                           <div class="mb-2"><label>Cargo:</label><input type="text" name="cargo" class="form-control" required></div>
                           <div class="row">
                               <div class="col-6 mb-2"><label>Inicio:</label><input type="date" name="fecha_inicio" class="form-control" required></div>
                               <div class="col-6 mb-2"><label>Fin (Actual):</label><input type="date" name="fecha_fin" class="form-control"></div>
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
                  <form action="<?php echo URLROOT; ?>/users/certificate_add" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
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
<?php require APPROOT . '/views/layouts/footer.php'; ?>

<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-10 mx-auto mt-4">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-dark"><i class="fas fa-cogs me-2"></i>Configuración del Sistema</h2>
                <p class="text-muted mb-0">Gestione los parámetros generales, identidad visual y datos de contacto.</p>
            </div>
             <a href="<?php echo URLROOT; ?>/admin" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al Dashboard</a>
        </div>

        <?php flash('msg_success'); ?>

        <div class="card shadow-sm rounded-3 border-0">
            <div class="card-header bg-white py-3">
                <ul class="nav nav-pills card-header-pills" id="settingsTab" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button">General e Identidad</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button">Contacto y Redes</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="alerts-tab" data-bs-toggle="tab" data-bs-target="#alerts" type="button">Alertas y Notificaciones</button>
                    </li>
                </ul>
            </div>
            
            <div class="card-body p-4">
                 <form action="<?php echo URLROOT; ?>/admin/settings" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $data['settings']->id ?? ''; ?>">
                    
                    <div class="tab-content" id="myTabContent">
                        
                        <!-- General Tab -->
                        <div class="tab-pane fade show active" id="general">
                            <h5 class="mb-4 text-primary border-bottom pb-2">Información del Sistema</h5>
                           
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small text-muted">Nombre del Sistema (Sitio Web)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-desktop text-secondary"></i></span>
                                        <input type="text" name="nombre_sistema" class="form-control" value="<?php echo $data['settings']->nombre_sistema; ?>" required>
                                    </div>
                                    <small class="text-muted">Aparece en la barra de título y pie de página.</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small text-muted">Nombre de la Empresa Matriz</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-building text-secondary"></i></span>
                                        <input type="text" name="nombre_empresa" class="form-control" value="<?php echo $data['settings']->nombre_empresa; ?>" required>
                                    </div>
                                    <small class="text-muted">Entidad legal responsable.</small>
                                </div>
                            </div>


                        </div>

                        <!-- Contact Tab -->
                        <div class="tab-pane fade" id="contact">
                            <h5 class="mb-4 text-primary border-bottom pb-2">Datos de Contacto</h5>
                             <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small text-muted">Correo Electrónico Oficial</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-envelope text-secondary"></i></span>
                                        <input type="email" name="email" class="form-control" value="<?php echo $data['settings']->email; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small text-muted">Teléfono Principal</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-phone text-secondary"></i></span>
                                        <input type="text" name="telefono" class="form-control" value="<?php echo $data['settings']->telefono; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small text-muted">WhatsApp</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fab fa-whatsapp text-success"></i></span>
                                        <input type="text" name="whatsapp" class="form-control" value="<?php echo $data['settings']->whatsapp; ?>" placeholder="Ej: 50370000000">
                                    </div>
                                </div>
                             </div>

                             <h5 class="mb-4 text-primary border-bottom pb-2">Ubicación</h5>
                             <div class="row mb-4">
                                <div class="col-md-4 mb-3">
                                     <label class="form-label fw-bold small text-muted">Departamento</label>
                                     <select name="departamento_id" id="departamento_id" class="form-select">
                                         <option value="">Seleccione</option>
                                         <?php if(isset($data['departamentos'])): ?>
                                             <?php foreach($data['departamentos'] as $dep): ?>
                                                 <option value="<?php echo $dep->id_departamento; ?>" <?php echo ($data['settings']->departamento_id == $dep->id_departamento) ? 'selected' : ''; ?>>
                                                     <?php echo $dep->departamento; ?>
                                                 </option>
                                             <?php endforeach; ?>
                                         <?php endif; ?>
                                     </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold small text-muted">Municipio</label>
                                    <select name="municipio_id" id="municipio_id" class="form-select" data-selected="<?php echo $data['settings']->municipio_id; ?>">
                                        <option value="">Seleccione Departamento</option>
                                    </select>
                                </div>
                                 <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold small text-muted">Distrito</label>
                                    <select name="distrito_id" id="distrito_id" class="form-select" data-selected="<?php echo $data['settings']->distrito_id; ?>">
                                        <option value="">Seleccione Municipio</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-bold small text-muted">Dirección Exacta</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-map-marker-alt text-secondary"></i></span>
                                        <input type="text" name="direccion" class="form-control" value="<?php echo $data['settings']->direccion; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold small text-muted">Mapa (Google Maps Embed URL)</label>
                                    <small class="d-block text-muted mb-1">Copie el enlace "src" de la opción "Insertar un mapa" de Google Maps.</small>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-map text-secondary"></i></span>
                                        <input type="text" name="map_embed_url" class="form-control" value="<?php echo isset($data['settings']->map_embed_url) ? $data['settings']->map_embed_url : ''; ?>" placeholder="https://www.google.com/maps/embed?...">
                                    </div>
                                    <?php if(!empty($data['settings']->map_embed_url)): ?>
                                        <div class="mt-3 border rounded p-1">
                                            <iframe src="<?php echo $data['settings']->map_embed_url; ?>" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                        </div>
                                    <?php endif; ?>
                                </div>
                             </div>
                        </div>

                        <!-- Alerts Tab -->
                        <div class="tab-pane fade" id="alerts">
                            <h5 class="mb-4 text-primary border-bottom pb-2">Configuración de Alertas por Correo</h5>
                            <div class="alert alert-info border-0 shadow-sm">
                                <i class="fas fa-info-circle me-2"></i> Configure aquí el correo remitente para las notificaciones del sistema (ofertas, confirmaciones, etc.).
                            </div>

                             <div class="row mb-4">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold small text-muted">Correo Remitente (Alertas)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-paper-plane text-secondary"></i></span>
                                        <input type="email" name="email_alertas" class="form-control" value="<?php echo $data['settings']->email_alertas ?? ''; ?>" placeholder="noreply@midominio.com">
                                    </div>
                                    <small class="text-muted">Este correo aparecerá como "De" en las notificaciones enviadas.</small>
                                </div>
                             </div>

                            <h5 class="mb-4 text-primary border-bottom pb-2">Configuración SMTP (Opcional)</h5>
                             <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label class="form-label fw-bold small text-muted">Servidor SMTP (Host)</label>
                                    <input type="text" name="email_smtp_host" class="form-control" value="<?php echo $data['settings']->email_smtp_host ?? ''; ?>" placeholder="smtp.gmail.com">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold small text-muted">Puerto</label>
                                    <input type="number" name="email_smtp_port" class="form-control" value="<?php echo $data['settings']->email_smtp_port ?? '587'; ?>" placeholder="587">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small text-muted">Usuario SMTP</label>
                                    <input type="text" name="email_smtp_user" class="form-control" value="<?php echo $data['settings']->email_smtp_user ?? ''; ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small text-muted">Contraseña SMTP</label>
                                    <input type="password" name="email_smtp_pass" class="form-control" value="<?php echo $data['settings']->email_smtp_pass ?? ''; ?>">
                                </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Location Selects ---
        const depSelect = document.getElementById('departamento_id');
        const munSelect = document.getElementById('municipio_id');
        const disSelect = document.getElementById('distrito_id');

        // Helper to clear options
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
                })
               .catch(err => {
                   console.error(err);
                   munSelect.innerHTML = '<option value="">Error al cargar</option>';
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
                })
               .catch(err => {
                   console.error(err);
                   disSelect.innerHTML = '<option value="">Error al cargar</option>';
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
    });
    });
</script>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

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

                            <h5 class="mb-4 text-primary border-bottom pb-2">Identidad Visual</h5>
                            <div class="row align-items-center mb-4">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold small text-muted d-block">Logotipo del Proyecto</label>
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 p-2 border rounded bg-light text-center" style="width: 100px; height: 100px;">
                                            <?php if(!empty($data['settings']->logo_path)): ?>
                                                <img src="<?php echo URLROOT; ?>/img/<?php echo $data['settings']->logo_path; ?>" alt="Logo" style="max-width: 100%; max-height: 100%;">
                                            <?php else: ?>
                                                <span class="text-muted small">Sin Logo</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex-grow-1">
                                            <input type="file" name="logo" class="form-control form-control-sm mb-2" accept=".png, .jpg, .jpeg, .svg">
                                            <small class="text-muted d-block">Recomendado: PNG Transparente. Max 2MB.</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold small text-muted d-block">Favicon</label>
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 p-2 border rounded bg-light text-center" style="width: 60px; height: 60px;">
                                             <?php if(!empty($data['settings']->favicon_path)): ?>
                                                <img src="<?php echo URLROOT; ?>/img/<?php echo $data['settings']->favicon_path; ?>" alt="Favicon" style="max-width: 32px;">
                                            <?php else: ?>
                                                <span class="text-muted small">N/A</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex-grow-1">
                                            <input type="file" name="favicon" class="form-control form-control-sm mb-2" accept=".ico, .png">
                                            <small class="text-muted d-block">Recomendado: .ico o .png (32x32px).</small>
                                        </div>
                                    </div>
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
                                </div>
                             </div>
                             
                             <h5 class="mb-4 text-primary border-bottom pb-2">Redes Sociales</h5>
                             <div class="row">
                                 <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small text-muted">Facebook</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fab fa-facebook-f text-primary"></i></span>
                                        <input type="text" name="facebook" class="form-control" value="<?php echo $data['settings']->facebook; ?>" placeholder="URL Perfil">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small text-muted">Instagram</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fab fa-instagram text-danger"></i></span>
                                        <input type="text" name="instagram" class="form-control" value="<?php echo $data['settings']->instagram; ?>" placeholder="URL Perfil">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small text-muted">Twitter / X</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fab fa-twitter text-info"></i></span>
                                        <input type="text" name="twitter" class="form-control" value="<?php echo $data['settings']->twitter; ?>" placeholder="URL Perfil">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small text-muted">LinkedIn</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fab fa-linkedin-in text-primary"></i></span>
                                        <input type="text" name="linkedin" class="form-control" value="<?php echo $data['settings']->linkedin; ?>" placeholder="URL Perfil">
                                    </div>
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

<?php require APPROOT . '/views/layouts/footer.php'; ?>

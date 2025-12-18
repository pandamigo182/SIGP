<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-10 mx-auto mt-4">
        
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold text-primary"><i class="fas fa-building me-2"></i>Editar Empresa</h3>
            <a href="<?php echo URLROOT; ?>/admin/empresas" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i>Volver</a>
        </div>

        <div class="card card-body bg-white shadow-sm rounded-3 mb-5">
            <form action="<?php echo URLROOT; ?>/admin/empresas_edit/<?php echo $data['empresa']->id; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="current_logo" value="<?php echo $data['empresa']->logo_path; ?>">
                
                <h5 class="text-secondary border-bottom pb-2 mb-3">Información General</h5>

                <div class="row">
                    <div class="col-md-3 text-center mb-3">
                        <div class="mb-2">
                             <?php if(!empty($data['empresa']->logo_path)): ?>
                                <img src="<?php echo URLROOT; ?>/uploads/logos/<?php echo $data['empresa']->logo_path; ?>" alt="Logo" class="img-thumbnail rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
                            <?php else: ?>
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 120px; height: 120px;">
                                    <i class="fas fa-building fa-3x text-muted"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <label class="btn btn-sm btn-outline-primary w-100">
                            <i class="fas fa-camera me-1"></i> Cambiar Logo
                            <input type="file" name="logo" hidden accept="image/*">
                        </label>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small text-muted">Nombre de la Empresa</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-signature text-secondary"></i></span>
                                    <input type="text" name="nombre" class="form-control" value="<?php echo $data['empresa']->nombre; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small text-muted">Rubro / Categoría</label>
                                <select name="rubro" class="form-select">
                                    <option value="">Seleccione</option>
                                    <?php 
                                        $rubros = ['Tecnología', 'Salud', 'Educación', 'Finanzas', 'Construcción', 'Comercio', 'Servicios', 'Otro'];
                                        foreach($rubros as $rubro): 
                                    ?>
                                        <option value="<?php echo $rubro; ?>" <?php echo ($data['empresa']->rubro == $rubro) ? 'selected' : ''; ?>><?php echo $rubro; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small text-muted">Email Contacto</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-envelope text-secondary"></i></span>
                                    <input type="email" name="email_contacto" class="form-control" value="<?php echo $data['empresa']->email_contacto; ?>">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small text-muted">Teléfono</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-phone text-secondary"></i></span>
                                    <input type="text" name="telefono" class="form-control" value="<?php echo $data['empresa']->telefono; ?>">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small text-muted">Sitio Web</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-globe text-secondary"></i></span>
                                    <input type="text" name="website" class="form-control" value="<?php echo $data['empresa']->website; ?>" placeholder="https://example.com">
                                </div>
                            </div>
                             <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small text-muted">NIT</label>
                                <input type="text" name="nit" class="form-control" value="<?php echo $data['empresa']->nit; ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-muted">Representante Legal</label>
                     <input type="text" name="representante_legal" class="form-control" value="<?php echo $data['empresa']->representante_legal; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-muted">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3"><?php echo $data['empresa']->descripcion; ?></textarea>
                </div>

                <h5 class="text-secondary border-bottom pb-2 mb-3 mt-4">Ubicación</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                         <label class="form-label fw-bold small text-muted">Departamento</label>
                         <select name="departamento_id" id="departamento_id" class="form-select">
                             <option value="">Seleccione</option>
                             <?php foreach($data['departamentos'] as $dep): ?>
                                 <option value="<?php echo $dep->id; ?>" <?php echo ($data['empresa']->departamento_id == $dep->id) ? 'selected' : ''; ?>>
                                     <?php echo $dep->nombre; ?>
                                 </option>
                             <?php endforeach; ?>
                         </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold small text-muted">Municipio</label>
                        <select name="municipio_id" id="municipio_id" class="form-select" data-selected="<?php echo $data['empresa']->municipio_id; ?>">
                            <option value="">Seleccione Departamento</option>
                        </select>
                    </div>
                     <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold small text-muted">Distrito</label>
                        <select name="distrito_id" id="distrito_id" class="form-select" data-selected="<?php echo $data['empresa']->distrito_id; ?>">
                            <option value="">Seleccione Municipio</option>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold small text-muted">Dirección Exacta</label>
                        <input type="text" name="direccion" class="form-control" value="<?php echo $data['empresa']->direccion; ?>">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                     <a href="<?php echo URLROOT; ?>/admin/empresas" class="btn btn-secondary">Cancelar</a>
                     <button type="submit" class="btn btn-warning px-4"><i class="fas fa-save me-2"></i>Actualizar Datos</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
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
            fetch('<?php echo URLROOT; ?>/admin/get_distritos/' + munId) // Ensure this route exists
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

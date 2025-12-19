<?php require APPROOT . '/views/layouts/header.php'; ?>
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<div class="row">
    <div class="col-md-10 mx-auto mt-4">
        <div class="card shadow-sm border-0">
             <div class="card-header bg-white">
                <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Registrar Nueva Empresa</h4>
            </div>
            <div class="card-body">
                <form action="<?php echo URLROOT; ?>/admin/empresas_add" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nombre de la Empresa:</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Rubro:</label>
                            <input type="text" name="rubro" class="form-control" placeholder="Ej. Tecnología, Alimentos..." required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Descripción:</label>
                        <textarea name="descripcion" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>NIT:</label>
                            <input type="text" name="nit" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Teléfono:</label>
                            <input type="text" name="telefono" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Email Contacto:</label>
                            <input type="email" name="email_contacto" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Representante Legal:</label>
                            <input type="text" name="representante_legal" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Sitio Web:</label>
                            <input type="text" name="website" class="form-control">
                        </div>
                    </div>

                    <h5 class="mt-3">Ubicación</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Departamento:</label>
                            <select name="departamento_id" id="departamento_id" class="form-control">
                                <option value="">Seleccione...</option>
                                <?php foreach($data['departamentos'] as $depto): ?>
                                    <option value="<?php echo $depto->id_departamento; ?>"><?php echo $depto->departamento; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Municipio:</label>
                            <select name="municipio_id" id="municipio_id" class="form-control" disabled>
                                <option value="">Seleccione Departamento primero</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Distrito:</label>
                            <select name="distrito_id" id="distrito_id" class="form-control" disabled>
                                <option value="">Seleccione Municipio primero</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Dirección Detallada:</label>
                        <input type="text" name="direccion" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Latitud:</label>
                            <input type="text" name="latitud" id="latitud" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Longitud:</label>
                            <input type="text" name="longitud" id="longitud" class="form-control">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label>Seleccionar Ubicación en Mapa:</label>
                        <div id="map" style="height: 300px; width: 100%;"></div>
                        <small class="text-muted">Haga clic en el mapa para establecer la ubicación.</small>
                    </div>

                    <h5 class="mt-3">Imagen Corporativa</h5>
                    <hr>
                    <div class="mb-3">
                        <label>Logo de la Empresa:</label>
                        <input type="file" name="logo" class="form-control" accept="image/*">
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">Registrar Empresa</button>
                        <a href="<?php echo URLROOT; ?>/admin/empresas" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    // Initialize Map
    var map = L.map('map').setView([13.6929, -89.2182], 13); // Default to San Salvador

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker;

    function onMapClick(e) {
        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker(e.latlng).addTo(map);
        document.getElementById('latitud').value = e.latlng.lat.toFixed(6);
        document.getElementById('longitud').value = e.latlng.lng.toFixed(6);
    }

    map.on('click', onMapClick);

    // Location Dropdowns Logic
    const urlRoot = '<?php echo URLROOT; ?>';
    
    document.getElementById('departamento_id').addEventListener('change', function() {
        const deptoId = this.value;
        const municipioSelect = document.getElementById('municipio_id');
        const distritoSelect = document.getElementById('distrito_id');
        
        municipioSelect.innerHTML = '<option value="">Cargando...</option>';
        municipioSelect.disabled = true;
        distritoSelect.innerHTML = '<option value="">Seleccione Municipio primero</option>';
        distritoSelect.disabled = true;

        if(deptoId) {
            fetch(`${urlRoot}/admin/get_municipios/${deptoId}`)
                .then(response => response.json())
                .then(data => {
                    municipioSelect.innerHTML = '<option value="">Seleccione...</option>';
                    data.forEach(item => {
                        municipioSelect.innerHTML += `<option value="${item.id_municipio}">${item.municipio}</option>`;
                    });
                    municipioSelect.disabled = false;
                });
        } else {
            municipioSelect.innerHTML = '<option value="">Seleccione Departamento primero</option>';
        }
    });

    document.getElementById('municipio_id').addEventListener('change', function() {
        const muniId = this.value;
        const distritoSelect = document.getElementById('distrito_id');
        
        distritoSelect.innerHTML = '<option value="">Cargando...</option>';
        distritoSelect.disabled = true;

        if(muniId) {
            fetch(`${urlRoot}/admin/get_distritos/${muniId}`)
                .then(response => response.json())
                .then(data => {
                    distritoSelect.innerHTML = '<option value="">Seleccione...</option>';
                    data.forEach(item => {
                        distritoSelect.innerHTML += `<option value="${item.id_distrito}">${item.distrito}</option>`;
                    });
                    distritoSelect.disabled = false;
                });
        } else {
            distritoSelect.innerHTML = '<option value="">Seleccione Municipio primero</option>';
        }
    });
</script>

<?php require APPROOT . '/views/layouts/footer.php'; ?>

<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row mb-3 align-items-center">
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/admin" class="btn btn-outline-secondary btn-sm mb-2"><i class="fas fa-arrow-left me-1"></i> Volver</a>
        <h1>Bitácora de Seguridad</h1>
        <p class="text-muted">Registro de auditoría y eventos del sistema.</p>
    </div>
    <div class="col-md-12 mt-2">
        <form action="<?php echo URLROOT; ?>/admin/logs" method="GET" class="card card-body bg-light border-0 shadow-sm">
            <div class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted">Búsqueda General</label>
                    <input class="form-control form-control-sm" type="search" name="search" placeholder="Usuario, Email, IP..." value="<?php echo isset($data['filters']['search']) ? $data['filters']['search'] : ''; ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-muted">Filtrar por Acción</label>
                    <select name="accion" class="form-select form-select-sm">
                        <option value="">Todas</option>
                        <?php foreach($data['actions'] as $act): ?>
                            <option value="<?php echo $act->accion; ?>" <?php echo ($data['filters']['accion'] == $act->accion) ? 'selected' : ''; ?>><?php echo $act->accion; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold text-muted">Desde</label>
                    <input type="date" name="fecha_inicio" class="form-control form-control-sm" value="<?php echo $data['filters']['fecha_inicio']; ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold text-muted">Hasta</label>
                    <input type="date" name="fecha_fin" class="form-control form-control-sm" value="<?php echo $data['filters']['fecha_fin']; ?>">
                </div>
                <div class="col-md-1">
                    <button class="btn btn-primary btn-sm w-100 fw-bold" type="submit">Filtrar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card shadow border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Fecha/Hora</th>
                        <th>Acción</th>
                        <th>Usuario</th>
                        <th>IP</th>
                        <th>Descripción</th>
                        <th>Detalles (UA)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($data['logs'])): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No se encontraron registros de auditoría.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($data['logs'] as $log): ?>
                            <tr>
                                <td><small><?php echo $log->created_at; ?></small></td>
                                <td>
                                    <?php 
                                        $badgeClass = 'bg-secondary';
                                        if(strpos($log->accion, 'LOGIN_SUCCESS') !== false) $badgeClass = 'bg-success';
                                        if(strpos($log->accion, 'LOGIN_FAILED') !== false) $badgeClass = 'bg-danger';
                                        if(strpos($log->accion, 'CREATE') !== false) $badgeClass = 'bg-primary';
                                        if(strpos($log->accion, 'UPDATE') !== false) $badgeClass = 'bg-info text-dark';
                                        if(strpos($log->accion, 'DELETE') !== false) $badgeClass = 'bg-danger';
                                        if(strpos($log->accion, 'CSRF') !== false) $badgeClass = 'bg-warning text-dark';
                                    ?>
                                    <span class="badge <?php echo $badgeClass; ?>"><?php echo $log->accion; ?></span>
                                </td>
                                <td>
                                    <?php if($log->usuario_id): ?>
                                        <strong><?php echo $log->usuario_nombre; ?></strong><br>
                                        <small class="text-muted"><?php echo $log->usuario_email; ?></small>
                                    <?php else: ?>
                                        <span class="text-muted">Desconocido / Anon</span>
                                    <?php endif; ?>
                                </td>
                                <td><code><?php echo $log->ip_address; ?></code></td>
                                <td><?php echo $log->descripcion; ?></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-info" type="button" data-bs-toggle="collapse" data-bs-target="#ua-<?php echo $log->id; ?>">
                                        <i class="fas fa-desktop"></i>
                                    </button>
                                    <div class="collapse mt-2" id="ua-<?php echo $log->id; ?>">
                                        <div class="card card-body p-2 smaller bg-light">
                                            <?php echo $log->user_agent; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Pagination -->
    <?php 
        $queryParams = array_filter($data['filters']); // Remove empty
        $queryString = http_build_query($queryParams);
        $connector = !empty($queryString) ? '?' : '';
    ?>
    <?php if($data['totalPages'] > 1): ?>
        <div class="card-footer bg-white border-0 py-3">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mb-0">
                    <li class="page-item <?php echo $data['page'] <= 1 ? 'disabled' : ''; ?>">
                         <a class="page-link" href="<?php echo URLROOT; ?>/admin/logs/<?php echo $data['page'] - 1; ?><?php echo $connector . $queryString; ?>">Anterior</a>
                    </li>
                    <?php 
                    // Limit pagination links logic could be redundant, keeping simple
                    for($i = max(1, $data['page'] - 2); $i <= min($data['page'] + 2, $data['totalPages']); $i++): ?>
                        <li class="page-item <?php echo $data['page'] == $i ? 'active' : ''; ?>">
                            <a class="page-link" href="<?php echo URLROOT; ?>/admin/logs/<?php echo $i; ?><?php echo $connector . $queryString; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?php echo $data['page'] >= $data['totalPages'] ? 'disabled' : ''; ?>">
                         <a class="page-link" href="<?php echo URLROOT; ?>/admin/logs/<?php echo $data['page'] + 1; ?><?php echo $connector . $queryString; ?>">Siguiente</a>
                    </li>
                </ul>
            </nav>
        </div>
    <?php endif; ?>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>

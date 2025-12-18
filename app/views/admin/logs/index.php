<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row mb-3 align-items-center">
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/admin" class="btn btn-outline-secondary btn-sm mb-2"><i class="fas fa-arrow-left me-1"></i> Volver</a>
        <h1>Bitácora de Seguridad</h1>
        <p class="text-muted">Registro de auditoría y eventos del sistema.</p>
    </div>
    <div class="col-md-6">
        <form action="<?php echo URLROOT; ?>/admin/logs" method="GET" class="d-flex">
            <input class="form-control me-2" type="search" name="q" placeholder="Buscar por usuario, IP, fecha..." aria-label="Search" value="<?php echo isset($data['search']) ? $data['search'] : ''; ?>">
            <button class="btn btn-primary" type="submit">Buscar</button>
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
                            <td colspan="6" class="text-center text-muted">No hay registros de auditoría.</td>
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
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>

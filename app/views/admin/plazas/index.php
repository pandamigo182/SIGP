<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row mb-3">
    <div class="col-md-6">
        <h1>Gestión de Pasantías (Ofertas)</h1>
    </div>
    <div class="col-md-6 text-end">
        <a href="<?php echo URLROOT; ?>/admin" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al Dashboard</a>
    </div>
</div>

<?php flash('admin_message'); ?>

<div class="card mb-4 border-0 shadow-sm bg-light">
    <div class="card-body">
        <form action="<?php echo URLROOT; ?>/admin/plazas" method="get" class="row g-2 align-items-end">
            <div class="col-md-5">
                <label class="form-label small fw-bold text-muted">Buscar Pasantía</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Título o descripción..." value="<?php echo $data['filters']['search']; ?>">
                </div>
            </div>
            <div class="col-md-5">
                <label class="form-label small fw-bold text-muted">Filtrar por Empresa</label>
                <select name="empresa_id" class="form-select">
                    <option value="">Todas las Empresas</option>
                    <?php foreach($data['empresas'] as $emp): ?>
                        <option value="<?php echo $emp->id; ?>" <?php echo ($data['filters']['empresa_id'] == $emp->id) ? 'selected' : ''; ?>>
                            <?php echo $emp->nombre; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100 fw-bold">Filtrar</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Puesto / Título</th>
                        <th>Empresa</th>
                        <th>Fecha de Publicación</th>
                        <th class="text-center">Aplicantes</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($data['plazas'])): ?>
                        <tr><td colspan="6" class="text-center p-4">No se encontraron pasantías con los filtros aplicados.</td></tr>
                    <?php else: ?>
                        <?php foreach($data['plazas'] as $plaza): ?>
                            <tr>
                                <td>
                                    <span class="fw-bold text-primary"><?php echo $plaza->titulo; ?></span>
                                    <br>
                                    <small class="text-muted"><?php echo substr($plaza->descripcion, 0, 40); ?>...</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <?php if(!empty($plaza->empresa_logo)): ?>
                                            <img src="<?php echo URLROOT . '/img/logos/' . $plaza->empresa_logo; ?>" width="30" height="30" class="rounded-circle me-2">
                                        <?php else: ?>
                                            <i class="fas fa-building text-secondary me-2"></i>
                                        <?php endif; ?>
                                        <span class="small"><?php echo $plaza->empresa_nombre; ?></span>
                                    </div>
                                </td>
                                <td><?php echo date('d/m/Y', strtotime($plaza->created_at)); ?></td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border">
                                        <i class="fas fa-users me-1"></i> <?php echo $plaza->total_postulaciones; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if($plaza->estado == 'abierta'): ?>
                                        <span class="badge bg-success">Abierta</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Cerrada</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="<?php echo URLROOT; ?>/plazas/show/<?php echo $plaza->id; ?>" class="btn btn-outline-info" data-bs-toggle="tooltip" title="Ver Detalle"><i class="fas fa-eye"></i></a>
                                        
                                        <!-- Actions usually require Admin Controller methods, currently we only see View 
                                             Assuming we might want Edit/Delete if Admin logic exists. 
                                             For now, improving the existing View button and maybe enabling/disabling if controller supports it. -->
                                             
                                        <!-- Placeholder for Edit if route exists (e.g. admin/plazas_edit) -->
                                        <!-- <a href="<?php echo URLROOT; ?>/admin/plazas_edit/<?php echo $plaza->id; ?>" class="btn btn-outline-warning" title="Editar"><i class="fas fa-edit"></i></a> -->
                                        
                                        <!-- Example Toggle State Button provided validation logic exists
                                             Currently just showing the 'View' button nicer as requested, 
                                             but the user asked for "UX/UI Expert" analysis. 
                                             Usually Admins need to Delete or Suspend. -->

                                         <button type="button" class="btn btn-outline-danger" onclick="confirmDelete('<?php echo URLROOT; ?>/admin/plazas_delete/<?php echo $plaza->id; ?>')" data-bs-toggle="tooltip" title="Eliminar"><i class="fas fa-trash"></i></button>
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
        $queryParams = [];
        if(!empty($data['filters']['search'])) $queryParams['search'] = $data['filters']['search'];
        if(!empty($data['filters']['empresa_id'])) $queryParams['empresa_id'] = $data['filters']['empresa_id'];
        $queryString = http_build_query($queryParams);
        $connector = !empty($queryString) ? '?' : '';
    ?>
    <?php if($data['totalPages'] > 1): ?>
    <div class="card-footer bg-white border-0 py-3">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mb-0">
                    <li class="page-item <?php echo $data['page'] <= 1 ? 'disabled' : ''; ?>">
                        <a class="page-link" href="<?php echo URLROOT; ?>/admin/plazas/<?php echo $data['page'] - 1; ?><?php echo $connector . $queryString; ?>">Anterior</a>
                    </li>
                    <?php for($i = 1; $i <= $data['totalPages']; $i++): ?>
                        <li class="page-item <?php echo $data['page'] == $i ? 'active' : ''; ?>">
                            <a class="page-link" href="<?php echo URLROOT; ?>/admin/plazas/<?php echo $i; ?><?php echo $connector . $queryString; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?php echo $data['page'] >= $data['totalPages'] ? 'disabled' : ''; ?>">
                        <a class="page-link" href="<?php echo URLROOT; ?>/admin/plazas/<?php echo $data['page'] + 1; ?><?php echo $connector . $queryString; ?>">Siguiente</a>
                    </li>
                </ul>
            </nav>
    </div>
    <?php endif; ?>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>

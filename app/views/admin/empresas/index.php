<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
             <a href="<?php echo URLROOT; ?>/admin" class="btn btn-outline-secondary btn-sm mb-2"><i class="fas fa-arrow-left me-1"></i> Volver</a>
             <h2><i class="fas fa-building me-2"></i>Gestión de Empresas</h2>
        </div>
        <a href="<?php echo URLROOT; ?>/admin/empresas_add" class="btn btn-primary"><i class="fas fa-plus"></i> Nueva Empresa</a>
    </div>

    <!-- Search -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="<?php echo URLROOT; ?>/admin/empresas" method="GET" class="row g-2">
                <div class="col-md-10">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o email..." value="<?php echo isset($data['search']) ? $data['search'] : ''; ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Buscar</button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Empresa</th>
                            <th>Ubicación</th>
                            <th>Contacto</th>
                            <th>Sitio Web</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($data['empresas'])): ?>
                            <tr>
                                <td colspan="5" class="text-center p-4 text-muted">No hay empresas registradas.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($data['empresas'] as $empresa): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; overflow:hidden;">
                                                <?php 
                                                    $logo = !empty($empresa->logo_path) ? URLROOT . '/img/logos/' . $empresa->logo_path : '';
                                                    if($logo):
                                                ?>
                                                <img src="<?php echo $logo; ?>" style="width:100%; height:100%; object-fit:cover;">
                                                <?php else: ?>
                                                <i class="fas fa-building text-secondary"></i>
                                                <?php endif; ?>
                                            </div>
                                            <div>
                                                <div class="fw-bold"><?php echo $empresa->nombre; ?></div>
                                                <small class="text-muted"><?php echo substr($empresa->descripcion, 0, 30); ?>...</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <i class="fas fa-map-marker-alt text-danger me-1"></i> <?php echo $empresa->direccion ? $empresa->direccion : 'N/A'; ?>
                                    </td>
                                    <td>
                                        <?php echo $empresa->telefono ? '<i class="fas fa-phone me-1"></i> ' . $empresa->telefono : 'N/A'; ?>
                                    </td>
                                    <td>
                                        <?php if($empresa->website): ?>
                                            <a href="<?php echo $empresa->website; ?>" target="_blank" class="btn btn-sm btn-outline-info"><i class="fas fa-external-link-alt"></i> Visitar</a>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo URLROOT; ?>/admin/empresas_edit/<?php echo $empresa->id; ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                        <form action="<?php echo URLROOT; ?>/admin/empresas_delete/<?php echo $empresa->id; ?>" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar esta empresa?');">
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Pagination -->
        <?php if($data['totalPages'] > 1): ?>
        <div class="card-footer bg-white border-0 py-3">
             <nav aria-label="Page navigation">
                 <ul class="pagination justify-content-center mb-0">
                     <?php 
                        $searchQuery = isset($data['search']) ? '&search=' . $data['search'] : '';
                     ?>
                     <li class="page-item <?php echo $data['page'] <= 1 ? 'disabled' : ''; ?>">
                         <a class="page-link" href="<?php echo URLROOT; ?>/admin/empresas/<?php echo $data['page'] - 1; ?>?<?php echo $searchQuery; ?>">Anterior</a>
                     </li>
                     <?php for($i=1; $i<=$data['totalPages']; $i++): ?>
                     <li class="page-item <?php echo $data['page'] == $i ? 'active' : ''; ?>">
                         <a class="page-link" href="<?php echo URLROOT; ?>/admin/empresas/<?php echo $i; ?>?<?php echo $searchQuery; ?>"><?php echo $i; ?></a>
                     </li>
                     <?php endfor; ?>
                     <li class="page-item <?php echo $data['page'] >= $data['totalPages'] ? 'disabled' : ''; ?>">
                         <a class="page-link" href="<?php echo URLROOT; ?>/admin/empresas/<?php echo $data['page'] + 1; ?>?<?php echo $searchQuery; ?>">Siguiente</a>
                     </li>
                 </ul>
             </nav>
        </div>
        <?php endif; ?>
    </div>

</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

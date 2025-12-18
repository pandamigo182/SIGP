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
                        <tr><td colspan="6" class="text-center p-4">No hay pasantías registradas.</td></tr>
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
                                    <a href="<?php echo URLROOT; ?>/plazas/show/<?php echo $plaza->id; ?>" class="btn btn-sm btn-info text-white" title="Ver Detalle"><i class="fas fa-eye"></i></a>
                                    <!-- Edit/Delete could be added here later -->
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
                    <li class="page-item <?php echo $data['page'] <= 1 ? 'disabled' : ''; ?>">
                        <a class="page-link" href="<?php echo URLROOT; ?>/admin/plazas/<?php echo $data['page'] - 1; ?>">Anterior</a>
                    </li>
                    <?php for($i = 1; $i <= $data['totalPages']; $i++): ?>
                        <li class="page-item <?php echo $data['page'] == $i ? 'active' : ''; ?>">
                            <a class="page-link" href="<?php echo URLROOT; ?>/admin/plazas/<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?php echo $data['page'] >= $data['totalPages'] ? 'disabled' : ''; ?>">
                        <a class="page-link" href="<?php echo URLROOT; ?>/admin/plazas/<?php echo $data['page'] + 1; ?>">Siguiente</a>
                    </li>
                </ul>
            </nav>
    </div>
    <?php endif; ?>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>

<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2><i class="fas fa-building me-2"></i>Gestión de Empresas</h2>
        <a href="<?php echo URLROOT; ?>/admin/empresas_add" class="btn btn-primary"><i class="fas fa-plus"></i> Nueva Empresa</a>
    </div>

    <!-- Filtros Future Implementation -->
    
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
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                <i class="fas fa-building text-secondary"></i>
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
                                        <a href="#" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="mt-3">
        <a href="<?php echo URLROOT; ?>/dashboard" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

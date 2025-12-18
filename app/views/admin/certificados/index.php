<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="row">
    <div class="col-md-12">
        <h2 class="mb-4"><i class="fas fa-certificate text-primary"></i> Gestión de Diplomas</h2>
        <?php flash('cert_message'); ?>

        <div class="row">
            <!-- Upload Form -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white fw-bold">Subir Nueva Plantilla</div>
                    <div class="card-body">
                        <form action="<?php echo URLROOT; ?>/certificados/upload" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Nombre de la Plantilla</label>
                                <input type="text" name="nombre" class="form-control" placeholder="Ej: Diploma 2025" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Imagen de Fondo (JPG/PNG)</label>
                                <input type="file" name="plantilla" class="form-control" accept=".jpg, .jpeg, .png" required>
                                <small class="text-muted">Recomendado: 297mm x 210mm (A4 Landscape), 300 DPI.</small>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Subir Plantilla</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- List Templates -->
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-bold">Plantillas Disponibles</div>
                    <div class="card-body">
                        <?php if(empty($data['templates'])): ?>
                            <div class="alert alert-info">No hay plantillas subidas.</div>
                        <?php else: ?>
                            <div class="row">
                                <?php foreach($data['templates'] as $tpl): ?>
                                    <div class="col-md-6 mb-3">
                                        <div class="card h-100">
                                            <img src="<?php echo URLROOT; ?>/img/certificados/<?php echo $tpl->archivo_fondo; ?>" class="card-img-top" alt="Template" style="height: 150px; object-fit: cover;">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $tpl->nombre; ?></h5>
                                                <p class="card-text small text-muted">Subido: <?php echo date('d/m/Y', strtotime($tpl->created_at)); ?></p>
                                                <?php if($tpl->activo): ?>
                                                    <span class="badge bg-success">Activo</span>
                                                <?php else: ?>
                                                    <!-- Feature: Set Active -->
                                                    <span class="badge bg-secondary">Inactivo</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>

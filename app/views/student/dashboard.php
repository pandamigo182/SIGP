<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Panel del Estudiante</h2>
            <div class="alert alert-info shadow-sm border-0">
                <i class="fas fa-user-graduate me-2"></i>Bienvenido, <strong><?php echo $_SESSION['user_name']; ?></strong>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Tarjeta de Perfil -->
        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm border-0 border-top border-4 border-primary">
                <div class="card-body text-center">
                    <div class="mb-3 text-primary">
                        <i class="fas fa-id-card fa-3x"></i>
                    </div>
                    <h5 class="card-title">Mi Perfil</h5>
                    <p class="card-text text-muted">Gestiona tu información personal y académica.</p>
                    <a href="#" class="btn btn-outline-primary rounded-pill w-100">Ver Perfil</a>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Postulaciones -->
        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm border-0 border-top border-4 border-success">
                <div class="card-body text-center">
                    <div class="mb-3 text-success">
                        <i class="fas fa-briefcase fa-3x"></i>
                    </div>
                    <h5 class="card-title">Plazas Disponibles</h5>
                    <p class="card-text text-muted">Explora las ofertas de empresas y postúlate.</p>
                    <a href="<?php echo URLROOT; ?>/pages/index" class="btn btn-outline-success rounded-pill w-100">Ver Plazas</a>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Reportes -->
        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm border-0 border-top border-4 border-warning">
                <div class="card-body text-center">
                    <div class="mb-3 text-warning">
                        <i class="fas fa-file-signature fa-3x"></i>
                    </div>
                    <h5 class="card-title">Mis Reportes</h5>
                    <p class="card-text text-muted">Sube tus reportes semanales de seguimiento.</p>
                    <a href="<?php echo URLROOT; ?>/reportes/index" class="btn btn-outline-warning rounded-pill w-100">Gestión de Reportes</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Mis Pasantías (Activas/Finalizadas) -->
    <?php if(!empty($data['pasantias_list'])): ?>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow-sm border-0 border-start border-5 border-info">
                <div class="card-header bg-white border-0 py-3">
                    <h4 class="mb-0 text-info"><i class="fas fa-project-diagram me-2"></i>Mis Pasantías</h4>
                </div>
                <div class="card-body">
                    <?php flash('student_message'); ?>
                    <?php flash('pasantia_message'); ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                             <thead class="table-light">
                                 <tr>
                                     <th>Proyecto / Puesto</th>
                                     <th>Empresa</th>
                                     <th>Fecha Inicio</th>
                                     <th>Estado</th>
                                     <th>Certificado</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php foreach($data['pasantias_list'] as $pasantia): ?>
                                     <tr>
                                         <td class="fw-bold"><?php echo $pasantia->proyecto_asociado; ?></td>
                                         <td><?php echo $pasantia->nombre_empresa; ?></td>
                                         <td><?php echo date('d/m/Y', strtotime($pasantia->fecha_inicio)); ?></td>
                                         <td>
                                             <?php if($pasantia->estado == 'finalizada'): ?>
                                                 <span class="badge bg-secondary"><i class="fas fa-flag-checkered me-1"></i> Finalizada</span>
                                             <?php else: ?>
                                                 <span class="badge bg-success"><i class="fas fa-play-circle me-1"></i> Activa</span>
                                             <?php endif; ?>
                                         </td>
                                         <td>
                                             <?php if($pasantia->estado == 'finalizada'): ?>
                                                 <a href="<?php echo URLROOT; ?>/certificados/generate/<?php echo $pasantia->id; ?>" target="_blank" class="btn btn-primary btn-sm rounded-pill shadow-sm">
                                                     <i class="fas fa-download me-1"></i> Descargar Constancia
                                                 </a>
                                             <?php else: ?>
                                                 <small class="text-muted text-center d-block">Al finalizar</small>
                                             <?php endif; ?>
                                         </td>
                                     </tr>
                                 <?php endforeach; ?>
                             </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Mis Postulaciones -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0">
                    <h4 class="mb-0"><i class="fas fa-list-alt me-2 text-primary"></i>Mis Postulaciones Recientes</h4>
                </div>
                <div class="card-body">
                    <?php if(empty($data['postulaciones'])): ?>
                        <div class="alert alert-light text-center">
                            Aún no te has postulado a ninguna pasantía. <a href="<?php echo URLROOT; ?>/pages/index">¡Busca una ahora!</a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Puesto</th>
                                        <th>Empresa</th>
                                        <th>Fecha Postulación</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($data['postulaciones'] as $postulacion): ?>
                                        <tr>
                                            <td class="fw-bold"><?php echo $postulacion->tituloPlaza; ?></td>
                                            <td><?php echo $postulacion->nombreEmpresa; ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($postulacion->fechaPostulacion)); ?></td>
                                            <td>
                                                <span class="badge <?php echo ($postulacion->estadoPostulacion == 'pendiente') ? 'bg-warning' : (($postulacion->estadoPostulacion == 'aceptado') ? 'bg-success' : 'bg-danger'); ?>">
                                                    <?php echo ucfirst($postulacion->estadoPostulacion); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="<?php echo URLROOT; ?>/plazas/show/<?php echo $postulacion->plaza_id; ?>" class="btn btn-sm btn-outline-primary">Ver Plaza</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

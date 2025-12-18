<?php require APPROOT . '/views/layouts/header.php'; ?>

<!-- Hero Plaza -->
<div class="py-5 position-relative text-white" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
    <div class="container position-relative z-index-1">
        <div class="row align-items-center">
             <div class="col-12 mb-3">
                 <a href="javascript:history.back()" class="text-white text-decoration-none small"><i class="fas fa-arrow-left me-1"></i> Regresar</a>
             </div>
             <div class="col-md-3 text-center text-md-start mb-3 mb-md-0">
                  <?php 
                     $logoPath = !empty($data['plaza']->logoEmpresa) ? URLROOT . '/' . $data['plaza']->logoEmpresa : 'https://ui-avatars.com/api/?name=' . urlencode($data['plaza']->nombreEmpresa) . '&background=random';
                  ?>
                  <img src="<?php echo $logoPath; ?>" alt="Logo" class="rounded-circle shadow-lg bg-white p-2" style="width: 150px; height: 150px; object-fit: cover;">
             </div>
             <div class="col-md-6 text-center text-md-start">
                  <h1 class="fw-bold mb-1 text-white"><?php echo $data['plaza']->titulo; ?></h1>
                  <h4 class="fw-light mb-2 text-light"><?php echo $data['plaza']->nombreEmpresa; ?></h4>
                  <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-4 mt-3">
                      <span class="badge bg-secondary p-2"><i class="fas fa-map-marker-alt me-1"></i> <?php echo $data['plaza']->nombreMunicipio . ', ' . $data['plaza']->nombreDepartamento; ?></span>
                      <span class="badge bg-secondary p-2"><i class="far fa-clock me-1"></i> <?php echo date('d/m/Y', strtotime($data['plaza']->fechaPublicacion)); ?></span>
                      <?php 
                          $modIcon = 'fa-briefcase'; // Default
                          $modLower = mb_strtolower($data['plaza']->modalidad, 'UTF-8');
                          if(strpos($modLower, 'remoto') !== false) { $modIcon = 'fa-laptop'; }
                          elseif(strpos($modLower, 'presencial') !== false) { $modIcon = 'fa-building'; }
                          elseif(strpos($modLower, 'híbrido') !== false || strpos($modLower, 'hibrido') !== false) { $modIcon = 'fa-house-user'; }
                      ?>
                      <span class="badge bg-secondary p-2"><i class="fas <?php echo $modIcon; ?> me-1"></i> <?php echo $data['plaza']->modalidad; ?></span>
                      <?php if(!empty($data['plaza']->duracion)): ?>
                          <span class="badge bg-secondary p-2"><i class="fas fa-hourglass-half me-1"></i> <?php echo $data['plaza']->duracion; ?></span>
                      <?php endif; ?>
                  </div>
             </div>
             <div class="col-md-3 text-center text-md-end mt-4 mt-md-0">
                 <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 5): ?>
                     <button class="btn btn-light btn-lg rounded-pill shadow-sm px-4 fw-bold mb-2 w-100" data-bs-toggle="modal" data-bs-target="#applyModal" <?php echo $data['yaAplico'] ? 'disabled' : ''; ?>>
                         <?php echo $data['yaAplico'] ? '<i class="fas fa-check"></i> Aplicado' : 'Aplicar Ahora'; ?>
                     </button>
                     <button class="btn btn-outline-light rounded-pill w-100" id="btnFavorite" onclick="toggleFavorite(<?php echo $data['plaza']->plazaId; ?>)">
                         <i class="<?php echo $data['esFavorito'] ? 'fas' : 'far'; ?> fa-heart"></i> Guardar
                     </button>
                 <?php else: ?>
                     <a href="<?php echo URLROOT; ?>/auth/login" class="btn btn-light btn-lg rounded-pill shadow-sm px-4 fw-bold w-100">Iniciar Sesión para Aplicar</a>
                 <?php endif; ?>
             </div>
        </div>
    </div>
    <!-- Overlay/Pattern -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(45deg, rgba(0,0,0,0.4), transparent); pointer-events: none;"></div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <!-- Main Content -->
        <div class="col-lg-10">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-5">
                             <h4 class="fw-bold text-primary mb-3"><i class="fas fa-align-left me-2"></i>Descripción del Puesto</h4>
                             <p class="text-muted" style="white-space: pre-line; text-align: justify;"><?php echo $data['plaza']->descripcion; ?></p>
                             
                             <hr class="my-5">
                             
                             <h4 class="fw-bold text-primary mb-3"><i class="fas fa-list-ul me-2"></i>Requisitos</h4>
                             <p class="text-muted" style="white-space: pre-line;"><?php echo $data['plaza']->requisitos; ?></p>

                             <?php if(!empty($data['plaza']->competencias_requeridas)): ?>
                                 <hr class="my-5">
                                 <h4 class="fw-bold text-primary mb-3"><i class="fas fa-star me-2"></i>Competencias</h4>
                                 <p class="text-muted"><?php echo $data['plaza']->competencias_requeridas; ?></p>
                             <?php endif; ?>

                             <?php if(isset($data['plaza']->beneficios)): ?>
                             <hr class="my-5">
                             <h4 class="fw-bold text-primary mb-3"><i class="fas fa-gift me-2"></i>Beneficios</h4>
                             <ul class="list-unstyled">
                                 <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> <?php echo $data['plaza']->es_remunerada ? 'Pasantía Remunerada' : 'Pasantía No Remunerada'; ?></li>
                                 <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> <?php echo $data['plaza']->beneficios ?? 'Oportunidad de crecimiento'; ?></li>
                             </ul>
                             <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar (Right) -->
                <div class="col-lg-4">
                     <!-- Company Card -->
                     <div class="card border-0 shadow-sm mb-4 bg-light">
                         <div class="card-body text-center p-4">
                             <h5 class="fw-bold mb-3 text-dark">Sobre la Empresa</h5>
                             <img src="<?php echo !empty($data['plaza']->logoEmpresa) ? URLROOT . '/' . $data['plaza']->logoEmpresa : 'https://ui-avatars.com/api/?name=' . urlencode($data['plaza']->nombreEmpresa); ?>" class="rounded-circle mb-3 border shadow-sm" width="80" height="80" style="object-fit:cover;">
                             <h6 class="fw-bold"><?php echo $data['plaza']->nombreEmpresa; ?></h6>
                             
                             <?php if(!empty($data['plaza']->descripcionEmpresa)): ?>
                                 <p class="small text-muted mb-3"><?php echo substr($data['plaza']->descripcionEmpresa, 0, 150) . '...'; ?></p>
                             <?php endif; ?>
                             
                             <?php if(!empty($data['plaza']->websiteEmpresa)): ?>
                                <a href="<?php echo $data['plaza']->websiteEmpresa; ?>" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill mb-3 w-100"><i class="fas fa-globe me-1"></i> Sitio Web</a>
                             <?php endif; ?>
                             
                             <div class="d-grid">
                                 <button class="btn btn-outline-warning btn-sm" onclick="alert('Feature coming soon: Job Alerts')"><i class="fas fa-bell me-1"></i> Crear Alerta de Empleo</button>
                             </div>
                         </div>
                     </div>
                     
                     <!-- Share Widget -->
                     <div class="card border-0 shadow-sm">
                         <div class="card-body p-4 text-center">
                             <h6 class="fw-bold mb-3">Compartir esta oferta</h6>
                             <div class="d-flex justify-content-center gap-2">
                                 <button class="btn btn-light rounded-circle text-primary shadow-sm" style="width:40px;height:40px;"><i class="fab fa-facebook-f"></i></button>
                                 <button class="btn btn-light rounded-circle text-info shadow-sm" style="width:40px;height:40px;"><i class="fab fa-twitter"></i></button>
                                 <button class="btn btn-light rounded-circle text-primary shadow-sm" style="width:40px;height:40px;"><i class="fab fa-linkedin-in"></i></button>
                                 <button class="btn btn-light rounded-circle text-success shadow-sm" style="width:40px;height:40px;"><i class="fab fa-whatsapp"></i></button>
                             </div>
                         </div>
                     </div>
                </div>
            </div>

            <!-- Similar Offers -->
            <?php if(!empty($data['similares'])): ?>
            <div class="mt-5">
                <h4 class="fw-bold mb-4 border-bottom pb-2">Ofertas Similares</h4>
                <div class="row">
                    <?php foreach($data['similares'] as $similar): ?>
                        <div class="col-md-6 mb-3">
                             <a href="<?php echo URLROOT; ?>/plazas/show/<?php echo $similar->id; ?>" class="text-decoration-none text-dark">
                                 <div class="card h-100 border-0 shadow-sm hover-shadow bg-white">
                                     <div class="card-body d-flex align-items-center p-3">
                                          <div class="bg-light rounded p-2 me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                              <?php if(!empty($similar->logoEmpresa)): ?>
                                                  <img src="<?php echo URLROOT . '/' . $similar->logoEmpresa; ?>" style="max-width:100%; max-height:100%;">
                                              <?php else: ?>
                                                  <span class="fw-bold text-secondary"><?php echo substr($similar->nombreEmpresa, 0, 1); ?></span>
                                              <?php endif; ?>
                                          </div>
                                          <div>
                                              <h6 class="mb-1 fw-bold text-truncate" style="max-width: 250px;"><?php echo $similar->titulo; ?></h6>
                                              <small class="text-muted"><?php echo $similar->nombreEmpresa; ?></small>
                                          </div>
                                     </div>
                                 </div>
                             </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Back Button at Bottom -->
            <div class="text-center mt-5 mb-5">
                <a href="<?php echo URLROOT; ?>/plazas" class="btn btn-outline-secondary px-5 rounded-pill shadow-sm">
                    <i class="fas fa-arrow-left me-2"></i> Regresar a Pasantías
                </a>
            </div>

        </div>
    </div>
</div>

<!-- Apply Modal -->
<div class="modal fade" id="applyModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold">Aplicar a <?php echo $data['plaza']->titulo; ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                 <form action="<?php echo URLROOT; ?>/plazas/apply/<?php echo $data['plaza']->plazaId; ?>" method="POST">
                     <p class="text-muted mb-4">Estás aplicando a <strong><?php echo $data['plaza']->nombreEmpresa; ?></strong>. Selecciona tu CV y responde las preguntas si existen.</p>
                     
                     <div class="card border-0 shadow-sm mb-4">
                         <div class="card-body">
                             <h6 class="fw-bold text-success mb-3"><i class="fas fa-file-alt me-2"></i>Tu Currículum</h6>
                             <!-- Mock CV Selection -->
                             <div class="form-check p-3 border rounded bg-white">
                                 <input class="form-check-input" type="radio" name="cv_id" id="cv1" value="1" checked>
                                 <label class="form-check-label w-100" for="cv1">
                                     <div class="d-flex justify-content-between align-items-center">
                                         <span><strong>CV Principal - <?php echo $_SESSION['user_name'] ?? 'Usuario'; ?></strong></span>
                                         <span class="badge bg-success rounded-pill"><i class="fas fa-check"></i> Listo</span>
                                     </div>
                                     <small class="text-muted">Actualizado: <?php echo date('d/m/Y'); ?></small>
                                 </label>
                             </div>
                             <div class="mt-3 text-end">
                                 <a href="#" class="small text-primary fw-bold text-decoration-none"><i class="fas fa-plus-circle"></i> Agregar Nuevo Currículo</a>
                             </div>
                         </div>
                     </div>

                     <!-- Mock Questions -->
                     <div class="card border-0 shadow-sm mb-4">
                         <div class="card-body">
                             <h6 class="fw-bold text-dark mb-3">Preguntas de la Empresa</h6>
                             <div class="mb-3">
                                 <label class="form-label small fw-bold">¿Zona de residencia?</label>
                                 <input type="text" name="q1" class="form-control" placeholder="Ej: San Salvador">
                             </div>
                             <div class="mb-3">
                                 <label class="form-label small fw-bold">¿Pretensión Salarial?</label>
                                 <input type="text" name="q2" class="form-control" placeholder="Ej: $300 - $400">
                             </div>
                         </div>
                     </div>

                     <div class="d-grid gap-2">
                         <button type="submit" class="btn btn-success btn-lg fw-bold shadow-sm">Enviar Aplicación</button>
                         <button type="button" class="btn btn-link text-muted" data-bs-dismiss="modal">Cancelar</button>
                     </div>
                 </form>
            </div>
        </div>
    </div>
</div>


<script>
function toggleFavorite(id) {
    const btn = document.getElementById('btnFavorite');
    const icon = btn.querySelector('i');
    
    fetch('<?php echo URLROOT; ?>/plazas/toggle_favorite/' + id)
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success'){
            if(data.favorito){
                icon.classList.remove('far');
                icon.classList.add('fas');
                // btn.classList.remove('btn-outline-light');
                // btn.classList.add('btn-light', 'text-danger');
                Swal.fire({
                    icon: 'success',
                    title: 'Guardado',
                    text: 'Agregado a tus favoritos',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                });
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                Swal.fire({
                    icon: 'info',
                    title: 'Removido',
                    text: 'Eliminado de tus favoritos',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        }
    })
    .catch(err => console.error(err));
}
</script>

<?php require APPROOT . '/views/layouts/footer.php'; ?>

<?php require APPROOT . '/views/layouts/header.php'; ?>
<style>
    @media (min-width: 765px) and (max-width: 975px) {
        .search-text { display: none; }
    }
</style>

<!-- Hero Section -->
<!-- Hero Section -->
<div class="hero-section text-center bg-light py-5">
    <img src="<?php echo URLROOT; ?>/img/logo-completo.svg" alt="SIGP Logo" class="img-fluid" style="max-height: 250px; filter: drop-shadow(0 0 10px rgba(0,0,0,0.1));">
    <p class="lead text-secondary mb-0 fs-4"><?php echo $data['description']; ?></p>
    
    <!-- Search Form inside Hero -->
    <div class="container" style="max-width: 900px;">
        <div class="card shadow-lg border-0">
            <div class="card-body p-4">
                <form action="<?php echo URLROOT; ?>/plazas" method="GET">
                    <div class="row g-2">
                        <div class="col-md-3">
                            <input type="text" name="q" class="form-control" placeholder="Buscar cargo o empresa..." value="<?php echo isset($_GET['q']) ? $_GET['q'] : ''; ?>">
                        </div>
                        <div class="col-md-2">
                            <select name="rubro" class="form-select">
                                <option value="">-- Rubro --</option>
                                <?php foreach($data['rubros'] as $rubro) : ?>
                                    <option value="<?php echo $rubro->rubro; ?>" <?php echo (isset($_GET['rubro']) && $_GET['rubro'] == $rubro->rubro) ? 'selected' : ''; ?>>
                                        <?php echo $rubro->rubro; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                           <select name="departamento_id" class="form-select">
                               <option value="">-- Departamento --</option>
                               <?php foreach($data['departamentos'] as $dep) : ?>
                                   <option value="<?php echo $dep->id_departamento; ?>" <?php echo (isset($_GET['departamento_id']) && $_GET['departamento_id'] == $dep->id_departamento) ? 'selected' : ''; ?>>
                                       <?php echo $dep->departamento; ?>
                                   </option>
                               <?php endforeach; ?>
                           </select>
                        </div>
                        <div class="col-md-3">
                             <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i> <span class="search-text">Buscar</span></button>
                        </div>
                        <div class="col-md-2">
                            <a href="<?php echo URLROOT; ?>" class="btn btn-outline-secondary w-100" title="Limpiar">Limpiar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Section: Ofertas Destacadas -->
<div class="container mb-5">
    <div class="d-flex align-items-center mb-3">
         <h5 class="text-uppercase fw-bold text-primary border-bottom border-primary pb-2 flex-grow-1" style="border-bottom-width: 2px !important;">Ofertas Destacadas</h5>
    </div>

    <div class="row">
         <?php foreach($data['destacadas'] as $destacada) : ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 position-relative">
                    <div class="card-body">
                         <div class="position-absolute top-0 end-0 p-3">
                             <i class="far fa-star text-success fa-lg"></i>
                         </div>
                         <div class="d-flex align-items-center mb-3">
                             <?php 
                                $logoPath = !empty($destacada->logoEmpresa) ? URLROOT . '/' . $destacada->logoEmpresa : 'https://ui-avatars.com/api/?name=' . urlencode($destacada->nombreEmpresa) . '&background=random';
                             ?>
                             <img src="<?php echo $logoPath; ?>" alt="Logo" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                             <div>
                                 <h6 class="card-title fw-bold mb-0 text-truncate" style="max-width: 200px;"><?php echo $destacada->titulo; ?></h6>
                                 <small class="text-muted"><?php echo $destacada->nombreEmpresa; ?></small>
                             </div>
                         </div>
                         <div class="mb-3">
                             <small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i> 
                                <?php echo $destacada->nombreMunicipio . ', ' . $destacada->nombreDepartamento; ?>
                             </small>
                         </div>
                         <a href="<?php echo URLROOT; ?>/plazas/show/<?php echo $destacada->id; ?>" class="stretched-link"></a>
                    </div>
                </div>
            </div>
         <?php endforeach; ?>
    </div>
</div>

<!-- Featured Companies Removed -->


<!-- Section: Plazas Disponibles -->
<div class="container mb-5">
    <div class="d-flex align-items-center mb-4">
         <h5 class="text-uppercase fw-bold text-primary border-bottom border-primary pb-2 flex-grow-1" style="border-bottom-width: 2px !important;">Últimas Ofertas Publicadas</h5>
    </div>

    <div class="row">
        <?php if(empty($data['plazas'])) : ?>
            <div class="col-md-12">
                <div class="alert alert-secondary text-center p-4 rounded-3" role="alert">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <h4>No se encontraron pasantías con esos filtros.</h4>
                    <p>Intenta una búsqueda más amplia.</p>
                </div>
            </div>
        <?php else : ?>
            <?php foreach($data['plazas'] as $plaza) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card card-plaza h-100 shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                 <?php 
                                    $logoPath = !empty($plaza->logoEmpresa) ? URLROOT . '/' . $plaza->logoEmpresa : 'https://ui-avatars.com/api/?name=' . urlencode($plaza->nombreEmpresa) . '&background=random';
                                 ?>
                                 <img src="<?php echo $logoPath; ?>" alt="Logo" class="rounded mb-2" style="width: 40px; height: 40px; object-fit: cover;">
                                 <?php if(strtotime($plaza->fechaPublicacion) > strtotime('-24 hours')): ?>
                                     <span class="badge bg-danger rounded-1">NUEVO!</span>
                                 <?php endif; ?>
                            </div>

                            <h5 class="card-title fw-bold mb-1"><?php echo $plaza->titulo; ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted fw-normal">
                                <?php echo $plaza->nombreEmpresa; ?>
                            </h6>
                            
                            <div class="mb-3 text-muted small">
                                <i class="fas fa-map-marker-alt me-1"></i> <?php echo $plaza->nombreMunicipio . ', ' . $plaza->nombreDepartamento; ?>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                <i class="far fa-star text-success fa-lg" style="cursor: pointer;"></i>
                                <a href="<?php echo URLROOT; ?>/plazas/show/<?php echo $plaza->plazaId; ?>" class="btn btn-sm text-primary fw-bold">Ver Detalles <i class="fas fa-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    
    <!-- View More Button -->
    <div class="mt-5">
        <a href="<?php echo URLROOT; ?>/plazas" class="btn btn-primary btn-lg w-100 py-3 shadow-sm text-uppercase fw-bold">Ver Todas las Ofertas <i class="fas fa-briefcase ms-2"></i></a>
    </div>

</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>

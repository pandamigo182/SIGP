<?php require APPROOT . '/views/layouts/header.php'; ?>
<style>
    @media (min-width: 765px) and (max-width: 975px) {
        .search-text { display: none; }
    }
</style>

<!-- Hero Section -->
<!-- Hero Section -->
<!-- Premium Home Hero -->
<div class="position-relative overflow-hidden" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); padding-top: 4rem; padding-bottom: 8rem; margin-bottom: 2rem;">
    <!-- Abstract Shapes -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="opacity: 0.1;">
        <svg viewBox="0 0 100 100" preserveAspectRatio="none" style="width: 100%; height: 100%;">
            <path d="M0 0 L100 0 L100 100 Z" fill="white"></path>
        </svg>
    </div>

    <div class="container position-relative z-index-1 text-center">
        <!-- Logo Container with Glow -->
        <div class="mb-4 d-inline-block p-4 rounded-pill bg-white shadow-lg animate-float" style="display: flex; align-items: center; justify-content: center;">
            <img src="<?php echo URLROOT; ?>/img/logo-completo.svg" alt="SIGP Logo" class="img-fluid" style="max-height: 150px;">
        </div>
        
        <h1 class="display-5 fw-bold text-white mb-2" style="text-shadow: 0 4px 15px rgba(0,0,0,0.2);">
            Sistema Integral de Gestión de Pasantías
        </h1>
        <p class="lead text-white-50 mx-auto mb-4" style="max-width: 700px;">
            <?php echo $data['description']; ?>
        </p>
    </div>

    <!-- Wave Border Bottom -->
    <div class="position-absolute bottom-0 start-0 w-100" style="line-height: 0;">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" style="width: 100%; height: 60px; fill: var(--bg-body);">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"></path>
        </svg>
    </div>
</div>

<!-- Search Card (Floating Overlay) -->
<div class="container position-relative z-index-2" style="margin-top: -6rem; margin-bottom: 4rem;">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
                <div class="card-body p-4 p-lg-5 bg-white">
                    <form action="<?php echo URLROOT; ?>/plazas" method="GET">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-muted">Búsqueda</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="fas fa-search text-primary"></i></span>
                                    <input type="text" name="q" class="form-control bg-light border-0" placeholder="Cargo o empresa..." value="<?php echo isset($_GET['q']) ? $_GET['q'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small fw-bold text-muted">Rubro</label>
                                <select name="rubro" class="form-select bg-light border-0">
                                    <option value="">Todos</option>
                                    <?php foreach($data['rubros'] as $rubro) : ?>
                                        <option value="<?php echo $rubro->rubro; ?>" <?php echo (isset($_GET['rubro']) && $_GET['rubro'] == $rubro->rubro) ? 'selected' : ''; ?>>
                                            <?php echo $rubro->rubro; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small fw-bold text-muted">Ubicación</label>
                                <select name="departamento_id" class="form-select bg-light border-0">
                                    <option value="">Todas</option>
                                    <?php foreach($data['departamentos'] as $dep) : ?>
                                        <option value="<?php echo $dep->id_departamento; ?>" <?php echo (isset($_GET['departamento_id']) && $_GET['departamento_id'] == $dep->id_departamento) ? 'selected' : ''; ?>>
                                            <?php echo $dep->departamento; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                 <button type="submit" class="btn btn-primary w-100 fw-bold shadow-sm" style="height: 38px;">Buscar</button>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <a href="<?php echo URLROOT; ?>" class="btn btn-outline-secondary w-100 border-0 bg-light" title="Limpiar"><i class="fas fa-undo"></i></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
</style>

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
                             <img src="<?php echo $logoPath; ?>" alt="Logo" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;" loading="lazy">
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
                                 <img src="<?php echo $logoPath; ?>" alt="Logo" class="rounded mb-2" style="width: 40px; height: 40px; object-fit: cover;" loading="lazy">
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

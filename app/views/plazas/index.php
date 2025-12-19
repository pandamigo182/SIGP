<?php require APPROOT . '/views/layouts/header.php'; ?>

<!-- Premium Hero Search -->
<div class="position-relative overflow-hidden" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); padding-top: 5rem; padding-bottom: 8rem; margin-bottom: 2rem;">
    <!-- Abstract Shapes -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="opacity: 0.1;">
        <svg viewBox="0 0 100 100" preserveAspectRatio="none" style="width: 100%; height: 100%;">
            <circle cx="0" cy="0" r="40" fill="white" />
            <circle cx="100" cy="100" r="30" fill="white" />
        </svg>
    </div>

    <div class="container position-relative z-index-1 text-center">
        <h1 class="display-4 fw-bold text-white mb-3" style="text-shadow: 0 4px 15px rgba(0,0,0,0.2);">
            Encuentra tu Pasantía Ideal
        </h1>
        <p class="lead text-white-50 mx-auto mb-4" style="max-width: 600px;">
            Explora cientos de oportunidades en las mejores empresas y da el primer paso en tu carrera profesional.
        </p>
    </div>

    <!-- Wave Border Bottom -->
    <div class="position-absolute bottom-0 start-0 w-100" style="line-height: 0;">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" style="width: 100%; height: 60px; fill: var(--bg-body);">
            <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.5,651.3,1.6,561.08,18.41,478.71,32,364.51,50.83,249.26,69.57,133.58,74.78,92.42,76.62,50.28,75.46,9.15,69.87L0,68.45V120H1200V0C1132.19,23.09,1055.71,74.35,985.66,92.83Z"></path>
        </svg>
    </div>
</div>

<!-- Search Card (Floating Overlay) -->
<div class="container position-relative z-index-2" style="margin-top: -6rem; mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
                <div class="card-body p-4 p-lg-5 bg-white">
                    <form action="<?php echo URLROOT; ?>/plazas" method="GET">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-muted">¿Qué buscas?</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="fas fa-search text-primary"></i></span>
                                    <input type="text" name="q" class="form-control bg-light border-0" placeholder="Cargo, empresa..." value="<?php echo isset($_GET['q']) ? $_GET['q'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
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
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-muted">Ubicación</label>
                                <select name="departamento_id" class="form-select bg-light border-0">
                                    <option value="">Todo el país</option>
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
                            <div class="col-12 text-center mt-2">
                                <a href="<?php echo URLROOT; ?>/plazas" class="text-decoration-none small text-muted"><i class="fas fa-sync-alt me-1"></i> Limpiar filtros</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mb-5"></div> 
<!-- Spacer for list -->

<!-- Listado de Plazas -->
<div class="container mb-5">
    <div class="row">
        <?php if(empty($data['plazas'])) : ?>
            <div class="col-md-12">
                <div class="alert alert-light text-center p-5 rounded-3 shadow-sm border" role="alert">
                    <i class="fas fa-search fa-3x text-muted mb-3 opacity-50"></i>
                    <h4 class="text-muted">No se encontraron resultados</h4>
                    <p class="text-muted">Intenta ajustar los filtros de búsqueda.</p>
                    <a href="<?php echo URLROOT; ?>/plazas" class="btn btn-outline-secondary mt-2">Limpiar Filtros</a>
                </div>
            </div>
        <?php else : ?>
            <?php foreach($data['plazas'] as $plaza) : ?>
                <div class="col-lg-6 mb-4">
                    <div class="card h-100 shadow-sm border-0 transition-hover">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="d-flex align-items-center">
                                    <?php 
                                        $logoPath = !empty($plaza->logoEmpresa) ? URLROOT . '/' . $plaza->logoEmpresa : 'https://ui-avatars.com/api/?name=' . urlencode($plaza->nombreEmpresa) . '&background=random';
                                    ?>
                                    <img src="<?php echo $logoPath; ?>" alt="Logo" class="rounded shadow-sm me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                    <div>
                                        <h5 class="card-title fw-bold mb-0 text-primary"><a href="<?php echo URLROOT; ?>/plazas/show/<?php echo $plaza->plazaId; ?>" class="text-decoration-none"><?php echo $plaza->titulo; ?></a></h5>
                                        <small class="text-muted fw-bold"><?php echo $plaza->nombreEmpresa; ?></small>
                                    </div>
                                </div>
                                <?php if(strtotime($plaza->fechaPublicacion) > strtotime('-24 hours')): ?>
                                     <span class="badge bg-danger rounded-pill px-2">NUEVO</span>
                                <?php endif; ?>
                            </div>

                            <p class="card-text text-muted small mb-3">
                                <?php echo substr(strip_tags($plaza->descripcion), 0, 150) . '...'; ?>
                            </p>
                            
                            <hr class="my-3 opacity-25">

                            <div class="d-flex flex-wrap justify-content-between align-items-center text-muted small">
                                <div>
                                    <span class="me-3"><i class="fas fa-map-marker-alt me-1 text-secondary"></i> <?php echo $plaza->nombreMunicipio; ?></span>
                                    <?php 
                                        $modIcon = 'fa-briefcase'; // Default
                                        $modLower = mb_strtolower($plaza->modalidad, 'UTF-8');
                                        if(strpos($modLower, 'remoto') !== false) { $modIcon = 'fa-laptop'; }
                                        elseif(strpos($modLower, 'presencial') !== false) { $modIcon = 'fa-building'; }
                                        elseif(strpos($modLower, 'híbrido') !== false || strpos($modLower, 'hibrido') !== false) { $modIcon = 'fa-house-user'; }
                                    ?>
                                    <span class="me-3"><i class="fas <?php echo $modIcon; ?> me-1 text-secondary"></i> <?php echo $plaza->modalidad; ?></span>
                                    <span><i class="far fa-clock me-1 text-secondary"></i> <?php echo date('d/m/Y', strtotime($plaza->fechaPublicacion)); ?></span>
                                </div>
                                <div class="mt-2 mt-md-0">
                                    <a href="<?php echo URLROOT; ?>/plazas/show/<?php echo $plaza->plazaId; ?>" class="btn btn-sm btn-outline-primary px-3 rounded-pill">Ver Detalles</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    
    <!-- Pagination -->
    <?php if($data['pagination']['total_pages'] > 1): ?>
    <nav aria-label="Page navigation" class="mt-5">
        <ul class="pagination justify-content-center">
            <?php 
                $current = $data['pagination']['current_page'];
                $total = $data['pagination']['total_pages'];
                
                // Construct URL params except page
                $params = $_GET;
                unset($params['url']); // Remove rewrite url
                unset($params['page']);
                $queryStr = http_build_query($params);
                $baseUrl = URLROOT . '/plazas?' . ($queryStr ? $queryStr . '&' : '');
            ?>
            
            <li class="page-item <?php echo $current <= 1 ? 'disabled' : ''; ?>">
                <a class="page-link shadow-none" href="<?php echo $baseUrl . 'page=' . ($current - 1); ?>">Anterior</a>
            </li>
            
            <?php for($i = 1; $i <= $total; $i++): ?>
                <li class="page-item <?php echo $current == $i ? 'active' : ''; ?>">
                    <a class="page-link shadow-none" href="<?php echo $baseUrl . 'page=' . $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            
            <li class="page-item <?php echo $current >= $total ? 'disabled' : ''; ?>">
                <a class="page-link shadow-none" href="<?php echo $baseUrl . 'page=' . ($current + 1); ?>">Siguiente</a>
            </li>
        </ul>
    </nav>
    <div class="text-center text-muted small mt-2">
        Página <?php echo $current; ?> de <?php echo $total; ?>
    </div>
    <?php endif; ?>
</div>

<style>
    .transition-hover { transition: transform 0.2s; }
    .transition-hover:hover { transform: translateY(-5px); }
</style>

<?php require APPROOT . '/views/layouts/footer.php'; ?>

<?php require APPROOT . '/views/layouts/header.php'; ?>

<!-- Header/Search Section -->
<div class="py-5 mb-5 border-bottom" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="row justify-content-center text-center mb-4">
             <div class="col-md-8">
                 <h1 class="fw-bold mb-3 text-white">Pasantías Disponibles</h1>
                 <p class="text-light lead">Explora las mejores oportunidades para iniciar tu carrera profesional.</p>
             </div>
        </div>

        <div class="row justify-content-center">
             <div class="col-lg-10">
                 <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <form action="<?php echo URLROOT; ?>/plazas" method="GET">
                            <div class="row g-2">
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                                        <input type="text" name="q" class="form-control border-start-0 ps-0" placeholder="Cargo o empresa..." value="<?php echo isset($_GET['q']) ? $_GET['q'] : ''; ?>">
                                    </div>
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
                                     <button type="submit" class="btn btn-primary w-100">Buscar</button>
                                </div>
                                <div class="col-md-2">
                                    <a href="<?php echo URLROOT; ?>/plazas" class="btn btn-outline-secondary w-100">Limpiar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                 </div>
             </div>
        </div>
    </div>
</div>

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

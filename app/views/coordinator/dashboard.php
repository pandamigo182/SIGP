<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="container mt-4">
    <div class="row mb-3">
        <div class="col">
            <h2><i class="fas fa-university me-2"></i>Panel de Coordinador</h2>
            <p class="text-muted">Gestión de estudiantes de su institución.</p>
        </div>
    </div>

    <!-- Stats or Actions -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Estudiantes</h5>
                            <h2 class="mb-0"><?php echo count($data['myStudents']); ?></h2>
                        </div>
                        <i class="fas fa-user-graduate fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add more stats like "Active Internships" later -->
    </div>

    <!-- Students List -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h5 class="mb-0">Estudiantes Registrados</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Matrícula</th>
                            <th>Estudiante</th>
                            <th>Carrera</th>
                            <th>Estado Pasantía</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($data['myStudents'])): ?>
                            <tr>
                                <td colspan="5" class="text-center p-4 text-muted">No se encontraron estudiantes asociados a su institución.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($data['myStudents'] as $student): ?>
                                <tr>
                                    <td><span class="badge bg-light text-dark border"><?php echo $student->matricula; ?></span></td>
                                    <td>
                                        <div class="fw-bold"><?php echo $student->nombre; ?></div>
                                        <small class="text-muted"><?php echo $student->email; ?></small>
                                    </td>
                                    <td><?php echo $student->carrera; ?></td>
                                    <td>
                                        <!-- Placeholder for status, requires query update -->
                                        <span class="badge bg-secondary">Sin Info</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i> Perfil</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row mb-3">
    <div class="col-md-6">
        <h1>Gestión de Usuarios</h1>
    </div>
    <div class="col-md-6">
        <div class="float-end">
            <a href="<?php echo URLROOT; ?>/dashboard" class="btn btn-secondary me-2">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <a href="<?php echo URLROOT; ?>/admin/users_add" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Usuario
            </a>
        </div>
    </div>
</div>

<?php flash('admin_message'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="mb-3">
                    <strong>Filtrar por:</strong> 
                    <a href="<?php echo URLROOT; ?>/admin/users" class="btn btn-sm btn-outline-secondary <?php echo ($data['filterRole'] == null) ? 'active' : ''; ?>">Todos</a>
                    <a href="<?php echo URLROOT; ?>/admin/users/4" class="btn btn-sm btn-outline-secondary <?php echo ($data['filterRole'] == 4) ? 'active' : ''; ?>">Empresas</a>
                    <a href="<?php echo URLROOT; ?>/admin/users/5" class="btn btn-sm btn-outline-secondary <?php echo ($data['filterRole'] == 5) ? 'active' : ''; ?>">Estudiantes</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['users'] as $user): ?>
                                <tr>
                                    <td><?php echo $user->nombre; ?></td>
                                    <td><?php echo $user->email; ?></td>
                                    <td>
                                        <?php 
                                            switch($user->role_id){
                                                case 1: echo '<span class="badge bg-danger">Admin</span>'; break;
                                                case 2: echo '<span class="badge bg-primary">Coordinador</span>'; break;
                                                case 3: echo '<span class="badge bg-info text-dark">Tutor</span>'; break;
                                                case 4: echo '<span class="badge bg-dark">Empresa</span>'; break;
                                                case 5: echo '<span class="badge bg-secondary">Estudiante</span>'; break;
                                                default: echo 'Usuario'; break;
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo URLROOT; ?>/admin/users_edit/<?php echo $user->id; ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                        <?php if($_SESSION['user_id'] != $user->id): ?>
                                            <form action="<?php echo URLROOT; ?>/admin/users_delete/<?php echo $user->id; ?>" method="post" class="d-inline delete-form">
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <?php if($data['totalPages'] > 1): ?>
                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php echo $data['page'] <= 1 ? 'disabled' : ''; ?>">
                            <a class="page-link" href="<?php echo URLROOT; ?>/admin/users/<?php echo $data['page'] - 1; ?>" tabindex="-1">Anterior</a>
                        </li>
                        <?php for($i = 1; $i <= $data['totalPages']; $i++): ?>
                            <li class="page-item <?php echo $data['page'] == $i ? 'active' : ''; ?>">
                                <a class="page-link" href="<?php echo URLROOT; ?>/admin/users/<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?php echo $data['page'] >= $data['totalPages'] ? 'disabled' : ''; ?>">
                            <a class="page-link" href="<?php echo URLROOT; ?>/admin/users/<?php echo $data['page'] + 1; ?>">Siguiente</a>
                        </li>
                    </ul>
                </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e){
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
    });
</script>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

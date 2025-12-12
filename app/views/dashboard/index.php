<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-md-12">
        <h1>Dashboard General</h1>
        <p>Bienvenido, <?php echo $_SESSION['user_name']; ?> (Rol: <?php echo $data['role_name']; ?>)</p>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>

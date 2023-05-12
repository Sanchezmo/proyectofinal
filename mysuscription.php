<?php include('./includes/header.php'); session_start();?>
<?php include('./includes/navbar.php'); ?>
<?php include('./includes/driverdb.php');?>
<div class="container-fluid mt-5">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link " href="user.php">Mis Recetas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="usermedia.php">Mi Multimedia</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="mysuscription.php">Mi Suscripción</a>
        </li>
        
    </ul>
</div>
<?php include('./includes/footer.php'); ?>
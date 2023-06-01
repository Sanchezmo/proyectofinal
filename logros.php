<?php include('./includes/header.php'); session_start();?>
<?php include('./includes/navbar.php'); ?>
<?php include('./includes/driverdb.php');

if($_SESSION['login']!="OK"){header("Location: login.php");} ?>

<div class="container-fluid mt-5">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link " href="user.php">Mis Recetas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="usermedia.php">Mi Multimedia</a>
        </li>
        <li class="nav-item">
            <a class="nav-link"  href="mysuscription.php">Mi Suscripción</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="logros.php">Logros</a>
        </li>

    </ul>
</div>
<?php include('./includes/footer.php');

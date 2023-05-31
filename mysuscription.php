<?php include('./includes/header.php'); session_start();
if($_SESSION['login']!="OK"){header("Location: login.php");}?>
<?php include('./includes/navbar.php'); ?>
<?php include('./includes/driverdb.php');
$id=$_SESSION['id'];

if(isset($_POST['premium'])){
    $premium=$_POST['premium'];
    $query= "UPDATE Users SET Premium='$premium' WHERE CustomerID=$id";
            mysqli_query($conexion,$query);
            header("Location: mysuscription.php");
           
}
?>
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
<?php $query_premium="SELECT * FROM Users WHERE CustomerID=$id";
    $rs=mysqli_query($conexion,$query_premium);
    $row=mysqli_fetch_array($rs);
    $premium=$row['Premium'];
?>   
<?php if($premium=="NO"){ ?> 
    <?php include('./includes/wallet.php'); ?>
<?php }else{ ?>
     <div>Ya eres premium.</div>
    <?php } ?>
</div>

<?php include('./includes/footer.php'); ?>
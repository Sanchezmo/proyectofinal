<?php 
include('./includes/driverdb.php');
session_start();
//LOGIN
if(isset($_POST['user'])&&isset($_POST['password'])){
    $user = $_POST['user'];
    $password = $_POST['password'];
    $query="SELECT * FROM Users WHERE Email ='$user'  AND Pass ='$password' ";
    $result=mysqli_query($conexion,$query);
    $ok=mysqli_fetch_array($result);
            if($ok){
                
             $_SESSION['login']='OK';
             $_SESSION['admin']=$ok['Admin'];      
             header("Location: recetas.php");
            }else{
                $_SESSION['mensaje']='Usuario o contraseña incorrecta';
                header("Location: login.php");
                $_SESSION['login']='NO';
            }
}
//UNLOG
if(isset($_GET['unlog'])){
    session_unset();
    header("Location: index.php");
}
?>
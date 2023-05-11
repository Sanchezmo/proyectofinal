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
             $_SESSION['premium']=$ok['Premium'];
             $_SESSION['email']=$ok['Email'];
             $_SESSION['id']=$ok['CustomerID'];
             $_SESSION['customerName']=$ok['CustomerName'];      
             header("Location: user.php");
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
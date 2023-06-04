<?php include('./includes/driverdb.php');
if(isset($_GET['confirmacion'])){
    $confirmacion=$_GET['confirmacion'];
    $queryconfirm="SELECT * FROM PreUsers WHERE CustomerID=$confirmacion";
    $rs=mysqli_query($conexion,$queryconfirm);
    $row=mysqli_fetch_array($rs);
    if($rs!=0){
     $emailf=$row['Email'];
     $userf=$row['CustomerName'];
     $passf=$row['Pass'];
     $queryregistrofinal="INSERT INTO Users(CustomerName,Premium,Admin,Email,Pass) VALUES('$userf','NO','NO','$emailf','$passf')";
     mysqli_query($conexion,$queryregistrofinal);
     header('Location: login.php');
    }
}
?>
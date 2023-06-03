

<?php include('./includes/driverdb.php'); ?>
<?php
    if(isset($_GET['id']) && isset($_GET['tabla'])&& isset($_GET['idcampo'])&& isset($_GET['page'])&& isset($_GET['file'])){
       
        $id=$_GET['id'];
        $tabla=$_GET['tabla'];
        $idcampo=$_GET['idcampo'];
        $page=$_GET['page'];
        $file=$_GET['file'];
        $fileid=$_GET['file'];

        $query2="SELECT * FROM Media WHERE MediaID = '$fileid' ";
        $archivo=mysqli_query($conexion,$query2);
        $row = mysqli_fetch_array($archivo); 
        
        //unlink('./'.$row['MediaName']);
        unlink($row['MediaPath']);
        $query= "DELETE FROM Media WHERE MediaID = '$fileid' ";
        mysqli_query($conexion,$query);

        $query3= "DELETE FROM $tabla WHERE $idcampo = $id";
        $sentence=mysqli_query($conexion , $query3) or die("sentencia incorrecta".$query3);
        
        
        header("Location: $page.php");
        
        
       
    }
?>

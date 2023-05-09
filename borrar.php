

<?php include('./includes/driverdb.php'); ?>
<?php
    if(isset($_GET['id']) && isset($_GET['tabla'])&& isset($_GET['idcampo'])&& isset($_GET['page'])&& isset($_GET['file'])){
        echo 'entro';
        $id=$_GET['id'];
        $tabla=$_GET['tabla'];
        $idcampo=$_GET['idcampo'];
        $page=$_GET['page'];
        $file=$_GET['file'];
        
        $query= "DELETE FROM $tabla WHERE $idcampo = $id";
        
        $sentence=mysqli_query($conexion , $query) or die("sentencia incorrecta".$query);

        if($sentence){
            unlink($file);
        }
       
       
        header("Location: $page.php");
        
        
       
    }
?>

<?php include('./includes/header.php');session_start(); ;?>
<?php include('./includes/navbar.php');?>
<?php include('./includes/driverdb.php');

if($_SESSION['admin']!="SI"){header("Location: login.php");}
//insert con archivo

    if(isset($_POST['FechaI'])&& isset($_POST['TituloI'])&& isset($_POST['ContenidoI'])&& isset($_FILES['ArchivoI'])){
        $fechai=$_POST['FechaI'];
        $tituloi=$_POST['TituloI'];
        $contenidoi=$_POST['ContenidoI'];
        $archivoi=$_FILES['ArchivoI'];
        $formatoi=$archivoi['type'];
        $sizei=$archivoi['size'];
        $extensioni=explode('.',$archivoi['name'])[1];
        //control de archivo
        if(($extensioni=="jpg"||$extensioni=="png"||$extensioni=="mp4"||$extensioni=="pdf")&& $sizei<15000000){
            $carpeta_destino=$_SERVER['DOCUMENT_ROOT'].'/uploads';
            $rutai=$carpeta_destino.$archivoi['name'];
            move_uploaded_file($_FILES['ArchivoI']['tmp_name'],$rutai);
            $directorio="../uploads".$archivoi['name'];
            $queryi1= "INSERT INTO Articulos (Fecha, Titulo, Contenido, Formato, Extension , Archivo, Size) VALUES('$fechai','$tituloi','$contenidoi','$formatoi','$extensioni','$directorio','$sizei')";
        mysqli_query($conexion,$queryi1);
        header("Location: admin.php");
        }
    }
    if(isset($_POST['FechaI'])&& isset($_POST['TituloI'])&& isset($_POST['ContenidoI'])&&($_FILES['ArchivoI']['size']==0)){
            $fechai2=$_POST['FechaI'];
            $tituloi2=$_POST['TituloI'];
            $contenidoi2=$_POST['ContenidoI'];
            $queryi2= "INSERT INTO Articulos (Fecha, Titulo, Contenido,Extension,Formato,Archivo,Size) VALUES('$fechai2','$tituloi2','$contenidoi2','vacio','vacio','vacio','0')";
            mysqli_query($conexion,$queryi2);
            header("Location: admin.php");
           }
 
//update   
if(isset($_POST['Id']) && isset($_POST['Fecha'])&& isset($_POST['Titulo'])&& isset($_POST['Contenido'])&&isset($_POST['ArchivoHidden'])){
    $id=$_POST['Id'];
    $fecha=$_POST['Fecha'];
    $titulo=$_POST['Titulo'];
    $contenido=$_POST['Contenido'];
    $rutafo=$_POST['ArchivoHidden'];
    if (is_uploaded_file($_FILES['Archivo']['tmp_name'])) {
        if($rutafo!="vacio"){
        unlink($rutafo); 
        }
        $archivo=$_FILES['Archivo'];
        $formato=$archivo['type'];
        //sacar la extension del nombre del archivo
        $extension=explode('.',$archivo['name'])[1];
        //control de archivo
        if(($extension=="jpg"||$extension=="png"||$extension=="mp4"||$extension=="pdf")&& $size<15000000){
        $carpeta_destino=$_SERVER['DOCUMENT_ROOT'].'/uploads';
        $ruta=$carpeta_destino.$archivo['name'];
        move_uploaded_file($_FILES['Archivo']['tmp_name'],$ruta);
        $directorio="../uploads".$archivo['name'];
        $query= "UPDATE Articulos SET Titulo='$titulo', Fecha='$fecha', Contenido='$contenido', Extension='$extension',Formato='$formato',Archivo='$ruta',Size='$size' WHERE Id=$id";
         $update=mysqli_query($conexion,$query);
         header("Location: admin.php");
        }   
    }else{
        if($rutafo!="vacio"){
            unlink($rutafo); 
            }
        $query= "UPDATE Articulos SET Titulo='$titulo', Fecha='$fecha', Contenido='$contenido', Extension='vacio',Formato='vacio',Archivo='vacio',Size=0 WHERE Id=$id";
                    $update=mysqli_query($conexion,$query);
                    header("Location: admin.php");
    } 

}

    ?>
     <div class="container-fluid mt-5">
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="adminrecipe.php">Recetas</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="admincategorie.php">Categorias</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="admincustomer.php">Suscriptores</a>
  </li> 
</ul>
</div>
<div class="container-fluid ">


    <form method="post" action="admin.php" enctype="multipart/form-data">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">FECHA</th>
                    <th scope="col">TITULO</th>
                    <th scope="col">CONTENIDO</th>
                    <th scope="col">MULTIMEDIA</th>
                    <th scope="col">INSERTAR</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
             $query = 'SELECT count(*) as cuenta FROM Articulos';
            $result_count= mysqli_query($conexion , $query);
            $array_id=mysqli_fetch_array($result_count);
            $lastid=1+$array_id['cuenta'];?>
                    <td><input name="FechaI" type="date" require></td>
                    <td><input name="TituloI" type="text" require placeholder="Titulo" size="25"></td>
                    <td><textarea name="ContenidoI" require placeholder="Contenido" size="250"></textarea></td>
                    <td><input name="ArchivoI" type="file"></td>
                    <td><button type="submit" name="insert" require class="btn btn-warning">INSERTAR</button></td>

                <tr>
                    <div class="mb-2"></div>
                </tr>
            </tbody>
        </table>
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">FECHA</th>
                <th scope="col">TITULO</th>
                <th scope="col">CONTENIDO</th>
                <th scope="col">FORMATO</th>
                <th scope="col">ARCHIVO</th>
                <th scope="col">CAMBIAR ARCHIVO</th>
                <th scope="col">EDITAR</th>
                <th scope="col">BORRAR</th>
            </tr>
        </thead>
        <tbody>

            <?php $query2='SELECT * FROM Articulos';
            $result_clientes=mysqli_query($conexion,$query2);
             while ($row = mysqli_fetch_array($result_clientes)){?>
            <form method="post" action="admin.php" id="<?php echo $row['Id']?>">
                <tr>

                    <input name="Id" type="hidden" value="<?php echo $row['Id']?>">
                    <input name="ArchivoHidden" type="hidden" value="<?php echo $row['Archivo']?>">
                    <td><input name="Fecha" type="date" value="<?php echo $row['Fecha']?>"></td>
                    <td><input name="Titulo" type="text" value="<?php echo $row['Titulo']?>" size="25"></td>
                    <td><input name="Contenido" type="text" value="<?php echo $row['Contenido']?>" size="50"></td>
                    <td><?php echo $row['Formato']?></td>
                    <!--mostrar archivo segun formato-->
                    <?php if($row['Extension']=='jpg'||$row['Extension']=='png'){
                        $img="<td><img style='width:40px;'src='".$row['Archivo']."'></td>";
                        echo $img;
                         }else{
                        $img="<td><img style='width:40px;' src='https://cdn.pixabay.com/photo/2017/02/12/21/29/false-2061132_640.png'></td>";
                        echo $img;
                         }?>
                    <td><input name="Archivo" type="file"></td>
                    <td><button type="submit" name="<?php echo $row['Id']?>" class="btn btn-success">UPDATE</button>
                    </td>

                    <td><input type="button"
                            onclick="location.href='borrar.php?id=<?php echo $row['Id']?>&tabla=Articulos&idcampo=Id&page=admin.php&file=<?php echo $row['Archivo']?>'"
                            value="BORRAR" class="btn btn-danger" />
                </tr>
            </form>
            <?php } ?>
        </tbody>
    </table>

</div>

<?php include('./includes/footer.php');?>
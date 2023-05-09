<?php include('./includes/header.php');session_start();?>
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
 

    ?>
<div class="container-fluid mt-5">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link " href="adminrecipe.php">Recetas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="admincategorie.php">Categorias</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="admincustomer.php">Suscriptores</a>
        </li>
    </ul>
</div>
<div class="container-fluid ">


    <form method="post" action="admincategorie.php" enctype="multipart/form-data">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">NOMBRE CATEGORIA</th>
                    <th scope="col">DESCRIPCIÓN</th>
                    <th scope="col">INSERTAR</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
             $query = 'SELECT count(*) as cuenta FROM Categories';
            $result_count= mysqli_query($conexion , $query);
            $array_id=mysqli_fetch_array($result_count);
            $lastid=1+$array_id['cuenta'];?>
                    <td><input name="NombreI" type="text" require size="25"></td>
                    <td><textarea name="DescripcionI" require placeholder="Descripción" cols="70"
                            width="100"></textarea></td>
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
                <th scope="col">NOMBRE CATEGORIA</th>
                <th scope="col">DESCRIPCIÓN</th>
                <th scope="col">EDITAR</th>
                <th scope="col">BORRAR</th>
            </tr>
        </thead>
        <tbody>

            <?php $query2='SELECT * FROM Categories';
            $result_clientes=mysqli_query($conexion,$query2);
             while ($row = mysqli_fetch_array($result_clientes)){?>
            <form method="post" action="admincategorie.php" id="<?php echo $row['CategoryID']?>">
                <tr>

                    <input name="Id" type="hidden" value="<?php echo $row['CategoryID']?>">


                    <td><input name="Nombre" type="text" value="<?php echo $row['CategoryName']?>" size="25"></td>
                    <td><textarea name="DescripcionI" value="<?php echo $row['Description']?>" cols="70"></textarea></td>
                    <td><button type="submit" name="<?php echo $row['CategoryID']?>"
                            class="btn btn-success">UPDATE</button>
                    </td>

                    <td><input type="button"
                            onclick="location.href='borrar.php?id=<?php echo $row['Id']?>&tabla=Categories&idcampo=CategoryID&page=admincategorie&file=<?php echo $row['Archivo']?>'"
                            value="BORRAR" class="btn btn-danger" />
                </tr>
            </form>
            <?php } ?>
        </tbody>
    </table>

</div>

<?php include('./includes/footer.php');?>
<?php include('./includes/header.php');session_start();?>
<?php include('./includes/navbar.php');?>
<?php include('./includes/driverdb.php');
 
 if($_SESSION['admin']!="SI"){header("Location: login.php");}
//insert con archivo

if(isset($_FILES['ArchivoI'])){
    
    $archivoi=$_FILES['ArchivoI'];
    $sizei=$archivoi['size'];
    $extensioni=explode('.',$archivoi['name'])[1];
    //control de archivo
    if(($extensioni=="jpg"||$extensioni=="png"||$extensioni=="mp4"||$extensioni=="pdf")&& $sizei<15000000){
        $carpeta_destino=$_SERVER['DOCUMENT_ROOT'];
        
        move_uploaded_file($_FILES['ArchivoI']['tmp_name'],$carpeta_destino);
        $directorio=$carpeta_destino.$archivoi['name'];
        $name=$archivoi['name'];
        $ownerID=$_SESSION['id'];
        $queryi1= "INSERT INTO Media (MediaPath,MediaSize,MediaName,Extension,OwnerID) VALUES('$directorio','$sizei','$name','$extensioni','$ownerID')";
    mysqli_query($conexion,$queryi1);
    exec('chmod -R 777 ./');
    header("Location: adminmedia.php");
    }
}

    ?>
<div class="container-fluid mt-5">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link " href="adminrecipe.php">Recetas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="admincategorie.php">Categorias</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="admincustomer.php">Suscriptores</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  active" aria-current="page" href="adminmedia.php">Media</a>
        </li>
    </ul>
</div>
<div class="container-fluid ">


    <form method="post" action="adminmedia.php" enctype="multipart/form-data">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ARCHIVO</th>
                    <th scope="col">INSERTAR</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input name="ArchivoI" type="file"></td>


                    <td><button type="submit" name="insert" require class="btn btn-warning">INSERTAR</button></td>
                <tr>
                    <div class="mb-2"></div>
                </tr>
            </tbody>
        </table>
    </form>
    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample"
        aria-expanded="false" aria-controls="collapseExample">
        Mostrar Media
    </button>

    <div class="collapse" id="collapseExample">
        <div class="card card-body">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">MEDIA</th>
                        <th scope="col">PROPIETARIO</th>
                        <th scope="col">BORRAR</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $query2='SELECT * FROM Media';
            $result_clientes=mysqli_query($conexion,$query2);
           
             while ($row = mysqli_fetch_array($result_clientes)){?>
                    <form method="post" action="adminmedia.php" id="<?php echo $row['MediaID']?>">
                        <tr>

                            <input name="ID" type="hidden" value="<?php echo $row['MediaID']?>">
                            <td><?php echo $row['MediaName']?></td>
                            <!--mostrar archivo segun formato-->
                            <?php if($row['Extension']=='jpg'||$row['Extension']=='png'){
                        $img="<td><img style='width:40px;'src='".$row['MediaPath']."'></td>";
                        echo $img;
                         }else{
                        $img="<td><img style='width:40px;' src='https://cdn.pixabay.com/photo/2017/02/12/21/29/false-2061132_640.png'></td>";
                        echo $img;
                         }?>
                            <td><?php  $queryowner='SELECT * FROM Users WHERE CustomerID='.$row['OwnerID'].'';
                                 $result_owner=mysqli_query($conexion,$queryowner);
                                 $owner=mysqli_fetch_array($result_owner);
                                 echo $owner['Email'];?></td>
                            <td><input type="button"
                                    onclick="location.href='borrar.php?id=<?php echo $row['MediaID']?>&tabla=Media&idcampo=MediaID&page=adminmedia&file=<?php echo $row['MediaID']?>'"
                                    value="BORRAR" class="btn btn-danger" />
                        </tr>
                    </form>
                    <?php } ?>
                </tbody>
            </table>


        </div>
    </div>


</div>

<?php include('./includes/footer.php');?>

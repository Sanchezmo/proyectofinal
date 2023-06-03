<?php include('./includes/header.php');session_start();?>
<?php include('./includes/navbar.php');?>
<?php include('./includes/driverdb.php');
 
 if($_SESSION['admin']!="SI"){header("Location: login.php");}
//insert con archivo

    if(isset($_POST['NombreI'])&& isset($_POST['DescriptionI'])){
        $nombrei=$_POST['NombreI'];
        $descriptioni=$_POST['DescriptionI'];
        $queryi1= "INSERT INTO Categories (CategoryName, Description)VALUES('$nombrei','$descriptioni')";
        mysqli_query($conexion,$queryi1);
        header("Location: admincategorie.php");
        }
    
    if(isset($_POST['Nombre'])&& isset($_POST['Description'])&& isset($_POST['ID'])){
        $id=$_POST['ID'];
        $nombre=$_POST['Nombre'];
        $description=$_POST['Description'];
        $query= "UPDATE Categories SET CategoryName='$nombre',Description='$description' WHERE CategoryID=$id";
            mysqli_query($conexion,$query);
            header("Location: admincategorie.php");
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
        <li class="nav-item">
            <a class="nav-link"  href="adminmedia.php">Media</a>
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
                    <td><input name="NombreI" type="text" require size="25" placeholder="Nombre Categoría"></td>
                    <td><textarea name="DescriptionI" require placeholder="Descripción" cols="70" rows="12"></textarea></td>
                    <td><button type="submit" name="insert" require class="btn btn-warning">INSERTAR</button></td>
                <tr>
                    <div class="mb-2"></div>
                </tr>
            </tbody>
        </table>
    </form>
    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Editar Categorías
  </button>

<div class="collapse" id="collapseExample">
  <div class="card card-body">
    
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

                    <input name="ID" type="hidden" value="<?php echo $row['CategoryID']?>">
                    <td><input name="Nombre" type="text" value="<?php echo $row['CategoryName']?>" size="25"></td>
                    <td><textarea name="Description" cols="70" rows="12"><?php echo $row['Description']?> </textarea></td>
                    <td><button type="submit" name="<?php echo $row['CategoryID']?>"
                            class="btn btn-success">UPDATE</button>
                    </td>

                    <td><input type="button"
                            onclick="location.href='borrar.php?id=<?php echo $row['CategoryID']?>&tabla=Categories&idcampo=CategoryID&page=admincategorie&file=<?php echo $row['Archivo']?>'"
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
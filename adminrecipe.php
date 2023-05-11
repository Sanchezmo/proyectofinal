<?php include('./includes/header.php');session_start(); ;?>
<?php include('./includes/navbar.php');?>
<?php include('./includes/driverdb.php');

if($_SESSION['admin']!="SI"){header("Location: login.php");}
//insert con archivo

    if(isset($_POST['NombreI'])&& isset($_POST['RecipeI'])&& isset($_POST['CategoryI'])&& isset($_POST['PremiumI'])&& isset($_FILES['ArchivoI'])){
        $nombre=$_POST['NombreI'];
        $recipe=$_POST['RecipeI'];
        $category=$_POST['CategoryI'];
        $premium=$_POST['PremiumI'];
        $archivoi=$_FILES['ArchivoI'];
        $sizei=$archivoi['size'];
        $extensioni=explode('.',$archivoi['name'])[1];
    //control de archivo
        if(($extensioni=="jpg"||$extensioni=="png"||$extensioni=="mp4"||$extensioni=="pdf")&& $sizei<15000000){
            $carpeta_destino=$_SERVER['DOCUMENT_ROOT'].'/uploads';
            $rutai=$carpeta_destino.$archivoi['name'];
            move_uploaded_file($_FILES['ArchivoI']['tmp_name'],$rutai);
            $directorio="../uploads".$archivoi['name'];
            $name=$archivoi['name'];
            $ownerID=$_SESSION['id'];
            //metemos el archivo a Media
            $queryi1= "INSERT INTO Media (MediaPath,MediaSize,MediaName,Extension,OwnerID) VALUES('$directorio','$sizei','$name','$extensioni','$ownerID')";
            $result_media2=mysqli_query($conexion,$queryi1);
            //sacamos la ID del archivo de Media
            $query_3="SELECT * FROM Media WHERE MediaPath='$directorio'";
            
            $result_3=mysqli_query($conexion,$query_3);
            $row_3=mysqli_fetch_array($result_3);
            $idmedia=$row_3['MediaID'];
            
            //introducimos la receta con el id del archivo
            
            $queryrecipe="INSERT INTO Recipes (RecipeName, Recipe, MediaID, CategoryID, OwnerID, Premium, Vote)VALUES('$nombre','$recipe',$idmedia,$category,$ownerID,'$premium',0)";
            mysqli_query($conexion,$queryrecipe);
            header("Location: adminrecipe.php");
        }
        
    }
    if(isset($_POST['RecipeName'])&& isset($_POST['Recipe'])&& isset($_POST['CategoryID'])&& isset($_POST['Premium'])&& isset($_POST['CambiarMedia'])&& isset($_POST['RecipeID'])){
        
        $id=$_POST['RecipeID'];
        $nombre=$_POST['RecipeName'];
        $recipe=$_POST['Recipe'];
        $category=$_POST['CategoryID'];
        $premium=$_POST['Premium'];
        $cambiomedia=$_POST['CambiarMedia'];
        $ownerID=$_SESSION['id'];
        $queryupdate= "UPDATE Recipes SET RecipeName='$nombre', Recipe='$recipe', MediaID='$cambiomedia',Premium='$premium' WHERE RecipeID=$id";
        mysqli_query($conexion,$queryupdate);
        header("Location: adminrecipe.php");
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
        <li class="nav-item">
            <a class="nav-link" href="adminmedia.php">Media</a>
        </li>
    </ul>
</div>
<div class="container-fluid ">


    <form method="post" action="adminrecipe.php" enctype="multipart/form-data">
        <table class="table table-striped">
            <thead>
                <tr>

                    <th scope="col">NOMBRE</th>
                    <th scope="col">RECETA</th>
                    <th scope="col">CATEGORÍA</th>
                    <th scope="col">PREMIUM</th>
                    <th scope="col">MEDIA</th>
                    <th scope="col">INSERTAR</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
             $query = 'SELECT count(*) as cuenta FROM Recipes';
            $result_count= mysqli_query($conexion , $query);
            $array_id=mysqli_fetch_array($result_count);
            $lastid=1+$array_id['cuenta'];?>

                    <td><input name="NombreI" type="text" require placeholder="Titulo" size="25"></td>
                    <td><textarea name="RecipeI" require placeholder="Contenido" cols="70" rows="12" ></textarea></td>
                    <td><select name="CategoryI">
                            <?php $query_category='SELECT * FROM Categories';
                    $result_category=mysqli_query($conexion,$query_category);
                    while($row_category=mysqli_fetch_array($result_category)){?>
                            <option value="<?php echo $row_category['CategoryID']?>">
                                <?php echo $row_category['CategoryName']?></option>
                            <?php } ?>
                        </select></td>
                    <td><select name="PremiumI">
                            <option value="SI">SI</option>
                            <option value="NO" selected>NO</option>
                        </select></td>
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
                <thead>
                    <tr>

                        <th scope="col">NOMBRE</th>
                        <th scope="col">RECETA</th>
                        <th scope="col">CATEGORÍA</th>
                        <th scope="col">PREMIUM</th>
                        <th scope="col">MEDIA</th>
                        <th scope="col">CAMBIAR MEDIA</th>
                        <th scope="col">ACTUALIZAR</th>
                        <th scope="col">BORRAR</th>
                    </tr>
                </thead>
        <tbody>

            <?php $query2='SELECT * FROM Recipes';
            $result_recipes=mysqli_query($conexion,$query2);
             while ($row = mysqli_fetch_array($result_recipes)){?>
            <form method="post" action="adminrecipe.php" id="<?php echo $row['RecipeID']?>">
                <tr>
                    <input name="RecipeID" type="hidden" value="<?php echo $row['RecipeID']?>">
                    
                    <td><input name="RecipeName" type="text" value="<?php echo $row['RecipeName']?>" size="25"></td>
                    <td><textarea name="Recipe" require placeholder="Contenido" cols="70" rows="12" ><?php echo $row['Recipe']?></textarea></td>
                    <td><select name="CategoryID">
                            <?php $query_category='SELECT * FROM Categories';
                    $result_category=mysqli_query($conexion,$query_category);
                    while($row_category=mysqli_fetch_array($result_category)){?>
                            <option value="<?php echo $row_category['CategoryID']?>"<?php if($row['CategoryID']==$row_category['CategoryID']){echo 'selected';} ?>><?php echo $row_category['CategoryName']?></option>
                            <?php } ?>
                        </select></td>
                        <td><select name="Premium">
                            <?php if($row['Premium']=="SI"){?>
                            <option value="SI" selected>SI</option>
                            <option value="NO">NO</option>
                            <?php }else{ ?>
                            <option value="SI">SI</option>
                            <option value="NO" selected>NO</option>
                            <?php } ?>
                        </select></td>
                    <?php $query_media="SELECT * FROM Media WHERE MediaID = ".$row['MediaID']."";
                    $result_media=mysqli_query($conexion,$query_media);
                    $row_media = mysqli_fetch_array($result_media);?>
                    
                    <!--mostrar archivo segun formato-->
                    <?php if($row_media['Extension']=='jpg'||$row_media['Extension']=='png'){
                        $img="<td><img style='width:40px;'src='".$row_media['MediaPath']."'></td>";
                        echo $img;
                         }else{
                        $img="<td><img style='width:40px;' src='https://cdn.pixabay.com/photo/2017/02/12/21/29/false-2061132_640.png'></td>";
                        echo $img;
                         }?>
                    <td><select name="CambiarMedia">
                            <?php $query_media2='SELECT * FROM Media';
                    $result_media2=mysqli_query($conexion,$query_media2);
                    while($row_media2=mysqli_fetch_array($result_media2)){?>
                            <option value="<?php echo $row_media2['MediaID']?>"<?php if($row['MediaID']==$row_media2['MediaID']){echo 'selected';} ?>>Imagen <?php echo $row_media2['MediaID']?></option>
                            <?php } ?>
                        </select></td>
                    <td><button type="submit" name="<?php echo $row['RecipeID']?>" class="btn btn-success">UPDATE</button>
                    </td>

                    <td><input type="button"
                            onclick="location.href='borrar.php?id=<?php echo $row['RecipeID']?>&tabla=Recipes&idcampo=RecipeID&page=adminrecipe&file=<?php echo $row['MediaID']?>'"
                            value="BORRAR" class="btn btn-danger" />
                </tr>
            </form>
            <?php } ?>
        </tbody>
    </table>

</div>

<?php include('./includes/footer.php');?>
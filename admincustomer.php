<?php include('./includes/header.php');session_start();?>
<?php include('./includes/navbar.php');?>
<?php include('./includes/driverdb.php');
 
if($_SESSION['admin']!="SI"){header("Location: login.php");}
//insert
    if(isset($_POST['NombreI'])&& isset($_POST['EmailI'])&& isset($_POST['AdminI'])&& isset($_POST['PremiumI'])&& isset($_POST['PasswordI'])){
        $nombre=$_POST['NombreI'];
        $email=$_POST['>EmailI'];
        $admin=$_POST['AdminI'];
        $premium=$_POST['PremiumI'];
        $password=$_POST['>PasswordI'];
        $queryi1="INSERT INTO Users (CustomerName, Email, Pass,Admin,Premium) VALUES('$nombre', '$email','$password', '$admin','$premium')";
        mysqli_query($conexion,$queryi1);
        header("Location: admincustomer.php");
        }
//update
    if(isset($_POST['Nombre'])&& isset($_POST['Email'])&& isset($_POST['Admin'])&& isset($_POST['Premium'])&& isset($_POST['Id'])&& isset($_POST['Password'])){
            $nombre=$_POST['Nombre'];
            $email=$_POST['>Email'];
            $admin=$_POST['Admin'];
            $premium=$_POST['Premium'];
            $password=$_POST['>Password'];
            $query= "UPDATE Articulos SET CustomerName='$nombre', Email='$email', Admin='$admin', Premium='$premium',Pass='$password' WHERE Id=$id";
            mysqli_query($conexion,$query);
            header("Location: admincustomer.php");
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
            <a class="nav-link active" aria-current="admincustomer.php" href="#">Suscriptores</a>
        </li>
    </ul>
</div>
<div class="container-fluid ">


    <form method="post" action="admincustomer.php" enctype="multipart/form-data">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">PASSWORD</th>
                    <th scope="col">ADMIN</th>
                    <th scope="col">PREMIUM</th>
                    <th scope="col">INSERTAR</th>
                    <th scope="col"></th>
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
             $query = 'SELECT count(*) as cuenta FROM Users';
            $result_count= mysqli_query($conexion , $query);
            $array_id=mysqli_fetch_array($result_count);
            $lastid=1+$array_id['cuenta'];?>
                    <td><input name="NombreI" type="text" size="25" require></td>
                    <td><input name="EmailI" type="email" size="25" require></td>
                    <td><input name="PasswordI" type="password" size="25" require></td>
                    <td><select name="AdminI">
                            <option value="SI">SI</option>
                            <option value="NO" selected>NO</option>
                        </select></td>
                    <td><select name="PremiumI">
                            <option value="SI">SI</option>
                            <option value="NO" selected>NO</option>
                        </select></td>
                    <td><button type="submit" name="insert" class="btn btn-warning">INSERTAR</button></td>
                    <td>      </td>
                <tr>
                    <div class="mb-2"></div>
                </tr>
            </tbody>
        </table>
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">NOMBRE</th>
                <th scope="col">EMAIL</th>
                <th scope="col">PASSWORD</th>
                <th scope="col">ADMIN</th>
                <th scope="col">PREMIUM</th>
                <th scope="col">EDITAR</th>
                <th scope="col">BORRAR</th>
            </tr>
        </thead>
        <tbody>

            <?php $query2='SELECT * FROM Users';
            $result_clientes=mysqli_query($conexion,$query2);
             while ($row = mysqli_fetch_array($result_clientes)){?>
            <form method="post" action="admincustomer.php" id="<?php echo $row['CustomerID']?>">
                <tr>

                    <input name="Id" type="hidden" value="<?php echo $row['CustomerID']?>">
                    <td><input name="Nombre" type="text" value="<?php echo $row['CustomerName']?>" size="25"></td>
                    <td><input name="Email" type="email" value="<?php echo $row['Email']?>" size="25"></td>
                    <td><input name="Password" type="password" value="<?php echo $row['Pass']?>" size="25"></td>
                    <td><select name="Admin">
                            <?php if($row['Admin']=="SI"){?>
                            <option value="SI" selected>SI</option>
                            <option value="NO">NO</option>
                            <?php }else{ ?>
                            <option value="SI">SI</option>
                            <option value="NO" selected>NO</option>
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
                    

                    <td><button type="submit" name="<?php echo $row['CustomerID']?>"
                            class="btn btn-success">UPDATE</button>
                    </td>

                    <td><input type="button"
                            onclick="location.href='borrar.php?id=<?php echo $row['CustomerID']?>&tabla=Users&idcampo=CustomerID&page=admincustomer&file=<?php echo $row['Archivo']?>'"
                            value="BORRAR" class="btn btn-danger" />
                </tr>
            </form>
            <?php } ?>
        </tbody>
    </table>

</div>

<?php include('./includes/footer.php');?>
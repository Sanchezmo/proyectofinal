<?php include('./includes/header.php'); 
session_start(); 
include('./includes/navbar.php');
//include('./includes/asider.php');

include('./includes/driverdb.php');
//sistema voto;
if(isset($_GET['id'])&&(!empty($_SESSION['id']))){
   
$id=$_GET['id'];
$owner=$_SESSION['id'];

$query_comprobar_voto="SELECT count(*) AS Vote FROM Votos WHERE RecipeID=$id AND OwnerID=$owner";
$rs1=mysqli_query($conexion,$query_comprobar_voto);
$vote_count=mysqli_fetch_array($rs1);

if($vote_count['Vote']==0){
   
    $query_voto="INSERT INTO Votos(RecipeID,OwnerID) VALUES($id,$owner)";
    mysqli_query($conexion,$query_voto);
    header("Location: buscador.php");
}else{
   
    $_SESSION['mensajevoto']="Ya has votado";
}
}
if(isset($_GET['id'])&&(empty($_SESSION['id']))){
    $_SESSION['mensajevoto']="Debes ser un usuario registrado para votar. <a href='login.php'> Login</a> o <a href='register.php'> Registrar</a>";  
}

?>
<hr>
</hr>
<?php if($_SESSION['mensajevoto']){ ?>
<div class="alert alert-danger mt-5"><?php echo $_SESSION['mensajevoto']; session_unset(); ?></div>
<?php } ?>
<div class="container-fluid">
    <div class="row row-cols-4 mt-5">
        <?php $busqueda="%".$_GET['busqueda']."%"; $query="SELECT * FROM Recipes WHERE RecipeName LIKE '$busqueda'";
            $result=mysqli_query($conexion,$query);
             while ($row = mysqli_fetch_array($result)){?>
        <div class="col">
            <div class="card h-100">
                
                <?php $query_media="SELECT * FROM Media WHERE MediaID = ".$row['MediaID']."";
                    $result_media=mysqli_query($conexion,$query_media);
                    $row_media = mysqli_fetch_array($result_media);?>
                <!--mostrar archivo segun formato-->
                <?php if($row_media['Extension']=='jpg'||$row_media['Extension']=='png'){
                        $img="<td><img  style='width:250px;  height:250px; margin:auto;'src='".$row_media['MediaPath']."'></td>";
                        echo $img;
                         }else{
                        $img="<td><img  style='width:250px; height:250px;' src='https://cdn.pixabay.com/photo/2017/02/12/21/29/false-2061132_640.png'></td>";
                        echo $img;
                         }?>
                         
                <div class="card-body">
                    <div class="card-title">
                        Titulo: <?php echo $row['RecipeName']?> <p> Autor: <?php $userid=$row['OwnerID']; $queryowner="SELECT * FROM Users WHERE CustomerID =$userid";
            $resultowner=mysqli_query($conexion,$queryowner);
             while ($rowowner = mysqli_fetch_array($resultowner)){?> <?php echo $rowowner['CustomerName'];} ?></p>
                    </div>
                    <div class="card-text">
                        <?php if($row['Premium']=="SI"&& $_SESSION['premium']=="SI"){ ?>
                        <p class="lead"><?php echo $row['Recipe']?></p>
                        <?php }elseif($row['Premium']=="NO"){ ?>
                        <p class="lead"><?php echo $row['Recipe']?></p>
                        <?php }else{?>
                        <p>Contenido premium. <a href="mysuscription.php">Hazte premium </a>
                            <?php } ?>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="button" onclick="location.href='buscador.php?id=<?php echo $row['RecipeID']?>'"
                        value="VOTAR" class="btn btn-success" />
                    <?php $idr=$row['RecipeID'];
                    $query_numvotos="SELECT Count(*) AS numvotos FROM Votos WHERE RecipeID= $idr";
                    $rs=mysqli_query($conexion,$query_numvotos);$row2=mysqli_fetch_array($rs);?>
                    <span><?php echo $row2['numvotos']?> votos</span>
                </div>

            </div>
        </div>
        <?php }?>
    </div>
</div>

<?php //include('./includes/wallet.php'); ?>
<?php include('./includes/footer.php'); ?>
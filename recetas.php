<?php include('./includes/header.php'); 
session_start(); 
include('./includes/navbar.php');

include('./includes/driverdb.php');


?>
<hr>
</hr>

<?php $query='SELECT * FROM Recipes ORDER BY RecipeID';
            $result=mysqli_query($conexion,$query);
             while ($row = mysqli_fetch_array($result)){?>
<div class="container">
    <hr class="featurette-divider mt-5">

    <div class="row featurette">
        <div class="col-md-7">
            <h2 class="featurette-heading">
                <span class="text-muted"><?php echo $row['RecipeName']?></span></h2>
            <?php if($row['Premium']=="SI"&& $_SESSION['premium']=="SI"){ ?> 
            <p class="lead"><?php echo $row['Recipe']?></p>
            <?php }elseif($row['Premium']=="NO"){ ?> 
                <p class="lead"><?php echo $row['Recipe']?></p>
                <?php }else{?> 
                    <p>Contenido premium. <a href="premium.php">Hazte premium </a> 
                    <?php } ?>
        </div>
        <div class="col-md-5">
        <?php $query_media="SELECT * FROM Media WHERE MediaID = ".$row['MediaID']."";
                    $result_media=mysqli_query($conexion,$query_media);
                    $row_media = mysqli_fetch_array($result_media);?>
                    
                    <!--mostrar archivo segun formato-->
                    <?php if($row_media['Extension']=='jpg'||$row_media['Extension']=='png'){
                        $img="<td><img style='width:250px;'src='".$row_media['MediaPath']."'></td>";
                        echo $img;
                         }else{
                        $img="<td><img style='width:250px;' src='https://cdn.pixabay.com/photo/2017/02/12/21/29/false-2061132_640.png'></td>";
                        echo $img;
                         }?>
        </div>
    </div>
    <hr class="featurette-divider mb-1" style="margin-top:5%">
</div>
<?php }?>


<?php //include('./includes/wallet.php'); ?>
<?php include('./includes/footer.php'); ?>
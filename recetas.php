<?php include('./includes/header.php'); 
session_start(); 
include('./includes/navbar.php');

include('./includes/driverdb.php');


?>
<hr>
</hr>

<?php $query='SELECT * FROM Recipes ORDER BY RecipeID DESC LIMIT 3';
            $result=mysqli_query($conexion,$query);
             while ($row = mysqli_fetch_array($result)){?>
<div class="container">
    <hr class="featurette-divider mt-5">

    <div class="row featurette">
        <div class="col-md-7">
            <h2 class="featurette-heading">
               <span class="text-muted"><?php echo $row['RecipeName']?></span>
            </h2>
            <p class="lead"><?php echo $row['Recipe']?></p>
        </div>
        <div class="col-md-5">
            <?php if($row['Extension']=='jpg'||$row['Extension']=='png'){
                        $img="<img width='320 heigth=240'src='".$row['Archivo']."'>";
                        echo $img;
                         
        }elseif($row['Extension']=='mp4'){
                    $video="<video width='320 heigth=240'><source src='".$row['Imagen']."' type='video/mp4'><source src='".$row['Imagen']."' type='video/ogg'>Su explorador no soporta video</video>";
                    echo $video;
        }elseif($row['Extension']=='vacio'){
                        //no hay contenido
                }else{
                    $img="<img width='320 heigth=240' src='https://cdn.pixabay.com/photo/2017/02/12/21/29/false-2061132_640.png'>";
                    echo $img;
                          
            }?>
        </div>
    </div>
    <hr class="featurette-divider mb-1" style="margin-top:5%">
</div>
<?php }?>


<?php //include('./includes/wallet.php'); ?>
<?php include('./includes/footer.php'); ?>
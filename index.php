<?php include('./includes/header.php'); 
session_start(); 
include('./includes/navbar.php');
?>
<div class="container-fluid" style="margin-top:3%;background-color: #eee;" >
    <div class="row" style="width:40%;margin-left:25%;">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./img/chef.png"
                        class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./img/chef.png"
                        class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./img/chef.png"
                        class="d-block w-100" alt="...">
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('./includes/footer.php'); ?>
<?php include('./includes/header.php');  session_start();?>
<?php include('./includes/navbar.php'); 
      include('./includes/driverdb.php'); 
if(isset($_POST['user'])&& isset($_POST['email'])&& isset($_POST['password'])&& isset($_POST['password2'])&& isset($_POST['terminos'])){
  if($_POST['password']==$_POST['password2']){
    
    $email=$_POST['email'];
    $user=$_POST['user'];
    $password=$_POST['password'];
    $querycheckuser="SELECT * FROM Users WHERE Email ='$email'";
    $rs1 =mysqli_query($conexion,$querycheckuser);
    $row =mysqli_fetch_array($rs1);
   
    if($row==0){
       
        $query="INSERT INTO Users(CustomerName,Premium,Admin,Email,Pass) VALUES('$user','NO','NO','$email','$password')";
        $stm=mysqli_query($conexion,$query);
        if($stm>0){
            header("Location: login.php");
        }
    }elseif($row>0){
        $_SESSION['mensaje2']="Usuario registrado"; 
    }
  }elseif($_POST['password']!=$_POST['password'])
  $_SESSION['mensaje2']="Las password deben coincidir";
}
if(isset($_POST['user'])&& isset($_POST['email'])&& isset($_POST['password'])&& isset($_POST['password2'])&& empty($_POST['terminos'])){
  $_SESSION['mensaje2']="Acepte los terminos de uso";
  
}

?>
<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Registro</p>

                                <form class="mx-1 mx-md-4" method="post" action="register.php"
                                    enctype="multipart/form-data">
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="form3Example1c">Nombre</label>
                                            <input type="text" id="form3Example1c" name="user" class="form-control" />

                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="form3Example3c">Email</label>
                                            <input type="email" id="form3Example3c" name="email" class="form-control" />

                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="form3Example4c">Password</label>
                                            <input type="password" id="form3Example4c" name="password"
                                                class="form-control" />

                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="form3Example4cd">Repetir Password</label>
                                            <input type="password" id="form3Example4cd" name="password2"
                                                class="form-control" />
                                            <?php if($_SESSION['mensaje2']!=""){ ?>
                                            <div class='alert alert-danger'><?php echo $_SESSION['mensaje2'] ?></div>
                                            <?php session_unset(); } ?>
                                        </div>
                                    </div>

                                    <div class="form-check d-flex justify-content-center mb-5">
                                        <input class="form-check-input me-2" name="terminos" type="checkbox"
                                            value="aceptados" id="form2Example3c" />
                                        <label class="form-check-label" for="form2Example3">
                                            Estoy de acuerdo con los <a href="terminos.php">Terminos de uso</a>
                                        </label>
                                    </div>

                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" class="btn btn-primary btn-lg">Registrar</button>
                                    </div>

                                </form>

                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                <img src="./img/chef.png" class="img-fluid" width="200%" alt="Sample image">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('./includes/footer.php'); ?>
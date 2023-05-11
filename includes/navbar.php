<nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"> <img src="./img/chef.png" alt="Logo" width="30" height="24"
                class="d-inline-block align-text-top"> RECETAS.ES</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="nav col-12 col-lg-auto mb-2 justify-content-end mb-md-0">
                <span class="nav-link" style="color:white;" id="time" href="#"></span>
                <a class="nav-link " href="index.php">HOME</a>
                <a class="nav-link " href="recetas.php">RECETAS</a>
                <a class="nav-link " href="#">SOBRE NOSOTROS</a>

                <!--<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>-->

                <script>
                var fechaHora = new Date();
                var fecha = ('0' + fechaHora.getDate()).slice(-2) + '/' + ('0' + (fechaHora.getMonth() + 1)).slice(-2) +
                    '/' + fechaHora.getFullYear();
                var hora = ('0' + fechaHora.getHours()).slice(-2) + ':' + ('0' + fechaHora.getMinutes()).slice(-2) +
                    ':' + ('0' + fechaHora.getSeconds()).slice(-2);
                document.getElementById('time').innerHTML = fecha + "  " + hora;


                setInterval(() => {
                    var fechaHora = new Date();
                    var fecha = ('0' + fechaHora.getDate()).slice(-2) + '/' + ('0' + (fechaHora.getMonth() + 1))
                        .slice(-2) +
                        '/' + fechaHora.getFullYear();
                    var hora = ('0' + fechaHora.getHours()).slice(-2) + ':' + ('0' + fechaHora.getMinutes())
                        .slice(-2) +
                        ':' + ('0' + fechaHora.getSeconds()).slice(-2);
                    document.getElementById('time').innerHTML = fecha + "  " + hora;

                }, 1000);
                </script>
            </div>
        </div>
        <?php   if($_SESSION['admin']=="SI"){echo '<a class="nav-link " href="adminrecipe.php">ADMINISTRAR</a>';} ?>
        <?php  $name='<a class="nav-link right px-8 text-white" href="user.php">'.$_SESSION['customerName'].'</a><a class="nav-link right px-8 text-white " href="control.php?unlog=unlog">SALIR</a>';
         if($_SESSION['login']=="OK"){echo $name;} ?>
        <?php   if($_SESSION['login']!="OK"){echo '<a class="nav-link right px-8 text-white " href="login.php">LOGIN</a>
        <a class="nav-link right px-8 text-white " href="register.php">REGISTRARSE</a>';} ?>

    </div>
</nav>
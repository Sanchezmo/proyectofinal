<?php include('./includes/header.php'); ?>
<?php include('./includes/navbar.php'); session_start();?>

<div class="container p-4 mt-5">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-body">
                <form action="control.php" method="POST">
                    <div class="form-group">
                        <label for="user" class="col-sm-2 col-form-label">Usuario</label>
                        <input type="text" class="form-control" id="user" name="user" placeholder="Usuario">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <input type="password" class="form-control" id="inputPassword" name="password">
                    </div>
                    <input type="submit" class="btn btn-success mt-3" name="intro" value="Entrar">
                </form>
                <?php if(isset($_SESSION['mensaje'])){?>
                <div class="alert alert-danger" role="alert">Error
                    <?php echo $_SESSION['mensaje']; ?>
                </div> <?php session_unset();}?>
            </div>
        </div>
    </div>
</div>

<?php include('./includes/footer.php'); ?>
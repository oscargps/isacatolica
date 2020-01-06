<?php
    session_start();
    if(isset($_SESSION['username']))
    {
        $auth="ok";

    }else
    {
            echo"<script>location.href='../index.html';</script>";

    }
    include "conexion.php";
    $con=mysqli_connect($host,$user,$pw) or die ("no se puede conectar al server");
    mysqli_select_db($con,$db) or die("no se puede conectar a la base de datos");



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pagina principal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/principal.css">
</head>
<header>
    <div class=" container">
        <div class="row">
            <div class="col-md-4 col-md-2 col-sm-1"><img src="../img/logo.jpg" alt=""></div>
            <div class="col-md-4 col-md-2 col-sm-1 align-self-center"><h3><b> Bienvenido Sr:<br> <?php echo $_SESSION['name']?></b></h3></div>
            <div class="col-md-2 col-md-2 col-sm-1 align-self-center" style="display:block;">
                <a href="profile.php" class="btn btn-success">Ver mi perfil</a>
            </div>
            <div class="col-md-2 col-sm-1 align-self-center">
                <a href="cerrar.php" class="btn btn-danger" >Cerrar Sesion</a>
            </div>

        </div>
    </div>
</header>

<body>
    <div class="container">
      <div class="row justify-content-around m-5 text-center item" style="height: 100px;">
        <div class="col col-md-3 ">
          <h1>Permisos</h1>
        </div>
        <div class="col col-md-3 ">
          citaciones
        </div>
        <div class="col col-md-3 ">
          Estudiantes
        </div>
      </div>
      <div class="row justify-content-around m-5 text-center item" style="height: 100px;">
        <div class="col col-md-3 ">
          Permisos
        </div>
        <div class="col col-md-3 ">
          citaciones
        </div>
        <div class="col col-md-3 ">
          Estudiantes
        </div>
      </div>
    </div></br>

    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   <script>

   </script>
</body>
</html>

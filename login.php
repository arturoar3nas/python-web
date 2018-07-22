<?php
/*
Author: Arturo Arenas
*/
session_start();

/// si esta iniciada la sesion, redireccionar a la pagina de indice
if(isset($_SESSION['k_username'])!="")
{
  header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <!-- Jquery -->
  <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
  <!--Validate Script-->
  <script type="text/javascript" src="js/validation.min.js"></script>
  <!-- Img Innovared-->
  <link href="img/favicon.ico" type="image/x-icon" rel="shortcut icon">
  <!--Login Script-->
  <script type="text/javascript" src="login_c.js"></script>
  <!-- Title-->
  <title>Wolke</title>
</head>

<body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">
          <img style="width: 30px; align: right" alt="Logo Net-Energy" src="img/raspberry-pi.png">  Login</div>
          <div class="card-body">
            <form class="form-signin" method="post" id="login-form">
              <br>
              <div id="error">
                <!-- error will be shown here ! -->
              </div>              
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Usuario" name="user_email" id="user_email" autocomplete="off" />
                <span id="check-e"></span>
              </div>              
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Contraseña" name="password" id="password" />
              </div>             
              
              <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block" name="btn-login" id="btn-login">
                  <span class="glyphicon glyphicon-log-in"></span> &nbsp; Ingresar 
                  </button> 
              </div> 
              <br>
              <div class="row">
                <div class="col">
                  <img style="width: 130px; align: right" alt="Logo Innovared" src="img/raspberry-pi.png">
                </div>
                <div class="col">
                  <p class="text-right" align="right">Wolke - Versi&oacute;n 1.0.0.5</p>
                </div>
              </div>
            </form>

          </div>          
        </div>
      </div>

<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Bootstrap core JavaScript
<script src="vendor/jquery/jquery.min.js"></script>

<!-- Core plugin JavaScript

-->
</body>
</html>

<?php

/*
Author: Julio César Canelón
URL: http://www.innovared.cl
*/
session_start();

if(isset($_SESSION["k_username"])=="")
{
	header("Location: login.php");
}

$readonly = "";
$disabled = "";
if($_SESSION["k_username"] != "admin")
{
	$readonly = "readonly";
	$disabled = "disabled";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>INNOVARED - Configuraci&oacute;n de InnoRTU</title>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<script type="text/javascript" src="../js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="../js/validation.min.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="screen">
<script type="text/javascript" src="../js/reiniciar_equipo_c.js"></script>
<link href="../img/favicon.ico" type="image/x-icon" rel="shortcut icon">
</head>

<body>
    
<div class="signin-form">
	<div class="container">       
       <form class="form-signin" method="post" id="restart-form">		
		<img style="width: 250px; height: 73px;" alt="Logo Net-Energy" src="../img/logo-innoRTU.png">
        <hr />
		 <div class="btn-group-justified">
			<a href="../index.php" class="btn btn-default">Inicio</a>
			<a href="../gprs_status.php" class="btn btn-default">Estado GPRS</a>
			<a href="../rtu_status.php" class="btn btn-default">Estado RTU</a>
			<a href="../cerrar_sesion.php" class="btn btn-link">Salir</a>		
		</div>
		<h2 class="text-center">Reiniciar equipo</h2><hr />
        
        <div id="error">
        <!-- error will be shown here ! -->
        </div>
		<div class="panel-group"  >			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
							Se est&aacute; reiniciando el equipo, tardar&aacute; varios minutos.
					</h4><br/>
					<br/>
					
					<div id="mensaje">
						<div class="alert alert-info">							
						</div>
					</div>
				</div>
			</div> <!--FIN panel 2-->
		</div>
     	<hr />
                
		<p class="text-right">Versi&oacute;n 2.0</p>

       <hr />
	   <img style="width: 130px; align: right" alt="Logo Innovared" src="../img/logo-innovared.png">	          	 
	  </form> 
    </div>
    
</div>
<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
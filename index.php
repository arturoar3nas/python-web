<?php
/*
Author: Arturo Arenas
*/
session_start();

if (!isset($_SESSION['k_username']))
{
  header('Location: login.php');
}

$readonly = "";
$disabled = "";
if($_SESSION["k_username"] != "admin")
{
  $readonly = "readonly";
  $disabled = "disabled";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Setup</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <!-- Favicon-->
  <link href="img/favicon.ico" type="image/x-icon" rel="shortcut icon">
  <!-- Jquery -->
  <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
  <!-- Validation -->
  <script type="text/javascript" src="js/validation.min.js"></script>
  <!--Controller-->
  <script type="text/javascript" src="index_c.js"></script>
  <!-- Alertify Js -->
  <script src="alertifyjs/alertify.min.js"></script>
  <!-- include the style -->
  <link rel="stylesheet" href="alertifyjs/css/alertify.min.css" />
  <link rel="stylesheet" href="alertifyjs/css/themes/default.min.css" />
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <img style="width: 40px; height: 50px;" alt="Logo Net-Energy" src="img/raspberry-pi.png">
    <!--<a class="navbar-brand" href="index.html">Start InnoRTU</a>-->
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Home">
          <a class="nav-link" href="index.php">
            <i class="fa fa-cog"></i>
            <span class="nav-link-text">Setup</span>
          </a>
        </li>
      </ul>

      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="php/cerrar_sesion.php" class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Navigation -->

  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="signin-form">        
        <form class="form-signin" method="post" id="index-form">

			<!-- Panel 1 -->
			<h4><a>Flags</a></h4>
			<!-- Rounded switch -->
			<label for="fWifi">Wifi</label>
			<label class="switch">

			  <input type="hidden" name="fWifi" value="0" id="fWifi">
			  <input type="checkbox" value="1" name="fWifi" id="fWifi">
			  <span class="slider round"></span>

			</label>

			<label for="f3G">3G</label>
			<label class="switch">

			  <input type="hidden" name="f3G" value="0" id="f3G">
			  <input type="checkbox" value="1" name="f3G" id="f3G">
			  <span class="slider round"></span>

			</label>

			<label for="fBt">Bluethoot</label>
			<label class="switch">

			  <input type="hidden" name="fBt" value="0" id="fBt">
			  <input type="checkbox" value="1" name="fBt" id="fBt">
			  <span class="slider round"></span>

			</label>
					
			<!--FIN panel 1-->
				
			<!-- Panel 2 -->
	        <hr><h4><a>Operador plan de datos SIM</a></h4>
	        <div class="form-group">
	          <label for="isp" >ISP</label>
	          <br/>
	          <select onchange="selectISP(this.value,1)" name="isp" id="isp" class="btn dropdown-toggle selectpicker btn-default">
	            <option value="0">ENEL Movistar</option>
	            <option value="1">Entel</option>
	            <option value="2">Movistar WAP</option>
	            <option value="3">Movistar WEB</option>
	            <option value="4">Claro</option>
	            <option value="5">WOM</option>
	            <option value="6">VTR</option>
	            <option value="7">OTRO...</option>
	          </select>
	        </div>
	        
	        <div class="row">
	          <div class="col">
	            <label for="apn">APN</label>
	            <input type="text" class="form-control" name="apn" id="apn" required />
	          </div>  
	          <div class="col">
	            <label for="apn_user">Usuario</label>
	            <input type="text" class="form-control" name="apn_user" id="apn_user" required />
	          </div>  
	          <div class="col">
	            <label for="apn_password">Contrase&ntilde;a</label>
	            <input type="text" class="form-control" name="apn_password" id="apn_password" required />
	          </div> 
	        </div>   
			<!--FIN panel 2-->

			<!-- Panel 3 -->
			<hr><h4><a>Configutacion Wifi</a></h4>	        
	        <div class="row">
	          <div class="col">
	            <label for="wifi_ssid">SSID</label>
	            <input type="text" class="form-control" name="wifi_ssid" id="wifi_ssid" required />
	          </div>  
	          <div class="col">
	            <label for="wifi_password">Contrase&ntilde;a</label>
	            <input type="text" class="form-control" name="wifi_password" id="wifi_password" required />
	          </div> 
	        </div>   
			<!--FIN panel 3-->
				<hr><h4><a>Otras Configuraciones</a></h4>
				<label for="fScan">Stop Scan</label>
				<label class="switch">
				  <input type="hidden" name="fScan" value="0" id="fScan">
				  <input type="checkbox" value="1" name="fScan" id="fScan">
				  <span class="slider round"></span>
				</label>
				<div class="row">
			          <div class="col">
						<label for="">Scan Time</label>
						<input type="number" min="0" max="999" class="form-control" id="Scan_Time" name ="Scan_Time" required >
			          </div> 
			          <div class="col">
					  </div> 
			          <div class="col"> 
				      </div>
				      <div class="col"> 
				      </div>
			     </div> 

				<div class="row">
		          <div class="col">
		            <label for="Aplicacion">Aplicacion</label>
		            <input type="text" class="form-control" name="Aplicacion" id="Aplicacion" required />
		          </div>  
		          <div class="col">
		            <label for="Key">Key</label>
		            <input type="text" class="form-control" name="Key" id="Key" required />
		          </div>	          	
		          <div class="col">
						<label for="ID">ID</label>
						<input type="number" min="0" max="999" class="form-control" id="ID" name ="ID" required >
					</div>	
					<div class="col">			
					</div>	  
		        </div>   
	     		<br><br>

			<div class="form-group">
            <button class="btn btn-success" name="btn-configurar" id="btn-configurar" onclick="guardarForm();">
				<span class="glyphicon glyphicon-cog"></span> &nbsp; Configurar 
			</button>

          <!-- Footer -->
          <footer class="sticky-footer">
            <div class="container">        
              <div class="text-center">
                <img style="width: 30px; align: right" alt="Logo Innovared" src="img/raspberry-pi.png">
                <small>Copyright © - Versi&oacute;n 1.0.0.0 </small>
              </div>
            </div>
          </footer>
          <!-- Footer -->
          <!-- Scroll to Top Button-->
          <a class="scroll-to-top rounded" href="#page-top">
            <i class="fa fa-angle-up"></i>
          </a>
          <!-- Logout Modal-->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <a class="btn btn-primary" href="php/cerrar_sesion.php">Logout</a>
                </div>
              </div>
            </div>
          </div>
          <!-- Bootstrap core JavaScript-->
          <!-- <script src="vendor/jquery/jquery.min.js"></script> -->
          <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
          <!-- Core plugin JavaScript-->
          <!-- <script src="vendor/jquery-easing/jquery.easing.min.js"></script> -->
          <!-- Custom scripts for all pages-->
          <script src="js/sb-admin.min.js"></script>  
        </form>
      </div>
    </div><!-- /.container-fluid-->
  </div><!-- /.content-wrapper-->    
</body>
</html>
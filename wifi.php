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
if($_SESSION["k_username"] != $_SESSION["k_admin"])
{
  $readonly = "readonly";
  $disabled = "disabled";
}
    require_once("header.php");
    require_once("nav.php");
?>

<script type="text/javascript" src="wifi_c.js"></script>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="signin-form">        
        <form class="form-signin" method="post" id="wifi-form">
			<!-- Panel 1 -->
			<h4><a>Wifi</a></h4>
			
			<!-- Rounded switch -->
			<label for="fWifi"></label>
			<label class="switch">

			  <input type="hidden" name="fWifi" value="0" id="fWifi">
			  <input type="checkbox" value="1" name="fWifi" id="fWifi">
			  <span class="slider round"></span>

			</label>		
			<!--FIN panel 1-->

			<!-- Panel 3 -->
			<hr><h4><a>Configuracion Wifi</a></h4>	        
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
			<br><br>
			<div class="form-group">
            <button class="btn btn-success" name="btn-configurar" id="btn-configurar" onclick="guardarForm();">
				<span class="glyphicon glyphicon-cog"></span> &nbsp; Configurar 
			</button>

			<?php
    			require_once("footer.php");
    			require_once("scroll.php");
    			require_once("logout.php");
			?> 
        </form>
      </div>
    </div><!-- /.container-fluid-->
  </div><!-- /.content-wrapper-->    
</body>
</html>
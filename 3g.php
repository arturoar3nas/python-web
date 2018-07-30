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

<script type="text/javascript" src="3g_c.js"></script>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="signin-form">        
        <form class="form-signin" method="post" id="3g-form">
			<!-- Panel 1 -->
			<h5><a>3G</a></h5>
			<!-- Rounded switch -->
			<label class="switch">
			  <input type="hidden" name="f3G" value="0" id="f3G">
			  <input type="checkbox" value="1" name="f3G" id="f3G">
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
	        <br><br>
			<button class="btn btn-success" name="btn-configurar" id="btn-configurar" onclick="guardarForm();">
				<span class="glyphicon glyphicon-cog"></span> &nbsp; Configurar 
			</button>
	        <br><hr>
			<h4><a>Estado SIM</a></h4>
			<div class="row">
	          <div class="col">
	            <label for="red">Red </label>
	            <input type="text" class="form-control" name="red" id="red"  readonly />
	          </div>  
	          <div class="col">
	            <label for="signal">Intensidad de la señal </label>
	            <input type="text" class="form-control" name="signal" id="signal" readonly />
	          </div>  
	          <div class="col">
	            <label for="type">Tipo de Red</label>
	            <input type="text" class="form-control" name="type" id="type" readonly />
	          </div> 
	        </div>
	        <br><br>
	        <div class="row">
	          <div class="col">
	            <label for="status">Estado del Servicio</label>
	            <input type="text" class="form-control" name="status" id="status"  readonly />
	          </div>  
	          <div class="col">
	            <label for="roaming">Roaming </label>
	            <input type="text" class="form-control" name="roaming" id="roaming" readonly />
	          </div>  
	          <div class="col">
	            <label for="imei">IMEI</label>
	            <input type="text" class="form-control" name="imei" id="imei" readonly />
	          </div> 
	        </div>
	        <br><br>    
			
			<!--FIN panel 2-->

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
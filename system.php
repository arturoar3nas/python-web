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

<script type="text/javascript" src="system_c.js"></script>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="signin-form">        
        <form class="form-signin" method="post" id="system-form">
			<!-- Panel 1 -->
			<h4><a>Bluethoot</a></h4>
			<!-- Rounded switch -->
			<label class="switch">
			  <input type="hidden" name="fBt" value="0" id="fBt">
			  <input type="checkbox" value="1" name="fBt" id="fBt">
			  <span class="slider round"></span>
			</label>				
			<!--FIN panel 1-->
			<hr>
			<h4><a>Estatus del Sistema</a></h4>
			<div class="row">
	          <div class="col">
	            <label for="apn">Memoria Activa </label>
	            <input type="text" class="form-control" name="ActiveMemory" id="ActiveMemory" readonly />
	          </div>  
	          <div class="col">
	            <label for="apn_user">Memoria dispobible </label>
	            <input type="text" class="form-control" name="AvailableMemory" id="AvailableMemory"  readonly />
	          </div>  
	          <div class="col">
	            <label for="apn_password">Buffer de Memoria </label>
	            <input type="text" class="form-control" name="BufferMemory" id="BufferMemory"  readonly />
	          </div> 
	        </div>

	        <div class="row">
	          <div class="col">
	            <label for="apn">Memoria Cache </label>
	            <input type="text" class="form-control" name="CachedMemory" id="CachedMemory"  readonly />
	          </div>  
	          <div class="col">
	            <label for="apn_user">Memoria Libre </label>
	            <input type="text" class="form-control" name="FreeMemory" id="FreeMemory" readonly />
	          </div>  
	          <div class="col">
	            <label for="apn_password">Memoria Inactiva </label>
	            <input type="text" class="form-control" name="InactiveMemory" id="InactiveMemory" readonly />
	          </div> 
	        </div>

	        <div class="row">
	          <div class="col">
	            <label for="apn">Memoria Total </label>
	            <input type="text" class="form-control" name="TotalMemory" id="TotalMemory" readonly />
	          </div>  
	          <div class="col">
	            <label for="apn_user">Almacenamiento Libre </label>
	            <input type="text" class="form-control" name="diskfree" id="diskfree" readonly />
	          </div>  
	          <div class="col">
	            <label for="apn_password">Almacenamiento Usado </label>
	            <input type="text" class="form-control" name="diskused" id="diskused" readonly />
	          </div> 
	        </div>

	        <div class="row">
	          <div class="col">
	          </div>  
	          <div class="col">
	            <label for="apn_user">Almacenamiento Total </label>
	            <input type="text" class="form-control" name="disktotal" id="disktotal" readonly />
	          </div>  
	          <div class="col">
	            <label for="apn_password">% de uso de Cpu </label>
	            <input type="text" class="form-control" name="CpuPercent" id="CpuPercent" readonly />
	          </div> 
	        </div>

	        <br><br>
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
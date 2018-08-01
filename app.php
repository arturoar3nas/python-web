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

<script type="text/javascript" src="app_c.js"></script>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="signin-form">        
        <form class="form-signin" method="post" id="app-form">
			<h4><a>Detener Escaneo</a></h4>
				<label for="fScan"></label>
				<label class="switch">
				  <input type="hidden" name="fScan" value="0" id="fScan" required <?php echo $disabled; ?>>
				  <input type="checkbox" value="1" name="fScan" id="fScan" required <?php echo $disabled; ?>>
				  <span class="slider round"></span>
				</label>
				<div class="row">
			          <div class="col">
						<label for="">Tiempo de Escaneo (segundos) </label>
						<input type="number" min="0" max="999" class="form-control" id="Scan_Time" name ="Scan_Time" required <?php echo $disabled; ?> >
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
		            <label for="Aplicacion">Aplicaci&oacuten</label>
		            <input type="text" class="form-control" name="Aplicacion" id="Aplicacion" required <?php echo $disabled; ?>/>
		          </div>  
		          <div class="col">
		            <label for="Key">Key</label>
		            <input type="text" class="form-control" name="Key" id="Key" required <?php echo $disabled; ?> >
		          </div>	          	
		          <div class="col">
						<label for="ID">ID</label>
						<input type="number" min="0" max="999" class="form-control" id="ID" name ="ID" required <?php echo $disabled; ?> >
					</div>	
					<div class="col">
					</div>	  
		        </div>
		        <div class="row">
		          <div class="col">
		            <label for="Aplicacion">Versi&oacuten</label>
		            <input type="text" class="form-control" name="version" id="version" required <?php echo $disabled; ?> />
		          </div>  
		          <div class="col">
		            <label for="Key">Direcci&oacuten Servidor</label>
		            <input type="text" class="form-control" name="server" id="server" required <?php echo $disabled; ?> >
		          </div>	          	
		          <div class="col">
		          	<label for="Pnumber">Estado del Proceso</label>
					<input type="text" class="form-control" id="Pnumber" name ="Pnumber" readonly  >	
				  </div>	
					<div class="col">	
					</div>	  
		        </div> 
				<hr>
				<h4><a>Detener Medici&oacuten de Peso</a></h4>
				<label for="fWeight"></label>
				<label class="switch">
				  <input type="hidden" name="fWeight" value="0" id="fWeight" required <?php echo $disabled; ?>>
				  <input type="checkbox" value="1" name="fWeight" id="fWeight" required <?php echo $disabled; ?>>
				  <span class="slider round"></span>
				</label>
		        <div class="row">
		          <div class="col">
		            <label for="tara">Tara (Kg)</label>
		            <input type="text" class="form-control" name="tara" id="tara" readonly  />
		          </div>  
		          <div class="col">
		            <label for="Key">Peso (Kg)</label>
		            <input type="text" class="form-control" name="weight" id="weight" readonly  >
		          </div>	          	
		          <div class="col">
						<label for="ID">Ganancia (Kg)</label>
						<input type="number" class="form-control" id="Gain" name ="Gain" readonly >
					</div>	
					<div class="col">	
						<label for="ID">Estado de Calibraci&oacuten</label>
						<input type="string" class="form-control" id="Calibration_Status" name ="Calibration_Status" readonly>		
					</div>	  
		        </div>    
	     		<br><br>
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
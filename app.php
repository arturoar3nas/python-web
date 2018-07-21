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
			<h4><a>Stop Scan</a></h4>
				<label for="fScan"></label>
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
		            <input type="text" class="form-control" name="Key" id="Key" required <?php echo $disabled; ?> >
		          </div>	          	
		          <div class="col">
						<label for="ID">ID</label>
						<input type="number" min="0" max="999" class="form-control" id="ID" name ="ID" required <?php echo $disabled; ?> >
					</div>	
					<div class="col">			
					</div>	  
		        </div>
				<hr>
				<h4><a>Stop Weight</a></h4>
				<label for="fScan"></label>
				<label class="switch">
				  <input type="hidden" name="fWeight" value="0" id="fWeight">
				  <input type="checkbox" value="1" name="fWeight" id="fWeight">
				  <span class="slider round"></span>
				</label>
		        <div class="row">
		          <div class="col">
		            <label for="Aplicacion">Tara</label>
		            <input type="text" class="form-control" name="Tara" id="Tara" required />
		          </div>  
		          <div class="col">
		            <label for="Key">Weigth</label>
		            <input type="text" class="form-control" name="Weigth" id="Weigth" required <?php echo $disabled; ?> >
		          </div>	          	
		          <div class="col">
						<label for="ID">Gain</label>
						<input type="number" min="0" max="999" class="form-control" id="Gain" name ="Gain" required <?php echo $disabled; ?> >
					</div>	
					<div class="col">	
						<label for="ID">Calibration_Status</label>
						<input type="number" min="0" max="999" class="form-control" id="Calibration_Status" name ="Calibration_Status" required <?php echo $disabled; ?> >		
					</div>	  
		        </div>

		        <div class="row">
		          <div class="col">
		            <label for="Aplicacion">Version</label>
		            <input type="text" class="form-control" name="version" id="version" required />
		          </div>  
		          <div class="col">
		            <label for="Key">Direction Server</label>
		            <input type="text" class="form-control" name="server" id="server" required <?php echo $disabled; ?> >
		          </div>	          	
		          <div class="col">
					</div>	
					<div class="col">	
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
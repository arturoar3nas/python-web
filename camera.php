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
<script type="text/javascript" src="camera_c.js"></script>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="signin-form">        
        <form class="form-signin" method="post" id="index-form">

        	<div id="img">
        		<!-- Load img here! -->
	        </div>

        	<br><br>
			<div class="form-group">
            <button class="btn btn-success" name="btn-configurar" id="btn-configurar" onclick="cargarForm();">
				<span class="glyphicon glyphicon-cog"></span> &nbsp; Refresh 
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
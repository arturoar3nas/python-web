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
        <form class="form-signin" method="post" id="index-form">
			<!-- Panel 1 -->
			<h4><a>Bluethoot</a></h4>
			<!-- Rounded switch -->
			<label for="fBt"></label>
			<label class="switch">
			  <input type="hidden" name="fBt" value="0" id="fBt">
			  <input type="checkbox" value="1" name="fBt" id="fBt">
			  <span class="slider round"></span>
			</label>					
			<!--FIN panel 1-->
			<hr>
			<h4><a>System Status</a></h4>
			<div class="row">
	          <div class="col">
	            <label for="apn">Active Memory</label>
	            <input type="text" class="form-control" name="ActiveMemory" id="ActiveMemory"/>
	          </div>  
	          <div class="col">
	            <label for="apn_user">Available Memory</label>
	            <input type="text" class="form-control" name="AvailableMemory" id="AvailableMemory"  />
	          </div>  
	          <div class="col">
	            <label for="apn_password">Buffer Memory</label>
	            <input type="text" class="form-control" name="BufferMemory" id="BufferMemory"  />
	          </div> 
	        </div>

	        <div class="row">
	          <div class="col">
	            <label for="apn">Cached Memory</label>
	            <input type="text" class="form-control" name="CachedMemory" id="CachedMemory"  />
	          </div>  
	          <div class="col">
	            <label for="apn_user">Free Memory"</label>
	            <input type="text" class="form-control" name="FreeMemory" id="FreeMemory"/>
	          </div>  
	          <div class="col">
	            <label for="apn_password">Inactive Memory</label>
	            <input type="text" class="form-control" name="InactiveMemory" id="InactiveMemory"/>
	          </div> 
	        </div>

	        <div class="row">
	          <div class="col">
	            <label for="apn">Total Memory</label>
	            <input type="text" class="form-control" name="TotalMemory" id="TotalMemory"/>
	          </div>  
	          <div class="col">
	            <label for="apn_user">diskfree</label>
	            <input type="text" class="form-control" name="diskfree" id="diskfree"/>
	          </div>  
	          <div class="col">
	            <label for="apn_password">diskused</label>
	            <input type="text" class="form-control" name="diskused" id="diskused"/>
	          </div> 
	        </div>

	        <div class="row">
	          <div class="col">
	          </div>  
	          <div class="col">
	            <label for="apn_user">disktotal</label>
	            <input type="text" class="form-control" name="disktotal" id="disktotal"/>
	          </div>  
	          <div class="col">
	            <label for="apn_password">Cpu Percent</label>
	            <input type="text" class="form-control" name="CpuPercent" id="CpuPercent"/>
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
<?php

/*
Archivo: index_m.php
Descripcion: Se carga la configuracion del equipo desde la pagina index.php

*/

session_start();
if (!isset($_SESSION['k_username']))
{
	header('Location: login.php');
}

// determinar cual es la funcion que se esta llamando desde ajax
$function = "";
if (isset($_POST['call']))
{
	$function = $_POST['call'];
}

if(function_exists($function)) 
{        
    call_user_func($function);
} 
else 
{
    //echo 'Funci&oacute;n no existe!';
}

	$img_dir = "img/";

	$images = scandir($img_dir);
	$html = array();

	foreach($images as $img) 	{ 
			if($img === '.' || $img === '..') {continue;} 		

				if (  (preg_match('/.jpg/',$img))  ||  (preg_match('/.gif/',$img)) || (preg_match('/.tiff/',$img)) || (preg_match('/.png/',$img)) ) {				

				 array_push($html,'<img src="'.$img_dir.$img.'" >'); 
				} else { continue; }	
		}
	echo json_encode($html);

function cargarDatos()
{	try 
	{	
	}
	catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
	}
}
?>




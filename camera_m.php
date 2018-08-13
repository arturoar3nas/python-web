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
try
{
	$img_dir = "/tmp/";

	$images = scandir($img_dir);
	$html = array();

	$files = glob('tmp/*'); // get all file names
	foreach($files as $file){ // iterate files
	  if(is_file($file))
	    unlink($file); // delete file
	}
	$thereisimg = false;
	foreach($images as $img) 	{ 
		if($img === '.' || $img === '..') {continue;} 		

			if (  (preg_match('/.jpg/',$img))  ||  (preg_match('/.gif/',$img)) || (preg_match('/.tiff/',$img)) || (preg_match('/.png/',$img)) ) {				

				 copy($img_dir.$img, 'tmp/'.$img); // dar permiso en tmp y en img y en /var/www/html/tmp 
				 //array_push($html,'<img src="'.$img_dir.$img.'" >'); //'<img src="img/'.$img.'" >'
				 array_push($html,'<img width="450" height="450" src="tmp/'.$img.'" >');
				 $thereisimg = true;
				 break; 
			} else { continue; }	
	}

	if ($thereisimg == false){
		array_push($html,'<img width="450" height="450" src="img/photo.png" >');
	}

	echo json_encode($html);	
} catch(Exception $e) {
	die(json_encode($e->getMessage()));
}

?>




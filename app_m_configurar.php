<?php

/*
Archivo: index_m_configurar.php
Descripcion: Se guarda la configuracion del equipo desde la pagina index.php

*/
//include "php/gprs-config.php";

session_start();
if (!isset($_SESSION['k_username']))
{
	header('Location: login.php');
}

// obtener las variables enviadas del formulario

guardarDatos();

function guardarDatos()
{
	$myFile = "/home/pi/servicecom/loadcellcmd.json";
    $arr_data = array(); // create empty array
	
	if(isset($_POST['btn-configurar']))
	{
		try 
		{
		   //Get data from existing json file
		   $jsondata = file_get_contents($myFile);

		   // converts json data into array
		   $arr_data = json_decode($jsondata, true);

		   $arr_data['WeightCalibration'] = $_POST['WeightCalibration'];
		   $arr_data['Cmd'] = $_POST['Cmd'];
		   
	       //Convert updated array to JSON
		   $json = json_encode($arr_data,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
		   
		   //write json data into data.json file
		   if(file_put_contents($myFile, $json)) {
		        echo 'Data successfully saved';
		    }
		   else {
		        echo "error";			
		   }			
		}
		catch (Exception $e)
		{
			echo ("Error intentando guardar datos en el archivo (".$e->getMessage().")");
		}
		
		echo ("ok");
	}	
}
?>
<?php

cargarDatos();

function cargarDatos()
{	try 
	{
		
		//include "php/gprs-config.php";
		$myFile = "/home/pi/servicecom/simstatus.json";
	    $arr_data = array(); // create empty array
	    $array = array();


	   	//Get data from existing json file
	   	$jsondata = file_get_contents($myFile);

	   	// converts json data into array
	   	$arr_data = json_decode($jsondata, true);


		$array['red'] = $arr_data['Red'];
		$array['signal'] = $arr_data['Signal'];
		$array['type'] = $arr_data['Type'];
		$array['status'] = $arr_data['Status'];
		$array['roaming'] = $arr_data['Roaming'];
		$array['imei'] = $arr_data['Imei'];	

		// se transforma el arreglo de respuesta en un json
		echo json_encode($array);
	}
	catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
	}
}
?>

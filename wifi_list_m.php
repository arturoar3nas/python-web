<?php
cargarDatos();
function cargarDatos()
{	try 
	{
		
		$command = escapeshellcmd('sudo python3 /home/pi/servicecom/scanwifi.py');
		$output = shell_exec($command); //shell_exec
		sleep(4);

		// do your processing
		$myFile = "/home/pi/servicecom/networks.json";
	    $array = array();

	   	//Get data from existing json file
	   	$jsondata = file_get_contents($myFile);

	   	// converts json data into array
	   	$array = json_decode($jsondata, true);	

		// se transforma el arreglo de respuesta en un json
		echo json_encode($array);
		// echo $jsondata;

		echo null;

	}
	catch (Exception $e) {
    echo '';
	}
}
?>

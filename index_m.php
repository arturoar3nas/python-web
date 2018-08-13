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
    echo 'Funci&oacute;n no existe!';
}

function cargarDatos()
{	try 
	{
		
		//include "php/gprs-config.php";
		$myFile = "/home/pi/servicecom/config.json";
	    $arr_data = array(); // create empty array
	    $array = array();


	   	//Get data from existing json file
	   	$jsondata = file_get_contents($myFile);

	   	// converts json data into array
	   	$arr_data = json_decode($jsondata, true);


		$array['fWifi']=  $arr_data['Flags']['Wifi'];
		$array['f3G'] = $arr_data['Flags']['3g'];
		$array['fBt'] =$arr_data['Flags']['Bluethoot'];

		$array['apn'] = $arr_data['3G']['Apn'];
		$array['apn_user'] = $arr_data['3G']['User'];
		$array['apn_password'] = $arr_data['3G']['Psw'];

		$array['wifi_ssid'] = $arr_data['Wifi']['Ssid'];
		$array['wifi_password'] = $arr_data['Wifi']['Psw'];

		$array['Aplicacion'] = $arr_data['Aplication'];
		$array['Scan_Time'] = $arr_data['ScanTime'];
		$array['fScan'] = $arr_data['StopScan'];
		$array['ID'] = $arr_data['Id'];
		$array['Key'] = $arr_data['Key'];
		$array['version'] = $arr_data['Version'];
		$array['server'] = $arr_data['Server'];
		$array['fWeight'] = $arr_data['Weight'];
		$array['Pnumber'] = $arr_data['StatusApp'];	

		// se transforma el arreglo de respuesta en un json
		echo json_encode($array);
	}
	catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
	}
}
?>

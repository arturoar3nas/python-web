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
	$myFile = "/home/pi/servicecom/config.json";
    $arr_data = array(); // create empty array
	
	if(isset($_POST['btn-configurar']))
	{
		/* Example Object Json
		{
		  "Flags": {
		  "Wifi": 1,
		  "3G": 1,
		  "Bluethoot": 1
		  },
		  "3G": {
		    "APN": "imovil.entelpcs.cl",
		    "User": "entelcps",
		    "Psw": "entelcps"
		  },
		  "Wifi": {
		    "SSID": "innovared-piso1",
		    "Psw": "222275622"
		  },
		  "Aplication": "/home/pi/servicecom/Demo.py",
		  "ScanTime": 10,
		  "StopScan": 0,
		  "ID": 1,
		  "KEY":"abcdf"
		}
		*/
		try 
		{
		   //Get data from existing json file
		   $jsondata = file_get_contents($myFile);

		   // converts json data into array
		   $arr_data = json_decode($jsondata, true);

		   $arr_data['Flags']['Wifi'] = $_POST['fWifi'];
		   $arr_data['Flags']['3G'] = $_POST['f3G'];
		   $arr_data['Flags']['Bluethoot'] = $_POST['fBt'];

		   $arr_data['3G']['APN'] = $_POST['apn'];
		   $arr_data['3G']['User'] = $_POST['apn_user'];
		   $arr_data['3G']['Psw'] = $_POST['apn_password'];

		   $arr_data['Wifi']['SSID'] = $_POST['wifi_ssid'];
		   $arr_data['Wifi']['Psw'] = $_POST['wifi_password'];

		   $arr_data['Aplication'] = $_POST['Aplicacion'];
		   $arr_data['ScanTime'] = $_POST['Scan_Time'];
		   $arr_data['StopScan'] = $_POST['fScan'];
		   $arr_data['ID'] = $_POST['ID'];
		   $arr_data['KEY'] = $_POST['Key'];

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


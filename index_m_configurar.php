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
		try 
		{
		   //Get data from existing json file
		   $jsondata = file_get_contents($myFile);

		   // converts json data into array
		   $arr_data = json_decode($jsondata, true);

		   if(strcmp (arr_data['Flags']['Wifi'],$_POST['fWifi']) != 0 && $_POST['fWifi'] != null)
		   $arr_data['Flags']['Wifi'] = $_POST['fWifi'];
		   
		   if(strcmp ($arr_data['Flags']['3G'],$_POST['f3G']) != 0 && $_POST['f3G'] != null)
		   $arr_data['Flags']['3G'] = $_POST['f3G'];

		   if(strcmp ($arr_data['Flags']['Bluethoot'], $_POST['fBt']) != 0 && $_POST['fBt'] != null)
		   $arr_data['Flags']['Bluethoot'] = $_POST['fBt'];

		   if(strcmp ($arr_data['3G']['APN'],$_POST['apn']) != 0 && $_POST['apn'] != null)
		   $arr_data['3G']['APN'] = $_POST['apn'];

		   if(strcmp ($arr_data['3G']['User'],$_POST['apn_user']) != 0 && $_POST['apn_user'] != null)
		   $arr_data['3G']['User'] = $_POST['apn_user'];

		   if(strcmp ($arr_data['3G']['Psw'] ,$_POST['apn_password']) != 0 && $_POST['apn_password'] != null)
		   $arr_data['3G']['Psw'] = $_POST['apn_password'];

		   if(strcmp ($arr_data['Wifi']['SSID'],$_POST['wifi_ssid']) != 0 && $_POST['wifi_ssid'] != null)
		   $arr_data['Wifi']['SSID'] = $_POST['wifi_ssid'];

		   if(strcmp ($arr_data['Wifi']['Psw'] ,$_POST['wifi_password']) != 0 && $_POST['wifi_password'] != null)
		   $arr_data['Wifi']['Psw'] = $_POST['wifi_password'];

		   if(strcmp ($arr_data['Aplication'],$_POST['Aplicacion']) != 0 && $_POST['Aplicacion'] != null)
		   $arr_data['Aplication'] = $_POST['Aplicacion'];

		   if(strcmp ($arr_data['ScanTime'],$_POST['Scan_Time']) != 0 && $_POST['Scan_Time'] != null)
		   $arr_data['ScanTime'] = $_POST['Scan_Time'];

		   if(strcmp ($arr_data['StopScan'],$_POST['fScan']) != 0 && $_POST['fScan'] != null)
		   $arr_data['StopScan'] = $_POST['fScan'];
		   
           if(strcmp ($arr_data['ID'],$_POST['ID']) != 0 && $_POST['ID'] != null)
		   $arr_data['ID'] = $_POST['ID'];

		   if(strcmp ($arr_data['KEY'],$_POST['Key']) != 0 && $_POST['Key'] != null)
		   $arr_data['KEY'] = $_POST['Key'];

		   if(strcmp ( $arr_data['version'] ,$_POST['version']) != 0 && $_POST['version'] != null)
		   $arr_data['version'] = $_POST['version'];

		   if(strcmp ($arr_data['server'] , $_POST['server']) != 0 && $_POST['server'] != null)
		   $arr_data['server'] = $_POST['server'];

		   if(strcmp ($arr_data['weight'] ,$_POST['fWeight']) != 0 && $_POST['fWeight'] != null)
		   $arr_data['weight'] = $_POST['fWeight'];	

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


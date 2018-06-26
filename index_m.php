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
{
	global $apn,$apn_user,$apn_password, $apn2,$apn2_user,$apn2_password;
	$estado_conexion = "2";
	$rssi = "";
	
	include "php/gprs-config.php";
	$configFile = "/innovared/config/backup.bin";  

	if(!$fd = fopen($configFile, 'r'))
	{
		echo "No se puede abrir el archivo de configuraci&oacute;n: ($configFile)";
		exit;
	}
	// cargar data del archivo de configuracion
	// en el arreglo respuesta
	// el nombre de la variable debe ser el mismo que el del componente en el formulario
	$respuesta = array();

	$data = fread($fd, 1);
	$temp = unpack("C", $data);
	$file_mark = $temp[1];

	$data = fread($fd, 2);
	$temp = unpack("v", $data);
	$id_equipo = $temp[1];
	if(file_exists("/innovared/config/id_equipo.txt")) 
	{
		$id_equipo = file_get_contents("/innovared/config/id_equipo.txt"); //MVD FEB 2017
	}

	$data = fread($fd, 32);
	$temp = unpack("a32", $data);
	$ip_host = $temp[1];

	$data = fread($fd, 32);
	$temp = unpack("a32", $data);
	$ip_ping = $temp[1];

	$data = fread($fd, 2);
	$temp = unpack("v", $data);
	$port_host = $temp[1];
	
	$data = fread($fd, 2); //uint16_t puerto
	$temp = unpack("S", $data);
	$DNP3puerto = $temp[1];
	
	$data = fread($fd, 2); //uint16_t direccionMaster
	$temp = unpack("S", $data);
	$DNP3direccionMaster = $temp[1];
	
	$data = fread($fd, 2); //uint16_t direccionLocal;
	$temp = unpack("S", $data);
	$DNP3direccionLocal = $temp[1];
		
	$data = fread($fd, 1); //bool msgsNoSolitadosHabilitados
	$temp = unpack("C", $data);
	$DNP3msgsNoSolitadosHabilitados = $temp[1];
			
	$data = fread($fd, 2);
	$temp = unpack("v", $data);
	$cuentaFalla = $temp[1];
		
	$data = fread($fd, 2);
	$temp = unpack("v", $data);
	$cuentaFallaA = $temp[1];
		
	$data = fread($fd, 2);
	$temp = unpack("v", $data);
	$cuentaFallaB = $temp[1];
	
	$data = fread($fd, 2);
	$temp = unpack("v", $data);
	$cuentaFallaC = $temp[1];
	
	$data = fread($fd, 2);
	$temp = unpack("v", $data);
	$cuentaFallaTierra = $temp[1];
	
	$data = fread($fd, 2);
	$temp = unpack("v", $data);
	$cuentaFallaMonofasica = $temp[1];
	
	$data = fread($fd, 2);
	$temp = unpack("v", $data);
	$cuentaFallaBifasica = $temp[1];
	
	$data = fread($fd, 2);
	$temp = unpack("v", $data);
	$cuentaFallaTrifasica = $temp[1];
	
	$data = fread($fd, 6);
	$temp = unpack("a6", $data);
	$horaFalla = $temp[1];
	
	$data = fread($fd, 6);
	$temp = unpack("a6", $data);
	$horaFallaA = $temp[1];
	
	$data = fread($fd, 6);
	$temp = unpack("a6", $data);
	$horaFallaB = $temp[1];
	
	$data = fread($fd, 6);
	$temp = unpack("a6", $data);
	$horaFallaC = $temp[1];

	$data = fread($fd, 6);
	$temp = unpack("a6", $data);
	$horaFallaTierra = $temp[1];

	$data = fread($fd, 6);
	$temp = unpack("a6", $data);
	$horaFallaMonofasica = $temp[1];

	$data = fread($fd, 6);
	$temp = unpack("a6", $data);
	$horaFallaBifasica = $temp[1];

	$data = fread($fd, 6);
	$temp = unpack("a6", $data);
	$horaFallaTrifasica = $temp[1];

	$data = fread($fd, 6);
	$temp = unpack("a6", $data);
	$horaNormalizacion = $temp[1];

	$data = fread($fd, 71);
	$temp = unpack("a71", $data);
	$SMSAviso = $temp[1];

	$data = fread($fd, 1); //setCmd_t setCmd
	$temp = unpack("C", $data);
	$setCmd = $temp[1];

	//IfEMG::Config_t
	$data = fread($fd, 1); //uint8_t permanentRxMode;   hard_registers_t IfEMG::Config_t
	$temp = unpack("C", $data);
	$IfEMG_Config_permanentRxMode = $temp[1];

	$data = fread($fd, 2); //uint16_t relayTime;   hard_registers_t IfEMG::Config_t
	$temp = unpack("S", $data);
	$IfEMG_Config_relayTime = $temp[1];
	
	$data = fread($fd, 1); //uint8_t relayActivation;   hard_registers_t IfEMG::Config_t
	$temp = unpack("C", $data);
	$IfEMG_Config_relayActivation = $temp[1];
	
	$data = fread($fd, 2); //uint16_t storageMode;	    hard_registers_t IfEMG::Config_t
	$temp = unpack("v", $data);
	$IfEMG_Config_storageMode = $temp[1];
	
	$data = fread($fd, 2); //uint16_t faulCurrentOC;	hard_registers_t IfEMG::Config_t		
	$temp = unpack("S", $data);
	$IfEMG_Config_faulCurrentOC = $temp[1];
	
	$data = fread($fd, 2); //uint16_t faulCurrentEF;	hard_registers_t IfEMG::Config_t		
	$temp = unpack("S", $data);
	$IfEMG_Config_faulCurrentEF = $temp[1];
	
	$data = fread($fd, 1); //uint8_t id;                hard_registers_t IfEMG::Config_t FLA_config_t
	$temp = unpack("C", $data);
	$IfEMG_Config_FLA1_id = $temp[1];
	if(file_exists("/innovared/config/ID_IF_A.txt")) 
	{
		$IfEMG_Config_FLA1_id = (int)file_get_contents("/innovared/config/ID_IF_A.txt"); //MVD FEB 2017
	}

	$data = fread($fd, 1); //bool enabled;              hard_registers_t IfEMG::Config_t FLA_config_t
	$temp = unpack("C", $data);
	$IfEMG_Config_FLA1_enabled = $temp[1];
	if(file_exists("/innovared/config/IF_A_ENABLED.txt")) 
	{
		$IfEMG_Config_FLA1_enabled = (int)file_get_contents("/innovared/config/IF_A_ENABLED.txt"); //MVD FEB 2017
	}

	$data = fread($fd, 1); //uint8_t id;                hard_registers_t IfEMG::Config_t FLA_config_t
	$temp = unpack("C", $data);
	$IfEMG_Config_FLA2_id = $temp[1];
	if(file_exists("/innovared/config/ID_IF_B.txt")) 
	{
		$IfEMG_Config_FLA2_id = (int)file_get_contents("/innovared/config/ID_IF_B.txt"); //MVD FEB 2017
	}

	$data = fread($fd, 1); //bool enabled;              hard_registers_t IfEMG::Config_t FLA_config_t
	$temp = unpack("C", $data);
	$IfEMG_Config_FLA2_enabled = $temp[1];
	if(file_exists("/innovared/config/IF_B_ENABLED.txt")) 
	{
		$IfEMG_Config_FLA2_enabled = (int)file_get_contents("/innovared/config/IF_B_ENABLED.txt"); //MVD FEB 2017
	}

	$data = fread($fd, 1); //uint8_t id;                hard_registers_t IfEMG::Config_t FLA_config_t
	$temp = unpack("C", $data);
	$IfEMG_Config_FLA3_id = $temp[1];
	if(file_exists("/innovared/config/ID_IF_C.txt")) 
	{
		$IfEMG_Config_FLA3_id = (int)file_get_contents("/innovared/config/ID_IF_C.txt"); //MVD FEB 2017
	}

	$data = fread($fd, 1); //bool enabled;              hard_registers_t IfEMG::Config_t FLA_config_t
	$temp = unpack("C", $data);
	$IfEMG_Config_FLA3_enabled = $temp[1];
	if(file_exists("/innovared/config/IF_C_ENABLED.txt")) 
	{
		$IfEMG_Config_FLA3_enabled = (int)file_get_contents("/innovared/config/IF_C_ENABLED.txt"); //MVD FEB 2017
	}

	$data = fread($fd, 2); //uint16_t datalogging;	    hard_registers_t IfEMG::Config_t FLA_CommonConfig_t						
	$temp = unpack("S", $data);
	$IfEMG_CommonConfig_datalogging = $temp[1];

	$data = fread($fd, 1); //uint8_t	shortMsg;       hard_registers_t IfEMG::Config_t FLA_CommonConfig_t			
	$temp = unpack("C", $data);
	$IfEMG_CommonConfig_shortMsg = $temp[1];

	$data = fread($fd, 2); //uint16_t tripCurrentOC;    hard_registers_t IfEMG::Config_t FLA_CommonConfig_t	
	$temp = unpack("S", $data);
	$IfEMG_CommonConfig_tripCurrentOC = $temp[1];

	$data = fread($fd, 2); //uint16_t respTimeOC;	    hard_registers_t IfEMG::Config_t FLA_CommonConfig_t	
	$temp = unpack("S", $data);
	$IfEMG_CommonConfig_respTimeOC = $temp[1];

	$data = fread($fd, 2); //uint16_t tripCurrentEF;	hard_registers_t IfEMG::Config_t FLA_CommonConfig_t				
	$temp = unpack("S", $data);
	$IfEMG_CommonConfig_tripCurrentEF = $temp[1];

	$data = fread($fd, 1); //uint8_t	autTripCurrentOCStatus; hard_registers_t IfEMG::Config_t FLA_CommonConfig_t	
	$temp = unpack("C", $data);
	$IfEMG_CommonConfig_autTripCurrentOCStatus = $temp[1];
	 
	$data = fread($fd, 2); //uint16_t autTripCurrentOC;		hard_registers_t IfEMG::Config_t FLA_CommonConfig_t			
	$temp = unpack("S", $data);
	$IfEMG_CommonConfig_autTripCurrentOC = $temp[1];
		
	$data = fread($fd, 2); //uint16_t resetTime;				hard_registers_t IfEMG::Config_t FLA_CommonConfig_t	
	$temp = unpack("S", $data);
	$IfEMG_CommonConfig_resetTime = $temp[1];

	$data = fread($fd, 1); //uint8_t	resetRemoteIndicator;   hard_registers_t IfEMG::Config_t FLA_CommonConfig_t	
	$temp = unpack("C", $data);
	$IfEMG_CommonConfig_resetRemoteIndicator = $temp[1];

	$data = fread($fd, 1); //uint8_t	resetAfterRecovery;     hard_registers_t IfEMG::Config_t FLA_CommonConfig_t	
	$temp = unpack("C", $data);
	$IfEMG_CommonConfig_resetAfterRecovery = $temp[1];

	$data = fread($fd, 1); //uint8_t	transientDetection;     hard_registers_t IfEMG::Config_t FLA_CommonConfig_t	
	$temp = unpack("C", $data);
	$IfEMG_CommonConfig_transientDetection = $temp[1];

	$data = fread($fd, 1); //uint8_t	recloserSetting;        hard_registers_t IfEMG::Config_t FLA_CommonConfig_t	
	$temp = unpack("C", $data);
	$IfEMG_CommonConfig_recloserSetting = $temp[1];

	$data = fread($fd, 1); //uint8_t	reclosingTime;          hard_registers_t IfEMG::Config_t FLA_CommonConfig_t	
	$temp = unpack("C", $data);
	$IfEMG_CommonConfig_reclosingTime = $temp[1];

	$data = fread($fd, 1); //uint8_t	temporaryFaultIndication;   hard_registers_t IfEMG::Config_t FLA_CommonConfig_t	
	$temp = unpack("C", $data);
	$IfEMG_CommonConfig_temporaryFaultIndication = $temp[1];

	$data = fread($fd, 1); //uint8_t	networkFrecuencySetting;    hard_registers_t IfEMG::Config_t FLA_CommonConfig_t	
	$temp = unpack("C", $data);
	$IfEMG_CommonConfig_networkFrecuencySetting = $temp[1];

	$data = fread($fd, 1); //uint8_t	currentIndication;          hard_registers_t IfEMG::Config_t FLA_CommonConfig_t	
	$temp = unpack("C", $data);
	$IfEMG_CommonConfig_currentIndication = $temp[1];

	$data = fread($fd, 1); //uint8_t	voltageIndication;          hard_registers_t IfEMG::Config_t FLA_CommonConfig_t	
	$temp = unpack("C", $data);
	$IfEMG_CommonConfig_voltageIndication = $temp[1];

	$data = fread($fd, 1); //bool dualSimHabilitada;
	$temp = unpack("C", $data);
	$dualSimHabilitada = $temp[1];

	$simSecundariaHabilitada = "0";
	if(file_exists("/innovared/config/SimBEnabled.txt")) 
	{
		$simSecundariaHabilitada = ((int)file_get_contents("/innovared/config/SimBEnabled.txt")); //JMF// $temp[1];
	}

	$tiempoMaxFallaSimPrimaria = 0;
	if(file_exists("/innovared/config/MaxRetry.txt")) 
	{
		$tiempoMaxFallaSimPrimaria = (int)file_get_contents("/innovared/config/MaxRetry.txt"); //JMF// $temp[1];
	}

	$tiempoRetornoSimPrimaria = 0;
	if(file_exists("/innovared/config/MaxSimB.txt")) 
	{
		$tiempoRetornoSimPrimaria = (int)file_get_contents("/innovared/config/MaxSimB.txt"); //JMF// $temp[1];
	}
	
	$inetTestFile = "0";
	if(file_exists("/innovared/config/inet_test.txt")) 
	{
		$inetTestFile = (int)file_get_contents("/innovared/config/inet_test.txt"); //MVD DIC 2016
	}

	$ip_ping2 = "";
	if(file_exists("/innovared/config/TestSite2.txt")) 
	{
		$ip_ping2 = file_get_contents("/innovared/config/TestSite2.txt"); //MVD DIC 2016
	}

	$inetTestFile2 = "0";
	if(file_exists("/innovared/config/inet_test2.txt")) 
	{
		$inetTestFile2 = (int)file_get_contents("/innovared/config/inet_test2.txt"); //MVD DIC 2016
	}

	if(file_exists("/run/estadoConexion.txt")) { 
		$estado_conexion = trim(file_get_contents("/run/estadoConexion.txt"));
	}

	$tmprssi = "";
	if(file_exists("/run/user/rssi.txt")) {
		$tmprssi = (string)file_get_contents("/run/user/rssi.txt");
		$rssi = preg_replace("/[^0-9?! , ]/","",$tmprssi);
	}

	fclose($fd);

	$respuesta["estado_conexion"] = $estado_conexion;
	$respuesta["id_equipo"] = $id_equipo;
	$respuesta["ip_host"] = $ip_host;
	$respuesta["port_host"] = $port_host;
	$respuesta["DNP3puerto"] = $DNP3puerto;
	$respuesta["DNP3direccionMaster"] = $DNP3direccionMaster;
	$respuesta["DNP3direccionLocal"] = $DNP3direccionLocal;
	$respuesta["DNP3msgsNoSolitadosHabilitados"] = $DNP3msgsNoSolitadosHabilitados;
	$respuesta["IfEMG_Config_relayTime"] = $IfEMG_Config_relayTime;
	$respuesta["IfEMG_Config_relayActivation"] = $IfEMG_Config_relayActivation-1; // se guarda valor -1 por que la web despliega por el indice que parte desde 0
	$respuesta["IfEMG_Config_storageMode"] = $IfEMG_Config_storageMode;
	$respuesta["IfEMG_Config_FLA1_id"] = $IfEMG_Config_FLA1_id;
	$respuesta["IfEMG_Config_FLA1_enabled"] = $IfEMG_Config_FLA1_enabled;
	$respuesta["IfEMG_Config_FLA2_id"] = $IfEMG_Config_FLA2_id;
	$respuesta["IfEMG_Config_FLA2_enabled"] = $IfEMG_Config_FLA2_enabled;
	$respuesta["IfEMG_Config_FLA3_id"] = $IfEMG_Config_FLA3_id;
	$respuesta["IfEMG_Config_FLA3_enabled"] = $IfEMG_Config_FLA3_enabled;
	$respuesta["IfEMG_CommonConfig_datalogging"] = $IfEMG_CommonConfig_datalogging;
	$respuesta["IfEMG_CommonConfig_shortMsg"] = $IfEMG_CommonConfig_shortMsg;
	$respuesta["IfEMG_CommonConfig_tripCurrentOC"] = $IfEMG_CommonConfig_tripCurrentOC;
	$respuesta["IfEMG_CommonConfig_tripCurrentEF"] = $IfEMG_CommonConfig_tripCurrentEF;
	$respuesta["IfEMG_CommonConfig_respTimeOC"] = $IfEMG_CommonConfig_respTimeOC;
	$respuesta["IfEMG_CommonConfig_autTripCurrentOCStatus"] = $IfEMG_CommonConfig_autTripCurrentOCStatus; 
	$respuesta["IfEMG_CommonConfig_autTripCurrentOC"] = $IfEMG_CommonConfig_autTripCurrentOC; 
	$respuesta["IfEMG_CommonConfig_resetTime"] = $IfEMG_CommonConfig_resetTime; 
	$respuesta["IfEMG_CommonConfig_resetRemoteIndicator"] = $IfEMG_CommonConfig_resetRemoteIndicator; 
	$respuesta["IfEMG_CommonConfig_resetAfterRecovery"] = $IfEMG_CommonConfig_resetAfterRecovery;
	$respuesta["IfEMG_CommonConfig_networkFrecuencySetting"] = $IfEMG_CommonConfig_networkFrecuencySetting;
	$respuesta["IfEMG_CommonConfig_currentIndication"] = $IfEMG_CommonConfig_currentIndication;
	$respuesta["IfEMG_CommonConfig_voltageIndication"] = $IfEMG_CommonConfig_voltageIndication;
	$respuesta["rssi"] = $rssi;

	// se transforma el arreglo de respuesta en un json
	echo json_encode($respuesta);
}
?>

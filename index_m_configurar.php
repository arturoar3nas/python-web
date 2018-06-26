<?php

/*
Archivo: index_m_configurar.php
Descripcion: Se guarda la configuracion del equipo desde la pagina index.php

*/
include "php/gprs-config.php";

session_start();
if (!isset($_SESSION['k_username']))
{
	header('Location: login.php');
}

// obtener las variables enviadas del formulario

guardarDatos();

function guardarDatos()
{
	$configFile = "/innovared/config/backup.bin";
	
	if(isset($_POST['btn-configurar']))
	{
		// seccion para leer las variables del archivo 
		if(!$fd = fopen($configFile, 'r'))
		{
			echo "No se puede abrir el archivo: ($configFile)";
			exit;
		}

		$data = fread($fd, 1);   
		$temp = unpack("C", $data);
		$file_mark = $temp[1];

		$data = fread($fd, 2); //Identificador de RTU
		$temp = unpack("S", $data);
		$id_equipo = $temp[1];
		if(file_exists("/innovared/config/id_equipo.txt")) 
		{
			$id_equipo = file_get_contents("/innovared/config/id_equipo.txt"); //MVD FEB 2017
		}

		$data = fread($fd, 32);	//char direccionServidor[32];               hard_registers_t ServerConfig_t
		$temp = unpack("a32", $data);
		$ip_host = $temp[1];

		$data = fread($fd, 32);	//char direccionPing[3];               hard_registers_t ServerConfig_t
		$temp = unpack("a32", $data);
		$ip_ping = $temp[1];

		$data = fread($fd, 2);  //uint16_t puerto;                  hard_registers_t ServerConfig_t
		$temp = unpack("S", $data);
		$port_host = $temp[1];

		$data = fread($fd, 2);  //uint16_t puerto;                  hard_registers_t DNP3Config_t
		$temp = unpack("S", $data);
		$DNP3puerto = $temp[1];

		$data = fread($fd, 2);  //uint16_t direccionMaster          hard_registers_t DNP3Config_t
		$temp = unpack("S", $data);
		$DNP3direccionMaster = $temp[1];

		$data = fread($fd, 2); //uint16_t direccionLocal;          hard_registers_t DNP3Config_t
		$temp = unpack("S", $data);
		$DNP3direccionLocal = $temp[1];

		$data = fread($fd, 1); //bool msgsNoSolitadosHabilitados    hard_registers_t DNP3Config_t
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

		$data = fread($fd, 1); //setCmd_t setCmd;   
		$temp = unpack("C", $data);
		$setCmd = $temp[1];

		$data = fread($fd, 1); //uint8_t permanentRxMode;   hard_registers_t IfEMG::Config_t
		$temp = unpack("C", $data);
		$IfEMG_Config_permanentRxMode = $temp[1];
		
		$data = fread($fd, 2); //uint8_t relayTime;   hard_registers_t IfEMG::Config_t
		$temp = unpack("S", $data);
		$IfEMG_Config_relayTime = $temp[1];
	
		$data = fread($fd, 1); //uint8_t relayActivation;   hard_registers_t IfEMG::Config_t
		$temp = unpack("C", $data);
		$IfEMG_Config_relayActivation = $temp[1];
	
		$data = fread($fd, 2); //uint16_t storageMode;	    hard_registers_t IfEMG::Config_t
		$temp = unpack("S", $data);
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
			$IfEMG_Config_FLA1_id = file_get_contents("/innovared/config/ID_IF_A.txt"); //MVD FEB 2017
		}

		$data = fread($fd, 1); //bool enabled;              hard_registers_t IfEMG::Config_t FLA_config_t
		$temp = unpack("C", $data);
		$IfEMG_Config_FLA1_enabled = $temp[1];
		if(file_exists("/innovared/config/IF_A_ENABLED.txt")) 
		{
			$IfEMG_Config_FLA1_enabled = file_get_contents("/innovared/config/IF_A_ENABLED.txt"); //MVD FEB 2017
		}

		$data = fread($fd, 1); //uint8_t id;                hard_registers_t IfEMG::Config_t FLA_config_t
		$temp = unpack("C", $data);
		$IfEMG_Config_FLA2_id = $temp[1];
		if(file_exists("/innovared/config/ID_IF_B.txt")) 
		{
			$IfEMG_Config_FLA2_id = file_get_contents("/innovared/config/ID_IF_B.txt"); //MVD FEB 2017
		}

		$data = fread($fd, 1); //bool enabled;              hard_registers_t IfEMG::Config_t FLA_config_t
		$temp = unpack("C", $data);
		$IfEMG_Config_FLA2_enabled = $temp[1];
		if(file_exists("/innovared/config/IF_B_ENABLED.txt")) 
		{
			$IfEMG_Config_FLA2_enabled = file_get_contents("/innovared/config/IF_B_ENABLED.txt"); //MVD FEB 2017
		}

		$data = fread($fd, 1); //uint8_t id;                hard_registers_t IfEMG::Config_t FLA_config_t
		$temp = unpack("C", $data);
		$IfEMG_Config_FLA3_id = $temp[1];
		if(file_exists("/innovared/config/ID_IF_C.txt")) 
		{
			$IfEMG_Config_FLA3_id = file_get_contents("/innovared/config/ID_IF_C.txt"); //MVD FEB 2017
		}

		$data = fread($fd, 1); //bool enabled;              hard_registers_t IfEMG::Config_t FLA_config_t
		$temp = unpack("C", $data);
		$IfEMG_Config_FLA3_enabled = $temp[1];
		if(file_exists("/innovared/config/IF_C_ENABLED.txt")) 
		{
			$IfEMG_Config_FLA3_enabled = file_get_contents("/innovared/config/IF_C_ENABLED.txt"); //MVD FEB 2017
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

		$data = fread($fd, 1); //bool simSecundariaHabilitada;
		$temp = unpack("C", $data);
		$simSecundariaHabilitada = $temp[1];

		$data = fread($fd, 2); //uint16_t tiempoMaxFallaSimPrimaria;	//En segundos
		$temp = unpack("S", $data);
		$tiempoMaxFallaSimPrimaria = $temp[1];

		$data = fread($fd, 1); //uint8_t tiempoRetornoSimPrimaria;	//En minutos
		$temp = unpack("C", $data);
		$tiempoRetornoSimPrimaria = $temp[1];

		fclose($fd);	
		// - fin lectura de archivo

		// setear los valores de las variables que vienen del formulario

		$id_equipo = trim($_POST['id_equipo']);
		file_put_contents("/innovared/config/id_equipo.txt", $id_equipo); //MVD FEB 2017
		$ip_host = trim($_POST['ip_host']);
		$port_host = trim($_POST['port_host']);	
		$DNP3puerto = $_POST['DNP3puerto'];
		$DNP3direccionMaster = $_POST['DNP3direccionMaster'];
		$DNP3direccionLocal = $_POST['DNP3direccionLocal'];
			
		$IfEMG_CommonConfig_tripCurrentOC = trim($_POST['IfEMG_CommonConfig_tripCurrentOC']);
		$IfEMG_CommonConfig_tripCurrentEF = trim($_POST['IfEMG_CommonConfig_tripCurrentEF']);
		$IfEMG_CommonConfig_respTimeOC = trim($_POST['IfEMG_CommonConfig_respTimeOC']);
		$IfEMG_CommonConfig_datalogging = trim($_POST['IfEMG_CommonConfig_datalogging']);
		$IfEMG_CommonConfig_shortMsg = trim($_POST['IfEMG_CommonConfig_shortMsg']);
		$IfEMG_CommonConfig_autTripCurrentOCStatus = trim($_POST['IfEMG_CommonConfig_autTripCurrentOCStatus']);
		$IfEMG_CommonConfig_autTripCurrentOC = trim($_POST['IfEMG_CommonConfig_autTripCurrentOC']);		
		$IfEMG_CommonConfig_resetTime = trim($_POST['IfEMG_CommonConfig_resetTime']);		
		$IfEMG_CommonConfig_resetAfterRecovery = trim($_POST['IfEMG_CommonConfig_resetAfterRecovery']);
		$IfEMG_CommonConfig_resetRemoteIndicator = trim($_POST['IfEMG_CommonConfig_resetRemoteIndicator']);
		$IfEMG_CommonConfig_networkFrecuencySetting = trim($_POST['IfEMG_CommonConfig_networkFrecuencySetting']);
		$IfEMG_CommonConfig_currentIndication = trim($_POST['IfEMG_CommonConfig_currentIndication']);
		$IfEMG_CommonConfig_voltageIndication = trim($_POST['IfEMG_CommonConfig_voltageIndication']);
		
		$IfEMG_Config_relayTime = trim($_POST['IfEMG_Config_relayTime']);
		$IfEMG_Config_relayActivation = trim($_POST['IfEMG_Config_relayActivation']);
		$IfEMG_Config_storageMode = trim($_POST['IfEMG_Config_storageMode']);
		$IfEMG_Config_FLA1_id = trim($_POST['IfEMG_Config_FLA1_id']);
		file_put_contents("/innovared/config/ID_IF_A.txt", $IfEMG_Config_FLA1_id); //MVD FEB 2017
		$IfEMG_Config_FLA1_enabled = trim($_POST['IfEMG_Config_FLA1_enabled']);
		file_put_contents("/innovared/config/IF_A_ENABLED.txt", $IfEMG_Config_FLA1_enabled); //MVD FEB 2017
		$IfEMG_Config_FLA2_id = trim($_POST['IfEMG_Config_FLA2_id']);
		file_put_contents("/innovared/config/ID_IF_B.txt", $IfEMG_Config_FLA2_id); //MVD FEB 2017
		$IfEMG_Config_FLA2_enabled = trim($_POST['IfEMG_Config_FLA2_enabled']);
		file_put_contents("/innovared/config/IF_B_ENABLED.txt", $IfEMG_Config_FLA2_enabled); //MVD FEB 2017
		$IfEMG_Config_FLA3_id = trim($_POST['IfEMG_Config_FLA3_id']);
		file_put_contents("/innovared/config/ID_IF_C.txt", $IfEMG_Config_FLA3_id); //MVD FEB 2017
		$IfEMG_Config_FLA3_enabled = trim($_POST['IfEMG_Config_FLA3_enabled']);	
		file_put_contents("/innovared/config/IF_C_ENABLED.txt", $IfEMG_Config_FLA3_enabled); //MVD FEB 2017
		
		// - fin de seteo de variables que vienen del formulario
		
		// preparar variables para guardar en archivo 		
		$temp1 = pack("C",$file_mark);
		$temp2 = pack("v",$id_equipo);
		$temp3 = pack("a32",$ip_host);
		$temp3b = pack("a32",$ip_ping);
		$temp4 = pack("v",$port_host);

		$temp5 = pack("v",$DNP3puerto);
		$temp6 = pack("v",$DNP3direccionMaster);
		$temp7 = pack("v",$DNP3direccionLocal);
		$temp8 = pack("C",$DNP3msgsNoSolitadosHabilitados);

		$temp9 = pack("v",$cuentaFalla);
		$temp10 = pack("v",$cuentaFallaA);
		$temp11 = pack("v",$cuentaFallaB);
		$temp12 = pack("v",$cuentaFallaC);
		$temp13 = pack("v",$cuentaFallaTierra);
		$temp14 = pack("v",$cuentaFallaMonofasica);
		$temp15 = pack("v",$cuentaFallaBifasica);
		$temp16 = pack("v",$cuentaFallaTrifasica);

		$temp17 = pack("a6",$horaFalla);
		$temp18 = pack("a6",$horaFallaA);
		$temp19 = pack("a6",$horaFallaB);
		$temp20 = pack("a6",$horaFallaC);
		$temp21 = pack("a6",$horaFallaTierra);
		$temp22 = pack("a6",$horaFallaMonofasica);
		$temp23 = pack("a6",$horaFallaBifasica);
		$temp24 = pack("a6",$horaFallaTrifasica);
		$temp25 = pack("a6",$horaNormalizacion);

		$temp26 = pack("a71",$SMSAviso);
		$temp27 = pack("C",$setCmd);

		$temp28 = pack("C",$IfEMG_Config_permanentRxMode);
		$temp28a = pack("S",$IfEMG_Config_relayTime);
		$temp28b = pack("C",$IfEMG_Config_relayActivation);
		$temp28c = pack("v",$IfEMG_Config_storageMode);
		$temp28d = pack("S",$IfEMG_Config_faulCurrentOC);
		$temp28e = pack("S",$IfEMG_Config_faulCurrentEF);

		$temp29 = pack("C",$IfEMG_Config_FLA1_id);
		$temp30 = pack("C",$IfEMG_Config_FLA1_enabled);
		$temp32 = pack("C",$IfEMG_Config_FLA2_id);
		$temp33 = pack("C",$IfEMG_Config_FLA2_enabled);
		$temp35 = pack("C",$IfEMG_Config_FLA3_id);
		$temp36 = pack("C",$IfEMG_Config_FLA3_enabled);
		$temp39 = pack("v",$IfEMG_CommonConfig_datalogging);
		$temp40 = pack("C",$IfEMG_CommonConfig_shortMsg);
		$temp41 = pack("v",$IfEMG_CommonConfig_tripCurrentOC);
		$temp42 = pack("v",$IfEMG_CommonConfig_respTimeOC);
		$temp43 = pack("v",$IfEMG_CommonConfig_tripCurrentEF);

		$temp44 = pack("C",$IfEMG_CommonConfig_autTripCurrentOCStatus);
		$temp45 = pack("v",$IfEMG_CommonConfig_autTripCurrentOC);
		$temp46 = pack("v",$IfEMG_CommonConfig_resetTime);
		$temp47 = pack("C",$IfEMG_CommonConfig_resetRemoteIndicator);
		$temp48 = pack("C",$IfEMG_CommonConfig_resetAfterRecovery);
		$temp49 = pack("C",$IfEMG_CommonConfig_transientDetection);
		$temp50 = pack("C",$IfEMG_CommonConfig_recloserSetting);
		$temp51 = pack("C",$IfEMG_CommonConfig_reclosingTime);
		$temp52 = pack("C",$IfEMG_CommonConfig_temporaryFaultIndication);
		$temp53 = pack("C",$IfEMG_CommonConfig_networkFrecuencySetting);
		$temp54 = pack("C",$IfEMG_CommonConfig_currentIndication);
		$temp55 = pack("C",$IfEMG_CommonConfig_voltageIndication);
		$temp56 = pack("C",$dualSimHabilitada);
		$temp57 = pack("C",$simSecundariaHabilitada);
		$temp58 = pack("v",$tiempoMaxFallaSimPrimaria);
		$temp59 = pack("C",$tiempoRetornoSimPrimaria); 
		// - fin prepara variables 
		
		// guardar variables en archivo
		if(!$fp = fopen($configFile, 'w'))
		{
			echo "No se puede abrir el archivo: ($configFile)";
			exit;
		}
		try 
		{
			fwrite($fp,$temp1);     //MARK
			fwrite($fp,$temp2);     //uint16_t Id
			fwrite($fp,$temp3);     //char server_ip[64]
			fwrite($fp,$temp3b);
			fwrite($fp,$temp4);     //uint16_t server_port
			fwrite($fp,$temp5);     //uint16_t puerto
			fwrite($fp,$temp6);     //uint16_t direccionMaster
			fwrite($fp,$temp7);     //uint16_t direccionLocal
			fwrite($fp,$temp8);     //bool msgsNoSolitadosHabilitados
			fwrite($fp,$temp9);     //uint16_t cuentaFalla
			fwrite($fp,$temp10);    //uint16_t cuentaFallaA
			fwrite($fp,$temp11);    //uint16_t cuentaFallaB
			fwrite($fp,$temp12);    //uint16_t cuentaFallaC
			fwrite($fp,$temp13);    //uint16_t cuentaFallaTierra  
			fwrite($fp,$temp14);    //uint16_t cuentaFallaMonofasica
			fwrite($fp,$temp15);    //uint16_t cuentaFallaBifasica
			fwrite($fp,$temp16);    //uint16_t cuentaFallaTrifasica   
			fwrite($fp,$temp17);    //Datetime_t horaFalla
			fwrite($fp,$temp18);    //Datetime_t horaFallaA
			fwrite($fp,$temp19);    //Datetime_t horaFallaB
			fwrite($fp,$temp20);    //Datetime_t horaFallaC
			fwrite($fp,$temp21);    //Datetime_t horaFallaMonofasica
			fwrite($fp,$temp22);    //Datetime_t horaFallaBifasica
			fwrite($fp,$temp23);    //Datetime_t horaFallaTrifasica
			fwrite($fp,$temp24);    //Datetime_t horaFallaEF
			fwrite($fp,$temp25);    //Datetime_t horaNormalizacion
			fwrite($fp,$temp26);    //SMSAviso_t SMSAviso
			fwrite($fp,$temp27);	//setCmd_t setCmd
			fwrite($fp,$temp28);
			fwrite($fp,$temp28a);
			fwrite($fp,$temp28b);
			fwrite($fp,$temp28c);
			fwrite($fp,$temp28d);
			fwrite($fp,$temp28e);
			fwrite($fp,$temp29);
			fwrite($fp,$temp30);
			fwrite($fp,$temp32);
			fwrite($fp,$temp33);
			fwrite($fp,$temp35);
			fwrite($fp,$temp36);
			fwrite($fp,$temp39);
			fwrite($fp,$temp40);
			fwrite($fp,$temp41);
			fwrite($fp,$temp42);
			fwrite($fp,$temp43);
			fwrite($fp,$temp44);
			fwrite($fp,$temp45);
			fwrite($fp,$temp46);
			fwrite($fp,$temp47);
			fwrite($fp,$temp48);
			fwrite($fp,$temp49);
			fwrite($fp,$temp50);
			fwrite($fp,$temp51);
			fwrite($fp,$temp52);
			fwrite($fp,$temp53);
			fwrite($fp,$temp54);
			fwrite($fp,$temp55);
			fwrite($fp,$temp56);
			fwrite($fp,$temp57);
			fwrite($fp,$temp58);
			fwrite($fp,$temp59);
			fclose($fp);
			// - fin guardar variables en archivo			
		}
		catch (Exception $e)
		{
			echo ("Error intentando guardar datos en el archivo (".$e->getMessage().")");
		}
		
		echo ("ok");
	}	
}
?>


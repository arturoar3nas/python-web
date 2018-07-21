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
{       try 
        {
                
                //include "php/gprs-config.php";
                $myFile = "/home/pi/servicecom/sysinfo.json";
                $arr_data = array(); // create empty array
                $array = array();


                //Get data from existing json file
                $jsondata = file_get_contents($myFile);

                // converts json data into array
                $arr_data = json_decode($jsondata, true);  

                // se transforma el arreglo de respuesta en un json
                echo json_encode($arr_data);
        }
        catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
}
?>

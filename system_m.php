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

                $arr_data["ActiveMemory"] = convertToReadableSize($arr_data['ActiveMemory']);
                $arr_data["AvailableMemory"] = convertToReadableSize($arr_data['AvailableMemory']);
                $arr_data["BufferMemory"] = convertToReadableSize($arr_data['BufferMemory']);
                $arr_data["CachedMemory"] = convertToReadableSize($arr_data['CachedMemory']);
                $arr_data["FreeMemory"] = convertToReadableSize($arr_data['FreeMemory']);
                $arr_data["InactiveMemory"] = convertToReadableSize($arr_data['InactiveMemory']);
                $arr_data["TotalMemory"] = convertToReadableSize($arr_data['TotalMemory']);
                $arr_data['diskfree'] = convertToReadableSize($arr_data['diskfree']);
                $arr_data['diskused'] = convertToReadableSize($arr_data['diskused']);
                $arr_data['disktotal'] = convertToReadableSize($arr_data['disktotal']);
                $arr_data['CpuPercent'] = convertToReadableSize($arr_data['CpuPercent']);

                // echo json_encode($arr_data,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
                // se transforma el arreglo de respuesta en un json
                echo json_encode($arr_data);
        }
        catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
}


function convertToReadableSize($size){
  $base = log($size) / log(1024);
  $suffix = array("", "KB", "MB", "GB", "TB");
  $f_base = floor($base);
  return round(pow(1024, $base - floor($base)), 1) . $suffix[$f_base];
}


?>


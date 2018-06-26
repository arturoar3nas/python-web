<?php

session_start();

if(isset($_POST['btn-login']))
{
	$user_ingresado = trim($_POST['user_email']);
	$user_password = trim($_POST['password']);
	
	try
	{	
		$passwordFile = "./password.file";
		if(!$fp = fopen($passwordFile, 'r'))
		{
			echo "No se puede abrir el archivo de claves";
			exit;
		}
		
		$strings = file_get_contents($passwordFile);
		$user = strtok($strings, ";");
		$password = strtok(";");
		$passwordAdmin = strtok(";");
		fclose($fp);
					
		if(strcmp($user,$user_ingresado) == 0)
		{
			if(strcmp($password,$user_password) == 0)
			{
				$_SESSION["k_username"] = $user_ingresado;
				echo "ok";
			}
			else
			{
				echo "Contraseña incorrecta";
			}
		}
		else 
		{
			if(strcmp("admin",$user_ingresado) == 0)
			{
				if(strcmp($passwordAdmin,$user_password) == 0)
				{
					$_SESSION["k_username"] = "admin";
					echo "ok";
				}
				else
				{
					echo "Contraseña de administrador incorrecta";
				}
			}
			else
			{ 	
				echo "Usuario incorrecto";
			}
		}			
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}

?>
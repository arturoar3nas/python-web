<?php

session_start();

if(isset($_POST['btn-login']))
{
	$user_ingresado = trim($_POST['user_email']);
	$user_password = trim($_POST['password']);
	
	try
	{	
		$passwordFile = "./password.json";
	    $array = array();


	   	//Get data from existing json file
	   	$jsondata = file_get_contents($passwordFile);

	   	// converts json data into array
	   	$array = json_decode($jsondata, true);


		$user = $array['Admin_User'];
		$passwordAdmin = $array['Admin_Password'];
		$regular_user = $array['Regular_User'];
		$regular_password = $array['Regular_Password'];

		$_SESSION["k_admin"] = $user;		
					
		if(strcmp($regular_user,$user_ingresado) == 0)
		{
			if(strcmp($regular_password,$user_password) == 0)
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
			if(strcmp($user, $user_ingresado) == 0)
			{
				if(strcmp($passwordAdmin,$user_password) == 0)
				{
					$_SESSION["k_username"] = $user_ingresado;
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
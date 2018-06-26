var contador = 0;
var simbolo = "";

function cargarForm()
{
	// esta funcion espera respuesta del equipo para redireccionar a la pagina principal
	$("#mensaje").html('<div class="alert alert-info"> Esperando respuesta del equipo '+simbolo+'</div>');
	$.ajax({ 
		url: 'reiniciar_equipo_m.php'		
	});
	
	setInterval(
		function() 
		{
			contador++;
			simbolo = "=".repeat(contador % 45);		
			$("#mensaje").html('<div class="alert alert-info"> Esperando respuesta del equipo '+simbolo+'</div>');
			
			$.ajax(
			{
				url: "../index.php",
				success: 
					function(result)
					{
						window.location.href = "../index.php";
					}
			});
		}, 60000); //5 seconds	
}

function resetRTU()
{	
	cargarForm();
}

window.onload = cargarForm;

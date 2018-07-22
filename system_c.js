function cargarForm()
{		

	$.ajax({
		url: "system_m.php", 
		type: "POST",
		data: "call=cargarDatos",
		dataType: "json",  
		error: function(error) { alert(JSON.stringify(error)) ;
					$("#error").fadeIn(1000, 
							function(){						
								$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+error.responseText+' !</div>');
								$("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
							});
			   },
		success: function(jsonData){
			var instance = 1;
			$.each(jsonData, function(identificador, valor) {
				$name = "#"+identificador;			
				$($name).attr("value", valor);		
			});
		}
	});
		$.ajax({
		url: "index_m.php", 
		type: "POST",
		data: "call=cargarDatos",
		dataType: "json",  
		error: function(error) { alert(JSON.stringify(error)) ;
					$("#error").fadeIn(1000, 
							function(){						
								$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+error.responseText+' !</div>');
								$("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
							});
			   },
		success: function(jsonData){
			var instance = 1;
			$.each(jsonData, function(identificador, valor) {
				$name = "#"+identificador;
				if ( identificador == "fBt"){
						if(valor == "1"){
							var elm = document.getElementById(identificador);
							elm.click();
						}
					}							
				$($name).attr("value", valor);		
			});
		}
	});
}

function guardarForm()
{
	// para cambiar el mensaje de validacion
	$.validator.messages.required = "*Este dato es obligatorio!";
	
	$("#system-form").validate({
	   submitHandler: submitForm
       });  
}

function submitForm()
{
	 var datosFormulario = $("#system-form").serialize(); 
	 $.ajax({ url: 'index_m_configurar.php',
		 //data: {call: 'guardarDatos', datos: datosFormulario},
		 data: datosFormulario,
		 type: 'POST',
		 beforeSend: function()
			{	
				$("#error").fadeOut();
				$("#btn-configurar").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Guardando ...');
			},		
		 success: 
				function(response) 
				{
					if(response.trim()=="ok")
					{						
						setTimeout(' window.location.href = "index.php"; ',1000);
					}
					else
					{
						$("#btn-configurar").html('<span class="glyphicon glyphicon-cog"></span> &nbsp; Configurar');									
						$("#error").fadeIn(1000, 
						function()
						{						
							$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');							
						});
					}
				}
	});
}

window.onload = cargarForm;
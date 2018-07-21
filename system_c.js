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
}

window.onload = cargarForm;
function cargarForm()
{		

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
			$.each(jsonData, function(identificador, valor) {
				$name = "#"+identificador;
				
				if (identificador == "estado_conexion")
				{
					actualizarEstadoConexion(valor);
				}
				else if (identificador == "rssi") {
					document.getElementById('rssi').innerHTML = valor + " dbm";
				}
				else if ( identificador == "f3G"){
						if(valor == "1"){
							var elm = document.getElementById(identificador);
							elm.click();
						}
					}				
				else  // guarda los valores en los demas elementos del formulario
				{
					$($name).attr("value", valor);
				}
			});
		}
	});
}

function guardarForm()
{
	// para cambiar el mensaje de validacion
	$.validator.messages.required = "*Este dato es obligatorio!";
	
	$("#index-form").validate({
	   submitHandler: submitForm
       });  
}

function submitForm()
{
	 var datosFormulario = $("#3g-form").serialize(); 
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

function selectISP(valor,apn)
{
		switch (valor){
		case "0":
			$("#apn").attr("value", "chilectratm00.movistar.cl");
			$("#apn_user").attr("value", "enel");
			$("#apn_password").attr("value", "enel");
			break;
		case "1":
			$("#apn").attr("value", "imovil.entelpcs.cl");
			$("#apn_user").attr("value", "entelpcs");
			$("#apn_password").attr("value", "entelpcs");
			break;
		case "2":
			$("#apn").attr("value", "wap.tmovil.cl");
			$("#apn_user").attr("value", "wap");
			$("#apn_password").attr("value", "wap");
			break;
		case "3":
			$("#apn").attr("value", "web.tmovil.cl");
			$("#apn_user").attr("value", "web");
			$("#apn_password").attr("value", "web");
			break;
		case "4":
			$("#apn").attr("value", "bam.clarochile.cl");
			$("#apn_user").attr("value", "clarochile");
			$("#apn_password").attr("value", "clarochile");
			break;
		case "5":
			$("#apn").attr("value", "internet");
			$("#apn_user").attr("value", "");
			$("#apn_password").attr("value", "");
			break;
		case "6":
			$("#apn").attr("value", "movil.vtr.com");
			$("#apn_user").attr("value", "vtrmovil");
			$("#apn_password").attr("value", "vtrmovil");
			break;
		default:
			$("#apn").attr("value", "");
			$("#apn_user").attr("value", "");
			$("#apn_password").attr("value", "");
			break;
		}		
		if (valor != 7 ) {
			$("#apn").attr('readonly','true'); 
			$("#apn_user").attr('readonly','true'); 
			$("#apn_password").attr('readonly','true'); 
		} else {
			$("#apn").removeAttr('readonly');
			$("#apn_user").removeAttr('readonly');
			$("#apn_password").removeAttr('readonly');
		}
}

window.onload = cargarForm;
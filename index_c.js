/*
*/

function cargarForm()
{		

	$.ajax({
		url: "index_m.php", 
		type: "POST",
		data: "call=cargarDatos",
		dataType: "json",  
		error: function(error) { //alert(JSON.stringify(error)) ;
					$("#error").fadeIn(1000, 
							function(){						
								$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+error.responseText+' !</div>');
								$("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
							});
			   },
		success: function(jsonData){
			$.each(jsonData, function(identificador, valor) {
				$name = "#"+identificador;
				
				// guardar los valores para los dropbox del formulario
				if ((identificador == "IfEMG_CommonConfig_shortMsg")
					|| (identificador == "IfEMG_CommonConfig_autTripCurrentOCStatus")
					|| (identificador == "IfEMG_CommonConfig_resetAfterRecovery")
					|| (identificador == "IfEMG_CommonConfig_resetRemoteIndicator")
					|| (identificador == "IfEMG_CommonConfig_networkFrecuencySetting")
					|| (identificador == "IfEMG_CommonConfig_voltageIndication")
					|| (identificador == "IfEMG_CommonConfig_currentIndication")
					|| (identificador == "IfEMG_Config_relayActivation")
					|| (identificador == "IfEMG_Config_FLA1_enabled")
					|| (identificador == "IfEMG_Config_FLA2_enabled")
					|| (identificador == "IfEMG_Config_FLA3_enabled")
				)
				{
					actualizarDropDown(identificador, valor);
				}
				else if (identificador == "estado_conexion")
				{
					actualizarEstadoConexion(valor);
				}
				else if (identificador == "rssi") {
					document.getElementById('rssi').innerHTML = valor + " dbm";
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
	if ((document.getElementById("IfEMG_CommonConfig_voltageIndication").selectedIndex == 1) && (document.getElementById("IfEMG_CommonConfig_currentIndication").selectedIndex == 1))
	{
		alert("La indicaci\u00F3n remota de corriente no puede estar habilitada al mismo tiempo que la indicaci\u00F3n remota de voltaje");
		return;
	}
	
	
	$("#index-form").validate({
      /* rules:
	  {
			id_equipo: {
			required: true,
			},
			user_email: {
            required: true
            },
	   },
       messages:
	   {
		   required: "Esta dato es obligatorio"            
       },*/
	   submitHandler: submitForm
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

function actualizarEstadoConexion(valor)
{
	if (valor=="0")
	{
		$("#estado_conectado").show();
		$("#estado_desconectado").hide();
		$("#estado_desconectado2").hide();
	}
	if (valor=="1")
	{
		$("#estado_conectado").hide();
		$("#estado_desconectado").hide();
		$("#estado_desconectado2").show();
	}
	if (valor=="2")
	{
		$("#estado_conectado").hide();
		$("#estado_desconectado").show();
		$("#estado_desconectado2").hide();
	}
}

function submitForm()
{
	 var datosFormulario = $("#index-form").serialize();	 
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

function resetRTU()
{
	window.location.href = "php/reiniciar_equipo.php";
}

function resetContadores()
{
	$.ajax({ url: 'php/reiniciar_contadores.php',
		 beforeSend: function()
			{	
				$("#error").fadeOut();
				$("#btn-reset_contadores").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Reiniciando contadores falla ...');
			},
		 success: 
				function(response) 
				{
					if(response.trim()=="ok")
					{						
						alert("Se iniciaron los contadores correctamente");
						window.location.href = "index.php";
					}
					else
					{
						$("#btn-reset_contadores").html('<span class="glyphicon glyphicon-refresh"></span> &nbsp; Reiniciar contadores de falla ');									
						$("#error").fadeIn(1000, 
						function()
						{						
							$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');							
						});
					}
				}
	});
}

function testIndicadores()
{
	$.ajax({ url: 'php/test_indicadores.php',
		 beforeSend: function()
			{	
				$("#error").fadeOut();
				$("#btn-test_indicadores").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Enviando comando ...');
			},
		 success: 
				function(response) 
				{
					if(response.trim()=="ok")
					{						
						alert("Se ha enviado comando de test a indicadores de falla");
						window.location.href = "index.php";
					}
					else
					{
						$("#btn-test_indicadores").html('<span class="glyphicon glyphicon-edit"></span> &nbsp; Test indicadores');									
						$("#error").fadeIn(1000, 
						function()
						{						
							$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');							
						});
					}
				}
	});
}
  
function actualizarDropDown(name, value)
{
	document.getElementById(name).selectedIndex = value;
}

function mostrarTodo()
{
	$("#collapse1").collapse("show");
	$("#collapse2").collapse("show");
	$("#collapse3").collapse("show");
}

function ocultarTodo()
{
	$("#collapse1").collapse("hide");
	$("#collapse2").collapse("hide");
	$("#collapse3").collapse("hide");
}
window.onload = cargarForm;
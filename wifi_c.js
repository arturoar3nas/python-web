function cargarForm()
{		
	buildHtmlTable('#excelDataTable');
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
				else if ( identificador == "fWifi"){
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
	
	$("#wifi-form").validate({
	   submitHandler: submitForm
       });  
}

function submitForm()
{
	 var datosFormulario = $("#wifi-form").serialize(); 
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


var myList = [
    {
        "channel": "11",
        "dbm": "-58",
        "encryption": "on",
        "freq": "2.462",
        "mac": "64:D1:54:F5:92:17",
        "quality": "52",
        "quality@scale": "70",
        "ssid": "10688-optic.cl"
    },
    {
        "channel": "1",
        "dbm": "-72",
        "encryption": "on",
        "freq": "2.412",
        "mac": "84:AA:9C:31:A7:F2",
        "quality": "38",
        "quality@scale": "70",
        "ssid": "Chelo"
    },
    {
        "channel": "1",
        "dbm": "-85",
        "encryption": "on",
        "freq": "2.412",
        "mac": "A4:B1:E9:EE:2C:58",
        "quality": "25",
        "quality@scale": "70",
        "ssid": "2510"
    },
    {
        "channel": "1",
        "dbm": "-86",
        "encryption": "on",
        "freq": "2.412",
        "mac": "84:AA:9C:0B:04:65",
        "quality": "24",
        "quality@scale": "70"
    },
    {
        "channel": "1",
        "dbm": "-84",
        "encryption": "on",
        "freq": "2.412",
        "mac": "C0:05:C2:E1:62:19",
        "quality": "26",
        "quality@scale": "70",
        "ssid": "VTR-0587041"
    },
    {
        "channel": "3",
        "dbm": "-70",
        "encryption": "on",
        "freq": "2.422",
        "mac": "AC:F1:DF:24:7B:B0",
        "quality": "40",
        "quality@scale": "70"
    },
    {
        "channel": "3",
        "dbm": "-85",
        "encryption": "on",
        "freq": "2.422",
        "mac": "48:D3:43:57:3D:71",
        "quality": "25",
        "quality@scale": "70",
        "ssid": "VTR-1173279"
    },
    {
        "channel": "5",
        "dbm": "-78",
        "encryption": "on",
        "freq": "2.432",
        "mac": "40:0D:10:0F:6E:79",
        "quality": "32",
        "quality@scale": "70",
        "ssid": "Home"
    },
    {
        "channel": "5",
        "dbm": "-83",
        "encryption": "on",
        "freq": "2.432",
        "mac": "94:10:3E:86:5B:B9",
        "quality": "27",
        "quality@scale": "70",
        "ssid": "Mio"
    },
    {
        "channel": "5",
        "dbm": "-87",
        "encryption": "on",
        "freq": "2.432",
        "mac": "C0:05:C2:C3:BB:F9",
        "quality": "23",
        "quality@scale": "70",
        "ssid": "VTR-3627767"
    },
    {
        "channel": "6",
        "dbm": "-81",
        "encryption": "on",
        "freq": "2.437",
        "mac": "84:16:F9:3A:13:48",
        "quality": "29",
        "quality@scale": "70",
        "ssid": "TP-LINK_1348"
    },
    {
        "channel": "9",
        "dbm": "-79",
        "encryption": "on",
        "freq": "2.452",
        "mac": "18:D6:C7:74:35:06",
        "quality": "31",
        "quality@scale": "70",
        "ssid": "Home01828"
    },
    {
        "channel": "10",
        "dbm": "-80",
        "encryption": "on",
        "freq": "2.457",
        "mac": "C4:6E:1F:8C:76:F4",
        "quality": "30",
        "quality@scale": "70",
        "ssid": "VE"
    },
    {
        "channel": "11",
        "dbm": "-77",
        "encryption": "on",
        "freq": "2.462",
        "mac": "08:6A:0A:6F:6C:BD",
        "quality": "33",
        "quality@scale": "70",
        "ssid": "Bodoke"
    },
    {
        "channel": "11",
        "dbm": "-86",
        "encryption": "on",
        "freq": "2.462",
        "mac": "08:6A:0A:6E:F1:A2",
        "quality": "24",
        "quality@scale": "70",
        "ssid": "Valeracity"
    },
    {
        "channel": "11",
        "dbm": "-93",
        "encryption": "on",
        "freq": "2.462",
        "mac": "34:57:60:E2:DF:B0",
        "quality": "17",
        "quality@scale": "70",
        "ssid": "Horacito"
    },
    {
        "channel": "11",
        "dbm": "-80",
        "encryption": "on",
        "freq": "2.462",
        "mac": "84:AA:9C:46:F8:9D",
        "quality": "30",
        "quality@scale": "70",
        "ssid": "movistar2,4GHZ_46F89D"
    }
];

// Builds the HTML Table out of myList.
function buildHtmlTable(selector) {
  
 $.ajax({
		url: "wifi_list_m.php", 
		type: "POST",
		data: "call=cargarDatos",
		dataType: "json",
		beforeSend: function()
			{	
				$("#error").fadeOut();
				/*Animamos el boton*/
				$("#btn-list").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Escaneando...');
			},  
		error: function(error) { alert(JSON.stringify(error)) ;
					$("#error").fadeIn(1000, 
							function(){						
								$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+error.responseText+' !</div>');
								$("#btn-list").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Scan');
							});
			   },
		success: function(jsonData){
			  var columns = addAllColumnHeaders(jsonData, selector);

			  for (var i = 0; i < jsonData.length; i++) {
			    var row$ = $('<tr/>');
			    for (var colIndex = 0; colIndex < columns.length; colIndex++) {
			      var cellValue = jsonData[i][columns[colIndex]];
			      if (cellValue == null) cellValue = "";
			      row$.append($('<td/>').html(cellValue));
			    }
			    $(selector).append(row$);
			  }
			  $("#btn-list").html('<span class="glyphicon glyphicon-cog"></span> &nbsp; Scan');				
			  alertify.success("Escaneo exitoso!");			
		}
	}); 
}

// Adds a header row to the table and returns the set of columns.
// Need to do union of keys from all records as some records may not contain
// all records.
function addAllColumnHeaders(myList, selector) {
  var columnSet = [];
  var headerTr$ = $('<tr/>');

  for (var i = 0; i < myList.length; i++) {
    var rowHash = myList[i];
    for (var key in rowHash) {
      if ($.inArray(key, columnSet) == -1) {
        columnSet.push(key);
        headerTr$.append($('<th/>').html(key));
      }
    }
  }
  $(selector).append(headerTr$);

  return columnSet;
}

window.onload = cargarForm;
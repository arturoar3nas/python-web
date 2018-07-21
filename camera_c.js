
function cargarForm()
{ 
  jQuery("#img").html("");
  jQuery('document').ready(function() {
        jQuery.ajax({            
              url: "camera_m.php", 
  	    type: "POST",          
  	    dataType: "JSON", 
              success: function( data ) {
                for (i in data)
                {
                  jQuery('#img').append(data[i]);
                  break;
                }		          
              },
              error: function(jqXHR, data ) {        
  		  alert ('Ajax request Failed.');    
  	    }
          }); 
  });
}

function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}

window.onload = cargarForm;

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
                  var res = data[i].replace(/\"/g, "");
                  jQuery('#img').append(res);
                  break;
                }		          
              },
              error: function(jqXHR, data ) {        
  		          alert ('Ajax request Failed. ' + JSON.stringify(data)  + ' ' + JSON.stringify(jqXHR) );    
  	    }
          }); 
  });
}


window.onload = cargarForm;
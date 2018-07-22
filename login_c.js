
$('document').ready(function()
{ 
     /* validation */
	 $("#login-form").validate({
      rules:
	  {
			password: {
			required: true,
			},
			user_email: {
            required: true
            },
	   },
       messages:
	   {
            password:{
                      required: "introduzca contraseña"
                     },
            user_email: "introduzca usuario",
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* login submit */
	   function submitForm()
	   {		
			var data = $("#login-form").serialize();
				
			$.ajax({
				
			type : 'POST',
			url  : 'login_m.php',
			data : data,
			beforeSend: function()
			{	
				$("#error").fadeOut();
				$("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Verificando ...');
			},
			success :  function(response)
			   {						
					if(response=="ok"){
									
						$("#btn-login").html('<img src="img/btn-ajax-loader.gif" /> &nbsp; Redireccionando ...');
						setTimeout(' window.location.href = "3g.php"; ',1000);
					}
					else{
									
						$("#error").fadeIn(1000, 
												function(){						
													$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
													$("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
												});
					}
			  }
			});
		}
	   /* login submit */
});

function cargarForm()
{
	$("#user_email").focus();
}

window.onload = cargarForm;

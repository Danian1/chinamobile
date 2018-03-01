$(document).ready(function(){
	$('#form_reg').validate({
					rules:{
						"name":{
							required:true,
							minlength:3,
							maxlength:20
						},
						"lastname":{
							required:true,
							minlength:3,
							maxlength:20
						},
						"email":{
							required:true,
							email:true
						},
						"login":{
							required:true,
							minlength:5,
							maxlength:15,
							},
						"password":{
							required:true,
							minlength:7,
							maxlength:15
						},
						"repassword":{
							required:true
						}
					},
					
					messages:{
						"name":{
							required:"Specify your name",
							minlength:"of 3 to 20 symbols",
							maxlength:"of 3 to 20 symbols"
						},
						"lastname":{
							required:"Specify your lastname",
							minlength:"of 3 to 20 symbols",
							maxlength:"of 3 to 20 symbols"
						},
						"email":{
							required:"Specify your email",
							email:"Incorrect email"
						},
						"login":{
							required:"Specify your login",
							minlength:"of 5 to 15 symbols",
							maxlength:"of 5 to 15 symbols"
							},
						"password":{
							required:"Specify password",
							minlength:"of 7 to 15 symbols",
							maxlength:"of 7 to 15 symbols"
						},
						"repassword":{
							required:"Specify confirm password"
						}
						
					},
		
			submitHandler:function(form){
				$(form).ajaxSubmit({
					success:function(data){
						if(data== 'true')
						{
							$("#registr").fadeOut(300,function(){
								$("#reg_message").addClass("reg_message_good").fadeIn(300).html("Success registration!");
								$(".register-bottom").hide();
							});
						}else
						{
							$("#reg_message").addClass("reg_message_error").fadeIn(300).html(data);
						}
					}
					
					
					
				});
				
			}
		
		
		
		
	});


});
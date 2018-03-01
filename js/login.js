$(document).ready(function(){
	
	$('#button-auth').click(function(){
		var auth_login=$("#auth_login").val();
		var auth_pass=$("#auth_pass").val();
		
		if(auth_login=="" || auth_login.length > 30){
			$("#auth_login").css("borderColor","#FF0000");
			send_login='no';
		}else{
			$("#auth_login").css("borderColor","#00FF59");
			send_login='yes';
		}
		if(auth_pass=="" || auth_pass.length > 15){
			$("#auth_pass").css("borderColor","#FF0000");
			send_pass='no';
		}else{
			$("#auth_pass").css("borderColor","#00FF59");
			send_pass='yes';
		}
		if($("#rememberme").prop('checked'))
		{
			auth_rememberme='yes';
		}else
		{
			auth_rememberme='no';
		}
		
		if(send_login=='yes' && send_pass=='yes')
		{
			$.ajax({
				type:"POST",
				url:"php/inc/auth.php",
				data:"login="+auth_login+"&pass="+auth_pass+"&rememberme="+auth_rememberme,
				dataType:"html",
				cache:false,
				success:function(data){
					
					if(data == 'yes_auth')
					{
						location.reload();
					}else{
						$("#message-auth").slideDown(400);
						$("#auth_login").css("borderColor","#FF0000");
						$("#auth_pass").css("borderColor","#FF0000");
					}
				}
			});
		}
			
		
	});

});
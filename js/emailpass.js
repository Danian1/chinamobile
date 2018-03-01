$('#button-remind').click(function(){
	var recall_email=$("#remind-email").val();
	
	if(recall_email=="" || recall_email.length > 30)
	{
		$("#remind-email").css("borderColor","#FF0000");
	}else{
		$("#remind-email").css("borderColor","#00FF59");
		
		$.ajax({
			type:"POST",
			url:"php/inc/remind-pass.php",
			data:"email="+recall_email,
			dataType:"html",
			cache:false;
			success:function(data){
				if(data == 'yes')
				{
					$('#message-remind').attr("class","message-remind-succes").html("In your email sent letter").slideDown(400);
					setTimeout("$('#message-remind').html('').hide(),$('#block-remind').hide(),$('#input-email-pass').show()",3000);
				}else
				{
					$('#message-remind').attr("class","message-remind-error").html(data).slideDown(400);
				}
			}
		});	
		
	}
		});	
$(document).ready(function(){
 $('#button-send-review').click(function(){
	var name=$("#name_rev").val(); 
	var good=$("#good_rev").val();
	var bad=$("#bad_rev").val();
	var comment=$("#comment_rev").val();
	var iid=$("#button-send-review").attr("iid");
	
	if(name!="")
	{
		name_rev='1';
		$("#nam_rev").css("borderColor","#DBDBDB");
	}else{
		name_rev='0';
		$("#nam_rev").css("borderColor","#FDB6B6");
	}
	if(good!="")
	{
		good_rev='1';
		$("#good_rev").css("borderColor","#DBDBDB");
	}else{
		good_rev='0';
		$("#good_rev").css("borderColor","#FDB6B6");
	}
	if(bad!="")
	{
		bad_rev='1';
		$("#bad_rev").css("borderColor","#DBDBDB");
	}else{
		bad_rev='0';
		$("#bad_rev").css("borderColor","#FDB6B6");
	}
	if(name_rev=='1' && good_rev=='1' && bad_rev=='1')
	{
		$.ajax({
		type:"POST",
		url:"php/inc/add_review.php",
		data:"id="+iid+"&name="+name+"&good="+good+"&bad="+bad+"&comment="+comment,
		dataType:"html",
		cache:false,
		success:function(){
			setTimeout("$.fancybox.close()",1000);
		}
		})
	}
 });
 
 $('#like').click(function(){

	var tid=$(this).attr("tid");
	$.ajax({
		type:"POST",
		url:"php/inc/like.php",
		data:"id="+tid,
		dataType:"html",
		cache:false,
		success:function(data){
			if(data=='no')
			{
				alert('You already voted!');
			}else
			{
				$("#nrlike").html(data);
			}
		}
		
	});

 });
});
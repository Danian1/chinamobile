$(document).ready(function(){
	$('.delete').click(function(){
		var rel=$(this).attr("rel");
		
		$.confirm({
			'title'	: "Confirm delete",
			'message': "After deleting the file will not be possible to restore! Confirm?",
			'buttons' : {
				'Yes' : {
					'class':'blue',
					'action':function(){
						location.href=rel;
					}
				},
				'No' : {
					'class':'gray',
					'action':function(){}
				}
			}
		});
	});
	$('#select-links').click(function(){
		$("#list-links,#list-links-sort").slideToggle(200);
	});
	$('.h3click').click(function(){
		$(this).next().slideToggle(400);
	});
	
	
	
	
	$('.delete-cat').click(function(){
		var selectid=$("#cat_type option:selected").val();
		
	if(!selectid){
		$("#cat_type").css("borderColor","#F5A4A4");
	}else{
		$.ajax({
			type:"POST",
			url:"actions/delete-category.php",
			data:"id="+selectid,
			dataType:"html",
			cache:false,
			success:function(data){
				if(data=="delete")
				{
					$("#cat_type option:selected").remove();
				}
			}
			});
		}
		
	});	
	
var count_input=1;
$("#add-im").click(function(){
	count_input++;
	$('<div id="addimage'+count_input+'" class="addimage"><input type="hidden" name="MAX_FILE_SIZE" value="2000000"/><input type="file" name="galleryimg[]"/><a class="delete-input" rel="'+count_input+'">Delete</a></div>').fadeIn(300).appendTo('#objects');
});	
	$('.block-clients').click(function(){
		$(this).find('ul').slideToggle(300);
	});
	
	
$(document).on('click','.delete-input',function(){
	var rel=$(this).attr("rel");
	$("#addimage"+rel).fadeOut(300,function(){
		$("#addimage"+rel).remove();
	});
});

$('.del-img').click(function(){
	var img_id=$(this).attr("img_id");
	var title_img=$("#del"+img_id+">img").attr("title");
	
	$.ajax({
		type:"POST",
		url:"./actions/delete-gallery.php",
		data:"id="+img_id+"&title="+title_img,
		dataType:"html",
		cache:false,
		success:function(data){
			if(data=="yes")
			{
				$("#del"+img_id).fadeOut(300);
			}
		}
	});
});



});
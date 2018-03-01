<footer>
            <div class="row">
				<div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    <ul>
                        <li> <a href="index.php">Home </a></li>
                        <li> <a href="store.php">Store </a></li>
                        <li> <a href="contact.php">Contact </a></li>
                    </ul>
				</div>
				<div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    <ul>
                        <li> <a href="about.php">About </a></li>
                        <li> <a href="faq.php">Faq </a></li>
                    </ul>
                            
                </div>
                 <p class="float-right">Copyright 2015 &copy; by <strong>Danian</strong></p>
            </div>
        </footer>
	 <!-- jQuery -->
	 <script type="text/javascript" src="js/jquery.js"></script> 
	 <script type="text/javascript" src="fancybox/jquery.fancybox.js"></script>
	 <script type="text/javascript" src="js/bootstrap.js"></script> 
	 <script type="text/javascript" src="js/login.js"></script>
	 <script type="text/javascript" src="js/jquery.form.js"></script>
	 <script type="text/javascript" src="js/jquery.validate.js"></script>
	 <script src="js/jqBootstrapValidation.js"></script>
		<script src="js/contact_me.js"></script>
<script type="text/javascript">
$(document).ready(function(){
 $('.top-auth').click(function(){
	$("#block-top-auth").slideToggle(100);
 });
$('#remindpass').click(function(){
	$('#input-email-pass').fadeOut(200,function(){
		$('#block-remind').fadeIn(300);
	});
});
$('#prev-auth').click(function(){
	$('#block-remind').fadeOut(200,function(){
		$('#input-email-pass').fadeIn(300);
	});
}); 

$('#user-info').click(
function(){
		$("#block-user").fadeIn(100);
		
});
	
	 $('#logout').click(function(){
	 $.ajax({
		 type:"POST",
		 url:"php/inc/logout.php",
		 dataType:"html",
		 cache:false,
		 success:function(data){
			 if(data=='logout')
			 {
				location.reload();
			 }
		 }
	 });
 });
});
</script>
    </div> <!-- /.container -->
</body>
</html>	
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
		 <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="index.php" title="Home">Home</a></li>
                    <li><a href="store.php" title="Store">Store</a></li>
					<li><a href="contact.php"title="Contact">Contact</a></li>
                </ul>
				<?php
				if($_SESSION['auth']=='yes_auth')
				{
					echo '<ul class="nav navbar-nav navbar-right">
						<li><a href="#" id="user-info" title="Your login">Hello, '.$_SESSION['auth_login'].'</a></li>
						</ul>
					';
					
				}else{
					echo'<ul class="nav navbar-nav navbar-right">
                       <li><a href="regist.php" title="Registration">Registration</a></li>	
					   <li><a class="top-auth" style="cursor:pointer" title="Login">Login</a></li>    
				       </ul>';
				}
				?>
		 <div id="block-top-auth">
					<form method="POST">
						<ul id="input-email-pass">
							<p id="message-auth">Incorrect login or(and) password</p>
							<li><input type="text" id="auth_login" placeholder="Login or Email" title="Write login or email"/></li>
							<li><input type="password" id="auth_pass" placeholder="Password" title="password"/></li>
								<ul id="list-auth">
									<li><input type="checkbox" name="rememberme" id="rememberme"/><label for="rememberme">  Remember me</label></li>
									<li><a id="remindpass" href="#" title="Do not remember your password?">Forgot your password?</a></li>
								</ul>
							<p align="right" id="button-auth" title="Login into your account"><a>Login</a></p>
						</ul>
				  </form>
				  <div id="block-remind">
				  <h4> Recovery, password</h4>
				  <p id="message-remind" class="message-remind-succes"></p>
				  <center><input type="text" id="remind-email" placeholder="Your email"/></center>
				  <p align="right" id="button-remind"><a title="Send new password">Send</a></p>
				  <p align="left" id="prev-auth" title="Back to panel login">Back</p>
				  </div>
		   </div>
		   <div id="block-user">
								<ul>
							<li><a href="profile.php" title="Profile">Profile</a></li>
							<li><a href="admin/login.php" title="Control">Control</a></li>
							<li><a id="logout" title="Logout">Logout</a></li>
						</ul>
				</div>
				 <form method="GET" action="search.php?q=" class="navbar-form navbar-right">
            <input type="text" class="form-control" name="q" placeholder="Search..." title="Search">
          </form>
		  
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav>
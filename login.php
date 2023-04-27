<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title>Login</title>		
<script src="js/jquery-3.2.1.min.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>﻿
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="font-awesome-5.3.1/css/all.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				
				<div class="setup-box">
					<h3 class="box-title">Log In here</h3>
					<form action="checkUser.php" method="post">
						<label>Username</label><br>
						<input type="text" class="setup-input" name="user_username" placeholder="Enter Username" autocomplete="off" required>
						<label>Password</label><br>
						<input type="password" id="input" class="setup-input" name="user_password" placeholder="Enter Password" autocomplete="off" required>
						<input type="checkbox" id="checkbox" onclick="showPassword()"> <label for="checkbox">Show Password</label>
						<?php 
							if (isset($_GET['msg'])) {
								$msg = "Username or password incorrect";
								echo "<div class='callout callout-danger'>";
      						echo "<p>".$msg."</p>";
      						echo "</div>";
      						echo "<br>";
							}
						?>		
						<div class="bottom-line"></div>
						<input type="submit" class="submit-btn" style="width: 100%; margin-top: -5px;" name="login" value="Log In">
					</form>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">	
	function showPassword() {
		var myinput = document.getElementById('input');
		if (myinput.type === "password") {
			myinput.type = "text";
		}else{
			myinput.type = "password";
		}
	}
</script>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title>Sign Up - Attendance Management System</title>		
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>﻿
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/script.js"></script>
<link rel="stylesheet" href="../css/style.css" type="text/css">
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.css">
<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="../font-awesome-5.3.1/css/all.css">
</head>
<body>
	<?php 
							if (isset($_GET['msg'])) {
								$msg = "Username or password incorrect";
								echo "<div class='callout callout-danger'>";
      						echo "<p>".$msg."</p>";
      						echo "</div>";
      						echo "<br>";
							}
						?>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<?php  
					if (isset($_GET['accExist'])) {
								$msg = $_GET['accExist'];
								echo "<div class='callout callout-warning'>";
      						echo "<p>".$msg."</p>";
      						echo "</div>";
      						echo "<br>";
							}

				?>
				<div class="setup-box">
					<h3 class="box-title">Create Account</h3>
					<form action="createAccount.php" method="post">
						<label>Name</label><br>
						<input type="text" class="setup-input" name="name" placeholder="Enter Name" autocomplete="off" required>
						<label>Username</label><br>
						<input type="text" class="setup-input" name="username" placeholder="Enter Username" id="username" autocomplete="off" onkeyup="noSpace()" required>
						<label>Select Department</label><br>
          				<select name="department" class="setup-input" required>
            				<option value="">Select Department</option>
				            <?php  
				              require_once("connection.php");
				              $sql = "SELECT * FROM tbl_departments";
				              $depResult = mysqli_query($conn, $sql);
				              if (mysqli_num_rows($depResult) > 0) {
				                while ($row = mysqli_fetch_assoc($depResult)) {
				                  $department = $row['dep_name'];
				                  $dep_ID = $row['dep_ID'];
				                  echo "<option value='".$dep_ID."'>".$department."</option>";
				                }
				              }
				              else{
				                echo "Not available";
				              }              
				            ?>
          				</select>
						<label>Password</label><br>
						<input type="password" id="password" class="setup-input" name="password1" placeholder="Enter Password" autocomplete="off" required>
						<label>Confirm Password</label><br>
						<input type="password" id="confirm_password" class="setup-input" name="password2" placeholder="Confirm Password" autocomplete="off" required>
						<input type="checkbox" id="checkbox" onclick="showPassword()"> <label for="checkbox">Show Password</label>
						

						<div class="bottom-line"></div>
						<input type="submit" class="submit-btn" style="width: 100%; margin-top: -5px;" name="signup" id="submit-btn" value="Sign up">
					</form>
				</div>
			</div>
		</div>
	</div>
	<p id="demo"></p>
<script type="text/javascript">	
	function noSpace() {
		var username = document.getElementById('username');
		if (username.indexOf('a') >= 0) {
			document.getElementById('demo').innerHTML = "Hello";
		}else{
			document.getElementById('demo').innerHTML = "Hello World";
		}
	}
	function showPassword() {
		var password = document.getElementById('password');
		var confirm_password = document.getElementById('confirm_password');
		if (password.type === "password" && confirm_password.type === "password") {
			password.type = "text";
			confirm_password.type = "text";
		}else{
			password.type = "password";
			confirm_password.type = "password";
		}
	}
	$('#password, #confirm_password').on('keyup', function () {
  if ($('#password').val() == $('#confirm_password').val()) {
    $('#submit-btn').prop('disabled', false);
    $('#submit-btn').css('cursor', 'pointer');
    $('#confirm_password').css('border', '1px solid green');
    $('#password').css('border', '1px solid green');
  } else {
    $('#submit-btn').prop('disabled', true);
    $('#submit-btn').css('cursor', 'not-allowed');
    $('#confirm_password').css('border', '1px solid red');
    $('#password').css('border', '1px solid red');
  }
});
</script>
</body>
</html>
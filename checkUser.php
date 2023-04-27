<?php 
require_once ("connection.php");

session_start();

$username = mysqli_real_escape_string($conn, $_POST['user_username']);
$password = mysqli_real_escape_string($conn, $_POST['user_password']);
			
$sql = "SELECT * FROM tbl_users WHERE user_username='$username' AND user_password='$password'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 0){
	header("location: login.php?msg=1");
}else{	
	$_SESSION["user_username"] = $username;
	header("location: index.php");	
}

?>
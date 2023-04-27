<?php 
require_once ("connection.php");

session_start();

$username = mysqli_real_escape_string($conn, $_POST['admin_username']);
$password = mysqli_real_escape_string($conn, $_POST['admin_password']);
			
$sql = "SELECT * FROM tbl_admin WHERE admin_username='$username' AND admin_password='$password'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 0){
	header("location: login.php?msg=1");
}else{	
	$_SESSION["admin_username"] = $username;
	header("location: index.php");
// 	while ($row = mysqli_fetch_assoc($result)) {
// 		$userType = $row['user_type']; 
// 		if ($userType=="admin") {
// 			$_SESSION["user_username"] = $username;
// 			header("location: index.php");
// 		}elseif ($userType=="user") {
// 			$_SESSION["user_username"] = $username;
// 			header("location: ../index.php");
// 		}
	
// }
}	
?>
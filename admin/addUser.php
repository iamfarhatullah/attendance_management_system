<?php  
require_once("connection.php");

$name = mysqli_real_escape_string($conn, $_POST['name']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['newPassword']);
$semester = mysqli_real_escape_string($conn, $_POST['semester']);
$department = mysqli_real_escape_string($conn, $_POST['department']);
$batch = mysqli_real_escape_string($conn, $_POST['batch']);

$sql_check = "SELECT * FROM tbl_users WHERE user_username='$username' and user_batchID='$batch' and user_semesterID='$semester'";
$check_result = mysqli_query($conn, $sql_check);

if (mysqli_num_rows($check_result)==0) {
	$sql = "INSERT into tbl_users(user_name, user_username, user_password, user_batchID, user_semesterID, user_departmentID)values('$name','$username','$password','$batch','$semester','$department')";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		header("location: users.php?userMsg=User added successfully.");
	}else{
		header("location: users.php?userMsgError=Error.");
	}
}else{
	header("location: users.php?userMsgExist=Username is taken.");
}

?>
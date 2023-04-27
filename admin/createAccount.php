<?php 
require_once ("connection.php");
$name = mysqli_real_escape_string($conn, $_POST['name']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password1']);
$department = mysqli_real_escape_string($conn, $_POST['department']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password1']);

$name = ucwords(strtolower($name));

$query = "SELECT * FROM tbl_admin WHERE admin_username='$username'";
$rs = mysqli_query($conn,$query);

if(mysqli_num_rows($rs) == 0){
	$sql = "INSERT into tbl_admin (admin_name,admin_username,admin_password,admin_departmentID)values('$name','$username','$password','$department')";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		header("location: login.php?acc=Account created!");
	}else{
		header("location: signup.php?accError=ERROR!");
	}
}else{	
	header("location: signup.php?accExist=Username is taken, try another");
}	
?>
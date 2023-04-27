<?php  
require_once("connection.php");
if (isset($_POST['submitGroup'])) {
	$userID = mysqli_real_escape_string($conn, $_POST['userID']);
	$groupname = mysqli_real_escape_string($conn, $_POST['groupname']);
	$courseID = mysqli_real_escape_string($conn, $_POST['course']);

	$sql_check = "SELECT * FROM tbl_groups WHERE grp_name='$groupname'";
	$check_result = mysqli_query($conn, $sql_check);

	if (mysqli_num_rows($check_result) > 0) {
		header("location: groups.php?addGrpExist=Group already exist");
	}else{
		$sql = "INSERT into tbl_groups(grp_name,grp_subjectID,grp_userID)values('$groupname','$courseID','$userID')";
		$result = mysqli_query($conn, $sql);
		if ($result) {
			header("location: groups.php?addGrpSucces=Group created successfully");
		}else{
			header("location: groups.php?addGrp=Error");
		}
	}
}
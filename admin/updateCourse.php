<?php  
	require_once("connection.php");

	if (isset($_POST['submitCourse'])) {
	$sub_ID = mysqli_real_escape_string($conn, $_POST['sub_ID']);
	$sub_name = mysqli_real_escape_string($conn, $_POST['subject']);
	
	$sqlCheck = "SELECT * From tbl_subjects WHERE sub_name='$sub_name' and sub_ID!='$sub_ID'";
	$result = mysqli_query($conn, $sqlCheck);
	if (mysqli_num_rows($result)==0) {
		$sql = "UPDATE tbl_subjects SET sub_name='".$sub_name."' WHERE sub_ID='".$sub_ID."' ";
		$updateResult = mysqli_query($conn, $sql);
		if($updateResult){
        	header("location: courses.php?updMsg=1 record edited.");
		}else{
			header("location: editCourse.php?id=".$sub_ID."&updMsgErr=Error.");
		}
	}else{
		header("location: editCourse.php?id=".$sub_ID."&updMsgExists=The Course You Entered Already Exists.");
	}


	
	}	
?>
<?php  
	require_once("connection.php");

	if (isset($_POST['submitStudent'])) {
	$id = mysqli_real_escape_string($conn, $_POST['id']);
	$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
	$fathername = mysqli_real_escape_string($conn, $_POST['fathername']);
	$batch = mysqli_real_escape_string($conn, $_POST['batch']);
	$rollno = mysqli_real_escape_string($conn, strtoupper($_POST['rollno']));
	$department = mysqli_real_escape_string($conn, $_POST['department']);
	$semester = mysqli_real_escape_string($conn, $_POST['semester']);
	
	$sqlCheck = "SELECT * From tbl_students WHERE std_rollno='$rollno' and std_batchID='$batch' and std_ID!='$id'";
	$result = mysqli_query($conn, $sqlCheck);
	if (mysqli_num_rows($result)==0) {
		$sql = "UPDATE tbl_students SET std_name='". $fullname. "' , std_fathername='". $fathername. "' , std_batchID='". $batch. "' , std_rollno='". $rollno. "', std_departmentID='". $department. "', std_semesterID='". $semester. "' WHERE std_ID='".$id."' ";
		$updateResult = mysqli_query($conn, $sql);
		if($updateResult){
        	header("location: students.php?updMsg=1 record edited.");
		}else{
			header("location: editStudent.php?id=".$id."&updMsgErr=Error.");
		}
	}else{
		header("location: editStudent.php?id=".$id."&updMsgExists=Exists.");
	}


	
	}	
?>
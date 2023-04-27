<?php
require_once("connection.php");
$id = $_GET['id'];
$totalStudents = $_GET['totalStudents'];
for ($i=1; $i <= $totalStudents; $i++) { 
	$submitDate = $_POST['submitDate'];
	$status = $_POST['status'.$i];
	$studentID = $_POST['studentID'.$i];
	$groupID = $_POST['groupID'.$i];

	$sql = "INSERT into tbl_attendance(att_date, att_status, att_studentID, att_groupID)values('$submitDate','$status','$studentID','$groupID')";

	if (mysqli_query($conn, $sql)) {
		header("location: attendance.php?id=".$id."&selectedDate=Attendance record saved successfully");
	}else{
		$msg = "Error";
	}
	
}

	echo $msg;

?>

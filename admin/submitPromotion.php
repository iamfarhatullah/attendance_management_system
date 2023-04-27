<?php  
require_once("connection.php");
$bat_ID = $_GET['bat_ID'];
$totalStudents = $_GET['totalStudents'];
$newSemester = $_POST['newSemester'];

$sqlSemesters = "SELECT sem_name FROM tbl_semesters WHERE sem_ID='$newSemester'";
$resultSemesters = mysqli_query($conn, $sqlSemesters);
$row = mysqli_fetch_assoc($resultSemesters);
$newSemesterName = $row['sem_name'];

for ($i=1; $i <= $totalStudents; $i++) { 
	$studentID = $_POST['studentID'.$i];
	$groupID = $_POST['oldSemester'.$i];

	$sql = "UPDATE tbl_students SET std_semesterID='$newSemester' WHERE std_batchID='$bat_ID' and std_ID='$studentID'";
	
	if (mysqli_query($conn, $sql)) {
		header("location: promoteStudents.php?id=".$bat_ID."&sem=Students promoted to ".$newSemesterName." semester");
	}else{
		$msg = "Error";
	}
	
}

	echo $msg;





?>
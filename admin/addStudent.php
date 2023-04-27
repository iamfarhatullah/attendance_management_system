<?php  
require_once("connection.php");

if (isset($_POST['submitStudent'])) {
	$fullname = mysqli_real_escape_string($conn, ucwords(strtolower($_POST['fullname'])));
	$fathername = mysqli_real_escape_string($conn, ucwords(strtolower($_POST['fathername'])));
	$batch = mysqli_real_escape_string($conn, $_POST['batch']);
	$rollno = mysqli_real_escape_string($conn, strtoupper($_POST['rollno']));
	$department = mysqli_real_escape_string($conn, $_POST['department']);
	$semester = mysqli_real_escape_string($conn, $_POST['semester']);

	$sql_check = "SELECT * FROM tbl_students WHERE std_rollno='$rollno' and std_semesterID='$semester'";
	$check_result = mysqli_query($conn, $sql_check);

	if (mysqli_num_rows($check_result) == 0) {
		$sql = "INSERT into tbl_students(std_name,std_fathername,std_batchID,std_rollno,std_departmentID,std_semesterID)values('$fullname','$fathername','$batch','$rollno','$department','$semester')";
            $result = mysqli_query($conn, $sql);
            if ($result) {

$sqlstd = "SELECT * FROM tbl_students WHERE std_rollno='$rollno' and std_batchID='$batch'";
$resultstd = mysqli_query($conn, $sqlstd);
$rowstd = mysqli_fetch_assoc($resultstd);
$std_ID = $rowstd['std_ID'];
$std_departmentID = $rowstd['std_departmentID'];

$sql = "SELECT `att_date`,`att_groupID` FROM tbl_attendance INNER JOIN tbl_students ON tbl_attendance.att_studentID = tbl_students.std_ID INNER JOIN tbl_groups ON tbl_attendance.att_groupID = tbl_groups.grp_ID WHERE att_groupID IN (SELECT grp_ID FROM tbl_groups INNER JOIN tbl_users ON tbl_groups.grp_userID = tbl_users.user_ID WHERE user_departmentID='$std_departmentID' and user_batchID='$batch') GROUP by `att_date`,`att_groupID`
";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result)>0) {
                    while ($rows = mysqli_fetch_assoc($result)) {
                        
                        $attDate1 = $rows['att_date'];
                        $grp_ID = $rows['att_groupID'];
                        $status = "--";

                        $sql = "INSERT into tbl_attendance(att_date, att_status, att_studentID, att_groupID) values ('$attDate1','$status','$std_ID','$grp_ID')";
                        $result1 = mysqli_query($conn, $sql);
                        if ($result) {
                            $msg = "AttInserted";
                        }else{
                            $msg = "AttNotInserted";
                        }
                    }
                }

              header("location: students.php?addStd=Student added Successfully ".$msg);
            }else{
              header("location: students.php?addStdError=Error.");
            }
	}else{
		header("location: students.php?addStdExist=Student already exist.");
	}
}
?>
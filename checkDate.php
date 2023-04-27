<?php
require_once("connection.php");

$id = mysqli_real_escape_string($conn, $_POST['id']);
$myDate = mysqli_real_escape_string($conn, $_POST['selectedDate']);

  
  $sql = "SELECT * FROM tbl_attendance WHERE att_date='$myDate' and att_groupID='$id'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result)>0) {
    header("location: selectDate.php?id=".$id."&selectedDateTaken=Attendance is taken already");
  }else{
    header("location: takeAttendance.php?id=".$id."&selectedDate=".$myDate);
    // echo $myDate;
  }

?>

<?php  
  require_once("connection.php");
  
  $id = $_GET['id'];
  $sql = "DELETE FROM tbl_students WHERE std_ID='$id'";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    $sqlDeleteAttendance = "DELETE FROM tbl_attendance WHERE att_studentID='$id'";
    $resultDeleteAttendance = mysqli_query($conn, $sqlDeleteAttendance);
    if ($sqlDeleteAttendance) {
      $msg = "Attendance also deleted";
    }else{
      $msg = "Attendance didn't deleted"; 
    }
    header("location: students.php?dltStudent=1 Student Deleted and ".$msg);
  }else{
    header("location: students.php?dltStudentError=Error.");
  }
  
  ?>
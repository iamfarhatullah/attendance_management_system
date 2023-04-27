<?php  
  require_once("connection.php");
  
  $id = $_GET['id'];
  $sql = "DELETE FROM tbl_groups WHERE grp_ID='$id'";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    $deleteAttendance = "DELETE FROM tbl_attendance WHERE att_groupID='$id'";
    $resultDeleteAttendance = mysqli_query($conn, $deleteAttendance);
    if ($resultDeleteAttendance) {
        $msg = "and the data inside the group also deleted";
    }else{
        $msg = "but the data inside the group did not deleted";
    }
    header("location: groups.php?dltGrp=Group deleted ".$msg);
  }else{
    header("location: groups.php?dltGrpErr=Error occured while deleting the group.");
  }
  
  ?>
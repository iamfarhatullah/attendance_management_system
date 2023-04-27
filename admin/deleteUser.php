<?php  
  require_once("connection.php");
  
  $id = $_GET['id'];
  $sql = "DELETE FROM tbl_users WHERE user_ID='$id'";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    header("location: users.php?dltUser=1 user deleted.");
  }else{
    header("location: users.php?dltUserError=Error.");
  }
  
  ?>
<?php  
  require_once("connection.php");
  if (isset($_POST['submitCourse'])) {
  $department = mysqli_real_escape_string($conn, $_POST['department']);
  $subject = mysqli_real_escape_string($conn, ucwords(strtolower($_POST['subject'])));
  
  $sql_check = "SELECT * FROM tbl_subjects WHERE sub_departmentID='$department' and sub_name='$subject'";
  $checkResult = mysqli_query($conn, $sql_check);
          
  if (mysqli_num_rows($checkResult)==0) {

  $sql = "INSERT into tbl_subjects(sub_name,sub_departmentID)values('$subject','$department')";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    header("location: courses.php?addSub=Course added Successfully.");
  }else{
    header("location: courses.php?addSubError=Error.");
  }
}else{
    header("location: courses.php?addSubExist=The Course You Entered already exist.");
}

}
    
?>
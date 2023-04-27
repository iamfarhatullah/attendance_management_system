<?php 
    session_start();
    if (!isset($_SESSION["admin_username"])) {
    header("location: login.php");
    }
?>
<?php  
require_once("connection.php");
$sessionUsername = $_SESSION["admin_username"];

$sql = "SELECT * FROM tbl_admin 
INNER JOIN tbl_departments ON tbl_admin.admin_departmentID = tbl_departments.dep_ID 
WHERE admin_username='".$sessionUsername."'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $sessionName = $row['admin_name'];
    $sessionDepartmentID = $row['admin_departmentID'];
    $sessionDepartment = $row['dep_name'];
  }
}
$id = $_GET['id'];

$sqlSub = "SELECT * FROM tbl_groups 
INNER JOIN tbl_subjects ON tbl_groups.grp_subjectID = tbl_subjects.sub_ID
WHERE grp_ID='$id'";
$resultSub = mysqli_query($conn, $sqlSub);
$rowSub = mysqli_fetch_assoc($resultSub);
$sub_name = $rowSub['sub_name'];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title><?php echo "."; ?></title>		
<script src="js/jquery-3.2.1.min.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>﻿
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="font-awesome-5.3.1/css/all.css">
<style type="text/css">
#table, th, td{
	border-collapse: collapse;
	border: 1px solid #3d3d3d;
	padding: 2px;
}
#table .th{/*
	height: 100px;
	width: 5px;
	transform: rotate(270deg);*/
}
</style>
</head>
<body>
<div class="wrapper" style="margin-top: -20px;">
	
<!-- Page Content Holder -->
<div id="content" style="width: 100%;">

	<div class="container">
		<div class="header-box">
		<div class="row">
          <div class="col-md-12">
            <div class="page-title">
            	<h3 style="text-align: center;">
            		<i class="fa fa-user-check"> </i> <?php echo $sub_name; ?>
            		<span class="pull-right">
            			<!-- <button style="background-color: transparent; color: blue; text-decoration: underline; border: none;" onclick="myFunction()">Print this page</button> -->
              		</span>
          		</h3>
            </div>
            <hr>
          </div>
        </div>
        </div>
    </div>
    <div class="container">				
        <div class="content-box"> <!-- Page Contents -->
<center>
        	<table id="table">
	<tr>
		<th>S.No</th>
		<th>Name</th>
		<th>Roll no</th>
		

<?php  
require_once("connection.php");

$sqlDate = "SELECT att_date FROM tbl_attendance WHERE att_groupID='$id' GROUP by att_date ORDER by att_date ASC";

$resultDate = mysqli_query($conn, $sqlDate);

if (mysqli_num_rows($resultDate)>0) {
	while ($rowDate = mysqli_fetch_assoc($resultDate)) {
		$date = $rowDate['att_date'];
		$day = date("d",strtotime($date));
		$month = date("m",strtotime($date));
		$year = date("y",strtotime($date));
		echo "<th class='th' style='text-align: center; padding: 3px;'><p>".$day.'<br>'.$month.'<br>'.$year."</p></th>";
	}
}

?>
	</tr>

<?php 
require_once("connection.php");

$sql = "SELECT * FROM tbl_attendance 
INNER JOIN tbl_students ON tbl_attendance.att_studentID = tbl_students.std_ID   
WHERE att_groupID='$id'
group by att_studentID, std_ID ORDER by std_rollno";
$result = mysqli_query($conn, $sql);
$num = 1;
if (mysqli_num_rows($result)>0) {
	while ($rows = mysqli_fetch_assoc($result)) {
		$att_ID = $rows['att_ID'];
		$std_ID = $row['std_ID'];
		$fullname = $rows['std_name'];
		$classno = $rows['std_rollno'];
		echo "<tr>";
		echo "<td style='text-align:center;'>".$num."</td>";
		echo "<td>".$fullname."</td>";
		echo "<td style='text-align:center;'>".$classno."</td>";
		$sql1 = "SELECT * FROM tbl_attendance 
		INNER JOIN tbl_students ON tbl_attendance.att_studentID = tbl_students.std_ID
		WHERE tbl_students.std_name='$fullname' and att_groupID='$id'";
		$result1 = mysqli_query($conn, $sql1);
		
		if (mysqli_num_rows($result1)>0) {
			while ($rows1 = mysqli_fetch_assoc($result1)) {
				$status1 = $rows1['att_status'];
				if ($status1 == "") {
					echo "<td style='text-align:center;'>--</td>";
				}else{
				echo "<td style='text-align:center;'>".$status1."</td>";
				} 
			}
		}
		echo "<td style='text-align:center; display:none;'>
				<a href='stdAttendance.php?id=".$id."&rollno=".$classno."' title='Edit'><span class='fa fa-edit'></span></a>
			</td>";
		echo "<tr>";
		$num++;
	}
}



 ?>
	
</table>
</center>

<script>
function myFunction() {
  window.print();
}
</script>

		</div><!-- /Page Contents -->
	</div>
</div>
</div>


         <script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                     $('.to-hide').toggle();
                     $('[data-toggle="tooltip"]').tooltip();
                 });
             });
         </script>
<script>
	$(document).ready(function(){
    	//$('[data-toggle="tooltip"]').tooltip();   
	});
</script>
</body>
</html>
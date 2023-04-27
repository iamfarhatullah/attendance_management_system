<?php 
    session_start();
    if (!isset($_SESSION["user_username"])) {
        header("location: login.php");
    }
?>
<?php  
require_once("connection.php");
$sessionUsername = $_SESSION["user_username"];

$sql = "SELECT * FROM tbl_users 
INNER JOIN tbl_batch ON tbl_users.user_batchID = tbl_batch.bat_ID
INNER JOIN tbl_departments  ON tbl_users.user_departmentID = tbl_departments.dep_ID
INNER JOIN tbl_semesters ON tbl_users.user_semesterID = tbl_semesters.sem_ID
WHERE user_username='$sessionUsername'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		$sessionUserID = $row['user_ID'];
		$sessionBatchID = $row['user_batchID'];
		$sessionSemesterID = $row['user_semesterID'];
		$sessionDepartmentID = $row['user_departmentID'];
		
		$sessionName = $row['user_name'];
		$sessionBatch = $row['bat_name'];
		$sessionSemester = $row['sem_name'];
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
<div class="wrapper" style="margin-top: -20px; background-color: #EEE; width: 100%; height: 100%;">
	<nav id="sidebar" style="display: none;">
        <div class="main-nav-tab">
      <table class="user-panel">
        <tr>
          <td>
            <img class="img-circle img-responsive" width="50px" src="images/user.jpg">
          </td>
          <td>
            <h5 class="to-hide"><?php echo $sessionName; ?> <br><span>User</span></h5>
          </td>
        </tr>
      </table>
      </div>
		<ul class="sidebar-nav" style="display: none;">
			<li data-toggle="tooltip" data-placement="right" title="Dashboard">
				<a href="index.php">
					<i class="fa fa-tachometer-alt"></i>
					<span class="to-hide">Dashboard</span>
				</a>
			</li>
		    <li data-toggle="tooltip" data-placement="right" title="Attendance">
		    	<a href="attendance.php">
		    		<i class="fa fa-user-check"></i>
		    		<span class="to-hide">Attendance</span>
		    	</a>
		    </li>
			<li data-toggle="tooltip" data-placement="right" title="Create group">
				<a href="createGroup.php">
					<i class="fa fa-th-large"></i>
					<span class="to-hide">Create group</span>
				</a>
			</li>
			<li data-toggle="tooltip" data-placement="right" title="All groups">
				<a href="groups.php">
					<i class="fa fa-building"></i>
					<span class="to-hide">All groups</span>
				</a>
			</li>
			<li data-toggle="tooltip" data-placement="right" title="Students">
				<a href="students.php">
					<i class="fa fa-book-open"></i>
					<span class="to-hide">Students</span>
				</a>
			</li>
			<li data-toggle="tooltip" data-placement="right" title="Log out">
				<a href="logout.php">
					<i class="fa fa-sign-out-alt"></i>
					<span class="to-hide">Log out</span>
				</a>
			</li>
		</ul>
	</nav>
<!-- Page Content Holder -->
<div id="content" style="width: 100%;">
	<nav class="navbar" id="main-nav" style="display: none;">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
					<i class="glyphicon glyphicon-align-left"></i>
					<span><!-- Toggle Sidebar --></span>
				</button>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#" class="nav-links"><?php echo $sessionName; ?></a></li>
					<li><a href="logout.php" class="nav-links"><i class="fa fa-sign-out-alt"></i></a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="header-box">
		<div class="row">
          <div class="col-md-12">
            <div class="page-title">
            	<h3>
            		<i> </i> <?php echo $sub_name; ?>
            		<span class="pull-right">
            			<button style="background-color: transparent; color: blue; text-decoration: underline; border: none;" onclick="myFunction()">Print this page</button>
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
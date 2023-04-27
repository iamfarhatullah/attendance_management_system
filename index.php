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

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title>Dashboard - Attendance Management System</title>		
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
</head>
<body>
<div class="wrapper" style="margin-top: -20px; background-color: #EEE; width: 100%; height: 100%;">
	<nav id="sidebar">
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
		<ul class="sidebar-nav">
			<li data-toggle="tooltip" data-placement="right" title="Dashboard">
				<a href="index.php" class="active-sidebar-link">
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
			<li data-toggle="tooltip" data-placement="right" title="Groups">
				<a href="groups.php">
					<i class="fa fa-th-large"></i>
					<span class="to-hide">Groups</span>
				</a>
			</li>
			<li data-toggle="tooltip" data-placement="right" title="Students">
				<a href="students.php">
					<i class="fa fa-user-graduate"></i>
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
	<nav class="navbar" id="main-nav">
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
	<div class="container-fluid">
		<div class="header-box">
		<div class="row">
          <div class="col-md-12">
            <div class="page-title">
              <h3><i class="fa fa-tachometer-alt"></i> Dashboard <span></span></h3>
            </div>
            <hr>
          </div>
        </div>
        </div>
    </div>
    <div class="container-fluid">				
        <div class="content-box"> <!-- Page Contents -->
<?php
    require_once("connection.php");
    $sql= " SELECT count(bat_ID) AS total FROM tbl_batch";
    $result = mysqli_query($conn, $sql);
    $values = mysqli_fetch_assoc($result);
    $totalBatches = $values['total'];
?>

<?php
    require_once("connection.php");
    $sql= " SELECT count(user_ID) AS total FROM tbl_users";
    $result = mysqli_query($conn, $sql);
    $values = mysqli_fetch_assoc($result);
    $totalUsers = $values['total'];
?>

<?php
    require_once("connection.php");
    $sql= " SELECT count(grp_ID) AS total FROM tbl_groups WHERE grp_userID='$sessionUserID'";
    $result = mysqli_query($conn, $sql);
    $values = mysqli_fetch_assoc($result);
    $totalGroups = $values['total'];
?>

<?php
    require_once("connection.php");
    $sql= " SELECT count(std_ID) AS total FROM tbl_students WHERE std_departmentID='$sessionDepartmentID' and std_batchID='$sessionBatchID' and std_semesterID='$sessionSemesterID'";
    $result = mysqli_query($conn, $sql);
    $values = mysqli_fetch_assoc($result);
    $totalStudents = $values['total'];
?>

        	<!-- <div class="row">
	          <div class="col-md-6 col-sm-6">
	               <div class="widgets">
	                <span class="widgets-span-danger fa fa-2x fa-th-large"></span>
	                <h3 style="color: #95a0a2; padding-bottom: 5px; border-bottom: 1px solid #ddd"><?php echo $totalBatches; ?> Batches</h3>
	              </div>
	          </div>
	        	<div class="col-md-6 col-sm-6">
	               <div class="widgets">
	                <span class="widgets-span-success fa fa-2x fa-building"></span>
	                <h3 style="color: #95a0a2; padding-bottom: 5px; border-bottom: 1px solid #ddd"><?php echo $totalDepartments; ?> Departments</h3>
	              </div>
	          </div>-->
	          <div class="col-md-6 col-sm-6">
	               <div class="widgets">
	                <span class="widgets-span-warning fa fa-2x fa-th-large"></span>
	                <h3 style="color: #95a0a2; padding-bottom: 5px; border-bottom: 1px solid #ddd"><?php echo $totalGroups; ?> Groups</h3>
	              </div>
	          </div>
	          <div class="col-md-6 col-sm-6">
	              <div class="widgets">
	                <span class="widgets-span-primary fa fa-2x fa-user-graduate"></span>
	                <h3 style="color: #95a0a2; padding-bottom: 5px; border-bottom: 1px solid #ddd"><?php echo $totalStudents; ?> Students</h3>
	              </div>
	          </div>
	        </div> 
	        <div class="">
	        	<div class="col-md-6 col-sm-12 col-xs-12">
<?php
require_once("connection.php");
    $sql = "SELECT * FROM tbl_students 
    INNER JOIN tbl_batch ON tbl_batch.bat_ID = tbl_students.std_batchID 
    INNER JOIN tbl_departments ON tbl_departments.dep_ID = tbl_students.std_departmentID
    INNER JOIN tbl_semesters ON tbl_semesters.sem_ID = tbl_students.std_semesterID
    WHERE std_batchID IN (SELECT bat_name FROM tbl_batch WHERE bat_ID='1') and 
    std_departmentID='1' 
    ORDER by std_rollno asc";
    $result = mysqli_query($conn, $sql);
    $num = 1;
    if (mysqli_num_rows($result) > 0) {
        $dataPoints = array();
        while ($row = mysqli_fetch_assoc($result)) {
        	$id = $row['std_ID'];
        	$fullname = $row['std_name'];
        	$fathername = $row['std_fathername'];
        	$batch = $row['bat_name'];
        	$rollno = $row['std_rollno'];
        	$department = $row['dep_name'];
        	$semester = $row['sem_name'];
            $num++;
            array_push($dataPoints, array("y" => $id, "label" => $fullname ));

        }
    }else{
        echo "Nothing to show...";
    } 
 
?>
					<!-- <div id="chartContainer" style="height: 280px; width: auto; overflow-x: scroll;"></div> -->
	        	</div>
	        </div>

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
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Students Attendance"
	},
	axisY: {
		title: "Students Attendance Graph"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## ",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>
</html>
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
$todayDate = date("Y-m-d");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title>Take Attendance - Attendance Management System</title>		
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
<script type="text/javascript">
    function addDate() {
      var submitDate = document.getElementById('submitDate');
      var datePicker = document.getElementById('datePicker');
      submitDate.value = datePicker.value;
      
    }
    function checkDate(){
    	addDate();
    	//var myDate = document.getElementById('datePicker').value;
    	var myDate = document.form.datePicker.value;
    	var dataString ='name='+datePicker;
    	$.ajax({
    		type: "post",
    		url: "checkDate.php",
    		data: myDate,
    		cache:false,
    		success: function(html){
    			$('#msg').html(html);
    		}
    	});
    	return false;
    }
   </script>
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
				<a href="index.php">
					<i class="fa fa-tachometer-alt"></i>
					<span class="to-hide">Dashboard</span>
				</a>
			</li>
		    <li data-toggle="tooltip" data-placement="right" title="Attendance">
		    	<a href="attendance.php" class="active-sidebar-link">
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
    </div>
    <div class="container-fluid">				
        <div class="content-box"> <!-- Page Contents -->
        <div class="row">
        	<div class="col-md-12">
        		<div style="border-bottom: 2px solid #ddd; margin-bottom: 15px;">
        		</div>
        	</div>
        </div>	
<?php  
$sqlCount= " SELECT count(std_ID) AS total FROM tbl_students 
WHERE std_batchID='$sessionBatchID' and std_departmentID='$sessionDepartmentID' and std_semesterID='$sessionSemesterID'";
$resultCount = mysqli_query($conn, $sqlCount);
$values = mysqli_fetch_assoc($resultCount);
$totalStudents = $values['total'];

$groupID = $_GET['id'];
$selectedDate = $_GET['selectedDate'];

require_once("connection.php");
$sql = "SELECT * FROM tbl_students  
INNER JOIN tbl_batch ON tbl_students.std_batchID = tbl_batch.bat_ID
WHERE std_batchID='$sessionBatchID' and std_departmentID='$sessionDepartmentID' and std_semesterID='$sessionSemesterID' ORDER By std_rollno";
$result = mysqli_query($conn, $sql);
$num = 1;
echo "<form method='post' name='form' action='submitAttendance.php?totalStudents=".$totalStudents."&id=".$groupID."'>";
echo "<div class='col-md-12'>";
echo "<label>Selected Date: </label>";
echo "<input type='date' style='background-color: transparent; border:none;' id='submitDate' name='submitDate' value='".$selectedDate."' readonly>";
echo "<input class='submit-btn pull-right' style='margin-bottom:20px; margin-top:-10px;' type='submit' value='Submit Data'>";
echo "</div>";
if (mysqli_num_rows($result)>0) {
	while ($row = mysqli_fetch_assoc($result)) {
		$std_ID = $row['std_ID'];
		$std_name = $row['std_name'];
		$std_rollno = $row['std_rollno'];
		$bat_name = $row['bat_name'];

if ($num % 2 == 0) {
	$evenOdd = "record-set-odd";
}else{
	$evenOdd = "record-set-even";
}
		echo '<div class="row">
        	<div class="col-md-12 col-sm-12">
        		<div class="record-set '.$evenOdd.'">
        			<div class="row">
        				<div class="col-md-1 col-sm-1 col-xs-1">
        					<p style="padding-top: 10px;">'.$num.'</p>
        				</div>
        				<div class="col-md-1 col-sm-2 col-xs-2">
        					<div class="">
        						<img src="images/user1.jpg" class="img-responsive img-circle">
        					</div>
        				</div>
        				<div class="col-md-6 col-sm-5 col-xs-4">
        					<h4>'.$std_name.' <br> <span style="font-size: 14px;">'.$bat_name.'-'.$std_rollno.'</span></h4>
        					<input type="hidden" name="studentID'.$num.'" value="'.$std_ID.'">
        					<input type="hidden" name="groupID'.$num.'" value="'.$groupID.'">
        				</div>
        				<div class="col-md-4 col-sm-4 col-xs-5" style="padding-top: 15px;">
	        				<div class="pull-right">
	        					<label class="radio-box" style="padding-right: 20px;">P
	  							<input type="radio" checked="checked" value="P" name="status'.$num.'">
	  							<span class="checkmark"></span>
							</label>
							<label class="radio-box">A
	  							<input type="radio" value="A" name="status'.$num.'">
	  							<span class="checkmark"></span>
							</label>
	        				</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>';
        $num++;

	}
}

			//echo '<input type="submit" id="submitFormData" value="Submit Data" />';
            echo "</form>";
?>
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
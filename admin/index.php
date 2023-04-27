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

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title>Dashboard - Attendance Management System</title>		
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>﻿
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/script.js"></script>
<link rel="stylesheet" href="../css/style.css" type="text/css">
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.css">
<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="../font-awesome-5.3.1/css/all.css">
</head>
<body>
<div class="wrapper" style="margin-top: -20px; background-color: #EEE; width: 100%; height: 100%;">
	<nav id="sidebar">
        <div class="main-nav-tab">
      <table class="user-panel">
        <tr>
          <td>
            <img class="img-circle img-responsive" width="50px" src="../images/user.jpg">
          </td>
          <td>
            <h5 class="to-hide"><?php echo $sessionName; ?> <br><span>Administrator</span></h5>
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
			<li data-toggle="tooltip" data-placement="right" title="Courses">
				<a href="courses.php">
					<i class="fa fa-book-open"></i>
					<span class="to-hide">Courses</span>
				</a>
			</li>
			<li data-toggle="tooltip" data-placement="right" title="Students">
				<a href="students.php">
					<i class="fa fa-user-graduate"></i>
					<span class="to-hide">Students</span>
				</a>
			</li>
			<li data-toggle="tooltip" data-placement="right" title="Users">
				<a href="users.php">
					<i class="fa fa-users"></i>
					<span class="to-hide">Users</span>
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
<?php
    require_once("connection.php");
    $sql= " SELECT count(sub_ID) AS total FROM tbl_subjects WHERE sub_departmentID='$sessionDepartmentID'";
    $result = mysqli_query($conn, $sql);
    $values = mysqli_fetch_assoc($result);
    $totalCourses = $values['total'];
?>

<?php
    require_once("connection.php");
    $sql= " SELECT count(user_ID) AS total FROM tbl_users WHERE user_departmentID='$sessionDepartmentID'";
    $result = mysqli_query($conn, $sql);
    $values = mysqli_fetch_assoc($result);
    $totalUsers = $values['total'];
?>


<?php
    require_once("connection.php");
    $sql= " SELECT count(std_ID) AS total FROM tbl_students WHERE std_departmentID='$sessionDepartmentID'";
    $result = mysqli_query($conn, $sql);
    $values = mysqli_fetch_assoc($result);
    $totalStudents = $values['total'];
?>
    <div class="container-fluid">				
        <div class="content-box"> <!-- Page Contents -->
	        <div class="row">
	        	<div class="col-md-4 col-sm-6">
	              <div class="widgets">
	                <span class="widgets-span-primary fa fa-2x fa-user-graduate"></span>
	                <h3 style="color: #95a0a2; padding-bottom: 5px; border-bottom: 1px solid #ddd"><?php echo $totalStudents; ?> Students</h3>
	              </div>
	          </div>
	          <div class="col-md-4 col-sm-6">
	               <div class="widgets">
	                <span class="widgets-span-danger fa fa-2x fa-book-open"></span>
	                <h3 style="color: #95a0a2; padding-bottom: 5px; border-bottom: 1px solid #ddd"><?php echo $totalCourses; ?> Courses</h3>
	              </div>
	          </div>
	          <div class="col-md-4 col-sm-6">
	               <div class="widgets">
	                <span class="widgets-span-warning fa fa-2x fa-users"></span>
	                <h3 style="color: #95a0a2; padding-bottom: 5px; border-bottom: 1px solid #ddd"><?php echo $totalUsers; ?> Users</h3>
	              </div>
	          </div>
	        </div>
             
<?php  
	require_once("connection.php"); 
 $query = "SELECT *, count(*) as number FROM tbl_students 
 INNER JOIN tbl_semesters ON tbl_students.std_semesterID = tbl_semesters.sem_ID
 WHERE std_departmentID='$sessionDepartmentID'
 GROUP BY sem_ID";  
 $result = mysqli_query($conn, $query);  
 ?> 
           <div class="row">
           	<div class="col-md-8 col-sm-12 col-xs-12">    
                <div id="piechart" style="width: 100%; height: 300px; border: 1px solid #ccc; box-shadow: 3px 3px 5px #ccc;"></div>  
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Gender', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["sem_name"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Percentage of Students in different semesters',  
                      //is3D:true,  
                      pieHole: 0.4  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
           </script>
</body>
</html>
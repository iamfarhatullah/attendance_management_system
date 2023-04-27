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
$todayDate = date("Y-m-d");

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title>Select Date - Attendance Management System</title>		
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
			<p></p>
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
              <h3><i class="fa fa-calendar"></i> Select Date <span></span></h3>
            </div>
            <hr>
          </div>
        </div>
        </div>
    </div>
    <div class="container-fluid">				
        <div class="content-box"> <!-- Page Contents -->
        	<?php 
        		if (isset($_GET['selectedDateTaken'])) {
        			$msg = $_GET['selectedDateTaken'];
        			echo "<div class='callout callout-primary'>";
        			echo "<p>".$msg."</p>";
        			echo "</div>";
        			echo "<br>";
        		}
        	 ?>
        	<div class="row">
        	  <div class="col-md-12 col-sm-12 col-xs-12">
			    <div class="setup-box"> 
			      <h3 class="box-title">Select date for attendance</h3>
			        <form action="checkDate.php" method="post">
			        	<input type="hidden" name="id" value="<?php echo $id; ?>">
			        	<input type="hidden" name="name" value="<?php echo $name; ?>">
			          <div class="row">
			            <div class="col-md-4 col-sm-8">
			              <label>Select date</label>
			          <input type="date" class="setup-input" value="<?php echo $todayDate; ?>" name="selectedDate" required>
			            </div>
			            <div class="col-md-4 col-sm-4">
			              <input type="submit" value="Select Date" class="submit-btn" name="submitDate">
			            </div>
			          </div>
			        </form>
			    </div>          
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
</body>
</html>
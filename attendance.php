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
<title>Attendance - Attendance Management System</title>		
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
		<div class="header-box">
		<div class="row">
          <div class="col-md-12">
            <div class="page-title">
              <h3><i class="fa fa-user-check"></i> Attendance <span></span></h3>
            </div>
            <hr>
          </div>
        </div>
        </div>
    </div>
    <div class="container-fluid">				
        <div class="content-box"> <!-- Page Contents -->
          <?php 
            if (isset($_GET['selectedDate'])) {
              $msg = $_GET['selectedDate'];
              echo "<div class='callout callout-primary'>";
              echo "<p>".$msg."</p>";
              echo "</div>";
              echo "<br>";
            }
           ?>
        	<div class="setup-box">
          <div class="row">
          <div class="col-md-12">
              <h3 class="box-title">Attendance Groups <a href="groups.php" class="btn btn-success btn-xs pull-right"><i class="fa fa-plus"></i> Create new</a></h3>
              <?php  
              require_once("connection.php");
              $sql = "SELECT * FROM tbl_groups 
              INNER JOIN tbl_subjects ON tbl_groups.grp_subjectID = tbl_subjects.sub_ID 
              WHERE grp_userID='$sessionUserID'";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $id = $row['grp_ID'];
                  $groupname = $row['grp_name'];
                  $course = $row['sub_name'];

                  echo '<div class="col-md-6 col-sm-12 col-xs-12">
                <div class="group-box">
                  <table>
                    <tr>
                      <td class="hidden-xs">
                        <i class="fa fa-users g-icon"></i>  
                      </td>
                      <td>
                        <h4 class="ellipse">'.$groupname.'</h4>
                        <p class="ellipse">'.$course.'</p>
                        <a style="color: #84ba3f; font-weight:600;" href="selectDate.php?id='.$id.'" class="">Take Attendance</a>
                        <a style="color: #363636" href="pdf/?groupID='.$id.'" target="_blank" class="">View Attendance</a>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>';
                }
              }else{
                echo "<div class='callout callout-default'>";
                echo "No groups available!";
                echo "</div>";
                echo "<br>";
              }
              ?>

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
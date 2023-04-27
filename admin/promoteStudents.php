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
<title>Promote Students - Attendance Management System</title>		
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
			<li data-toggle="tooltip" data-placement="right" title="Courses">
				<a href="courses.php">
					<i class="fa fa-book-open"></i>
					<span class="to-hide">Courses</span>
				</a>
			</li>
			<li data-toggle="tooltip" data-placement="right" title="Students">
				<a href="students.php" class="active-sidebar-link">
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
        <div class="content-box"> <!-- Page Contents -->


<div class="row">
  <div class="col-md-12">
    <?php  
    if (isset($_GET['sem'])) {
      $sem = $_GET['sem'];
      echo "<div class='callout callout-success'>";
      echo "<p>".$sem."</p>";
      echo "</div>";
      echo "<br>";
    }
    ?>
    <div class="setup-box"> 
            <?php  
              $bat_ID = $_GET['id'];

              $sqlCount= " SELECT count(std_ID) AS total FROM tbl_students 
              WHERE std_batchID='$bat_ID' and std_departmentID='$sessionDepartmentID'";
              $resultCount = mysqli_query($conn, $sqlCount);
              $values = mysqli_fetch_assoc($resultCount);
              $totalStudents = $values['total'];
            ?>

              <?php  
              require_once("connection.php");
              
              $sql = "SELECT * FROM tbl_students 
              INNER JOIN tbl_batch ON tbl_students.std_batchID = tbl_batch.bat_ID
              INNER JOIN tbl_departments ON tbl_students.std_departmentID = tbl_departments.dep_ID 
              INNER JOIN tbl_semesters ON tbl_students.std_semesterID = tbl_semesters.sem_ID 
              WHERE std_departmentID='$sessionDepartmentID' and std_batchID='$bat_ID'
              ORDER by std_semesterID asc, std_rollno asc";
              $result = mysqli_query($conn, $sql);
              $num = 1;
              echo "<form method='post' name='form' action='submitPromotion.php?totalStudents=".$totalStudents."&bat_ID=".$bat_ID."'>";
              echo '<div class="box-title">';
              echo '<label>Select Semester to promote students</label>
            <select name="newSemester" class="" required>
            <option value="">Select Semester</option>';
              
              require_once("connection.php");
              $sql = "SELECT * FROM tbl_semesters";
              $semResult = mysqli_query($conn, $sql);
              if (mysqli_num_rows($semResult) > 0) {
                while ($row = mysqli_fetch_assoc($semResult)) {
                  $sem_ID = $row['sem_ID'];
                  $semester = $row['sem_name'];
                  echo "<option value='".$sem_ID."'>".$semester."</option>";
                }
              }
              else{
                echo "Not available";
              }              
              echo '</select>';
              echo '<input type="submit" name="promoteStd" class="submit-btn" value="Promote">';
              echo "</div>";
              if (mysqli_num_rows($result) > 0) {
                echo '<div class="table-responsive"> 
              <table id="mytable" class="table table-bordred table-striped">    
                <thead>   
                  <th>S.No</th>
                  <th>Name</th>
                  <th>F/Name</th>
                  <th>Class #</th>
                  <th>Semester</th>
                </thead>
              <tbody>';
                while ($row = mysqli_fetch_assoc($result)) {
                  $std_ID = $row['std_ID'];
                  $fullname = $row['std_name'];
                  $fathername = $row['std_fathername'];
                  $batch = $row['bat_name'];
                  $rollno = $row['std_rollno'];
                  $department = $row['dep_name'];
                  $semester = $row['sem_name'];
                  echo "<tr>";
                  echo "<td>".$num."</td>";
                  echo "<td>".$fullname."</td>";
                  echo "<td>".$fathername."</td>";
                  echo "<input type='hidden' value='".$std_ID."' name='studentID".$num."'>";
                  echo "<td style='text-transform:uppercase;'>".$batch.'-'.$rollno."</td>";
                  echo "<input type='hidden' value='".$semester."' name='oldSemester".$num."'>";
                  echo "<td>".$semester."</td>";
                  echo "</tr>";
                  $num++;
                }
                echo '</tbody>
          </table>
        </div>
         </form>';
              }else{
                echo "<div class='callout callout-default'>";
                echo "Nothing to show";
                echo "</div>";
                echo "<br>";
              }
              ?>
          
    </div>      
  </div>
          </div>

       		<!--  -->

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
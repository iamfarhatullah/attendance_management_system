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
<title>Edit Student - Attendance Management System</title>		
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
		<div class="header-box">
		<div class="row">
          <div class="col-md-12">
            <div class="page-title">
              <h3><i class="fa fa-pencil-alt"></i> Edit Student <span></span></h3>
            </div>
            <hr>
          </div>
        </div>
        </div>
    </div>
<?php 
	require_once("connection.php");							
	$id = $_GET['id'];	
	$sql="SELECT * FROM tbl_students 
  INNER JOIN tbl_batch ON tbl_students.std_batchID = tbl_batch.bat_ID
  INNER JOIN tbl_departments ON tbl_students.std_departmentID = tbl_departments.dep_ID
  INNER JOIN tbl_semesters ON tbl_students.std_semesterID = tbl_semesters.sem_ID 
  WHERE std_ID=$id";
	$result = mysqli_query($conn,$sql) or die(mysqli_error());
	if (mysqli_num_rows($result)>0){
		$response= array();
		$row=mysqli_fetch_array($result);
    	$id = $row['std_ID'];
    	$fullname = $row['std_name'];
    	$fathername = $row['std_fathername'];
    	$batch = $row['bat_name'];
    	$rollno = $row['std_rollno'];
    	$department = $row['dep_name'];
      $semester = $row['sem_name'];
    	
	} 
 
 ?>

 <div class="container-fluid">        
  <div class="content-box"> <!-- Page Contents -->
    <div class="row">
  <div class="col-md-12">
    <?php 
        if (isset($_GET['updMsgErr'])) {
          $subMsg = $_GET['updMsgErr'];
          echo "<div class='callout callout-danger'>";
          echo "<p>".$subMsg."</p>";
          echo "</div>";
          echo "<br>";
        }elseif (isset($_GET['updMsgExists'])) {
          $subMsg = "The Roll No & Batch you entered already exists";
          echo "<div class='callout callout-warning'>";
          echo "<p>".$subMsg."</p>";
          echo "</div>";
          echo "<br>";
        }
?>
    <div class="setup-box"> 
      <h3 class="box-title">Edit Student`s data</h3>
        <form action="updateStudent.php" method="post">
          <div class="row">
            <div class="col-md-3 col-sm-6">
              <label>Name</label><br>
              <input type="hidden" name="id" value="<?php echo $id;  ?>">
              <input type="text" value="<?php echo $fullname;  ?>" class="setup-input" name="fullname" placeholder="Student Name" required>
            </div>
            <div class="col-md-3 col-sm-6">
              <label>Father Name</label><br>
              <input type="text" value="<?php echo $fathername;  ?>" class="setup-input" name="fathername" placeholder="Father Name" required>
            </div>
            <div class="col-md-3 col-sm-6">
              <label>Roll No</label><br>
              <input type="text" value="<?php echo $rollno;  ?>" class="setup-input" name="rollno" placeholder="Roll No" required>
            </div>
            <div class="col-md-3 col-sm-6">
              <label>Select batch</label><br>
              <select class="setup-input" name="batch" required>
                <option value="">Batch</option>
              <?php  
              require_once("connection.php");
              $sql = "SELECT * FROM tbl_batch";
              $batchResult = mysqli_query($conn, $sql);
              if (mysqli_num_rows($batchResult) > 0) {
                while ($row = mysqli_fetch_assoc($batchResult)) {
                  $bat_ID = $row['bat_ID'];
                  $batchno = $row['bat_name'];
                  echo "<option value='".$bat_ID."'>".$batchno."</option>";
                }
              }
              else{
                echo "Not available";
              }              
            ?>
            </select>
            </div>
            
          </div>
          <div class="row">
            <div class="col-md-3 col-sm-6" style="display: none;">
              <label>Select department</label><br>
                <select name="department" class="setup-input" required readonly>
                  <option value="<?php echo $sessionDepartmentID ?>"><?php echo $sessionDepartment; ?></option>
                </select>
            </div>
            <div class="col-md-3 col-sm-6">
              <label>Select Semester</label><br>
              <select name="semester" class="setup-input" required>
                <option value="">Select Semester</option>
                <?php  
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
            ?>
              </select>
            </div>
            <div class="col-md-2 col-sm-6">
              <input type="submit" class="submit-btn" name="submitStudent">    
            </div>
          </div>
          
        </form>
      <?php if (isset($_GET['addStd'])) {
        $addStd = $_GET['addStd'];
          echo "<p>".$addStd."</p>";
        }
      ?>
    </div>     
  </div>
</div>

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
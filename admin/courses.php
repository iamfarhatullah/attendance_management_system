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
<title>Courses - Attendance Management System</title>		
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
				<a href="courses.php" class="active-sidebar-link">
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
              <h3><i class="fa fa-book-open"></i> Courses <span></span></h3>
            </div>
            <hr>
          </div>
        </div>
        </div>
    </div>
    <div class="container-fluid">				
        <div class="content-box"> <!-- Page Contents -->

          <div class="row">
  <div class="col-md-12">
    <?php if (isset($_GET['addSub'])) {
        $subMsg = $_GET['addSub'];
          echo "<div class='callout callout-success'>";
          echo "<p>".$subMsg."</p>";
          echo "</div>";
          echo "<br>";
        }elseif (isset($_GET['addSubError'])) {
          $subMsg = $_GET['addSubError'];
          echo "<div class='callout callout-danger'>";
          echo "<p>".$subMsg."</p>";
          echo "</div>";
          echo "<br>";
        }elseif (isset($_GET['addSubExist'])) {
          $subMsg = $_GET['addSubExist'];
          echo "<div class='callout callout-warning'>";
          echo "<p>".$subMsg."</p>";
          echo "</div>";
          echo "<br>";
        }elseif (isset($_GET['updMsg'])) {
          $subMsg = $_GET['updMsg'];
          echo "<div class='callout callout-success'>";
          echo "<p>".$subMsg."</p>";
          echo "</div>";
          echo "<br>";
        }
      ?>
    <div class="setup-box"> 
      <h3 class="box-title">Add Course</h3>
        <form action="addCourse.php" method="post">
          <div class="row">
            <div class="col-md-4 col-sm-4" style="display: none;">
              <label>Select Department</label><br>
          <select name="department" class="setup-input" required readonly>
            <option value="<?php echo $sessionDepartmentID ?>"><?php echo $sessionDepartment; ?></option>
          </select>
            </div>
            <div class="col-md-6 col-sm-8">
              <label>Course Name</label><br>
              <input type="text" class="setup-input" name="subject" placeholder="Course Name" required>    
            </div>
            <div class="col-md-2 col-sm-4">
              <input type="submit" value="Submit" class="submit-btn" name="submitCourse">    
            </div>
          </div>
          
        </form>
      
    </div>     
  </div>
</div>

	   	<div class="setup-box">
          <div class="row">
          <div class="col-md-12">
              <h3 class="box-title">Courses</h3>
              <?php  
              require_once("connection.php");
              $sql = "SELECT * FROM tbl_subjects 
              INNER JOIN tbl_departments ON tbl_subjects.sub_departmentID = tbl_departments.dep_ID 
              WHERE sub_departmentID='$sessionDepartmentID'
              order by sub_name";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                echo '<div class="table-responsive"> 
              <table id="mytable" class="table table-bordred table-striped">    
                <thead>   
                  <th>S.No</th>
                  <th>Course Name</th>
                  <th>Action</th>
                </thead>
              <tbody>';
                $num = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                  $sub_ID = $row['sub_ID'];
                  $subject = $row['sub_name'];
                  $department = $row['dep_name'];
                  echo "<tr>";
                  echo "<td>".$num."</td>";
                  echo "<td>".$subject."</td>";
                  echo "<td><a href='editCourse.php?id=".$sub_ID."' class='btn btn-primary btn-xs'><i class='fa fa-pencil-alt'></i></a></td>";
                  echo "</tr>";
                  $num++;
                }
                echo '</tbody>
          </table>
        </div>';
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
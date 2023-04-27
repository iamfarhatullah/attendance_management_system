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
<title>Students - Attendance Management System</title>		
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
              <h3><i class="fa fa-user-graduate"></i> Students <span></span></h3>
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
    <?php if (isset($_GET['addStd'])) {
        $stdMsg = $_GET['addStd'];
          echo "<div class='callout callout-success'>";
          echo "<p>".$stdMsg."</p>";
          echo "</div>";
          echo "<br>";
        }elseif (isset($_GET['addStdError'])) {
          $stdMsg = $_GET['addStdError'];
          echo "<div class='callout callout-danger'>";
          echo "<p>".$stdMsg."</p>";
          echo "</div>";
          echo "<br>";
        }elseif (isset($_GET['addStdExist'])) {
          $stdMsg = $_GET['addStdExist'];
          echo "<div class='callout callout-warning'>";
          echo "<p>".$stdMsg."</p>";
          echo "</div>";
          echo "<br>";
        }elseif (isset($_GET['updMsg'])) {
          $stdMsg = $_GET['updMsg'];
          echo "<div class='callout callout-success'>";
          echo "<p>".$stdMsg."</p>";
          echo "</div>";
          echo "<br>";
        }elseif (isset($_GET['updMsgErr'])) {
          $stdMsg = $_GET['updMsgErr'];
          echo "<div class='callout callout-danger'>";
          echo "<p>".$stdMsg."</p>";
          echo "</div>";
          echo "<br>";
        }elseif (isset($_GET['dltStudent'])) {
          $stdMsg = $_GET['dltStudent'];
          echo "<div class='callout callout-primary'>";
          echo "<p>".$stdMsg."</p>";
          echo "</div>";
          echo "<br>";
        }elseif (isset($_GET['dltStudentError'])) {
          $stdMsg = $_GET['dltStudentError'];
          echo "<div class='callout callout-danger'>";
          echo "<p>".$stdMsg."</p>";
          echo "</div>";
          echo "<br>";
        }
      ?>
    <div class="setup-box"> 
      <h3 class="box-title">Add Student</h3>
        <form action="addStudent.php" method="post">
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <label>Name</label><br>
              <input type="text" class="setup-input" name="fullname" placeholder="Student Name" required>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <label>Father Name</label><br>
              <input type="text" class="setup-input" name="fathername" placeholder="Father Name" required>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <label>Roll No</label><br>
              <input type="text" class="setup-input" name="rollno" placeholder="Roll No" required>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <label>Batch</label><br>
              <select class="setup-input" name="batch">
                <option value="">Select Batch</option>
              <?php  
              require_once("connection.php");
              $sql = "SELECT * FROM tbl_batch";
              $batchResult = mysqli_query($conn, $sql);
              if (mysqli_num_rows($batchResult) > 0) {
                while ($row = mysqli_fetch_assoc($batchResult)) {
                  $bat_ID = $row['bat_ID'];
                  $bat_name = $row['bat_name'];
                  echo "<option value='".$bat_ID."'>".$bat_name."</option>";
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
            <div class="col-md-3 col-sm-6 col-xs-12" style="display: none;">
              <label>Select Department</label><br>
                <select name="department" class="setup-input" required>
            <option value="<?php echo $sessionDepartmentID ?>"><?php echo $sessionDepartment; ?></option>
          </select>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
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
            <div class="col-md-2 col-sm-6 col-xs-12">
              <input type="submit" value="Submit" class="submit-btn" name="submitStudent">    
            </div>
          </div>
          
        </form>
      
    </div>     
  </div>
</div>


<div class="row">
  <div class="col-md-12">
    <div class="setup-box"> 
      <h3 class="box-title">Students <a href="selectBatch.php" class="btn btn-success btn-xs pull-right">Promote Students</a></h3>           
              <?php  
              require_once("connection.php");
              
              $sql = "SELECT * FROM tbl_students 
              INNER JOIN tbl_batch ON tbl_students.std_batchID = tbl_batch.bat_ID
              INNER JOIN tbl_departments ON tbl_students.std_departmentID = tbl_departments.dep_ID 
              INNER JOIN tbl_semesters ON tbl_students.std_semesterID = tbl_semesters.sem_ID 
              WHERE std_departmentID='$sessionDepartmentID'
              ORDER by std_semesterID asc, std_rollno asc";
              $result = mysqli_query($conn, $sql);
              $num = 1;
              if (mysqli_num_rows($result) > 0) {
                echo '<div class="table-responsive"> 
              <table id="mytable" class="table table-bordred table-striped">    
                <thead>   
                  <th>S.No</th>
                  <th>Name</th>
                  <th>F/Name</th>
                  <th>Class #</th>
                  <th>Semester</th>
                  <th>Action</th>
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
                  echo "<td style='text-transform:uppercase;'>".$batch.'-'.$rollno."</td>";
                  echo "<td>".$semester."</td>";
                  echo "<td>&nbsp;
                  <a href='deleteStudent.php?id=".$std_ID."' onclick='return confirmDelete()' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i></a>
                  <a href='editStudent.php?id=".$std_ID."' class='btn btn-info btn-xs'><i class='fa fa-pencil-alt'></i></a>
                  </td>";
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


      <!--     <div class="row"> 
            <div class="col-md-12">
              <div class="setup-box">
                <h3 class="box-title">Semesters</h3>
                <div class="row">
                  
<?php 
require_once("connection.php");
$sql = "SELECT * FROM tbl_semesters";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result)>0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $sem_ID = $row['sem_ID'];
    $sem_name = $row['sem_name'];

    $sql1= " SELECT count(std_ID) AS total FROM tbl_students 
    INNER JOIN tbl_semesters ON tbl_students.std_semesterID = tbl_semesters.sem_ID
    WHERE std_semesterID='$sem_ID' and std_departmentID='$sessionDepartmentID'";
    $result1 = mysqli_query($conn, $sql1);
    $values = mysqli_fetch_assoc($result1);
    $totalStudents = $values['total'];
    $str = strval($totalStudents);
    if ($str>0) {
      $pageLink = '<a href="viewStudents.php?id='.$sem_ID.'" class="">View students</a>';
    }else{
      $pageLink = '<a href="setup.php" class="">Click here to add student</a>';
    }
    echo '<div class="col-md-3 col-sm-12 col-xs-12">
                <div class="group-box">
                  <table>
                    <tr>
                      <td>
                        <i class="fa fa-building g-icon"></i>  
                      </td>
                      <td>
                        <h4>'.$sem_name.' Semester</h4>
                        <p>Total Students '.$totalStudents++.'</p>
                        '.$pageLink.'
                      </td>
                    </tr>
                  </table>
                </div>
              </div>';
  }
}
?>
                  

                </div>
              </div>
            </div>
          </div> -->
<style type="text/css">
.group-box{
  background-color: #fff;
  border: 1px solid #ccc;
  margin-bottom: 20px;
  padding: 20px 10px 20px 10px;
}
.group-box h4{
  font-weight: 600;
  /*color: #84ba3f;*/
  color: #337ab7;
}
.group-box p{
  font-weight: 600;
  margin-top: -10px;
  color: #808080;
}
.group-box a{
  font-weight: 500;
  color: #337ab7;
}
.g-icon{
  color: #fff;
  /*background-color: #84ba3f;*/
  background-color: #337ab7;
  padding: 23px 22px;
  margin-right: 20px;
  margin-left: 10px;
  font-size: 32px;
  box-shadow: 3px 3px 5px #ccc;
}
</style>
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
  function confirmDelete() {
  return confirm("Are you sure you want to delete this Student?");
}
	$(document).ready(function(){
    	//$('[data-toggle="tooltip"]').tooltip();   
	});
</script>
</body>
</html>
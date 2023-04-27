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
<title>Users - Attendance Management System</title>		
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
				<a href="students.php">
					<i class="fa fa-user-graduate"></i>
					<span class="to-hide">Students</span>
				</a>
			</li>
			<li data-toggle="tooltip" data-placement="right" title="Users">
				<a href="users.php" class="active-sidebar-link">
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
              <h3><i class="fa fa-users"></i> Users <span></span></h3>
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
      <?php  
          if (isset($_GET['userMsg'])) {
        $userMsg = $_GET['userMsg'];
          echo "<div class='callout callout-success'>";
          echo "<p>".$userMsg."</p>";
          echo "</div>";
          echo "<br>";
        }elseif (isset($_GET['userMsgError'])) {
          $userMsg = $_GET['userMsgError'];
          echo "<div class='callout callout-danger'>";
          echo "<p>".$userMsg."</p>";
          echo "</div>";
          echo "<br>";
        }elseif (isset($_GET['userMsgExist'])) {
          $userMsg = $_GET['userMsgExist'];
          echo "<div class='callout callout-warning'>";
          echo "<p>".$userMsg."</p>";
          echo "</div>";
          echo "<br>";
        }elseif (isset($_GET['dltUser'])) {
          $userMsg = $_GET['dltUser'];
          echo "<div class='callout callout-primary'>";
          echo "<p>".$userMsg."</p>";
          echo "</div>";
          echo "<br>";
        }elseif (isset($_GET['dltUserError'])) {
          $userMsg = $_GET['dltUserError'];
          echo "<div class='callout callout-danger'>";
          echo "<p>".$userMsg."</p>";
          echo "</div>";
          echo "<br>";
        }
        ?>
    <div class="setup-box"> 
      <h3 class="box-title">Add User</h3>
      <div>
        
      </div>
      <div class="row">
      <form action="addUser.php" method="post" autocomplete="off">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <label>Enter Name</label>
          <input type="text" class="setup-input" name="name" placeholder="Name" required>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <label>Create username</label>
          <input type="text" class="setup-input" name="username" placeholder="Choose Username" required>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <label>Password</label>
          <input id="password" class="newPassword setup-input" type="password" name="newPassword" placeholder="Enter Password" required>
         
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <label>Confirm Password</label>
          <input id="confirm_password" class="confirmPassword setup-input" type="password" name="confirmPassword" placeholder="Confirm Password" required>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <label>Batch</label>
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
      <div class="col-md-3 col-sm-6 col-xs-12">
        <label>Semester</label>
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
      <div class="col-md-3 col-sm-6 col-xs-12" style="display: none;">
        <label>Department</label>
            <select name="department" class="setup-input" required readonly>
            <option value="<?php echo $sessionDepartmentID ?>"><?php echo $sessionDepartment; ?></option>
          </select>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <input type="submit" class="submit-btn" value="Submit" name="submitUser" id="submit-btn">
      </div>
      <div id="divCheck"></div>           
                    
        </form> 
      </div>
    </div>
  </div>


  <div class="col-md-12">
    <div class="setup-box"> 
      <h3 class="box-title">All Users</h3>
              <?php  
              require_once("connection.php");
              $sql = "SELECT * FROM tbl_users 
              INNER JOIN tbl_batch ON tbl_users.user_batchID = tbl_batch.bat_ID
              INNER JOIN tbl_semesters ON tbl_users.user_semesterID = tbl_semesters.sem_ID
              INNER JOIN tbl_departments ON tbl_users.user_departmentID = tbl_departments.dep_ID
              WHERE user_departmentID='$sessionDepartmentID'";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                echo '<div class="table-responsive"> 
              <table id="mytable" class="table table-bordred table-striped">    
                <thead>   
                  <th>S.No</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Batch</th>
                  <th>Semester</th>
                  <th>Action</th>
                </thead>
              <tbody>';
                $num = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                  $user_ID = $row['user_ID'];
                  $name = $row['user_name'];
                  $username = $row['user_username'];
                  $batch = $row['bat_name'];
                  $department = $row['dep_name'];
                  $semester = $row['sem_name'];
                  echo "<tr>";
                  echo "<td>".$num."</td>";
                  echo "<td>".$name."</td>";
                  echo "<td>".$username."</td>";
                  echo "<td>******</td>";
                  echo "<td>".$batch."</td>";
                  echo "<td>".$semester."</td>";
                  echo "<td><a href='deleteUser.php?id=".$user_ID."' onclick='return confirmDelete()' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i></a></td>";
                  echo "</tr>";
                  $num++;
                }
                echo "</tbody>
                    </table>";
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
<script type="text/javascript">
  $('#password, #confirm_password').on('keyup', function () {
  if ($('#password').val() == $('#confirm_password').val()) {
    $('#submit-btn').prop('disabled', false);
    $('#submit-btn').css('cursor', 'pointer');
    $('#confirm_password').css('border', '1px solid green');
    $('#password').css('border', '1px solid green');
  } else {
    $('#submit-btn').prop('disabled', true);
    $('#submit-btn').css('cursor', 'not-allowed');
    $('#confirm_password').css('border', '1px solid red');
    $('#password').css('border', '1px solid red');
  }
});
   function confirmDelete() {
  return confirm("Are you sure you want to delete this User?");
}
	$(document).ready(function(){
    	//$('[data-toggle="tooltip"]').tooltip();   
	});

</script>
</body>
</html>
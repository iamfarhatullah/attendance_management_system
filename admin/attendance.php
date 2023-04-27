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
<title>Attendance - Attendance Management System</title>		
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
          <a href="attendance.php" class="active-sidebar-link">
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
            if (isset($_GET['dltGrp'])) {
                $msg = $_GET['dltGrp'];
                echo "<div class='callout callout-success'>";
                echo "<p>".$msg."</p>";
                echo "</div>";
                echo "<br>";
            }elseif(isset($_GET['dltGrpErr'])) {
                $msg = $_GET['dltGrpErr'];
                echo "<div class='callout callout-danger'>";
                echo "<p>".$msg."</p>";
                echo "</div>";
                echo "<br>";
            }

           ?>        	
                  
<?php 
require_once("connection.php");
$sql = "SELECT * FROM tbl_batch";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result)>0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $bat_ID = $row['bat_ID'];
    $bat_name = $row['bat_name'];

    $sql1= " SELECT count(std_ID) AS total FROM tbl_students 
    INNER JOIN tbl_batch ON tbl_students.std_batchID = tbl_batch.bat_ID
    WHERE std_batchID='$bat_ID' and std_departmentID='$sessionDepartmentID'";
    $result1 = mysqli_query($conn, $sql1);
    $values = mysqli_fetch_assoc($result1);
    $totalStudents = $values['total'];
    $str = strval($totalStudents);
    if ($str>0) {
      $hideThis = "display: block;";
    }else{
      $hideThis = "display: none;";
    }
    $numberSub = substr($bat_name, 0, -1);
    $batchSub = substr($bat_name, 1);
    if ($bat_name == "1B") {
      $bat_namest = "1st-Batch";
    }elseif ($bat_name == "2B") {
      $bat_namest = "2nd-Batch";
    }elseif ($bat_name == "3B") {
      $bat_namest = "3rd-Batch";
    }else{
      $bat_namest = $numberSub."th-"."Batch";
    }

  echo '<div class="row" style=""> 
            <div class="col-md-12">
              <div class="setup-box">
                <h3 class="box-title">'.$bat_namest.'</h3>
                <div class="row">';

    $sqlGroup = "SELECT * FROM tbl_groups 
    INNER JOIN tbl_users ON tbl_groups.grp_userID = tbl_users.user_ID 
    INNER JOIN tbl_subjects ON tbl_groups.grp_subjectID = tbl_subjects.sub_ID
    WHERE user_batchID='$bat_ID' and user_departmentID='$sessionDepartmentID'";
    $resultGroup = mysqli_query($conn, $sqlGroup);

    if (mysqli_num_rows($resultGroup)>0) {
    	while ($rowGroup = mysqli_fetch_assoc($resultGroup)) {
    		$grp_ID = $rowGroup['grp_ID'];
    		$grp_name = $rowGroup['grp_name'];
    		$sub_name = $rowGroup['sub_name'];

    		echo '<div class="col-md-6 col-sm-12 col-xs-12">
                <div class="group-box">
                  <table>
                    <tr>
                      <td class="hidden-xs">
                        <i class="fa fa-users g-icon"></i>  
                      </td>
                      <td>
                        <h4 class="ellipse">'.$grp_name.'</h4>
                        <p class="ellipse">'.$sub_name.'</p>
                        <a style="color: #363636" href="pdf/?groupID='.$grp_ID.'&batch='.$bat_name.'" target="_blank" class="">View Attendance</a>
                        <a href="#" style="float:left; color:#fff; margin-right:6px;" class="btn btn-xs btn-primary"><span class="fa fa-edit"></span></a>
                        <a href="deleteGroup.php?id='.$grp_ID.'" onclick="return confirmDelete()" style="float:left; color:#fff; margin-right:6px;" class="btn btn-xs btn-danger"><span class="fa fa-trash"></span></a>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>';
    	}
    }

  



              echo '</div>
              </div>
            </div>
          </div> ';
  }
}
?>
                  

                
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
  return confirm("Are you sure you want to delete this group?");
}
	$(document).ready(function(){
    	//$('[data-toggle="tooltip"]').tooltip();   
	});
</script>
</body>
</html>
<?php
require_once("connection.php");
    $sql = "SELECT * FROM tbl_students 
    INNER JOIN tbl_batch ON tbl_batch.bat_ID = tbl_students.std_batchID 
    INNER JOIN tbl_departments ON tbl_departments.dep_ID = tbl_students.std_departmentID
    INNER JOIN tbl_semesters ON tbl_semesters.sem_ID = tbl_students.std_semesterID
    WHERE std_batchID IN (SELECT bat_name FROM tbl_batch WHERE bat_ID='1') and 
    std_departmentID='1' 
    ORDER by std_rollno asc";
    $result = mysqli_query($conn, $sql);
    $num = 1;
    if (mysqli_num_rows($result) > 0) {
        $dataPoints = array();
        while ($row = mysqli_fetch_assoc($result)) {
        	$id = $row['std_ID'];
        	$fullname = $row['std_name'];
        	$fathername = $row['std_fathername'];
        	$batch = $row['bat_name'];
        	$rollno = $row['std_rollno'];
        	$department = $row['dep_name'];
        	$semester = $row['sem_name'];
            $num++;
            array_push($dataPoints, array("y" => $id, "label" => $fullname ));

        }
    }else{
        echo "Nothing to show...";
    } 
 
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Students Attendance"
	},
	axisY: {
		title: "Students Attendance Graph"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## ",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html> 
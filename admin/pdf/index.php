<?php  

require 'fpdf.php';
require '../connection.php';
class myPDF extends FPDF {
	function header(){
		require '../connection.php';
		$id = $_GET['groupID'];
		$getSubject = "SELECT * FROM `tbl_groups` 
		INNER JOIN tbl_subjects ON tbl_groups.grp_subjectID=tbl_subjects.sub_ID 
		INNER JOIN tbl_departments ON tbl_subjects.sub_departmentID=tbl_departments.dep_ID
		WHERE grp_ID='$id'";
		$sql1 = mysqli_query($conn,$getSubject);
		$result1 = mysqli_fetch_assoc($sql1);
		$sub_name = $result1['sub_name'];
		$department = $result1['dep_name'];
		$this->Ln(4);
		$this->SetFont('Arial','B',18);
		$this->Cell(0,5,'Govt Degree College Thana',0,0,'C');
		$this->Ln();
		$this->SetFont('Times','',12);
		$this->Cell(0,10,'Department of '.$department,0,0,'C');
		$this->Ln(7);
		$this->SetFont('Times','',12);
		$this->Cell(0,8,$sub_name,0,0,'C');
		$this->Ln(15);

		$sqlDate = "SELECT att_date FROM tbl_attendance WHERE att_groupID='$id' GROUP by att_date ORDER by att_date ASC";
		$result = $conn->query($sqlDate);
		
		if ($result->num_rows > 0) {
			$this->SetFont('Arial','B',8);
			$this->Cell(5,6,'','TLR',0,'C');
			$this->Cell(36,6,'','TLR',0,'L');
			$this->Cell(36,6,'','TLR',0,'L');
			$this->Cell(13,6,'','TLR',0,'L');
			$index = 1;
			$sqlCountDate = "SELECT COUNT(DISTINCT(att_date)) AS total FROM tbl_attendance WHERE att_groupID='$id'";
						$resultCount = $conn->query($sqlCountDate);
						$rowCountedDate = $resultCount->fetch_assoc();
						$rowCountedDate = $rowCountedDate['total'];
			while ($row = $result->fetch_assoc()) {
				

				$date = $row['att_date'];
				$day = date("d",strtotime($date));
				$month = date("m",strtotime($date));
				$year = date("y",strtotime($date));
				$this->Cell(4.5,6,"$day",'TLR',0,'C');	

				

						if ($index == $rowCountedDate) {
							for ($i=$index; $i <40; $i++) { 
								$this->Cell(4.5,6,"",'TLR',0,'C');				
						 	}							 	
						}
						$index++; 	
			}
			$this->Ln();
		}
		// 2nd
			$sqlDate = "SELECT att_date FROM tbl_attendance WHERE att_groupID='$id' GROUP by att_date ORDER by att_date ASC";
		$result = $conn->query($sqlDate);
		
		if ($result->num_rows > 0) {
			$this->SetFont('Arial','B',8);
			$this->Cell(5,6,'','LR',0,'C');
			$this->Cell(36,6,'','LR',0,'L');
			$this->Cell(36,6,'','LR',0,'L');
			$this->Cell(13,6,'','LR',0,'L');
			$index = 1;
			$sqlCountDate = "SELECT COUNT(DISTINCT(att_date)) AS total FROM tbl_attendance WHERE att_groupID='$id'";
						$resultCount = $conn->query($sqlCountDate);
						$rowCountedDate = $resultCount->fetch_assoc();
						$rowCountedDate = $rowCountedDate['total'];
			while ($row = $result->fetch_assoc()) {
				

				$date = $row['att_date'];
				$day = date("d",strtotime($date));
				$month = date("m",strtotime($date));
				$year = date("y",strtotime($date));
				$this->Cell(4.5,6,"$month",'RL',0,'C');	

				

						if ($index == $rowCountedDate) {
							for ($i=$index; $i <40; $i++) { 
								$this->Cell(4.5,6,"",'RL',0,'C');				
						 	}							 	
						}
						$index++; 	
			}
			$this->Ln();
		}
		// 2nd
		// 3rd
			$sqlDate = "SELECT att_date FROM tbl_attendance WHERE att_groupID='$id' GROUP by att_date ORDER by att_date ASC";
		$result = $conn->query($sqlDate);
		
		if ($result->num_rows > 0) {
			$this->SetFont('Arial','B',8);
			$this->Cell(5,6,'','LR',0,'C');
			$this->Cell(36,6,'','LR',0,'L');
			$this->Cell(36,6,'','LR',0,'L');
			$this->Cell(13,6,'','LR',0,'L');
			$index = 1;
			$sqlCountDate = "SELECT COUNT(DISTINCT(att_date)) AS total FROM tbl_attendance WHERE att_groupID='$id'";
						$resultCount = $conn->query($sqlCountDate);
						$rowCountedDate = $resultCount->fetch_assoc();
						$rowCountedDate = $rowCountedDate['total'];
			while ($row = $result->fetch_assoc()) {
				

				$date = $row['att_date'];
				$day = date("d",strtotime($date));
				$month = date("m",strtotime($date));
				$year = date("y",strtotime($date));
				$this->Cell(4.5,6,"$year",'LR',0,'C');	

				

						if ($index == $rowCountedDate) {
							for ($i=$index; $i <40; $i++) { 
								$this->Cell(4.5,6,"",'LR',0,'C');				
						 	}							 	
						}
						$index++; 	
			}
			$this->Ln();
		}
		// 3rd
		$this->SetFont('Arial','B',8);
		$this->Cell(5,7,'S#','L',0,'C');
		$this->Cell(36,7,'Name','L',0,'L');
		$this->Cell(36,6,'Father Name','L',0,'L');
		$this->Cell(13,7,'Roll No','L',0,'L');
		for ($i=1; $i <= 40; $i++) { 
		$this->Cell(4.5,7,$i,1,0,'C');
		}
		$this->Ln();
	}
	function ShowStudentsAttendance($conn){
		$id = $_GET['groupID'];
		$batch = $_GET['batch'];
		$sql = "SELECT * FROM tbl_attendance 
		INNER JOIN tbl_students ON tbl_attendance.att_studentID = tbl_students.std_ID   
		WHERE att_groupID='$id'
		group by att_studentID, std_ID ORDER by std_rollno";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$this->SetFont('Arial','',7.5);
			$num = 1;
			while ($row = $result->fetch_assoc()) {
				$att_ID = $row['att_ID'];
				$std_ID = $row['std_ID'];
				$fullname = $row['std_name'];
				$fathername = $row['std_fathername'];
				$classno = $row['std_rollno'];
				$this->Cell(5,6,$num,1,0,'C');
				$this->Cell(36,6,$fullname,1,0,'L');
				$this->Cell(36,6,$fathername,1,0,'L');
				$this->Cell(13,6,$batch."-".$classno,1,0,'C');

				$sql1 = "SELECT * FROM tbl_attendance 
				INNER JOIN tbl_students ON tbl_attendance.att_studentID = tbl_students.std_ID
				WHERE tbl_students.std_name='$fullname' and att_groupID='$id'";

				$result1 = $conn->query($sql1);

				if ($result1->num_rows > 0) {
					$a = 1;
					while ($row1 = $result1->fetch_assoc()) {
						$status = $row1['att_status'];
						$this->Cell(4.5,6,$status,1,0,'C');

						$sqlCount = "SELECT count(att_status) AS total FROM tbl_attendance 
						INNER JOIN tbl_students ON tbl_attendance.att_studentID = tbl_students.std_ID
						WHERE tbl_students.std_name='$fullname' and att_groupID='$id'";
						$resultCount = $conn->query($sqlCount);
						$rowCounted = $resultCount->fetch_assoc();
						$rowCounted = $rowCounted['total'];
						
						if ($a == $rowCounted) {
							for ($i=$a; $i <40; $i++) { 
								$this->Cell(4.5,6,"",1,0,'C');				
						 	}							 	
						}
						$a++; 				
					}
				}

				$this->Ln();
				$num++;
			}
		}

	}
	function footer(){
		$this->SetY(-15);
		$this->SetFont('Arial','I',8);
		$this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');
	}
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->SetFont('Times','',12);
$pdf->ShowStudentsAttendance($conn);
$pdf->Output();



?>
<?php 
	$backDir = '';
	if(file_exists($backDir."library/Config.php")) {
		require_once($backDir."library/Config.php"); 
	}
	if(!$loggedIn)
		header("Location: index.php");
	if(isset($_GET['report']) && $oes->getLoggedUserInfo("Type") == "Administrator") {
		$report = $_GET['report'];
		$doc["DocumentTitle"] = "";
	} elseif(isset($_GET['cor'])) {
		$cor = $_GET['cor'];
		if($oes->getLoggedUserInfo("Type") != "Administrator" && $oes->getLoggedUserInfo("Type") != "Student") {
			header("Location: index.php");
		}
		if($oes->getLoggedUserInfo("Type") == "Student") {
			if($cor != $_SESSION['loggedID']) {
				header("Location: index.php");
			}
		}
	} elseif(isset($_GET['permit'])) {
		$permit = $_GET['permit'];
		if($oes->getLoggedUserInfo("Type") != "Administrator" && $oes->getLoggedUserInfo("Type") != "Enrollee") {
			header("Location: index.php");
		}
		if($oes->getLoggedUserInfo("Type") == "Enrollee") {
			if($permit != $_SESSION['loggedID']) {
				header("Location: index.php");
			}
		}
	} elseif(isset($_GET['confirm'])) {
		$confirm = $_GET['confirm'];
		if($oes->getLoggedUserInfo("Type") != "Administrator" && $oes->getLoggedUserInfo("Type") != "Enrollee") {
			header("Location: index.php");
		}
		if($oes->getLoggedUserInfo("Type") == "Enrollee") {
			if($confirm != $_SESSION['loggedID']) {
				header("Location: index.php");
			}
		}
	} elseif(isset($_GET['grade'])) {
		if(isset($_GET['id'])) {
			$grade = "student";
			if(!($oes->getLoggedUserInfo("Type") == "Administrator" || $oes->getLoggedUserInfo("Type") == "Custom" || ($oes->getLoggedUserInfo("Type") == "Student" && $_SESSION['loggedID'] == $_GET['id']))) {
				header("Location: index.php");
			}
		} elseif(isset($_GET['gl'], $_GET['subject'])) {
			$grade = "faculty";
			$facultyid = $oes->getSingleData("Schedule", "FacultyID", "SectionID = '".$_GET['gl']."' AND SubjectID = '".$_GET['subject']."'");
			if(!($oes->getLoggedUserInfo("Type") == "Faculty" && $_SESSION['loggedID'] == $facultyid)) {
				header("Location: index.php");
			}
		} else {
			header("Location: index.php?");
		}
	} else {
		header("Location: index.php");
	}
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	<title><?php echo $doc["DocumentTitle"]; ?></title>
	<script src="<?php echo $backDir; ?>scripts/jquery.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo $backDir; ?>styles/skin/light/">
	<link rel="stylesheet" href="<?php echo $backDir; ?>styles/style.php">
	<link rel="stylesheet" href="<?php echo $backDir; ?>styles/paper.css">
	<script src="<?php echo $backDir; ?>scripts/smooth_scroll.js"></script>
	<script src="<?php echo $backDir; ?>scripts/oslo-ui.js"></script>
</head>
<body>
<div id="app-container">
	<div class="bg"></div>
	<?php
	if(isset($report)) {
	?>
	<div class="paper">

	</div>
	<script>
	$(document).ready(function() {
		$except = 0;
		$("#float-left-menu").hide();
		updateLayout("loaded");
		$("#blackTrans").show();
		$("#loading").show("slow");
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=viewreport",
			data: {report: '<?php echo $report; ?>', get: <?php echo json_encode($_GET); ?>},
			success: function(html) {
				$(".paper").html(html);
			}
		})
	});
	</script>
	<?php
	} elseif(isset($_GET['cor'])) {
		$id = $cor;
		$data = $oes->getRow("Student", "*", "ID = '$id'");
	?>
	<div class="paper">
		<div class="header"><center><h1></h1></center></div>
		<div class="content">
			<span class="title">Unofficial Certificate of Registration</span><hr><br>
			<table width="100%" cellpadding="5px">
				<tr valign="top">
					<td width="50%">
						<table class="cor">
							<tr>
								<td colspan="2">Personal Information</td>
							</tr>
							<tr>
								<td>Student No.:</td>
								<td><?php echo $id; ?></td>
							</tr>
							<tr>
								<td>Student Name:</td>
								<td><?php echo $oes->getNameFormat("l, f M.", $id); ?></td>
							</tr>
							<tr>
								<td>Year & Section:</td>
								<td>Grade <?php echo $data["GradeLevel"].$oes->getSingleData("GLS", "Section", "ID = '".$data["GLS"]."'"); ?></td>
							</tr>
							<tr>
								<td>Gender:</td>
								<td><?php echo $data["Gender"]; ?></td>
							</tr>
							<tr>
								<td>Age:</td>
								<td><?php echo $oes->getAge($data["BirthDate"]); ?></td>
							</tr>
							<tr>
								<td>Nationality:</td>
								<td><?php echo $data["Citizenship"]; ?></td>
							</tr>
							<tr>
								<td>Home Address:</td>
								<td><?php echo $data["NoStreetBrgy"].", ".$data["CityMunicipality"].", ".$data["ProvinceState"].", ".$data["Country"]." ".$data["ZipCode"];?></td>
							</tr>
							<tr>
								<td>Contact No.:</td>
								<td><?php echo $data["MobileNo"]; ?></td>
							</tr>
							<tr>
								<td>Parent/Guardian:</td>
								<td><?php echo $data["G_FullName"]; ?></td>
							</tr>
						</table>
						<br>
						<table class="cor">
							<tr>
								<td colspan="2">Assessment of Fees</td>
							</tr>
							<?php
							$fees = $oes->getData("Breakdown", "*", "GradeLevel = '".$data["GradeLevel"]."'");
							$total = 0;
							foreach($fees as $f) {
								$total += $f["Price"];
							?>
							<tr>
								<td><?php echo $f["Title"]; ?></td>
								<td align="right"><?php echo number_format($f["Price"],2); ?></td>
							</tr>
							<?php
							}
							?>
							<tr>
								<td>TOTAL</td>
								<td align="right"><?php echo number_format($total,2); ?></td>
							</tr>
						</table>
					</td>
					<td>
						<table class="cor">
							<tr>
								<td>Class Schedule</td>
							</tr>
							<tr>
								<td>
									<center>(Classes starts at 7:30am and end at 4:30pm)</center>
									<br>
									<?php
									$subjects = $oes->getData("Subject", "*", "1=1 ORDER BY Name");
									foreach($subjects as $s) {
										echo $s["Name"]."<br>";
									}
									?>
								</td>
							</tr>
						</table>
						<p align="right">
						<small><?php echo $data["Hash"]; ?></small>
						</p>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<?php
	} elseif(isset($_GET['permit'])) {
		$id = $permit;
		$data = $oes->getRow("Enrollee INNER JOIN Student INNER JOIN Account", "*", "Student.ID = Account.ID AND Student.ID = Enrollee.ID");
	?>
	<div class="paper">
		<div class="header">

		</div>
		<div class="content">
			<span class="title"><?php
			echo $data["GradeLevel"] == 7 ? 'Exam Permit': 'Interview Permit';
			?></span><hr><br>
			<center>
			<table width="100%" cellpadding="5px">
				<tr valign="top">
					<td width="50%">
						<table class="cor">
							<tr>
								<td colspan="2">Personal Information</td>
							</tr>
							<tr>
								<td>Student No.:</td>
								<td><?php echo $id; ?></td>
							</tr>
							<tr>
								<td>Student Name:</td>
								<td><?php echo $oes->getNameFormat("l, f M.", $id); ?></td>
							</tr>
							<tr>
								<td>Year:</td>
								<td>Grade <?php echo $data["GradeLevel"]; ?></td>
							</tr>
							<tr>
								<td>Gender:</td>
								<td><?php echo $data["Gender"]; ?></td>
							</tr>
							<tr>
								<td>Age:</td>
								<td><?php echo $oes->getAge($data["BirthDate"]); ?></td>
							</tr>
						</table>
					</td>
					<td>
						<table class="cor">
							<tr>
								<td colspan="2">Admission Information</td>
							</tr>
							<tr>
								<td>Permit No.:</td>
								<td>DLSUDHS<?php echo $data["Username"]; ?></td>
							</tr>
							<tr>
								<td>Enrollment Status:</td>
								<td><?php echo $data["EnrollmentStatus"]; ?></td>
							</tr>
							<tr>
								<td>Admission Date:</td>
								<td><?php echo date("F d, Y", strtotime($oes->getSingleData("Admission", "ScheduleDate", "ID = '".$data["AdmissionID"]."'"))); ?></td>
							</tr>
							<tr>
								<td>Admission Time:</td>
								<td><?php echo date("g:i a", strtotime($oes->getSingleData("Admission", "ScheduleTime", "ID = '".$data["AdmissionID"]."'"))); ?></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			</center>
		</div>
	</div>
	<?php
	} elseif(isset($_GET['confirm'])) {
		$id = $confirm;
		$data = $oes->getRow("Enrollee INNER JOIN Student INNER JOIN Account", "*", "Student.ID = Account.ID AND Student.ID = Enrollee.ID");
	?>
	<div class="paper">
		<div class="header">

		</div>
		<div class="content">
			<span class="title">Confirmation Permit</span><hr><br>
			<center>
			<table width="100%" cellpadding="5px">
				<tr valign="top">
					<td width="50%">
						<table class="cor">
							<tr>
								<td colspan="2">Personal Information</td>
							</tr>
							<tr>
								<td>Student No.:</td>
								<td><?php echo $id; ?></td>
							</tr>
							<tr>
								<td>Student Name:</td>
								<td><?php echo $oes->getNameFormat("l, f M.", $id); ?></td>
							</tr>
							<tr>
								<td>Year:</td>
								<td>Grade <?php echo $data["GradeLevel"]; ?></td>
							</tr>
							<tr>
								<td>Gender:</td>
								<td><?php echo $data["Gender"]; ?></td>
							</tr>
							<tr>
								<td>Age:</td>
								<td><?php echo $oes->getAge($data["BirthDate"]); ?></td>
							</tr>
						</table>
					</td>
					<td>
						<table class="cor">
							<tr>
								<td colspan="2">Admission Information</td>
							</tr>
							<tr>
								<td>Confirmation Hash:</td>
								<td><?php echo $data["Hash"]; ?></td>
							</tr>
							<tr>
								<td>Enrollment Status:</td>
								<td><?php echo $data["EnrollmentStatus"]; ?></td>
							</tr>
							<tr>
								<td>Admission Date:</td>
								<td><?php echo date("F d, Y", strtotime($oes->getSingleData("Admission", "ScheduleDate", "ID = '".$data["AdmissionID"]."'"))); ?></td>
							</tr>
							<tr>
								<td>Admission Time:</td>
								<td><?php echo date("g:i a", strtotime($oes->getSingleData("Admission", "ScheduleTime", "ID = '".$data["AdmissionID"]."'"))); ?></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			</center>
		</div>
	</div>
	<?php
	} elseif(isset($_GET['grade'])) {
		if($grade == "student") {
			$id = $_GET['id'];
			$sy = $_GET['sy'];
		?>
		<div class="paper">
			<div class="header">
			</div>
			<div class="content">
				<span class="title">Grade</span><hr><br>
				<b>Student Name:</b> <?php echo $oes->getNameFormat("f M. l", $id); ?><br><br>
				<b>School Year:</b> <?php echo $sy.' - '.($sy+1); ?><br><br>
				<center>
				<table class="list small" id="tableListGrades">
				<?php
				$subjects = $oes->getData("Subject", "*", "1=1 ORDER BY ID ASC");
			?>
				<tr class="title">
					<td class="hide"></td>
					<td>Subject</td>
					<td align="center" width="1px">Q1</td>
					<td align="center" width="1px">Q2</td>
					<td align="center" width="1px">Q3</td>
					<td align="center" width="1px">Q4</td>
					<td align="center" width="1px">AVG</td>
				</tr>
			<?php
				$complete = true;
				$total = 0;
				foreach($subjects as $subject) {
			?>
				<tr>
					<td class="hide"></td>
					<td><?php echo $subject["Code"]; ?></td>
					<?php
					$avg = 0;
					$num = 0;
					for($i = 1; $i <= 4; $i++) {
					?>
						<td align="center"><?php
						$grade = $oes->getSingleData("Grade", "Grade", "SchoolYear = '$sy' AND Quarter = '$i' AND StudentID = '$id' AND SubjectID = '".$subject["ID"]."'");
						if($grade == "")
							echo "-";
						else {
							echo $grade;
							$avg += $grade;
							$num++;
						}
						?></td>
					<?php
					}
					?>
					<td align="center"><?php
					if($num == 4) {
						echo number_format($avg/4,2);
						$total += ($avg/4);
					} else {
						$complete = false;
						echo '-';
					}
					?></td>
				</tr>
			<?php
				}
				?>
					<tr>
						<td class="hide"></td>
						<td colspan="5"><b>TOTAL</b></td>
						<td align="center"><?php 
						if($complete)
							echo number_format($total/sizeof($subjects),2);
						else
							echo '-';
						?></td>
					</tr>
				</table>
				</center>
			</div>
		</div>
		<?php
		} elseif($grade == "faculty") {
			$subject = $_GET['subject'];
			$section = $_GET['gl'];
			$sectiondata = $oes->getRow("GLS", "*", "ID = '".$section."'");
		?>
		<div class="paper">
			<div class="header">
			</div>
			<div class="content">
				<span class="title">Grade Report</span><hr><br>
				<b>Faculty Name:</b> <?php echo $oes->getNameFormat("f M. l", $facultyid); ?><br><br>
				<b>Grade/Section:</b> Grade <?php echo $sectiondata["GradeLevel"].$sectiondata["Section"]; ?><br><br>
				<b>Subject:</b> <?php echo $oes->getSingleData("Subject", "Name", "ID = '$subject'"); ?><br><br>
				<center>
				<table class="list small" id="tableListGrades">
				<?php
				$students = $oes->getData("Account INNER JOIN Student", "*", "Account.ID = Student.ID AND Student.GLS = '$section' AND Account.Status = 'Active' AND Account.Type = 'Student' ORDER BY LastName ASC");
			?>
				<tr class="title">
					<td class="hide"></td>
					<td>Student ID</td>
					<td>Name</td>
					<td align="center" width="1px">Q1</td>
					<td align="center" width="1px">Q2</td>
					<td align="center" width="1px">Q3</td>
					<td align="center" width="1px">Q4</td>
					<td align="center" width="1px">AVG</td>
				</tr>
			<?php
				$complete = true;
				$total = 0;
				foreach($students as $student) {
			?>
				<tr>
					<td class="hide"></td>
					<td><?php echo $student["ID"]; ?></td>
					<td><?php echo $oes->getNameFormat("l, f M.", $student["ID"]); ?></td>
					<?php
					$avg = 0;
					$num = 0;
					$sy = $oes->getSchoolYear();
					$qs = array("FirstQuarter", "SecondQuarter", "ThirdQuarter", "FourthQuarter");
					for($i = 1; $i <= 4; $i++) {
						$grade = $oes->getSingleData("Grade", "Grade", "SchoolYear = '$sy' AND StudentID = '".$student["ID"]."' AND Quarter = '$i' AND SubjectID = '$subject'");
						if($grade == "")
							$grade = "-";
						else {
							$avg += $grade;
							$num++;
						}
					?>
					<td align="center"><?php echo $grade; ?></td>
					<?php
					}
					?>
					<td align="center">
						<?php
						if($num == 4)
							echo $avg/4;
						else
							echo '-';
						?>
					</td>
				</tr>
			<?php
				}
				?>
				</table>
				</center>
			</div>
		</div>
		<?php
		}
	}
	?>
	<script>
	$(document).ready(function() {
		$except = 0;
		$("#float-left-menu").hide();
		updateLayout("loaded");
	});
	</script>
	<div id="float-left-menu">
		<div class="wrapper">
			<div class="title">
				<div style="position: relative"><a class="icons icon_medium" onclick="showElement('none')"></a>Main Menu</div>
			</div>
			<ul class="ripple">
				<li><a><span class="img ic_payment_white"></span>About</a></li>
				<li><a href="index.php?login"><span class="img ic_dashboard_white"></span>Login</a></li>
				<li><a href="index.php?register"><span class="img ic_account_circle_white"></span>Register</a></li>
			</ul>
			<div class="copyright">
				&copy; 2015 Online Enrollment System<br>
				Juvar Abrera • Jarrell Maverick Remulla
			</div>
		</div>
	</div>
	<div id="blackTrans"></div>
	<div id="dialog-box">
		<div class="wrapper">
			<center><div class="loading"></div></center>
		</div>
	</div>
	<div id="snackbar">
		<div class="wrapper">
		</div>
	</div>
	<div id="loading"></div>
</div>
</body>
</html>
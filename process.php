<?php
$backDir = '';
if(file_exists($backDir."library/Config.php"))
	require_once($backDir."library/Config.php"); 

$systatus = $oes->getSYStatus();

function showSnackbar($show) {
	echo '<script>showSnackbar("'.$show.'");</script>';
}
function showSnackbarMsg($show) {
	echo '<script>showSnackbarMsg("'.$show.'");</script>';
}
function showDialogBox($show) {
	echo '<script>showDialogBox("'.$show.'");</script>';
}
function showBottomSheet($show) {
	echo '<script>showBottomSheet("'.$show.'");</script>';
}
function hideElements() {
	echo '<script>showElement("none");</script>';
}

function scriptCheckedData($id) {
?>
	<script>
	$(document).ready(function() {
		$("<?php echo $id; ?> #chkAll input").change(function() {
			if(this.checked) {
				$("<?php echo $id; ?> .checkData input").each(function() {
					if(!this.checked) {
						$checkedData.push($(this).attr("value"));
					}
				});
			} else {
				$("<?php echo $id; ?> .checkData input").each(function() {
					$index = $checkedData.indexOf($(this).attr("value"));
					$checkedData.splice($index, 1);
				});
			}
			if(this.checked) {
				$("<?php echo $id; ?> .checkData input").prop("checked", true);
			} else {
				$("<?php echo $id; ?> .checkData input").prop("checked", false);
			}
			updateDataAction();
		});
		$("<?php echo $id; ?> .checkData input").change(function() {
			$n = 1;
			$num = 0;
			$("<?php echo $id; ?> .checkData input").each(function() {
				if(!this.checked)
					$n = 0;
				else
					$num++;
			});
			if(this.checked) {
				$checkedData.push($(this).attr("value"));
			} else {
				$index = $checkedData.indexOf($(this).attr("value"));
				$checkedData.splice($index, 1);
			}
			if($n == 1)
				$("<?php echo $id; ?> #chkAll input").prop("checked", true);
			else
				$("<?php echo $id; ?> #chkAll input").prop("checked", false);
			updateDataAction();
		});
	});
	function updateDataAction() {
		if($checkedData.length != 0) {
			$("#data-action-bar .menu-title .title").html($checkedData.length + " selected");
			showDataAction(true);
		} else {
			$("#numDataSelected").html("");
			showDataAction(false);
		}
	}
	$("#data-action-bar #btnSelectAll").click(function() {
		$(".checkData input").each(function() {
			if(!this.checked) {
				$checkedData.push($(this).attr("value"));
			}
		});
		$("#chkAll input").prop("checked", true);
		$(".checkData input").prop("checked", true);
		updateDataAction();
	});
	$("#data-action-bar #btnSelectOff").click(function() {
		deselectData();
	});
	function deselectData() {
		$checkedData = [];
		$("#chkAll input").prop("checked", false);
		$(".checkData input").prop("checked", false);
		updateDataAction();
	}
	</script>
<?php
}
function showPagination($query, $filter, $rowPerPage, $p, $refreshList) {
?>
	<div class="card button-container">
		<?php
		$query = mysql_query("$query $filter");
		$totalRecords = mysql_num_rows($query);
		$totalPages = 1;
		if($rowPerPage != 0)
			$totalPages = ceil($totalRecords / $rowPerPage);
		?>
		<div class="table">
			<div class="row">
				<div class="cell compact">
					<ul class="button-container divider">
						<li><a <?php if($p != 1) echo 'id="btnFirst" '; ?>onclick class="flat_button"><span class="flat_icon ic_double-left compact"></span></a></li>
						<li><a <?php if($p != 1) echo 'id="btnPrev" '; ?>onclick class="flat_button"><span class="flat_icon ic_left compact"></span></a></li>
					</ul>
				</div>
				<div class="cell">
					<select id="ddlPage">
						<?php
						for($i = 1; $i <= $totalPages; $i++) {
							$selected = "";
							if($p == $i) {
								$selected = " selected";
							}
							echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
						}
						?>
					</select>
				</div>
				<div class="cell compact">
					<ul class="button-container right divider">
						<li><a <?php if($p != $totalPages) echo 'id="btnNext" '; ?>onclick class="flat_button"><span class="flat_icon ic_right compact"></span></a></li>
						<li><a <?php if($p != $totalPages) echo 'id="btnLast" '; ?>onclick class="flat_button"><span class="flat_icon ic_double-right compact"></span></a></li>
					</ul>
				</div>
			</div>
		</div>
		<script>
		$(document).ready(function() {
			$("#btnFirst").click(function() {
				$("#frmSearch input[name='p']").val(1);
				<?php echo $refreshList; ?>
			});
			$("#btnPrev").click(function() {
				$("#frmSearch input[name='p']").val(parseInt($("#frmSearch input[name='p']").val(), 10)-1);
				<?php echo $refreshList; ?>
			});
			$("#btnNext").click(function() {
				$("#frmSearch input[name='p']").val(parseInt($("#frmSearch input[name='p']").val(), 10)+1);
				<?php echo $refreshList; ?>
			});
			$("#btnLast").click(function() {
				$("#frmSearch input[name='p']").val(<?php echo $totalPages; ?>);
				<?php echo $refreshList; ?>
			});
			$("#ddlPage").change(function() {
				$val = $(this).val();
				$("#frmSearch input[name='p']").val($val);
				<?php echo $refreshList; ?>
			});
		});
		</script>
	</div>
<?php
}




if(isset($_GET['action'])) {
	$action = $_GET['action'];
	if($action == "show-bottom-sheet") {
		if(isset($_POST['name'])) {
			$name = $_POST['name'];
			if(isset($_POST['id'])) 
				$bs_id = $_POST['id'];
			if(file_exists("content/bottom-sheet/$name.php"))
				require_once("content/bottom-sheet/$name.php");
			else
				require_once("content/bottom-sheet/null.php");
		} else 
			require_once("content/bottom-sheet/null.php");
	} elseif($action == "show-dialog-box") {
		if(isset($_POST['name'])) {
			$name = $_POST['name'];
			if(isset($_POST['id'])) 
				$db_id = $_POST['id'];
			if(file_exists("content/dialog-box/$name.php"))
				require_once("content/dialog-box/$name.php");
			else 
				require_once("content/dialog-box/null.php");
		} else 
			require_once("content/dialog-box/null.php");
	} elseif($action == "show-snackbar") {
		if(isset($_POST['name'])) {
			$name = $_POST['name'];
			if(isset($_POST['id'])) 
				$sb_id = $_POST['id'];
			if(file_exists("content/snackbar/$name.php"))
				require_once("content/snackbar/$name.php");
			else 
				require_once("content/snackbar/null.php");
		} else 
			require_once("content/snackbar/null.php");
	} elseif($action == "register") {
		if(isset($_POST['gradelevel'], $_POST['firstname'], $_POST['middlename'], $_POST['lastname'], $_POST['auxname'], $_POST['gender'], $_POST['birthdate'], $_POST['birthplace'], $_POST['religion'], $_POST['status'], $_POST['citizenship'], $_POST['nostreetbrgy'], $_POST['city'], $_POST['province'], $_POST['country'], $_POST['zipcode'], $_POST['email'], $_POST['mobileno'], $_POST['fname'], $_POST['foccupation'], $_POST['mname'], $_POST['moccupation'], $_POST['gname'], $_POST['relationship'], $_POST['gaddress'], $_POST['sameaddress'], $_POST['gmobileno'], $_POST['gradeschool'], $_POST['namegradeschool'], $_POST['gsaddress'], $_POST['yeargraduate'])) {
			$gradelevel = $_POST['gradelevel'];
			$firstname = $_POST['firstname'];
			$middlename = $_POST['middlename'];
			$lastname = $_POST['lastname'];
			$auxname = $_POST['auxname'];
			$gender = $_POST['gender'];
			$birthdate = $_POST['birthdate'];
			$birthplace = $_POST['birthplace'];
			$religion = $_POST['religion'];
			$status = $_POST['status'];
			$citizenship = $_POST['citizenship'];
			$nostreetbrgy = $_POST['nostreetbrgy'];
			$city = $_POST['city'];
			$province = $_POST['province'];
			$country = $_POST['country'];
			$zipcode = $_POST['zipcode'];
			$email = $_POST['email'];
			$mobileno = $_POST['mobileno'];
			$fname = $_POST['fname'];
			$foccupation = $_POST['foccupation'];
			$mname = $_POST['mname'];
			$moccupation = $_POST['moccupation'];
			$gname = $_POST['gname'];
			$relationship = $_POST['relationship'];
			$gaddress = $_POST['gaddress'];
			$sameaddress = $_POST['sameaddress'];
			$gmobileno = $_POST['gmobileno'];
			$gradeschool = $_POST['gradeschool'];
			$namegradeschool = $_POST['namegradeschool'];
			$gsaddress = $_POST['gsaddress'];
			$yeargraduate = $_POST['yeargraduate'];
			$id = $oes->generateTempAccountID();
			$username = $oes->generateTempUsername($id, $firstname, $middlename, $lastname);
			$password = $oes->generatePassword(8);
			if($sameaddress == "true") {
				$gaddress = $nostreetbrgy.', '.$city.', '.$province.', '.$country;
			}
			if($gradeschool == "Other") {
				$gradeschool = $namegradeschool;
			}
			$hash = $oes->generateHash(15);
			mysql_query("INSERT INTO Account (ID, Username, Password, Type, Status) VALUES ('$id', '$username', '$password', 'Enrollee', 'Active')");
			mysql_query("INSERT INTO Student (ID, Hash, FirstName, MiddleName, LastName, AuxiliaryName, GradeLevel, GLS, Gender, BirthDate, BirthPlace, Religion, CivilStatus, Citizenship, NoStreetBrgy, CityMunicipality, ProvinceState, Country, ZipCode, Email, MobileNo, F_FullName, F_Occupation, M_FullName, M_Occupation, G_FullName, G_Relationship, G_Address, G_MobileNo, GradeSchool, Address, YearGraduate) VALUES ('$id', '$hash', '$firstname', '$middlename', '$lastname', '$auxname', '$gradelevel', '0', '$gender', '$birthdate', '$birthplace', '$religion', '$status', '$citizenship', '$nostreetbrgy', '$city', '$province', '$country', '$zipcode', '$email', '$mobileno', '$fname', '$foccupation', '$mname', '$moccupation', '$gname', '$relationship', '$gaddress', '$gmobileno', '$gradeschool', '$gaddress', '$yeargraduate')");
			if($gradelevel == 7) {
				$schedule = $oes->getScheduleDate("Exam");
			} else {
				$schedule = $oes->getScheduleDate("Interview");
			}
			mysql_query("INSERT INTO Enrollee(ID, AdmissionID, EnrollmentStatus) VALUES ('$id', '$schedule', 'Pending')");
			$tuition = $oes->getSingleData("Breakdown", "Price", "GradeLevel = '$gradelevel' AND Title = 'Tuition Fee'");
			$lab = $oes->getSingleData("Breakdown", "Price", "GradeLevel = '$gradelevel' AND Title = 'Laboratory Fee'");
			$misc = $oes->getSingleData("Breakdown", "Price", "GradeLevel = '$gradelevel' AND Title = 'Miscellaneous Fee'");
			$other = $oes->getSingleData("Breakdown", "Price", "GradeLevel = '$gradelevel' AND Title = 'Other Fee'");
			mysql_query("INSERT INTO Assessment(ID, TuitionFee, LaboratoryFee, MiscellaneousFee, OtherFee) VALUES ('$id', '$tuition', '$lab', '$misc', '$other')");
			$oes->addFeed($id, "Welcome", "You are now registered as an enrollee.");
			$message = "Welcome, ".$oes->getNameFormat("f",$id)."!<br><br>Here are your login credentials!<br><br>Username: $username<br>Password: $password<br><br>Be sure to login at http://oes.juvarabrera.com to check updates for your account! See you soon!";
			$oes->sendEmail($id, "Registration", $message);
?>
			<h4>Message</h4>
			<p>You are now registered. We will send you an email for your username and password within 24 hours.</p>
			<p>-- Debug Log --</p>
			<p>Username: <?php echo $username; ?></p>
			<p>Password: <?php echo $password; ?></p>
<?php
		}
	} elseif($action == "addenrollee") {
		if(isset($_POST['gradelevel'], $_POST['fname'], $_POST['mname'], $_POST['lname'], $_POST['gender'], $_POST['bday'])) {
			$gradelevel = $_POST['gradelevel'];
			$firstname = $_POST['fname'];
			$middlename = $_POST['mname'];
			$lastname = $_POST['lname'];
			$gender = $_POST['gender'];
			$birthdate = $_POST['bday'];
			$id = $oes->generateTempAccountID();
			$username = $oes->generateTempUsername($id, $firstname, $middlename, $lastname);
			$password = $oes->generatePassword(8);
			$hash = $oes->generateHash(15);
			mysql_query("INSERT INTO Account (ID, Username, Password, Type, Status) VALUES ('$id', '$username', '$password', 'Enrollee', 'Active')");
			mysql_query("INSERT INTO Student (ID, Hash, FirstName, MiddleName, LastName, GradeLevel, GLS, Gender, BirthDate) VALUES ('$id', '$hash', '$firstname', '$middlename', '$lastname', '$gradelevel', '0', '$gender', '$birthdate')");
			if($gradelevel == 7) {
				$schedule = $oes->getScheduleDate("Exam");
			} else {
				$schedule = $oes->getScheduleDate("Interview");
			}
			mysql_query("INSERT INTO Enrollee(ID, AdmissionID, EnrollmentStatus) VALUES ('$id', '$schedule', 'Pending')");
			$tuition = $oes->getSingleData("Breakdown", "Price", "GradeLevel = '$gradelevel' AND Title = 'Tuition Fee'");
			$lab = $oes->getSingleData("Breakdown", "Price", "GradeLevel = '$gradelevel' AND Title = 'Laboratory Fee'");
			$misc = $oes->getSingleData("Breakdown", "Price", "GradeLevel = '$gradelevel' AND Title = 'Miscellaneous Fee'");
			$other = $oes->getSingleData("Breakdown", "Price", "GradeLevel = '$gradelevel' AND Title = 'Other Fee'");
			mysql_query("INSERT INTO Assessment(ID, TuitionFee, LaboratoryFee, MiscellaneousFee, OtherFee) VALUES ('$id', '$tuition', '$lab', '$misc', '$other')");
			$oes->addFeed($id, "Welcome", "You are now registered as an enrollee.");
			$message = "Welcome, ".$oes->getNameFormat("f",$id)."!<br><br>Here are your login credentials!<br><br>Username: $username<br>Password: $password<br><br>Be sure to login at http://oes.juvarabrera.com to check updates for your account! See you soon!";
			$oes->sendEmail($id, "Registration", $message);
		}
	} elseif($action == "updatestudent_info") {
		if(isset($_POST['id'], $_POST['firstname'], $_POST['middlename'], $_POST['lastname'], $_POST['auxname'], $_POST['gender'], $_POST['birthdate'], $_POST['birthplace'], $_POST['religion'], $_POST['status'], $_POST['citizenship'], $_POST['nostreetbrgy'], $_POST['city'], $_POST['province'], $_POST['country'], $_POST['zipcode'], $_POST['email'], $_POST['mobileno'], $_POST['fname'], $_POST['foccupation'], $_POST['mname'], $_POST['moccupation'], $_POST['gname'], $_POST['relationship'], $_POST['gaddress'], $_POST['sameaddress'], $_POST['gmobileno'], $_POST['gradeschool'], $_POST['namegradeschool'], $_POST['gsaddress'], $_POST['yeargraduate'])) {
			$id = $_POST['id'];
			$firstname = $_POST['firstname'];
			$middlename = $_POST['middlename'];
			$lastname = $_POST['lastname'];
			$auxname = $_POST['auxname'];
			$gender = $_POST['gender'];
			$birthdate = $_POST['birthdate'];
			$birthplace = $_POST['birthplace'];
			$religion = $_POST['religion'];
			$status = $_POST['status'];
			$citizenship = $_POST['citizenship'];
			$nostreetbrgy = $_POST['nostreetbrgy'];
			$city = $_POST['city'];
			$province = $_POST['province'];
			$country = $_POST['country'];
			$zipcode = $_POST['zipcode'];
			$email = $_POST['email'];
			$mobileno = $_POST['mobileno'];
			$fname = $_POST['fname'];
			$foccupation = $_POST['foccupation'];
			$mname = $_POST['mname'];
			$moccupation = $_POST['moccupation'];
			$gname = $_POST['gname'];
			$relationship = $_POST['relationship'];
			$gaddress = $_POST['gaddress'];
			$sameaddress = $_POST['sameaddress'];
			$gmobileno = $_POST['gmobileno'];
			$gradeschool = $_POST['gradeschool'];
			$namegradeschool = $_POST['namegradeschool'];
			$gsaddress = $_POST['gsaddress'];
			$yeargraduate = $_POST['yeargraduate'];
			if($sameaddress == "true") {
				$gaddress = $nostreetbrgy.', '.$city.', '.$province.', '.$country;
			}
			if($gradeschool == "Other") {
				$gradeschool = $namegradeschool;
			}
			$username = $oes->getSingleData("Account", "Username", "ID = '$id'");
			$username = $oes->updateUsername($username, $firstname, $middlename, $lastname);
			mysql_query("UPDATE Account SET Username = '$username' WHERE ID = '$id'");
			mysql_query("UPDATE Student SET FirstName = '$firstname', MiddleName = '$middlename', LastName = '$lastname', AuxiliaryName = '$auxname', Gender = '$gender', BirthDate = '$birthdate', BirthPlace = '$birthplace', Religion = '$religion', CivilStatus = '$status', Citizenship = '$citizenship', NoStreetBrgy = '$nostreetbrgy', CityMunicipality = '$city', ProvinceState = '$province', Country = '$country', ZipCode = '$zipcode', Email = '$email', MobileNo = '$mobileno', F_FullName = '$fname', F_Occupation = '$foccupation', M_FullName = '$mname', M_Occupation = '$moccupation', G_FullName = '$gname', G_Relationship = '$relationship', G_Address = '$gaddress', G_MobileNo = '$gmobileno', GradeSchool = '$gradeschool', Address = '$gsaddress', YearGraduate = '$yeargraduate' WHERE ID = '$id'");
		}
	} elseif($action == "login") {
		if(isset($_POST['oes_username'], $_POST['oes_password'])) {
			$username = mysql_escape_string($_POST['oes_username']);
			$password = mysql_escape_string($_POST['oes_password']);
			$query = mysql_query("SELECT * FROM Account WHERE Username = '$username' AND Password = '$password'");
			$n = 0;
			while($row = mysql_fetch_array($query)) {
				$n = 1;
				$oes = new OES();
				$_SESSION["loggedID"] = $oes->getID($username);
				$oes->loggedUser($_SESSION["loggedID"]);
			}
			mysql_query("INSERT INTO LoginCount (Username, Password, DateLogin, TimeLogin, LoggedIn) VALUES ('$username', '$password', '".$__CURDATE."', '".$__CURTIME."', $n)");
		}
		header("Location: index.php");
	} elseif($action == "logout") {
		session_destroy();
		header("Location: index.php");
	} elseif($action == "getcollege") {
		if(isset($_POST['alloption'])) {
			echo '<option value="all">All colleges</option>';
		}
		$colleges = $oes->getData("College", "*", "");
		foreach($colleges as $college) {
			echo '<option value="'.$college["ID"].'">'.$college["Code"].'</option>';
		}
	} elseif($action == "getcourse") {
		if(isset($_POST['collegeID'])) {
			$collegeID = $_POST['collegeID'];
			if(isset($_POST['alloption']))
				echo '<option value="all">All courses</option>';
			if(isset($_POST['nooption']))
				echo '<option value="null">No course</option>';
			if($collegeID == "all") {
				$courses = $oes->getData("Course", "*", "");
			} else {
				$courses = $oes->getData("Course", "*", "CollegeID = '$collegeID' ORDER BY Name");
			}
			foreach($courses as $course) {
				$selected = "";
				if(isset($_POST['equal'])) {
					$equal = $_POST['equal'];
					if($course["ID"] == $equal) 
						$selected = " selected";
				}
				echo '<option value="'.$course["ID"].'"'.$selected.'>'.$course["Code"].'</option>';
			}
		}
	} elseif($action == "getsection") {
		if(isset($_POST['gl'])) {
			$gl = $_POST['gl'];
			if(isset($_POST['alloption']))
				echo '<option value="all">All sections</option>';
			if(isset($_POST['nooption']))
				echo '<option value="null">No section</option>';
			if(isset($_POST['autoassign']))
				echo '<option value="assign">Auto assign</option>';
			if($gl != "all") {
				$query = mysql_query("SELECT * FROM GLS WHERE GradeLevel = '$gl'");
				while($row = mysql_fetch_array($query)) {
					$selected = "";
					if(isset($_POST['equal'])) {
						$equal = $_POST['equal'];
						if($row["Section"] == $equal) 
							$selected = " selected";
					}
					echo '<option value="'.$row["ID"].'"'.$selected.'>'.$row["Section"].'</option>';
				}
			}
			if(isset($_POST['definenew']))
				echo '<option value="new">Define new</option>';
		}
	} elseif($action == "getgradelevel") {
		for($i = 7; $i <= 10; $i++) {
			$selected = "";
			if(isset($_POST['equal'])) {
				$equal = $_POST['equal'];
				if($i == $equal) 
					$selected = " selected";
			}
			echo '<option value="'.$i.'"'.$selected.'>Grade '.$i.'</option>';
		}
	} elseif($action == "getterm") {
		if(isset($_POST['term'])) {
			$term = $_POST['term'];
			if(isset($_POST['alloption']))
				echo '<option value="all">All courses</option>';
			if(isset($_POST['nooption']))
				echo '<option value="null">No course</option>';
			$termtext = array("1st Semester", "2nd Semester", "3rd Semester", "Summer Term");
			for($i = 1; $i <= 4; $i++) {
				$selected = "";
				if($i == $term) 
					$selected = " selected";
				echo '<option value="'.$i.'"'.$selected.'>'.$termtext[$i-1].'</option>';
			}
		}
	} elseif($action == "getdepartment") {
		if(isset($_POST['collegeID'])) {
			$collegeID = $_POST['collegeID'];
			if(isset($_POST['nooption']))
				echo '<option value="null">No department</option>';
			if(isset($_POST['alloption']))
				echo '<option value="all">All departments</option>';
			if($collegeID == "all") {
				$departments = $oes->getData("Department", "*", "");
			} else {
				$departments = $oes->getData("Department", "*", "CollegeID = '$collegeID' ORDER BY Name");
			}
			foreach($departments as $department) {
				$selected = "";
				if(isset($_POST['equal'])) {
					$equal = $_POST['equal'];
					if($department["ID"] == $equal) 
						$selected = " selected";
				}
				echo '<option value="'.$department["ID"].'"'.$selected.'>'.$department["Code"].'</option>';
			}
		}
	} elseif($action == "getsubject") {
		if(isset($_POST['gradelevel'])) {
			$gradelevel = $_POST['gradelevel'];
			if(isset($_POST['nooption']))
				echo '<option value="null">No subjects</option>';
			if(isset($_POST['alloption']))
				echo '<option value="all">All subjects</option>';
			if($gradelevel == "all") {
				$subjects = $oes->getData("Subject", "*", "");
			} else {
				if(isset($_POST['except']))
					$subjects = $oes->getdata("Subject", "*", "ID NOT IN (SELECT SubjectID FROM Curriculum WHERE CourseID = '$gradelevel')");
				else
					$subjects = $oes->getData("Curriculum INNER JOIN Subject", "*", "SubjectID = Subject.ID AND CourseID = '$gradelevel' ORDER BY Name");
			}
			foreach($subjects as $subject) {
				$selected = "";
				if(isset($_POST['equal'])) {
					$equal = $_POST['equal'];
					if($subject["ID"] == $equal) 
						$selected = " selected";
				}
				echo '<option value="'.$subject["ID"].'"'.$selected.'>'.$subject["Code"].' - '.$subject["Name"].'</option>';
			}
		}
	} elseif($action == "getschedulesubject") {
		if(isset($_POST['gl'])) {
			$gl = $_POST['gl'];
			echo '<option value="Homeroom">Homeroom</option><option value="Recess">Recess</option><option value="Lunch">Lunch</option><option value="Club Meetings">Club Meetings</option>';
			$subjects = $oes->getData("Subject", "*", "1=1");
			foreach($subjects as $subject) {
				echo '<option value="'.$subject["ID"].'">'.$subject["Name"].'</option>';
			}
		}
	} elseif($action == "getcourseyear") {
		if(isset($_POST['courseID'])) {
			$courseID = $_POST['courseID'];
			if(isset($_POST['alloption']))
				echo '<option value="all">All years</option>';
			$years = $oes->getCourseYears($courseID);
			for($i = 1; $i <= $years; $i++) {
				$selected = "";
				if(isset($_POST['equal'])) {
					$equal = $_POST['equal'];
					if($i == $equal) 
						$selected = " selected";
				}
				echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
			}
		}
	} elseif($action == "getbuilding") {
		if(isset($_POST['alloption']))
			echo '<option value="all">All buildings</option>';
		if(isset($_POST['nooption']))
			echo '<option value="null">No buildings</option>';
		$buildings = $oes->getData("Building", "*", "");
		foreach($buildings as $building) {
			$selected = "";
			if(isset($_POST['equal'])) {
				$equal = $_POST['equal'];
				if($i == $equal) 
					$selected = " selected";
			}
			echo '<option value="'.$building["ID"].'"'.$selected.'>'.$building["Name"].'</option>';
		}
	} elseif($action == "getroom") {
		if(isset($_POST['buildingID'])) {
			$buildingID = $_POST['buildingID'];
			if(isset($_POST['alloption']))
				echo '<option value="all">All rooms</option>';
			if(isset($_POST['nooption']))
				echo '<option value="null">No rooms</option>';

			if(isset($_POST['getnotdefaultroom']))
				$rooms = $oes->getData("Room", "*", "BuildingID = '$buildingID' AND ID NOT IN (SELECT RoomID FROM GLS)");
			else
				$rooms = $oes->getData("Room", "*", "BuildingID = '$buildingID'");
			foreach($rooms as $room) {
				$selected = "";
				if(isset($_POST['equal'])) {
					$equal = $_POST['equal'];
					if($i == $equal) 
						$selected = " selected";
				}
				echo '<option value="'.$room["ID"].'"'.$selected.'>'.$room["Name"].'</option>';
			}
		}
	} elseif($action == "getgradeschool") {
		$schools = mysql_query("SELECT DISTINCT GradeSchool FROM Student WHERE GradeSchool IS NOT NULL");
		echo '<option value="Other">Other</option>';
		while($school = mysql_fetch_array($schools)) {
			$selected = "";
			if(isset($_POST['equal'])) {
				$equal = $_POST['equal'];
				if($school["GradeSchool"] == $equal)
					$selected = " selected";
			}
			echo '<option value="'.$school["GradeSchool"].'"'.$selected.'>'.$school["GradeSchool"].'</option>';
		}
	} elseif($action == "getexpertise") {
		if(isset($_POST['faculty'])) {
			$faculty = $_POST['faculty'];
			$expertises = $oes->getData("Expertise", "*", "FacultyID = '$faculty'");
			if(isset($_POST['alloption']))
				echo '<option value="all">All expertise</option>';
			foreach($expertises as $expertise) {
				echo '<option value="'.$expertise["SubjectID"].'">'.$oes->getSingleData("Subject", "Name", "ID = '".$expertise["SubjectID"]."'").'</option>';
			}
		}
	} elseif($action == "getavailableschedule") {
		if(isset($_POST['faculty'])) {
			$faculty = $_POST['faculty'];
			if(isset($_POST['expertise']))
				$data = mysql_query("SELECT DISTINCT SubjectID, SectionID FROM Schedule WHERE (FacultyID IS NULL OR FacultyID = '0') AND SubjectID = '".$_POST['expertise']."' ORDER BY SectionID, SubjectID");
			else
				$data = mysql_query("SELECT DISTINCT SubjectID, SectionID FROM Schedule WHERE (FacultyID IS NULL OR FacultyID = '0') AND SubjectID IN (SELECT SubjectID FROM Expertise WHERE FacultyID = '$faculty') ORDER BY SectionID, SubjectID");
			while($schedule = mysql_fetch_array($data)) {
			?>
			<li>
				<a id="op_<?php echo $schedule["SubjectID"].'_'.$schedule["SectionID"]; ?>"><?php
				echo '<b>'.$oes->getSingleData("Subject", "Name", "ID = '".$schedule["SubjectID"]."'").'</b><br><small>Grade '.$oes->getSingleData("GLS", "GradeLevel", "ID = '".$schedule["SectionID"]."'").$oes->getSingleData("GLS", "Section", "ID = '".$schedule["SectionID"]."'").'<br>';
				$getdatetime = $oes->getData("Schedule", "*", "SectionID ='".$schedule["SectionID"]."' AND SubjectID = '".$schedule["SubjectID"]."'");
				$first = true;
				foreach($getdatetime as $datetime) {
					if($first) {
						$first = false;
						echo $datetime["Day"].' - '.date("g:i a", strtotime($datetime["StartTime"])).' - '.date("g:i a", strtotime($datetime["EndTime"]));
					} else {
						echo '<br>'.$datetime["Day"].' - '.date("g:i a", strtotime($datetime["StartTime"])).' - '.date("g:i a", strtotime($datetime["EndTime"]));
					}
				}
				?></small></a>
			</li>
			<script>
			$(document).ready(function() {
				$("#bottom-sheet #op_<?php echo $schedule["SubjectID"].'_'.$schedule["SectionID"]; ?>").click(function() {
					$("#loading").show("slow");
					$("#bottom-sheet ul#availableschedule").html("");
					$.ajax({
						type: "post",
						cache: true,
						url: "process.php?action=addfacultyschedule",
						data: {faculty: '<?php echo $faculty; ?>', section: '<?php echo $schedule["SectionID"]; ?>', subject: '<?php echo $schedule["SubjectID"]; ?>'},
						success: function(html) {
							showElement('none');
							$("#snackbar .wrapper").html(html);
							refreshListFacultySchedule('<?php echo $faculty; ?>');
						}
					})
				});
			})
			</script>
			<?php
			}
		}
	} elseif($action == "listcollege") {
?>
	<div class="card">
		<a onclick="showBottomSheet('addcollege');" class="float_button ic_plus_white icon_medium pos_top_right"></a>
		<table class="list" id="tableListCollege">
			<tr class="title">
				<td width="1px">
					<label id="chkAll"><input type="checkbox"><span></span></label>
				</td>
				<td colspan="2">College</td>
			</tr>
		<?php
		$tableData = $oes->getData("College", "*", "");
		if(!empty($tableData)) {
			foreach($tableData as $data) {
			?>
			<tr>
				<td>
					<label class="checkData" id="chk_<?php echo $data["ID"]; ?>"><input type="checkbox" value="<?php echo $data["ID"]; ?>"><span></span></label>
				</td>
				<td class="primary">
					<span><?php echo $data["Name"]; ?></span>
					<span><?php echo $data["Code"]; ?></span>
				</td>
				<td>
					<ul class="button-container">
						<li>
							<a id="btnEdit_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_pencil showhover"></a>
							<a id="btnDelete_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
						</li>
					</ul>
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#btnEdit_<?php echo $data["ID"]; ?>").click(function() {
					showBottomSheet('editcollege', '<?php echo $data["ID"]; ?>');
				});
				$("#btnDelete_<?php echo $data["ID"]; ?>").click(function() {
					showDialogBox('deletecollege', '<?php echo $data["ID"]; ?>');
				});
			});
			</script>
			<?php
			}
			scriptCheckedData("#tableListCollege");
		} else {
		?>
			<tr>
				<td></td>
				<td colspan="2" align="center">
					No result found.
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#tableListCollege #chkAll").css({"visibility": "hidden"});
			});
			</script>
		<?php
		}
		?>
		</table>
	</div>
	<script>
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getdataaction",
		data: {module: "college"},
		success: function(html) {
			$("#data-action-bar #actions").html(html)
		}
	})
	</script>
<?php
	} elseif($action == "listcurriculum") {
?>
	<div class="card">
		<a onclick="btnAddCurriculum_Click()" class="float_button ic_plus_white icon_medium pos_top_right"></a>
		<script>
		function btnAddCurriculum_Click() {
			$gl = $("#frmSearch select[name='gradelevel']").val();
			showBottomSheet('addcurriculum', $gl);
		}
		</script>
		<table class="list" id="tableListCurriculum">
		<?php
		if(isset($_POST['gradelevel'])) {
			if($_POST['gradelevel'] != "") {
				$gradelevel = $_POST['gradelevel'];
			}
		}
		$chkAll = true;
		$filter = "";
		if($gradelevel != "")
			$filter .= " AND YearLevel = '$gradelevel' ";
		?>
			<tr class="title">
				<td width="1px">
					<?php 
					if($chkAll) {
						$chkAll = false;
					?>
					<label id="chkAll"><input type="checkbox"><span></span></label>
					<?php
					}
					?>
				</td>
				<td colspan="2">Grade <?php echo $gradelevel; ?></td>
			</tr>
				<?php
				$additional = "1=1 $filter";
				$tableData = $oes->getData("Curriculum", "*", $additional);
				if(!empty($tableData)) {
					foreach($tableData as $data) {
					?>
			<tr>
				<td>
					<label class="checkData" id="chk_<?php echo $data["ID"]; ?>"><input type="checkbox" value="<?php echo $data["ID"]; ?>"><span></span></label>
				</td>
				<td class="primary">
					<span><?php echo $oes->getSingleData("Subject", "Name", "ID = '".$data["SubjectID"]."'"); ?></span>
					<span><?php echo $u = $oes->getSingleData("Subject", "Units", "ID = '".$data["SubjectID"]."'"); if($u != 1) echo ' units'; else echo ' unit'; ?></span>
				</td>
			</tr>
					<?php
					}
				} else {
				?>
			<tr>
				<td></td>
				<td align="center">
					Not set.
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#tableListCurriculum #chkAll").css({"visibility": "hidden"});
			});
			</script>
			<?php
		}
		?>
		</table>
	</div>
	<?php
	scriptCheckedData("#tableListCurriculum");
	?>
	<script>
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getdataaction",
		data: {module: "curriculum"},
		success: function(html) {
			$("#data-action-bar #actions").html(html)
		}
	})
	</script>
<?php
	} elseif($action == "listbuilding") {
?>
	<div class="card">
		<a onclick="showBottomSheet('addbuilding');" class="float_button ic_plus_white icon_medium pos_top_right"></a>
		<table class="list" id="tableListBuilding">
			<tr class="title">
				<td<?php 
				if($systatus == 1) {
					echo ' class="hide"';
				} else {
					echo ' width="1px"';
				}
				?>>
					<label id="chkAll"><input type="checkbox"><span></span></label>
				</td>
				<td colspan="2">Building</td>
			</tr>
		<?php
		$tableData = $oes->getData("Building", "*", "");
		if(!empty($tableData)) {
			foreach($tableData as $data) {
			?>
			<tr>
				<td<?php 
				if($systatus == 1) {
					echo ' class="hide"';
				} else {
					echo ' width="1px"';
				}
				?>>
					<label class="checkData" id="chk_<?php echo $data["ID"]; ?>"><input type="checkbox" value="<?php echo $data["ID"]; ?>"><span></span></label>
				</td>
				<td class="primary">
					<span><?php echo $data["Name"]; ?></span>
					<span><?php echo $data["Code"]; ?></span>
				</td>
				<td>
					<ul class="button-container">
						<li>
							<a id="btnEdit_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_pencil showhover"></a>
							<?php
							if($systatus == 0) {
							?>
							<a id="btnDelete_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
							<?php
							}
							?>
						</li>
					</ul>
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#btnEdit_<?php echo $data["ID"]; ?>").click(function() {
					showBottomSheet('editbuilding', '<?php echo $data["ID"]; ?>');
				});
				$("#btnDelete_<?php echo $data["ID"]; ?>").click(function() {
					showDialogBox('deletebuilding', '<?php echo $data["ID"]; ?>');
				});
			});
			</script>
			<?php
			}
			scriptCheckedData("#tableListBuilding");
		} else {
		?>
			<tr>
				<td></td>
				<td colspan="2" align="center">
					No result found.
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#tableListBuilding #chkAll").css({"visibility": "hidden"});
			});
			</script>
		<?php
		}
		?>
		</table>
	</div>
	<script>
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getdataaction",
		data: {module: "building"},
		success: function(html) {
			$("#data-action-bar #actions").html(html)
		}
	})
	</script>
<?php
	} elseif($action == "listadmin") {
?>
	<div class="card">
		<a onclick="showBottomSheet('addadmin');" class="float_button pos_top_right ic_plus_white icon_medium"></a>
		<table class="list" id="tableListAdmin">
			<tr class="title">
				<td width="1px">
					<label id="chkAll"><input type="checkbox"><span></span></label>
				</td>
				<td colspan="2"><?php echo $results = $oes->getNum("Account", "Account.Type = 'Custom' AND Account.Status = 'Active'"); if($results > 1) echo ' accounts'; else echo ' account'; ?></td>
			</tr>
			<?php
			$tableData = $oes->getData("Account", "*", "Account.Type = 'Custom' AND Account.Status = 'Active'");
			if(!empty($tableData)) {
				foreach($tableData as $data) {
				?>
			<tr>
				<td>
					<label class="checkData" id="chk_<?php echo $data["ID"]; ?>"><input type="checkbox" value="<?php echo $data["ID"]; ?>"><span></span></label>
				</td>
				<td class="primary">
					<span><?php echo $data["Username"]; ?></span>
				</td>
				<td width="1px">
					<ul class="button-container">
						<li>
							<a id="btnEdit_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_pencil showhover"></a>
							<a id="btnDelete_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
						</li>
					</ul>
				</td>
			</tr>
				<script>
				$(document).ready(function() {
					$("#btnEdit_<?php echo $data["ID"]; ?>").click(function() {
						showBottomSheet('editadmin', '<?php echo $data["ID"]; ?>');
					});
					$("#btnDelete_<?php echo $data["ID"]; ?>").click(function() {
						showDialogBox('deleteadmin', '<?php echo $data["ID"]; ?>');
					});
				});
				</script>
				<?php
				}
				scriptCheckedData("#tableListAdmin");
			} else {
			?>
			<tr>
				<td></td>
				<td colspan="2" align="center">
					No result found.
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#tableListAdmin #chkAll").css({"visibility": "hidden"});
			});
			</script>
			<?php
			}
			?>
		</table>
	</div>
	<script>
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getdataaction",
		data: {module: "admin"},
		success: function(html) {
			$("#data-action-bar #actions").html(html);
		}
	})
	</script>
	</div>
<?php
	} elseif($action == "liststudent") {
?>
	<?php
	$query = $oes->getData("Student INNER JOIN Account", "*", "Student.ID = Account.ID AND Account.Type = 'Student' AND GLS = '0' AND Account.Status = 'Active'");
	if(!empty($query)) {
	?>
	<div class="card" id="card-warning">
		<h4><span class="flat_icon ic_warning"></span>Warning</h4>
		<p><?php echo sizeof($query); if(sizeof($query) > 1) echo ' students'; else echo ' student';  ?> doesn't have a section. We can automatically assign them for you.</p>
		<ul class="button-container right">
			<li><a onclick="dismissCard('warning', 'swipe-left');" class="flat_button">Dismiss</a></li>
			<li><a onclick="showDialogBox('auto_assign_students_to_section');" class="raised_button">Assign now</a></li>
		</ul>
	</div>
	<?php
	}
	?>
	<div class="card">
		<a onclick="showBottomSheet('addstudent');" class="float_button pos_top_right ic_plus_white icon_medium"></a>
		<?php
		$p = 1;
		if(isset($_POST['p']))
			$p = $_POST['p'];
		if(isset($_POST['pp'])) {
			if($_POST['pp'] == "All")
				$rowPerPage = 0;
			else
				$rowPerPage = $_POST['pp'];
		}
		$startFrom = ($p-1) * $rowPerPage;
		$filter = "";
		if(isset($_POST['search'])) {
			if($_POST['search'] != "") {
				$search = mysql_escape_string($_POST['search']);
				$filter .= " AND (CONCAT(Student.FirstName, ' ', Student.MiddleName, ' ', Student.LastName) LIKE '%$search%' OR Account.ID LIKE '%$search%') ";
			}
		}
		if(isset($_POST['gl'])) {
			if($_POST['gl'] != "all") {
				$gl = $_POST['gl'];
				$filter .= " AND Student.GradeLevel = '$gl' ";
			}
		}
		if(isset($_POST['section'])) {
			$section = $_POST['section'];
			if($section == "null") {
				$filter .= " AND Student.GLS = '0'";
			} elseif($section != "all") {
				$filter .= " AND Student.GLS = '$section' ";
			}
		}
		$additional = "Account.Type = 'Student' AND Account.ID = Student.ID AND Account.Status = 'Active' $filter LIMIT $startFrom, $rowPerPage";
		if($rowPerPage == 0) 
			$additional = "Account.Type = 'Student' AND Account.ID = Student.ID AND Account.Status = 'Active' $filter";
		?>
		<table class="list" id="tableListStudent">
			<tr class="title">
				<td width="1px">
					<label id="chkAll"><input type="checkbox"><span></span></label>
				</td>
				<td colspan="2"><?php echo $results = $oes->getNum("Account INNER JOIN Student", "Account.Type = 'Student' AND Account.ID = Student.ID AND Account.Status = 'Active' $filter"); if($results > 1) echo ' students'; else echo ' student'; ?></td>
			</tr>
			<?php
			$tableData = $oes->getData("Account INNER JOIN Student", "*", $additional);
			if(!empty($tableData)) {
				foreach($tableData as $data) {
				?>
			<tr>
				<td>
					<label class="checkData" id="chk_<?php echo $data["ID"]; ?>"><input type="checkbox" value="<?php echo $data["ID"]; ?>"><span></span></label>
				</td>
				<td class="primary">
					<span>
						<?php 
						echo $oes->getNameFormat("l, f M.", $data["ID"]); 
						if($data["GLS"] == 0) {
							echo '<i class="flat_icon ic_warning" title="No section"></i>';
						}
						?>
					</span>
					<span><?php echo $data["ID"]; ?></span>
				</td>
				<td width="1px">
					<ul class="button-container">
						<li>
							<a id="btnEdit_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_pencil showhover"></a>
							<a id="btnArchive_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_archive showhover"></a>
							<a id="btnDelete_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
						</li>
					</ul>
				</td>
			</tr>
				<script>
				$(document).ready(function() {
					$("#btnEdit_<?php echo $data["ID"]; ?>").click(function() {
						showBottomSheet('editstudent', '<?php echo $data["ID"]; ?>');
					});
					$("#btnArchive_<?php echo $data["ID"]; ?>").click(function() {
						showDialogBox('archivestudent', '<?php echo $data["ID"]; ?>');
					});
					$("#btnDelete_<?php echo $data["ID"]; ?>").click(function() {
						showDialogBox('deletestudent', '<?php echo $data["ID"]; ?>');
					});
				});
				</script>
				<?php
				}
				scriptCheckedData("#tableListStudent");
			} else {
			?>
			<tr>
				<td></td>
				<td colspan="2" align="center">
					No result found.
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#tableListStudent #chkAll").css({"visibility": "hidden"});
			});
			</script>
			<?php
			}
			?>
		</table>
	</div>
	<script>
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getdataaction",
		data: {module: "student"},
		success: function(html) {
			$("#data-action-bar #actions").html(html);
		}
	})
	</script>
		<?php
		showPagination("SELECT * FROM Account INNER JOIN Student WHERE Account.Type = 'Student' AND Account.ID = Student.ID AND Account.Status = 'Active'", $filter, $rowPerPage, $p, "refreshListStudent();");
	} elseif($action == "listenrollee") {
		$check = $oes->getData("Account INNER JOIN Student INNER JOIN Enrollee", "*", "Account.ID = Student.ID AND Account.ID = Enrollee.ID AND Account.Type = 'Enrollee' AND Enrollee.EnrollmentStatus = 'Pending' AND Account.Status = 'Active' AND Enrollee.AdmissionID = '0'");
		if(sizeof($check) > 0) {
		?>
	<div class="card" id="card-warning">
		<h4><span class="flat_icon ic_warning"></span>Warning</h4>
		<p>Some enrollees doesn't have an admission date set. To fix this, add admission dates and automatically assign them.</p>
		<ul class="button-container right">
			<li><a onclick="dismissCard('warning', 'swipe-left');" class="flat_button">Dismiss</a></li>
			<li><a href="?admission-dates" class="raised_button">Add Admission Dates</a></li>
		</ul>
	</div>
		<?php
		}
?>
	<div class="card">
		<a onclick="showBottomSheet('addenrollee');" class="float_button pos_top_right ic_plus_white icon_medium"></a>
		<?php
		$p = 1;
		if(isset($_POST['p']))
			$p = $_POST['p'];
		if(isset($_POST['pp'])) {
			if($_POST['pp'] == "All")
				$rowPerPage = 0;
			else
				$rowPerPage = $_POST['pp'];
		}
		$startFrom = ($p-1) * $rowPerPage;
		$filter = "";
		if(isset($_POST['search'])) {
			if($_POST['search'] != "") {
				$search = mysql_escape_string($_POST['search']);
				$filter .= " AND (CONCAT(Student.FirstName, ' ', Student.MiddleName, ' ', Student.LastName) LIKE '%$search%' OR Account.ID LIKE '%$search%') ";
			}
		}
		if(isset($_POST['gl'])) {
			if($_POST['gl'] != "all") {
				$gl = $_POST['gl'];
				$filter .= " AND Student.GradeLevel = '$gl' ";
			}
		}
		if(isset($_POST['status'])) {
			$status = $_POST['status'];
			$filter .= " AND Enrollee.EnrollmentStatus = '$status' ";
		}
		$additional = "Account.Type = 'Enrollee' AND Account.ID = Student.ID AND Account.ID = Enrollee.ID AND Account.Status = 'Active' $filter LIMIT $startFrom, $rowPerPage";
		if($rowPerPage == 0) 
			$additional = "Account.Type = 'Enrollee' AND Account.ID = Student.ID AND Account.ID = Enrollee.ID AND Account.Status = 'Active' $filter";
		?>
		<table class="list" id="tableListEnrollee">
			<tr class="title">
				<td width="1px">
					<label id="chkAll"><input type="checkbox"><span></span></label>
				</td>
				<td colspan="2"><?php echo $results = $oes->getNum("Account INNER JOIN Student INNER JOIN Enrollee", "Account.Type = 'Enrollee' AND Account.ID = Student.ID AND Account.ID = Enrollee.ID AND Account.Status = 'Active' $filter"); if($results > 1) echo ' students'; else echo ' student'; ?></td>
			</tr>
			<?php
			$tableData = $oes->getData("Account INNER JOIN Student INNER JOIN Enrollee", "*", $additional);
			if(!empty($tableData)) {
				foreach($tableData as $data) {
				?>
			<tr>
				<td>
					<label class="checkData" id="chk_<?php echo $data["ID"]; ?>"><input type="checkbox" value="<?php echo $data["ID"]; ?>"><span></span></label>
				</td>
				<td class="primary">
					<span>
						<?php 
						echo $oes->getNameFormat("l, f M.", $data["ID"]);
						if($data["AdmissionID"] == 0) {
							echo '<i class="flat_icon ic_warning" title="No admission date"></i>';
						}
						?>
					</span>
					<span><?php echo $data["ID"]; ?></span>
				</td>
				<td width="1px">
					<ul class="button-container">
						<li>
							<a id="btnEdit_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_pencil showhover"></a>
							<a id="btnArchive_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_archive showhover"></a>
							<a id="btnDelete_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
						</li>
					</ul>
				</td>
			</tr>
				<script>
				$(document).ready(function() {
					$("#btnEdit_<?php echo $data["ID"]; ?>").click(function() {
						showBottomSheet('editenrollee', '<?php echo $data["ID"]; ?>');
					});
					$("#btnArchive_<?php echo $data["ID"]; ?>").click(function() {
						showDialogBox('archiveenrollee', '<?php echo $data["ID"]; ?>');
					});
					$("#btnDelete_<?php echo $data["ID"]; ?>").click(function() {
						showDialogBox('deleteenrollee', '<?php echo $data["ID"]; ?>');
					});
				});
				</script>
				<?php
				}
				scriptCheckedData("#tableListEnrollee");
			} else {
			?>
			<tr>
				<td></td>
				<td colspan="2" align="center">
					No result found.
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#tableListEnrollee #chkAll").css({"visibility": "hidden"});
			});
			</script>
			<?php
			}
			?>
		</table>
	</div>
	<script>
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getdataaction",
		data: {module: "enrollee"},
		success: function(html) {
			$("#data-action-bar #actions").html(html);
		}
	})
	</script>
		<?php
		showPagination("SELECT * FROM Account INNER JOIN Student INNER JOIN Enrollee WHERE Account.Type = 'Enrollee' AND Account.ID = Student.ID AND Account.ID = Enrollee.ID AND Account.Status = 'Active'", $filter, $rowPerPage, $p, "refreshListEnrollee();");
	} elseif($action == "listpassedenrollee") {
?>
	<div class="card">
		<?php
		$p = 1;
		if(isset($_POST['p']))
			$p = $_POST['p'];
		if(isset($_POST['pp'])) {
			if($_POST['pp'] == "All")
				$rowPerPage = 0;
			else
				$rowPerPage = $_POST['pp'];
		}
		$startFrom = ($p-1) * $rowPerPage;
		$filter = "";
		if(isset($_POST['search'])) {
			if($_POST['search'] != "") {
				$search = mysql_escape_string($_POST['search']);
				$filter .= " AND (CONCAT(Student.FirstName, ' ', Student.MiddleName, ' ', Student.LastName) LIKE '%$search%' OR Account.ID LIKE '%$search%') ";
			}
		}
		if(isset($_POST['gl'])) {
			if($_POST['gl'] != "all") {
				$gl = $_POST['gl'];
				$filter .= " AND Student.GradeLevel = '$gl' ";
			}
		}
		$additional = "Account.Type = 'Enrollee' AND Account.ID = Student.ID AND Account.ID = Enrollee.ID AND Enrollee.EnrollmentStatus = 'Passed' AND Account.Status = 'Active' $filter LIMIT $startFrom, $rowPerPage";
		if($rowPerPage == 0) 
			$additional = "Account.Type = 'Enrollee' AND Account.ID = Student.ID AND Account.ID = Enrollee.ID AND Enrollee.EnrollmentStatus = 'Passed' $filter AND Account.Status = 'Active'";
		?>
		<table class="list" id="tableListPassedEnrollee">
			<tr class="title">
				<td width="1px">
					<label id="chkAll"><input type="checkbox"><span></span></label>
				</td>
				<td colspan="2"><?php echo $results = $oes->getNum("Account INNER JOIN Student INNER JOIN Enrollee", "Account.Type = 'Enrollee' AND Account.ID = Student.ID AND Account.ID = Enrollee.ID AND Enrollee.EnrollmentStatus = 'Passed' AND Account.Status = 'Active' $filter"); if($results > 1) echo ' students'; else echo ' student'; ?></td>
			</tr>
			<?php
			$tableData = $oes->getData("Account INNER JOIN Student INNER JOIN Enrollee", "*", $additional);
			if(!empty($tableData)) {
				foreach($tableData as $data) {
				?>
			<tr>
				<td>
					<label class="checkData" id="chk_<?php echo $data["ID"]; ?>"><input type="checkbox" value="<?php echo $data["ID"]; ?>"><span></span></label>
				</td>
				<td class="primary">
					<span><?php echo $oes->getNameFormat("l, f M.", $data["ID"]); ?></span>
					<span><?php echo $data["ID"]; ?></span>
				</td>
				<td width="1px">
					<ul class="button-container">
						<li>
							<a id="btnConfirm_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_done showhover"></a>
							<a id="btnArchive_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_archive showhover"></a>
							<a id="btnDelete_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
						</li>
					</ul>
				</td>
			</tr>
				<script>
				$(document).ready(function() {
					$("#btnConfirm_<?php echo $data["ID"]; ?>").click(function() {
						showDialogBox('confirmenrollee', '<?php echo $data["ID"]; ?>');
					});
					$("#btnArchive_<?php echo $data["ID"]; ?>").click(function() {
						showDialogBox('archiveenrollee', '<?php echo $data["ID"]; ?>');
					});
					$("#btnDelete_<?php echo $data["ID"]; ?>").click(function() {
						showDialogBox('deleteenrollee', '<?php echo $data["ID"]; ?>');
					});
				});
				</script>
				<?php
				}
				scriptCheckedData("#tableListPassedEnrollee");
			} else {
			?>
			<tr>
				<td></td>
				<td colspan="2" align="center">
					No result found.
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#tableListPassedEnrollee #chkAll").css({"visibility": "hidden"});
			});
			</script>
			<?php
			}
			?>
		</table>
	</div>
	<script>
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getdataaction",
		data: {module: "passedenrollee"},
		success: function(html) {
			$("#data-action-bar #actions").html(html);
		}
	})
	</script>
		<?php
		showPagination("SELECT * FROM Account INNER JOIN Student INNER JOIN Enrollee WHERE Account.Type = 'Enrollee' AND Account.ID = Student.ID AND Account.ID = Enrollee.ID AND Enrollee.EnrollmentStatus = 'Passed' AND Account.Status = 'Active'", $filter, $rowPerPage, $p, "refreshListPassedEnrollee();");
	} elseif($action == "listfaculty") {
?>
	<div class="card">
		<a onclick="showBottomSheet('addfaculty');" class="float_button pos_top_right ic_plus_white icon_medium"></a>
		<?php
		$p = 1;
		if(isset($_POST['p']))
			$p = $_POST['p'];
		if(isset($_POST['pp'])) {
			if($_POST['pp'] == "All")
				$rowPerPage = 0;
			else
				$rowPerPage = $_POST['pp'];
		}
		$startFrom = ($p-1) * $rowPerPage;
		$filter = "";
		if(isset($_POST['search'])) {
			if($_POST['search'] != "") {
				$search = mysql_escape_string($_POST['search']);
				$filter .= " AND (CONCAT(FirstName, ' ', MiddleName, ' ', LastName) LIKE '%$search%' OR Account.ID LIKE '%$search%') ";
			}
		}
		if(isset($_POST['college'])) {
			if($_POST['college'] != "all") {
				$college = $_POST['college'];
				$filter .= " AND Department IN (SELECT ID FROM Department WHERE CollegeID = '$college') ";
			}
		}
		if(isset($_POST['department'])) {
			if($_POST['department'] == "null") {
				$filter .= " AND Department IS NULL ";
			} elseif($_POST['department'] != "all") {
				$department = $_POST['department'];
				$filter .= " AND Department = '$department' ";
			}
		}
		$additional = "Type = 'Faculty' AND Account.ID = Faculty.ID AND Account.Status = 'Active' $filter LIMIT $startFrom, $rowPerPage";
		if($rowPerPage == 0) 
			$additional = "Type = 'Faculty' AND Account.ID = Faculty.ID AND Account.Status = 'Active' $filter";
		?>
		<table class="list" id="tableListFaculty">
			<tr class="title">
				<td width="1px">
					<label id="chkAll"><input type="checkbox"><span></span></label>
				</td>
				<td colspan="2"><?php echo $results = $oes->getNum("Account INNER JOIN Faculty", "Type = 'Faculty' AND Account.ID = Faculty.ID AND Account.Status = 'Active' $filter"); if($results > 1) echo ' teachers'; else echo ' teacher'; ?></td>
			</tr>
			<?php
			$tableData = $oes->getData("Account INNER JOIN Faculty", "*", $additional);
			if(!empty($tableData)) {
				foreach($tableData as $data) {
				?>
			<tr>
				<td>
					<label class="checkData" id="chk_<?php echo $data["ID"]; ?>"><input type="checkbox" value="<?php echo $data["ID"]; ?>"><span></span></label>
				</td>
				<td class="primary">
					<span>
						<?php 
						echo $oes->getNameFormat("l, f M.", $data["ID"]); 
						$check = $oes->getData("Expertise", "*", "FacultyID ='".$data["ID"]."'");
						if(sizeof($check) == 0) {
							echo '<i class="flat_icon ic_warning" title="No expertise"></i>';
						}
						?>
					</span>
					<span><?php echo $data["ID"]; ?></span>
				</td>
				<td>
					<ul class="button-container">
						<li>
							<a id="btnEdit_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_pencil showhover"></a>
							<a id="btnArchive_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_archive showhover"></a>
							<a id="btnDelete_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
						</li>
					</ul>
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#btnEdit_<?php echo $data["ID"]; ?>").click(function() {
					showBottomSheet('editfaculty', '<?php echo $data["ID"]; ?>');
				});
				$("#btnArchive_<?php echo $data["ID"]; ?>").click(function() {
					showDialogBox('archivefaculty', '<?php echo $data["ID"]; ?>');
				});
				$("#btnDelete_<?php echo $data["ID"]; ?>").click(function() {
					showDialogBox('deletefaculty', '<?php echo $data["ID"]; ?>');
				});
			});
			</script>
				<?php
				}
				scriptCheckedData("#tableListFaculty");
			} else {
			?>
			<tr>
				<td></td>
				<td colspan="2" align="center">
					No result found.
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#tableListFaculty #chkAll").css({"visibility": "hidden"});
			});
			</script>
			<?php
			}
			?>
		</table>
	</div>
	<script>
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getdataaction",
		data: {module: "faculty"},
		success: function(html) {
			$("#data-action-bar #actions").html(html)
		}
	})
	</script>
		<?php
		showPagination("SELECT * FROM Account INNER JOIN Faculty WHERE Type = 'Faculty' AND Account.ID = Faculty.ID AND Account.Status = 'Active'", $filter, $rowPerPage, $p, "refreshListFaculty();");
	} elseif($action == "listfacultyschedule") {
		if(isset($_POST['faculty'])) {
			$faculty = $_POST['faculty'];
			?>
			<div class="card">
				<table class="form-container">
					<tr>
						<td width="50%"><label>Faculty Name</label><br><?php echo $oes->getNameFormat("f M. l", $faculty); ?></td>
						<td><label>Total Load</label><br><?php echo $units = $oes->getTotalLoad($faculty); echo ' '.($units > 1 ? 'units' : 'unit'); ?></td>
					</tr>
				</table>
			</div>
			<?php
			$expertise = $oes->getData("Expertise", "*", "FacultyID = '$faculty'");
			if(empty($expertise)) {
			?>
			<div class="card">
				<h4><span class="flat_icon ic_warning"></span>Warning</h4>
				<p>This faculty doesn't have any expertise assigned. You should assign an expertise first before assigning this faculty to a schedule.</p>
				<ul class="button-container right">
					<li><a onclick="showBottomSheet('addexpertise', ['<?php echo $faculty; ?>']);" class="raised_button">Add Expertise</a></li>
				</ul>
			</div>
			<?php
			}
			?>
			<div class="card">
				<?php
				if(!empty($expertise) && $systatus == 0) {
				?>
				<a onclick="showBottomSheet('addfacultyschedule', '<?php echo $faculty; ?>');" class="float_button pos_top_right ic_plus_white icon_medium"></a>
				<?php
				}
				?>
				<h4>Schedule</h4>
				<table class="list" id="tableListFacultySchedule">
					<?php
					$days = array("M", "T", "W", "H", "F");

					foreach($days as $day) {
					?>
					<tr class="title">
						<td<?php 
						if($systatus == 1) {
							echo ' class="hide"';
						} else {
							echo ' width="1px"';
						}
						?>>
						</td>
						<td colspan="2"><?php echo $oes->getFullDayName($day); ?></td>
					</tr>
					<?php
						$schedule = $oes->getData("Schedule", "*", "FacultyID = '$faculty' AND Day = '".$day."' ORDER BY StartTime ASC");
						if(!empty($schedule)) {
							foreach($schedule as $s) {
					?>
					<tr>
						<td<?php 
						if($systatus == 1) {
							echo ' class="hide"';
						} else {
							echo ' width="1px"';
						}
						?>>
							<?php
							if($s["SubjectID"] != null) {
							?>
							<label class="checkData" id="chk_<?php echo $s["ID"]; ?>"><input type="checkbox" value="<?php echo $s["ID"]; ?>"><span></span></label>
							<?php
							}
							?>
						</td>
						<td class="primary">
							<span><?php echo ($s["SubjectID"] == null ? $s["Break"] : $oes->getSingleData("Subject", "Name", "ID = '".$s["SubjectID"]."'")); ?></span>
							<span><?php echo date('g:i a', strtotime($s["StartTime"])).' - '.date('g:i a', strtotime($s["EndTime"])); ?></span>
						</td>
						<td>
							<ul class="button-container">
								<li>
									<a id="btnInfo_<?php echo $s["ID"]; ?>" class="flat_icon_20 ic_info_outline showhover"></a>
									<?php
									if($systatus == 0 && $s["SubjectID"] != null) {
									?>
									<a id="btnDelete_<?php echo $s["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
									<?php
									}
									?>
								</li>
							</ul>
						</td>
					</tr>
					<script>
					$(document).ready(function() {
						$("#btnInfo_<?php echo $s["ID"]; ?>").click(function() {
							showDialogBox('infofacultyschedule', '<?php echo $s["ID"]; ?>');
						});
						$("#btnDelete_<?php echo $s["ID"]; ?>").click(function() {
							showDialogBox('deletefacultyschedule', '<?php echo $s["ID"]; ?>');
						});
					});
					</script>
					<?php
							}
						} else {
					?>
					<tr>
						<td<?php 
					if($systatus == 1) {
						echo ' class="hide"';
					} else {
						echo ' width="1px"';
					}
					?>></td>
						<td colspan="2"><center><small><i>No schedule assigned in this day.</i></small></center></td>
					</tr>
					<?php
						}
					}
					scriptCheckedData("#tableListFacultySchedule");
					?>
				</table>
			</div>
			<script>
			$.ajax({
				type: "post",
				cache: true,
				url: "process.php?action=getdataaction",
				data: {module: "facultyschedule"},
				success: function(html) {
					$("#data-action-bar #actions").html(html)
				}
			});
			</script>
		<?php
		}
	} elseif($action == "listcourse") {
?>
	<div class="card">
		<a onclick="showBottomSheet('addcourse');" class="float_button pos_top_right ic_plus_white icon_medium"></a>
		<table class="list" id="tableListCourse">
			<tr class="title">
				<td width="1px">
					<label id="chkAll"><input type="checkbox"><span></span></label>
				</td>
				<td colspan="2">Course</td>
			</tr>
		<?php
		$p = 1;
		if(isset($_POST['p']))
			$p = $_POST['p'];
		if(isset($_POST['pp'])) {
			if($_POST['pp'] == "All")
				$rowPerPage = 0;
			else
				$rowPerPage = $_POST['pp'];
		}
		$startFrom = ($p-1) * $rowPerPage;
		$filter = "";
		if(isset($_POST['search'])) {
			if($_POST['search'] != "") {
				$search = mysql_escape_string($_POST['search']);
				$filter .= " AND (Name LIKE '%$search%' OR Code LIKE '%$search%') ";
			}
		}
		if(isset($_POST['college'])) {
			if($_POST['college'] != "all") {
				$college = $_POST['college'];
				$filter .= " AND CollegeID = '$college' ";
			}
		}
		$additional = "1=1 $filter LIMIT $startFrom, $rowPerPage";
		if($rowPerPage == 0) 
			$additional = "1=1 $filter";
		$tableData = $oes->getData("Course", "*", $additional);
		if(!empty($tableData)) {
			foreach($tableData as $data) {
			?>
			<tr>
				<td>
					<label class="checkData" id="chk_<?php echo $data["ID"]; ?>"><input type="checkbox" value="<?php echo $data["ID"]; ?>"><span></span></label>
				</td>
				<td class="primary">
					<span><?php echo $data["Name"]; ?></span>
					<span><?php echo $data["Code"]; ?></span>
				</td>
				<td>
					<ul class="button-container">
						<li>
							<a id="btnEdit_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_pencil showhover"></a>
							<a id="btnDelete_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
						</li>
					</ul>
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#btnEdit_<?php echo $data["ID"]; ?>").click(function() {
					showBottomSheet('editcourse', '<?php echo $data["ID"]; ?>');
				});
				$("#btnDelete_<?php echo $data["ID"]; ?>").click(function() {
					showDialogBox('deletecourse', '<?php echo $data["ID"]; ?>');
				});
			});
			</script>
			<?php
			}
			scriptCheckedData("#tableListCourse");
		} else {
		?>
			<tr>
				<td></td>
				<td colspan="3" align="center">
					No result found.
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#tableListCourse #chkAll").css({"visibility": "hidden"});
			});
			</script>
		<?php
		}
		?>
		</table>
	</div>
	<script>
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getdataaction",
		data: {module: "course"},
		success: function(html) {
			$("#data-action-bar #actions").html(html)
		}
	})
	</script>
		<?php
		showPagination("SELECT * FROM Course WHERE 1=1", $filter, $rowPerPage, $p, "refreshListCourse();");
	} elseif($action == "listsection") {
?>
	<?php
	$query = $oes->getData("GLS", "*", "FacultyID = '0'");
	if(!empty($query)) {
	?>
	<div class="card" id="card-warning">
		<h4><span class="flat_icon ic_warning"></span>Warning</h4>
		<p> <?php echo sizeof($query); if(sizeof($query) > 1) echo ' sections'; else echo ' section';  ?> doesn't have an adviser. We can automatically assign them for you.</p>
		<ul class="button-container right">
			<li><a onclick="dismissCard('warning', 'swipe-left');" class="flat_button">Dismiss</a></li>
			<li><a onclick="showDialogBox('auto_assign_faculty_to_section');" class="raised_button">Assign now</a></li>
		</ul>
	</div>
	<?php
	}
	?>
	<div class="card">
		<!--
		<a onclick="showBottomSheet('addsection');" class="float_button pos_top_right ic_plus_white icon_medium"></a>
		-->
		<table class="list" id="tableListSection">
			<tr class="title">
				<td width="1px">
					<label id="chkAll"><input type="checkbox"><span></span></label>
				</td>
				<td colspan="2">Section</td>
			</tr>
		<?php
		$filter = "";
		if(isset($_POST['search'])) {
			if($_POST['search'] != "") {
				$search = mysql_escape_string($_POST['search']);
				$filter .= " AND Section LIKE '%$search%' ";
			}
		}
		if(isset($_POST['gl'])) {
			if($_POST['gl'] != "all") {
				$gl = $_POST['gl'];
				$filter .= " AND GradeLevel = '$gl' ";
			}
		}
		$additional = "1=1 $filter";
		$tableData = $oes->getData("GLS", "*", $additional);
		if(!empty($tableData)) {
			foreach($tableData as $data) {
			?>
			<tr>
				<td>
					<label class="checkData" id="chk_<?php echo $data["ID"]; ?>"><input type="checkbox" value="<?php echo $data["ID"]; ?>"><span></span></label>
				</td>
				<td class="primary">
					<span>
						<?php 
						echo $data["Section"]; 
						if($data["FacultyID"] == 0) {
							echo '<i class="flat_icon ic_warning" title="No adviser"></i>';
						}
						?>
					</span>
					<span>Grade <?php echo $data["GradeLevel"]; ?> • <?php echo $oes->getNum("Account INNER JOIN Student", "Account.ID = Student.ID AND Account.Type = 'Student' AND GLS = '".$data["ID"]."' AND Account.Status = 'Active'")?> students</span>
				</td>
				<td>
					<ul class="button-container">
						<li>
							<a id="btnEdit_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_pencil showhover"></a>
							<a id="btnDeploy_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_assignment_ind showhover"></a>
							<?php
							if($systatus == 0) {
							?>
								<a id="btnDelete_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
							<?php
							}
							?>
						</li>
					</ul>
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#btnEdit_<?php echo $data["ID"]; ?>").click(function() {
					showBottomSheet('editsection', '<?php echo $data["ID"]; ?>');
				});
				$("#btnDeploy_<?php echo $data["ID"]; ?>").click(function() {
					showBottomSheet('deployadviser', '<?php echo $data["ID"]; ?>');
				});
				$("#btnDelete_<?php echo $data["ID"]; ?>").click(function() {
					showDialogBox('deletesection', '<?php echo $data["ID"]; ?>');
				});
			});
			</script>
			<?php
			}
			scriptCheckedData("#tableListSection");
		} else {
		?>
			<tr>
				<td></td>
				<td colspan="3" align="center">
					No result found.
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#tableListSection #chkAll").css({"visibility": "hidden"});
			});
			</script>
		<?php
		}
		?>
		</table>
	</div>
	<script>
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getdataaction",
		data: {module: "section"},
		success: function(html) {
			$("#data-action-bar #actions").html(html)
		}
	});
	</script>
		<?php
	} elseif($action == "listsectionschedule") {
?>
	<?php
	$gradelevel = $_POST['gl'];
	$section = $_POST['section'];
	if($gradelevel != "" && $section != "") {
		$defaultroom = $oes->getSingleData("GLS", "RoomID", "ID = '$section'");
		if($defaultroom == "0") {
		?>
		<div class="card" id="card-defaultroom">
			<h4><span class="flat_icon ic_warning"></span>Warning</h4>
			<p>This section doesn't have a default room. You can only add subjects to schedule if this section has a default room.</p>
			<ul class="button-container right">
				<li><a onclick="dismissCard('defaultroom', 'swipe-left');" class="flat_button">Dismiss</a></li>
				<li><a onclick="showBottomSheet('setdefaultroom', '<?php echo $section; ?>');" class="raised_button">Set Default Room</a></li>
			</ul>
		</div>
		<?php
		} else {
		?>
		<div class="card">
			<h4>Default Room</h4>
			<table class="list">
				<tr class="title">
					<td class="hide"></td>
					<td colspan="2">Default Room</td>
				</tr>
				<tr>
					<td class="hide"></td>
					<td>
						<span>
						<?php 
							$roomname = $oes->getSingleData("Room", "Name", "ID = '$defaultroom'"); 
							if(is_numeric($roomname)) 
								echo 'Room '.$roomname;
							else
								echo $roomname;
							echo ', '.$oes->getSingleData("Building", "Name", "ID = '".$oes->getSingleData("Room", "BuildingID", "ID = '$defaultroom'")."'");
						?>
						</span>
					</td>
					<td>
						<?php
						if($systatus == 0) {
						?>
						<ul class="button-container">
							<li>
								<a id="btnChange_<?php echo $section; ?>" class="flat_icon_20 ic_pencil showhover"></a>
							</li>
						</ul>
						<script>
						$(document).ready(function() {
							$("#btnChange_<?php echo $section; ?>").click(function() {
								showBottomSheet("changedefaultroom", "<?php echo $section; ?>");
							})
						});
						</script>
						<?php
						}
						?>
					</td>
				</tr>
			</table>
		</div>
		<?php
		}
		?>
		<?php
		$scheduleData = $oes->getData("Schedule", "*", "SectionID = '$section'");
		if(empty($scheduleData) && $defaultroom != "0") {
		?>
		<div class="card" id="card-generateschedule">
			<h4><span class="flat_icon ic_warning"></span>Warning</h4>
			<p>This section doesn't have a schedule. We can automatically create a schedule for this section. You know if you want to. If not, yeah, sure, whatever.</p>
			<ul class="button-container right">
				<li><a onclick="dismissCard('generateschedule', 'swipe-left');" class="flat_button">Dismiss</a></li>
				<li><a onclick="showDialogBox('auto_generate_schedule_to_section', '<?php echo $section; ?>');" class="raised_button">Generate Schedule</a></li>
			</ul>
		</div>
		<?php
		}
		?>
		<div class="card">
			<?php
			if($defaultroom != "0" && $systatus == 0) {
			?>
			<a onclick="showBottomSheet('addsectionschedule', '<?php echo $section; ?>');" class="float_button pos_top_right ic_plus_white icon_medium"></a>
			<a onclick="showDialogBox('auto_generate_schedule_to_section', '<?php echo $section; ?>');" class="float_button pos_top_left ic_autorenew_white icon_medium"></a>
			<?php
			}
			?>
			<h4>Schedule for Grade <?php echo $gradelevel.$oes->getSingleData("GLS", "Section", "ID = '$section'"); ?></h4>
			<table class="list" id="tableListSectionSchedule">
				<?php
				$days = array("M", "T", "W", "H", "F");

				foreach($days as $day) {
				?>
				<tr class="title">
					<td<?php 
					if($systatus == 1) {
						echo ' class="hide"';
					} else {
						echo ' width="1px"';
					}
					?>></td>
					<td colspan="2"><?php echo $oes->getFullDayName($day); ?></td>
				</tr>
				<?php
					$schedule = $oes->getData("Schedule", "*", "SectionID = '$section' AND Day = '".$day."' ORDER BY StartTime ASC");
					if(!empty($schedule)) {
						foreach($schedule as $s) {
				?>
				<tr>
					<td<?php 
					if($systatus == 1) {
						echo ' class="hide"';
					} else {
						echo ' width="1px"';
					}
					?>>
						<label class="checkData" id="chk_<?php echo $s["ID"]; ?>"><input type="checkbox" value="<?php echo $s["ID"]; ?>"><span></span></label>
					</td>
					<td class="primary">
						<span>
							<?php echo ($s["SubjectID"] == null ? $s["Break"] : $oes->getSingleData("Subject", "Name", "ID = '".$s["SubjectID"]."'")); ?>
							<?php
							if($s["FacultyID"] == "" && $s["Break"] == "") {
								echo '<i class="flat_icon ic_warning" title="No faculty assigned"></i>';
							}
							?>
						</span>
						<span><?php echo date('g:i a', strtotime($s["StartTime"])).' - '.date('g:i a', strtotime($s["EndTime"])); ?></span>
					</td>
					<td>
						<ul class="button-container">
							<li>
								<a id="btnInfo_<?php echo $s["ID"]; ?>" class="flat_icon_20 ic_info_outline showhover"></a>
								<?php
								if($systatus == 0) {
								?>
								<a id="btnDelete_<?php echo $s["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
								<?php
								}
								?>
							</li>
						</ul>
					</td>
				</tr>
				<script>
				$(document).ready(function() {
					$("#btnInfo_<?php echo $s["ID"]; ?>").click(function() {
						showDialogBox('infosectionschedule', '<?php echo $s["ID"]; ?>');
					});
					$("#btnDelete_<?php echo $s["ID"]; ?>").click(function() {
						showDialogBox('deletesectionschedule', '<?php echo $s["ID"]; ?>');
					});
				});
				</script>
				<?php
						}
					} else {
				?>
				<tr>
					<td></td>
					<td colspan="2"><center><small><i>No schedule assigned in this day.</i></small></center></td>
				</tr>
				<?php
					}
				}
				scriptCheckedData("#tableListSectionSchedule");
				?>
			</table>
		</div>
		<script>
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=getdataaction",
			data: {module: "sectionschedule"},
			success: function(html) {
				$("#data-action-bar #actions").html(html)
			}
		});
		</script>
<?php
		}
	} elseif($action == "listroom") {
?>
	<div class="card">
		<a onclick="showBottomSheet('addroom');" class="float_button pos_top_right ic_plus_white icon_medium"></a>
		<table class="list" id="tableListRoom">
			<tr class="title">
				<td<?php 
				if($systatus == 1) {
					echo ' class="hide"';
				} else {
					echo ' width="1px"';
				}
				?>>
					<label id="chkAll"><input type="checkbox"><span></span></label>
				</td>
				<td colspan="2">Room</td>
			</tr>
		<?php
		$p = 1;
		if(isset($_POST['p']))
			$p = $_POST['p'];
		if(isset($_POST['pp'])) {
			if($_POST['pp'] == "All")
				$rowPerPage = 0;
			else
				$rowPerPage = $_POST['pp'];
		}
		$startFrom = ($p-1) * $rowPerPage;
		$filter = "";
		if(isset($_POST['search'])) {
			if($_POST['search'] != "") {
				$search = mysql_escape_string($_POST['search']);
				$filter .= " AND Name LIKE '%$search%' ";
			}
		}
		if(isset($_POST['building'])) {
			if($_POST['building'] != "all") {
				$building = $_POST['building'];
				$filter .= " AND BuildingID = '$building' ";
			}
		}
		$additional = "1=1 $filter LIMIT $startFrom, $rowPerPage";
		if($rowPerPage == 0) 
			$additional = "1=1 $filter";
		$tableData = $oes->getData("Room", "*", $additional);
		if(!empty($tableData)) {
			foreach($tableData as $data) {
			?>
			<tr>
				<td<?php 
				if($systatus == 1) {
					echo ' class="hide"';
				} else {
					echo ' width="1px"';
				}
				?>>
					<label class="checkData" id="chk_<?php echo $data["ID"]; ?>"><input type="checkbox" value="<?php echo $data["ID"]; ?>"><span></span></label>
				</td>
				<td class="primary">
					<span><?php echo $data["Name"]; ?></span>
					<span><?php echo $oes->getSingleData("Building", "Name", "ID = '".$data["BuildingID"]."'"); ?></span>
				</td>
				<td>
					<ul class="button-container">
						<li>
							<a id="btnEdit_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_pencil showhover"></a>
							<?php 
							if($systatus == 0) {
							?>
							<a id="btnDelete_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
							<?php
							}
							?>
						</li>
					</ul>
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#btnEdit_<?php echo $data["ID"]; ?>").click(function() {
					showBottomSheet('editroom', '<?php echo $data["ID"]; ?>');
				});
				$("#btnDelete_<?php echo $data["ID"]; ?>").click(function() {
					showDialogBox('deleteroom', '<?php echo $data["ID"]; ?>');
				});
			});
			</script>
			<?php
			}
			scriptCheckedData("#tableListRoom");
		} else {
		?>
			<tr>
				<td></td>
				<td colspan="3" align="center">
					No result found.
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#tableListRoom #chkAll").css({"visibility": "hidden"});
			});
			</script>
		<?php
		}
		?>
		</table>
	</div>
	<script>
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getdataaction",
		data: {module: "room"},
		success: function(html) {
			$("#data-action-bar #actions").html(html)
		}
	})
	</script>
		<?php
		showPagination("SELECT * FROM Room WHERE 1=1", $filter, $rowPerPage, $p, "refreshListRoom();");
	} elseif($action == "listdepartment") {
?>
	<div class="card">
		<a onclick="showBottomSheet('adddepartment');" class="float_button pos_top_right ic_plus_white icon_medium"></a>
		<table class="list" id="tableListDepartment">
			<tr class="title">
				<td width="1px">
					<label id="chkAll"><input type="checkbox"><span></span></label>
				</td>
				<td colspan="2">Department</td>
			</tr>
		<?php
		$p = 1;
		if(isset($_POST['p']))
			$p = $_POST['p'];
		if(isset($_POST['pp'])) {
			if($_POST['pp'] == "All")
				$rowPerPage = 0;
			else
				$rowPerPage = $_POST['pp'];
		}
		$startFrom = ($p-1) * $rowPerPage;
		$filter = "";
		if(isset($_POST['search'])) {
			if($_POST['search'] != "") {
				$search = mysql_escape_string($_POST['search']);
				$filter .= " AND (Name LIKE '%$search%' OR Code LIKE '%$search%') ";
			}
		}
		if(isset($_POST['college'])) {
			if($_POST['college'] != "all") {
				$college = $_POST['college'];
				$filter .= " AND CollegeID = '$college' ";
			}
		}
		$additional = "1=1 $filter LIMIT $startFrom, $rowPerPage";
		if($rowPerPage == 0) 
			$additional = "1=1 $filter";
		$tableData = $oes->getData("Department", "*", $additional);
		if(!empty($tableData)) {
			foreach($tableData as $data) {
			?>
			<tr>
				<td>
					<label class="checkData" id="chk_<?php echo $data["ID"]; ?>"><input type="checkbox" value="<?php echo $data["ID"]; ?>"><span></span></label>
				</td>
				<td class="primary">
					<span><?php echo $data["Name"]; ?></span>
					<span><?php echo $data["Code"]; ?></span>
				</td>
				<td>
					<ul class="button-container">
						<li>
							<a id="btnEdit_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_pencil showhover"></a>
							<a id="btnDelete_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
						</li>
					</ul>
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#btnEdit_<?php echo $data["ID"]; ?>").click(function() {
					showBottomSheet('editdepartment', '<?php echo $data["ID"]; ?>');
				});
				$("#btnDelete_<?php echo $data["ID"]; ?>").click(function() {
					showDialogBox('deletedepartment', '<?php echo $data["ID"]; ?>');
				});
			});
			</script>
			<?php
			}
			scriptCheckedData("#tableListDepartment");
		} else {
		?>
			<tr>
				<td></td>
				<td colspan="3" align="center">
					No result found.
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#tableListDepartment #chkAll").css({"visibility": "hidden"});
			});
			</script>
		<?php
		}
		?>
		</table>
	</div>
	<script>
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getdataaction",
		data: {module: "department"},
		success: function(html) {
			$("#data-action-bar #actions").html(html)
		}
	})
	</script>
		<?php
		showPagination("SELECT * FROM Department WHERE 1=1", $filter, $rowPerPage, $p, "refreshListDepartment();");
	} elseif($action == "listsubject") {
?>
	<div class="card">
		<!--
		<a onclick="showBottomSheet('addsubject');" class="float_button pos_top_right ic_plus_white icon_medium"></a>
		-->
		<table class="list" id="tableListSubject">
			<tr class="title">
				<!--
				<td width="1px">
					<label id="chkAll"><input type="checkbox"><span></span></label>
				</td>
				-->
				<td class="hide"></td>
				<td>Subject</td>
			</tr>
			<?php
			$p = 1;
			if(isset($_POST['p']))
				$p = $_POST['p'];
			if(isset($_POST['pp'])) {
				if($_POST['pp'] == "All")
					$rowPerPage = 0;
				else
					$rowPerPage = $_POST['pp'];
			}
			$startFrom = ($p-1) * $rowPerPage;
			$filter = "";
			if(isset($_POST['search'])) {
				if($_POST['search'] != "") {
					$search = mysql_escape_string($_POST['search']);
					$filter .= " AND (Name LIKE '%$search%' OR Code LIKE '%$search%') ";
				}
			}
			$additional = "$filter LIMIT $startFrom, $rowPerPage";
			if($rowPerPage == 0) 
				$additional = "$filter";
			$tableData = $oes->getData("Subject", "*", "1=1 ".$additional);
			if(!empty($tableData)) {
				foreach($tableData as $data) {
				?>
			<tr>
				<!--
				<td>
					<label class="checkData" id="chk_<?php echo $data["ID"]; ?>"><input type="checkbox" value="<?php echo $data["ID"]; ?>"><span></span></label>
				</td>
				-->
				<td class="hide"></td>
				<td class="primary">
					<span><?php echo $data["Name"]; ?></span>
					<span><?php echo $data["Code"]; ?> • <?php echo $u = $data["Units"]; echo ($u > 1 ? ' units' : ' unit'); ?></span>
				</td>
				<!--
				<td width="1px">
					<ul class="button-container">
						<li>
							<a id="btnEdit_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_pencil showhover"></a>
							<a id="btnDelete_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
						</li>
					</ul>
				</td>
				-->
			</tr>
			<script>
			$(document).ready(function() {
				$("#btnEdit_<?php echo $data["ID"]; ?>").click(function() {
					showBottomSheet('editsubject', '<?php echo $data["ID"]; ?>');
				});
				$("#btnDelete_<?php echo $data["ID"]; ?>").click(function() {
					showDialogBox('deletesubject', '<?php echo $data["ID"]; ?>');
				});
			});
			</script>
				<?php
				}
				scriptCheckedData("#tableListSubject");
			} else {
			?>
			<tr>
				<td class="hide"></td>
				<td align="center">
					No result found.
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#tableListSubject #chkAll").css({"visibility": "hidden"});
			});
			</script>
			<?php
			}
			?>
		</table>
	</div>
	<script>
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getdataaction",
		data: {module: "subject"},
		success: function(html) {
			$("#data-action-bar #actions").html(html);
		}
	})
	</script>
		<?php
		showPagination("SELECT * FROM Subject WHERE 1=1", $filter, $rowPerPage, $p, "refreshListSubject();");
	} elseif($action == "addcurriculum") {
		if(isset($_POST['gradelevel'], $_POST['subject'])) {
			$subjects = $_POST['subject'];
			$gl = $_POST['gradelevel'];
			foreach($subjects as $subject) {
				mysql_query("INSERT INTO Curriculum (SubjectID, YearLevel) VALUES ('$subject', '$gl')");
			}
			hideElements();
			showSnackbar('add_success');
		} else {
			showSnackbar('add_error');
		}
	} /*elseif($action == "editcurriculum") {
		if(isset($_POST['id'], $_POST['subject'], $_POST['courseyear'], $_POST['term'])) {
			$id = mysql_escape_string($_POST['id']);
			$subject = mysql_escape_string($_POST['subject']);
			$courseyear = mysql_escape_string($_POST['courseyear']);
			$term = mysql_escape_string($_POST['term']);
			if($id != "" && $subject != "" && $courseyear != "" && $term != "") {
				$q1 = mysql_query("UPDATE Curriculum SET SubjectID = '$subject', Year = '$courseyear', Term = '$term' WHERE ID = '$id'");
				if($q1)
					showSnackbar('edit_success');
				else
					showSnackbar('edit_error');
			} else {
				showSnackbar('edit_error');
			}
		} else {
			showSnackbar('edit_error');
		}
	} */ elseif($action == "deletecurriculum") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$q1 = mysql_query("DELETE FROM Curriculum WHERE ID = '$id'");
			if($q1)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "deletecurriculum_data") {
		if(isset($_POST['checkedData'])) {
			$checkedData = $_POST['checkedData'];
			$success = true;
			foreach($checkedData as $data) {
				$q1 = mysql_query("DELETE FROM Curriculum WHERE ID = '$data'");
				if(!$q1)
					$success = false;
			}
			if($success)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "addcollege") {
		if(isset($_POST['name'], $_POST['code'])) {
			$name = mysql_escape_string($_POST['name']);
			$code = mysql_escape_string($_POST['code']);
			if($name != "" && $code != "") {
				$q1 = mysql_query("INSERT INTO College (Name, Code) VALUES ('$name', '$code')");
				if($q1) {
					showSnackbar('add_success');
					hideElements();
				} else
					showSnackbar('add_error');
			} else {
				showSnackbar('add_error');
			}
		} else {
			showSnackbar('add_error');
		}
	} elseif($action == "editcollege") {
		if(isset($_POST['name'])) {
			$id = $_POST['id'];
			$name = mysql_escape_string($_POST['name']);
			$code = mysql_escape_string($_POST['code']);
			if($name != "" && $code != "") {
				$q1 = mysql_query("UPDATE College SET Name = '$name', Code = '$code' WHERE ID = '$id'");
				if($q1) {
					showSnackbar('edit_success');
					hideElements();
				} else
					showSnackbar('edit_error');
			} else {
				showSnackbar('edit_error');
			}
		} else {
			showSnackbar('edit_error');
		}
	} elseif($action == "deletecollege") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$q1 = mysql_query("DELETE FROM College WHERE ID = '$id'");
			if($q1) 
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "deletecollege_data") {
		if(isset($_POST['checkedData'])) {
			$checkedData = $_POST['checkedData'];
			$success = true;
			foreach($checkedData as $data) {
				$q1 = mysql_query("DELETE FROM College WHERE ID = '$data'");
				if(!$q1)
					$success = false;
			}
			if($success)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "addroom") {
		if(isset($_POST['name'], $_POST['building'], $_POST['type'], $_POST['from'], $_POST['to'])) {
			$name = mysql_escape_string($_POST['name']);
			$building = mysql_escape_string($_POST['building']);
			$type = mysql_escape_string($_POST['type']);
			$from = mysql_escape_string($_POST['from']);
			$to = mysql_escape_string($_POST['to']);
			if($type == "single") {
				if($name != "" && $building != "") {
					$exists = $oes->isExists("Room", array("BuildingID", "Name"), array($building, $name));
					if(!$exists) {
						$q1 = mysql_query("INSERT INTO Room (BuildingID, Name) VALUES ('$building', '$name')");
						if($q1) {
							showSnackbar('add_success');
							hideElements();
						} else
							showSnackbar('add_error');
					} else
						showSnackbar('add_error');
				} else {
					showSnackbar('add_error');
				}
			} elseif($type == "multiple") {
				if($from != "" && $to != "" && $building != "") {
					if($from <= $to && is_numeric($from) && is_numeric($to)) {
						$continue = true;
						for($i = $from; $i <= $to; $i++) {
							$exists = $oes->isExists("Room", array("BuildingID", "Name"), array($building, $i));
							if($exists) {
								$continue = false;
								break;
							}
						}
						if($continue) {
							for($i = $from; $i <= $to; $i++) {
								mysql_query("INSERT INTO Room (BuildingID, Name) VALUES ('$building', '$i')");
							}
							showSnackbar('add_success');
							hideElements();
						} else
							showSnackbar('add_error');
					} else
						showSnackbar('add_error');
				} else
					showSnackbar('add_error');
			} else
				showSnackbar('add_error');
		} else {
			showSnackbar('add_error');
		}
	} elseif($action == "editroom") {
		if(isset($_POST['name'])) {
			$id = $_POST['id'];
			$name = mysql_escape_string($_POST['name']);
			$building = mysql_escape_string($_POST['building']);
			if($name != "" && $building != "") {
				$exists = $oes->isExists("Room", array("BuildingID", "Name"), array($building, $name));
				if(!$exists) {
					$q1 = mysql_query("UPDATE Room SET BuildingID = '$building', Name = '$name' WHERE ID = '$id'");
					if($q1) {
						showSnackbar('add_success');
						hideElements();
					} else
						showSnackbar('add_error');
				} else
					showSnackbar('add_error');
			} else {
				showSnackbar('edit_error');
			}
		} else {
			showSnackbar('edit_error');
		}
	} elseif($action == "deleteroom") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$q1 = mysql_query("DELETE FROM Room WHERE ID = '$id'");
			$q2 = mysql_query("UPDATE GLS SET RoomID = '0' WHERE RoomID  = '$id'");
			if($q1 && $q2)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "deleteroom_data") {
		if(isset($_POST['checkedData'])) {
			$checkedData = $_POST['checkedData'];
			$success = true;
			foreach($checkedData as $data) {
				$q1 = mysql_query("DELETE FROM Room WHERE ID = '$data'");
				$q2 = mysql_query("UPDATE GLS SET RoomID = '0' WHERE RoomID  = '$data'");
				if(!$q1 || !$q2)
					$success = false;
			}
			if($success)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "addbuilding") {
		if(isset($_POST['name'], $_POST['code'])) {
			$name = mysql_escape_string($_POST['name']);
			$code = mysql_escape_string($_POST['code']);
			if($name != "" && $code != "") {
				$q1 = mysql_query("INSERT INTO Building (Name, Code) VALUES ('$name', '$code')");
				if($q1) {
					showSnackbar('add_success');
					hideElements();
				} else 
					showSnackbar('add_error');
			} else {
				showSnackbar('add_error');
			}
		} else {
			showSnackbar('add_error');
		}
	} elseif($action == "editbuilding") {
		if(isset($_POST['name'])) {
			$id = $_POST['id'];
			$name = mysql_escape_string($_POST['name']);
			$code = mysql_escape_string($_POST['code']);
			if($name != "" && $code != "") {
				$q1 = mysql_query("UPDATE Building SET Name = '$name', Code = '$code' WHERE ID = '$id'");
				if($q1) {
					showSnackbar('edit_success');
					hideElements();
				} else
					showSnackbar('edit_error');
			} else {
				showSnackbar('edit_error');
			}
		} else {
			showSnackbar('edit_error');
		}
	} elseif($action == "deletebuilding") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$q3 = mysql_query("UPDATE GLS SET RoomID = '0' WHERE RoomID IN (SELECT ID FROM Room WHERE BuildingID = '$id')");
			$q1 = mysql_query("DELETE FROM Building WHERE ID = '$id'");
			$q2 = mysql_query("DELETE FROM Room WHERE BuildingID = '$id'");
			if($q1 && $q2 && $q3)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "deletebuilding_data") {
		if(isset($_POST['checkedData'])) {
			$checkedData = $_POST['checkedData'];
			$success = true;
			foreach($checkedData as $data) {
				$q3 = mysql_query("UPDATE GLS SET RoomID = '0' WHERE RoomID IN (SELECT ID FROM Room WHERE BuildingID = '$data')");
				$q1 = mysql_query("DELETE FROM Building WHERE ID = '$data'");
				$q2 = mysql_query("DELETE FROM Room WHERE BuildingID = '$data'");
				if(!$q1 || !$q2 || !$q3)
					$success = false;
			}
			if($success) 
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "addcourse") {
		if(isset($_POST['name'], $_POST['code'], $_POST['college'], $_POST['yearcourse'])) {
			$name = mysql_escape_string($_POST['name']);
			$code = mysql_escape_string($_POST['code']);
			$college = $_POST['college'];
			$yearcourse = $_POST['yearcourse'];
			if($name != "" && $code != "") {
				$q1 = mysql_query("INSERT INTO Course (Name, Code, CollegeID, YearCourse) VALUES ('$name', '$code', '$college', '$yearcourse')");
				if($q1) {
					showSnackbar('add_success');
					hideElements();
				} else
					showSnackbar('add_error');
			} else {
				showSnackbar('add_error');
			}
		} else {
			showSnackbar('add_error');
		}
	} elseif($action == "editcourse") {
		if(isset($_POST['name'])) {
			$id = $_POST['id'];
			$name = mysql_escape_string($_POST['name']);
			$code = mysql_escape_string($_POST['code']);
			$college = $_POST['college'];
			$yearcourse = $_POST['yearcourse'];
			if($name != "" && $code != "") {
				$q1 = mysql_query("UPDATE Course SET Name = '$name', Code = '$code', CollegeID = '$college', YearCourse = '$yearcourse' WHERE ID = '$id'");
				if($q1) {
					showSnackbar('edit_success');
					hideElements();
				} else
					showSnackbar('edit_error');
			} else {
				showSnackbar('edit_error');
			}
		} else {
			showSnackbar('edit_error');
		}
	} elseif($action == "deletecourse") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$q1 = mysql_query("DELETE FROM Course WHERE ID = '$id'");
			$q2 = mysql_query("UPDATE Student SET Course = NULL WHERE Course = '$id'");
			if($q1 && $q2)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "deletecourse_data") {
		if(isset($_POST['checkedData'])) {
			$checkedData = $_POST['checkedData'];
			$success = true;
			foreach($checkedData as $data) {
				$q1 = mysql_query("DELETE FROM Course WHERE ID = '$data'");
				$q2 = mysql_query("UPDATE Student SET Course = NULL WHERE Course = '$data'");
				if(!$q1 || !$q2)
					$success = false;
			}
			if($success)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "adddepartment") {
		if(isset($_POST['name'], $_POST['code'], $_POST['college'])) {
			$name = mysql_escape_string($_POST['name']);
			$code = mysql_escape_string($_POST['code']);
			$college = $_POST['college'];
			if($name != "" && $code != "") {
				$q1 = mysql_query("INSERT INTO Department (Name, Code, CollegeID) VALUES ('$name', '$code', '$college')");
				if($q1)  {
					showSnackbar('add_success');
					hideElements();
				} else
					showSnackbar('add_error');
			} else {
				showSnackbar('add_error');
			}
		} else {
			showSnackbar('add_error');
		}
	} elseif($action == "editdepartment") {
		if(isset($_POST['name'])) {
			$id = $_POST['id'];
			$name = mysql_escape_string($_POST['name']);
			$code = mysql_escape_string($_POST['code']);
			$college = $_POST['college'];
			if($name != "" && $code != "") {
				$q1 = mysql_query("UPDATE Department SET Name = '$name', Code = '$code', CollegeID = '$college' WHERE ID = '$id'");
				if($q1) {
					showSnackbar('edit_success');
					hideElements();
				} else
					showSnackbar('edit_error');
			} else {
				showSnackbar('edit_error');
			}
		} else {
			showSnackbar('edit_error');
		}
	} elseif($action == "deletedepartment") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$q1 = mysql_query("DELETE FROM Department WHERE ID = '$id'");
			$q2 = mysql_query("UPDATE Faculty SET Course = NULL WHERE Department = '$id'");
			if($q1 && $q2)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "deletedepartment_data") {
		if(isset($_POST['checkedData'])) {
			$checkedData = $_POST['checkedData'];
			$success = true;
			foreach($checkedData as $data) {
				$q1 = mysql_query("DELETE FROM Department WHERE ID = '$data'");
				$q2 = mysql_query("UPDATE Faculty SET Department = NULL WHERE Department = '$data'");
				if(!$q1 || !$q2)
					$success = false;
			}
			if($success)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "addsubject") {
		if(isset($_POST['name'], $_POST['code'], $_POST['units'])) {
			$name = mysql_escape_string($_POST['name']);
			$code = mysql_escape_string($_POST['code']);
			$units = $_POST['units'];
			if($name != "" && $code != "") {
				$q1 = mysql_query("INSERT INTO Subject (Name, Code, Units) VALUES ('$name', '$code', '$units')");
				if($q1) {
					showSnackbar('add_success');
					hideElements();
				} else
					showSnackbar('add_error');
			} else {
				showSnackbar('add_error');
			}
		} else {
			showSnackbar('add_error');
		}
	} elseif($action == "editsubject") {
		if(isset($_POST['name'])) {
			$id = $_POST['id'];
			$name = mysql_escape_string($_POST['name']);
			$code = mysql_escape_string($_POST['code']);
			$units = $_POST['units'];
			if($name != "" && $code != "") {
				$q1 = mysql_query("UPDATE Subject SET Name = '$name', Code = '$code', Units = '$units' WHERE ID = '$id'");
				if($q1) {
					showSnackbar('edit_success');
					hideElements();
				} else
					showSnackbar('edit_error');
			} else {
				showSnackbar('edit_error');
			}
		} else {
			showSnackbar('edit_error');
		}
	} elseif($action == "deletesubject") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$q1 = mysql_query("DELETE FROM Subject WHERE ID = '$id'");
			$q2 = mysql_query("DELETE FROM Curriculum WHERE SubjectID = '$id'");
			if($q1 && $q2)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "deletesubject_data") {
		if(isset($_POST['checkedData'])) {
			$checkedData = $_POST['checkedData'];
			$success = true;
			foreach($checkedData as $data) {
				$q1 = mysql_query("DELETE FROM Subject WHERE ID = '$data'");
				$q2 = mysql_query("DELETE FROM Curriculum WHERE SubjectID = '$data'");
				if(!$q1 || !$q2)
					$success = false;
			}
			if($success)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "addsection") {
		if(isset($_POST['gl'], $_POST['section'])) {
			$gl = $_POST['gl'];
			$section = mysql_escape_string($_POST['section']);
			$exists = $oes->getData("GLS", "*", "Section = '$section' AND GradeLevel = '$gl'");
			if(empty($exists) && $section != "") {
				$q1 = mysql_query("INSERT INTO GLS (GradeLevel, Section) VALUES ('$gl', '$section')");
				if($q1) {
					showSnackbar('add_success');
					hideElements();
				} else
					showSnackbar('add_error');
			} else
				showSnackbar('add_error');
		} else
			showSnackbar('add_error');
	} elseif($action == "editsection") {
		if(isset($_POST['gl'], $_POST['section'])) {
			$id = $_POST['id'];
			$gl = mysql_escape_string($_POST['gl']);
			$section = mysql_escape_string($_POST['section']);
			$exists = $oes->getData("GLS", "*", "Section = '$section' AND GradeLevel = '$gl'");
			if(empty($exists) && $section != "") {
				$q1 = mysql_query("UPDATE GLS SET Section = '$section', GradeLevel = '$gl' WHERE ID = '$id'");
				$q2 = mysql_query("UPDATE Student SET GradeLevel = '$gl' WHERE GLS = '$id'");
				if($q1 && $q2) {
					showSnackbar('edit_success');
					hideElements();
				} else
					showSnackbar('edit_error');
			} else {
				showSnackbar('edit_error');
			}
		} else {
			showSnackbar('edit_error');
		}
	} elseif($action == "deletesection") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$q1 = mysql_query("DELETE FROM GLS WHERE ID = '$id'");
			$q2 = mysql_query("UPDATE Student SET GLS = '0' WHERE GLS = '$id'");
			$q3 = mysql_query("DELETE FROM Schedule WHERE SectionID = '$id'");
			if($q1 && $q2 && $q3)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "deletesection_data") {
		if(isset($_POST['checkedData'])) {
			$checkedData = $_POST['checkedData'];
			$success = true;
			foreach($checkedData as $data) {
				$q1 = mysql_query("DELETE FROM GLS WHERE ID = '$data'");
				$q2 = mysql_query("UPDATE Student SET GLS = '0' WHERE GLS = '$data'");
				$q3 = mysql_query("DELETE FROM Schedule WHERE SectionID = '$data'");
				if(!$q1)
					$success = false;
			}
			if($success)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "addstudent") {
		if(isset($_POST['fname'])) {
			$fname = mysql_escape_string($_POST['fname']);
			$mname = mysql_escape_string($_POST['mname']);
			$lname = mysql_escape_string($_POST['lname']);
			$bday = $_POST['bday'];
			$gender = $_POST['gender'];
			$gradelevel = $_POST['gradelevel'];
			$section = $_POST['section'];
			if($fname != "" && $mname != "" && $lname != "" && $bday != "") {
				$id = $oes->GenerateAccountID();
				$username = $oes->GenerateUsername($id, $fname, $mname, $lname);
				$password = $oes->generatePassword(8);
				$hash = $oes->generateHash(15);
				$q1 = mysql_query("INSERT INTO Account (ID, Username, Password, Type, Status) VALUES ('$id', '$username', '$password', 'Student', 'Active')");
				$q2 = mysql_query("INSERT INTO Student (ID, Hash, FirstName, MiddleName, LastName, BirthDate, Gender, GradeLevel, GLS) VALUES ('$id','$hash', '$fname', '$mname', '$lname', '$bday', '$gender', '$gradelevel', '$section')");
				$tuition = $oes->getSingleData("Breakdown", "Price", "GradeLevel = '$gradelevel' AND Title = 'Tuition Fee'");
				$lab = $oes->getSingleData("Breakdown", "Price", "GradeLevel = '$gradelevel' AND Title = 'Laboratory Fee'");
				$misc = $oes->getSingleData("Breakdown", "Price", "GradeLevel = '$gradelevel' AND Title = 'Miscellaneous Fee'");
				$other = $oes->getSingleData("Breakdown", "Price", "GradeLevel = '$gradelevel' AND Title = 'Other Fee'");
				$q3 = mysql_query("INSERT INTO Assessment(ID, TuitionFee, LaboratoryFee, MiscellaneousFee, OtherFee) VALUES ('$id', '$tuition', '$lab', '$misc', '$other')");
				$oes->addFeed($id, "Welcome", "You are now registered as student!");
				if($q1 && $q2 && $q3) {
					showSnackbar('add_success');
					hideElements();
				} else
					showSnackbar('add_error');
			} else {
				showSnackbar('add_error');
			}
		} else {
			showSnackbar('add_error');
		}
	} elseif($action == "editstudent") {
		if(isset($_POST['fname'])) {
			$id = $_POST['id'];
			$fname = mysql_escape_string($_POST['fname']);
			$mname = mysql_escape_string($_POST['mname']);
			$lname = mysql_escape_string($_POST['lname']);
			$bday = $_POST['bday'];
			$gender = $_POST['gender'];
			$gradelevel = $_POST['gradelevel'];
			$section = $_POST['section'];
			$bc = $_POST['bc'];
			$form138 = $_POST['form138'];
			$gm = $_POST['gm'];
			if($bc == "true")
				$bc = 1;
			else
				$bc = 0;
			if($form138 == "true")
				$form138 = 1;
			else
				$form138 = 0;
			if($gm == "true")
				$gm = 1;
			else
				$gm = 0;
			if($fname != "" && $mname != "" && $lname != "" && $bday != "") {
				$q1 = mysql_query("UPDATE Student SET FirstName = '$fname', MiddleName = '$mname', LastName =  '$lname', BirthDate = '$bday', Gender = '$gender', GradeLevel = '$gradelevel', GLS = '$section', BirthCertificate = '$bc', Form138 = '$form138', GoodMoral = '$gm' WHERE ID = '$id'");
				if($q1) {
					showSnackbar('edit_success');
					hideElements();
				} else
					showSnackbar('edit_error');
			} else {
				showSnackbar('edit_error');
			}
		} else {
			showSnackbar('edit_error');
		}
	} elseif($action == "deletestudent") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$section = $oes->getSingleData("Student", "GLS", "ID = '$id'");
			mysql_query("DELETE FROM Account WHERE ID = '$id'");
			mysql_query("DELETE FROM Student WHERE ID = '$id'");
			mysql_query("DELETE FROM Assessment WHERE ID = '$id'");
			mysql_query("DELETE FROM Enrollee WHERE ID = '$id'");
			mysql_query("DELETE FROM Feed WHERE AccountID = '$id'");
			mysql_query("DELETE FROM CreditCard WHERE ID = '$id'");
			mysql_query("DELETE FROM Grade WHERE StudentID = '$id'");
			mysql_query("DELETE FROM Paper WHERE AccountID = '$id'");
			mysql_query("DELETE FROM Surcharge WHERE StudentID = '$id'");
			mysql_query("DELETE FROM Transaction WHERE StudentID = '$id'");
			$num = $oes->getNum("Student", "GLS = '$section'");
			if($num == 0)  {
				mysql_query("DELETE FROM GLS WHERE ID = '$section'");
				mysql_query("DELETE FROM Schedule WHERE SectionID = '$section'");
			}
			showSnackbar('delete_success');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "deletestudent_data") {
		if(isset($_POST['checkedData'])) {
			$checkedData = $_POST['checkedData'];
			$success = true;
			foreach($checkedData as $id) {
				$section = $oes->getSingleData("Student", "GLS", "ID = '$id'");
				mysql_query("DELETE FROM Student WHERE ID = '$id'");
				mysql_query("DELETE FROM Account WHERE ID = '$id'");
				mysql_query("DELETE FROM Enrollee WHERE ID = '$id'");
				mysql_query("DELETE FROM Assessment WHERE ID = '$id'");
				mysql_query("DELETE FROM Feed WHERE AccountID = '$id'");
				mysql_query("DELETE FROM CreditCard WHERE ID = '$id'");
				mysql_query("DELETE FROM Grade WHERE StudentID = '$id'");
				mysql_query("DELETE FROM Paper WHERE AccountID = '$id'");
				mysql_query("DELETE FROM Surcharge WHERE StudentID = '$id'");
				mysql_query("DELETE FROM Transaction WHERE StudentID = '$id'");
				$num = $oes->getNum("Student", "GLS = '$section'");
				if($num == 0) {
					mysql_query("DELETE FROM GLS WHERE ID = '$section'");
					mysql_query("DELETE FROM Schedule WHERE SectionID = '$section'");
				}
			}
			showSnackbar('delete_success');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "movestudenttosection_data") {
		if(isset($_POST['id'], $_POST['gradelevel'], $_POST['section'])) {
			$students = $_POST['id'];
			$gl = $_POST['gradelevel'];
			$section = $_POST['section'];
			foreach($students as $student) {
				$currentSection = $oes->getSingleData("Student", "GLS", "ID = '$student'");
				$numStudents = $oes->getData("Student", "*", "GLS = '$currentSection'");
				if(empty($numStudents)) {
					mysql_query("DELETE FROM GLS WHERE ID = '$currentSection'");
					mysql_query("DELETE FROM Schedule WHERE SectionID = '$currentSection'");
				}
				mysql_query("UPDATE Student SET GradeLevel = '$gl', GLS = '$section' WHERE ID = '$student'");
				$oes->addFeed($student, "Moved", "You're moved to Grade ".$gl.$oes->getSingleData("GLS", "Section", "ID = '$section'").".");
			}
			showSnackbar("edit_success");
			hideElements();
		} else
			showSnackbar("edit_error");
	} elseif($action == "editenrollee") {
		if(isset($_POST['id'], $_POST['status'], $_POST['admission'])) {
			$id = $_POST['id'];
			$status = $_POST['status'];
			$admission = $_POST['admission'];
			$bc = $_POST['bc'];
			$form138 = $_POST['form138'];
			$gm = $_POST['gm'];
			if($bc == "true")
				$bc = 1;
			else
				$bc = 0;
			if($form138 == "true")
				$form138 = 1;
			else
				$form138 = 0;
			if($gm == "true")
				$gm = 1;
			else
				$gm = 0;
			mysql_query("UPDATE Student SET BirthCertificate = '$bc', Form138 = '$form138', GoodMoral = '$gm' WHERE ID = '$id'");
			mysql_query("UPDATE Enrollee SET EnrollmentStatus = '$status', AdmissionID = '$admission' WHERE ID = '$id'");
			showSnackbar("edit_success");
			hideElements();
		}
	} elseif($action == "editenrolleestatus_data") {
		if(isset($_POST['id'], $_POST['status'])) {
			$enrollees = $_POST['id'];
			$status = $_POST['status'];
			foreach($enrollees as $id) {
				mysql_query("UPDATE Enrollee SET EnrollmentStatus = '$status' WHERE ID = '$id'");
			}
			showSnackbar("edit_success");
			hideElements();
		}
	} elseif($action == "deleteenrollee") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			mysql_query("DELETE FROM Student WHERE ID = '$id'");
			mysql_query("DELETE FROM Account WHERE ID = '$id'");
			mysql_query("DELETE FROM Enrollee WHERE ID = '$id'");
			mysql_query("DELETE FROM Assessment WHERE ID = '$id'");
			mysql_query("DELETE FROM Feed WHERE AccountID = '$id'");
			mysql_query("DELETE FROM CreditCard WHERE ID = '$id'");
			mysql_query("DELETE FROM Grade WHERE StudentID = '$id'");
			mysql_query("DELETE FROM Paper WHERE AccountID = '$id'");
			mysql_query("DELETE FROM Surcharge WHERE StudentID = '$id'");
			mysql_query("DELETE FROM Transaction WHERE StudentID	 = '$id'");
			showSnackbar("delete_success");
			hideElements();
		}
	} elseif($action == "deleteenrollee_data") {
		if(isset($_POST['checkedData'])) {
			$checkedData = $_POST['checkedData'];
			foreach($checkedData as $id) {
				mysql_query("DELETE FROM Student WHERE ID = '$id'");
				mysql_query("DELETE FROM Account WHERE ID = '$id'");
				mysql_query("DELETE FROM Enrollee WHERE ID = '$id'");
				mysql_query("DELETE FROM Assessment WHERE ID = '$id'");
				mysql_query("DELETE FROM Feed WHERE AccountID = '$id'");
				mysql_query("DELETE FROM CreditCard WHERE ID = '$id'");
				mysql_query("DELETE FROM Grade WHERE StudentID = '$id'");
				mysql_query("DELETE FROM Paper WHERE AccountID = '$id'");
				mysql_query("DELETE FROM Surcharge WHERE StudentID = '$id'");
				mysql_query("DELETE FROM Transaction WHERE StudentID = '$id'");
			}
			showSnackbar("delete_success");
			hideElements();
		}
	} elseif($action == "addfaculty") {
		if(isset($_POST['fname'])) {
			$fname = mysql_escape_string($_POST['fname']);
			$mname = mysql_escape_string($_POST['mname']);
			$lname = mysql_escape_string($_POST['lname']);
			$bday = $_POST['bday'];
			$gender = $_POST['gender'];
			if($fname != "" && $mname != "" && $lname != "" && $bday != "") {
				$id = $oes->GenerateAccountID();
				$username = $oes->GenerateUsername($id, $fname, $mname, $lname);
				$password = $oes->generatePassword(8);
				$q1 = mysql_query("INSERT INTO Account (ID, Username, Password, Type, Status) VALUES ('$id', '$username', '$password', 'Faculty', 'Active')");
				$q2 = mysql_query("INSERT INTO Faculty (ID, FirstName, MiddleName, LastName, BirthDate, Gender) VALUES ('$id', '$fname', '$mname', '$lname', '$bday', '$gender')");
				$oes->addFeed($id, "Welcome", "You are now registered as faculty!");
				if($q1 && $q2) {
					showSnackbar('add_success');
					hideElements();
				} else
					showSnackbar('add_error');
			} else {
				showSnackbar('add_error');
			}
		} else {
			showSnackbar('add_error');
		}
	} elseif($action == "editfaculty") {
		if(isset($_POST['fname'])) {
			$id = $_POST['id'];
			$fname = mysql_escape_string($_POST['fname']);
			$mname = mysql_escape_string($_POST['mname']);
			$lname = mysql_escape_string($_POST['lname']);
			$bday = $_POST['bday'];
			$gender = $_POST['gender'];
			if($fname != "" && $mname != "" && $lname != "" && $bday != "") {
				$q1 = mysql_query("UPDATE Faculty SET FirstName = '$fname', MiddleName = '$mname', LastName =  '$lname', BirthDate = '$bday', Gender = '$gender' WHERE ID = '$id'");
				if($q1) {
					showSnackbar('edit_success');
					hideElements();
				} else
					showSnackbar('edit_error');
			} else {
				showSnackbar('edit_error');
			}
		} else {
			showSnackbar('edit_error');
		}
	} elseif($action == "deletefaculty") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$q1 = mysql_query("DELETE FROM Account WHERE ID = '$id'");
			$q2 = mysql_query("DELETE FROM Faculty WHERE ID = '$id'");
			$q3 = mysql_query("DELETE FROM Expertise WHERE FacultyID = '$id'");
			if($q1 && $q2 && $q3)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "deletefaculty_data") {
		if(isset($_POST['checkedData'])) {
			$checkedData = $_POST['checkedData'];
			$success = true;
			foreach($checkedData as $data) {
				$q1 = mysql_query("DELETE FROM Account WHERE ID = '$data'");
				$q2 = mysql_query("DELETE FROM Faculty WHERE ID = '$data'");
				$q3 = mysql_query("DELETE FROM Expertise WHERE FacultyID = '$data'");
				if(!$q1 || !$q2 || !$q3)
					$success = false;
			}
			if($success)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "addexpertise") {
		if(isset($_POST['faculty'], $_POST['subject'])) {
			$faculty = $_POST['faculty'];
			$subject = $_POST['subject'];
			foreach($faculty as $f) {
				foreach($subject as $s) {
					if(!$oes->isExists("Expertise", array("FacultyID", "SubjectID"), array($f, $s))) {
						mysql_query("INSERT INTO Expertise (FacultyID, SubjectID) VALUES ('$f', '$s')");
					}
				}
			}
			hideElements();
			showSnackbar('add_success');
		}
	} elseif($action == "deleteexpertise") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$q1 = mysql_query("DELETE FROM Expertise WHERE ID = '$id'");
			if($q1) 
				showSnackbar("delete_success");
			else 
				showSnackbar("delete_error");
		} else
			showSnackbar("delete_error");
	} elseif($action == "deployadviser") {
		if(isset($_POST['section'], $_POST['faculty'])) {
			$section = $_POST['section'];
			$faculty = $_POST['faculty'];
			$q1 = mysql_query("UPDATE GLS SET FacultyID = '$faculty' WHERE ID = '$section'");
			if($faculty == "0")
				$q2 = mysql_query("UPDATE Schedule SET FacultyID = NULL WHERE Break = 'Homeroom' AND SectionID = '$section'");
			else
				$q2 = mysql_query("UPDATE Schedule SET FacultyID = '$faculty' WHERE  Break = 'Homeroom' AND SectionID = '$section'");
			$oes->addFeed($faculty, "Deployed", "You are assigned as an adviser to Grade ".$oes->getSingleData("GLS", "GradeLevel", "ID = '$section'").$oes->getSingleData("GLS", "Section", "ID = '$section'")."");
			if($q1 && $q2) {
				showSnackbar("edit_success");
				hideElements();
			} else
				showSnackbar("edit_error");
		} else
			showSnackbar("edit_error");
	} elseif($action == "getdataaction") {
		if(isset($_POST['module'])) {
			$m = $_POST['module'];
			if($m == "admin") {
			?>
				<li><a id="btnChangePasswordSelected"><span class="flat_icon ic_security_black trans_icon"></span>Change Password</a></li>
				<li><a id="btnDeleteSelected"><span class="flat_icon ic_delete_black trans_icon"></span>Delete</a></li>
				<script>
				$("#data-action-bar #btnDeleteSelected").click(function() {
					showDialogBox("deleteadmin_data", $checkedData);
				});
				$("#data-action-bar #btnChangePasswordSelected").click(function() {
					showBottomSheet("changepassword_data", $checkedData);
				});
				</script>
			<?php
			} elseif($m == "student") {
			?>
				<li><a id="btnMoveSectionSelected"><span class="flat_icon ic_exit_to_app_black trans_icon"></span>Move to Section</a></li>
				<li><a id="btnChangePasswordSelected"><span class="flat_icon ic_security_black trans_icon"></span>Change Password</a></li>
				<li><a id="btnArchiveSelected"><span class="flat_icon ic_archive_black trans_icon"></span>Move to Archive</a></li>
				<li><a id="btnDeleteSelected"><span class="flat_icon ic_delete_black trans_icon"></span>Delete</a></li>
				<script>
				$("#data-action-bar #btnDeleteSelected").click(function() {
					showDialogBox("deletestudent_data", $checkedData);
				});
				$("#data-action-bar #btnMoveSectionSelected").click(function() {
					showBottomSheet("movestudenttosection_data", $checkedData);
				});
				$("#data-action-bar #btnChangePasswordSelected").click(function() {
					showBottomSheet("changepassword_data", $checkedData);
				});
				$("#data-action-bar #btnArchiveSelected").click(function() {
					showDialogBox("archivestudent_data", $checkedData);
				});
				</script>
			<?php
			} elseif($m == "enrollee") {
			?>
				<li><a id="btnEditStatusSelected"><span class="flat_icon ic_pencil_black trans_icon"></span>Edit Status</a></li>
				<li><a id="btnChangePasswordSelected"><span class="flat_icon ic_security_black trans_icon"></span>Change Password</a></li>
				<li><a id="btnArchiveSelected"><span class="flat_icon ic_archive_black trans_icon"></span>Move to Archive</a></li>
				<li><a id="btnDeleteSelected"><span class="flat_icon ic_delete_black trans_icon"></span>Delete</a></li>
				<script>
				$("#data-action-bar #btnDeleteSelected").click(function() {
					showDialogBox("deleteenrollee_data", $checkedData);
				});
				$("#data-action-bar #btnEditStatusSelected").click(function() {
					showBottomSheet("editenrolleestatus_data", $checkedData);
				});
				$("#data-action-bar #btnChangePasswordSelected").click(function() {
					showBottomSheet("changepassword_data", $checkedData);
				});
				$("#data-action-bar #btnArchiveSelected").click(function() {
					showDialogBox("archiveenrollee_data", $checkedData);
				});
				</script>
			<?php
			} elseif($m == "passedenrollee") {
			?>
				<li><a id="btnConfirmSelected"><span class="flat_icon ic_done_black trans_icon"></span>Confirm</a></li>
				<li><a id="btnArchiveSelected"><span class="flat_icon ic_archive_black trans_icon"></span>Move to Archive</a></li>
				<li><a id="btnDeleteSelected"><span class="flat_icon ic_delete_black trans_icon"></span>Delete</a></li>
				<script>
				$("#data-action-bar #btnConfirmSelected").click(function() {
					showDialogBox("confirmenrollee_data", $checkedData);
				});
				$("#data-action-bar #btnDeleteSelected").click(function() {
					showDialogBox("deleteenrollee_data", $checkedData);
				});
				$("#data-action-bar #btnArchiveSelected").click(function() {
					showDialogBox("archiveenrollee_data", $checkedData);
				});
				</script>
			<?php
			} elseif($m == "faculty") {
			?>
				<li><a id="btnAddExpertise"><span class="flat_icon ic_loyalty_black trans_icon"></span>Add Expertise</a></li>
				<li><a id="btnChangePasswordSelected"><span class="flat_icon ic_security_black trans_icon"></span>Change Password</a></li>
				<li><a id="btnArchiveSelected"><span class="flat_icon ic_archive_black trans_icon"></span>Move to Archive</a></li>
				<li><a id="btnDeleteSelected"><span class="flat_icon ic_delete_black trans_icon"></span>Delete</a></li>
				<script>
				$("#data-action-bar #btnDeleteSelected").click(function() {
					showDialogBox("deletefaculty_data", $checkedData);
				});
				$("#data-action-bar #btnAddExpertise").click(function() {
					showBottomSheet("addexpertise", $checkedData);
				});
				$("#data-action-bar #btnChangePasswordSelected").click(function() {
					showBottomSheet("changepassword_data", $checkedData);
				});
				$("#data-action-bar #btnArchiveSelected").click(function() {
					showDialogBox("archivefaculty_data", $checkedData);
				});
				</script>
			<?php
			} elseif($m == "college") {
			?>
				<li><a id="btnDeleteSelected"><span class="flat_icon ic_delete_black trans_icon"></span>Delete</a></li>
				<script>
				$("#data-action-bar #btnDeleteSelected").click(function() {
					showDialogBox("deletecollege_data", $checkedData);
				});
				</script>
			<?php
			} elseif($m == "building") {
			?>
				<li><a id="btnDeleteSelected"><span class="flat_icon ic_delete_black trans_icon"></span>Delete</a></li>
				<script>
				$("#data-action-bar #btnDeleteSelected").click(function() {
					showDialogBox("deletebuilding_data", $checkedData);
				});
				</script>
			<?php
			} elseif($m == "course") {
			?>
				<li><a id="btnDeleteSelected"><span class="flat_icon ic_delete_black trans_icon"></span>Delete</a></li>
				<script>
				$("#data-action-bar #btnDeleteSelected").click(function() {
					showDialogBox("deletecourse_data", $checkedData);
				});
				</script>
			<?php
			} elseif($m == "department") {
			?>
				<li><a id="btnDeleteSelected"><span class="flat_icon ic_delete_black trans_icon"></span>Delete</a></li>
				<script>
				$("#data-action-bar #btnDeleteSelected").click(function() {
					showDialogBox("deletedepartment_data", $checkedData);
				});
				</script>
			<?php
			} elseif($m == "subject") {
			?>
				<li><a id="btnDeleteSelected"><span class="flat_icon ic_delete_black trans_icon"></span>Delete</a></li>
				<script>
				$("#data-action-bar #btnDeleteSelected").click(function() {
					showDialogBox("deletesubject_data", $checkedData);
				});
				</script>
			<?php
			} elseif($m == "room") {
			?>
				<li><a id="btnDeleteSelected"><span class="flat_icon ic_delete_black trans_icon"></span>Delete</a></li>
				<script>
				$("#data-action-bar #btnDeleteSelected").click(function() {
					showDialogBox("deleteroom_data", $checkedData);
				});
				</script>
			<?php
			} elseif($m == "curriculum") {
			?>
				<li><a id="btnDeleteSelected"><span class="flat_icon ic_delete_black trans_icon"></span>Delete</a></li>
				<script>
				$("#data-action-bar #btnDeleteSelected").click(function() {
					showDialogBox("deletecurriculum_data", $checkedData);
				});
				</script>
			<?php
			} elseif($m == "section") {
			?>
				<li><a id="btnDeleteSelected"><span class="flat_icon ic_delete_black trans_icon"></span>Delete</a></li>
				<script>
				$("#data-action-bar #btnDeleteSelected").click(function() {
					showDialogBox("deletesection_data", $checkedData);
				});
				</script>
			<?php
			} elseif($m == "sectionschedule") {
			?>
				<li><a id="btnDeleteSelected"><span class="flat_icon ic_delete_black trans_icon"></span>Delete</a></li>
				<script>
				$("#data-action-bar #btnDeleteSelected").click(function() {
					showDialogBox("deletesectionschedule_data", $checkedData);
				});
				</script>
			<?php
			} elseif($m == "facultyschedule") {
			?>
				<li><a id="btnDeleteSelected"><span class="flat_icon ic_delete_black trans_icon"></span>Delete</a></li>
				<script>
				$("#data-action-bar #btnDeleteSelected").click(function() {
					showDialogBox("deletefacultyschedule_data", $checkedData);
				});
				</script>
			<?php
			}
		}
	} elseif($action == "changepassword") {
		if(isset($_POST['old'], $_POST['new'], $_POST['new2'])) {
			$old = mysql_escape_string($_POST['old']);
			$new = mysql_escape_string($_POST['new']);
			$new2 = mysql_escape_string($_POST['new2']);
			$curpass = $oes->getSingleData("Account", "Password", "ID = '".$_SESSION['loggedID']."'");
			if($curpass == $old && $new == $new2) {
				$q1 = mysql_query("UPDATE Account SET Password = '$new' WHERE ID = '".$_SESSION['loggedID']."'");
				if($q1)
					header("Location: index.php?settings&pass_success");
				else
					header("Location: index.php?settings&pass_error");
			} else
				header("Location: index.php?settings&pass_error");
		} else
			header("Location: index.php?settings&pass_error");
	} elseif($action == "addstudent_excel") {
		if(isset($_POST['submit'])) {
			$h = $oes->generateHash(10);
			$import = $_FILES['import'];
			$directory = "resources/excels/";
			$filename = substr(basename($import["name"]), 0, 0-strlen(pathinfo(basename($import["name"]), PATHINFO_EXTENSION))-1).'_'.$h.'.'.pathinfo(basename($import["name"]), PATHINFO_EXTENSION);
			move_uploaded_file($import["tmp_name"], $directory.$filename);
			

			$excel->setOutputEncoding('CP1251');
			$excel->read($directory.$filename);

			$columns = array();
			$data = array();
			for ($i = 1; $i <= $excel->sheets[0]['numRows']; $i++) {
				for ($j = 1; $j <= $excel->sheets[0]['numCols']; $j++) {
					if($i == 1) {
						$columns[] = $excel->sheets[0]['cells'][$i][$j];
					} else {
						$data[$i-1][$columns[$j-1]] = $excel->sheets[0]['cells'][$i][$j];
					}
				}
			}
			$query_column = "";
			foreach($columns as $column) {
				if($query_column == "")
					$query_column .= $column;
				else
					$query_column .= ", $column";
			}
			$error = false;
			foreach($data as $d) {
				if(isset($d["FirstName"], $d["MiddleName"], $d["LastName"], $d["GradeLevel"])) {
					$id = $oes->GenerateAccountID();
					$username = $oes->GenerateUsername($id, $d["FirstName"], $d["MiddleName"], $d["LastName"]);
					$query_value = "";
					foreach($d as $val) {
						if($query_value == "")
							$query_value .= "'$val'";
						else
							$query_value .= ", '$val'";
					}
					$hash = $oes->generateHash(15);
					mysql_query("INSERT INTO Account (ID, Username, Password, Type, Status) VALUES ('$id', '$username', '$username', 'Student', 'Active')");
					mysql_query("INSERT INTO Student (ID, Hash, $query_column, GLS) VALUES ('$id', '$hash', $query_value, '0')");
					$gradelevel = $d["GradeLevel"];
					$tuition = $oes->getSingleData("Breakdown", "Price", "GradeLevel = '$gradelevel' AND Title = 'Tuition Fee'");
					$lab = $oes->getSingleData("Breakdown", "Price", "GradeLevel = '$gradelevel' AND Title = 'Laboratory Fee'");
					$misc = $oes->getSingleData("Breakdown", "Price", "GradeLevel = '$gradelevel' AND Title = 'Miscellaneous Fee'");
					$other = $oes->getSingleData("Breakdown", "Price", "GradeLevel = '$gradelevel' AND Title = 'Other Fee'");
					mysql_query("INSERT INTO Assessment(ID, TuitionFee, LaboratoryFee, MiscellaneousFee, OtherFee) VALUES ('$id', '$tuition', '$lab', '$misc', '$other')");
					$oes->addFeed($id, "Welcome", "You are now registered as student!");
				} else {
					$error = true;
					break;
				}
			}
			if(!$error)
				header("Location: index.php?student-master-data&import_success");
			else
				header("Location: index.php?student-master-data&import_error");
		}
	} elseif($action == "addenrollee_excel") {
		if(isset($_POST['submit'])) {
			$h = $oes->generateHash(10);
			$import = $_FILES['import'];
			$directory = "resources/excels/";
			$filename = substr(basename($import["name"]), 0, 0-strlen(pathinfo(basename($import["name"]), PATHINFO_EXTENSION))-1).'_'.$h.'.'.pathinfo(basename($import["name"]), PATHINFO_EXTENSION);
			move_uploaded_file($import["tmp_name"], $directory.$filename);
			

			$excel->setOutputEncoding('CP1251');
			$excel->read($directory.$filename);

			$columns = array();
			$data = array();
			for ($i = 1; $i <= $excel->sheets[0]['numRows']; $i++) {
				for ($j = 1; $j <= $excel->sheets[0]['numCols']; $j++) {
					if($i == 1) {
						$columns[] = $excel->sheets[0]['cells'][$i][$j];
					} else {
						$data[$i-1][$columns[$j-1]] = $excel->sheets[0]['cells'][$i][$j];
					}
				}
			}
			$query_column = "";
			foreach($columns as $column) {
				if($query_column == "")
					$query_column .= $column;
				else
					$query_column .= ", $column";
			}
			$error = false;
			foreach($data as $d) {
				if(isset($d["FirstName"], $d["MiddleName"], $d["LastName"], $d["GradeLevel"])) {
					$id = $oes->GenerateAccountID();
					$gradelevel = $d["GradeLevel"];
					$username = $oes->GenerateUsername($id, $d["FirstName"], $d["MiddleName"], $d["LastName"]);
					$password = $oes->generatePassword(8);
					$query_value = "";
					foreach($d as $val) {
						if($query_value == "")
							$query_value .= "'$val'";
						else
							$query_value .= ", '$val'";
					}
					$hash = $oes->generateHash(15);
					mysql_query("INSERT INTO Account (ID, Username, Password, Type, Status) VALUES ('$id', '$username', '$password', 'Enrollee', 'Active')");
					mysql_query("INSERT INTO Student (ID, Hash, $query_column, GLS) VALUES ('$id', '$hash', $query_value, '0')");
					if($gradelevel == 7) {
						$schedule = $oes->getScheduleDate("Exam");
					} else {
						$schedule = $oes->getScheduleDate("Interview");
					}
					mysql_query("INSERT INTO Enrollee(ID, AdmissionID, EnrollmentStatus) VALUES ('$id', '$schedule', 'Pending')");
					$gradelevel = $d["GradeLevel"];
					$tuition = $oes->getSingleData("Breakdown", "Price", "GradeLevel = '$gradelevel' AND Title = 'Tuition Fee'");
					$lab = $oes->getSingleData("Breakdown", "Price", "GradeLevel = '$gradelevel' AND Title = 'Laboratory Fee'");
					$misc = $oes->getSingleData("Breakdown", "Price", "GradeLevel = '$gradelevel' AND Title = 'Miscellaneous Fee'");
					$other = $oes->getSingleData("Breakdown", "Price", "GradeLevel = '$gradelevel' AND Title = 'Other Fee'");
					mysql_query("INSERT INTO Assessment(ID, TuitionFee, LaboratoryFee, MiscellaneousFee, OtherFee) VALUES ('$id', '$tuition', '$lab', '$misc', '$other')");
					$oes->addFeed($id, "Welcome", "You are now registered as an enrollee.");
				} else {
					$error = true;
					break;
				}
			}
			if(!$error)
				header("Location: index.php?enrollee-master-data&import_success");
			else
				header("Location: index.php?enrollee-master-data&import_error");
		}
	} elseif($action == "addfaculty_excel") {
		if(isset($_POST['submit'])) {
			$h = $oes->generateHash(10);
			$import = $_FILES['import'];
			$directory = "resources/excels/";
			$filename = substr(basename($import["name"]), 0, 0-strlen(pathinfo(basename($import["name"]), PATHINFO_EXTENSION))-1).'_'.$h.'.'.pathinfo(basename($import["name"]), PATHINFO_EXTENSION);
			move_uploaded_file($import["tmp_name"], $directory.$filename);
			

			$excel->setOutputEncoding('CP1251');
			$excel->read($directory.$filename);

			$columns = array();
			$data = array();
			for ($i = 1; $i <= $excel->sheets[0]['numRows']; $i++) {
				for ($j = 1; $j <= $excel->sheets[0]['numCols']; $j++) {
					if($i == 1) {
						$columns[] = $excel->sheets[0]['cells'][$i][$j];
					} else {
						$data[$i-1][$columns[$j-1]] = $excel->sheets[0]['cells'][$i][$j];
					}
				}
			}
			$query_column = "";
			foreach($columns as $column) {
				if($query_column == "")
					$query_column .= $column;
				else
					$query_column .= ", $column";
			}
			$error = false;
			foreach($data as $d) {
				if(isset($d["FirstName"], $d["MiddleName"], $d["LastName"])) {
					$id = $oes->GenerateAccountID();
					$username = $oes->GenerateUsername($id, $d["FirstName"], $d["MiddleName"], $d["LastName"]);
					$password = $oes->generatePassword(8);
					$query_value = "";
					foreach($d as $val) {
						if($query_value == "")
							$query_value .= "'$val'";
						else
							$query_value .= ", '$val'";
					}
					mysql_query("INSERT INTO Account (ID, Username, Password, Type, Status) VALUES ('$id', '$username', '$password', 'Faculty', 'Active')");
					mysql_query("INSERT INTO Faculty (ID, $query_column) VALUES ('$id', $query_value)");
					$oes->addFeed($id, "Welcome", "You are now registered as faculty!");
				} else {
					$error = true;
					break;
				}
			}
			if(!$error)
				header("Location: index.php?faculty-master-data&import_success");
			else
				header("Location: index.php?faculty-master-data&import_error");
		}
	} elseif($action == "auto_assign_students_to_section") {
		for($i = 7; $i <= 10; $i++) {
			$totalStudents = sizeof($oes->getData("Student INNER JOIN Account", "*", "Student.ID = Account.ID AND Account.Type = 'Student' AND Account.Status = 'Active' AND GradeLevel = '$i'"));
			$totalSectionsNeeded = ceil($totalStudents/40);
			$totalCurrentSections = sizeof($oes->getData("GLS", "*", "GradeLevel = '$i' AND ID IN (SELECT GLS FROM Student)"));
			$totalSectionsToCreate = $totalSectionsNeeded - $totalCurrentSections;
			$totalRooms = sizeof($oes->getData("Room", "*", ""));
			if($totalCurrentSections + $totalSectionsToCreate <= $totalRooms) {
				mysql_query("DELETE FROM GLS WHERE ID NOT IN (SELECT GLS FROM Student)");
				mysql_query("DELETE FROM Schedule WHERE SectionID NOT IN (SELECT GLS FROM Student)");
				if($totalSectionsToCreate > 0) {
					$oes->createSections($totalSectionsToCreate, $i);
				}
				$students = $oes->getData("Student INNER JOIN Account", "*", "Student.ID = Account.ID AND Account.Type = 'Student' AND Student.GradeLevel = '$i' AND Student.GLS = '0' AND Student.Gender = 'Male' AND Account.Status = 'Active' ORDER BY Student.LastName");
				foreach($students as $student) {
					$section = $oes->getSectionWithLowestStudent($i);
					mysql_query("UPDATE Student SET GLS = '$section' WHERE ID = '".$student["ID"]."'");
					$oes->addFeed($student["ID"], "Moved", "You're moved to Grade ".$oes->getSingleData("GLS", "GradeLevel", "ID = '$section'").$oes->getSingleData("GLS", "Section", "ID = '$section'").".");
				}
				$students = $oes->getData("Student INNER JOIN Account", "*", "Student.ID = Account.ID AND Account.Type = 'Student' AND Student.GradeLevel = '$i' AND Student.GLS = '0' AND Student.Gender = 'Female' AND Account.Status = 'Active' ORDER BY Student.LastName");
				foreach($students as $student) {
					$section = $oes->getSectionWithLowestStudent($i);
					mysql_query("UPDATE Student SET GLS = '$section' WHERE ID = '".$student["ID"]."'");
					$oes->addFeed($student["ID"], "Moved", "You're moved to Grade ".$oes->getSingleData("GLS", "GradeLevel", "ID = '$section'").$oes->getSingleData("GLS", "Section", "ID = '$section'").".");
				}
			} else {
				showSnackbarMsg("Rooms aren't enough for additional sections");
			}
		}
	} elseif($action == "auto_assign_faculty_to_section") {
		$sections = $oes->getData("GLS", "*", "FacultyID = '0'");
		foreach($sections as $section) {
			$faculty = $oes->getData("Faculty", "*", "ID NOT IN (SELECT FacultyID FROM GLS)");
			if(!empty($faculty)) {
				$selectedfaculty = rand(0, sizeof($faculty)-1);
				mysql_query("UPDATE GLS SET FacultyID = '".$faculty[$selectedfaculty]["ID"]."' WHERE ID = '".$section["ID"]."'");
				mysql_query("UPDATE Schedule SET FacultyID = '".$faculty[$selectedfaculty]["ID"]."' WHERE SubjectID IS NULL AND Break = 'Homeroom' AND SectionID = '".$section["ID"]."'");
				$oes->addFeed($faculty[$selectedfaculty]["ID"], "Deployed", "You are assigned as an adviser to Grade ".$section["GradeLevel"].$section["Section"]."");

			}
		}
	} elseif($action == "auto_assign_edate_to_enrollee") {
		$students = $oes->getData("Account INNER JOIN Enrollee INNER JOIN Student", "*", "Student.ID = Account.ID AND Enrollee.ID = Account.ID AND Account.Type = 'Enrollee' AND Enrollee.AdmissionID = '0' AND Student.GradeLevel = '7' AND Account.Status = 'Active'");
		$n = 0;
		$dates = $oes->getData("Admission", "*", "Entrance = 'Exam'");
		$sy = $oes->getSchoolYear();
		$max = $oes->getSingleData("Administration", "MaxExaminees", "SchoolYear = '$sy'");
		foreach($dates as $date) {
			$id = $date["ID"];
			while(true) {
				if($n < sizeof($students)) {
					$check = $oes->getNum("Account INNER JOIN Enrollee INNER JOIN Student", "Student.ID = Account.ID AND Enrollee.ID = Account.ID AND Account.Type = 'Enrollee' AND Enrollee.AdmissionID = '$id' AND Student.GradeLevel = '7' AND Account.Status = 'Active'");
					if($check < $max) {
						$sid = $students[$n]["ID"];
						mysql_query("UPDATE Enrollee SET AdmissionID = '$id' WHERE ID = '$sid'");
						$n++;
					} else break;
				} else break;
			}
		}
	} elseif($action == "auto_assign_idate_to_enrollee") {
		$students = $oes->getData("Account INNER JOIN Enrollee INNER JOIN Student", "*", "Student.ID = Account.ID AND Enrollee.ID = Account.ID AND Account.Type = 'Enrollee' AND Enrollee.AdmissionID = '0' AND Student.GradeLevel != '7' AND Account.Status = 'Active'");
		$n = 0;
		$dates = $oes->getData("Admission", "*", "Entrance = 'Interview'");
		$sy = $oes->getSchoolYear();
		$max = $oes->getSingleData("Administration", "MaxInterviewees", "SchoolYear = '$sy'");
		foreach($dates as $date) {
			$id = $date["ID"];
			while(true) {
				if($n < sizeof($students)) {
					$check = $oes->getNum("Account INNER JOIN Enrollee INNER JOIN Student", "Student.ID = Account.ID AND Enrollee.ID = Account.ID AND Account.Type = 'Enrollee' AND Enrollee.AdmissionID = '$id' AND Student.GradeLevel != '7' AND Account.Status = 'Active'");
					if($check < $max) {
						$sid = $students[$n]["ID"];
						mysql_query("UPDATE Enrollee SET AdmissionID = '$id' WHERE ID = '$sid'");
						$n++;
					} else break;
				} else break;
			}
		}
	} elseif($action == "addsectionschedule") {
		if(isset($_POST['section'], $_POST['subject'], $_POST['m'], $_POST['t'], $_POST['w'], $_POST['h'], $_POST['f'], $_POST['start_hour'], $_POST['start_min'], $_POST['end_hour'], $_POST['end_min'])) {
			$section = $_POST['section'];
			$subject = $_POST['subject'];
			$m = $_POST['m'];
			$t = $_POST['t'];
			$w = $_POST['w'];
			$h = $_POST['h'];
			$f = $_POST['f'];
			$days = "";
			if($m == "true") 
				$days .= "M";
			if($t == "true")
				$days .= "T";
			if($w == "true")
				$days .= "W";
			if($h == "true")
				$days .= "H";
			if($f == "true")
				$days .= "F";
			$start_hour = $_POST['start_hour'];
			$start_min = $_POST['start_min'];
			$end_hour = $_POST['end_hour'];
			$end_min = $_POST['end_min'];
			$startTime = date("H:i:s", strtotime("$start_hour:$start_min:00"));
			$endTime = date("H:i:s", strtotime("$end_hour:$end_min:00"));
			$breaks = array("Homeroom", "Recess", "Lunch", "Club Meetings");
			if($days != "" && $startTime < $endTime) {
				$intersect = false;
				for($i = 0; $i < strlen($days); $i++) {
					$query = mysql_query("SELECT * FROM Schedule WHERE SectionID = '$section' AND Day LIKE '%".$days[$i]."%' AND (('$startTime' >= StartTime AND '$startTime' < EndTime) OR ('$endTime' > StartTime AND '$endTime' <= EndTime))");
					if(mysql_num_rows($query) > 0) 
						$intersect = true;
				}
				if(!$intersect) {
					if(in_array($subject, $breaks)) {
						for($i = 0; $i < strlen($days); $i++) {
							if($subject == "Homeroom") {
								$adviser = $oes->getSingleData("GLS", "FacultyID", "ID = '$section'");
								if($adviser == 0)
									mysql_query("INSERT INTO Schedule (SectionID, Break, Day, StartTime, EndTime) VALUES ('$section', '$subject', '".$days[$i]."', '$startTime', '$endTime')");
								else
									mysql_query("INSERT INTO Schedule (SectionID, Break, FacultyID, Day, StartTime, EndTime) VALUES ('$section', '$subject', '$adviser', '".$days[$i]."', '$startTime', '$endTime')");
							} else {
								mysql_query("INSERT INTO Schedule (SectionID, Break, Day, StartTime, EndTime) VALUES ('$section', '$subject', '".$days[$i]."', '$startTime', '$endTime')");
							}
						}
					} else {
						for($i = 0; $i < strlen($days); $i++) {
							mysql_query("INSERT INTO Schedule (SectionID, SubjectID, Day, StartTime, EndTime) VALUES ('$section', '$subject', '".$days[$i]."', '$startTime', '$endTime')");
						}
					}
					hideElements();
				} else {
					showSnackbarMsg("Error: Subject has overlapped another subject.");
				}
			} else {
				showSnackbarMsg("Days and Time is invalid.");
			}
		}
	} elseif($action == "addfacultyschedule") {
		if(isset($_POST['faculty'], $_POST['section'], $_POST['subject'])) {
			$faculty = $_POST['faculty'];
			$section = $_POST['section'];
			$subject = $_POST['subject'];
			$schedule = $oes->getData("Schedule", "*", "FacultyID IS NULL AND SectionID = '$section' AND SubjectID = '$subject'");
			$intersect = false;
			$currentLoad = $oes->getTotalLoad($faculty);
			if($currentLoad + $oes->getSingleData("Subject", "Units", "ID = '$subject'") <= 24) {
				foreach($schedule as $s) {
					$day = $s["Day"];
					$startTime = $s["StartTime"];
					$endTime = $s["EndTime"];
					$query = mysql_query("SELECT * FROM Schedule WHERE FacultyID = '$faculty' AND Day = '$day' AND (('$startTime' >= StartTime AND '$startTime' < EndTime) OR ('$endTime' > StartTime AND '$endTime' <= EndTime))");
					if(mysql_num_rows($query) > 0) 
							$intersect = true;
				}
				if(!$intersect) {
					mysql_query("UPDATE Schedule SET FacultyID = '$faculty' WHERE SectionID = '$section' AND SubjectID = '$subject'");
					showSnackbar("add_success");
				} else {
					showSnackbarMsg("Error: The schedule you want to add has overlapped another subject");
				}
			} else {
				showSnackbarMsg("Maximum load is 24 units only.");
			}
		}
	} elseif($action == "deletesectionschedule") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$q1 = mysql_query("DELETE FROM Schedule WHERE ID = '$id'");
			if($q1)
				showSnackbar("delete_success");
			else
				showSnackbar("delete_error");
		} else
			showSnackbar("delete_error");
	} elseif($action == "deletesectionschedule_data") {
		if(isset($_POST['checkedData'])) {
			$checkedData = $_POST['checkedData'];
			$success = true;
			foreach($checkedData as $data) {
				$q1 = mysql_query("DELETE FROM Schedule WHERE ID = '$data'");
				if(!$q1)
					$success = false;
			}
			if($success)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "deletefacultyschedule") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$sched = $oes->getRow("Schedule", "*", "ID = '$id'");
			$q1 = mysql_query("UPDATE Schedule SET FacultyID = NULL WHERE SectionID = '".$sched["SectionID"]."' AND SubjectID = '".$sched["SubjectID"]."'");
			if($q1)
				showSnackbar("delete_success");
			else
				showSnackbar("delete_error");
		} else
			showSnackbar("delete_error");
	} elseif($action == "deletefacultyschedule_data") {
		if(isset($_POST['checkedData'])) {
			$checkedData = $_POST['checkedData'];
			$success = true;
			$faculty = "";
			foreach($checkedData as $data) {
				$sched = $oes->getRow("Schedule", "*", "ID = '$data'");
				if($faculty == "")
					$faculty = $sched["FacultyID"];
				mysql_query("UPDATE Schedule SET FacultyID = NULL WHERE SectionID = '".$sched["SectionID"]."' AND SubjectID = '".$sched["SubjectID"]."'");
			}
			?><script>refreshListFacultySchedule('<?php echo $faculty; ?>');</script><?php
			showSnackbar('delete_success');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "setdefaultroom") {
		if(isset($_POST['section'], $_POST['room'])) {
			$section = $_POST['section'];
			$room = $_POST['room'];
			$q1 = mysql_query("UPDATE GLS SET RoomID = '$room' WHERE ID = '$section'");
			if($q1) {
				showSnackbar("edit_success");
				hideElements();
			} else
				showSnackbar("edit_error");
		} else
			showSnackbar("edit_error");
	} elseif($action == "auto_generate_schedule_to_section") {
		if(isset($_POST['section'])) {
			$section = $_POST['section'];
			$gradelevel = $oes->getSingleData("GLS", "GradeLevel", "ID = '$section'");
			mysql_query("DELETE FROM Schedule WHERE SectionID = '$section'");
			$day = array("M", "T");
			$daypartner = array("W", "H");
			$patterns = array(
				array("Homeroom", "Subject", "Recess", "Subject", "Subject", "Subject", "Lunch", "Subject", "Subject", "Subject"),
				array("Subject", "Subject", "Recess", "Subject", "Subject", "Lunch", "Subject", "Subject", "Subject"),
				array("Homeroom", "Subject", "Recess", "Subject", "Subject", "Lunch", "Subject", "Subject", "Club Meetings")
			);
			$time = array("07:30", "08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30");
				
			$x = 0;
			//$rand1 = rand(0,1);
			$rand1 = 0;
			while($x < sizeof($day)) {
				$timeline = 0;
				if($rand1 == "0") {
					for($i = 0; $i < sizeof($patterns[$rand1]); $i++) {
						$key = $patterns[$rand1][$i];
						if($key == "Subject") {
							$select = false;
							$subjectsavailable = $oes->getData("Subject", "*", "ID NOT IN (SELECT SubjectID FROM Schedule WHERE Day = '".$day[$x]."' AND SectionID = '$section' AND Break IS NULL) AND Name NOT LIKE '%Elective' AND Code != 'TLE'");
							while(!$select) {
								$selectedsubject = rand(0, sizeof($subjectsavailable)-1);
								if(in_array($subjectsavailable[$selectedsubject]["Code"], array("English", "Filipino", "Math", "Science"))) {
									$check = $oes->getData("Schedule", "*", "SectionID = '$section' AND Day = '".$day[$x]."' AND SubjectID IN (SELECT ID FROM Subject WHERE Code = '".$subjectsavailable[$selectedsubject]["Code"]."')");
									if(sizeof($check) == 0)
										$select = true;
								} elseif(in_array($subjectsavailable[$selectedsubject]["Code"], array("Music", "Arts", "PE", "Health"))) {
									$check = $oes->getData("Schedule", "*", "SectionID = '$section' AND Day = '".$day[$x]."' AND SubjectID IN (SELECT ID FROM Subject WHERE Code IN ('Music', 'Arts', 'PE', 'Health'))");
									$check2 = $oes->getData("Schedule", "*", "SectionID = '$section' AND Day IN ('M', 'T') AND SubjectID IN (SELECT ID FROM Subject WHERE Code = '".$subjectsavailable[$selectedsubject]["Code"]."')");
									if(sizeof($check) == 0 && sizeof($check) == 0)
										$select = true;
								} elseif(in_array($subjectsavailable[$selectedsubject]["Code"], array("AP", "ESP", "CLE"))) {
									$check = $oes->getData("Schedule", "*", "SectionID = '$section' AND Day IN ('M', 'T') AND SubjectID IN (SELECT ID FROM Subject WHERE Code = '".$subjectsavailable[$selectedsubject]["Code"]."')");
									$check2 = $oes->getData("Schedule", "*", "SectionID = '$section' AND Day = '".$day[$x]."' AND SubjectID IN (SELECT ID FROM Subject WHERE Code IN ('AP', 'CLE', 'ESP'))");
									if(sizeof($check) == 0 && sizeof($check2) < 2) 
										$select = true;
								}
							}
							if($oes->checkExpertiseAndSchedule($subjectsavailable[$selectedsubject]["ID"], $day[$x], $time[$timeline].':00', $time[$timeline+2].':00')) {
								mysql_query("INSERT INTO Schedule (SectionID, SubjectID, Day, StartTime, EndTime) VALUES ('$section', '".$subjectsavailable[$selectedsubject]["ID"]."', '".$day[$x]."', '".$time[$timeline].":00', '".$time[$timeline+2].":00')");
								if(in_array($subjectsavailable[$selectedsubject]["Code"], array("Music", "Arts", "PE", "Health"))) {
									$subjectpartner = $oes->getData("Subject", "*", "ID NOT IN (SELECT SubjectID FROM Schedule WHERE SectionID = '$section' AND Break IS NULL) AND Name NOT LIKE '%Elective' AND Units = '1'");
									$selectedsubject = rand(0, sizeof($subjectpartner)-1);
									mysql_query("INSERT INTO Schedule (SectionID, SubjectID, Day, StartTime, EndTime) VALUES ('$section', '".$subjectpartner[$selectedsubject]["ID"]."', '".$daypartner[$x]."', '".$time[$timeline].":00', '".$time[$timeline+=2].":00')");
								} else {
									mysql_query("INSERT INTO Schedule (SectionID, SubjectID, Day, StartTime, EndTime) VALUES ('$section', '".$subjectsavailable[$selectedsubject]["ID"]."', '".$daypartner[$x]."', '".$time[$timeline].":00', '".$time[$timeline+=2].":00')");
								}
							}
						} elseif($key == "Homeroom" || $key == "Recess") {
							mysql_query("INSERT INTO Schedule (SectionID, Break, Day, StartTime, EndTime) VALUES ('$section', '$key', '".$day[$x]."', '".$time[$timeline].":00', '".$time[$timeline+1].":00')");
							mysql_query("INSERT INTO Schedule (SectionID, Break, Day, StartTime, EndTime) VALUES ('$section', '$key', '".$daypartner[$x]."', '".$time[$timeline].":00', '".$time[$timeline+=1].":00')");
						} elseif($key == "Lunch") {
							mysql_query("INSERT INTO Schedule (SectionID, Break, Day, StartTime, EndTime) VALUES ('$section', '$key', '".$day[$x]."', '".$time[$timeline].":00', '".$time[$timeline+2].":00')");
							mysql_query("INSERT INTO Schedule (SectionID, Break, Day, StartTime, EndTime) VALUES ('$section', '$key', '".$daypartner[$x]."', '".$time[$timeline].":00', '".$time[$timeline+=2].":00')");
						}
					}
					$rand1 = 1;
				} else {
					for($i = 0; $i < sizeof($patterns[$rand1]); $i++) {
						$key = $patterns[$rand1][$i];
						if($key == "Subject") {
							$select = false; 
							$subjectsavailable = $oes->getData("Subject", "*", "ID NOT IN (SELECT SubjectID FROM Schedule WHERE Day = '".$day[$x]."' AND SectionID = '$section' AND Break IS NULL) AND Name NOT LIKE '%Elective'");
							$checktle = $oes->getData("Schedule", "*", "SectionID IN (SELECT ID FROM GLS WHERE GradeLevel = '$gradelevel') AND SubjectID = (SELECT ID FROM Subject WHERE Code = 'TLE')");
							if(sizeof($checktle) > 0) {
								$checktle2 = $oes->getData("Schedule", "*", "SectionID IN (SELECT ID FROM GLS WHERE GradeLevel = '$gradelevel') AND SubjectID = (SELECT ID FROM Subject WHERE Code = 'TLE') AND Day = '".$day[$x]."' AND StartTime = '".$time[$timeline]."' AND EndTime = '".$time[$timeline+3]."'");
								if(sizeof($checktle2) > 0) {
									mysql_query("INSERT INTO Schedule (SectionID, SubjectID, Day, StartTime, EndTime) VALUES ('$section', (SELECT ID FROM Subject WHERE Code = 'TLE'), '".$day[$x]."', '".$time[$timeline].":00', '".$time[$timeline+3].":00')");
									mysql_query("INSERT INTO Schedule (SectionID, SubjectID, Day, StartTime, EndTime) VALUES ('$section', (SELECT ID FROM Subject WHERE Code = 'TLE'), '".$daypartner[$x]."', '".$time[$timeline].":00', '".$time[$timeline+=3].":00')");
								} else {
									while(!$select) {
										$selectedsubject = rand(0, sizeof($subjectsavailable)-1);
										if(in_array($subjectsavailable[$selectedsubject]["Code"], array("English", "Filipino", "Math", "Science"))) {
											$check = $oes->getData("Schedule", "*", "SectionID = '$section' AND Day = '".$day[$x]."' AND SubjectID IN (SELECT ID FROM Subject WHERE Code = '".$subjectsavailable[$selectedsubject]["Code"]."')");
											if(sizeof($check) == 0) 
												$select = true;
										} elseif(in_array($subjectsavailable[$selectedsubject]["Code"], array("Music", "Arts", "PE", "Health"))) {
											$check = $oes->getData("Schedule", "*", "SectionID = '$section' AND Day = '".$day[$x]."' AND SubjectID IN (SELECT ID FROM Subject WHERE Code IN ('Music', 'Arts', 'PE', 'Health'))");
											$check2 = $oes->getData("Schedule", "*", "SectionID = '$section' AND Day IN ('M', 'T') AND SubjectID IN (SELECT ID FROM Subject WHERE Code = '".$subjectsavailable[$selectedsubject]["Code"]."')");
											if(sizeof($check) == 0 && sizeof($check) == 0) 
												$select = true;
										} elseif(in_array($subjectsavailable[$selectedsubject]["Code"], array("AP", "ESP", "CLE"))) {
											$check = $oes->getData("Schedule", "*", "SectionID = '$section' AND Day IN ('M', 'T') AND SubjectID IN (SELECT ID FROM Subject WHERE Code = '".$subjectsavailable[$selectedsubject]["Code"]."')");
											$check2 = $oes->getData("Schedule", "*", "SectionID = '$section' AND Day = '".$day[$x]."' AND SubjectID IN (SELECT ID FROM Subject WHERE Code IN ('AP', 'CLE', 'ESP'))");
											if(sizeof($check) == 0 && sizeof($check2) < 1) 
												$select = true; 
										}
									}
									if($oes->checkExpertiseAndSchedule($subjectsavailable[$selectedsubject]["ID"], $day[$x], $time[$timeline].':00', $time[$timeline+2].':00')) {
										mysql_query("INSERT INTO Schedule (SectionID, SubjectID, Day, StartTime, EndTime) VALUES ('$section', '".$subjectsavailable[$selectedsubject]["ID"]."', '".$day[$x]."', '".$time[$timeline].":00', '".$time[$timeline+2].":00')");
										if(in_array($subjectsavailable[$selectedsubject]["Code"], array("Music", "Arts", "PE", "Health"))) {
											$subjectpartner = $oes->getData("Subject", "*", "ID NOT IN (SELECT SubjectID FROM Schedule WHERE SectionID = '$section' AND Break IS NULL) AND Name NOT LIKE '%Elective' AND Units = '1'");
											$selectedsubject = rand(0, sizeof($subjectpartner)-1);
											mysql_query("INSERT INTO Schedule (SectionID, SubjectID, Day, StartTime, EndTime) VALUES ('$section', '".$subjectpartner[$selectedsubject]["ID"]."', '".$daypartner[$x]."', '".$time[$timeline].":00', '".$time[$timeline+=2].":00')");
										} else {
											mysql_query("INSERT INTO Schedule (SectionID, SubjectID, Day, StartTime, EndTime) VALUES ('$section', '".$subjectsavailable[$selectedsubject]["ID"]."', '".$daypartner[$x]."', '".$time[$timeline].":00', '".$time[$timeline+=2].":00')");
										}
									}
								}
							} else {
								while(!$select) {
									$selectedsubject = rand(0, sizeof($subjectsavailable)-1);
									if(in_array($subjectsavailable[$selectedsubject]["Code"], array("English", "Filipino", "Math", "Science"))) {
										$check = $oes->getData("Schedule", "*", "SectionID = '$section' AND Day = '".$day[$x]."' AND SubjectID IN (SELECT ID FROM Subject WHERE Code = '".$subjectsavailable[$selectedsubject]["Code"]."')");
										if(sizeof($check) == 0) 
											$select = true;
									} elseif(in_array($subjectsavailable[$selectedsubject]["Code"], array("Music", "Arts", "PE", "Health"))) {
										$check = $oes->getData("Schedule", "*", "SectionID = '$section' AND Day = '".$day[$x]."' AND SubjectID IN (SELECT ID FROM Subject WHERE Code IN ('Music', 'Arts', 'PE', 'Health'))");
										$check2 = $oes->getData("Schedule", "*", "SectionID = '$section' AND Day IN ('M', 'T') AND SubjectID IN (SELECT ID FROM Subject WHERE Code = '".$subjectsavailable[$selectedsubject]["Code"]."')");
										if(sizeof($check) == 0 && sizeof($check) == 0) 
											$select = true;
									} elseif(in_array($subjectsavailable[$selectedsubject]["Code"], array("AP", "ESP", "CLE"))) {
										$check = $oes->getData("Schedule", "*", "SectionID = '$section' AND Day IN ('M', 'T') AND SubjectID IN (SELECT ID FROM Subject WHERE Code = '".$subjectsavailable[$selectedsubject]["Code"]."')");
										$check2 = $oes->getData("Schedule", "*", "SectionID = '$section' AND Day = '".$day[$x]."' AND SubjectID IN (SELECT ID FROM Subject WHERE Code IN ('AP', 'CLE', 'ESP'))");
										if(sizeof($check) == 0 && sizeof($check2) < 1) 
											$select = true; 
									} elseif($subjectsavailable[$selectedsubject]["Code"] == "TLE") {
										$select = true;
									}
								}
								if($subjectsavailable[$selectedsubject]["Code"] == "TLE") {
									mysql_query("INSERT INTO Schedule (SectionID, SubjectID, Day, StartTime, EndTime) VALUES ('$section', (SELECT ID FROM Subject WHERE Code = 'TLE'), '".$day[$x]."', '".$time[$timeline].":00', '".$time[$timeline+3].":00')");
									mysql_query("INSERT INTO Schedule (SectionID, SubjectID, Day, StartTime, EndTime) VALUES ('$section', (SELECT ID FROM Subject WHERE Code = 'TLE'), '".$daypartner[$x]."', '".$time[$timeline].":00', '".$time[$timeline+=3].":00')");	
								} elseif($oes->checkExpertiseAndSchedule($subjectsavailable[$selectedsubject]["ID"], $day[$x], $time[$timeline].':00', $time[$timeline+2].':00')) {
									mysql_query("INSERT INTO Schedule (SectionID, SubjectID, Day, StartTime, EndTime) VALUES ('$section', '".$subjectsavailable[$selectedsubject]["ID"]."', '".$day[$x]."', '".$time[$timeline].":00', '".$time[$timeline+2].":00')");
									if(in_array($subjectsavailable[$selectedsubject]["Code"], array("Music", "Arts", "PE", "Health"))) {
										$subjectpartner = $oes->getData("Subject", "*", "ID NOT IN (SELECT SubjectID FROM Schedule WHERE SectionID = '$section' AND Break IS NULL) AND Name NOT LIKE '%Elective' AND Units = '1'");
										$selectedsubject = rand(0, sizeof($subjectpartner)-1);
										mysql_query("INSERT INTO Schedule (SectionID, SubjectID, Day, StartTime, EndTime) VALUES ('$section', '".$subjectpartner[$selectedsubject]["ID"]."', '".$daypartner[$x]."', '".$time[$timeline].":00', '".$time[$timeline+=2].":00')");
									} else {
										mysql_query("INSERT INTO Schedule (SectionID, SubjectID, Day, StartTime, EndTime) VALUES ('$section', '".$subjectsavailable[$selectedsubject]["ID"]."', '".$daypartner[$x]."', '".$time[$timeline].":00', '".$time[$timeline+=2].":00')");
									}
								}
							}
						} elseif($key == "Homeroom" || $key == "Recess") {
							mysql_query("INSERT INTO Schedule (SectionID, Break, Day, StartTime, EndTime) VALUES ('$section', '$key', '".$day[$x]."', '".$time[$timeline].":00', '".$time[$timeline+1].":00')");
							mysql_query("INSERT INTO Schedule (SectionID, Break, Day, StartTime, EndTime) VALUES ('$section', '$key', '".$daypartner[$x]."', '".$time[$timeline].":00', '".$time[$timeline+=1].":00')");
						} elseif($key == "Lunch") {
							mysql_query("INSERT INTO Schedule (SectionID, Break, Day, StartTime, EndTime) VALUES ('$section', '$key', '".$day[$x]."', '".$time[$timeline].":00', '".$time[$timeline+2].":00')");
							mysql_query("INSERT INTO Schedule (SectionID, Break, Day, StartTime, EndTime) VALUES ('$section', '$key', '".$daypartner[$x]."', '".$time[$timeline].":00', '".$time[$timeline+=2].":00')");
						} elseif($key == "TLE") {
							if($oes->checkExpertiseAndSchedule($oes->getSingleData("Subject", "ID", "Code = 'TLE'"), $day[$x], $time[$timeline].':00', $time[$timeline+2].':00')) {
								mysql_query("INSERT INTO Schedule (SectionID, SubjectID, Day, StartTime, EndTime) VALUES ('$section', (SELECT ID FROM Subject WHERE Code = '$key'), '".$day[$x]."', '".$time[$timeline].":00', '".$time[$timeline+3].":00')");
								mysql_query("INSERT INTO Schedule (SectionID, SubjectID, Day, StartTime, EndTime) VALUES ('$section', (SELECT ID FROM Subject WHERE Code = '$key'), '".$daypartner[$x]."', '".$time[$timeline].":00', '".$time[$timeline+=3].":00')");
							}
						}
					}
					$rand1 = 0;
				}
				$x++;
			}

			// FRIDAY
			$timeline = 0;
			for($i = 0; $i < sizeof($patterns[2]); $i++) {
				$key = $patterns[2][$i];
				if($key == "Subject") {
					$subjectsavailable = $oes->getData("Subject", "*", "ID NOT IN (SELECT SubjectID FROM Schedule WHERE Day = 'F' AND SectionID = '$section' AND Break IS NULL) AND (Name LIKE '%Elective' OR Code IN ('AP', 'TLE'))");
					$selectedsubject = rand(0, sizeof($subjectsavailable)-1);
					if($oes->checkExpertiseAndSchedule($subjectsavailable[$selectedsubject]["ID"], 'F', $time[$timeline].':00', $time[$timeline+2].':00')) {
						mysql_query("INSERT INTO Schedule (SectionID, SubjectID, Day, StartTime, EndTime) VALUES ('$section', '".$subjectsavailable[$selectedsubject]["ID"]."', 'F', '".$time[$timeline].":00', '".$time[$timeline+=2].":00')");
					} else {
						$i--;
					}
				} elseif($key == "Recess") {
					mysql_query("INSERT INTO Schedule (SectionID, Break, Day, StartTime, EndTime) VALUES ('$section', '$key', 'F', '".$time[$timeline].":00', '".$time[$timeline+=1].":00')");
				} elseif($key == "Lunch" || $key == "Homeroom") {
					mysql_query("INSERT INTO Schedule (SectionID, Break, Day, StartTime, EndTime) VALUES ('$section', '$key', 'F', '".$time[$timeline].":00', '".$time[$timeline+=2].":00')");
				} elseif($key == "Club Meetings") {
					mysql_query("INSERT INTO Schedule (SectionID, Break, Day, StartTime, EndTime) VALUES ('$section', '$key', 'F', '".$time[$timeline].":00', '".$time[$timeline+=3].":00')");
				}
			}

			$students = $oes->getData("Account INNER JOIN Student", "*", "Account.ID = Student.ID AND Account.Type = 'Student' AND Account.Status = 'Active' AND GLS = '$section'");
			foreach($students as $s) {
				$oes->addFeed($s["ID"], "Schedule", "You have a new schedule. Check your new schedule in the Schedule module.");
			}
		}
	} elseif($action == "auto_generate_schedule_to_faculty") {
		//mysql_query("UPDATE Schedule SET FacultyID = NULL");
		$query = mysql_query("SELECT DISTINCT SubjectID FROM Schedule WHERE Break IS NULL ORDER BY SubjectID");
		while($row = mysql_fetch_array($query)) {
			$simultaneous = 0;
			$subject = $row["SubjectID"];
			$faculty = $oes->getData("Expertise", "*", "SubjectID = '$subject'");
			$query2 = mysql_query("SELECT DISTINCT SectionID FROM Schedule WHERE SubjectID = '$subject'");
			while($row2 = mysql_fetch_array($query2)) {
				$section = $row2["SectionID"];
				$query3 = $oes->getData("Schedule", "*", "SectionID = '$section' AND SubjectID = '$subject'");
				foreach($query3 as $row3) {
					$daycheck = $row3["Day"];
					$stcheck = $row3["StartTime"];
					$etcheck = $row3["EndTime"];
					$x = $oes->getData("Schedule", "*", "SubjectID = '$subject' AND Day = '$daycheck' AND (('$stcheck' >= StartTime AND '$stcheck' < EndTime) OR ('$etcheck' > StartTime AND '$etcheck' <= EndTime))");
					if($simultaneous <= sizeof($x)) {
						$simultaneous = sizeof($x);
					}
				}
			}
			$query2 = $oes->getData("Expertise", "*", "SubjectID = '$subject'");
			if($simultaneous <= sizeof($query2)) {
				$days = array("M", "T", "W", "H", "F");
				$schedules = array();
				foreach($days as $day) {
					$query3 = $oes->getData("Schedule", "*", "Day = '$day' AND SubjectID = '$subject' ORDER BY StartTime ASC");
					foreach($query3 as $row3)
						array_push($schedules, $row3);
				}
				foreach($schedules as $s) {
					$select = false;
					$id = $s["ID"];
					$faculty = $s["FacultyID"];
					$section = $s["SectionID"];
					$starttime = $s["StartTime"];
					$endtime = $s["EndTime"];
					$day = $s["Day"];
					if($faculty == "") {
						$prevfaculty = array();
						$okay = false;
						$error = false;
						while(!$okay) {
							$selectedfaculty = "";
							$tempload = 24;
							foreach($query2 as $faculty) {
								if($oes->getTotalLoad($faculty["FacultyID"]) < $tempload && !in_array($faculty["FacultyID"], $prevfaculty)) {
									$tempload = $oes->getTotalLoad($faculty["FacultyID"]);
									$selectedfaculty = $faculty["FacultyID"];
								}
							}
							$intersect = $oes->getData("Schedule", "*", "FacultyID = '".$selectedfaculty."' AND Day = '$day' AND (('$starttime' >= StartTime AND '$starttime' < EndTime) OR ('$endtime' > StartTime AND '$endtime' <= EndTime))");
							$currentLoad = $oes->getTotalLoad($selectedfaculty);
							if(sizeof($intersect) == 0 && $currentLoad + $oes->getSingleData("Subject", "Units", "ID = '$subject'") <= 24) {
								$okay = true;
								$check = $oes->getData("Feed", "*", "AccountID = '".$selectedfaculty."' AND DatePosted = '".date("Y-m-d")."'");
								if($check == 0)
									$oes->addFeed($selectedfaculty, "Schedule", "You have a new schedule. Check your new schedule in the Schedule module.");
								mysql_query("UPDATE Schedule SET FacultyID = '".$selectedfaculty."' WHERE SubjectID = '$subject' AND SectionID = '$section'");
							} else {
								$prevfaculty[] = $selectedfaculty;
								if(sizeof($query2) == sizeof($prevfaculty)) {
									$error = true;
									break;
								}
							}
						}
						if($error) {
							showSnackbarMsg("Not enough faculty for ".$oes->getSingleData("Subject", "Name", "ID = '$subject'"));
						}
					}	
				}
			} else {
				showSnackbarMsg("Not enough faculty for ".$oes->getSingleData("Subject", "Name", "ID = '$subject'"));
				break;
			}
		}
	} elseif($action == "checkenroll") {
		if(isset($_POST['gradelevel'])) {
			$gl = $_POST['gradelevel'];
			$totalStudents = sizeof($oes->getData("Student INNER JOIN Account", "*", "Student.ID = Account.ID AND Account.Type IN ('Student', 'Enrollee') AND GradeLevel = '$gl' AND Account.Status = 'Active'"));
			$totalSectionsNeeded = ceil(($totalStudents+1)/40);
			$totalCurrentSections = sizeof($oes->getData("GLS", "*", "GradeLevel = '$i' AND ID IN (SELECT GLS FROM Student)"));
			$totalSectionsToCreate = $totalSectionsNeeded - $totalCurrentSections;
			$totalRooms = sizeof($oes->getData("Room", "*", ""));
			if($totalCurrentSections + $totalSectionsToCreate <= $totalRooms) {
			?>
			<script>$("#frmApplication table.form-container tr:not(.nohide)").show();</script>
			<?php
			} else {
				showSnackbarMsg("Grade level is full.");
			}
																						
		}
	} elseif($action == "listexamdate") {
		$check = $oes->getData("Account INNER JOIN Student INNER JOIN Enrollee", "*", "Account.ID = Student.ID AND Account.ID = Enrollee.ID AND Account.Type = 'Enrollee' AND Student.GradeLevel = '7' AND Enrollee.EnrollmentStatus = 'Pending' AND Account.Status = 'Active' AND Enrollee.AdmissionID = '0'");
		if(sizeof($check) > 0) {
	?>
	<div class="card">
		<h4><span class="flat_icon ic_warning"></span>Warning</h4>
		<p><?php echo $num = sizeof($check); echo ($num == 1 ? ' enrollee' : ' enrollees'); ?> doesn't have an admission date set. To fix this, add admission dates or increase the number of examinees per date/time.</p>
		<ul class="button-container right">
			<li><a onclick="showDialogBox('auto_assign_edate_to_enrollee')" class="raised_button">Auto Assign</a></li>
		</ul>
	</div>
	<?php
		}
	?>
	<div class="card">
		<a onclick="showBottomSheet('exam_settings');" class="float_button pos_top_right ic_settings_white icon_medium"></a>
		<h4>Exam Schedule</h4>
		<table class="list" id="tableListExam">
			<?php
			$dates = $oes->getData("Admission", "*", "Entrance = 'Exam'");
			if(!empty($dates)) {
				foreach($dates as $data) {
					$num = $oes->getNum("Account INNER JOIN Enrollee", "Account.ID = Enrollee.ID AND Account.Type = 'Enrollee' AND Account.Status = 'Active' AND AdmissionID = '".$data["ID"]."'");
				?>
				<tr>
					<td class="hide"></td>
					<td class="primary"><?php echo date("F d, Y - g:i A", strtotime($data["ScheduleDate"].' '.$data["ScheduleTime"])); ?> (<?php echo $num; ?>)</td>
					<td>
						<ul class="button-container">
							<li>
								<a id="btnEdit_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_pencil showhover"></a>
								<a id="btnDelete_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
							</li>
						</ul>
					</td>
				</tr>
				<script>
				$(document).ready(function() {
					$("#tableListExam #btnEdit_<?php echo $data["ID"]; ?>").click(function() {
						showBottomSheet('editexamschedule', '<?php echo $data["ID"]; ?>');
					});
					$("#tableListExam #btnDelete_<?php echo $data["ID"]; ?>").click(function() {
						showDialogBox('deleteexamschedule', '<?php echo $data["ID"]; ?>');
					});
				})
				</script>
				<?php
				}
			} else {
			?>
			<tr>
				<td><i><small><center>There are no dates for examination.</center></small></i></td>
			</tr>
			<?php
			}
			?>
		</table>
		<ul class="button-container right">
			<li><a onclick="showBottomSheet('addexamschedule');" class="raised_button">Add Date</a></li>
		</ul>
	</div>
	<?php
	} elseif($action == "listinterviewdate") {
		$check = $oes->getData("Account INNER JOIN Student INNER JOIN Enrollee", "*", "Account.ID = Student.ID AND Account.ID = Enrollee.ID AND Account.Type = 'Enrollee' AND Student.GradeLevel != '7' AND Enrollee.EnrollmentStatus = 'Pending' AND Account.Status = 'Active' AND Enrollee.AdmissionID = '0'");
		if(sizeof($check) > 0) {
	?>
	<div class="card">
		<h4><span class="flat_icon ic_warning"></span>Warning</h4>
		<p><?php echo $num = sizeof($check); echo ($num == 1 ? ' enrollee' : ' enrollees'); ?> doesn't have an admission date set. To fix this, add admission dates or increase the number of interviewees per date/time.</p>
		<ul class="button-container right">
			<li><a onclick="showDialogBox('auto_assign_idate_to_enrollee')" class="raised_button">Auto Assign</a></li>
		</ul>
	</div>
	<?php
		}
	?>
	<div class="card">
		<a onclick="showBottomSheet('interview_settings');" class="float_button pos_top_right ic_settings_white icon_medium"></a>
		<h4>Interview Schedule</h4>
		<table class="list" id="tableListInterview">
			<?php
			$dates = $oes->getData("Admission", "*", "Entrance = 'Interview'");
			if(!empty($dates)) {
				foreach($dates as $data) {
					$num = $oes->getNum("Account INNER JOIN Enrollee", "Account.ID = Enrollee.ID AND Account.Type = 'Enrollee' AND Account.Status = 'Active' AND AdmissionID = '".$data["ID"]."'");
				?>
				<tr>
					<td class="hide"></td>
					<td class="primary"><?php echo date("F d, Y - g:i A", strtotime($data["ScheduleDate"].' '.$data["ScheduleTime"])); ?> (<?php echo $num; ?>)</td>
					<td>
						<ul class="button-container">
							<li>
								<a id="btnEdit_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_pencil showhover"></a>
								<a id="btnDelete_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
							</li>
						</ul>
					</td>
				</tr>
				<script>
				$(document).ready(function() {
					$("#tableListInterview #btnEdit_<?php echo $data["ID"]; ?>").click(function() {
						showBottomSheet('editinterviewschedule', '<?php echo $data["ID"]; ?>');
					});
					$("#tableListInterview #btnDelete_<?php echo $data["ID"]; ?>").click(function() {
						showDialogBox('deleteinterviewschedule', '<?php echo $data["ID"]; ?>');
					});
				})
				</script>
				<?php
				}
			} else {
			?>
			<tr>
				<td><i><small><center>There are no dates for interview.</center></small></i></td>
			</tr>
			<?php
			}
			?>
		</table>
		<ul class="button-container right">
			<li><a onclick="showBottomSheet('addinterviewschedule');" class="raised_button">Add Date</a></li>
		</ul>
	</div>
	<?php
	} elseif($action == "editexamsettings") {
		if(isset($_POST['max'])) {
			$max = $_POST['max'];
			if(is_numeric($max)) {
				if($max > 0) {
					$sy = $oes->getSchoolYear();
					mysql_query("UPDATE Administration SET MaxExaminees = '$max' WHERE SchoolYear = '$sy'");
					hideElements();
				} else {
					showSnackbarMsg("Maximum examinees should be more than 0");
				}
			} else {
				showSnackbarMsg("Invalid input");
			}
		} else {
			showSnackbarMsg("Invalid input");
		}
	} elseif($action == "editinterviewsettings") {
		if(isset($_POST['max'])) {
			$max = $_POST['max'];
			if(is_numeric($max)) {
				if($max > 0) {
					$sy = $oes->getSchoolYear();
					mysql_query("UPDATE Administration SET MaxInterviewees = '$max' WHERE SchoolYear = '$sy'");
					hideElements();
				} else {
					showSnackbarMsg("Maximum interviewees should be more than 0");
				}
			} else {
				showSnackbarMsg("Invalid input");
			}
		} else {
			showSnackbarMsg("Invalid input");
		}
	} elseif($action == "addexamschedule") {
		if(isset($_POST['examdate'], $_POST['examtime'])) {
			$examdate = $_POST['examdate'];
			$examtime = $_POST['examtime'];
			$check = $oes->getData("Admission", "*", "Entrance = 'Exam' AND ScheduleDate = '$examdate' AND ScheduleTime = '$examtime'");
			if(empty($check)) {
				mysql_query("INSERT INTO Admission (Entrance, ScheduleDate, ScheduleTime) VALUES ('Exam', '$examdate', '$examtime')");
				hideElements();
			} else {
				showSnackbarMsg("Schedule already exists");
			}
		} else {
			showSnackbarMsg("Invalid input");
		}
	} elseif($action == "editexamschedule") {
		if(isset($_POST['id'], $_POST['examdate'], $_POST['examtime'])) {
			$id = $_POST['id'];
			$examdate = $_POST['examdate'];
			$examtime = $_POST['examtime'];
			$check = $oes->getData("Admission", "*", "ID != '$id' AND Entrance = 'Exam' AND ScheduleDate = '$examdate' AND ScheduleTime = '$examtime'");
			if(empty($check)) {
				mysql_query("UPDATE Admission SET ScheduleDate = '$examdate', ScheduleTime = '$examtime' WHERE ID = '$id'");
				hideElements();
			} else {
				showSnackbarMsg("Schedule already exists");
			}
		} else {
			showSnackbarMsg("Invalid input");
		}
	} elseif($action == "deleteexamschedule") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			mysql_query("DELETE FROM Admission WHERE ID = '$id'");
			mysql_query("UPDATE Enrollee SET AdmissionID = '0' WHERE AdmissionID = '$id'");
			showSnackbar("delete_success");
		}
	} elseif($action == "addinterviewschedule") {
		if(isset($_POST['interviewdate'], $_POST['interviewtime'])) {
			$interviewdate = $_POST['interviewdate'];
			$interviewtime = $_POST['interviewtime'];
			$check = $oes->getData("Admission", "*", "Entrance = 'Interview' AND ScheduleDate = '$interviewdate' AND ScheduleTime = '$interviewtime'");
			if(empty($check)) {
				mysql_query("INSERT INTO Admission (Entrance, ScheduleDate, ScheduleTime) VALUES ('Interview', '$interviewdate', '$interviewtime')");
				hideElements();
			} else {
				showSnackbarMsg("Schedule already exists");
			}
		} else {
			showSnackbarMsg("Invalid input");
		}
	} elseif($action == "editinterviewschedule") {
		if(isset($_POST['id'], $_POST['interviewdate'], $_POST['interviewtime'])) {
			$id = $_POST['id'];
			$interviewdate = $_POST['interviewdate'];
			$interviewtime = $_POST['interviewtime'];
			$check = $oes->getData("Admission", "*", "ID != '$id' AND Entrance = 'Interview' AND ScheduleDate = '$interviewdate' AND ScheduleTime = '$interviewtime'");
			if(empty($check)) {
				mysql_query("UPDATE Admission SET ScheduleDate = '$interviewdate', ScheduleTime = '$interviewtime' WHERE ID = '$id'");
				hideElements();
			} else {
				showSnackbarMsg("Schedule already exists");
			}
		} else {
			showSnackbarMsg("Invalid input");
		}
	} elseif($action == "deleteinterviewschedule") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			mysql_query("DELETE FROM Admission WHERE ID = '$id'");
			mysql_query("UPDATE Enrollee SET AdmissionID = '0' WHERE AdmissionID = '$id'");
			showSnackbar("delete_success");
		}
	} elseif($action == "viewstudent_info") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$studentInfo = $oes->getRow("Student INNER JOIN Account", "*", "Account.ID = Student.ID AND Account.ID = '$id'");
			?>
			<div class="card" id="frmApplication">
				<table class="form-container">
					<tr>
						<td colspan="2">
							<h4>Student Name</h4>
						</td>
					</tr>
					<tr>
						<td width="50%">
							<label>First Name</label>
							<input type="text" name="firstname" value="<?php echo $studentInfo["FirstName"]; ?>">
						</td>
						<td>
							<label>Middle Name</label>
							<input type="text" name="middlename" value="<?php echo $studentInfo["MiddleName"]; ?>">
						</td>
					</tr>
					<tr>
						<td>
							<label>Last Name</label>
							<input type="text" name="lastname" value="<?php echo $studentInfo["LastName"]; ?>">
						</td>
						<td>
							<label>Auxiliary Name</label>
							<select name="auxname">
								<?php
								$options = array("", "Jr", "Sr", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X");
								foreach($options as $option) {
									$selected = "";
									if($option == $studentInfo["AuxiliaryName"])
										$selected = " selected";
									echo '<option value="'.$option.'"'.$selected.'>'.$option.'</option>';
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<h4>Basic Information</h4>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Gender</label>
							<select name="gender">
								<?php
								$options = array("Male", "Female");
								foreach($options as $option) {
									$selected = "";
									if($option == $studentInfo["Gender"])
										$selected = " selected";
									echo '<option value="'.$option.'"'.$selected.'>'.$option.'</option>';
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<label>Birth Date</label>
							<input type="date" name="birthdate" value="<?php echo $studentInfo["BirthDate"]; ?>">
						</td>
						<td>
							<label>Birth Place</label>
							<input type="text" name="birthplace" value="<?php echo $studentInfo["BirthPlace"]; ?>">
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Religion</label>
							<select name="religion">
								<?php
								$options = array("Roman Catholic", "Aglipanayan", "Baptist", "Buddhism", "Christian", "Evangelical", "Hinduism", "Iglesia ni Cristo", "Islam", "Jehova's Witness", "Judaism", "Lutheran", "Methodist", "Other", "Pentecostal", "Seventh-Day Adventist");
								foreach($options as $option) {
									$selected = "";
									if($option == $studentInfo["Religion"])
										$selected = " selected";
									echo '<option value="'.$option.'"'.$selected.'>'.$option.'</option>';
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Civil Status</label>
							<select name="status">
								<?php
								$options = array("Single", "Married", "Widow");
								foreach($options as $option) {
									$selected = "";
									if($option == $studentInfo["CivilStatus"])
										$selected = " selected";
									echo '<option value="'.$option.'"'.$selected.'>'.$option.'</option>';
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Citizenship</label>
							<select name="citizenship">
								<?php
								$options = array("Filipino", "Other");
								foreach($options as $option) {
									$selected = "";
									if($option == $studentInfo["Citizenship"])
										$selected = " selected";
									echo '<option value="'.$option.'"'.$selected.'>'.$option.'</option>';
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<h4>Address & Contact Information</h4>
						</td>
					</tr>
					<tr>
						<td>
							<label>No./Street/Brgy.</label>
							<input type="text" name="nostreetbrgy" value="<?php echo $studentInfo["NoStreetBrgy"]; ?>">
						</td>
						<td>
							<label>City/Municipality</label>
							<input type="text" name="city" value="<?php echo $studentInfo["CityMunicipality"]; ?>">
						</td>
					</tr>
					<tr>
						<td>
							<label>Province/State</label>
							<input type="text" name="province" value="<?php echo $studentInfo["ProvinceState"]; ?>">
						</td>
						<td>
							<label>Country</label>
							<select name="country">
								<?php
								$options = array("Afganistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antigua &amp; Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bonaire", "Bosnia &amp; Herzegovina", "Botswana", "Brazil", "British Indian Ocean Ter", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Canary Islands", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Channel Islands", "Chile", "China", "Christmas Island", "Cocos Island", "Colombia", "Comoros", "Congo", "Cook Islands", "Costa Rica", "Cote DIvoire", "Croatia", "Cuba", "Curaco", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands", "Faroe Islands", "Fiji", "Finland", "France", "French Guiana", "French Polynesia", "French Southern Ter", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Great Britain", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guyana", "Haiti", "Hawaii", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "North Korea", "South Korea", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia", "Madagascar", "Malaysia", "Malawi", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Midway Islands", "Moldova", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Nambia", "Nauru", "Nepal", "Netherland Antilles", "Netherlands", "Nevis", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Norway", "Oman", "Pakistan", "Palau Island", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Phillipines", "Pitcairn Island", "Poland", "Portugal", "Puerto Rico", "Qatar", "Republic of Montenegro", "Republic of Serbia", "Reunion", "Romania", "Russia", "Rwanda", "St Barthelemy", "St Eustatius", "St Helena", "St Kitts-Nevis", "St Lucia", "St Maarten", "St Pierre &amp; Miquelon", "St Vincent &amp; Grenadines", "Saipan", "Samoa", "Samoa American", "San Marino", "Sao Tome &amp; Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "Spain", "Sri Lanka", "Sudan", "Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Tahiti", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad &amp; Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks &amp; Caicos Is", "Tuvalu", "Uganda", "Ukraine", "United Arab Erimates", "United Kingdom", "United States of America", "Uraguay", "Uzbekistan", "Vanuatu", "Vatican City State", "Venezuela", "Vietnam", "Virgin Islands (Brit)", "Virgin Islands (USA)", "Wake Island", "Wallis &amp; Futana Is", "Yemen", "Zaire", "Zambia", "Zimbabwe");
								foreach($options as $option) {
									$selected = "";
									if($option == $studentInfo["Country"])
										$selected = " selected";
									echo '<option value="'.$option.'"'.$selected.'>'.$option.'</option>';
								}
								?>
								<
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Zip Code</label>
							<input type="text" name="zipcode" value="<?php echo $studentInfo["ZipCode"]; ?>">
						</td>
					</tr>
					<tr>
						<td>
							<label>Email Address</label>
							<input type="text" name="email" value="<?php echo $studentInfo["Email"]; ?>">
						</td>
						<td>
							<label>Landline/Mobile No.</label>
							<input type="text" name="mobileno" value="<?php echo $studentInfo["MobileNo"]; ?>">
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<h4>Parents Information</h4>
						</td>
					</tr>
					<tr>
						<td>
							<label>Father's Name</label>
							<input type="text" name="fname" value="<?php echo $studentInfo["F_FullName"]; ?>">
						</td>
						<td>
							<label>Father's Occupation</label>
							<input type="text" name="foccupation" value="<?php echo $studentInfo["F_Occupation"]; ?>">
						</td>
					</tr>
					<tr>
						<td>
							<label>Mother's Name</label>
							<input type="text" name="mname" value="<?php echo $studentInfo["M_FullName"]; ?>">
						</td>
						<td>
							<label>Mother's Occupation</label>
							<input type="text" name="moccupation" value="<?php echo $studentInfo["M_Occupation"]; ?>">
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<h4>Guardian Information</h4>
						</td>
					</tr>
					<tr>
						<td>
							<label>Guardian's Name</label>
							<input type="text" name="gname" value="<?php echo $studentInfo["G_FullName"]; ?>">
						</td>
						<td>
							<label>Relationship</label>
							<select name="relationship">
								<?php
								$options = array("Other", "Father", "Mother");
								foreach($options as $option) {
									$selected = "";
									if($option == $studentInfo["G_Relationship"])
										$selected = " selected";
									echo '<option value="'.$option.'"'.$selected.'>'.$option.'</option>';
								}
								?>
							</select>
						</td>
					</tr>
					<tr valign="top">
						<td>
							<label>Guardian's Address</label>
							<input type="text" name="gaddress" value="<?php echo $studentInfo["G_Address"]; ?>"<?php if($studentInfo["G_Address"] == $studentInfo["NoStreetBrgy"].", ".$studentInfo["CityMunicipality"].", ".$studentInfo["ProvinceState"].", ".$studentInfo["Country"]) echo ' disabled'; ?>>
							<label><input type="checkbox" name="sameaddress"<?php if($studentInfo["G_Address"] == $studentInfo["NoStreetBrgy"].", ".$studentInfo["CityMunicipality"].", ".$studentInfo["ProvinceState"].", ".$studentInfo["Country"]) echo ' checked'; ?>><span></span>Use same address</label>
						</td>
						<td>
							<label>Landline/Mobile No.</label>
							<input type="text" name="gmobileno" value="<?php echo $studentInfo["G_MobileNo"]; ?>">
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<h4>Educational Information</h4>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Grade School</label>
							<select name="gradeschool">
							</select>
						</td>
					</tr>
					<script>
					function showNameOfSchool() {
						$val = $("#frmApplication select[name=gradeschool]").val();
						if($val == "Other" && $("#frmApplication select[name=gradelevel]").val() != "0") 
							$("#frmApplication #row_nameofschool").show();
						else
							$("#frmApplication #row_nameofschool").hide();
					}
					$(document).ready(function() {
						$.ajax({
							type: "post",
							cache: true,
							url: "process.php?action=getgradeschool",
							data: {equal: '<?php echo $studentInfo["GradeSchool"]; ?>'},
							success: function(html) {
								$("#frmApplication select[name=gradeschool]").html(html);
								showNameOfSchool();
							}
						});
						$("#frmApplication select[name=gradeschool").change(function() {
							showNameOfSchool();
						});
					})
					</script>
					<tr id="row_nameofschool">
						<td colspan="2">
							<label>Name of School</label>
							<input type="text" name="namegradeschool">
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Address</label>
							<input type="text" name="gsaddress" value="<?php echo $studentInfo["Address"]; ?>">
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Year Graduated</label>
							<select name="yeargraduate">
							<?php
							for($i = 2016; $i >= 1900; $i--) {
								$selected = "";
								if($i == $studentInfo["YearGraduate"])
									$selected = " selected";
								echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
							}
							?>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<ul class="button-container block center">
								<li><a id="btnSave" class="raised_button large_button">Save</a></li>
							</ul>
							<center><div class="loading" style="display: none;"></div></center>
						</td>
					</tr>
				</table>
				<script>
				$(document).ready(function() {
					$("input[type=text]:not([name=namegradeschool]):not([name=gaddress]), input[type=date]").focusout(function() {
						if($(this).val() == "") {
							$(this).css({
								"border-bottom": "1px solid red"
							});
						} else {
							$(this).css({
								"border-bottom": "1px solid #ccc"
							});
						}
					});
					$("#frmApplication input[name=fname]").change(function() {
						if($("#frmApplication select[name=relationship]").val() == "Father") {
							$("#frmApplication input[name=gname]").val($("#frmApplication input[name=fname]").val())
						}
					});
					$("#frmApplication input[name=mname]").change(function() {
						if($("#frmApplication select[name=relationship]").val() == "Mother") {
							$("#frmApplication input[name=gname]").val($("#frmApplication input[name=mname]").val())
						}
					});
					$("#frmApplication input[name=gname]").change(function() {
						if($("#frmApplication select[name=relationship]").val() == "Mother") {
							$("#frmApplication input[name=gname]").val($("#frmApplication input[name=mname]").val())
						}
					});
					$("#frmApplication select[name=relationship]").change(function() {
						if($(this).val() == "Father") {
							$("#frmApplication input[name=gname]").val($("#frmApplication input[name=fname]").val()).prop("disabled", true).css({
								"border-bottom": "1px solid #ccc"
							});
						} else if($(this).val() == "Mother") {
							$("#frmApplication input[name=gname]").val($("#frmApplication input[name=mname]").val()).prop("disabled", true).css({
								"border-bottom": "1px solid #ccc"
							});
						} else {
							$("#frmApplication input[name=gname]").prop("disabled", false);
						}
					});
					$("#frmApplication input[name=gaddress]").focusout(function() {
						if(!$("#frmApplication input[name=sameaddress]").is(":checked") && $(this).val() == "") {
							$(this).css({
								"border-bottom": "1px solid red"
							});
						} else {
							$(this).css({
								"border-bottom": "1px solid #ccc"
							});
						}
					});
					$("#frmApplication input[name=sameaddress]").change(function() {
						if(this.checked) {
							$("#frmApplication input[name=gaddress]").prop("disabled", true).val("").css({
								"border-bottom": "1px solid #ccc"
							});
						} else {
							$("#frmApplication input[name=gaddress]").prop("disabled", false);
						}
					});
					$("#frmApplication input[name=namegradeschool]").focusout(function() {
						if($("#frmApplication select[name=gradeschool]").val() == "Other" && $(this).val() == "") {
							$(this).css({
								"border-bottom": "1px solid red"
							});
						} else {
							$(this).css({
								"border-bottom": "1px solid #ccc"
							});
						}
					})
					$("#frmApplication #btnSave").click(function() {
						$firstname = $("#frmApplication input[name=firstname]").val();
						$middlename = $("#frmApplication input[name=middlename]").val();
						$lastname = $("#frmApplication input[name=lastname]").val();
						$auxname = $("#frmApplication select[name=auxname]").val();
						$gender = $("#frmApplication select[name=gender]").val();
						$birthdate = $("#frmApplication input[name=birthdate]").val();
						$birthplace = $("#frmApplication input[name=birthplace]").val();
						$religion = $("#frmApplication select[name=religion]").val();
						$status = $("#frmApplication select[name=status]").val();
						$citizenship = $("#frmApplication select[name=citizenship]").val();
						$nostreetbrgy = $("#frmApplication input[name=nostreetbrgy]").val();
						$city = $("#frmApplication input[name=city]").val();
						$province = $("#frmApplication input[name=province]").val();
						$country = $("#frmApplication select[name=country]").val();
						$zipcode = $("#frmApplication input[name=zipcode]").val();
						$email = $("#frmApplication input[name=email]").val();
						$mobileno = $("#frmApplication input[name=mobileno]").val();
						$fname = $("#frmApplication input[name=fname]").val();
						$foccupation = $("#frmApplication input[name=foccupation]").val();
						$mname = $("#frmApplication input[name=mname]").val();
						$moccupation = $("#frmApplication input[name=moccupation]").val();
						$gname = $("#frmApplication input[name=gname]").val();
						$relationship = $("#frmApplication select[name=relationship]").val();
						$gaddress = $("#frmApplication input[name=gaddress]").val();
						$gmobileno = $("#frmApplication input[name=gmobileno]").val();
						$gradeschool = $("#frmApplication select[name=gradeschool]").val();
						$namegradeschool = $("#frmApplication input[name=namegradeschool]").val();
						$gsaddress = $("#frmApplication input[name=gsaddress]").val();
						$yeargraduate = $("#frmApplication select[name=yeargraduate]").val();
						$sameaddress = $("#frmApplication input[name=sameaddress]");
						$complete = true;
						$("input[type=text]:not([name=namegradeschool]):not([name=gaddress]), input[type=date]").each(function() {
							if($(this).val() == "") {
								$(this).css({
									"border-bottom": "1px solid red"
								});
								$complete = false;
							} else {
								$(this).css({
									"border-bottom": "1px solid #ccc"
								});
							}
						});
						if(!$("#frmApplication input[name=sameaddress]").is(":checked") && $gaddress == "") {
							$complete = false;
							$("#frmApplication input[name=gaddress]").css({
								"border-bottom": "1px solid red"
							});
						} else {
							$("#frmApplication input[name=gaddress]").css({
								"border-bottom": "1px solid #ccc"
							});
						}
						if($gradeschool == "Other" && $namegradeschool == "") {
							$complete = false;
							$("#frmApplication input[name=namegradeschool]").css({
								"border-bottom": "1px solid red"
							});
						} else {
							$("#frmApplication input[name=namegradeschool]").css({
								"border-bottom": "1px solid #ccc"
							});
						}
						if($complete) {
							$("#frmApplication .loading").show("slow");
							$("#frmApplication ul.button-container").hide();
							showSnackbarMsg("Processing...");
							$.ajax({
								type: "post",
								cache: false,
								url: "process.php?action=updatestudent_info",
								data: {id: '<?php echo $id; ?>', firstname: $firstname, middlename: $middlename, lastname: $lastname, auxname: $auxname, gender: $gender, birthdate: $birthdate, birthplace: $birthplace, religion: $religion, status: $status, citizenship: $citizenship, nostreetbrgy: $nostreetbrgy, city: $city, province: $province, country: $country, zipcode: $zipcode, email: $email, mobileno: $mobileno, fname: $fname, foccupation: $foccupation, mname: $mname, moccupation: $moccupation, gname: $gname, relationship: $relationship, gaddress: $gaddress, sameaddress: $sameaddress.is(":checked"), gmobileno: $gmobileno, gradeschool: $gradeschool, namegradeschool: $namegradeschool, gsaddress: $gsaddress, yeargraduate: $yeargraduate},
								success: function(html) {
									showSnackbarMsg("Saved.");
									$("#frmApplication .loading").hide();
									$("#frmApplication ul.button-container").show();
								}
							})
						}
					});
				});
				</script>
			</div>
			<?php
		}
	} elseif($action == "viewstudent_assessment") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$data = $oes->getRow("Assessment", "*", "ID = '$id'");
			if($data["PaymentTerm"] == "") {
	?>
			<div class="card">
				<h4><span class="flat_icon ic_warning"></span>Warning</h4>
				<p>This student doesn't have a payment term set.</p>
				<ul class="button-container right">
					<li><a onclick="showBottomSheet('setpaymentterm', '<?php echo $id; ?>');" class="raised_button">Set Payment Term</a></li>
				</ul>
			</div>
	<?php
			}
	?>
			<div class="card">
				<a onclick="showBottomSheet('setcreditcard', '<?php echo $id; ?>');" class="float_button pos_top_right ic_payment_white icon_medium"></a>
				<h4>Assessment for <?php echo $oes->getNameFormat("f l", $id); ?></h4>
				<?php
				$ptstr = $oes->getSingleData("PaymentTerm", "PaymentTerm", "ID = '".$data["PaymentTerm"]."'");
				if($data["PaymentTerm"] != "") {
				 echo '<p>Payment Term: '.$ptstr.'</p>';
				}
				?>
				<table class="list">
					<tr class="title">
						<td class="hide"></td>
						<td>Account</td>
						<td align="right">Fee</td>
					</tr>
					<?php
					$breakdown = array("Tuition Fee", "Laboratory Fee", "Miscellaneous Fee", "Other Fee");
					$total = 0;
					foreach($breakdown as $b) {
						$price = $data[str_replace(" ", "", $b)];
						$total += $price;
					?>
					<tr>
						<td class="hide"></td>
						<td><?php echo $b; ?></td>
						<td align="right">Php <?php echo number_format($price, 3, ".", ","); ?></td>
					</tr>
					<?php
					}
					?>
					<tr>
						<td class="hide"></td>
						<td><b>Sub-Total:</b></td>
						<td align="right">Php <?php echo number_format($total, 3, ".", ","); ?></td>
					</tr>
					<?php
					if($data["PaymentTerm"] != "") {
						if($data["InstallmentFee"] >= 0) {
					?>
					<tr>
						<td class="hide"></td>
						<td>Additional Fee</td>
						<td align="right">Php <?php echo number_format($data["InstallmentFee"], 3, ".", ","); ?></td>
					</tr>
					<?php
						} else {
					?>
					<tr>
						<td class="hide"></td>
						<td>Rebate</td>
						<td align="right">(Php <?php echo number_format(0-$data["InstallmentFee"], 3, ".", ","); ?>)</td>
					</tr>
					<?php
						}
					?>
					<tr>
						<td class="hide"></td>
						<td><b>TOTAL:</b></td>
						<td align="right">Php <?php echo number_format($total+$data["InstallmentFee"], 3, ".", ","); ?></td>
					</tr>
					<?php
					}
					?>
				</table>
			</div>
			<?php
			if($data["PaymentTerm"] != "") {
			?>
			<div class="card">
				<h4>Payment Status</h4>
				<table class="list">
					<?php
					$sy = $oes->getSchoolYear();
					if($ptstr == "Monthly Installment") 
						$months = array($sy."-08-01", $sy."-09-01", $sy."-10-01", $sy."-11-01", $sy."-12-01", ($sy+1)."-01-01", ($sy+1)."-02-01", ($sy+1)."-03-01", ($sy+1)."-04-01");
					elseif($ptstr == "Quarterly Installment") 
						$months = array($sy."-09-01", $sy."-12-01", ($sy+1)."-03-01");
					elseif($ptstr == "Semi-annually Installment")
						$months = array($sy."-12-01");
					?>
					<tr>
						<td width="1px">
						<?php 
						$paid = $oes->getData("Transaction", "*", "StudentID = '$id' AND ApplicableMonth = 'Upon Enrollment'");
						if(!empty($paid)) {
						?>
						<span class="flat_icon ic_done"></span>
						<?php
							$paybutton = false;
						}
						?>
						</td>
						<td>Upon Enrollment</td>
						<td align="right">Php <?php echo number_format($data["Installment"], 3); ?></td>
					</tr>
					<?php
					$paybutton = false;
					if($ptstr != "Full Payment") {
						foreach($months as $month) {
					?>
					<tr>
						<td width="1px">
						<?php 
						$paid = $oes->getData("Transaction", "*", "StudentID = '$id' AND ApplicableMonth = '$month'");
						if(!empty($paid)) {
						?>
						<span class="flat_icon ic_done"></span>
						<?php
						} else {
							$paybutton = true;
						}
						?>
						</td>
						<td><?php echo date("F Y", strtotime($month)); ?></td>
						<td align="right">Php <?php echo number_format($data["Installment"], 3); ?></td>
					</tr>
					<?php
						}
					}
					?>
				</table>
			</div>
				<?php
				$surcharges = $oes->getData("Surcharge", "*", "StudentID = '$id'");
				if(!empty($surcharges)) {
				?>
			<div class="card">
				<h4>Surcharges</h4>
				<table class="list">
					<tr class="title">
						<td class="hide"></td>
						<td>Date Charged</td>
						<td align="right">Amount</td>
					</tr>
				<?php
					foreach($surcharges as $s) {
				?>
				<tr>
					<td class="hide"></td>
					<td><?php echo date("F d, Y", strtotime($s["DateCharge"])); ?></td>
					<td align="right">Php <?php echo number_format($s["Amount"], 3, ".", ","); ?></td>
				</tr>
				<?php
					}
				?>
				</table>
			</div>
				<?php
				}
				?>
			<div class="card">
				<h4>Outstanding Balance</h4>
				<table class="list">
					<tr class="title">
						<td class="hide"></td>
						<td>Account</td>
						<td align="right">Amount</td>
					</tr>
					<tr>
						<td class="hide"></td>
						<td>Total Tuition</td>
						<td align="right">Php <?php echo number_format($total+$data["InstallmentFee"], 3, ".", ","); ?></td>
					</tr>
					<tr>
						<td class="hide"></td>
						<td>Active Surcharge</td>
						<td align="right">Php <?php echo number_format($data["Surcharge"], 3, ".", ","); ?></td>
					</tr>
					<tr>
						<td class="hide"></td>
						<td>Previous Balance</td>
						<td align="right">
							<?php
							if($data["PreviousBalance"] >= 0) {
								echo 'Php '.number_format($data["PreviousBalance"], 3);
							} else {
								echo '(Php '.number_format(0-$data["PreviousBalance"], 3).')';
							}
							?>
						</td>
					</tr>
					<tr>
						<td class="hide"></td>
						<td>Paid</td>
						<td align="right">(Php <?php echo number_format($oes->getTotalCredit($id), 3); ?>)</td>
					</tr>
					<tr>
						<td class="hide"></td>
						<td>Balance</td>
						<td align="right">Php <?php echo number_format($data["Balance"] + $data["Surcharge"], 3); ?></td>
					</tr>
				</table><br>
				<ul class="button-container right">
					<?php
					if($paybutton) {
					?>
						<li><a onclick="showBottomSheet('addcredit', '<?php echo $id; ?>');" class="raised_button">Add Credits</a></li>
						<li><a onclick="showBottomSheet('paywithcash', '<?php echo $id; ?>');" class="raised_button">Pay with cash</a></li>
						<?php
						$creditcard = $oes->getData("CreditCard", "*", "ID = '$id'");
						if(!empty($creditcard)) {
						?>
						<li><a onclick="showBottomSheet('paywithcard', '<?php echo $id; ?>');" class="raised_button">Pay with credit card</a></li>
					<?php
						}
					}
					?>
				</ul>
			</div>
			<?php
			}
			?>
	<?php
		}
	} elseif($action == "viewstudent_schedule" || $action == "student_schedule") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$gradelevel = $oes->getSingleData("Student", "GradeLevel", "ID = '$id'");
			$section = $oes->getSingleData("Student", "GLS", "ID = '$id'");
			$defaultroom = $oes->getSingleData("GLS", "RoomID", "ID = '$section'");
			$adviser = $oes->getSingleData("GLS", "FacultyID", "ID = '$section'");
			$useragent=$_SERVER['HTTP_USER_AGENT']; 
			if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
			?>
			<div class="card">
				<h4>Schedule</h4>
				<?php
				if($adviser != 0 && $defaultroom != 0) {
				?>
					<b>Adviser:</b> <?php echo $oes->getNameFormat("f M. l", $adviser); ?><br>
					<b>Default Room:</b> <?php
					$roomdata = $oes->getRow("Room", "*", "ID = '$defaultroom'");
					$buildingdata = $oes->getRow("Building", "*", "ID = '".$roomdata["BuildingID"]."'");
					echo $buildingdata["Name"].' - Room '.$roomdata["Name"];
				}
				?>
				<table class="list" id="tableListSectionSchedule">
					<?php
					$days = array("M", "T", "W", "H", "F");

					foreach($days as $day) {
					?>
					<tr class="title">
						<td class="hide">
						</td>
						<td colspan="2"><?php echo $oes->getFullDayName($day); ?></td>
					</tr>
					<?php
						$schedule = $oes->getData("Schedule", "*", "SectionID = '$section' AND Day = '".$day."' ORDER BY StartTime ASC");
						if(!empty($schedule)) {
							foreach($schedule as $s) {
					?>
					<tr>
						<td class="hide"></td>
						<td class="primary">
							<span><?php echo ($s["SubjectID"] == null ? $s["Break"] : $oes->getSingleData("Subject", "Name", "ID = '".$s["SubjectID"]."'")); ?></span>
							<span><?php echo date('g:i a', strtotime($s["StartTime"])).' - '.date('g:i a', strtotime($s["EndTime"])); ?></span>
						</td>
						<td>
							<ul class="button-container">
								<li>
									<a id="btnInfo_<?php echo $s["ID"]; ?>" class="flat_icon_20 ic_info_outline showhover"></a>
								</li>
							</ul>
						</td>
					</tr>
					<script>
					$(document).ready(function() {
						$("#btnInfo_<?php echo $s["ID"]; ?>").click(function() {
							showDialogBox('infosectionschedule', '<?php echo $s["ID"]; ?>');
						});
					});
					</script>
					</tr>
					<?php
							}
						} else {
					?>
					<tr>
						<td class="hide"></td>
						<td colspan="2"><center><small><i>No schedule assigned in this day.</i></small></center></td>
					</tr>
					<?php
						}
					}
					?>
				</table>
			</div>
		<?php
			} else {
		?>
			<div class="card">
				<h4>Schedule</h4>
				<?php
				if($adviser != 0 && $defaultroom != 0) {
				?>
					<b>Adviser:</b> <?php echo $oes->getNameFormat("f M. l", $adviser); ?><br>
					<b>Default Room:</b> <?php
					$roomdata = $oes->getRow("Room", "*", "ID = '$defaultroom'");
					$buildingdata = $oes->getRow("Building", "*", "ID = '".$roomdata["BuildingID"]."'");
					echo $buildingdata["Name"].' - Room '.$roomdata["Name"];
				}
				?>
				<table class="list schedule">
					<tr class="title">
						<td class="hide"></td>
						<td>Time</td>
						<td align="center">M</td>
						<td align="center">T</td>
						<td align="center">W</td>
						<td align="center">H</td>
						<td align="center">F</td>
					</tr>
					<?php
					$time = array("07:30", "08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30");
					$day = array("M", "T", "W", "H", "F");
					for($i = 0; $i < sizeof($time)-1; $i++) {
						echo '<tr>
							<td class="hide"></td>
							<td>'.date("g:i a", strtotime($time[$i].":00"))." - ".date("g:i a", strtotime($time[$i+1].":00")).'</td>';
						for($j = 0; $j < sizeof($day); $j++) {
							$sched = $oes->getRow("Schedule", "*", "SectionID = '$section' AND StartTime = '".$time[$i].":00' AND Day = '".$day[$j]."'"); 
							if(!empty($sched)) {
								$step = 0;
								while($sched["EndTime"] != $time[$i+$step].":00") {
									$step++;
								}
								if($sched["Break"] == "")
									echo '<td rowspan="'.$step.'" align="center">'.$oes->getSingleData("Subject", "Code", "ID = '".$sched["SubjectID"]."'").'</td>';
								else
									echo '<td rowspan="'.$step.'" align="center">'.$sched["Break"].'</td>';
							} else {
								$check = $oes->getData("Schedule", "*", "SectionID = '$section' AND Day = '".$day[$j]."' AND ('".$time[$i]."' >= StartTime AND '".$time[$i]."' < EndTime)");
								if(sizeof($check) == 0) {
									echo "<td></td>";
								}
							}
						}
						echo '</tr>';
					}
					?>
				</table>
			</div>
		<?php
			}
		}
	} elseif($action == "viewstudent_grades" || $action == "student_grades") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
		?>
			<div class="card" id="lstGrades">
				<a onclick="showBottomSheet('viewgrades', '<?php echo $id; ?>');" target="_blank" class="float_button pos_top_right ic_clipboard-text_white icon_medium"></a>
				<h4>Grades</h4>
				<select name="sy">
					<?php
					$sy = "";
					$sys = mysql_query("SELECT DISTINCT SchoolYear FROM Grade WHERE StudentID = '$id' ORDER BY SchoolYear DESC");
					while($row = mysql_fetch_array($sys)) {
						$sy = $row["SchoolYear"];
						echo '<option value="'.$row["SchoolYear"].'">School Year '.$row["SchoolYear"].' - '.($row["SchoolYear"]+1).'</option>';
					}
					?>
				</select>
				<br>
				<br>
				<table class="list small" id="tableListGrades">
					
				</table>
				<script>
				function refreshStudentGrade($sy) {
					$("#lstGrades #tableListGrades").html('<tr><td><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></td></tr>');
					$.ajax({
						type: "post",
						cache: true,
						url: "process.php?action=listgrades",
						data: {student: '<?php echo $id; ?>', sy: $sy},
						success: function(html) {
							$("#lstGrades #tableListGrades").html(html);
						}
					})
				}
				$(document).ready(function() {
					$val = $("#lstGrades select[name=sy]").val();
						refreshStudentGrade($val);
					$("#lstGrades select[name=sy]").change(function() {
						refreshStudentGrade($(this).val());
					});
				})
				</script>
			</div>
		<?php
		}
	} elseif($action == "listgrades") {
		if(isset($_POST['student'], $_POST['sy'])) {
			$id = $_POST['student'];
			$sy = $_POST['sy'];
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
		<?php
		}
	} elseif($action == "listbreakdown") {
		if(isset($_POST['gl'])) {
			$gradelevel = $_POST['gl'];
?>
			<div class="card">
				<!-- <a onclick="showBottomSheet('addfee', '<?php echo $gradelevel; ?>');" class="float_button pos_top_right ic_plus_white icon_medium"></a>-->
				<table class="list" id="tableListBreakDown">
					<tr class="title">
						<td class="hide"></td>
						<td colspan="2">Assessment of Fees</td>
					</tr>
					<?php
					$breakdown = $oes->getData("Breakdown", "*", "GradeLevel = '$gradelevel'");
					$total = 0;
					if(!empty($breakdown)) {
						foreach($breakdown as $data) {
							$total += $data["Price"];
					?>
					<tr>
						<td class="hide"></td>
						<td class="primary">
							<span><?php echo $data["Title"]; ?></span>
							<span>Php <?php echo number_format($data["Price"], 2, ".", ","); ?></span>
						</td>
						<td>
							<ul class="button-container">
								<li>
									<a id="btnEdit_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_pencil showhover"></a>
									<!--<a id="btnDelete_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>-->
								</li>
							</ul>
						</td>
					</tr>
					<script>
					$(document).ready(function() {
						$("#btnEdit_<?php echo $data["ID"]; ?>").click(function() {
							showBottomSheet('editfee', '<?php echo $data["ID"]; ?>');
						});
						$("#btnDelete_<?php echo $data["ID"]; ?>").click(function() {
							showDialogBox('deletefee', '<?php echo $data["ID"]; ?>');
						});
					});
					</script>
					<?php
						}
					?>
					<tr>
						<td class="hide"></td>
						<td><b>TOTAL</b></td>
						<td align="right">Php <?php echo number_format($total, 2, ".", ","); ?></td>
					</tr>
					<?php
					} else {
					?>
					<tr>
						<td class="hide"></td>
						<td colspan="2"><i><center><small>No fees added.</small></center></i></td>
					</tr>
					<?php
					}
					?>
				</table>
			</div>
<?php
		}
	} elseif($action == "addfee") {
		if(isset($_POST['gl'], $_POST['title'], $_POST['price'])) {
			$gl = $_POST['gl'];
			$title = $_POST['title'];
			$price = $_POST['price'];
			if(is_numeric($price) && $title != "") {
				mysql_query("INSERT INTO Breakdown (GradeLevel, Title, Price) VALUES ('$gl', '$title', '$price')");
				hideElements();
				showSnackbar("add_success");
			} else {
				showSnackbar("add_error");
			}
		}
	} elseif($action == "editfee") {
		if(isset($_POST['id'], $_POST['title'], $_POST['price'])) {
			$id = $_POST['id'];
			$title = $_POST['title'];
			$price = $_POST['price'];
			if(is_numeric($price) && $title != "") {
				mysql_query("UPDATE Breakdown SET Title = '$title', Price = '$price' WHERE ID = '$id'");
				hideElements();
				showSnackbar("edit_success");
			} else {
				showSnackbar("edit_error");
			}
		}
	} elseif($action == "deletefee") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			mysql_query("DELETE FROM Breakdown WHERE ID = '$id'");
			showSnackbar("delete_success");
		}
	} elseif($action == "listpaymentdue") {
	?>
			<div class="card">
				<table class="list">
					<tr class="title">
						<td class="hide"></td>
						<td>Applicable Month</td>
						<td>Due Date</td>
						<td></td>
					</tr>
					<?php
					$sy = $getSchoolYear();
					$months = array($sy."-08-01", $sy."-09-01", $sy."-10-01", $sy."-11-01", $sy."-12-01", ($sy+1)."-01-01", ($sy+1)."-02-01", ($sy+1)."-03-01", ($sy+1)."-04-01");
					foreach($months as $month) {
					?>
					<tr>
						<td class="hide"></td>
						<td><?php echo date("F Y", strtotime($month)); ?></td>
						<td><?php echo date("F d", strtotime($oes->getSingleData("Administration", "Due_".date("F", strtotime($month)), "SchoolYear = '".$oes->getSchoolYear()."'"))); ?></td>
						<td>
							<ul class="button-container">
								<li>
									<a id="btnEdit_<?php echo $month; ?>" class="flat_icon_20 ic_pencil showhover"></a>
								</li>
							</ul>
						</td>
					</tr>
					<script>
					$(document).ready(function() {
						$("#btnEdit_<?php echo $month; ?>").click(function() {
							showBottomSheet('editdue', '<?php echo $month ?>');
						});
					});
					</script>
					<?php
					}
					?>
				</table>
			</div>
	<?php
	} elseif($action == "editdue") {
		if(isset($_POST['month'], $_POST['duedate'])) {
			$month = $_POST['month'];
			$duedate = $_POST['duedate'];
			$startdate = date("Y-m-01", strtotime($month));
			$enddate = date("Y-m-t", strtotime($month));
			if(($duedate >= $startdate) && ($duedate <= $enddate)) {
				mysql_query("UPDATE Administration SET Due_".date("F", strtotime($month))." = '$duedate' WHERE SchoolYear = '".$oes->getSchoolYear()."'");
				hideElements();
				showSnackbar("edit_success");
			} else {
				showSnackbar("edit_error");
			}
		}
	} elseif($action == "listpaymentterms") {
		if(isset($_POST['gl'])) {
			$gl = $_POST['gl'];
	?>
			<div class="card">
				<table class="list">
					<tr class="title">
						<td class="hide"></td>
						<td>Payment Terms</td>
						<td>Additional Fee</td>
						<td></td>
					</tr>
					<?php
					$terms = $oes->getData("PaymentTerm", "*", "GradeLevel = '$gl' ORDER BY PaymentTerm");
					foreach($terms as $term) {
					?>
					<tr>
						<td class="hide"></td>
						<td><?php echo $term["PaymentTerm"]; ?></td>
						<td>Php <?php echo number_format($term["Fee"], 2, ".", ","); ?></td>
						<td>
							<ul class="button-container">
								<li>
									<a id="btnEdit_<?php echo $term["ID"]; ?>" class="flat_icon_20 ic_pencil showhover"></a>
								</li>
							</ul>
						</td>
					</tr>
					<script>
					$(document).ready(function() {
						$("#btnEdit_<?php echo $term["ID"]; ?>").click(function() {
							showBottomSheet('editpaymentterm', '<?php echo $term["ID"]; ?>');
						});
					});
					</script>
					<?php
					}
					if(empty($terms)) {
					?>
					<tr>
						<td class="hide"></td>
						<td colspan="3"><i><small><center>No payment terms</center></small></i></td>
					</tr>
					<?php
					}
					?>
				</table>
			</div>
	<?php
		}
	} elseif($action == "editpaymentterm") {
		if(isset($_POST['id'], $_POST['fee'])) {
			$id = $_POST['id'];
			$fee = $_POST['fee'];
			if(is_numeric($fee)) {
				mysql_query("UPDATE PaymentTerm SET Fee = '$fee' WHERE ID = '$id'");
				hideElements();
				showSnackbar("edit_success");
			} else
				showSnackbar("edit_error");
		}
	} elseif($action == "liststudentpayment") {
		if(isset($_POST['student'])) {
			$id = $_POST['student'];
			$data = $oes->getRow("Assessment", "*", "ID = '$id'");
			if($data["PaymentTerm"] == "") {
	?>
			<div class="card">
				<h4><span class="flat_icon ic_warning"></span>Warning</h4>
				<p>This student doesn't have a payment term set.</p>
				<ul class="button-container right">
					<li><a onclick="showBottomSheet('setpaymentterm', '<?php echo $id; ?>');" class="raised_button">Set Payment Term</a></li>
				</ul>
			</div>
	<?php
			}
	?>
			<div class="card">
				<a onclick="showBottomSheet('setcreditcard', '<?php echo $id; ?>');" class="float_button pos_top_right ic_payment_white icon_medium"></a>
				<h4>Assessment for <?php echo $oes->getNameFormat("f l", $id); ?></h4>
				<?php
				$ptstr = $oes->getSingleData("PaymentTerm", "PaymentTerm", "ID = '".$data["PaymentTerm"]."'");
				if($data["PaymentTerm"] != "") {
				 echo '<p>Payment Term: '.$ptstr.'</p>';
				}
				?>
				<table class="list">
					<tr class="title">
						<td class="hide"></td>
						<td>Account</td>
						<td align="right">Fee</td>
					</tr>
					<?php
					$breakdown = array("Tuition Fee", "Laboratory Fee", "Miscellaneous Fee", "Other Fee");
					$total = 0;
					foreach($breakdown as $b) {
						$price = $data[str_replace(" ", "", $b)];
						$total += $price;
					?>
					<tr>
						<td class="hide"></td>
						<td><?php echo $b; ?></td>
						<td align="right">Php <?php echo number_format($price, 3, ".", ","); ?></td>
					</tr>
					<?php
					}
					?>
					<tr>
						<td class="hide"></td>
						<td><b>Sub-Total:</b></td>
						<td align="right">Php <?php echo number_format($total, 3, ".", ","); ?></td>
					</tr>
					<?php
					if($data["PaymentTerm"] != "") {
						if($data["InstallmentFee"] >= 0) {
					?>
					<tr>
						<td class="hide"></td>
						<td>Additional Fee</td>
						<td align="right">Php <?php echo number_format($data["InstallmentFee"], 3, ".", ","); ?></td>
					</tr>
					<?php
						} else {
					?>
					<tr>
						<td class="hide"></td>
						<td>Rebate</td>
						<td align="right">(Php <?php echo number_format(0-$data["InstallmentFee"], 3, ".", ","); ?>)</td>
					</tr>
					<?php
						}
					?>
					<tr>
						<td class="hide"></td>
						<td><b>TOTAL:</b></td>
						<td align="right">Php <?php echo number_format($total+$data["InstallmentFee"], 3, ".", ","); ?></td>
					</tr>
					<?php
					}
					?>
				</table>
			</div>
			<?php
			if($data["PaymentTerm"] != "") {
			?>
			<div class="card">
				<h4>Payment Status</h4>
				<table class="list">
					<?php
					$sy = $oes->getSchoolYear();
					if($ptstr == "Monthly Installment") 
						$months = array($sy."-08-01", $sy."-09-01", $sy."-10-01", $sy."-11-01", $sy."-12-01", ($sy+1)."-01-01", ($sy+1)."-02-01", ($sy+1)."-03-01", ($sy+1)."-04-01");
					elseif($ptstr == "Quarterly Installment") 
						$months = array($sy."-09-01", $sy."-12-01", ($sy+1)."-03-01");
					elseif($ptstr == "Semi-annually Installment")
						$months = array($sy."-12-01");
					?>
					<tr>
						<td width="1px">
						<?php 
						$paid = $oes->getData("Transaction", "*", "StudentID = '$id' AND ApplicableMonth = 'Upon Enrollment'");
						if(!empty($paid)) {
						?>
						<span class="flat_icon ic_done"></span>
						<?php
							$paybutton = false;
						}
						?>
						</td>
						<td>Upon Enrollment</td>
						<td align="right">Php <?php echo number_format($data["Installment"], 3); ?></td>
					</tr>
					<?php
					$paybutton = false;
					if($ptstr != "Full Payment") {
						foreach($months as $month) {
					?>
					<tr>
						<td width="1px">
						<?php 
						$paid = $oes->getData("Transaction", "*", "StudentID = '$id' AND ApplicableMonth = '$month'");
						if(!empty($paid)) {
						?>
						<span class="flat_icon ic_done"></span>
						<?php
						} else {
							$paybutton = true;
						}
						?>
						</td>
						<td><?php echo date("F Y", strtotime($month)); ?></td>
						<td align="right">Php <?php echo number_format($data["Installment"], 3); ?></td>
					</tr>
					<?php
						}
					}
					?>
				</table>
			</div>
				<?php
				$surcharges = $oes->getData("Surcharge", "*", "StudentID = '$id'");
				if(!empty($surcharges)) {
				?>
			<div class="card">
				<h4>Surcharges</h4>
				<table class="list">
					<tr class="title">
						<td class="hide"></td>
						<td>Date Charged</td>
						<td align="right">Amount</td>
					</tr>
				<?php
					foreach($surcharges as $s) {
				?>
				<tr>
					<td class="hide"></td>
					<td><?php echo date("F d, Y", strtotime($s["DateCharge"])); ?></td>
					<td align="right">Php <?php echo number_format($s["Amount"], 3, ".", ","); ?></td>
				</tr>
				<?php
					}
				?>
				</table>
			</div>
				<?php
				}
				?>
			<div class="card">
				<h4>Outstanding Balance</h4>
				<table class="list">
					<tr class="title">
						<td class="hide"></td>
						<td>Account</td>
						<td align="right">Amount</td>
					</tr>
					<tr>
						<td class="hide"></td>
						<td>Total Tuition</td>
						<td align="right">Php <?php echo number_format($total+$data["InstallmentFee"], 3, ".", ","); ?></td>
					</tr>
					<tr>
						<td class="hide"></td>
						<td>Active Surcharge</td>
						<td align="right">Php <?php echo number_format($data["Surcharge"], 3, ".", ","); ?></td>
					</tr>
					<tr>
						<td class="hide"></td>
						<td>Previous Balance</td>
						<td align="right">
							<?php
							if($data["PreviousBalance"] >= 0) {
								echo 'Php '.number_format($data["PreviousBalance"], 3);
							} else {
								echo '(Php '.number_format(0-$data["PreviousBalance"], 3).')';
							}
							?>
						</td>
					</tr>
					<tr>
						<td class="hide"></td>
						<td>Paid</td>
						<td align="right">(Php <?php echo number_format($oes->getTotalCredit($id), 3); ?>)</td>
					</tr>
					<tr>
						<td class="hide"></td>
						<td>Balance</td>
						<td align="right">Php <?php echo number_format($data["Balance"] + $data["Surcharge"], 3); ?></td>
					</tr>
				</table><br>
				<ul class="button-container right">
					<?php
					if($paybutton) {
					?>
						<li><a onclick="showBottomSheet('addcredit', '<?php echo $id; ?>');" class="raised_button">Add Credits</a></li>
						<li><a onclick="showBottomSheet('paywithcash', '<?php echo $id; ?>');" class="raised_button">Pay with cash</a></li>
						<?php
						$creditcard = $oes->getData("CreditCard", "*", "ID = '$id'");
						if(!empty($creditcard)) {
						?>
						<li><a onclick="showBottomSheet('paywithcard', '<?php echo $id; ?>');" class="raised_button">Pay with credit card</a></li>
					<?php
						}
					}
					?>
				</ul>
			</div>
			<?php
			}
			?>
	<?php
		}
	} elseif($action == "getpaymenttermfee") {
		if(isset($_POST['pt'])) {
			$pt = $_POST['pt'];
			echo 'Php '.number_format($oes->getSingleData("PaymentTerm", "Fee", "ID = '$pt'"), 2, ".", ",");
		}
	} elseif($action == "setpaymentterm") {
		if(isset($_POST['student'], $_POST['pt'])) {
			$student = $_POST['student'];
			$pt = $_POST['pt'];
			$previousbalance = $oes->getSingleData("Assessment", "Balance", "ID = '$student'");
			if($previousbalance == "")
				$previousbalance = 0;
			$tuition = $oes->getTuitionFee($student);
			$fee = $oes->getSingleData("PaymentTerm", "Fee", "ID = '$pt'");
			$surcharge = $oes->getSingleData("Assessment", "Surcharge", "ID = '$student'");
			$total = $tuition + $fee + $previousbalance + $surcharge;
			$installment = $tuition + $fee + $previousbalance + $surcharge;
			$ptstr = $oes->getSingleData("PaymentTerm", "PaymentTerm", "ID = '$pt'");
			mysql_query("UPDATE Assessment SET PreviousBalance = Balance WHERE ID = '$student'");
			if($ptstr == "Full Payment") {
				$q1 = mysql_query("UPDATE Assessment SET Surcharge = '0', InstallmentFee = '$fee', PaymentTerm = '$pt', Installment = '$installment', Balance = '$total' WHERE ID = '$student'");
			} elseif($ptstr == "Monthly Installment") {
				$installment = $installment/10;
				$q1 = mysql_query("UPDATE Assessment SET Surcharge = '0', InstallmentFee = '$fee', PaymentTerm = '$pt', Installment = '$installment', Balance = '$total' WHERE ID = '$student'");
			} elseif($ptstr == "Quarterly Installment") {
				$installment = $installment/4;
				$q1 = mysql_query("UPDATE Assessment SET Surcharge = '0', InstallmentFee = '$fee', PaymentTerm = '$pt', Installment = '$installment', Balance = '$total' WHERE ID = '$student'");
			} elseif($ptstr == "Semi-annually Installment") {
				$installment = $installment/2;
				$q1 = mysql_query("UPDATE Assessment SET Surcharge = '0', InstallmentFee = '$fee', PaymentTerm = '$pt', Installment = '$installment', Balance = '$total' WHERE ID = '$student'");
			}
			$oes->addFeed($student, "Assessment", "Your assessment has been updated. You chose $ptstr as your payment scheme.");
			if($q1) {
				hideElements();
				showSnackbarMsg("Payment term successfully set.");
			} else {
				showSnackbarMsg("Error");
			}
		}
	} elseif($action == "confirmenrollee") {
		if(isset($_POST['id'])) {
			$old_id = $_POST['id'];
			if($oes->isTemporary($old_id)) {
				$new_id = $oes->GenerateAccountID();
				$student = $oes->getRow("Student", "*", "ID = '$old_id'");
				$username = $oes->GenerateUsername($new_id, $student["FirstName"], $student["MiddleName"], $student["LastName"]);
				mysql_query("UPDATE Account SET ID = '$new_id', Username = '$username', Type = 'Student' WHERE ID = '$old_id'");
				mysql_query("UPDATE Student SET ID = '$new_id' WHERE ID = '$old_id'");
				mysql_query("UPDATE Assessment SET ID = '$new_id' WHERE ID ='$old_id'");
				mysql_query("DELETE FROM Enrollee WHERE ID = '$old_id'");
				showSnackbarMsg("Student confirmed");
				$oes->addFeed($new_id, "Confirmed", "You are now confirmed and now registered as an official student!");
				$message = "Hello, ".$oes->getNameFormat("f",$id)."!<br><br>You have successfully confirmed your account!<br><br>Here is your new and permanent username: $username";
				$oes->sendEmail($id, "Confirmed", $message);
			} else {
				mysql_query("UPDATE Account SET Type = 'Student' WHERE ID = '$old_id'");
				showSnackbarMsg("Student confirmed");
				$oes->addFeed($old_id, "Confirmed", "You are now confirmed and now registered as an official student!");
				$message = "Hello, ".$oes->getNameFormat("f",$id)."!<br><br>You have successfully confirmed your account!<br><br>";
				$oes->sendEmail($id, "Confirmed", $message);
			}
		}
	} elseif($action == "confirmenrollee_data") {
		if(isset($_POST['checkedData'])) {
			$checkedData = $_POST['checkedData'];
			foreach($checkedData as $id) {
				$old_id = $id;
				if($oes->isTemporary($old_id)) {
					$new_id = $oes->GenerateAccountID();
					$student = $oes->getRow("Student", "*", "ID = '$old_id'");
					$username = $oes->GenerateUsername($new_id, $student["FirstName"], $student["MiddleName"], $student["LastName"]);
					mysql_query("UPDATE Account SET ID = '$new_id', Username = '$username', Type = 'Student' WHERE ID = '$old_id'");
					mysql_query("UPDATE Student SET ID = '$new_id' WHERE ID = '$old_id'");
					mysql_query("UPDATE Assessment SET ID = '$new_id' WHERE ID ='$old_id'");
					mysql_query("DELETE FROM Enrollee WHERE ID = '$old_id'");
					showSnackbarMsg("Student confirmed");
					$oes->addFeed($new_id, "Confirmed", "You are now confirmed and now registered as an official student!");
					$message = "Hello, ".$oes->getNameFormat("f",$id)."!<br><br>You have successfully confirmed your account!<br><br>Here is your new and permanent username: $username";
					$oes->sendEmail($id, "Confirmed", $message);
				} else {
					mysql_query("UPDATE Account SET Type = 'Student' WHERE ID = '$old_id'");
					mysql_query("DELETE FROM Enrollee WHERE ID = '$old_id'");
					showSnackbarMsg("Student confirmed");
					$oes->addFeed($old_id, "Confirmed", "You are now confirmed and now registered as an official student!");
					$message = "Hello, ".$oes->getNameFormat("f",$id)."!<br><br>You have successfully confirmed your account!<br><br>";
					$oes->sendEmail($id, "Confirmed", $message);
				}
			}
		}
	} elseif($action == "setcreditcard") {
		if(isset($_POST['id'], $_POST['name'], $_POST['number'], $_POST['verify'], $_POST['expiremonth'], $_POST['expireyear'])) {
			$id = $_POST['id'];
			$name = $_POST['name'];
			$number = $_POST['number'];
			$verify = $_POST['verify'];
			$expire = $_POST['expireyear'].'-'.$_POST['expiremonth'].'-01';
			if($name != "" && $number != "" & $verify != "") {
				if($oes->isExists("CreditCard", array("ID"), array($id))) {
					mysql_query("UPDATE CreditCard SET HolderName = '$name', CardNumber = '$number', VerificationNumber = '$verify', ExpirationDate = '$expire' WHERE ID = '$id'");
				} else {
					mysql_query("INSERT INTO CreditCard (ID, HolderName, CardNumber, VerificationNumber, ExpirationDate) VALUES ('$id', '$name', '$number', '$verify', '$expire')");
				}
				hideElements();
				showSnackbar("edit_success");
			} else {
				showSnackbar("edit_error");
			}
		}
	} elseif($action == "removecreditcard") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			mysql_query("DELETE FROM CreditCard WHERE ID = '$id'");
			showSnackbar("delete_success");
		}
	} elseif($action == "paywithcash") {
		if(isset($_POST['id'], $_POST['amount'], $_POST['month'], $_POST['date'])) {
			$id = $_POST['id'];
			$assessment = $oes->getRow("Assessment", "*", "ID = '$id'");
			$amount = $_POST['amount'];
			$month = $_POST['month'];
			$date = $_POST['date'];
			if(is_numeric($amount)) {
				if($amount + $assessment["Credit"] >= $assessment["Installment"] && $amount >= 0) {
					if($assessment["Credit"] >= $assessment["Installment"]) {
						$surcharge = $assessment["Surcharge"];
						$total = $amount + $assessment["Credit"];
						if($total >= ($assessment["Installment"] + $surcharge)) {
							$surchargepaid = $surcharge;
							$assessment["Credit"] = $total - $assessment["Installment"] - $surchargepaid;
						} else {
							$surchargepaid = $total - $assessment["Installment"];
							if($surchargepaid > $surcharge) {
								$surchargepaid = $surcharge;
								$assessment["Credit"] = 0;
							} else {
								$assessment["Credit"] = 0;
							}
						}
						$surcharge -= $surchargepaid;
						$assessment["Balance"] -= $amount - $surchargepaid;
						mysql_query("UPDATE Assessment SET Surcharge = '".$surcharge."', Balance = '".$assessment["Balance"]."', Credit = '".$assessment["Credit"]."' WHERE ID = '$id'");
						mysql_query("INSERT INTO Transaction (StudentID, PaymentType, ApplicableMonth, DatePaid, TotalAmount) VALUES ('$id', 'Cash', '$month', '$date', '$amount')");
					} else {
						$surcharge = $assessment["Surcharge"];
						$total = $amount + $assessment["Credit"];
						if($total >= ($assessment["Installment"] + $surcharge)) {
							$surchargepaid = $surcharge;
							$assessment["Credit"] = $total - $assessment["Installment"] - $surcharge;
						} else {
							$surchargepaid = $total - $assessment["Installment"];
							if($surchargepaid > $surcharge)
								$surchargepaid = $surcharge;
							$assessment["Credit"] = 0;
						}
						$surcharge -= $surchargepaid;
						$assessment["Balance"] -= $amount - $surchargepaid;
						mysql_query("UPDATE Assessment SET Surcharge = '".$surcharge."', Balance = '".$assessment["Balance"]."', Credit = '".$assessment["Credit"]."' WHERE ID = '$id'");
						mysql_query("INSERT INTO Transaction (StudentID, PaymentType, ApplicableMonth, DatePaid, TotalAmount) VALUES ('$id', 'Cash', '$month', '$date', '".($amount)."')");
					}
					hideElements();
					if($month == "Upon Enrollment") {
						$oes->addFeed($id, "Paid", "You have successfully paid your downpayment using cash.");
					} else {
						$oes->addFeed($id, "Paid", "You have successfully paid your installment for the applicable month of ".date("F Y", strtotime($month))." using cash.");
					}
					showSnackbarMsg("Paid successfully");
				} else {
					showSnackbarMsg($amount + $assessment["Credit"].' = '.$assessment["Installment"]);
				}
			} else {
				showSnackbarMsg("Error");
			}
		} else {
			showSnackbarMsg("Error");
		}
	} elseif($action == "paywithcard") {
		if(isset($_POST['id'], $_POST['amount'], $_POST['month'], $_POST['date'], $_POST['surcharge'])) {
			$id = $_POST['id'];
			$amount = $_POST['amount'];
			$month = $_POST['month'];
			$date = $_POST['date'];
			$is_surcharge = $_POST['surcharge'];
			if(is_numeric($amount)) {
				$assessment = $oes->getRow("Assessment", "*", "ID = '$id'");
				if($amount + $assessment["Credit"] >= $assessment["Installment"] && $amount >= 0) {
					if($assessment["Credit"] >= $assessment["Installment"]) {
						$surcharge = $assessment["Surcharge"];
						$total = $amount + $assessment["Credit"];
						if($total >= ($assessment["Installment"] + $surcharge)) {
							$surchargepaid = $surcharge;
							$assessment["Credit"] = $total - $assessment["Installment"] - $surchargepaid;
						} else {
							$surchargepaid = $total - $assessment["Installment"];
							if($surchargepaid > $surcharge) {
								$surchargepaid = $surcharge;
								$assessment["Credit"] = 0;
							} else {
								$assessment["Credit"] = 0;
							}
						}
						$surcharge -= $surchargepaid;
						$assessment["Balance"] -= $amount - $surchargepaid;
						//mysql_query("UPDATE Assessment SET Surcharge = '".$surcharge."', Balance = '".$assessment["Balance"]."', Credit = '".$assessment["Credit"]."' WHERE ID = '$id'");
						//mysql_query("INSERT INTO Transaction (StudentID, PaymentType, ApplicableMonth, DatePaid, TotalAmount) VALUES ('$id', 'Cash', '$month', '$date', '$amount')");
					} else {
						$surcharge = $assessment["Surcharge"];
						$total = $amount + $assessment["Credit"];
						$assessment["Credit"] = 0;
						$surchargepaid = 0;
						if($is_surcharge == "true") {
							$surchargepaid = $surcharge;
							$surcharge = 0;
						}
						$assessment["Balance"] -= $amount;
						mysql_query("UPDATE Assessment SET Surcharge = '".$surcharge."', Balance = '".$assessment["Balance"]."', Credit = '".$assessment["Credit"]."' WHERE ID = '$id'");
						mysql_query("INSERT INTO Transaction (StudentID, PaymentType, ApplicableMonth, DatePaid, TotalAmount) VALUES ('$id', 'Cash', '$month', '$date', '".($amount)."')");
					}
					hideElements();
					if($month == "Upon Enrollment") {
						$oes->addFeed($id, "Paid", "You have successfully paid your downpayment using cash.");
					} else {
						$oes->addFeed($id, "Paid", "You have successfully paid your installment for the applicable month of ".date("F Y", strtotime($month))." using cash.");
					}
					showSnackbarMsg("Paid successfully");
				} else {
					showSnackbarMsg("Insufficient amount.");
				}
			} else {
				showSnackbarMsg("Error");
			}
		} else {
			showSnackbarMsg("Error");
		}
	} elseif($action == "addcredit") {
		if(isset($_POST['id'], $_POST['credit'])) {
			$id = $_POST['id'];
			$credit = $_POST['credit'];
			if(is_numeric($credit)) {
				if($credit > 0) {
					$currentBalance = $oes->getSingleData("Assessment", "Balance", "ID = '$id'");
					$balance = $currentBalance - $credit;
					$currentCredit = $oes->getSingleData("Assessment", "Credit", "ID = '$id'");
					$currentCredit += $credit;
					mysql_query("UPDATE Assessment SET Balance = '$balance', Credit = '$currentCredit' WHERE ID = '$id'");
					mysql_query("INSERT INTO Transaction (StudentID, PaymentType, ApplicableMonth, DatePaid, TotalAmount) VALUES ('$id', 'Cash', 'Credit', '".date("Y-m-d")."', '$credit')");
					hideElements();
					showSnackbarMsg("Credit successfully added");
				}
			}
		}
	} elseif($action == "applysurcharges") {
		if(isset($_POST['month'])) {
			$month = $_POST['month'];
			$students = $oes->getData("Assessment", "*", "PaymentTerm != ''");
			foreach($students as $student) {
				$check = $oes->getData("Transaction", "*", "StudentID = '".$student["ID"]."' AND ApplicableMonth = '$month'");
				$check2 = $oes->getData("Surcharge", "*", "StudentID = '".$student["ID"]."' AND ApplicableMonth = '$month'");
				if(sizeof($check) == 0 && sizeof($check2) == 0) {
					if($student["Credit"] >= $student["Installment"]) {
						$credit = $student["Credit"] - $student["Installment"];
						$date = date("Y-m-d");
						mysql_query("UPDATE Assessment SET Credit = '$credit' WHERE ID = '".$student["ID"]."'");
						mysql_query("INSERT INTO Transaction (StudentID, PaymentType, ApplicableMonth, DatePaid, TotalAmount) VALUES ('".$student["ID"]."', 'Cash', '$month', '$date', '0')");
					} else {
						$surcharge = $oes->getSurcharge($student["ID"]);
						$ptstr = $oes->getSingleData("PaymentTerm", "PaymentTerm", "ID = '".$student["PaymentTerm"]."'");
						$months = array();
						$sy = $oes->getSchoolYear();
						if($ptstr == "Monthly Installment") 
							$months = array($sy."-08-01", $sy."-09-01", $sy."-10-01", $sy."-11-01", $sy."-12-01", ($sy+1)."-01-01", ($sy+1)."-02-01", ($sy+1)."-03-01", ($sy+1)."-04-01");
						elseif($ptstr == "Quarterly Installment") 
							$months = array($sy."-09-01", $sy."-12-01", ($sy+1)."-03-01");
						elseif($ptstr == "Semi-annually Installment")
							$months = array($sy."-12-01");
						if(in_array($month, $months)) {
							$currentSurcharge = $oes->getSingleData("Assessment", "Surcharge", "ID = '".$student["ID"]."'");
							$currentSurcharge += $surcharge;
							mysql_query("UPDATE Assessment SET Surcharge = '$currentSurcharge' WHERE ID = '".$student["ID"]."'");
							mysql_query("INSERT INTO Surcharge (StudentID, Amount, DateCharge, ApplicableMonth) VALUES ('".$student["ID"]."', '$surcharge', '".date("Y-m-d")."', '$month')");
							$oes->addFeed($student["ID"], "Surcharge", "You have been charged with the amount of Php ".$surcharge." for not paying on the right schedule.");
						}
					}
				}
			}
			hideElements();
			showSnackbarMsg("Surchages applied");
		} else {
			showSnackbarMsg("Error");
		}
	} elseif($action == "changeschoolyear") {
		if(isset($_POST['confirm'])) {
			$sy_old = $oes->getSchoolYear();
			$sy_new = $sy_old+1;
			mysql_query("UPDATE Student SET GLS = '0' WHERE ID IN (SELECT ID FROM Account WHERE Type = 'Enrollee' AND Status = 'Active')");
			mysql_query("UPDATE Administration SET Status = 0, FirstQuarter = 0, SecondQuarter = 0, ThirdQuarter = 0, FourthQuarter = 0, SchoolYear = '$sy_new' WHERE SchoolYear = '$sy_old'");
			mysql_query("INSERT INTO Enrollee (ID, EnrollmentStatus) SELECT ID, 'Passed' FROM Account WHERE Type = 'Student'");

			$students = $oes->getData("Student INNER JOIN Account", "*", "Student.ID AND Account.ID AND Account.Type = 'Student' AND Account.Status = 'Active'");
			foreach($students as $student) {
				$gradelevel = $student["GradeLevel"];
				$tuition = $oes->getSingleData("Breakdown", "Price", "GradeLevel = '$gradelevel' AND Title = 'Tuition Fee'");
				$lab = $oes->getSingleData("Breakdown", "Price", "GradeLevel = '$gradelevel' AND Title = 'Laboratory Fee'");
				$misc = $oes->getSingleData("Breakdown", "Price", "GradeLevel = '$gradelevel' AND Title = 'Miscellaneous Fee'");
				$other = $oes->getSingleData("Breakdown", "Price", "GradeLevel = '$gradelevel' AND Title = 'Other Fee'");
				mysql_query("UPDATE Assessment SET TuitionFee = '$tuition', LaboratoryFee = '$lab', MiscellaneousFee = '$misc', OtherFee = '$other', PaymentTerm = NULL, Installment = NULL WHERE ID = '".$student["ID"]."'");
			}
			
			mysql_query("UPDATE Student SET GradeLevel = '10' WHERE GradeLevel = '9' AND ID IN (SELECT ID FROM Account WHERE Type = 'Student' AND Status = 'Active')");
			mysql_query("UPDATE Student SET GradeLevel = '9' WHERE GradeLevel = '8' AND ID IN (SELECT ID FROM Account WHERE Type = 'Student' AND Status = 'Active')");
			mysql_query("UPDATE Student SET GradeLevel = '8' WHERE GradeLevel = '7' AND ID IN (SELECT ID FROM Account WHERE Type = 'Student' AND Status = 'Active')");
			
			mysql_query("UPDATE Account SET Type = 'Enrollee' WHERE Type = 'Student'");
			mysql_query("UPDATE Account SET Type = 'Graduate' WHERE ID IN (SELECT ID FROM Student WHERE GradeLevel = '10') AND Status = 'Active'");
			
			mysql_query("UPDATE GLS SET GradeLevel = '10' WHERE GradeLevel = '9'");
			mysql_query("UPDATE GLS SET GradeLevel = '9' WHERE GradeLevel = '8'");
			mysql_query("UPDATE GLS SET GradeLevel = '8' WHERE GradeLevel = '7'");
			mysql_query("UPDATE GLS SET FacultyID = NULL");
			mysql_query("DELETE FROM Schedule");
			mysql_query("DELETE FROM Surcharge");
			mysql_query("DELETE FROM Transaction");
		}
	} elseif($action == "student_assessment") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$paymentterm = $oes->getSingleData("Assessment", "PaymentTerm", "ID = '$id'");
			?>
			<div class="card">
				<a onclick="showBottomSheet('setcreditcard', '<?php echo $id; ?>');" class="float_button pos_top_right ic_payment_white icon_medium"></a>
				<h4>Assessment for <?php echo $oes->getNameFormat("f l", $id); ?></h4>
				<?php
				$ptstr = $oes->getSingleData("PaymentTerm", "PaymentTerm", "ID = '$paymentterm'");
				if($paymentterm != "") {
				 echo '<p>Payment Term: '.$ptstr.'</p>';
				}
				?>
				<table class="list">
					<tr class="title">
						<td class="hide"></td>
						<td>Account</td>
						<td align="right">Fee</td>
					</tr>
					<?php
					$gl = $oes->getSingleData("Student", "GradeLevel", "ID = '$id'");
					$breakdown = $oes->getData("Breakdown", "*", "GradeLevel = '$gl'");
					$total = 0;
					foreach($breakdown as $b) {
						$total += $b["Price"];
					?>
					<tr>
						<td class="hide"></td>
						<td><?php echo $b["Title"]; ?></td>
						<td align="right">Php <?php echo number_format($b["Price"], 3, ".", ","); ?></td>
					</tr>
					<?php
					}
					?>
					<tr>
						<td class="hide"></td>
						<td><b>Sub-Total:</b></td>
						<td align="right">Php <?php echo number_format($total, 3, ".", ","); ?></td>
					</tr>
					<?php
					if($paymentterm != "") {
						$fee = $oes->getSingleData("PaymentTerm", "Fee", "ID = '$paymentterm'");
						if($fee >= 0) {
					?>
					<tr>
						<td class="hide"></td>
						<td>Additional Fee</td>
						<td align="right">Php <?php echo number_format($fee, 3, ".", ","); ?></td>
					</tr>
					<?php
						} else {
					?>
					<tr>
						<td class="hide"></td>
						<td>Rebate</td>
						<td align="right">(Php <?php echo number_format($fee, 3, ".", ","); ?>)</td>
					</tr>
					<?php
						}
					?>
					<tr>
						<td class="hide"></td>
						<td><b>TOTAL:</b></td>
						<td align="right">Php <?php echo number_format($total+$fee, 3, ".", ","); ?></td>
					</tr>
					<?php
					}
					?>
				</table>
			</div>
			<?php
			if($paymentterm != "") {
			?>
			<div class="card">
				<h4>Payment Status</h4>
				<table class="list">
					<?php
					$sy = $oes->getSchoolYear();
					if($ptstr == "Monthly Installment") 
						$months = array($sy."-08-01", $sy."-09-01", $sy."-10-01", $sy."-11-01", $sy."-12-01", ($sy+1)."-01-01", ($sy+1)."-02-01", ($sy+1)."-03-01", ($sy+1)."-04-01");
					elseif($ptstr == "Quarterly Installment") 
						$months = array($sy."-09-01", $sy."-12-01", ($sy+1)."-03-01");
					elseif($ptstr == "Semi-annually Installment")
						$months = array($sy."-12-01");
					?>
					<tr>
						<td width="1px">
						<?php 
						$paid = $oes->getData("Transaction", "*", "StudentID = '$id' AND ApplicableMonth = 'Upon Enrollment'");
						if(!empty($paid)) {
						?>
						<span class="flat_icon ic_done"></span>
						<?php
						}
						?>
						</td>
						<td>Upon Enrollment</td>
						<td align="right">Php <?php echo number_format($oes->getSingleData("Assessment", "Installment", "ID = '$id'"), 3); ?></td>
					</tr>
					<?php
					if($ptstr != "Full Payment") {
						foreach($months as $month) {
					?>
					<tr>
						<td width="1px">
						<?php 
						$paid = $oes->getData("Transaction", "*", "StudentID = '$id' AND ApplicableMonth = '$month'");
						if(!empty($paid)) {
						?>
						<span class="flat_icon ic_done"></span>
						<?php
						}
						?>
						</td>
						<td><?php echo date("F Y", strtotime($month)); ?></td>
						<td align="right">Php <?php echo number_format($oes->getSingleData("Assessment", "Installment", "ID = '$id'"), 3); ?></td>
					</tr>
					<?php
						}
					}
					?>
				</table>
				<h4>Outstanding Balance</h4>
				<table class="list">
					<tr>
						<td class="hide"></td>
						<td>Total Tuition</td>
						<td align="right">Php <?php echo number_format($total+$fee, 3, ".", ","); ?></td>
					</tr>
					<?php
					$surcharges = $oes->getData("Surcharge", "*", "StudentID = '$id'");
					if(!empty($surcharges)) {
						foreach($surcharges as $s) {
					?>
					<tr>
						<td class="hide"></td>
						<td>Surcharge (<?php echo date("F d, Y", strtotime($s["DateCharge"])); ?>)</td>
						<td align="right">Php <?php echo number_format($s["Amount"], 3, ".", ","); ?></td>
					</tr>
					<?php
						}
					}
					?>
					<tr>
						<td class="hide"></td>
						<td>Credit</td>
						<td align="right">Php (<?php echo number_format($oes->getTotalCredit($id), 3); ?>)</td>
					</tr>
					<tr>
						<td class="hide"></td>
						<td>Balance</td>
						<td align="right">Php <?php echo $totalbalance = number_format($oes->getSingleData("Assessment", "Balance", "ID = '$id'"), 3); ?></td>
					</tr>
				</table><br>
				<ul class="button-container right">
					<?php
					$creditcard = $oes->getData("CreditCard", "*", "ID = '$id'");
					if(!empty($creditcard) && $totalbalance > 0) {
					?>
					<li><a onclick="showBottomSheet('paywithcard', '<?php echo $id; ?>');" class="raised_button">Pay with credit card</a></li>
					<?php
					}
					?>
				</ul>
			</div>
			<?php
			}
			?>
	<?php
		}
	} elseif($action == "student_classmates") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$section = $oes->getSingleData("Student", "GLS", "ID = '$id'");
	?>
			<div class="card">
				<h4>Your classmates</h4>
				<table class="list">
					<tr class="title">
						<td class="hide"></td>
						<td>ID</td>
						<td>Name</td>
					</tr>
					<?php
					$classmates = $oes->getData("Student", "*", "GLS = '$section' AND ID != '$id' ORDER BY LastName");
					foreach($classmates as $c) {
					?>
					<tr>
						<td class="hide"></td>
						<td><?php echo $c["ID"]; ?></td>
						<td><?php echo $oes->getNameFormat("f M. l", $c["ID"]); ?></td>
					</tr>
					<?php
					}
					if(empty($classmates)) {
					?>
					<tr>
						<td class="hide"></td>
						<td colspan="2"><small><i><center>You have no classmates. Lol</center></i></small></td>
					</tr>
					<?php
					}
					?>
				</table>
			</div>
	<?php
		}
	} elseif($action == "faculty_schedule") {
		if(isset($_POST['id'])) {
			$faculty = $_POST['id'];
			?>
			<div class="card">
				<table class="form-container">
					<tr>
						<td width="50%"><label>Faculty Name</label><br><?php echo $oes->getNameFormat("f M. l", $faculty); ?></td>
						<td><label>Total Load</label><br><?php echo $units = $oes->getTotalLoad($faculty); echo ' '.($units > 1 ? 'units' : 'unit'); ?></td>
					</tr>
				</table>
			</div>
			<?php
			$useragent=$_SERVER['HTTP_USER_AGENT']; 
			if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
			?>
			<div class="card">
				<h4>Schedule</h4>
				<table class="list" id="tableListFacultySchedule">
					<?php
					$days = array("M", "T", "W", "H", "F");

					foreach($days as $day) {
					?>
					<tr class="title">
						<td width="1px">
						</td>
						<td colspan="2"><?php echo $oes->getFullDayName($day); ?></td>
					</tr>
					<?php
						$schedule = $oes->getData("Schedule", "*", "FacultyID = '$faculty' AND Day = '".$day."' ORDER BY StartTime ASC");
						if(!empty($schedule)) {
							foreach($schedule as $s) {
					?>
					<tr>
						<td>
							<label class="checkData" id="chk_<?php echo $s["ID"]; ?>"><input type="checkbox" value="<?php echo $s["ID"]; ?>"><span></span></label>
						</td>
						<td class="primary">
							<span><?php echo ($s["SubjectID"] == null ? $s["Break"] : $oes->getSingleData("Subject", "Name", "ID = '".$s["SubjectID"]."'")); ?></span>
							<span><?php echo date('g:i a', strtotime($s["StartTime"])).' - '.date('g:i a', strtotime($s["EndTime"])); ?></span>
						</td>
						<td>
							<ul class="button-container">
								<li>
									<a id="btnInfo_<?php echo $s["ID"]; ?>" class="flat_icon_20 ic_info_outline showhover"></a>
									<a id="btnDelete_<?php echo $s["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
								</li>
							</ul>
						</td>
					</tr>
					<script>
					$(document).ready(function() {
						$("#btnInfo_<?php echo $s["ID"]; ?>").click(function() {
							showDialogBox('infofacultyschedule', '<?php echo $s["ID"]; ?>');
						});
						$("#btnDelete_<?php echo $s["ID"]; ?>").click(function() {
							showDialogBox('deletefacultyschedule', '<?php echo $s["ID"]; ?>');
						});
					});
					</script>
					<?php
							}
						} else {
					?>
					<tr>
						<td></td>
						<td colspan="2"><center><small><i>No schedule assigned in this day.</i></small></center></td>
					</tr>
					<?php
						}
					}
					scriptCheckedData("#tableListFacultySchedule");
					?>
				</table>
			</div>
			<script>
			$.ajax({
				type: "post",
				cache: true,
				url: "process.php?action=getdataaction",
				data: {module: "facultyschedule"},
				success: function(html) {
					$("#data-action-bar #actions").html(html)
				}
			});
			</script>
		<?php
			} else {
		?>
			<div class="card">
				<h4>Schedule</h4>
				<table class="list schedule">
					<tr class="title">
						<td class="hide"></td>
						<td>Time</td>
						<td align="center">M</td>
						<td align="center">T</td>
						<td align="center">W</td>
						<td align="center">H</td>
						<td align="center">F</td>
					</tr>
					<?php
					$time = array("07:30", "08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30");
					$day = array("M", "T", "W", "H", "F");
					$colors = array("de8282", "de82d9", "8682de", "82b8de", "82dedb", "82deb6", "afde82", "dbde82", "deb882");
					$rooms = array();
					for($i = 0; $i < sizeof($time)-1; $i++) {
						echo '<tr>
							<td class="hide"></td>
							<td>'.date("g:i a", strtotime($time[$i].":00"))." - ".date("g:i a", strtotime($time[$i+1].":00")).'</td>';
						for($j = 0; $j < sizeof($day); $j++) {
							$sched = $oes->getRow("Schedule", "*", "FacultyID = '".$faculty."' AND StartTime = '".$time[$i].":00' AND Day = '".$day[$j]."'"); 
							if(!empty($sched)) {
								$sectiondata = $oes->getRow("GLS", "*", "ID = '".$sched["SectionID"]."'");
								$step = 0;
								while($sched["EndTime"] != $time[$i+$step].":00") {
									$step++;
								}
								if($sched["Break"] == "") {
									while(true) {
										$randomcolor = rand(0, sizeof($colors)-1);
										if(!in_array($colors[$randomcolor], $rooms)) {
											if(!isset($rooms[$sectiondata["ID"]]))
												$rooms[$sectiondata["ID"]] = $colors[$randomcolor];
											break;
										}
									}
									echo '<td rowspan="'.$step.'" align="center" style="color: white;background-color: #'.$rooms[$sectiondata["ID"]].';">'.$oes->getSingleData("Subject", "Code", "ID = '".$sched["SubjectID"]."'").'</td>';
								} else
									echo '<td rowspan="'.$step.'" align="center">'.$sched["Break"].'</td>';
							} else {
								$check = $oes->getData("Schedule", "*", "FacultyID = '".$faculty."' AND Day = '".$day[$j]."' AND ('".$time[$i]."' >= StartTime AND '".$time[$i]."' < EndTime)");
								if(sizeof($check) == 0) {
									echo "<td></td>";
								}
							}
						}
						echo '</tr>';
					}
					?>
				</table><br>
				<?php
				foreach($rooms as $sectionid => $color) {
					$sectiondata = $oes->getRow("GLS", "*", "ID = '$sectionid'");
					$roomdata = $oes->getRow("Room", "*", "ID = '".$sectiondata["RoomID"]."'");
					$buildingdata = $oes->getRow("Building", "*", "ID = '".$roomdata["BuildingID"]."'");
					echo '<span class="colorbox" style="background: #'.$color.';"></span>Grade '.$sectiondata["GradeLevel"].$sectiondata["Section"].' ('.$buildingdata["Name"].' - Room '.$roomdata["Name"].')';
				}
				?>
			</div>
		<?php
			}
		}
	} elseif($action == "enrollee_assessment") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$paymentterm = $oes->getSingleData("Assessment", "PaymentTerm", "ID = '$id'");
			?>
			<div class="card">
				<h4>Assessment for <?php echo $oes->getNameFormat("f l", $id); ?></h4>
				<?php
				$ptstr = $oes->getSingleData("PaymentTerm", "PaymentTerm", "ID = '$paymentterm'");
				if($paymentterm != "") {
				 echo '<p>Payment Term: '.$ptstr.'</p>';
				}
				?>
				<table class="list">
					<tr class="title">
						<td class="hide"></td>
						<td>Account</td>
						<td align="right">Fee</td>
					</tr>
					<?php
					$gl = $oes->getSingleData("Student", "GradeLevel", "ID = '$id'");
					$breakdown = $oes->getData("Breakdown", "*", "GradeLevel = '$gl'");
					$total = $oes->getTuitionFee($id);
					foreach($breakdown as $b) {
					?>
					<tr>
						<td class="hide"></td>
						<td><?php echo $b["Title"]; ?></td>
						<td align="right">Php <?php echo number_format($b["Price"], 3, ".", ","); ?></td>
					</tr>
					<?php
					}
					?>
					<tr>
						<td class="hide"></td>
						<td><b>Sub-Total:</b></td>
						<td align="right">Php <?php echo number_format($total, 3, ".", ","); ?></td>
					</tr>
					<?php
					if($paymentterm != "") {
						$fee = $oes->getSingleData("PaymentTerm", "Fee", "ID = '$paymentterm'");
						if($fee >= 0) {
					?>
					<tr>
						<td class="hide"></td>
						<td>Additional Fee</td>
						<td align="right">Php <?php echo number_format($fee, 3, ".", ","); ?></td>
					</tr>
					<?php
						} else {
					?>
					<tr>
						<td class="hide"></td>
						<td>Rebate</td>
						<td align="right">Php <?php echo number_format($fee, 3, ".", ","); ?></td>
					</tr>
					<?php
						}
					?>
					<tr>
						<td class="hide"></td>
						<td><b>TOTAL:</b></td>
						<td align="right">Php <?php echo number_format($total+$fee, 3, ".", ","); ?></td>
					</tr>
					<?php
					}
					?>
				</table>
			</div>
			<?php
			if($paymentterm != "") {
			?>
			<div class="card">
				<h4>Payment Status</h4>
				<table class="list">
					<?php
					$sy = $oes->getSchoolYear();
					if($ptstr == "Monthly Installment") 
						$months = array($sy."-08-01", $sy."-09-01", $sy."-10-01", $sy."-11-01", $sy."-12-01", ($sy+1)."-01-01", ($sy+1)."-02-01", ($sy+1)."-03-01", ($sy+1)."-04-01");
					elseif($ptstr == "Quarterly Installment") 
						$months = array($sy."-09-01", $sy."-12-01", ($sy+1)."-03-01");
					elseif($ptstr == "Semi-annually Installment")
						$months = array($sy."-12-01");
					?>
					<tr>
						<td width="1px">
						<?php 
						$paid = $oes->getData("Transaction", "*", "StudentID = '$id' AND ApplicableMonth = 'Upon Enrollment'");
						if(!empty($paid)) {
						?>
						<span class="flat_icon ic_done"></span>
						<?php
						}
						?>
						</td>
						<td>Upon Enrollment</td>
						<td align="right">Php <?php echo number_format($oes->getSingleData("Assessment", "Installment", "ID = '$id'"), 3); ?></td>
					</tr>
					<?php
					if($ptstr != "Full Payment") {
						foreach($months as $month) {
					?>
					<tr>
						<td width="1px">
						<?php 
						$paid = $oes->getData("Transaction", "*", "StudentID = '$id' AND ApplicableMonth = '$month'");
						if(!empty($paid)) {
						?>
						<span class="flat_icon ic_done"></span>
						<?php
						}
						?>
						</td>
						<td><?php echo date("F Y", strtotime($month)); ?></td>
						<td align="right">Php <?php echo number_format($oes->getSingleData("Assessment", "Installment", "ID = '$id'"), 3); ?></td>
					</tr>
					<?php
						}
					}
					?>
				</table>
				<h4>Outstanding Balance</h4>
				<table class="list">
					<tr>
						<td class="hide"></td>
						<td>Total Tuition</td>
						<td align="right">Php <?php echo number_format($total+$fee, 3, ".", ","); ?></td>
					</tr>
					<?php
					$surcharges = $oes->getData("Surcharge", "*", "StudentID = '$id'");
					if(!empty($surcharges)) {
						foreach($surcharges as $s) {
					?>
					<tr>
						<td class="hide"></td>
						<td>Surcharge (<?php echo date("F d, Y", strtotime($s["DateCharge"])); ?>)</td>
						<td align="right">Php <?php echo number_format($s["Amount"], 3, ".", ","); ?></td>
					</tr>
					<?php
						}
					}
					?>
					<tr>
						<td class="hide"></td>
						<td>Credit</td>
						<td align="right">Php (<?php echo number_format($oes->getTotalCredit($id), 3); ?>)</td>
					</tr>
					<tr>
						<td class="hide"></td>
						<td>Balance</td>
						<td align="right">Php <?php echo $totalbalance = number_format($oes->getSingleData("Assessment", "Balance", "ID = '$id'"), 3); ?></td>
					</tr>
				</table><br>
				<ul class="button-container right">
					<?php
					$creditcard = $oes->getData("CreditCard", "*", "ID = '$id'");
					if(!empty($creditcard) && $totalbalance > 0) {
					?>
					<li><a onclick="showBottomSheet('paywithcard', '<?php echo $id; ?>');" class="raised_button">Pay with credit card</a></li>
					<?php
					}
					?>
				</ul>
			</div>
			<?php
			}
			?>
	<?php
		}
	} elseif($action == "checkpaymentterm") {
		if(isset($_POST['id'], $_POST['pt'])) {
			$id = $_POST['id'];
			$pt = $_POST['pt'];
			$gl = $oes->getSingleData("Student", "GradeLevel", "ID = '$id'");
			$tuition = $oes->getTuitionFee($id);
			$fee = $oes->getSingleData("PaymentTerm", "Fee", "GradeLevel = '$gl' AND PaymentTerm = '$pt'");
			$total = $tuition + $fee;
			?>
			<tr class="title">
				<td class="hide"></td>
				<td>Account</td>
				<td align="right">Amount</td>
			</tr>
			<tr>
				<td class="hide"></td>
				<td>Sub-total</td>
				<td align="right">Php <?php echo number_format($tuition, 3); ?></td>
			</tr>
			<tr>
				<td class="hide"></td>
				<td><?php echo ($fee > 0 ? 'Additional Fee':'Rebate'); ?></td>
				<td align="right">Php <?php echo ($fee < 0 ? '('.number_format(0-$fee, 3).')': number_format($fee, 3)); ?></td>
			</tr>
			<tr>
				<td class="hide"></td>
				<td>Total</td>
				<td align="right">Php <?php echo number_format($total, 3); ?></td>
			</tr>
			<tr class="title">
				<td class="hide"></td>
				<td>Payment Schedule</td>
				<td align="right">Amount</td>
			</tr>
			<?php
			$sy = $oes->getSchoolYear();
			if($pt == "Full Payment") {
				$installment = $total;
				$months = array();
			} elseif($pt == "Monthly Installment") {
				$installment = $total/10;
				$months = array($sy."-08-01", $sy."-09-01", $sy."-10-01", $sy."-11-01", $sy."-12-01", ($sy+1)."-01-01", ($sy+1)."-02-01", ($sy+1)."-03-01", ($sy+1)."-04-01");
			} elseif($pt == "Quarterly Installment") {
				$installment = $total/4;
				$months = array($sy."-09-01", $sy."-12-01", ($sy+1)."-03-01");
			} elseif($pt == "Semi-annually Installment") {
				$installment = $total/2;
				$months = array($sy."-12-01");
			}
			?>
			<tr>
				<td class="hide"></td>
				<td>Upon Enrollment</td>
				<td align="right">Php <?php echo number_format($installment, 3); ?></td>
			</tr>
			<?php
			foreach($months as $month) {
			?>
			<tr>
				<td class="hide"></td>
				<td><?php echo date("F Y", strtotime($month)); ?></td>
				<td align="right">Php <?php echo number_format($installment, 3); ?></td>
			</tr>
			<?php
			}
		}
	} elseif($action == "liststudentforgrades") {
		if(isset($_POST['section'], $_POST['subject'])) {
			$section = $_POST['section'];
			$subject = $_POST['subject'];
	?>
		<div class="card" id="card-grades">
			<a id="btnEncodeGrades" class="float_button pos_top_right ic_excel_white icon_medium"></a>
			<h4>Grade <?php echo $oes->getSingleData("GLS", "GradeLevel", "ID = '$section'").$oes->getSingleData("GLS", "Section", "ID = '$section'"); ?> - <?php echo $oes->getSingleData("Subject", "Name", "ID = '$subject'"); ?> Class</h4>
			<select name="quarter">
				<option value="1">First Quarter</option>
				<option value="2">Second Quarter</option>
				<option value="3">Third Quarter</option>
				<option value="4">Fourth Quarter</option>
				<option value="average">Average</option>
			</select>
			<script>
			$(document).ready(function() {
				$("#card-grades #btnEncodeGrades").click(function() {
					$q = $("#card-grades select[name=quarter]").val();
					showBottomSheet('encodegrades', ['<?php echo $section; ?>', '<?php echo $subject; ?>', $q]);
				})
			})
			</script>
			<br>
			<br>
			<table class="list" id="tableListStudents">
				
			</table>
			<script>
			function refreshStudentList($q) {
				$("#lstGrades #tableListStudents").html('<tr><td><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></td></tr>');
				$.ajax({
					type: "post",
					cache: true,
					url: "process.php?action=liststudentforgrades1",
					data: {section: '<?php echo $section; ?>', subject: '<?php echo $subject; ?>', quarter: $q},
					success: function(html) {
						$("#lstGrades #tableListStudents").html(html);
					}
				})
			}
			$(document).ready(function() {
				refreshStudentList(1);
				$("#lstGrades select[name=quarter]").change(function() {
					refreshStudentList($(this).val());
				});
			})
			</script><br>
			<ul class="button-container block">
				<li><a href="paper.php?grade&gl=<?php echo $section; ?>&subject=<?php echo $subject; ?>" target="_blank" class="raised_button">Generate Report</a></li>
			</ul>
		</div>
	<?php
		}
	} elseif($action == "liststudentforgrades1") {
		if(isset($_POST['section'], $_POST['subject'], $_POST['quarter'])) {
			$section = $_POST['section'];
			$subject = $_POST['subject'];
			$quarter = $_POST['quarter'];
			if($quarter == "average") {
			?>
				<tr class="title">
					<td class="hide"></td>
					<td class="hideinmobile">Student No.</td>
					<td>Name</td>
					<td width="1px">Average</td>
				</tr>
			<?php
			} else {
			?>
				<tr class="title">
					<td class="hide"></td>
					<td class="hideinmobile">Student No.</td>
					<td>Name</td>
					<td width="1px">Grade</td>
					<td width="1px"></td>
				</tr>
			<?php
			}
			$sy = $oes->getSchoolYear();
			$students = $oes->getData("Account INNER JOIN Student", "*", "Account.ID = Student.ID AND Account.Type = 'Student' AND Student.GLS = '$section' ORDER BY LastName");
			foreach($students as $student) {
				if($quarter == "average") {
			?>
				<tr>
					<td class="hide"></td>
					<td class="hideinmobile"><?php echo $student["ID"]; ?></td>
					<td><?php echo $oes->getNameFormat("l, f M.", $student["ID"]); ?></td>
					<td><?php 
					$grades = $oes->getData("Grade", "*", "SchoolYear = '$sy' AND StudentID = '".$student["ID"]."' AND SubjectID = '$subject'");
					$avg = 0;
					$num = 0;
					foreach($grades as $grade) {
						if($grade["Grade"] >= 0 && $grade["Grade"] <= 100) {
							$avg += $grade["Grade"];
							$num++;
						}

					}
					if($num == 4)
						echo number_format($avg/4,2);
					else
						echo "N/A";
					?></td>
				</tr>
			<?php
				} else {
			?>
				<tr>
					<td class="hide"></td>
					<td class="hideinmobile"><?php echo $student["ID"]; ?></td>
					<td><?php echo $oes->getNameFormat("l, f M.", $student["ID"]); ?></td>
					<td><?php 
					$grade = $oes->getSingleData("Grade", "Grade", "SchoolYear = '$sy' AND Quarter = '$quarter' AND StudentID = '".$student["ID"]."' AND SubjectID = '$subject'");
					if($grade == "")
						echo "N/A";
					else
						echo $grade;
					?></td>
					<td>
						<?php
						if($quarter == 1) $qstr = "FirstQuarter";
						elseif($quarter == 2) $qstr = "SecondQuarter";
						elseif($quarter == 3) $qstr = "ThirdQuarter";
						elseif($quarter == 4) $qstr = "FourthQuarter";
						$sy = $oes->getSchoolYear();
						$qstatus = $oes->getSingleData("Administration", $qstr, "SchoolYear = '$sy'");
						if($qstatus == 1) {
						?>
						<ul class="button-container">
							<li><a id="btnEdit_<?php echo $student["ID"]; ?>" class="flat_icon_20 ic_pencil showhover"></a></li>
						</ul>
						<?php
						}
						?>
					</td>
				</tr>
				<script>
				$(document).ready(function() {
					$("#tableListStudents #btnEdit_<?php echo $student["ID"]; ?>").click(function() {
						showBottomSheet('editgrade', ['<?php echo $student["ID"]; ?>', '<?php echo $subject; ?>', '<?php echo $quarter; ?>']);
					});
				});
				</script>
			<?php
				}
			}
		}
	} elseif($action == "listclasslist") {
		if(isset($_POST['section'], $_POST['subject'])) {
			$section = $_POST['section'];
			$subject = $_POST['subject'];
	?>
		<div class="card" id="card-grades">
			<h4>Grade <?php echo $oes->getSingleData("GLS", "GradeLevel", "ID = '$section'").$oes->getSingleData("GLS", "Section", "ID = '$section'"); ?> - <?php echo $oes->getSingleData("Subject", "Name", "ID = '$subject'"); ?> Class</h4>
			<table class="list" id="tableListStudents">
				
			</table>
			<script>
			function refreshStudentList($q) {
				$("#lstClassList #tableListStudents").html('<tr><td><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></td></tr>');
				$.ajax({
					type: "post",
					cache: true,
					url: "process.php?action=listclasslist1",
					data: {section: '<?php echo $section; ?>', subject: '<?php echo $subject; ?>'},
					success: function(html) {
						$("#lstClassList #tableListStudents").html(html);
					}
				})
			}
			$(document).ready(function() {
				refreshStudentList(1);
				$("#lstGrades select[name=quarter]").change(function() {
					refreshStudentList($(this).val());
				});
			})
			</script><br>
		</div>
	<?php
		}
	} elseif($action == "listclasslist1") {
		if(isset($_POST['section'], $_POST['subject'])) {
			$section = $_POST['section'];
			$subject = $_POST['subject'];
			?>
				<tr class="title">
					<td class="hide"></td>
					<td class="hideinmobile">Student No.</td>
					<td>Name</td>
				</tr>
			<?php
			$sy = $oes->getSchoolYear();
			$students = $oes->getData("Account INNER JOIN Student", "*", "Account.ID = Student.ID AND Account.Type = 'Student' AND Student.GLS = '$section' ORDER BY LastName");
			foreach($students as $student) {
			?>
				<tr>
					<td class="hide"></td>
					<td class="hideinmobile"><?php echo $student["ID"]; ?></td>
					<td><?php echo $oes->getNameFormat("l, f M.", $student["ID"]); ?></td>
				</tr>
			<?php
			}
		}
	} elseif($action == "editgrade") {
		if(isset($_POST['student'], $_POST['quarter'], $_POST['subject'], $_POST['grade'])) {
			$student = $_POST['student'];
			$quarter = $_POST['quarter'];
			$subject = $_POST['subject'];
			$grade = $_POST['grade'];
			$sy = $oes->getSchoolYear();
			$exists = $oes->isExists("Grade", array("StudentID", "SchoolYear", "Quarter", "SubjectID"), array($student, $sy, $quarter, $subject));
			if($grade == "") {
				if($exists) 
					mysql_query("UPDATE Grade SET Grade = NULL WHERE StudentID = '$student' AND Quarter = '$quarter' AND SubjectID = '$subject' AND SchoolYear = '$sy'");
				else
					mysql_query("INSERT INTO Grade (SchoolYear, Quarter, StudentID, SubjectID, Grade) VALUES ('$sy', '$quarter', '$student', '$subject', NULL)");
				hideElements();
				showSnackbarMsg("Grade updated");
			} else {
				if(is_numeric($grade)) {
					if($grade >= 0 && $grade <= 100) {
						if($exists) 
							mysql_query("UPDATE Grade SET Grade = '$grade' WHERE StudentID = '$student' AND Quarter = '$quarter' AND SubjectID = '$subject' AND SchoolYear = '$sy'");
						else
							mysql_query("INSERT INTO Grade (SchoolYear, Quarter, StudentID, SubjectID, Grade) VALUES ('$sy', '$quarter', '$student', '$subject', '$grade')");
						if($quarter == 1)
							$qstr = "first quarter";
						elseif($quarter == 2)
							$qstr = "second quarter";
						elseif($quarter == 3)
							$qstr = "third quarter";
						elseif($quarter == 4)
							$qstr = "fourth quarter";
						$oes->addFeed($student, "Grade", "You have a grade in your ".$oes->getSingleData("Subject", "Name", "ID = '$subject'")." subject for the $qstr of school year $sy - ".($sy+1).".");
						hideElements();
						showSnackbarMsg("Grade updated");
					} else
						showSnackbarMsg("Invalid input");
				} else 
					showSnackbarMsg("Invalid input");
			}
		}
	} elseif($action == "encodegrades") {
		if(isset($_POST['submit'], $_POST['section'], $_POST['subject'], $_POST['quarter'])) {
			$section = $_POST['section'];
			$subject = $_POST['subject'];
			$quarter = $_POST['quarter'];
			$sy = $oes->getSchoolYear();

			$h = $oes->generateHash(10);
			$import = $_FILES['import'];
			$directory = "resources/excels/";
			$filename = substr(basename($import["name"]), 0, 0-strlen(pathinfo(basename($import["name"]), PATHINFO_EXTENSION))-1).'_'.$h.'.'.pathinfo(basename($import["name"]), PATHINFO_EXTENSION);
			move_uploaded_file($import["tmp_name"], $directory.$filename);
			

			$excel->setOutputEncoding('CP1251');
			$excel->read($directory.$filename);

			$columns = array();
			$data = array();
			for ($i = 1; $i <= $excel->sheets[0]['numRows']; $i++) {
				for ($j = 1; $j <= $excel->sheets[0]['numCols']; $j++) {
					if($i == 1) {
						$columns[] = $excel->sheets[0]['cells'][$i][$j];
					} else {
						$data[$i-1][$columns[$j-1]] = $excel->sheets[0]['cells'][$i][$j];
					}
				}
			}
			foreach($data as $d) {
				if(isset($d["StudentID"], $d["Grade"])) {
					$student = $d["StudentID"];
					$grade = $d["Grade"];
					$check = $oes->getNum("Account INNER JOIN Student", "Account.ID = Student.ID AND Account.Type = 'Student' AND Account.ID = '".$d["StudentID"]."' AND GLS = '$section' AND Account.Status = 'Active'");
					$exists = $oes->isExists("Grade", array("StudentID", "SchoolYear", "Quarter", "SubjectID"), array($d["StudentID"], $sy, $quarter, $subject));
					if($check > 0) {
						if($grade == "") {
							if($exists) 
								mysql_query("UPDATE Grade SET Grade = NULL WHERE StudentID = '$student' AND Quarter = '$quarter' AND SubjectID = '$subject' AND SchoolYear = '$sy'");
							else
								mysql_query("INSERT INTO Grade (SchoolYear, Quarter, StudentID, SubjectID, Grade) VALUES ('$sy', '$quarter', '$student', '$subject', NULL)");
						} else {
							if(is_numeric($grade)) {
								if($grade >= 0 && $grade <= 100) {
									if($exists) 
										mysql_query("UPDATE Grade SET Grade = '$grade' WHERE StudentID = '$student' AND Quarter = '$quarter' AND SubjectID = '$subject' AND SchoolYear = '$sy'");
									else
										mysql_query("INSERT INTO Grade (SchoolYear, Quarter, StudentID, SubjectID, Grade) VALUES ('$sy', '$quarter', '$student', '$subject', '$grade')");
									if($quarter == 1)
										$qstr = "first quarter";
									elseif($quarter == 2)
										$qstr = "second quarter";
									elseif($quarter == 3)
										$qstr = "third quarter";
									elseif($quarter == 4)
										$qstr = "fourth quarter";
									$oes->addFeed($student, "Grade", "You have a grade in your ".$oes->getSingleData("Subject", "Name", "ID = '$subject'")." subject for the $qstr of school year $sy - ".($sy+1).".");
								}
							}
						}
					}
				} 
			}
			header("Location: index.php?grades");
		}
	} elseif($action == "dismissfeed") {
		if(isset($_POST['id'], $_POST['feed'])) {
			$id = $_POST['id'];
			$feed = $_POST['feed'];
			mysql_query("UPDATE Feed SET Dismiss = '1' WHERE ID = '$feed'");
			$feeds = $oes->getData("Feed", "*", "AccountID = '$id' AND Dismiss = '0'");
			if(empty($feeds)) {
			?>
			<script>showCard('feeddone');</script>
			<?php
			}
		}
	} elseif($action == "viewallfeed") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$feeds = $oes->getData("Feed", "*", "AccountID = '$id' ORDER BY ID DESC");
			foreach($feeds as $feed) {
			?>
				<div class="card" id="card-feed_<?php echo $feed["ID"]; ?>">
					<table class="feed">
						<tr>
							<td><?php echo $feed["Title"]; ?></td>
							<td><?php echo date("M j, Y", strtotime($feed["DatePosted"])); ?></td>
						</tr>
						<tr>
							<td colspan="2"><?php echo $feed["Message"]; ?></td>
						</tr>
					</table>
				</div>
			<?php
			}
			if(empty($feeds)) {
			?>
				<div class="card">
					<h4>Message</h4>
					<p>You have no previous cards.</p>
				</div>
			<?php
			}
			?>
			<div class="card button-container compact">
				<ul class="button-container block">
					<li><a id="btnViewPreviousCards" class="flat_button"><span class="flat_icon ic_visibility"></span>View Recent Cards</a></li>
				</ul>
				<script>
				$(document).ready(function() {
					$("#btnViewPreviousCards").click(function() {
						$.ajax({
							type: "post",
							cache: false,
							url: "process.php?action=viewrecentfeed",
							data: {id: '<?php echo $id; ?>'},
							success: function(html) {
								$("#lstFeed").html(html);
							}
						});
					})
				})
				</script>
			</div>
			<?php
		}
	} elseif($action == "viewrecentfeed") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$feeds = $oes->getData("Feed", "*", "AccountID = '$id' AND Dismiss = '0' ORDER BY ID DESC");
			foreach($feeds as $feed) {
			?>
				<div class="card" id="card-feed_<?php echo $feed["ID"]; ?>">
					<table class="feed">
						<tr>
							<td><?php echo $feed["Title"]; ?></td>
							<td><?php echo date("M j, Y", strtotime($feed["DatePosted"])); ?></td>
						</tr>
						<tr>
							<td colspan="2"><?php echo $feed["Message"]; ?></td>
						</tr>
					</table>
					<ul class="button-container right">
						<li><a id="btnDismiss_<?php echo $feed["ID"]; ?>" class="flat_button"><span class="flat_icon ic_done"></span>Dismiss</a></li>
					</ul>
				</div>
				<script>
				$(document).ready(function() {
					dismissCard('feeddone', 'fast');
					$("#lstFeed #card-feed_<?php echo $feed["ID"]; ?> #btnDismiss_<?php echo $feed["ID"]; ?>").click(function() {
						dismissCard("feed_<?php echo $feed["ID"]; ?>", "swipe-left");
						$.ajax({
							type: "post",
							cache: true,
							url: "process.php?action=dismissfeed",
							data: {id: '<?php echo $_SESSION['loggedID']; ?>', feed: '<?php echo $feed["ID"]; ?>'},
							success: function(html) {
								$("#snackbar .wrapper").html(html);
							}
						})
					});
				});
				</script>
			<?php
			}
			if(empty($feeds)) {
			?>
			<div class="card">
				<h4>Done!</h4>
				<p>You're all done! Nothing to see here now.</p>
			</div>
			<?php
			} else {
			?>
			<div class="card" id="card-feeddone">
				<h4>Done!</h4>
				<p>You're all done! Nothing to see here now.</p>
			</div>
			<?php
			}
			?>
			<div class="card button-container compact">
				<ul class="button-container block">
					<li><a id="btnViewPreviousCards" class="flat_button"><span class="flat_icon ic_visibility"></span>View Previous Cards</a></li>
				</ul>
				<script>
				$(document).ready(function() {
					$("#btnViewPreviousCards").click(function() {
						$.ajax({
							type: "post",
							cache: false,
							url: "process.php?action=viewallfeed",
							data: {id: '<?php echo $id; ?>'},
							success: function(html) {
								$("#lstFeed").html(html);
							}
						});
					})
				})
				</script>
			</div>
		<?php
		}
	} elseif($action == "forgotpassword") {
		if(isset($_POST['email'])) {
			$email = $_POST['email'];
			$student = $oes->getRow("Student", "*", "Email = '$email'");
			if(!empty($student)) {
				$hash = $oes->generateHash(20);
				mysql_query("DELETE FROM ResetPassword WHERE AccountID = '".$student["ID"]."'");
				mysql_query("INSERT INTO ResetPassword (Hash, AccountID) VALUES ('$hash', '".$student["ID"]."')");
				$message = "Hello, ".$oes->getNameFormat("f",$student["ID"])."!<br><br>We've heard you lost/forgot your password. We can reset it for you! Just click or copy and paste the link below:<br><br>http://oes.juvarabrera.com/changepassword.php?h=$hash";
				$oes->sendEmail($student["ID"], "Forgot Password", $message);
				header("Location: forgotpassword.php?sent");
			} else {
				header("Location: forgotpassword.php?error");
			}
		} else {
			header("Location: forgotpassword.php?error");
		}
	} elseif($action == "changepassword1") {
		if(isset($_POST['pass'], $_POST['hash'])) {
			$pass = $_POST['pass'];
			$hash = $_POST['hash'];
			$id = $oes->getSingleData("ResetPassword", "AccountID", "Hash = '$hash'");
			mysql_query("UPDATE Account SET Password = '$pass' WHERE ID = '$id'");
			mysql_query("DELETE FROM ResetPassword WHERE Hash = '$hash'");
		} else
			header("Location: index.php");
	} elseif($action == "viewreport") {
		if(isset($_POST['report'], $_POST['get'])) {
			$date = date("F d, Y");
			$time = date("h:i a");
			$report = $_POST['report'];

			?>
			<div class="header right"><?php echo $date.' - '.$time; ?></div>
			<div class="content">
				<span class="title"><?php echo $report; ?></span><hr><br>
			<?php
			if($report == "Examinees Report") {
				$reportTitle = $report;
				$get = $_POST['get'];
				$landscape = false;
				if(isset($get['admission'], $get['max'])) {
					?>
					<?php echo date("F d, Y", strtotime($oes->getSingleData("Admission", "ScheduleDate", "ID = '".$get['admission']."'"))).' - '.date("g:i a", strtotime($oes->getSingleData("Admission", "ScheduleTime", "ID = '".$get['admission']."'")));?>
					<br><br>
					<?php
					$data = $oes->getData("Enrollee INNER JOIN Student INNER JOIN Account", "*", "Account.ID = Student.ID AND Enrollee.ID = Student.ID AND Enrollee.EnrollmentStatus = 'Pending' AND Enrollee.AdmissionID = '".$get['admission']."' AND Account.Status = 'Active'");
					$rooms = $oes->getData("Room", "*", "1=1");
					$currentRoom = -1;
					$num = $get['max'];
					$count = 0;
					$tmale = 0;
					$tfemale = 0;
					$male = 0;
					$female = 0;
					foreach($data as $d) {
						$count++;
						if($num == $get['max']) {
							$num = 0;
							$male = 0;
							$female = 0;
							$currentRoom++;
							echo "<b>".$oes->getSingleData("Building", "Code", "ID = '".$rooms[$currentRoom]["BuildingID"]."'").' - Room '.$rooms[$currentRoom]["Name"]."</b><br><br>";
						?>
						<table class="report">
							<tr class="title">
								<td>Permit Code</td>
								<td>Name</td>
							</tr>
						<?php
						}
						if($d["Gender"] == "Male") 
							$male++;
						elseif($d["Gender"] == "Female")
							$female++;
						?>
						<tr>
							<td>DLSUDHS<?php echo $d["Username"]; ?></td>
							<td><?php echo $oes->getNameFormat("l, f M.", $d["ID"]); ?></td>
						</tr>
						<?php
						$num++;
						if($num == $get['max'] || $count == sizeof($data)) {
							$tmale += $male;
							$tfemale += $female;
							echo '</table><p align="right">Male: '.$male.' | Female: '.$female.' | Total: '.$num.'</p><br><br>';
						}
					}
					echo 'Total Male: '.$tmale.'<br>Total Female: '.$tfemale.'<br>Overall Total: '.$count;
				}
				?>
			<?php
			} elseif($report == "Interviewees Report") {
				$reportTitle = $report;
				$get = $_POST['get'];
				$landscape = false;
				if(isset($get['admission'], $get['gl'])) {
					?>
					<textarea class="resize"><?php echo date("F d, Y", strtotime($oes->getSingleData("Admission", "ScheduleDate", "ID = '".$get['admission']."'"))).' - '.date("g:i a", strtotime($oes->getSingleData("Admission", "ScheduleTime", "ID = '".$get['admission']."'")));?></textarea>
					<?php
					$additional = "";
					if($get['gl'] != "all") 
						$additional = " AND Student.GradeLevel = '".$get['gl']."'";
					$data = $oes->getData("Enrollee INNER JOIN Student INNER JOIN Account", "*", "Account.ID = Student.ID AND Enrollee.ID = Student.ID AND Enrollee.EnrollmentStatus = 'Pending' AND Enrollee.AdmissionID = '".$get['admission']."' AND Account.Status = 'Active'$additional");
					?>
					<table class="report">
						<tr class="title">
							<td>Permit Code</td>
							<td>Name</td>
							<td>Grade Level</td>
						</tr>
					<?php
					$tmale = 0;
					$tfemale = 0;
					$tg8 = 0;
					$tg9 = 0;
					$tg10 = 0;
					foreach($data as $d) {
						if($d["Gender"] == "Male")
							$tmale++;
						elseif($d["Gender"] == "Female")
							$tfemale++;
						if($d["GradeLevel"] == "8")
							$tg8++;
						elseif($d["GradeLevel"] == "9")
							$tg9++;
						elseif($d["GradeLevel"] == "10")
							$tg10++;
						?>
						<tr>
							<td>DLSUDHS<?php echo $d["Username"]; ?></td>
							<td><?php echo $oes->getNameFormat("l, f M.", $d["ID"]); ?></td>
							<td>Grade <?php echo $d["GradeLevel"]; ?></td>
						</tr>
						<?php
					}
					?>
					</table><br><br>
					<?php
					$count = $tmale + $tfemale;
					echo 'Grade 8: '.$tg8.'<br>Grade 9: '.$tg9.'<br>Grade 10: '.$tg10.'<br><br>';
					echo 'Total Male: '.$tmale.'<br>Total Female: '.$tfemale.'<br>Overall Total: '.$count;
				}
			} elseif($report == "Passers Report") {
				$reportTitle = $report;
				$get = $_POST['get'];
				$landscape = false;
			?>
				<table class="report">
					<tr class="title">
						<td>Code</td>
						<td>Name</td>
						<td>Grade Level</td>
						<td>Admission Date</td>
					</tr>
					<?php
					if(isset($get['gl'])) {
						$additional = "";
						if($get['gl'] != "all") 
							$additional = " AND Student.GradeLevel = '".$get['gl']."'";
						$data = $oes->getData("Enrollee INNER JOIN Student INNER JOIN Account", "*", "Account.ID = Student.ID AND Enrollee.ID = Student.ID AND Enrollee.AdmissionID IS NOT NULL AND Enrollee.EnrollmentStatus = 'Passed' AND Account.Type = 'Enrollee' AND Account.Status = 'Active'$additional");
						$tmale = 0;
						$tfemale = 0;
						$tg7 = 0;
						$tg8 = 0;
						$tg9 = 0;
						$tg10 = 0;
						foreach($data as $d) {
							if($d["Gender"] == "Male")
								$tmale++;
							elseif($d["Gender"] == "Female")
								$tfemale++;
							if($d["GradeLevel"] == "7")
								$tg7++;
							elseif($d["GradeLevel"] == "8")
								$tg8++;
							elseif($d["GradeLevel"] == "9")
								$tg9++;
							elseif($d["GradeLevel"] == "10")
								$tg10++;
						?>
						<tr>
							<td>DLSUDHS<?php echo $d["Username"]; ?></td>
							<td><?php echo $oes->getNameFormat("l, f M.", $d["ID"]); ?></td>
							<td>Grade <?php echo $d["GradeLevel"]; ?></td>
							<td><?php echo date("m-d-Y", strtotime($oes->getSingleData("Admission", "ScheduleDate", "ID = '".$d["AdmissionID"]."'"))); ?> - <?php echo date("g:i a", strtotime($oes->getSingleData("Admission", "ScheduleTime", "ID = '".$d["AdmissionID"]."'"))); ?></td>
						</tr>
						<?php
						}
					}
					?>
				</table><br>
			<?php
				$count = $tmale + $tfemale;
				echo 'Grade 7: '.$tg7.'<br>Grade 8: '.$tg8.'<br>Grade 9: '.$tg9.'<br>Grade 10: '.$tg10.'<br><br>';
				echo 'Total Male: '.$tmale.'<br>Total Female: '.$tfemale.'<br>Overall Total: '.$count;
			} elseif($report == "Student List Report") {
				$reportTitle = $report;
				$get = $_POST['get'];
				$landscape = false;
				if(isset($get['gl'], $get['section'])) {
					$additional = "";
					if($get['gl'] != "all") 
						$additional .= " AND Student.GradeLevel = '".$get['gl']."'";
					if($get['section'] == "null")
						$additional .= " AND Student.GLS = '0'";
					elseif($get['section'] != "all")
						$additional .= " AND Student.GLS = '".$get['section']."'";
					$additional = "Account.Type = 'Student' AND Account.ID = Student.ID AND Account.Status = 'Active' $additional ORDER BY GradeLevel, GLS";
					
					if($get['section'] != "null" && $get['section'] != "all") {
						$sectiondata = $oes->getRow("GLS", "*", "ID = '".$get['section']."'");
					?>
					<b>Grade/Section:</b> Grade <?php echo $sectiondata["GradeLevel"].$sectiondata["Section"]; ?><br><br>
					<b>Adviser</b>: <?php echo ($sectiondata["FacultyID"] != 0) ? $oes->getNameFormat("f M. l", $sectiondata["FacultyID"]) : 'No adviser'; ?><br><br>
					<b>Default Room</b>: <?php echo ($sectiondata["RoomID"] != 0) ? $oes->getSingleData("Building", "Name", "ID = '".$oes->getSingleData("Room", "BuildingID", "ID = '".$sectiondata["RoomID"]."'")."'").' - Room '.$oes->getSingleData("Room", "Name", "ID = '".$sectiondata["RoomID"]."'") : 'No default room'; ?>
					<table width="100%" cellpadding="0px" cellspacing="10px">
						<tr valign="top">
							<td width="50%">
								<h4>Male</h4>
								<table class="report">
									<tr class="title">
										<td>Student No.</td>
										<td>Name</td>
									</tr>
									<?php
									$tmale = 0;
									$data = $oes->getData("Account INNER JOIN Student", "*", "Student.Gender = 'Male' AND $additional, LastName");
									foreach($data as $d) {
										$tmale++;
									?>
									<tr>
										<td><?php echo $d["ID"]; ?></td>
										<td><?php echo $oes->getNameFormat("l, f M.", $d["ID"]); ?></td>
									</tr>
									<?php
									}
									?>
								</table>
								<p align="right">Total Male: <?php echo $tmale; ?></p>
							</td>
							<td>
								<h4>Female</h4>
								<table class="report">
									<tr class="title">
										<td>Student No.</td>
										<td>Name</td>
									</tr>
									<?php
									$tfemale = 0;
									$data = $oes->getData("Account INNER JOIN Student", "*", "Student.Gender = 'Female' AND $additional, LastName");
									foreach($data as $d) {
										$tfemale++;
									?>
									<tr>
										<td><?php echo $d["ID"]; ?></td>
										<td><?php echo $oes->getNameFormat("l, f M.", $d["ID"]); ?></td>
									</tr>
									<?php
									}
									?>
								</table>
								<p align="right">Total Female: <?php echo $tfemale; ?></p>
							</td>
						</tr>
					</table>
					<?php
						$count = $tmale + $tfemale;
						echo 'Total: '.$count;
					} else {
					?>
					<table class="report">
						<tr class="title">
							<td>Student No.</td>
							<td>Name</td>
							<td>Grade Level/Section</td>
						</tr>
					<?php
						$tmale = 0;
						$tfemale = 0;
						$tg7 = 0;
						$tg8 = 0;
						$tg9 = 0;
						$tg10 = 0;
						$data = $oes->getData("Account INNER JOIN Student", "*", $additional);
						foreach($data as $d) {
							if($d["Gender"] == "Male")
								$tmale++;
							elseif($d["Gender"] == "Female")
								$tfemale++;
							if($d["GradeLevel"] == "7")
								$tg7++;
							elseif($d["GradeLevel"] == "8")
								$tg8++;
							elseif($d["GradeLevel"] == "9")
								$tg9++;
							elseif($d["GradeLevel"] == "10")
								$tg10++;
						?>
						<tr>
							<td><?php echo $d["ID"]; ?></td>
							<td><?php echo $oes->getNameFormat("l, f M.", $d["ID"]); ?></td>
							<td>Grade <?php echo $d["GradeLevel"];
							if($d["GLS"] != 0) 
								echo $oes->getSingleData("GLS", "Section", "ID = '".$d["GLS"]."'");
							?></td>
						</tr>
						<?php
						}
					?>
					</table><br>
					<?php
						$count = $tmale + $tfemale;
						echo 'Grade 7: '.$tg7.'<br>Grade 8: '.$tg8.'<br>Grade 9: '.$tg9.'<br>Grade 10: '.$tg10.'<br><br>';
						echo 'Total Male: '.$tmale.'<br>Total Female: '.$tfemale.'<br>Overall Total: '.$count;
					}
				}
			} elseif($report == "Section Schedule Report") {
				$reportTitle = $report;
				$get = $_POST['get'];
				$landscape = false;
				if(isset($get['gl'], $get['section'])) {
					$sectiondata = $oes->getRow("GLS", "*", "ID = '".$get['section']."'");
					?>
					<table width="100%">
						<tr valign="top">
							<td>
								<b>Grade/Section:</b> Grade <?php echo $sectiondata["GradeLevel"].$sectiondata["Section"]; ?><br><br>
								<b>Adviser</b>: <?php echo ($sectiondata["FacultyID"] != 0) ? $oes->getNameFormat("f M. l", $sectiondata["FacultyID"]) : 'No adviser'; ?>
							</td>
							<td>
								<b>Default Room</b>: <?php echo ($sectiondata["RoomID"] != 0) ? $oes->getSingleData("Building", "Name", "ID = '".$oes->getSingleData("Room", "BuildingID", "ID = '".$sectiondata["RoomID"]."'")."'").' - Room '.$oes->getSingleData("Room", "Name", "ID = '".$sectiondata["RoomID"]."'") : 'No default room'; ?>
							</td>
						</tr>
					</table>
					<table class="list schedule">
						<tr class="title">
							<td class="hide"></td>
							<td>Time</td>
							<td align="center">M</td>
							<td align="center">T</td>
							<td align="center">W</td>
							<td align="center">H</td>
							<td align="center">F</td>
						</tr>
						<?php
						$time = array("07:30", "08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30");
						$day = array("M", "T", "W", "H", "F");
						for($i = 0; $i < sizeof($time)-1; $i++) {
							echo '<tr>
								<td class="hide"></td>
								<td>'.date("g:i a", strtotime($time[$i].":00"))." - ".date("g:i a", strtotime($time[$i+1].":00")).'</td>';
							for($j = 0; $j < sizeof($day); $j++) {
								$sched = $oes->getRow("Schedule", "*", "SectionID = '".$get['section']."' AND StartTime = '".$time[$i].":00' AND Day = '".$day[$j]."'"); 
								if(!empty($sched)) {
									$step = 0;
									while($sched["EndTime"] != $time[$i+$step].":00") {
										$step++;
									}
									if($sched["Break"] == "")
										echo '<td rowspan="'.$step.'" align="center">'.$oes->getSingleData("Subject", "Code", "ID = '".$sched["SubjectID"]."'").'</td>';
									else
										echo '<td rowspan="'.$step.'" align="center">'.$sched["Break"].'</td>';
								} else {
									$check = $oes->getData("Schedule", "*", "SectionID = '".$get['section']."' AND Day = '".$day[$j]."' AND ('".$time[$i]."' >= StartTime AND '".$time[$i]."' < EndTime)");
									if(sizeof($check) == 0) {
										echo "<td></td>";
									}
								}
							}
							echo '</tr>';
						}
						?>
					</table>
					<?php
				}
			} elseif($report == "Faculty Schedule Report") {
				$reportTitle = $report;
				$get = $_POST['get'];
				$landscape = false;
				if(isset($get['faculty'])) {
					?>
					<table class="list schedule">
						<tr class="title">
							<td class="hide"></td>
							<td>Time</td>
							<td align="center">M</td>
							<td align="center">T</td>
							<td align="center">W</td>
							<td align="center">H</td>
							<td align="center">F</td>
						</tr>
						<?php
						$time = array("07:30", "08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30");
						$day = array("M", "T", "W", "H", "F");
						$colors = array("de8282", "de82d9", "8682de", "82b8de", "82dedb", "82deb6", "afde82", "dbde82", "deb882");
						$rooms = array();
						for($i = 0; $i < sizeof($time)-1; $i++) {
							echo '<tr>
								<td class="hide"></td>
								<td>'.date("g:i a", strtotime($time[$i].":00"))." - ".date("g:i a", strtotime($time[$i+1].":00")).'</td>';
							for($j = 0; $j < sizeof($day); $j++) {
								$sched = $oes->getRow("Schedule", "*", "FacultyID = '".$get['faculty']."' AND StartTime = '".$time[$i].":00' AND Day = '".$day[$j]."'"); 
								if(!empty($sched)) {
									$sectiondata = $oes->getRow("GLS", "*", "ID = '".$sched["SectionID"]."'");
									$step = 0;
									while($sched["EndTime"] != $time[$i+$step].":00") {
										$step++;
									}
									if($sched["Break"] == "") {
										while(true) {
											$randomcolor = rand(0, sizeof($colors)-1);
											if(!in_array($colors[$randomcolor], $rooms)) {
												if(!isset($rooms[$sectiondata["ID"]]))
													$rooms[$sectiondata["ID"]] = $colors[$randomcolor];
												break;
											}
										}
										echo '<td rowspan="'.$step.'" align="center" style="color: white;background-color: #'.$rooms[$sectiondata["ID"]].';">'.$oes->getSingleData("Subject", "Code", "ID = '".$sched["SubjectID"]."'").'</td>';
									} else
										echo '<td rowspan="'.$step.'" align="center">'.$sched["Break"].'</td>';
								} else {
									$check = $oes->getData("Schedule", "*", "FacultyID = '".$get['faculty']."' AND Day = '".$day[$j]."' AND ('".$time[$i]."' >= StartTime AND '".$time[$i]."' < EndTime)");
									if(sizeof($check) == 0) {
										echo "<td></td>";
									}
								}
							}
							echo '</tr>';
						}
						?>
					</table><br>
					<?php
					foreach($rooms as $sectionid => $color) {
						$sectiondata = $oes->getRow("GLS", "*", "ID = '$sectionid'");
						$roomdata = $oes->getRow("Room", "*", "ID = '".$sectiondata["RoomID"]."'");
						$buildingdata = $oes->getRow("Building", "*", "ID = '".$roomdata["BuildingID"]."'");
						echo '<span class="colorbox" style="background: #'.$color.';"></span>Grade '.$sectiondata["GradeLevel"].$sectiondata["Section"].' ('.$buildingdata["Name"].' - Room '.$roomdata["Name"].')';
					}
				}
			} elseif($report == "Incomplete Documents") {
				$reportTitle = $report;
				$get = $_POST['get'];
				$landscape = true;
				if(isset($get['gl'], $get['section'])) {
					$additional = "";
					if($get['gl'] != "all") 
						$additional .= " AND Student.GradeLevel = '".$get['gl']."'";
					if($get['section'] == "null")
						$additional .= " AND Student.GLS = '0'";
					elseif($get['section'] != "all")
						$additional .= " AND Student.GLS = '".$get['section']."'";
					$additional = "Account.Type = 'Student' AND Account.ID = Student.ID AND Account.Status = 'Active' AND (BirthCertificate = '0' OR Form138 = '0' OR GoodMoral = '0') $additional ORDER BY GradeLevel, GLS, LastName";
					
					if($get['section'] != "null" && $get['section'] != "all") {
						$sectiondata = $oes->getRow("GLS", "*", "ID = '".$get['section']."'");
					?>
					<b>Grade/Section:</b> Grade <?php echo $sectiondata["GradeLevel"].$sectiondata["Section"]; ?><br><br>
					<table class="report">
						<tr class="title">
							<td>Student No.</td>
							<td>Name</td>
							<td>Birth Certificate</td>
							<td>Form-138</td>
							<td>Good Moral</td>
						</tr>
						<?php
						$data = $oes->getData("Account INNER JOIN Student", "*", $additional);
						foreach($data as $d) {
						?>
						<tr>
							<td><?php echo $d["ID"]; ?></td>
							<td><?php echo $oes->getNameFormat("l, f M.", $d["ID"]); ?></td>
							<td align="center">
								<?php
								if($d["BirthCertificate"] == 1)
									echo '<img src="images/skin/oslo/icons/ic_done_black.png" width="24px">';
								else
									echo '<img src="images/skin/oslo/icons/ic_close_black.png" width="24px">';
								?>
							</td>
							<td align="center">
								<?php
								if($d["Form138"] == 1)
									echo '<img src="images/skin/oslo/icons/ic_done_black.png" width="24px">';
								else
									echo '<img src="images/skin/oslo/icons/ic_close_black.png" width="24px">';
								?>
							</td>
							<td align="center">
								<?php
								if($d["GoodMoral"] == 1)
									echo '<img src="images/skin/oslo/icons/ic_done_black.png" width="24px">';
								else
									echo '<img src="images/skin/oslo/icons/ic_close_black.png" width="24px">';
								?>
							</td>
						</tr>
						<?php
						}
						?>
					</table>
					<?php
					} else {
					?>
					<table class="report">
						<tr class="title">
							<td>Student No.</td>
							<td>Name</td>
							<td>Grade/Section</td>
							<td>Birth Certificate</td>
							<td>Form-138</td>
							<td>Good Moral</td>
						</tr>
						<?php
						$data = $oes->getData("Account INNER JOIN Student", "*", $additional);
						foreach($data as $d) {
						?>
						<tr>
							<td><?php echo $d["ID"]; ?></td>
							<td><?php echo $oes->getNameFormat("l, f M.", $d["ID"]); ?></td>
							<td>Grade <?php echo $d["GradeLevel"];
							if($d["GLS"] != 0) 
								echo $oes->getSingleData("GLS", "Section", "ID = '".$d["GLS"]."'");
							?></td>
							<td align="center">
								<?php
								if($d["BirthCertificate"] == 1)
									echo '<img src="images/skin/oslo/icons/ic_done_black.png" width="24px">';
								else
									echo '<img src="images/skin/oslo/icons/ic_close_black.png" width="24px">';
								?>
							</td>
							<td align="center">
								<?php
								if($d["Form138"] == 1)
									echo '<img src="images/skin/oslo/icons/ic_done_black.png" width="24px">';
								else
									echo '<img src="images/skin/oslo/icons/ic_close_black.png" width="24px">';
								?>
							</td>
							<td align="center">
								<?php
								if($d["GoodMoral"] == 1)
									echo '<img src="images/skin/oslo/icons/ic_done_black.png" width="24px">';
								else
									echo '<img src="images/skin/oslo/icons/ic_close_black.png" width="24px">';
								?>
							</td>
						</tr>
						<?php
						}
						?>
					</table>
					<?php
					}
				}
			} else {
				showDialogBox('invalidreport');
			}
			if(isset($reportTitle)) {
			?>
				<textarea class="resize"></textarea>
			</div>
			<div class="footer"></div>
			<script>
			$(document).ready(function() {
				document.title = "<?php echo $reportTitle; ?>";
				<?php
				if($landscape) {
				?>
				$(".paper").addClass("landscape");
				$(".bg").addClass("landscape");
				<?php
				}
				?>
				$("#loading").hide("slow");
				$("#blackTrans").hide();

				$("textarea.resize").keyup(function(event) {
					$(this).css('height','auto');
					$(this).height(this.scrollHeight);
				});
			})
			</script>
			<?php
			}
		}
	} elseif($action == "getreports") {
		$reports = $oes->getData("Report", "*", "");
		foreach($reports as $report) {
			echo '<option value="'.$report["ID"].'">'.$report["Name"].'</option>';
		}
		?>
		<option value="new">Define new...</option>
		<?php
	} elseif($action == "lstreport") {
		if(isset($_POST['report'])) {
			$report = $_POST['report'];
			if($report == "Examinees Report") {
			?>
				<div class="card">
					<h4>Report Settings</h4>
					<table class="form-container">
						<tr>
							<td><label>Admission Date</label>
							<select name="admission">
								<?php
								$dates = $oes->getData("Admission", "*", "Entrance = 'Exam'");
								foreach($dates as $date) {
									echo '<option value="'.$date["ID"].'">'.date("F d, Y", strtotime($date["ScheduleDate"])).' - '.date("h:i a", strtotime($date["ScheduleTime"])).'</option>';
								}
								?>
							</select></td>
						</tr>
						<tr>
							<td><label>Max Students per Room</label>
							<input type="number" name="max" value="30"></td>
						</tr>
					</table>
					<ul class="button-container right">
						<li><a id="btnGenerate" class="raised_button">Generate</a></li>
					</ul>
					<script>
					$(document).ready(function() {
						$("#lstReportSettings #btnGenerate").click(function() {
							$admission = $("#lstReportSettings select[name=admission]").val();
							$max = $("#lstReportSettings input[name=max]").val();
							window.open('paper.php?report=<?php echo $report; ?>&admission='+$admission+'&max='+$max, '_blank');
						})
					});
					</script>
				</div>
			<?php
			} elseif($report == "Interviewees Report") {
			?>
				<div class="card">
					<h4>Report Settings</h4>
					<table class="form-container">
						<tr>
							<td><label>Admission Date</label>
							<select name="admission">
								<?php
								$dates = $oes->getData("Admission", "*", "Entrance = 'Interview'");
								foreach($dates as $date) {
									echo '<option value="'.$date["ID"].'">'.date("F d, Y", strtotime($date["ScheduleDate"])).' - '.date("h:i a", strtotime($date["ScheduleTime"])).'</option>';
								}
								?>
							</select></td>
						</tr>
						<tr>
							<td><label>Grade Level</label>
							<select name="gl">
								<option value="all">All grade levels</option>
								<option value="8">Grade 8</option>
								<option value="9">Grade 9</option>
								<option value="10">Grade 10</option>
							</select></td>
						</tr>
					</table>
					<ul class="button-container right">
						<li><a id="btnGenerate" class="raised_button">Generate</a></li>
					</ul>
					<script>
					$(document).ready(function() {
						$("#lstReportSettings #btnGenerate").click(function() {
							$admission = $("#lstReportSettings select[name=admission]").val();
							$gl = $("#lstReportSettings select[name=gl]").val();
							window.open('paper.php?report=<?php echo $report; ?>&admission='+$admission+'&gl='+$gl, '_blank');
						})
					});
					</script>
				</div>
			<?php
			} elseif($report == "Passers Report") {
			?>
				<div class="card">
					<h4>Report Settings</h4>
					<table class="form-container">
						<tr>
							<td><label>Grade Level</label>
							<select name="gl">
								<option value="all">All grade levels</option>
								<option value="7">Grade 7</option>
								<option value="8">Grade 8</option>
								<option value="9">Grade 9</option>
								<option value="10">Grade 10</option>
							</select></td>
						</tr>
					</table>
					<ul class="button-container right">
						<li><a id="btnGenerate" class="raised_button">Generate</a></li>
					</ul>
					<script>
					$(document).ready(function() {
						$("#lstReportSettings #btnGenerate").click(function() {
							$gl = $("#lstReportSettings select[name=gl]").val();
							window.open('paper.php?report=<?php echo $report; ?>&gl='+$gl, '_blank');
						})
					});
					</script>
				</div>
			<?php
			} elseif($report == "Student List Report") {
			?>
				<div class="card">
					<h4>Report Settings</h4>
					<table class="form-container">
						<tr>
							<td><label>Grade Level</label>
							<select name="gradelevel" id="ddlGradeLevel">
								<option value="all">All grade levels</option>
							<?php
							$options = mysql_query("SELECT DISTINCT GradeLevel FROM Student WHERE GradeLevel != '0' ORDER BY GradeLevel ASC");
							while($row = mysql_fetch_array($options)) {
								echo '<option value="'.$row["GradeLevel"].'">Grade '.$row["GradeLevel"].'</option>';
							}
							?>
							</select></td>
						</tr>
						<tr>
							<td><label>Section</label>
							<select name="section" id="ddlSection">
								<option value="all">All sections</option>
								<option value="null">No sections</option>
							</select></td>
						</tr>
					</table>
					<ul class="button-container right">
						<li><a id="btnGenerate" class="raised_button">Generate</a></li>
					</ul>
					<script>
					$(document).ready(function() {
						$("#lstReportSettings #btnGenerate").click(function() {
							$gl = $("#lstReportSettings select[name=gradelevel]").val();
							$section = $("#lstReportSettings select[name=section]").val();
							window.open('paper.php?report=<?php echo $report; ?>&gl='+$gl+'&section='+$section, '_blank');
						})
						$("#lstReportSettings #ddlGradeLevel").change(function() {
							$("#btnGenerate").hide();
							$gl = $(this).val();
							$.ajax({
								type: "post",
								cache: true,
								url: "process.php?action=getsection",
								data: {gl: $gl, alloption: 1, nooption: 1},
								success: function(html) {
									$("#lstReportSettings #ddlSection").html(html);
									$("#btnGenerate").show();
								}
							});
						});
					});
					</script>
				</div>
			<?php
			} elseif($report == "Section Schedule Report") {
			?>
				<div class="card">
					<h4>Report Settings</h4>
					<table class="form-container">
						<tr>
							<td><label>Grade Level</label>
							<select name="gradelevel" id="ddlGradeLevel">
							<?php
							$options = mysql_query("SELECT DISTINCT GradeLevel FROM Student WHERE GradeLevel != '0' ORDER BY GradeLevel ASC");
							while($row = mysql_fetch_array($options)) {
								echo '<option value="'.$row["GradeLevel"].'">Grade '.$row["GradeLevel"].'</option>';
							}
							?>
							</select></td>
						</tr>
						<tr>
							<td><label>Section</label>
							<select name="section" id="ddlSection">
							</select></td>
						</tr>
					</table>
					<ul class="button-container right">
						<li><a id="btnGenerate" class="raised_button">Generate</a></li>
					</ul>
					<script>
					$(document).ready(function() {
						$("#lstReportSettings #btnGenerate").click(function() {
							$gl = $("#lstReportSettings select[name=gradelevel]").val();
							$section = $("#lstReportSettings select[name=section]").val();
							window.open('paper.php?report=<?php echo $report; ?>&gl='+$gl+'&section='+$section, '_blank');
						})
						function refreshDDLSection() {
							$("#btnGenerate").hide();
							$gl = $("#lstReportSettings #ddlGradeLevel").val();
							$.ajax({
								type: "post",
								cache: true,
								url: "process.php?action=getsection",
								data: {gl: $gl},
								success: function(html) {
									$("#lstReportSettings #ddlSection").html(html);
									$("#btnGenerate").show();
								}
							});
						}
						refreshDDLSection();
						$("#lstReportSettings #ddlGradeLevel").change(function() {
							refreshDDLSection();
						});
					});
					</script>
				</div>
			<?php
			} elseif($report == "Faculty Schedule Report") {
			?>
				<div class="card">
					<h4>Report Settings</h4>
					<table class="form-container">
						<tr>
							<td><label>Faculty</label>
							<select name="faculty">
							<?php
							$options = mysql_query("SELECT * FROM Faculty ORDER BY ID");
							while($row = mysql_fetch_array($options)) {
								echo '<option value="'.$row["ID"].'">'.$row["ID"].' - '.$oes->getNameFormat("l, f M.", $row["ID"]).'</option>';
							}
							?>
							</select></td>
						</tr>
					</table>
					<ul class="button-container right">
						<li><a id="btnGenerate" class="raised_button">Generate</a></li>
					</ul>
					<script>
					$(document).ready(function() {
						$("#lstReportSettings #btnGenerate").click(function() {
							$faculty = $("#lstReportSettings select[name=faculty]").val();
							window.open('paper.php?report=<?php echo $report; ?>&faculty='+$faculty, '_blank');
						})
					});
					</script>
				</div>
			<?php
			} elseif($report == "Incomplete Documents") {
			?>
				<div class="card">
					<h4>Report Settings</h4>
					<table class="form-container">
						<tr>
							<td><label>Grade Level</label>
							<select name="gradelevel" id="ddlGradeLevel">
								<option value="all">All grade levels</option>
							<?php
							$options = mysql_query("SELECT DISTINCT GradeLevel FROM Student WHERE GradeLevel != '0' ORDER BY GradeLevel ASC");
							while($row = mysql_fetch_array($options)) {
								echo '<option value="'.$row["GradeLevel"].'">Grade '.$row["GradeLevel"].'</option>';
							}
							?>
							</select></td>
						</tr>
						<tr>
							<td><label>Section</label>
							<select name="section" id="ddlSection">
								<option value="all">All sections</option>
								<option value="null">No sections</option>
							</select></td>
						</tr>
					</table>
					<ul class="button-container right">
						<li><a id="btnGenerate" class="raised_button">Generate</a></li>
					</ul>
					<script>
					$(document).ready(function() {
						$("#lstReportSettings #btnGenerate").click(function() {
							$gl = $("#lstReportSettings select[name=gradelevel]").val();
							$section = $("#lstReportSettings select[name=section]").val();
							window.open('paper.php?report=<?php echo $report; ?>&gl='+$gl+'&section='+$section, '_blank');
						})
						$("#lstReportSettings #ddlGradeLevel").change(function() {
							$("#btnGenerate").hide();
							$gl = $(this).val();
							$.ajax({
								type: "post",
								cache: true,
								url: "process.php?action=getsection",
								data: {gl: $gl, alloption: 1, nooption: 1},
								success: function(html) {
									$("#lstReportSettings #ddlSection").html(html);
									$("#btnGenerate").show();
								}
							});
						});
					});
					</script>
				</div>
			<?php
			}
		}
	} elseif($action == "changepassword_data") {
		if(isset($_POST['id'], $_POST['pass1'], $_POST['pass2'])) {
			$id = $_POST['id'];
			$pass1 = $_POST['pass1'];
			$pass2 = $_POST['pass2'];
			if($pass1 == $pass2) {
				foreach($id as $i) {
					mysql_query("UPDATE Account SET Password = '$pass1' WHERE ID = '$i'");
				}
				hideElements();
				showSnackbarMsg("Password successfully changed.");
			} else {
				showSnackbarMsg("Passwords doesn't match.");
			}
		}
	} elseif($action == "archivestudent") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			mysql_query("UPDATE Account SET Status = 'Inactive' WHERE ID = '$id'");
		}
	} elseif($action == "archivestudent_data") {
		if(isset($_POST['checkedData'])) {
			$checkedData = $_POST['checkedData'];
			$success = true;
			foreach($checkedData as $id) {
				$section = $oes->getSingleData("Student", "GLS", "ID = '$id'");
				mysql_query("UPDATE Account SET Status = 'Inactive' WHERE ID = '$id'");
				$num = $oes->getNum("Student INNER JOIN Account", "Student.ID AND Account.ID AND Account.Status = 'Active' AND GLS = '$section'");
				if($num == 0) {
					mysql_query("DELETE FROM GLS WHERE ID = '$section'");
					mysql_query("DELETE FROM Schedule WHERE SectionID = '$section'");
				}
			}
			showSnackbar('archive_success');
		} else {
			showSnackbar('archive_error');
		}
	} elseif($action == "archiveenrollee") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			mysql_query("UPDATE Account SET Status = 'Inactive' WHERE ID = '$id'");
		}
	} elseif($action == "archiveenrollee_data") {
		if(isset($_POST['checkedData'])) {
			$checkedData = $_POST['checkedData'];
			foreach($checkedData as $id) {
				mysql_query("UPDATE Account SET Status = 'Inactive' WHERE ID = '$id'");
			}
			showSnackbar("delete_success");
		}
	} elseif($action == "archivefaculty") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			mysql_query("UPDATE Account SET Status = 'Inactive' WHERE ID = '$id'");
		}
	} elseif($action == "changeschoolyearstatus") {
		if(isset($_POST['status'])) {
			$status = $_POST['status'];
			if($status == "true") {
				$status = 1;
			} else {
				$status = 0;
			}
			$sy = $oes->getSchoolYear();
			mysql_query("UPDATE Administration SET Status = '$status' WHERE SchoolYear = '$sy'");
		}
	} elseif($action == "changegradesettings") {
		if(isset($_POST['q1'], $_POST['q2'], $_POST['q3'], $_POST['q4'])) {
			$q1 = $_POST['q1'];
			$q2 = $_POST['q2'];
			$q3 = $_POST['q3'];
			$q4 = $_POST['q4'];
			if($q1 == "true") $q1 = 1; else $q1 = 0;
			if($q2 == "true") $q2 = 1; else $q2 = 0;
			if($q3 == "true") $q3 = 1; else $q3 = 0;
			if($q4 == "true") $q4 = 1; else $q4 = 0;
			$sy = $oes->getSchoolYear();
			mysql_query("UPDATE Administration SET FirstQuarter = '$q1', SecondQuarter = '$q2', ThirdQuarter = '$q3', FourthQuarter = '$q4' WHERE SchoolYear = '$sy'");
		}
	} elseif($action == "addadmin") {
		if(isset($_POST['username'], $_POST['pass1'], $_POST['pass2'], $_POST['modules'])) {
			$username = $_POST['username'];
			$pass1 = $_POST['pass1'];
			$pass2 = $_POST['pass2'];
			$modules = $_POST['modules'];
			if($username != "" && $pass1 != "" && $pass2 != "") {
				$check = $oes->getNum("Account", "Username = '".$username."'");
				if($check == 0) {
					if($pass1 == $pass2) {
						$modules = $oes->convertArrayToSQL($modules);
						mysql_query("INSERT INTO Account (Username, Password, Type, Status) VALUES ('$username', '$pass1', 'Custom', 'Active')");
						mysql_query("INSERT INTO Administrator (Username, Module) VALUES ('$username', '$modules')");
						hideElements();
						showSnackbar("add_success");
					} else
						showSnackbarMsg("Password does not match.");
				} else
					showSnackbarMsg("Username already exists");
			} else
				showSnackbarMsg("Invalid input");
		}
	} elseif($action == "editadmin") {
		if(isset($_POST['id'], $_POST['modules'])) {
			$id = $_POST['id'];
			$username = $oes->getSingleData("Account", "Username", "ID = '$id'");
			$modules = $_POST['modules'];
			$modules = $oes->convertArrayToSQL($modules);
			mysql_query("UPDATE Administrator SET Module = '$modules' WHERE Username = '$username'");
			hideElements();
			showSnackbar("edit_success");
		}
	} elseif($action == "deleteadmin") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$username = $oes->getSingleData("Account", "Username", "ID = '$id'");
			mysql_query("DELETE FROM Account WHERE ID = '$id'");
			mysql_query("DELETE FROM Administrator WHERE Username = '$username'");
			showSnackbar("delete_success");
		}
	} elseif($action == "archiveadmin") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			mysql_query("UPDATE Account SET Status = 'Inactive' WHERE ID = '$id'");
			showSnackbar("archive_success");
		}
	} else {
		header("Location: index.php");
	}
} else {
	header("Location: index.php");
}
?>
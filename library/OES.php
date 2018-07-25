<?php
class OES {
	protected $loggedID;
	
	function loggedUser($loggedID) {
		$this->loggedID = $loggedID;
	}

	function getID($username) {
		$x = "";
		$query = mysql_query("SELECT * FROM Account WHERE Username = '$username'");
		while($row = mysql_fetch_array($query)) {
			$x = $row["ID"];
		}
		return $x;
	}

	function getLoggedUserInfo($column) {
		$x = "";
		$query = mysql_query("SELECT $column FROM Account WHERE ID = '{$this->loggedID}'");
		while($row = mysql_fetch_array($query)) {
			$x = $row[$column];
		}
		return $x;
	}

	function getUserInfo($column, $id) {
		$x = "";
		$query = mysql_query("SELECT $column FROM Account WHERE ID = '$id'");
		while($row = mysql_fetch_array($query)) {
			$x = $row[$column];
		}
		return $x;
	}

	function getNameFormat($format, $id) {
		$x = $format;
		$formats = "FfMmLl";
		for($i = 0; $i < strlen($formats); $i++) {
			$temp = substr($formats, $i, 1);
			$x = str_replace($temp, '{'.$temp.'}', $x);
		}
		$type = $this->getSingleData("Account", "Type", "ID = '$id'");
		if($type == "Student" || $type == "Enrollee")
			$query = mysql_query("SELECT FirstName, MiddleName, LastName FROM Student WHERE ID = '$id'");
		elseif($type == "Faculty")
			$query = mysql_query("SELECT FirstName, MiddleName, LastName FROM Faculty WHERE ID = '$id'");
		while($row = mysql_fetch_array($query)) {
			$x = str_replace("{f}", $row["FirstName"], $x);
			$x = str_replace("{m}", $row["MiddleName"], $x);
			$x = str_replace("{l}", $row["LastName"], $x);
			$x = str_replace("{F}", substr($row["FirstName"], 0, 1), $x);
			$x = str_replace("{M}", substr($row["MiddleName"], 0, 1), $x);
			$x = str_replace("{L}", substr($row["LastName"], 0, 1), $x);
		}
		return $x;
	}

	function generateAccountID() {
		$id = "";
		$sy = $this->getSchoolYear();
		$query = mysql_query("SELECT * FROM Account WHERE ID LIKE '".$sy."0%' ORDER BY ID DESC LIMIT 1");
		$n = 0;
		while($row = mysql_fetch_array($query)) {
			$n = 1;
			$id = $row["ID"]+1;
			break;
		}
		if($n == 0)
			$id = $sy."00001";
		return $id;
	}

	function generateUsername($id, $fname, $mname, $lname) {
		return substr($lname, 0, 1).substr($fname, 0, 1).substr($mname, 0, 1).substr($id, -6);
	}

	function updateUsername($username, $fname, $mname, $lname) {
		return substr($lname, 0, 1).substr($fname, 0, 1).substr($mname, 0, 1).substr($username, -6);
	}

	function generateTempAccountID() {
		$id = "";
		$sy = $this->getSchoolYear();
		$query = mysql_query("SELECT * FROM Account WHERE ID LIKE '".$sy."1%' ORDER BY ID DESC LIMIT 1");
		$n = 0;
		while($row = mysql_fetch_array($query)) {
			$n = 1;
			$id = $row["ID"]+1;
			break;
		}
		if($n == 0)
			$id = $sy."10001";
		return $id;
	}

	function generateTempUsername($id, $fname, $mname, $lname) {
		return substr($lname, 0, 1).substr($fname, 0, 1).substr($mname, 0, 1).substr($id, -6);
	}

	function generatePassword($length) {
		return substr(str_shuffle(str_repeat("1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", $length)), 0, $length);
	}

	/*
	For >= PHP 5.3
	function getAge($birthDate) {
		$birthDate = new DateTime($birthDate);
		$now = new DateTime();
		$int = $now->diff($birthDate);
		return $int->y;
	}
	*/

	/*
	For < PHP 5.3
	*/
	function getAge($birthDate) {
		return date_diff(date_create($birthDate), date_create('now'))->y;
	}

	function getProfilePicture($id) {
		$profpic = "images/users/$id.jpg";
		if(!file_exists($profpic))
			$profpic = "images/users/unknown.jpg";
		return $profpic;
	}

	function getSingleData($table, $column, $where) {
		$x = "";
		$query = mysql_query("SELECT $column FROM $table WHERE $where");
		while($row = mysql_fetch_array($query)) {
			$x = $row[$column];
			break;
		}
		return $x;
	}

	function getRow($table, $columns, $additional) {
		$x = array();
		$queryString = "";
		if($columns == "*") {
			$queryString .= "SELECT * ";
			$columns = array();
			$temp_table = explode(" INNER JOIN ", $table);
			foreach($temp_table as $t) {
				$query = mysql_query("SHOW COLUMNS FROM $t");
				while($row = mysql_fetch_array($query)) {
					$columns[] = $row["Field"];
				}
			}
		} elseif(strpos(",", $columns)) {
			$queryString .= "SELECT $columns ";
			$columns = explode(",", str_replace(" ", "", $columns));
		}
		$queryString .= "FROM $table";
		if($additional != "")
			$queryString .= " WHERE $additional";
		$query = mysql_query($queryString);
		while($row = mysql_fetch_array($query)) {
			foreach($columns as $column)
				$x[$column] = $row[$column];
			break;
		}
		return $x;
	}

	function getData($table, $columns, $additional) {
		$x = array();
		$queryString = "";
		$tables = explode(" INNER JOIN ", $table);
		if($columns == "*") {
			$queryString .= "SELECT * ";
			$columns = array();
			foreach($tables as $t) {
				$query = mysql_query("SHOW COLUMNS FROM $t");
				while($row = mysql_fetch_array($query)) {
					$columns[] = $row["Field"];
				}
			}
		} elseif(strpos(",", $columns)) {
			$queryString .= "SELECT $columns ";
			$columns = explode(",", str_replace(" ", "", $columns));
		}
		$queryString .= "FROM $table";
		if($additional != "")
			$queryString .= " WHERE $additional";
		$query = mysql_query($queryString);
		$i = 0;
		while($row = mysql_fetch_array($query)) {
			foreach($columns as $column)
				$x[$i][$column] = $row[$column];
			$i++;
		}
		return $x;
	}

	function getNum($table, $additional) {
		$x = $this->getData($table, "*", $additional);
		return sizeof($x);
	}

	function getColleges() {
		$x = array();
		$query = mysql_query("SELECT * FROM College");
		$i = 0;
		while($row = mysql_fetch_array($query)) {
			$x[$i]["ID"] = $row["ID"];
			$x[$i]["Name"] = $row["Name"];
			$x[$i]["Code"] = $row["Code"];
			$i++;
		}
		return $x;
	}

	function getCourses($collegeID) {
		$x = array();
		$ar = array("all", "exact");
		if(in_array($collegeID, $ar)) {
			$query = mysql_query("SELECT * FROM Course ORDER BY Name");
		} else {
			$query = mysql_query("SELECT * FROM Course WHERE CollegeID = '$collegeID' ORDER BY Name");
		}
		$i = 0;
		while($row = mysql_fetch_array($query)) {
			$x[$i]["ID"] = $row["ID"];
			$x[$i]["Name"] = $row["Name"];
			$x[$i]["Code"] = $row["Code"];
			$i++;
		}
		return $x;
	}

	function getCourseYears($courseID) {
		$x = "";
		$query = mysql_query("SELECT YearCourse FROM Course WHERE ID = '$courseID' LIMIT 1");
		while($row = mysql_fetch_array($query)) {
			$x = $row["YearCourse"];
			break;
		}
		return $x;
	}

	function getSchoolYear() {
		$x = "";
		$query = mysql_query("SELECT SchoolYear FROM Administration ORDER BY ID DESC LIMIT 1");
		while($row = mysql_fetch_array($query)) {
			$x = $row["SchoolYear"];
			break;
		}
		return $x;
	}

	function getTermInWords($inWords) {
		$x = "";
		$query = mysql_query("SELECT Term FROM Administration ORDER BY ID DESC LIMIT 1");
		while($row = mysql_fetch_array($query)) {
			$x = $row["Term"];
			break;
		}
		if($inWords) {
			if($x == 1)
				$x = "1st Semester";
			elseif($x == 2)
				$x = "2nd Semester";
			elseif($x == 3)
				$x = "3rd Semester";
			elseif($x == 4)
				$x = "Summer Term";
		}
		return $x;
	}

	function isExists($table, $column, $value) {
		$exists = false;
		$where = "";
		for($i = 0; $i < sizeof($column); $i++) {
			if($i == 0)
				$where .= $column[$i]." = '".$value[$i]."'";
			else
				$where .= " AND ".$column[$i]." = '".$value[$i]."'";
		}
		$query = mysql_query("SELECT * FROM $table WHERE $where");
		if(mysql_num_rows($query) > 0)
			$exists = true;
		return $exists;
	}

	function convertPHPArrayToJS($arr) {
		$x = "[";
		for($i = 0; $i < sizeof($arr); $i++) {
			if($i == 0) 
				$x .= $arr[$i];
			else
				$x .= ", ".$arr[$i];
		}
		$x .= "]";
		return $x;
	}

	function convertArrayToSQL($arr) {
		$data = "//";
		foreach($arr as $ar) {
			$data .= $ar."//";
		}
		return $data;
	}

	function convertSQLToArray($data) {
		return explode("//", trim($data, "//"));
	}

	function removeElementInArray($arr, $el) {
		if(in_array($el, $arr))
			unset($arr[array_search($el, $arr)]);
		return $arr;
	}

	function generateHash($length) {
		$x = "abcdef1234567890";
		return substr(str_shuffle(str_repeat($x, $length)), 0, $length);
	}

	function createSections($sections, $gradelevel) {
		$sectionNames = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
		$j = 0;
		for($i = 0; $i < $sections; $i++) {
			$unique = false;
			while(!$unique) {
				if(!$this->isExists("GLS", array("GradeLevel", "Section"), array($gradelevel, $sectionNames[$j]))) {
					$unique = true;
				} else {
					$j++;
				}
			}
			if($unique) {
				$q1 = mysql_query("INSERT INTO GLS (GradeLevel, Section, FacultyID) VALUES ('$gradelevel', '".$sectionNames[$j]."', '0')");
			}
		}
	}

	function getSectionWithLowestStudent($gradelevel) {
		$sections = $this->getData("GLS", "*", "GradeLevel = '$gradelevel'");
		$id = 0;
		$students = 40;
		foreach($sections as $section) {
			if($id == 0)
				$id = $section["ID"];
			$numStudents = sizeof($this->getData("Student", "*", "GLS = '".$section["ID"]."'"));
			if($numStudents < $students) {
				$students = $numStudents;
				$id = $section["ID"];
			}
		}
		return $id;
	}
	function getFullDayName($day) {
		if($day == "M")
			return "Monday";
		elseif($day == "T")
			return "Tuesday";
		elseif($day == "W")
			return "Wednesday";
		elseif($day == "H")
			return "Thursday";
		elseif($day == "F")
			return "Friday";
		else
			return false;
	}

	function checkExpertiseAndSchedule($subjectID, $day, $starttime, $endtime) {
		$okay = true;
		$check2 = $this->getData("Expertise", "*", "SubjectID = '$subjectID'");
		$check3 = $this->getData("Schedule", "*", "Day = '".$day."' AND SubjectID = '$subjectID' AND (('$starttime' >= StartTime AND '$starttime' < EndTime) OR ('$endtime' > StartTime AND '$endtime' <= EndTime))");
		if(sizeof($check2) < sizeof($check3))
			$okay = false;
		return $okay;
	}

	function getTotalLoad($faculty) {
		$query = mysql_query("SELECT DISTINCT SubjectID, SectionID FROM Schedule WHERE FacultyID = '$faculty'");
		$load = 0;
		while($schedule = mysql_fetch_array($query)) {
			$subject = $schedule["SubjectID"];
			$load += $this->getSingleData("Subject", "Units", "ID = '$subject'");
		}
		return $load;
	}

	function getScheduleDate($type) {
		$selectedschedule = "0";
		$sy = $this->getSchoolYear();
		if($type == "Exam") {
			$max = $this->getSingleData("Administration", "MaxExaminees", "SchoolYear = '$sy'");
			$schedules = $this->getData("Admission", "*", "Entrance = 'Exam' ORDER BY ScheduleDate, ScheduleTime");
			foreach($schedules as $s) {
				$id = $s["ID"];
				$check = $this->getData("Enrollee", "*", "AdmissionID = '$id'");
				if(sizeof($check) < $max) {
					$selectedschedule = $id;
					break;
				}
			}
		} elseif($type == "Interview") {
			$max = $this->getSingleData("Administration", "MaxInterviewees", "SchoolYear = '$sy'");
			$schedules = $this->getData("Admission", "*", "Entrance = 'Interview' ORDER BY ScheduleDate, ScheduleTime");
			foreach($schedules as $s) {
				$id = $s["ID"];
				$check = $this->getData("Enrollee", "*", "AdmissionID = '$id'");
				if(sizeof($check) < $max) {
					$selectedschedule = $id;
					break;
				}
			}
		}
		return $selectedschedule;
	}

	function getTuitionFee($id) {
		$data = $this->getRow("Assessment", "*", "ID = '$id'");
		return $data["TuitionFee"] + $data["LaboratoryFee"] + $data["MiscellaneousFee"] + $data["OtherFee"];
	}

	function getSurcharge($id) {
		$surcharge = 0;
		$pt = $this->getSingleData("Assessment", "PaymentTerm", "ID = '$id'");
		$pt = $this->getSingleData("PaymentTerm", "PaymentTerm", "ID = '$pt'");
		if($pt == "Monthly Installment")
			$surcharge = 200;
		elseif($pt == "Quarterly Installment") 
			$surcharge = 500;
		elseif($pt == "Semi-annually Installment") 
			$surcharge = 1000;
		return $surcharge;
	}

	function getTotalCredit($id) {
		$total = 0;
		$transactions = $this->getData("Transaction", "*", "StudentID = '$id'");
		foreach($transactions as $t) {
			$total += $t["TotalAmount"];
		}
		return $total;
	}

	function calculateSurcharge($id) {
		$balance = $this->getSingleData("Assessment", "Balance", "ID = '$id'");
		$credit = $this->getTotalCredit($id);

		$tuition = $this->getTuitionFee($id);
		$paymentterm = $this->getSingleData("Assessment", "PaymentTerm", "ID = '$id'");
		$fee = $this->getSingleData("PaymentTerm", "Fee", "ID = '$paymentterm'");
		$totaltuition = $tuition + $fee;
		$surcharges = $this->getSurcharges($id);

		if($balance+$credit > $totaltuition)
			$surcharge = $balance+$credit-$totaltuition-$surcharges;
		else
			$surcharge = $balance+$credit-$totaltuition;
		return $surcharge;
	}

	function getSurcharges($id) {
		$x = 0;
		$surcharges = $this->getData("Surcharge", "*", "StudentID = '$id'");
		foreach($surcharges as $s) 
			$x += $s["Amount"];
		return $x;
	}


	function isTemporary($id) {
		$temp = false;
		$id = substr(substr($id, 4), 0, 1);
		if($id == 1)
			$temp = true;
		return $temp;
	}

	function addFeed($id, $title, $message) {
		$date = date("Y-m-d");
		$time = date("H:i:s");
		mysql_query("INSERT INTO Feed (AccountID, Title, Message, DatePosted, TimePosted, Dismiss) VALUES ('$id', '$title', '$message', '$date', '$time', '0')");
	}

	function sendEmail($id, $subject, $message) {
		date_default_timezone_set('Asia/Manila');
		$emailMessage = $message;
		$emailSubject = "DLSUD High School - ".$subject;
		$webmaster = $this->getSingleData("Student", "Email", "ID = '$id'");
		$emailContent = '
		<html> 
		<body style="background: #f8f8f8; padding: 20px;">
			<table width="600px" cellpadding="10px" cellspacing="0px" style="background: white; margin: 20px auto; color: black; font-family: sans-serif; font-size: 12px;"> 
				<tr style="background: #0f8a43; color: white"> 
					<td align="right"><a href="www.juvarabrera.comuf.com" style="background: url(http://www.juvarabrera.comuf.com/images/skin/default/logo/mail.png) no-repeat center center; display: inline-block; width: 109px; height: 20px;"></a></td>
			 	</tr>
			 	<tr>
			 		<td style="padding: 20px; line-height: 200%;">
			 			<h1 style="border-bottom: 2px dotted #0f8a43; padding-bottom: 10px;">'.$subject.'</h1>
			 			<p>'.$emailMessage.'</p>
			 		</td>
			 	</tr>
			 	<tr style="background: #ddd; color: #4a4a4a; line-height: 200%;">
			 		<td style="padding: 10px 15px;">
			 			&copy; 2015 Online Enrollment System
			 		</td>
			 	</tr>
			</table>
		</body>
		</html>';
		$headers = "From : admin <noreply@juvarabrera.com>" . "\r\n";
 		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		mail($webmaster, $emailSubject, $emailContent, $headers);
	}

	function getSYStatus() {
		$sy = $this->getSchoolYear();
		return $this->getSingleData("Administration", "Status", "SchoolYear = '$sy'");
	}
}
?>
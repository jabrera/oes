<script src="scripts/jquery.min.js"></script><?php
require_once("library/Config.php");

/*
$n = 4;
for($i = $n; $i >= 0; $i--) {
	for($j = $n - $i + 1; $j <= $n; $j++) {
		echo $j;
	}
	echo '<br>';
}
echo '<br>';

for($i = 1; $i <= $n; $i++) {
	for($j = $n - $i + 1; $j >= 1; $j--) {
		echo $j;
	}
	echo '<br>';
}
*/

/*
$data = mysql_query("SELECT * FROM Schedule WHERE ID IN (SELECT MIN(ID) FROM Schedule WHERE FacultyID IS NULL AND SubjectID = (SELECT SubjectID FROM Expertise WHERE FacultyID = '201500201'))");
while($row = mysql_fetch_array($data)) {
	echo $row["SubjectID"].' - '.$row["SectionID"]."<br>";
}
*/

/*
$query = mysql_query("SELECT DISTINCT GradeSchool FROM Student WHERE GradeSchool IS NOT NULL");
while($row = mysql_fetch_array($query))
	print_r($row);
*/

/*
$n = 4;
for($i = 4; $i > 0; $i--) {
	for($j = 1; $j <= ($n-$i); $j++) {
		echo '-';
	}
	for($j = ($i*2)-1; $j > 0; $j--) {
		echo '*';
	}
	echo '<br>';
}

$num = 1;
$n = 6;
for($i = 1; $i <= $n; $i++) {
	for($j = 1; $j <= $n; $j++) {
		if($num == 10) 
			$num = 0;
		echo $num;
		$num++;
	}
	echo '<br>';
}

//$oes->isTemporary('201520000');
$data = array("1","2","3");
echo $oes->convertArrayToSQL($data);
*/

?>
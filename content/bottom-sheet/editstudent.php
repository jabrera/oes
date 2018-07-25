<?php
$studentData = $oes->getRow("Account INNER JOIN Student", "*", "Account.ID = '$bs_id' AND Account.ID = Student.ID");
?>
<div class="content">
	<h3>Edit Student</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Username</label>
				<br>
				<?php echo $oes->getUserInfo("Username", $studentData["ID"]); ?>
			</td>
			<td>
				<ul class="button-container right">
					<li><a href="?student-master-data&id=<?php echo $bs_id; ?>" class="raised_button">View Full Info</a></li>
				</ul>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<label>Full Name</label>
				<input type="text" name="fname" value="<?php echo $studentData["FirstName"]; ?>" placeholder="First Name">
				<input type="text" name="mname" value="<?php echo $studentData["MiddleName"]; ?>" placeholder="Middle Name">
				<input type="text" name="lname" value="<?php echo $studentData["LastName"]; ?>" placeholder="Last Name">
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<label>Birth date</label>
				<input type="date" name="bday" placeholder="Birth date" value="<?php echo $studentData["BirthDate"]; ?>">
			</td>
		</tr>
		<tr>	
			<td colspan="2">
				<label>Gender</label>
				<select name="gender">
					<?php
					$genders = array("Male", "Female");
					$u_gender = $studentData["Gender"];
					foreach($genders as $gender) {
						$selected = "";
						if($u_gender == $gender) 
							$selected = " selected";
						echo '<option value="'.$gender.'"'.$selected.'>'.$gender.'</option>';
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<label>Grade Level/Section</label>
				<select name="gradelevel">
				</select>
				<select name="section">
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<label>Documents</label><br>
				<?php
				$inputname = array("bc", "form138", "gm");
				$labelname = array("Birth Certificate", "Form-138", "Good Moral");
				for($i = 0; $i < sizeof($labelname); $i++) {
					$columnname = str_replace(" ", "", str_replace("-", "", $labelname[$i]));
					$check = $oes->getSingleData("Student", $columnname, "ID = '$bs_id'");
					$checked = "";
					if($check == "1")
						$checked = " checked";
					echo '<label><input type="checkbox" name="'.$inputname[$i].'"'.$checked.'><span></span>'.$labelname[$i].'</label><br>';

				}
				?>
			</td>
		</tr>
	</table>
	<ul class="button-container right">
		<li><a onclick="showElement('none');" target="_blank" class="raised_button">Cancel</a></li>
		<li><a id="btnUpdate" target="_blank" class="raised_button">Update</a></li>
	</ul>
</div>
<script>
$(document).ready(function() {
	$("#bottom-sheet ul.button-container").hide();
	$("#loading").show("slow");
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getgradelevel",
		data: {equal: '<?php echo $oes->getSingleData("Student", "GradeLevel", "ID = '".$studentData['ID']."'"); ?>'},
		success: function(html) {
			$("#bottom-sheet select[name='gradelevel']").html(html);
			$gl = $("#bottom-sheet [name='gradelevel']").val();
			$.ajax({
				type: "post",
				cache: true,
				url: "process.php?action=getsection",
				data: {gl: $gl, nooption: 1, equal: '<?php echo $oes->getSingleData("GLS", "Section", "ID = '".$studentData['GLS']."'"); ?>'},
				success: function(html) {
					$("#bottom-sheet select[name='section']").html(html);
					$("#bottom-sheet ul.button-container").show();
					$("#loading").hide("slow");
				}
			});
		}
	});
	$("#bottom-sheet [name='gradelevel']").change(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$gl = $(this).val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=getsection",
			data: {gl: $gl, nooption: 1, equal: '<?php echo $oes->getSingleData("GLS", "Section", "ID = '".$studentData['GLS']."'"); ?>'},
			success: function(html) {
				$("#bottom-sheet select[name='section']").html(html);
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
			}
		});
	});
	$("#btnUpdate").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$fname = $("#bottom-sheet [name='fname']").val();
		$mname = $("#bottom-sheet [name='mname']").val();
		$lname = $("#bottom-sheet [name='lname']").val();
		$bday = $("#bottom-sheet [name='bday']").val();
		$gender = $("#bottom-sheet [name='gender']").val();
		$gradelevel = $("#bottom-sheet [name='gradelevel']").val();
		$section = $("#bottom-sheet [name='section']").val();
		$bc = $("#bottom-sheet input[name='bc']").is(":checked");
		$form138 = $("#bottom-sheet input[name='form138']").is(":checked");
		$gm = $("#bottom-sheet input[name='gm']").is(":checked");
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=editstudent",
			data: {id: <?php echo $bs_id; ?>, fname: $fname, mname: $mname, lname: $lname, bday: $bday, gender: $gender, gradelevel: $gradelevel, section: $section, bc: $bc, form138: $form138, gm: $gm},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshListStudent();
			}
		})
	});
});
</script>
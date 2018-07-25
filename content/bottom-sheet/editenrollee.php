<?php
$studentData = $oes->getRow("Account INNER JOIN Student INNER JOIN Enrollee", "*", "Account.ID = '$bs_id' AND Account.ID = Student.ID AND Account.ID = Enrollee.ID");
?>
<div class="content">
	<h3>Edit Enrollee</h3>
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
				<br>
				<?php echo $oes->getNameFormat("f M. l", $studentData["ID"]); ?>
			</td>
		</tr>
		<?php
		if($studentData["AdmissionID"] != "") {
		?>
		<tr>
			<td colspan="2">
				<label>Admission Date</label>
				<br>
				<select name="admission">
					<option value="0">None</option>
				<?php
				if($studentData["GradeLevel"] == 7) {
					$admissions = $oes->getData("Admission", "*", "Entrance = 'Exam'");
				} else {
					$admissions = $oes->getData("Admission", "*", "Entrance = 'Interview'");
				}
				foreach($admissions as $a) {
					$selected = "";
					if($studentData["AdmissionID"] == $a["ID"])
						$selected = " selected";
					echo '<option value="'.$a["ID"].'"'.$selected.'>'.date("F d, Y", strtotime($a["ScheduleDate"])).' - '.date("g:i a", strtotime($a["ScheduleTime"])).'</option>';
				}
				?>
				</select>
			</td>
		</tr>
		<?php
		}
		?>
		<tr>
			<td colspan="2">
				<label>Status</label>
				<select name="status">
					<?php
					$estatus = array("Pending", "Passed", "Failed");
					foreach($estatus as $e) {
						$selected = "";
						if($e == $studentData["EnrollmentStatus"])
							$selected = " selected";
						echo '<option value="'.$e.'"'.$selected.'>'.$e.'</option>';
					}
					?>
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
	$("#btnUpdate").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$admission = $("#bottom-sheet select[name='admission']").val();
		$status = $("#bottom-sheet select[name='status']").val();
		$bc = $("#bottom-sheet input[name='bc']").is(":checked");
		$form138 = $("#bottom-sheet input[name='form138']").is(":checked");
		$gm = $("#bottom-sheet input[name='gm']").is(":checked");
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=editenrollee",
			data: {id: <?php echo $bs_id; ?>, status: $status, admission: $admission, bc: $bc, form138: $form138, gm: $gm},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshListEnrollee();
			}
		});
	});
});
</script>
<div class="content">
	<h3>Edit Grade</h3>
	<?php
	$student = $bs_id[0];
	$subject = $bs_id[1];
	$quarter = $bs_id[2];
	$sy = $oes->getSchoolYear();
	?>
	<table class="form-container">
		<tr>
			<td>
				<label>Student</label>
				<br>
				<?php
				echo $oes->getNameFormat("f M. l", $student);
				?>
			</td>
		</tr>
		<tr>
			<td>
				<label>Subject</label>
				<br>
				<?php
				echo $oes->getSingleData("Subject", "Name", "ID = '$subject'");
				?>
			</td>
		</tr>
		<tr>
			<td>
				<label>Quarter</label>
				<br>
				<?php
				if($quarter == 1) {
					echo "First Quarter";
				} elseif($quarter == 2) {
					echo "Second Quarter";
				} elseif($quarter == 3) {
					echo "Third Quarter";
				} elseif($quarter == 4) {
					echo "Fourth Quarter";
				}
				?>
			</td>
		</tr>
		<tr>
			<td>
				<label>Grade</label>
				<input type="number" name="grade" value="<?php 
				echo $oes->getSingleData("Grade", "Grade", "SchoolYear = '$sy' AND Quarter = '$quarter' AND StudentID = '".$student."' AND SubjectID = '$subject'");
				?>">
			</td>
		</tr>
	</table>
	<ul class="button-container right">
		<li><a onclick="showElement('none');" target="_blank" class="raised_button">Cancel</a></li>
		<li><a id="btnEdit" target="_blank" class="raised_button">Encode</a></li>
	</ul>
</div>
<script>
$(document).ready(function() {
	$("#btnEdit").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$grade = $("#bottom-sheet input[name='grade']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=editgrade",
			data: {student: '<?php echo $student; ?>', quarter: '<?php echo $quarter; ?>', subject: '<?php echo $subject; ?>', grade: $grade},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshStudentList('<?php echo $quarter; ?>');
			}
		});
	});
})
</script>
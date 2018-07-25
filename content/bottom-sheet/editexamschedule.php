<?php
$examData = $oes->getRow("Admission", "*", "ID = '$bs_id'");
?>
<div class="content">
	<h3>Edit Exam Schedule</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Exam Date</label>
				<input type="date" name="examdate" value="<?php echo $examData["ScheduleDate"]; ?>">
			</td>
		</tr>
		<tr>
			<td>
				<label>Exam Time</label>
				<input type="time" name="examtime" value="<?php echo $examData["ScheduleTime"]; ?>">
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
		$examdate = $("#bottom-sheet input[name='examdate']").val();
		$examtime = $("#bottom-sheet input[name='examtime']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=editexamschedule",
			data: {id: '<?php echo $bs_id; ?>', examdate: $examdate, examtime: $examtime},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshAdmissionDates();
			}
		});
	});
})
</script>
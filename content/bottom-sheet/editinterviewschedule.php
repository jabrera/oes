<?php
$interviewData = $oes->getRow("Admission", "*", "ID = '$bs_id'");
?>
<div class="content">
	<h3>Edit Interview Schedule</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Interview Date</label>
				<input type="date" name="interviewdate" value="<?php echo $interviewData["ScheduleDate"]; ?>">
			</td>
		</tr>
		<tr>
			<td>
				<label>Interview Time</label>
				<input type="time" name="interviewtime" value="<?php echo $interviewData["ScheduleTime"]; ?>">
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
		$interviewdate = $("#bottom-sheet input[name='interviewdate']").val();
		$interviewtime = $("#bottom-sheet input[name='interviewtime']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=editinterviewschedule",
			data: {id: '<?php echo $bs_id; ?>', interviewdate: $interviewdate, interviewtime: $interviewtime},
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
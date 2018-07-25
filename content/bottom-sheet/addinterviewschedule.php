<div class="content">
	<h3>Add Interview Schedule</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Interview Date</label>
				<input type="date" name="interviewdate">
			</td>
		</tr>
		<tr>
			<td>
				<label>Interview Time</label>
				<input type="time" name="interviewtime">
			</td>
		</tr>
	</table>
	<ul class="button-container right">
		<li><a onclick="showElement('none');" target="_blank" class="raised_button">Cancel</a></li>
		<li><a id="btnAdd" target="_blank" class="raised_button">Add</a></li>
	</ul>
</div>
<script>
$(document).ready(function() {
	$("#btnAdd").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$interviewdate = $("#bottom-sheet input[name='interviewdate']").val();
		$interviewtime = $("#bottom-sheet input[name='interviewtime']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=addinterviewschedule",
			data: {interviewdate: $interviewdate, interviewtime: $interviewtime},
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
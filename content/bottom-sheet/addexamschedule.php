<div class="content">
	<h3>Add Exam Schedule</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Exam Date</label>
				<input type="date" name="examdate">
			</td>
		</tr>
		<tr>
			<td>
				<label>Exam Time</label>
				<input type="time" name="examtime">
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
		$examdate = $("#bottom-sheet input[name='examdate']").val();
		$examtime = $("#bottom-sheet input[name='examtime']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=addexamschedule",
			data: {examdate: $examdate, examtime: $examtime},
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
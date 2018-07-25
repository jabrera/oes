<div class="content">
	<h3>Exam Settings</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Maximum examinees per date/time</label>
				<input type="number" name="max" value="<?php echo $oes->getSingleData("Administration", "MaxExaminees", "SchoolYear = '".$oes->getSchoolYear()."'"); ?>">
			</td>
		</tr>
	</table><br>
	<ul class="button-container right">
		<li><a onclick="showElement('none');" target="_blank" class="raised_button">Cancel</a></li>
		<li><a id="btnSave" target="_blank" class="raised_button">Save</a></li>
	</ul>
</div>
<script>
$(document).ready(function() {
	$("#btnSave").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$max = $("#bottom-sheet input[name='max']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=editexamsettings",
			data: {max: $max},
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
<div class="content">
	<h3>Edit Due Date</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Applicable Month</label>
				<br>
				<?php
				echo date("F Y", strtotime($bs_id));
				?>
			</td>
		</tr>
		<tr>
			<td>
				<label>Due Date</label>
				<input type="date" name="duedate" value="<?php echo date("Y-m-d", strtotime($oes->getSingleData("Administration", "Due_".date("F", strtotime($bs_id)), "SchoolYear = '".$oes->getSchoolYear()."'"))); ?>">
			</td>
		</tr>
	</table>
	<ul class="button-container right">
		<li><a onclick="showElement('none');" target="_blank" class="raised_button">Cancel</a></li>
		<li><a id="btnEdit" target="_blank" class="raised_button">Edit</a></li>
	</ul>
</div>
<script>
$(document).ready(function() {
	$("#btnEdit").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$duedate = $("#bottom-sheet input[name='duedate']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=editdue",
			data: {month: '<?php echo $bs_id; ?>', duedate: $duedate},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshPaymentDue();
			}
		});
	});
})
</script>
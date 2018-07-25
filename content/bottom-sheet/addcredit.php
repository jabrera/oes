<div class="content">
	<h3>Add Credits</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Student</label>
				<br>
				<?php echo $oes->getNameFormat("f M. l", $bs_id); ?>
			</td>
		</tr>
		<tr>
			<td>
				<label>Credit</label>
				<input type="number" name="credit" placeholder="Credit">
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
		$credit = $("#bottom-sheet input[name='credit']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=addcredit",
			data: {id: '<?php echo $bs_id; ?>', credit: $credit},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshListStudentPayment('<?php echo $bs_id; ?>');
			}
		});
	});
})
</script>
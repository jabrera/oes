<div class="content">
	<h3>Apply Surcharges</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Applicable Month</label>
				<select name="month">
				<?php
				$sy = $oes->getSchoolYear();
				$months = array($sy."-08-01", $sy."-09-01", $sy."-10-01", $sy."-11-01", $sy."-12-01", ($sy+1)."-01-01", ($sy+1)."-02-01", ($sy+1)."-03-01", ($sy+1)."-04-01");
				foreach($months as $month) {
					echo '<option value="'.$month.'">'.date("F Y", strtotime($month)).'</option>';
				}
				?>
				</select>
			</td>
		</tr>
	</table>
	<ul class="button-container right">
		<li><a onclick="showElement('none');" target="_blank" class="raised_button">Cancel</a></li>
		<li><a id="btnAdd" target="_blank" class="raised_button">Apply</a></li>
	</ul>
</div>
<script>
$(document).ready(function() {
	$("#btnAdd").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$month = $("#bottom-sheet select[name='month']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=applysurcharges",
			data: {month: $month},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
			}
		});
	});
})
</script>
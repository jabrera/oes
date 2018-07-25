<div class="content">
	<h3>Edit Enrollees' Status</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Status</label>
				<select name="status">
					<?php
					$estatus = array("Pending", "Passed", "Failed");
					foreach($estatus as $e) {
						$selected = "";
						if($e == $oes->getSingleData("Enrollee", "EnrollmentStatus", "ID = '".$bs_id[0]."'"))
							$selected = " selected";
						echo '<option value="'.$e.'"'.$selected.'>'.$e.'</option>';
					}
					?>
				</select>
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
		$status = $("#bottom-sheet select[name='status']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=editenrolleestatus_data",
			data: {id: <?php echo $oes->convertPHPArrayToJS($bs_id); ?>, status: $status},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshListEnrollee();
			}
		})
	});
});
</script>
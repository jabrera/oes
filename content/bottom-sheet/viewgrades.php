<?php

?>
<div class="content">
	<h3>View Grade Report</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>School Year</label>
				<select name="sy">
					<?php
					$sy = "";
					$sys = mysql_query("SELECT DISTINCT SchoolYear FROM Grade WHERE StudentID = '$bs_id' ORDER BY SchoolYear DESC");
					while($row = mysql_fetch_array($sys)) {
						$sy = $row["SchoolYear"];
						echo '<option value="'.$row["SchoolYear"].'">School Year '.$row["SchoolYear"].' - '.($row["SchoolYear"]+1).'</option>';
					}
					?>
				</select>
			</td>
		</tr>
	</table>
	<ul class="button-container right">
		<li><a onclick="showElement('none');" target="_blank" class="raised_button">Cancel</a></li>
		<li><a id="btnSubmit" target="_blank" class="raised_button">View</a></li>
	</ul>
</div>
<script>
$(document).ready(function() {
	$("#btnSubmit").click(function() {
		$sy = $("#bottom-sheet select[name='sy']").val();
		if($sy != null) {
			showElement("none");
			window.open('paper.php?grade&id=<?php echo $bs_id; ?>&sy='+$sy, '_blank');
		} else {
			showSnackbarMsg('Invalid school year');
		}
	});
})
</script>
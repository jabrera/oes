<?php
$buildingData = $oes->getRow("Building", "*", "ID = '$bs_id'");
?>
<div class="content">
	<h3>Edit Building</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Building Name</label>
				<input type="text" name="name" value="<?php echo $buildingData["Name"]; ?>" placeholder="Building Name">
			</td>
		</tr>
		<tr>
			<td>
				<label>Building Code</label>
				<input type="text" name="code" value="<?php echo $buildingData["Code"]; ?>" placeholder="Building Code">
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
		$name = $("#bottom-sheet [name='name']").val();
		$code = $("#bottom-sheet [name='code']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=editbuilding",
			data: {id: <?php echo $bs_id; ?>, name: $name, code: $code},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshListBuilding();
			}
		})
	});
});
</script>
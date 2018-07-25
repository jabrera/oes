<?php
$roomData = $oes->getRow("Room", "*", "ID = '$bs_id'");
?>
<div class="content">
	<h3>Edit College</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Room Name</label>
				<input type="text" name="name" value="<?php echo $roomData["Name"]; ?>" placeholder="Room Name">
			</td>
		</tr>
		<tr>
			<td>
				<label>Building</label>
				<select name="building">
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
	$("#bottom-sheet ul.button-container").hide();
	$("#loading").show("slow");
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getbuilding",
		data: {buildingID: 'exact', equal: '<?php echo $oes->getSingleData("Room", "BuildingID", $bs_id); ?>'},
		success: function(html) {
			$("#bottom-sheet select[name='building']").html(html);
			$("#bottom-sheet ul.button-container").show();
			$("#loading").hide("slow");
		}
	});
	$("#btnUpdate").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$name = $("#bottom-sheet [name='name']").val();
		$building = $("#bottom-sheet [name='building']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=editroom",
			data: {id: <?php echo $bs_id; ?>, name: $name, building: $building},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshListRoom();
			}
		})
	});
});
</script>
<?php
$sectionData = $oes->getRow("GLS", "*", "ID = '$bs_id'");
?>
<div class="content">
	<h3>Change Default Room</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Building Name</label>
				<select name="building" id="ddlBuilding"></select>
			</td>
		</tr>
		<tr>
			<td>
				<label>Room Name</label>
				<select name="room" id="ddlRoom"></select>
			</td>
		</tr>
	</table>
	<ul class="button-container right">
		<li><a onclick="showElement('none');" target="_blank" class="raised_button">Cancel</a></li>
		<li><a id="btnSet" target="_blank" class="raised_button">Set Default</a></li>
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
		data: {equal: '<?php echo $oes->getSingleData("Room", "BuildingID", "ID = '".$sectionData["RoomID"]."'"); ?>'},
		success: function(html) {
			$("#bottom-sheet #ddlBuilding").html(html);
			$val = $("#bottom-sheet #ddlBuilding").val();
			$.ajax({
				type: "post",
				cache: true,
				url: "process.php?action=getroom",
				data: {buildingID: $val, getnotdefaultroom: 1, equal: '<?php echo $sectionData["RoomID"]; ?>'},
				success: function(html) {
					$("#bottom-sheet ul.button-container").show();
					$("#loading").hide("slow");
					$("#bottom-sheet #ddlRoom").html(html);
				}
			})
		}
	});
	$("#bottom-sheet #ddlBuilding").change(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$val = $(this).val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=getroom",
			data: {buildingID: $val, getnotdefaultroom: 1, equal: '<?php echo $sectionData["RoomID"]; ?>'},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#bottom-sheet #ddlRoom").html(html);
			}
		})
	})
	$("#btnSet").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$room = $("#bottom-sheet select[name='room']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=setdefaultroom",
			data: {section: '<?php echo $bs_id; ?>', room: $room},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshListSectionSchedule();
			}
		});
	});
})
</script>
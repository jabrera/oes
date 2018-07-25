<div class="content">
	<h3>Add Room</h3>
	<table class="form-container">
		<tr>
			<td colspan="2">
				<label><input type="radio" name="type" value="single" checked="checked"><span></span>Single room</label>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<label>Room Name</label>
				<input type="text" name="name" placeholder="Room Name">
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<label><input type="radio" name="type" value="multiple"><span></span>Multiple rooms</label>
			</td>
		</tr>
		<tr>
			<td>
				<label>Room No. From</label>
				<input type="text" name="from" placeholder="Room No. From">
			</td>
			<td width="50%">
				<label>Room No. To</label>
				<input type="text" name="to" placeholder="Room No. To">
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<label>Building</label>
				<select name="building">
				</select>
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
	$("#bottom-sheet ul.button-container").hide();
	$("#loading").show("slow");
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getbuilding",
		data: {buildingID: 'all'},
		success: function(html) {
			$("#bottom-sheet select[name='building']").html(html);
			$("#bottom-sheet ul.button-container").show();
			$("#loading").hide("slow");
		}
	});
	$("#btnAdd").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$name = $("#bottom-sheet input[name='name']").val();
		$building = $("#bottom-sheet [name='building']").val();
		$type = $("#bottom-sheet [name='type']:checked").val();
		$from = $("#bottom-sheet [name='from']").val();
		$to = $("#bottom-sheet [name='to']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=addroom",
			data: {name: $name, building: $building, type: $type, from: $from, to: $to},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshListRoom();
			}
		});
	});
})
</script>
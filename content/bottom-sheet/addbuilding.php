<div class="content">
	<h3>Add Building</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Building Name</label>
				<input type="text" name="name" placeholder="Building Name">
			</td>
		</tr>
		<tr>
			<td>
				<label>Building Code</label>
				<input type="text" name="code" placeholder="Building Code">
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
		$name = $("#bottom-sheet input[name='name']").val();
		$code = $("#bottom-sheet input[name='code']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=addbuilding",
			data: {name: $name, code: $code},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshListBuilding();
			}
		});
	});
})
</script>
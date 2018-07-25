<div class="content">
	<h3>Add College</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>College Name</label>
				<input type="text" name="name" placeholder="College Name">
			</td>
		</tr>
		<tr>
			<td>
				<label>College Code</label>
				<input type="text" name="code" placeholder="College Code">
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
			url: "process.php?action=addcollege",
			data: {name: $name, code: $code},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshListCollege();
			}
		});
	});
})
</script>
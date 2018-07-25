<div class="content">
	<h3>Add Department</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Department Name</label>
				<input type="text" name="name" placeholder="Department Name">
			</td>
		</tr>
		<tr>
			<td>
				<label>Department Code</label>
				<input type="text" name="code" placeholder="Department Code">
			</td>
		</tr>
		<tr>
			<td>
				<label>College</label>
				<select name="college">
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
		url: "process.php?action=getcollege",
		data: {collegeID: 'all'},
		success: function(html) {
			$("#bottom-sheet select[name='college']").html(html);
			$("#bottom-sheet ul.button-container").show();
			$("#loading").hide("slow");
		}
	});
	$("#btnAdd").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$name = $("#bottom-sheet input[name='name']").val();
		$code = $("#bottom-sheet input[name='code']").val();
		$college = $("#bottom-sheet [name='college']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=adddepartment",
			data: {name: $name, code: $code, college: $college},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshListDepartment();
			}
		});
	});
})
</script>
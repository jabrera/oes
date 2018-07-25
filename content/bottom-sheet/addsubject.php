<div class="content">
	<h3>Add Subject</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Subject Name</label>
				<input type="text" name="name" placeholder="Subject Name">
			</td>
		</tr>
		<tr>
			<td>
				<label>Subject Code</label>
				<input type="text" name="code" placeholder="Subject Code">
			</td>
		</tr>
		<tr>
			<td>
				<label>Units</label>
				<select name="units">
					<?php
					for($i = 0; $i <= 5; $i++) 
						echo '<option value="'.$i.'">'.$i.'</option>';
					?>
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
	$("#btnAdd").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$name = $("#bottom-sheet input[name='name']").val();
		$code = $("#bottom-sheet input[name='code']").val();
		$units = $("#bottom-sheet [name='units']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=addsubject",
			data: {name: $name, code: $code, units: $units},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshListSubject();
			}
		});
	});
})
</script>
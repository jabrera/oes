<div class="content">
	<h3>Add Section</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Section Name</label>
				<input type="text" name="section" placeholder="Section Name">
			</td>
		</tr>
		<tr>
			<td>
				<label>Grade Level</label>
				<select name="gradelevel">
					<?php
					for($i = 7; $i <= 12; $i++) 
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
		$section = $("#bottom-sheet input[name='section']").val();
		$gradelevel = $("#bottom-sheet [name='gradelevel']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=addsection",
			data: {section: $section, gl: $gradelevel},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshListSection();
			}
		});
	});
})
</script>
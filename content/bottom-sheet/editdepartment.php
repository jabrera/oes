<?php
$departmentData = $oes->getRow("Department", "*", "ID = '$bs_id'");
?>
<div class="content">
	<h3>Edit College</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Department Name</label>
				<input type="text" name="name" value="<?php echo $departmentData["Name"]; ?>" placeholder="Department Name">
			</td>
		</tr>
		<tr>
			<td>
				<label>Department Code</label>
				<input type="text" name="code" value="<?php echo $departmentData["Code"]; ?>" placeholder="Department Code">
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
		url: "process.php?action=getcollege",
		data: {collegeID: 'exact', equal: '<?php echo $oes->getSingleData("Department", "CollegeID", $bs_id); ?>'},
		success: function(html) {
			$("#bottom-sheet select[name='college']").html(html);
			$("#bottom-sheet ul.button-container").show();
			$("#loading").hide("slow");
		}
	});
	$("#btnUpdate").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$name = $("#bottom-sheet [name='name']").val();
		$code = $("#bottom-sheet [name='code']").val();
		$college = $("#bottom-sheet [name='college']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=editdepartment",
			data: {id: <?php echo $bs_id; ?>, name: $name, code: $code, college: $college},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshListDepartment();
			}
		})
	});
});
</script>
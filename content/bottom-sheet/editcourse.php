<?php
$courseData = $oes->getRow("Course", "*", "ID = '$bs_id'");
?>
<div class="content">
	<h3>Edit College</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Course Name</label>
				<input type="text" name="name" value="<?php echo $courseData["Name"]; ?>" placeholder="Course Name">
			</td>
		</tr>
		<tr>
			<td>
				<label>Course Code</label>
				<input type="text" name="code" value="<?php echo $courseData["Code"]; ?>" placeholder="Course Code">
			</td>
		</tr>
		<tr>
			<td>
				<label>College</label>
				<select name="college">
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label>Year Course</label>
				<select name="yearcourse">
					<?php
					$yearcourse = $oes->getSingleData("Course", "YearCourse", "ID = '$bs_id'");
					for($i = 1; $i <= 5; $i++) {
						$selected = "";
						if($i == $yearcourse)
							$selected = " selected";
						echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
					}
					?>
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
		data: {collegeID: 'exact', equal: '<?php echo $oes->getSingleData("Course", "CollegeID", $bs_id); ?>'},
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
		$yearcourse = $("#bottom-sheet [name='yearcourse']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=editcourse",
			data: {id: <?php echo $bs_id; ?>, name: $name, code: $code, college: $college, yearcourse: $yearcourse},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshListCourse();
			}
		})
	});
});
</script>
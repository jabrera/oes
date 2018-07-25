<?php
$courseData = $oes->getRow("Subject", "*", "ID = '$bs_id'");
?>
<div class="content">
	<h3>Edit College</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Subject Name</label>
				<input type="text" name="name" value="<?php echo $courseData["Name"]; ?>" placeholder="Subject Name">
			</td>
		</tr>
		<tr>
			<td>
				<label>Subject Code</label>
				<input type="text" name="code" value="<?php echo $courseData["Code"]; ?>" placeholder="Subject Code">
			</td>
		</tr>
		<tr>
			<td>
				<label>Units</label>
				<select name="units">
					<?php
					$units = $oes->getSingleData("Subject", "Units", "ID = '$bs_id'");
					for($i = 0; $i <= 5; $i++) {
						$selected = "";
						if($i == $units)
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
	$("#btnUpdate").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$name = $("#bottom-sheet [name='name']").val();
		$code = $("#bottom-sheet [name='code']").val();
		$units = $("#bottom-sheet [name='units']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=editsubject",
			data: {id: <?php echo $bs_id; ?>, name: $name, code: $code, units: $units},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshListSubject();
			}
		})
	});
});
</script>
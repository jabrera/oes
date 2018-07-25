<?php
$gls = $oes->getRow("GLS", "*", "ID = '$bs_id'");
?>
<div class="content">
	<h3>Edit Section</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Section Name</label>
				<input type="text" name="section" value="<?php echo $gls["Section"]; ?>" placeholder="Section Name">
			</td>
		</tr>
		<tr>
			<td>
				<label>Grade Level</label>
				<select name="gradelevel">
					<?php
					for($i = 7; $i <= 12; $i++) {
						$selected = "";
						if($i == $gls["GradeLevel"])
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
		$section = $("#bottom-sheet [name='section']").val();
		$gradelevel = $("#bottom-sheet [name='gradelevel']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=editsection",
			data: {id: <?php echo $bs_id; ?>, section: $section, gl: $gradelevel},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshListSection();
			}
		})
	});
});
</script>
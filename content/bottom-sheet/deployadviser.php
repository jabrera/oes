<?php
$sectionData = $oes->getRow("GLS", "*", "ID = '$bs_id'");
?>
<div class="content">
	<h3>Deploy Adviser</h3>
	<table class="list">
		<tr class="title">
			<td width="1px"></td>
			<td>Current Adviser</td>
		</tr>
		<tr>
			<td>
				<label><input type="radio" name="adviser_option" value="<?php echo $sectionData["FacultyID"]; ?>" checked><span></span></label>
			</td>
			<td><?php 
			if($sectionData["FacultyID"] == "0") {
				echo 'No faculty assigned';
			} else {
				echo  $oes->getNameFormat("l, f M.", $sectionData["FacultyID"]);
			}
			?></td>
		</tr>
		<tr class="title">
			<td width="1px">
			</td>
			<td>Faculty</td>
		</tr>
		<?php
		if($sectionData["FacultyID"] != "0") {
		?>
		<tr>
			<td>
				<label><input type="radio" name="adviser_option" value="0"><span></span></label>
			</td>
			<td>No adviser</td>
		</tr>
		<?php
		}
		$facultyData = $oes->getData("Faculty", "*", "ID NOT IN (SELECT FacultyID FROM GLS) ORDER BY LastName");
		foreach($facultyData as $data) {
		?>
		<tr>
			<td>
				<label><input type="radio" name="adviser_option" value="<?php echo $data["ID"]; ?>"><span></span></label>
			</td>
			<td><?php echo $oes->getNameFormat("l, f M.", $data["ID"]); ?></td>
		</tr>
		<?php
		}
		if(empty($facultyData)) {
		?>
		<tr>
			<td colspan="2"><center><i><br>No available faculty.<br><br></i></center></td>
		</tr>
		<?php
		}
		?>
	</table><br>
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
		$faculty = $("#bottom-sheet input[name='adviser_option']:checked").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=deployadviser",
			data: {section: '<?php echo $bs_id; ?>', faculty: $faculty},
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
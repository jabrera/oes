<div class="content">
<?php
if($bs_id[2] == 1) $qstr = "FirstQuarter";
elseif($bs_id[2] == 2) $qstr = "SecondQuarter";
elseif($bs_id[2] == 3) $qstr = "ThirdQuarter";
elseif($bs_id[2] == 4) $qstr = "FourthQuarter";
$sy = $oes->getSchoolYear();
$qstatus = $oes->getSingleData("Administration", $qstr, "SchoolYear = '$sy'");
if($qstatus == 1) {
?>
	<h3>Encode Grades</h3>
	<p>You can encode grades for students using an excel (.xls) file.</p>
	<form action="process.php?action=encodegrades" method="post" enctype="multipart/form-data">
	<table class="form-container">
		<tr>
			<td><label>Grade Level/Section</label>
			<br>Grade <?php echo $oes->getSingleData("GLS", "GradeLevel", "ID = '".$bs_id[0]."'").$oes->getSingleData("GLS", "Section", "ID = '".$bs_id[0]."'"); ?>
			</td>
		</tr>
		<tr>
			<td><label>Subject</label>
			<br><?php echo $oes->getSingleData("Subject", "Name", "ID = '".$bs_id[1]."'"); ?>
			</td>
		</tr>
		<tr>
			<td><label>Quarter</label>
			<br><?php
			switch($bs_id[2]) {
				case 1:
					echo 'First Quarter';
					break;
				case 2:
					echo 'Second Quarter';
					break;
				case 3:
					echo 'Third Quarter';
					break;
				case 4:
					echo 'Fourth Quarter';
					break;
			} 
			?>
			</td>
		</tr>
		<tr>
			<td><label>Select file to import</label></td>
		</tr>
		<tr>
			<td><input type="file" name="import" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"></td>
		</tr>
	</table>
	<input type="hidden" name="section" value="<?php echo $bs_id[0]; ?>">
	<input type="hidden" name="subject" value="<?php echo $bs_id[1]; ?>">
	<input type="hidden" name="quarter" value="<?php echo $bs_id[2]; ?>">
	<br>
	<ul class="button-container right">
		<li><a onclick="showElement('none');" target="_blank" class="raised_button">Cancel</a></li>
		<li><input type="submit" value="Import" name="submit"></li>
	</ul>
	</form>
<?php
} else {
?>
<h3>Message</h3>
<p>You cannot encode grades in this quarter of school year.</p>
<?php
}
?>
</div>
<script>
$(document).ready(function() {
	$("#bottom-sheet input[name=submit]").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
	})
});
</script>
<div class="content">
	<h3>Select Class</h3>
	<hr>
	<ul class="list-option">
		<?php
		$faculty = $bs_id[0];
		$section = $bs_id[1];
		$schedule = mysql_query("SELECT DISTINCT SubjectID FROM Schedule WHERE FacultyID = '$faculty' AND SectionID = '$section'");
		$n = 0;
		while($s = mysql_fetch_array($schedule)) {
			$n = 1;
		?>
			<li><a id="listschedule_<?php echo $s["SubjectID"]; ?>"><?php echo $oes->getSingleData("Subject", "Name", "ID = '".$s["SubjectID"]."'"); ?></a></li>
			<script>
			$(document).ready(function() {
				$("#bottom-sheet #listschedule_<?php echo $s["SubjectID"]; ?>").click(function() {
					showElement('none');
					$("#loading").show("slow");
					refreshGrades('<?php echo $section; ?>', '<?php echo $s["SubjectID"]; ?>');
				})
			});
			</script>
		<?php
		}
		if($n == 0) {
			echo '<br><center><small><i>No class found.</i></small></center><br>';
		}
		?>
	</ul>
</div>
<script>
$(document).ready(function() {

})
</script>
<?php
$scheduleData = $oes->getRow("Schedule", "*", "ID = '$db_id'");
?>
<span class="title">Subject Information</span>
<p>
	<ul class="list">
		<li>
			<div class="primary"><span>Subject</span><span><?php echo ($scheduleData["SubjectID"] == null ? $scheduleData["Break"] : $oes->getSingleData("Subject", "Name", "ID = '".$scheduleData["SubjectID"]."'")); ?></span></div>
		</li>
		<li>
			<div class="primary"><span>Day</span><span><?php echo $oes->getFullDayName($scheduleData["Day"]); ?></span></div>
		</li>
		<li>
			<div class="primary"><span>Time</span><span><?php echo date("g:i a", strtotime($scheduleData["StartTime"])).' - '.date("g:i a", strtotime($scheduleData["EndTime"])); ?></span></div>
		</li>
		<li>
			<div class="primary"><span>Section</span><span>Grade <?php echo $oes->getSingleData("GLS", "GradeLevel", "ID = '".$scheduleData["SectionID"]."'").$oes->getSingleData("GLS", "Section", "ID = '".$scheduleData["SectionID"]."'"); ?></span></div>
		</li>
	</ul>
</p>
<ul class="button-container right">
	<li><a onclick="showElement('none')" class="flat_button">Close</a></li>
</ul>
<script>
$(document).ready(function() {

});
</script>
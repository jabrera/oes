<?php
$scheduleData = $oes->getRow("Schedule", "*", "ID = '$db_id'");
?>
<span class="title">Message</span>
<p>
	Are you sure you want to delete this subject in this schedule?
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
	</ul>
</p>
<ul class="button-container right">
	<li><a onclick="showElement('none')" class="flat_button">No</a></li>
	<li><a id="btnDelete" class="flat_button">Yes</a></li>
</ul>
<script>
$(document).ready(function() {
	$("#btnDelete").click(function() {
		$("#dialog-box ul.button-container").hide();
		$("#loading").show("slow");
		$("#dialog-box").css({
			"margin-top": "-"+(($("#dialog-box").height()/2).toFixed())+"px"
		});
		$.ajax({
			type: "post",
			cache: false,
			url: "process.php?action=deletefacultyschedule",
			data: {id: '<?php echo $db_id; ?>'},
			success: function(html) {
				showElement('none');
				refreshListFacultySchedule('<?php echo $scheduleData["FacultyID"]; ?>');
				$("#snackbar .wrapper").html(html);
			}
		})
	});
});
</script>
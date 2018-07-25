<span class="title">Message</span>
<p>
	<?php
	$schedule = $oes->getData("Schedule", "*", "FacultyID IS NOT NULL");
	if(!empty($schedule)) 
		echo 'Generating a new schedule will overwrite the current schedule of some faculty. Are you sure you want to generate a new schedule?';
	else
		echo 'Are you sure you want to automatically generate a schedule to all teachers?';
	?>
</p>
<ul class="button-container right">
	<li><a onclick="showElement('none')" class="flat_button">No</a></li>
	<li><a id="btnGenerate" class="flat_button">Yes</a></li>
</ul>
<script>
$(document).ready(function() {
	$("#btnGenerate").click(function() {
		$("#dialog-box ul.button-container").hide();
		$("#loading").show("slow");
		$("#dialog-box").css({
			"margin-top": "-"+(($("#dialog-box").height()/2).toFixed())+"px"
		});
		$.ajax({
			type: "post",
			cache: false,
			url: "process.php?action=auto_generate_schedule_to_faculty",
			success: function(html) {
				showElement('none');
				refreshListFacultySchedule();
				$("#snackbar .wrapper").html(html);
			}
		})
	});
});
</script>
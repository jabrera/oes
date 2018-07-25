<span class="title">Message</span>
<p>
	Are you sure you want to delete this exam schedule?
	<ul class="list">
		<li>
			<div class="primary"><span>Exam Date</span><span><?php echo $oes->getSingleData("Admission", "ScheduleDate", "ID = '$db_id'"); ?></span></div>
		</li>
		<li>
			<div class="primary"><span>Exam Time</span><span><?php echo $oes->getSingleData("Admission", "ScheduleTime", "ID = '$db_id'"); ?></span></div>
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
			url: "process.php?action=deleteexamschedule",
			data: {id: '<?php echo $db_id; ?>'},
			success: function(html) {
				showElement('none');
				refreshAdmissionDates();
				$("#snackbar .wrapper").html(html);
			}
		})
	});
});
</script>
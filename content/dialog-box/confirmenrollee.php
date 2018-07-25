<span class="title">Message</span>
<p>
	Are you sure you want to confirm this enrollee?
	<ul class="list">
		<li>
			<div class="primary"><span>Name</span><span><?php echo $oes->getNameFormat("f M. l", $db_id); ?></span></div>
		</li>
		<li>
			<div class="primary"><span>Admission Date</span><span><?php
			echo date("F d, Y", strtotime($oes->getSingleData("Admission", "ScheduleDate", "ID = '".$oes->getSingleData("Enrollee", "AdmissionID", "ID = '$db_id'")."'"))).' - '.date("g:i a", strtotime($oes->getSingleData("Admission", "ScheduleTime", "ID = '".$oes->getSingleData("Enrollee", "AdmissionID", "ID = '$db_id'")."'")));
			?></span></div>
		</li>
		<li>
			<div class="primary"><span>Confirmation Hash</span><span><?php
			echo $oes->getSingleData("Student", "Hash", "ID = '$db_id'");
			?></span></div>
		</li>
	</ul>
</p>
<ul class="button-container right">
	<li><a onclick="showElement('none')" class="flat_button">No</a></li>
	<li><a id="btnConfirm" class="flat_button">Confirm</a></li>
</ul>
<script>
$(document).ready(function() {
	$("#btnConfirm").click(function() {
		$("#dialog-box ul.button-container").hide();
		$("#loading").show("slow");
		$("#dialog-box").css({
			"margin-top": "-"+(($("#dialog-box").height()/2).toFixed())+"px"
		});
		$.ajax({
			type: "post",
			cache: false,
			url: "process.php?action=confirmenrollee",
			data: {id: '<?php echo $db_id; ?>'},
			success: function(html) {
				showElement('none');
				refreshListPassedEnrollee();
				$("#snackbar .wrapper").html(html);
			}
		})
	});
});
</script>
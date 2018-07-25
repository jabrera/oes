<?php
$query = $oes->getData("Account INNER JOIN Enrollee INNER JOIN Student", "*", "Student.ID = Account.ID AND Enrollee.ID = Account.ID AND Account.Type = 'Enrollee' AND Enrollee.AdmissionID = '0' AND Student.GradeLevel = '7' AND Account.Status = 'Active'");
?>
<span class="title">Message</span>
<p>
	Are you sure you want to automatically assign <?php echo sizeof($query); if(sizeof($query) > 1) echo ' enrollees'; else echo ' enrollee';  ?> to admission dates?
</p>
<ul class="button-container right">
	<li><a onclick="showElement('none')" class="flat_button">No</a></li>
	<li><a id="btnAssign" class="flat_button">Yes</a></li>
</ul>
<script>
$(document).ready(function() {
	$("#btnAssign").click(function() {
		$("#dialog-box ul.button-container").hide();
		$("#loading").show("slow");
		$("#dialog-box").css({
			"margin-top": "-"+(($("#dialog-box").height()/2).toFixed())+"px"
		});
		$.ajax({
			type: "post",
			cache: false,
			url: "process.php?action=auto_assign_edate_to_enrollee",
			success: function(html) {
				showElement('none');
				refreshAdmissionDates();
				$("#snackbar .wrapper").html(html);
			}
		})
	});
});
</script>
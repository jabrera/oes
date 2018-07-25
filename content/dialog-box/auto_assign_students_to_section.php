<?php
$query = $oes->getData("Student INNER JOIN Account", "*", "Student.ID = Account.ID AND Account.Type = 'Student' AND Student.GLS = '0' AND Account.Status = 'Active'");
?>
<span class="title">Message</span>
<p>
	Are you sure you want to automatically assign <?php echo sizeof($query); if(sizeof($query) > 1) echo ' students'; else echo ' student';  ?> to sections?
	<ul class="list">
	<?php
	for($i = 7; $i <= 10; $i++) {
		$q1 = $oes->getData("Student INNER JOIN Account", "*", "Student.ID = Account.ID AND Account.Type = 'Student' AND Student.GLS = '0' AND Student.GradeLevel = '$i' AND Account.Status = 'Active'");
		if(sizeof($q1)) {
	?>
		<li>
			<div class="primary"><span>Grade <?php echo $i; ?></span><span><?php echo sizeof($q1); if(sizeof($q1) > 1) echo ' students'; else echo ' student';  ?></span></div>
		</li>
	<?php
		}
	}
	?>
	</ul>
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
			url: "process.php?action=auto_assign_students_to_section",
			success: function(html) {
				showElement('none');
				refreshListStudent();
				$("#snackbar .wrapper").html(html);
			}
		})
	});
});
</script>
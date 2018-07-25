<?php
$query = $oes->getData("GLS", "*", "FacultyID = '0'");
?>
<span class="title">Message</span>
<p>
	Are you sure you want to automatically assign an adviser to <?php echo sizeof($query); if(sizeof($query) > 1) echo ' sections'; else echo ' section';  ?>?
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
			url: "process.php?action=auto_assign_faculty_to_section",
			success: function(html) {
				showElement('none');
				refreshListSection();
				$("#snackbar .wrapper").html(html);
			}
		})
	});
});
</script>
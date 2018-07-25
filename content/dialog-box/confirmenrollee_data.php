<span class="title">Message</span>
<p>
	Are you sure you want to confirm selected enrollees?
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
			url: "process.php?action=confirmenrollee_data",
			data: {checkedData: <?php echo $oes->convertPHPArrayToJS($db_id); ?>},
			success: function(html) {
				showElement('none');
				refreshListPassedEnrollee();
				$("#snackbar .wrapper").html(html);
			}
		})
	});
});
</script>
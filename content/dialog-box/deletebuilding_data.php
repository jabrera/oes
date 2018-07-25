<span class="title">Message</span>
<p>
	Are you sure you want to delete the selected buildings?
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
			url: "process.php?action=deletebuilding_data",
			data: {checkedData: <?php echo $oes->convertPHPArrayToJS($db_id); ?>},
			success: function(html) {
				showElement('none');
				refreshListBuilding();
				$("#snackbar .wrapper").html(html);
			}
		});
	});
});
</script>
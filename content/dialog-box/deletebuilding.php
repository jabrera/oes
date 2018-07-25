<span class="title">Message</span>
<p>
	Are you sure you want to delete this building?
	<ul class="list">
		<li>
			<div class="primary"><span>Building Name</span><span><?php echo $oes->getSingleData("Building", "Name", "ID = '$db_id'"); ?></span></div>
		</li>
		<li>
			<div class="primary"><span>Building Code</span><span><?php echo $oes->getSingleData("Building", "Code", "ID = '$db_id'"); ?></span></div>
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
			url: "process.php?action=deletebuilding",
			data: {id: '<?php echo $db_id; ?>'},
			success: function(html) {
				showElement('none');
				refreshListBuilding();
				$("#snackbar .wrapper").html(html);
			}
		})
	});
});
</script>
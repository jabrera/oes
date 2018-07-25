<span class="title">Message</span>
<p>
	Are you sure you want to delete this fee?
	<ul class="list">
		<li>
			<div class="primary"><span>Title</span><span><?php echo $oes->getSingleData("Breakdown", "Title", "ID = '$db_id'"); ?></span></div>
		</li>
		<li>
			<div class="primary"><span>Price</span><span>Php <?php echo number_format($oes->getSingleData("Breakdown", "Price", "ID = '$db_id'"), 2, ".", ","); ?></span></div>
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
			url: "process.php?action=deletefee",
			data: {id: '<?php echo $db_id; ?>'},
			success: function(html) {
				showElement('none');
				refreshListBreakdown();
				$("#snackbar .wrapper").html(html);
			}
		})
	});
});
</script>
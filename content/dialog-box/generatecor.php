<span class="title">Message</span>
<p>
	Are you sure you want to generate certificate of registration for enrolled students?
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
			cache: false,
			url: "process.php?action=generatecor",
			success: function(html) {
				showElement('none');
				$("#snackbar .wrapper").html(html);
			}
		});
	});
});
</script>
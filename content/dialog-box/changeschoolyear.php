<span class="title">Message</span>
<p>
	This will change the current school year. Do you want to continue?
</p>
<ul class="button-container right">
	<li><a onclick="showElement('none')" class="flat_button">No</a></li>
	<li><a id="btnYes" class="flat_button">Yes</a></li>
</ul>
<script>
$(document).ready(function() {
	$("#btnYes").click(function() {
		showElement("none");
		showBottomSheet('changeschoolyear1');
	});
});
</script>
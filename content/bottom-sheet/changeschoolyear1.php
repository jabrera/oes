<div class="content">
	<h3>Message</h3>
	<p>Changing the school year will:</p>
	<ul>
		<li>Move the students to another grade level</li>
		<li>Change student's type to enrollee</li>
		<li>Delete the student's and teacher's schedule</li>
	</ul>
	<p>To confirm, check the following checkboxes and click Confirm.</p>
	<label><input type="checkbox" name="confirm1"><span></span></label>
	<label><input type="checkbox" name="confirm2"><span></span></label>
	<label><input type="checkbox" name="confirm3"><span></span></label><br>
	<ul class="button-container right">
		<li><a onclick="showElement('none');" target="_blank" class="raised_button">Cancel</a></li>
		<li><a id="btnAdd" target="_blank" class="raised_button">Confirm</a></li>
	</ul>
</div>
<script>
$(document).ready(function() {
	$("#bottom-sheet ul.button-container").hide();
	$("#bottom-sheet input[name=confirm1]").change(function() {
		$confirm1 = $(this).is(":checked");
		$confirm2 = $("#bottom-sheet input[name=confirm2]").is(":checked");
		$confirm3 = $("#bottom-sheet input[name=confirm3]").is(":checked");
		if($confirm1 && $confirm2 && $confirm3)
			$("#bottom-sheet ul.button-container").show();
		else
			$("#bottom-sheet ul.button-container").hide();
	});
	$("#bottom-sheet input[name=confirm2]").change(function() {
		$confirm2 = $(this).is(":checked");
		$confirm1 = $("#bottom-sheet input[name=confirm1]").is(":checked");
		$confirm3 = $("#bottom-sheet input[name=confirm3]").is(":checked");
		if($confirm1 && $confirm2 && $confirm3)
			$("#bottom-sheet ul.button-container").show();
		else
			$("#bottom-sheet ul.button-container").hide();
	});
	$("#bottom-sheet input[name=confirm3]").change(function() {
		$confirm3 = $(this).is(":checked");
		$confirm2 = $("#bottom-sheet input[name=confirm2]").is(":checked");
		$confirm1 = $("#bottom-sheet input[name=confirm1]").is(":checked");
		if($confirm1 && $confirm2 && $confirm3)
			$("#bottom-sheet ul.button-container").show();
		else
			$("#bottom-sheet ul.button-container").hide();
	});
	$("#btnAdd").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=changeschoolyear",
			data: {confirm: '1'},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				showElement("none");
				window.location.href = "index.php";
			}
		});
	});
})
</script>
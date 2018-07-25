<div class="content">
	<h3>Add Schedule</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Expertise</label>
				<select name="expertise">

				</select>
			</td>
		</tr>
		<tr>
			<td><label>Available schedule</label></td>
		</tr>
	</table>
	<ul class="list-option" id="availableschedule">
	</ul>
</div>
<script>
$(document).ready(function() {
	$("#bottom-sheet ul.button-container").hide();
	$("#loading").show("slow");
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getexpertise",
		data: {faculty: '<?php echo $bs_id; ?>', alloption: 1},
		success: function(html) {
			$("#bottom-sheet select[name=expertise]").html(html);
			$.ajax({
				type: "post",
				cache: true,
				url: "process.php?action=getavailableschedule",
				data: {faculty: '<?php echo $bs_id; ?>'},
				success: function(html) {
					$("#bottom-sheet ul.button-container").show();
					$("#loading").hide("slow");
					$("#bottom-sheet ul#availableschedule").html(html);
				}
			});
		}
	});
	$("#bottom-sheet select[name=expertise]").change(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$expertise = $(this).val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=getavailableschedule",
			data: {faculty: '<?php echo $bs_id; ?>', expertise: $expertise},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#bottom-sheet ul#availableschedule").html(html);
			}
		});
	});
})
</script>
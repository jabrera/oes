<div class="content">
	<h3>Add Fees</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Title</label>
				<input type="text" name="title" placeholder="Title">
			</td>
		</tr>
		<tr>
			<td>
				<label>Price</label>
				<input type="number" name="price" placeholder="Price">
			</td>
		</tr>
	</table>
	<ul class="button-container right">
		<li><a onclick="showElement('none');" target="_blank" class="raised_button">Cancel</a></li>
		<li><a id="btnAdd" target="_blank" class="raised_button">Add</a></li>
	</ul>
</div>
<script>
$(document).ready(function() {
	$("#btnAdd").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$title = $("#bottom-sheet input[name='title']").val();
		$price = $("#bottom-sheet input[name='price']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=addfee",
			data: {gl: '<?php echo $bs_id; ?>', title: $title, price: $price},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshListBreakdown();
			}
		});
	});
})
</script>
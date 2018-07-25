<div class="content">
	<h3>Move Student</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Grade Level</label>
				<select name="gradelevel">
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label>Section</label>
				<select name="section">
				</select>
			</td>
		</tr>
	</table><br>
	<ul class="button-container right">
		<li><a onclick="showElement('none');" target="_blank" class="raised_button">Cancel</a></li>
		<li><a id="btnUpdate" target="_blank" class="raised_button">Move</a></li>
	</ul>
</div>
<script>
$(document).ready(function() {
	$("#bottom-sheet ul.button-container").hide();
	$("#loading").show("slow");
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getgradelevel",
		success: function(html) {
			$("#bottom-sheet select[name='gradelevel']").html(html);
			$gl = $("#bottom-sheet [name='gradelevel']").val();
			$.ajax({
				type: "post",
				cache: true,
				url: "process.php?action=getsection",
				data: {gl: $gl, nooption: 1},
				success: function(html) {
					$("#bottom-sheet select[name='section']").html(html);
					$("#bottom-sheet ul.button-container").show();
					$("#loading").hide("slow");
				}
			});
		}
	});
	$("#bottom-sheet [name='gradelevel']").change(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$gl = $(this).val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=getsection",
			data: {gl: $gl, nooption: 1},
			success: function(html) {
				$("#bottom-sheet select[name='section']").html(html);
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
			}
		});
	});
	$("#btnUpdate").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$gradelevel = $("#bottom-sheet [name='gradelevel']").val();
		$section = $("#bottom-sheet [name='section']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=movestudenttosection_data",
			data: {id: <?php echo $oes->convertPHPArrayToJS($bs_id); ?>, gradelevel: $gradelevel, section: $section},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshListStudent();
			}
		})
	});
});
</script>
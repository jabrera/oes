<div class="content">
	<h3>Add Student</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Full Name</label>
				<input type="text" name="fname" placeholder="First Name">
				<input type="text" name="mname" placeholder="Middle Name">
				<input type="text" name="lname" placeholder="Last Name">
			</td>
		</tr>
		<tr>
			<td>
				<label>Birth date</label>
				<input type="date" name="bday" placeholder="Birth date">
			</td>
		</tr>
		<tr>
			<td>
				<label>Gender</label>
				<select name="gender">
					<option value="Male">Male</option>
					<option value="Female">Female</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label>Grade Level/Section</label>
				<select name="gradelevel">
				</select>
				<select name="section">
				</select>
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
	$("#btnAdd").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$fname = $("#bottom-sheet [name='fname']").val();
		$mname = $("#bottom-sheet [name='mname']").val();
		$lname = $("#bottom-sheet [name='lname']").val();
		$bday = $("#bottom-sheet [name='bday']").val();
		$gender = $("#bottom-sheet [name='gender']").val();
		$gradelevel = $("#bottom-sheet [name='gradelevel']").val();
		$section = $("#bottom-sheet [name='section']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=addstudent",
			data: {fname: $fname, mname: $mname, lname: $lname, bday: $bday, gender: $gender, gradelevel: $gradelevel, section: $section},
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
<div class="content">
	<h3>Add Faculty</h3>
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
		$fname = $("#bottom-sheet [name='fname']").val();
		$mname = $("#bottom-sheet [name='mname']").val();
		$lname = $("#bottom-sheet [name='lname']").val();
		$bday = $("#bottom-sheet [name='bday']").val();
		$gender = $("#bottom-sheet [name='gender']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=addfaculty",
			data: {fname: $fname, mname: $mname, lname: $lname, bday: $bday, gender: $gender},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshListFaculty();
			}
		})
	});
});
</script>
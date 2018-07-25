<div class="content">
	<h3>Change Password</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>New Password</label>
				<input type="password" name="pass1" placeholder="Password">
			</td>
		</tr>
		<tr>
			<td>
				<label>Retype New Password</label>
				<input type="password" name="pass2" placeholder="Password">
			</td>
		</tr>
	</table>
	<ul class="button-container right">
		<li><a onclick="showElement('none');" target="_blank" class="raised_button">Cancel</a></li>
		<li><a id="btnChange" target="_blank" class="raised_button">Change</a></li>
	</ul>
</div>
<script>
$(document).ready(function() {
	$("#btnChange").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$pass1 = $("#bottom-sheet input[name='pass1']").val();
		$pass2 = $("#bottom-sheet input[name='pass2']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=changepassword_data",
			data: {id: <?php echo $oes->convertPHPArrayToJS($bs_id); ?>, pass1: $pass1, pass2: $pass2},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				if(typeof refreshListStudent == 'function') refreshListStudent();
				if(typeof refreshListFaculty == 'function') refreshListFaculty();
				if(typeof refreshListEnrollee == 'function') refreshListEnrollee();
				if(typeof refreshListAdmin == 'function') refreshListAdmin();
			}
		});
	});
})
</script>
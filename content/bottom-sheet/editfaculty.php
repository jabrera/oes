<?php
$facultyData = $oes->getRow("Account INNER JOIN Faculty", "*", "Account.ID = '$bs_id' AND Account.ID = Faculty.ID");
?>
<div class="content">
	<h3>Edit Faculty</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Username</label>
				<br>
				<?php echo $oes->getUserInfo("Username", $facultyData["ID"]); ?>
			</td>
		</tr>
		<tr>
			<td>
				<label>Full Name</label>
				<input type="text" name="fname" value="<?php echo $facultyData["FirstName"]; ?>" placeholder="First Name">
				<input type="text" name="mname" value="<?php echo $facultyData["MiddleName"]; ?>" placeholder="Middle Name">
				<input type="text" name="lname" value="<?php echo $facultyData["LastName"]; ?>" placeholder="Last Name">
			</td>
		</tr>
		<tr>
			<td>
				<label>Birth date</label>
				<input type="date" name="bday" placeholder="Birth date" value="<?php echo $facultyData["BirthDate"]; ?>">
			</td>
		</tr>
		<tr>
			<td>
				<label>Gender</label>
				<select name="gender">
					<?php
					$genders = array("Male", "Female");
					$u_gender = $facultyData["Gender"];
					foreach($genders as $gender) {
						$selected = "";
						if($u_gender == $gender) 
							$selected = " selected";
						echo '<option value="'.$gender.'"'.$selected.'>'.$gender.'</option>';
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label>Expertise</label><br>
				<?php
				$expertiseData = $oes->getData("Expertise", "*", "FacultyID = '$bs_id'");
				foreach($expertiseData as $expertise) {
				?>
				<div class="tag" id="expertise_<?php echo $expertise["ID"]; ?>"><span><?php echo $oes->getSingleData("Subject", "Code", "ID = '".$expertise["SubjectID"]."'"); ?></span><a id="btnDelete"><span class="flat_icon ic_close_white trans_icon "></span></a></div>
				<script>
				$(document).ready(function() {
					$("#expertise_<?php echo $expertise["ID"]; ?> #btnDelete").click(function() {
						$.ajax({
							type: "post",
							cache: true,
							url: "process.php?action=deleteexpertise",
							data: {id: <?php echo $expertise["ID"]; ?>},
							success: function(html) {
								$("#snackbar .wrapper").html(html);
								$("#expertise_<?php echo $expertise["ID"]; ?>").hide();
							}
						})
					})
				})
				</script>
				<?php
				}
				?>
			</td>
		</tr>
	</table>
	<ul class="button-container right">
		<li><a onclick="showElement('none');" target="_blank" class="raised_button">Cancel</a></li>
		<li><a id="btnUpdate" target="_blank" class="raised_button">Update</a></li>
	</ul>
</div>
<script>
$(document).ready(function() {
	$("#btnUpdate").click(function() {
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
			url: "process.php?action=editfaculty",
			data: {id: <?php echo $bs_id; ?>, fname: $fname, mname: $mname, lname: $lname, bday: $bday, gender: $gender},
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
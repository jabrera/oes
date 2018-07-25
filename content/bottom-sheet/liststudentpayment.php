<div class="content">
	<h3>Select Student</h3>
	<hr>
	<ul class="list-option">
		<?php
		$studentData = $oes->getData("Student INNER JOIN Account", "*", "Student.ID = Account.ID AND Account.Type = 'Student' AND Account.ID = '$bs_id' AND Account.Status = 'Active'");
		if(!empty($studentData)) {
			foreach($studentData as $student) {
			?>
		<li><a id="liststudent_<?php echo $student["ID"]; ?>"><?php echo $oes->getNameFormat("l, f M.", $student["ID"]); ?></a></li>
		<script>
		$(document).ready(function() {
			$("#bottom-sheet #liststudent_<?php echo $student["ID"]; ?>").click(function() {
				showElement('none');
				$("#loading").show("slow");
				refreshListStudentPayment('<?php echo $student["ID"]; ?>');
			})
		});
		</script>
			<?php
			}
		} else {
			echo '<br><center><small><i>No student found.</i></small></center><br>';
		}
		?>
	</ul>
</div>
<script>
$(document).ready(function() {

})
</script>
<div class="content">
	<h3>Select Faculty</h3>
	<hr>
	<ul class="list-option">
		<?php
		if(isset($bs_id))
			$facultyData = $oes->getData("Faculty INNER JOIN Account", "*", "Faculty.ID = Account.ID AND Account.Type = 'Faculty' AND Account.Status = 'Active' AND (CONCAT(FirstName, ' ', MiddleName, ' ', LastName) LIKE '%$bs_id%' OR Account.ID LIKE '%$bs_id%')");
		else
			$facultyData = $oes->getData("Faculty INNER JOIN Account", "*", "Faculty.ID = Account.ID AND Account.Type = 'Faculty' AND Account.Status = 'Active'");
		if(!empty($facultyData)) {
			foreach($facultyData as $faculty) {
			?>
		<li><a id="listfaculty_<?php echo $faculty["ID"]; ?>"><?php echo $oes->getNameFormat("l, f M.", $faculty["ID"]); ?></a></li>
		<script>
		$(document).ready(function() {
			$("#bottom-sheet #listfaculty_<?php echo $faculty["ID"]; ?>").click(function() {
				showElement('none');
				$("#loading").show("slow");
				refreshListFacultySchedule('<?php echo $faculty["ID"]; ?>');
			})
		});
		</script>
			<?php
			}
		} else {
			echo '<br><center><small><i>No faculty found.</i></small></center><br>';
		}
		?>
	</ul>
</div>
<script>
$(document).ready(function() {

})
</script>
<div class="content">
	<h3>Add Expertise</h3>
	<table class="list">
		<tr class="title">
			<td width="1px">
				<label id="chkAll"><input type="checkbox"><span></span></label>
			</td>
			<td>Subjects</td>
		</tr>
		<?php
		$subjectData = $oes->getData("Subject", "*", "");
		foreach($subjectData as $subject) {
		?>
		<tr>
			<td>
				<label class="checkData" id="chk_<?php echo $subject["ID"]; ?>"><input type="checkbox" value="<?php echo $subject["ID"]; ?>"><span></span></label>
			</td>
			<td><?php echo $subject["Name"]; ?></td>
		</tr>
		<?php
		}
		?>
	</table>
	<ul class="button-container right">
		<li><a onclick="showElement('none');" target="_blank" class="raised_button">Cancel</a></li>
		<li><a id="btnAdd" target="_blank" class="raised_button">Add</a></li>
	</ul>
</div>
<script>
$(document).ready(function() {
	$selectedSubjects = [];
	$("#bottom-sheet #chkAll input").change(function() {
		if(this.checked) {
			$("#bottom-sheet .checkData input").each(function() {
				if(!this.checked) {
					$selectedSubjects.push($(this).attr("value"));
				}
			});
		} else {
			$("#bottom-sheet .checkData input").each(function() {
				$index = $selectedSubjects.indexOf($(this).attr("value"));
				$selectedSubjects.splice($index, 1);
			});
		}
		if(this.checked) {
			$("#bottom-sheet .checkData input").prop("checked", true);
		} else {
			$("#bottom-sheet .checkData input").prop("checked", false);
		}
	});
	$("#bottom-sheet .checkData input").change(function() {
		$n = 1;
		$num = 0;
		$("#bottom-sheet .checkData input").each(function() {
			if(!this.checked)
				$n = 0;
			else
				$num++;
		});
		if(this.checked) {
			$selectedSubjects.push($(this).attr("value"));
		} else {
			$index = $selectedSubjects.indexOf($(this).attr("value"));
			$selectedSubjects.splice($index, 1);
		}
		if($n == 1)
			$("#bottom-sheet #chkAll input").prop("checked", true);
		else
			$("#bottom-sheet #chkAll input").prop("checked", false);
	});


	$("#btnAdd").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$faculty = <?php
		if(is_array($bs_id)) 
			echo $oes->convertPHPArrayToJS($bs_id);
		else
			echo '\'$bs_id\'';
		?>;
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=addexpertise",
			data: {faculty: $faculty, subject: $selectedSubjects},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				<?php
				if(is_array($bs_id)) 
					echo 'refreshListFaculty()';
				else
					echo 'refreshListFacultySchedule(\'$bs_id\');';
				?>
			}
		});
	});
})
</script>
<div class="content">
	<h3>Add Subject to Curriculum</h3>
	<table class="list">
		<tr class="title">
			<td width="1px">
				<label id="chkAll"><input type="checkbox"><span></span></label>
			</td>
			<td>Subjects</td>
		</tr>
		<?php
		$subjectData = $oes->getData("Subject", "*", "ID NOT IN (SELECT SubjectID FROM Curriculum WHERE YearLevel = '$bs_id') ORDER BY Name");
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
		if(empty($subjectData)) {
		?>
		<tr>
			<td colspan="2"><center><i><br>No available subjects.<br><br></i></center></td>
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
		$gl = $("#frmSearch select[name='gradelevel']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=addcurriculum",
			data: {gradelevel: $gl, subject: $selectedSubjects},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshListCurriculum();
			}
		});
	});
})
</script>
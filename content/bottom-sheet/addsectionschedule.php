<div class="content">
	<h3>Add Schedule</h3>
	<table class="form-container">
		<tr>
			<td colspan="2">
				<label>Subject</label>
				<select name="subject">

				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<label>Day</label><br>
				<table class="list">
					<tr>
						<td width="1px">
							<label><input type="checkbox" name="M"><span></span></label>
						</td>
						<td>Monday</td>
					</tr>
					<tr>
						<td width="1px">
							<label><input type="checkbox" name="T"><span></span></label>
						</td>
						<td>Tuesday</td>
					</tr>
					<tr>
						<td width="1px">
							<label><input type="checkbox" name="W"><span></span></label>
						</td>
						<td>Wednesday</td>
					</tr>
					<tr>
						<td width="1px">
							<label><input type="checkbox" name="H"><span></span></label>
						</td>
						<td>Thursday</td>
					</tr>
					<tr>
						<td width="1px">
							<label><input type="checkbox" name="F"><span></span></label>
						</td>
						<td>Friday</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<label>Start Time</label>
				<table width="100%">
					<tr>
						<td>
							<select name="start_hour">
								<?php
								for($i = 7; $i <= 16; $i++) {
									echo '<option value="'.$i.'">'.$i.'</option>';
								}
								?>
							</select>
						</td>
						<td>:</td>
						<td>
							<select name="start_min">
								<option value="00">00</option>
								<option value="30">30</option>
							</select>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<label>End Time</label>
				<table width="100%">
					<tr>
						<td>
							<select name="end_hour">
								<?php
								for($i = 7; $i <= 16; $i++) {
									echo '<option value="'.$i.'">'.$i.'</option>';
								}
								?>
							</select>
						</td>
						<td>:</td>
						<td>
							<select name="end_min">
								<option value="00">00</option>
								<option value="30">30</option>
							</select>
						</td>
					</tr>
				</table>
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
		url: "process.php?action=getschedulesubject",
		data: {gl: '<?php echo $oes->getSingleData("GLS", "GradeLevel", "ID = '".$bs_id."'"); ?>'},
		success: function(html) {
			$("#bottom-sheet ul.button-container").show();
			$("#loading").hide("slow");
			$("#bottom-sheet select[name=subject]").html(html);
		}
	});
	$("#btnAdd").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$subject = $("#bottom-sheet select[name='subject']").val();
		$m = $("#bottom-sheet input[name='M']");
		$t = $("#bottom-sheet input[name='T']");
		$w = $("#bottom-sheet input[name='W']");
		$h = $("#bottom-sheet input[name='H']");
		$f = $("#bottom-sheet input[name='F']");
		$shour = $("#bottom-sheet select[name='start_hour']").val();
		$smin = $("#bottom-sheet select[name='start_min']").val();
		$ehour = $("#bottom-sheet select[name='end_hour']").val();
		$emin = $("#bottom-sheet select[name='end_min']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=addsectionschedule",
			data: {section: '<?php echo $bs_id; ?>', subject: $subject, m: $m.is(":checked"), t: $t.is(":checked"), w: $w.is(":checked"), h: $h.is(":checked"), f: $f.is(":checked"), start_hour: $shour, start_min: $smin, end_hour: $ehour, end_min: $emin},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshListSectionSchedule();
			}
		});
	});
})
</script>
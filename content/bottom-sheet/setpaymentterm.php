<div class="content">
	<h3>Set Payment Term</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Payment Term</label>
				<select name="term">
				<?php
				$gradelevel = $oes->getSingleData("Student", "GradeLevel", "ID = '$bs_id'");
				$paymentterms = $oes->getData("PaymentTerm", "*", "GradeLevel = '$gradelevel'");
				foreach($paymentterms as $p) {
				?>
					<option value="<?php echo $p["ID"]; ?>"><?php echo $p["PaymentTerm"]; ?></option>
				<?php
				}
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label>Additional Fee</label>
				<br>
				<span id="fee"></span>
			</td>
		</tr>
	</table>
	<ul class="button-container right">
		<li><a onclick="showElement('none');" target="_blank" class="raised_button">Cancel</a></li>
		<li><a id="btnAdd" target="_blank" class="raised_button">Set</a></li>
	</ul>
</div>
<script>
$(document).ready(function() {
	$("#bottom-sheet ul.button-container").hide();
	$("#loading").show("slow");
	$val = $("#bottom-sheet select[name=term]").val();
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getpaymenttermfee",
		data: {pt: $val},
		success: function(html) {
			$("#bottom-sheet #fee").html(html);
			$("#bottom-sheet ul.button-container").show();
			$("#loading").hide("slow");
		}
	});
	$("#bottom-sheet select[name=term]").change(function() {
		$val = $(this).val();
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=getpaymenttermfee",
			data: {pt: $val},
			success: function(html) {
				$("#bottom-sheet #fee").html(html);
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
			}
		});
	});
	$("#btnAdd").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$pt = $("#bottom-sheet select[name=term]").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=setpaymentterm",
			data: {student: '<?php echo $bs_id; ?>', pt: $pt},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				if(typeof refreshAssessment == 'function') refreshAssessment();
				if(typeof refreshListStudentPayment == 'function') refreshListStudentPayment('<?php echo $bs_id; ?>');
				if(typeof viewStudent == 'function') viewStudent('assessment');
			}
		});
	});
})
</script>
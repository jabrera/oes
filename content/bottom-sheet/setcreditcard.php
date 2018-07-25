<?php
$creditCardInfo = $oes->getRow("CreditCard", "*", "ID = '$bs_id'");
?>
<div class="content">
	<h3>Credit Card</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Card Holder Name</label>
				<input type="text" name="name" placeholder="Card Holder Name" value="<?php echo $creditCardInfo["HolderName"]; ?>">
			</td>
		</tr>
		<tr>
			<td>
				<label>Credit Card Number</label>
				<input type="text" name="number" placeholder="Credit Card Number" value="<?php echo $creditCardInfo["CardNumber"]; ?>">
			</td>
		</tr>
		<tr>
			<td>
				<label>Card Verification Number</label>
				<input type="text" name="verify" placeholder="Card Verification Number" value="<?php echo $creditCardInfo["VerificationNumber"]; ?>">
			</td>
		</tr>
		<tr>
			<td>
				<label>Expiration Date</label>
				<table class="list">
					<tr>
						<td><select name="expiremonth"><?php
						for($i = 1; $i <= 12; $i++) {
							$selected = "";
							if($i == date("n", strtotime($creditCardInfo["ExpirationDate"]))) {
								$selected = " selected";
							}
							echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
						}
						?></select></td>
						<td><select name="expireyear"><?php
						for($i = $oes->getSchoolYear(); $i <= $oes->getSchoolYear()+20; $i++) {
							$selected = "";
							if($i == date("Y", strtotime($creditCardInfo["ExpirationDate"]))) {
								$selected = " selected";
							}
							echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
						}
						?></select></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<?php
	if(!empty($creditCardInfo)) {
	?>
	<ul class="button-container">
		<li><a onclick="hideElement('#bottom-sheet'); showDialogBox('removecreditcard', '<?php echo $bs_id; ?>');" class="raised_button">Remove</a></li>
	</ul>
	<?php
	}
	?>
	<ul class="button-container right">
		<li><a onclick="showElement('none');" target="_blank" class="raised_button">Cancel</a></li>
		<li><a id="btnSet" target="_blank" class="raised_button">Set</a></li>
	</ul>
</div>
<script>
$(document).ready(function() {
	$("#btnSet").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$name = $("#bottom-sheet input[name='name']").val();
		$number = $("#bottom-sheet input[name='number']").val();
		$verify = $("#bottom-sheet input[name='verify']").val();
		$expiremonth = $("#bottom-sheet select[name='expiremonth']").val();
		$expireyear = $("#bottom-sheet select[name='expireyear']").val();
		$.ajax({
			type: "post",
			cache: false,
			url: "process.php?action=setcreditcard",
			data: {id: '<?php echo $bs_id; ?>', name: $name, number: $number, verify: $verify, expiremonth: $expiremonth, expireyear: $expireyear},
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
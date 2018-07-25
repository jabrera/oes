<?php
$a = $oes->getRow("Assessment", "*", "ID = '$bs_id'");
?>
<div class="content">
	<h3>Pay with Card</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Excess from previous transaction</label>
				<br>
				Php <?php echo $a["Credit"]; ?>
			</td>
		</tr>
		<tr>
			<td>
				<label>Total Amount</label>
				<input type="number" name="amount" placeholder="Amount" value="<?php echo (($a["Installment"]-$a["Credit"]) > 0) ? $a["Installment"]-$a["Credit"] : '0'; ?>" disabled>
			</td>
		</tr>
		<tr>
			<td>
				<label>Applicable Month</label>
				<br>
				<?php
				$paymentterm = $oes->getSingleData("Assessment", "PaymentTerm", "ID = '$bs_id'");
				$ptstr = $oes->getSingleData("PaymentTerm", "PaymentTerm", "ID = '$paymentterm'");
				$sy = $oes->getSchoolYear();
				if($ptstr == "Monthly Installment") 
					$months = array($sy."-08-01", $sy."-09-01", $sy."-10-01", $sy."-11-01", $sy."-12-01", ($sy+1)."-01-01", ($sy+1)."-02-01", ($sy+1)."-03-01", ($sy+1)."-04-01");
				elseif($ptstr == "Quarterly Installment") 
					$months = array($sy."-09-01", $sy."-12-01", ($sy+1)."-03-01");
				elseif($ptstr == "Semi-annually Installment")
					$months = array($sy."-12-01");
				$applicablemonth = "";
				$transaction = $oes->getData("Transaction", "*", "ApplicableMonth = 'Upon Enrollment' AND StudentID = '$bs_id'");
				if(empty($transaction)) {
					echo $applicablemonth = "Upon Enrollment";
				} else {
					foreach($months as $month) {
						$paid = $oes->getData("Transaction", "*", "StudentID = '$bs_id' AND ApplicableMonth = '$month'");
						if(empty($paid)) {
							$applicablemonth = $month;
							echo date("F Y", strtotime($applicablemonth));
							break;
						}
					}
					if($applicablemonth == "")
						echo $applicablemonth = "Others";
				}
				?>
			</td>
		</tr>
		<tr>
			<td>
				<label>Date</label>
				<input type="date" name="date" value="<?php echo date("Y-m-d"); ?>" disabled>
			</td>
		</tr>
		<tr>
			<td>
				<label><input type="checkbox" name="surcharge"><span></span>Include surcharge (Php <?php echo $oes->getSingleData("Assessment", "Surcharge", "ID = '$bs_id'"); ?>)</label>
			</td>
		</tr>
	</table>
	<ul class="button-container right">
		<li><a onclick="showElement('none');" target="_blank" class="raised_button">Cancel</a></li>
		<li><a id="btnAdd" target="_blank" class="raised_button">Pay</a></li>
	</ul>
</div>
<script>
$(document).ready(function() {
	$("#btnAdd").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
		$amount = $("#bottom-sheet input[name='amount']").val();
		$surcharge = $("#bottom-sheet input[name=surcharge]").is(":checked");
		$date = $("#bottom-sheet input[name=date]").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=paywithcard",
			data: {id: '<?php echo $bs_id; ?>', amount: $amount, month: '<?php echo $applicablemonth; ?>', date: $date, surcharge: $surcharge},
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
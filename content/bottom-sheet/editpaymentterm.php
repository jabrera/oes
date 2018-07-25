<?php
$paymentTerm = $oes->getRow("PaymentTerm", "*", "ID = '$bs_id'");
?>
<div class="content">
	<h3>Edit Payment Term</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Payment Term</label>
				<br>
				<?php
				echo $paymentTerm["PaymentTerm"];
				?>
			</td>
		</tr>
		<tr>
			<td>
				<label>Additional Fee</label>
				<input type="number" name="fee" value="<?php echo $paymentTerm["Fee"]; ?>" placeholder="Additional Fee">
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
		$fee = $("#bottom-sheet [name='fee']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=editpaymentterm",
			data: {id: <?php echo $bs_id; ?>, fee: $fee},
			success: function(html) {
				$("#bottom-sheet ul.button-container").show();
				$("#loading").hide("slow");
				$("#snackbar .wrapper").html(html);
				refreshListPaymentTerms();
			}
		})
	});
});
</script>
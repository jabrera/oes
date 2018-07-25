<script>
$(document).ready(function() {
	$selectedData = [];
	$("#bottom-sheet #chkAll input").change(function() {
		if(this.checked) {
			$("#bottom-sheet .checkData input").each(function() {
				if(!this.checked) {
					$selectedData.push($(this).attr("value"));
				}
			});
		} else {
			$("#bottom-sheet .checkData input").each(function() {
				$index = $selectedData.indexOf($(this).attr("value"));
				$selectedData.splice($index, 1);
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
			$selectedData.push($(this).attr("value"));
		} else {
			$index = $selectedData.indexOf($(this).attr("value"));
			$selectedData.splice($index, 1);
		}
		if($n == 1)
			$("#bottom-sheet #chkAll input").prop("checked", true);
		else
			$("#bottom-sheet #chkAll input").prop("checked", false);
	});
})
</script>
<div class="content">
	<h3>Add Admin Account</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Username</label>
				<input type="text" name="username" placeholder="Username">
			</td>
		</tr>
		<tr>
			<td>
				<label>New Password</label>
				<input type="password" name="pass1" placeholder="New Password">
			</td>
		</tr>
		<tr>
			<td>
				<label>Retype New Password</label>
				<input type="password" name="pass2" placeholder="Retype New Password">
			</td>
		</tr>
	</table>
	<table class="list">
		<tr class="title">
			<td width="1px">
				<label id="chkAll"><input type="checkbox"><span></span></label>
			</td>
			<td colspan="2">Modules</td>
		</tr>
		<?php
		$modules = array(
			array(
				"Administration",
				array(
					"School Year Settings", 
					"Admission Dates"
				)
			),
			array(
				"Assessment",
				array(
					"Payment",
					"Breakdown of Fees",
					"Payment Terms"
				)
			),
			array("Enrollment",
				array(
					"Enrollee Master Data",
					"Confirmation"
				)
			),
			array("Student",
				array(
					"Student Master Data"
				)
			),
			array("Faculty",
				array(
					"Faculty Master Data",
					"Faculty Schedule"
				)
			),
			array("Section",
				array(
					"Section Master Data",
					"Section Schedule"
				)
			),
			array("Curriculum",
				array(
					"Subject Master Data"
				)
			),
			array("Location",
				array(
					"Building Master Data",
					"Room Master Data"
				)
			),
			"Reports"
		);
		foreach($modules as $m) {
			if(is_array($m)) {
			?>
			<tr>
				<td></td>
				<td></td>
				<td><b><?php echo $m[0]; ?></b></td>
			</tr>
			<?php
				foreach($m[1] as $sb) {
				$code = str_replace(" ", "-", strtolower($sb));
			?>
			<tr>
				<td></td>
				<td width="1px"><label class="checkData" id="chk_<?php echo $code; ?>"><input type="checkbox" value="<?php echo $sb; ?>"><span></span></label></td>
				<td><?php echo $sb; ?></td>
			</tr>
			<?php
				}
			} else {
				$code = str_replace(" ", "-", strtolower($m));
			?>
			<tr>
				<td><label class="checkData" id="chk_<?php echo $code; ?>"><input type="checkbox" value="<?php echo $m; ?>"><span></span></label></td>
				<td colspan="2"><?php echo $m; ?></td>
			</tr>
			<?php
			}
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
	$("#btnAdd").click(function() {
		if($selectedData.length != 0) {
			$("#bottom-sheet ul.button-container").hide();
			$("#loading").show("slow");
			$username = $("#bottom-sheet input[name='username']").val();
			$pass1 = $("#bottom-sheet input[name='pass1']").val();
			$pass2 = $("#bottom-sheet input[name='pass2']").val();
			$.ajax({
				type: "post",
				cache: true,
				url: "process.php?action=addadmin",
				data: {username: $username, pass1: $pass1, pass2: $pass2, modules: $selectedData},
				success: function(html) {
					$("#bottom-sheet ul.button-container").show();
					$("#loading").hide("slow");
					$("#snackbar .wrapper").html(html);
					refreshListAdmin();
				}
			});
		} else {
			showSnackbarMsg("Select a module");
		}
	});
})
</script>
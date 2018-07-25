<div class="content">
	<h3>Import Data</h3>
	<p>You can add multiple data using an excel file.</p>
	<form action="process.php?action=addstudent_excel" method="post" enctype="multipart/form-data">
	<table class="form-container">
		<tr>
			<td><label>Select file to import</label></td>
		</tr>
		<tr>
			<td><input type="file" name="import" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"></td>
		</tr>
	</table>
	<br><br>
	<ul class="button-container right">
		<li><a onclick="showElement('none');" target="_blank" class="raised_button">Cancel</a></li>
		<li><input type="submit" value="Import" name="submit"></li>
	</ul>
	</form>
</div>
<script>
$(document).ready(function() {
	$("#bottom-sheet input[name=submit]").click(function() {
		$("#bottom-sheet ul.button-container").hide();
		$("#loading").show("slow");
	})
});
</script>
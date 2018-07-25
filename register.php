	<div id="action-bar">
		<div class="row">
			<div class="menu-title">
				<ul>
					<li><a onclick="showElement('#float-left-menu', 1)" class="action_icon ic_menu_white icons icon_medium"></a></li>
					<li><span class="title">Register</span></li>
				</ul>
			</div>
			<div class="actions">
			</div>
		</div>
	</div>
	<div id="float-left-menu">
		<div class="wrapper">
			<div class="title">
				<div style="position: relative"><a class="icons icon_medium" onclick="showElement('none')"></a>Main Menu</div>
			</div>
			<ul class="ripple">
				<li><a href="index.php?login"><span class="img ic_dashboard_white"></span>Login</a></li>
				<li><a href="index.php?register"><span class="img ic_account_circle_white"></span>Register</a></li>
			</ul>
			<div class="copyright">
				&copy; 2015 Online Enrollment System<br>
				<a href="http://www.juvarabrera.com/" target="_blank">Juvar Abrera</a> • <a href="http://fidgetyintellect.wordpress.com" target="_blank">Jarrell Maverick Remulla</a>
			</div>
		</div>
	</div>
	<div id="body-container">
		<div class="content">
			<div class="bg-cover"></div>
			<div class="title">
			</div>
			<div class="wrapper">
				<div class="col-6 offset-2">
				<?php
				$register = $oes->getSingleData("Administration", "Status", "1=1 ORDER BY ID DESC LIMIT 1");
				if($register == 0) {
				?>	
					<div class="card" id="frmApplication">
						<h2>Register</h2>
						<p>Fill up the form properly</p>
						<table class="form-container">
							<tr class="nohide">
								<td colspan="2">
									<label>Enrolling for grade level</label>
									<select name="gradelevel">
										<option value="0">Select grade level</option>
										<option value="7">Grade 7</option>
										<option value="8">Grade 8</option>
										<option value="9">Grade 9</option>
										<option value="10">Grade 10</option>
									</select>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<h4>Applicant Name</h4>
								</td>
							</tr>
							<tr>
								<td width="50%">
									<label>First Name</label>
									<input type="text" name="firstname">
								</td>
								<td>
									<label>Middle Name</label>
									<input type="text" name="middlename">
								</td>
							</tr>
							<tr>
								<td>
									<label>Last Name</label>
									<input type="text" name="lastname">
								</td>
								<td>
									<label>Auxiliary Name</label>
									<select name="auxname">
										<option value=""></option>
										<option value="Jr">Jr</option>
										<option value="Sr">Sr</option>
										<option value="I">I</option>
										<option value="II">II</option>
										<option value="III">III</option>
										<option value="IV">IV</option>
										<option value="V">V</option>
										<option value="VI">VI</option>
										<option value="VII">VII</option>
										<option value="VIII">VIII</option>
										<option value="IX">IX</option>
										<option value="X">X</option>
									</select>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<h4>Basic Information</h4>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<label>Gender</label>
									<select name="gender">
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label>Birth Date</label>
									<input type="date" name="birthdate">
								</td>
								<td>
									<label>Birth Place</label>
									<input type="text" name="birthplace">
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<label>Religion</label>
									<select name="religion">
										<option value="Roman Catholic">Roman Catholic</option>
										<option value="Aglipanayan">Aglipanayan</option>
										<option value="Baptist">Baptist</option>
										<option value="Buddhism">Buddhism</option>
										<option value="Christian">Christian</option>
										<option value="Evangelical">Evangelical</option>
										<option value="Hinduism">Hinduism</option>
										<option value="Iglesia ni Cristo">Iglesia ni Cristo</option>
										<option value="Islam">Islam</option>
										<option value="Jehova's Witness">Jehova's Witness</option>
										<option value="Judaism">Judaism</option>
										<option value="Lutheran">Lutheran</option>
										<option value="Methodist">Methodist</option>
										<option value="Other">Other</option>
										<option value="Pentecostal">Pentecostal</option>
										<option value="Seventh-Day Adventist">Seventh-Day Adventist</option>
									</select>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<label>Civil Status</label>
									<select name="status">
										<option value="Single">Single</option>
										<option value="Married">Married</option>
										<option value="Widow">Widow</option>
									</select>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<label>Citizenship</label>
									<select name="citizenship">
										<option value="Filipino">Filipino</option>
										<option value="Other">Other</option>
									</select>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<h4>Address & Contact Information</h4>
								</td>
							</tr>
							<tr>
								<td>
									<label>No./Street/Brgy.</label>
									<input type="text" name="nostreetbrgy">
								</td>
								<td>
									<label>City/Municipality</label>
									<input type="text" name="city">
								</td>
							</tr>
							<tr>
								<td>
									<label>Province/State</label>
									<input type="text" name="province">
								</td>
								<td>
									<label>Country</label>
									<select name="country">
										<option value="Afganistan">Afghanistan</option> <option value="Albania">Albania</option> <option value="Algeria">Algeria</option> <option value="American Samoa">American Samoa</option> <option value="Andorra">Andorra</option> <option value="Angola">Angola</option> <option value="Anguilla">Anguilla</option> <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option> <option value="Argentina">Argentina</option> <option value="Armenia">Armenia</option> <option value="Aruba">Aruba</option> <option value="Australia">Australia</option> <option value="Austria">Austria</option> <option value="Azerbaijan">Azerbaijan</option> <option value="Bahamas">Bahamas</option> <option value="Bahrain">Bahrain</option> <option value="Bangladesh">Bangladesh</option> <option value="Barbados">Barbados</option> <option value="Belarus">Belarus</option> <option value="Belgium">Belgium</option> <option value="Belize">Belize</option> <option value="Benin">Benin</option> <option value="Bermuda">Bermuda</option> <option value="Bhutan">Bhutan</option> <option value="Bolivia">Bolivia</option> <option value="Bonaire">Bonaire</option> <option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option> <option value="Botswana">Botswana</option> <option value="Brazil">Brazil</option> <option value="British Indian Ocean Ter">British Indian Ocean Ter</option> <option value="Brunei">Brunei</option> <option value="Bulgaria">Bulgaria</option> <option value="Burkina Faso">Burkina Faso</option> <option value="Burundi">Burundi</option> <option value="Cambodia">Cambodia</option> <option value="Cameroon">Cameroon</option> <option value="Canada">Canada</option> <option value="Canary Islands">Canary Islands</option> <option value="Cape Verde">Cape Verde</option> <option value="Cayman Islands">Cayman Islands</option> <option value="Central African Republic">Central African Republic</option> <option value="Chad">Chad</option> <option value="Channel Islands">Channel Islands</option> <option value="Chile">Chile</option> <option value="China">China</option> <option value="Christmas Island">Christmas Island</option> <option value="Cocos Island">Cocos Island</option> <option value="Colombia">Colombia</option> <option value="Comoros">Comoros</option> <option value="Congo">Congo</option> <option value="Cook Islands">Cook Islands</option> <option value="Costa Rica">Costa Rica</option> <option value="Cote DIvoire">Cote D'Ivoire</option> <option value="Croatia">Croatia</option> <option value="Cuba">Cuba</option> <option value="Curaco">Curacao</option> <option value="Cyprus">Cyprus</option> <option value="Czech Republic">Czech Republic</option> <option value="Denmark">Denmark</option> <option value="Djibouti">Djibouti</option> <option value="Dominica">Dominica</option> <option value="Dominican Republic">Dominican Republic</option> <option value="East Timor">East Timor</option> <option value="Ecuador">Ecuador</option> <option value="Egypt">Egypt</option> <option value="El Salvador">El Salvador</option> <option value="Equatorial Guinea">Equatorial Guinea</option> <option value="Eritrea">Eritrea</option> <option value="Estonia">Estonia</option> <option value="Ethiopia">Ethiopia</option> <option value="Falkland Islands">Falkland Islands</option> <option value="Faroe Islands">Faroe Islands</option> <option value="Fiji">Fiji</option> <option value="Finland">Finland</option> <option value="France">France</option> <option value="French Guiana">French Guiana</option> <option value="French Polynesia">French Polynesia</option> <option value="French Southern Ter">French Southern Ter</option> <option value="Gabon">Gabon</option> <option value="Gambia">Gambia</option> <option value="Georgia">Georgia</option> <option value="Germany">Germany</option> <option value="Ghana">Ghana</option> <option value="Gibraltar">Gibraltar</option> <option value="Great Britain">Great Britain</option> <option value="Greece">Greece</option> <option value="Greenland">Greenland</option> <option value="Grenada">Grenada</option> <option value="Guadeloupe">Guadeloupe</option> <option value="Guam">Guam</option> <option value="Guatemala">Guatemala</option> <option value="Guinea">Guinea</option> <option value="Guyana">Guyana</option> <option value="Haiti">Haiti</option> <option value="Hawaii">Hawaii</option> <option value="Honduras">Honduras</option> <option value="Hong Kong">Hong Kong</option> <option value="Hungary">Hungary</option> <option value="Iceland">Iceland</option> <option value="India">India</option> <option value="Indonesia">Indonesia</option> <option value="Iran">Iran</option> <option value="Iraq">Iraq</option> <option value="Ireland">Ireland</option> <option value="Isle of Man">Isle of Man</option> <option value="Israel">Israel</option> <option value="Italy">Italy</option> <option value="Jamaica">Jamaica</option> <option value="Japan">Japan</option> <option value="Jordan">Jordan</option> <option value="Kazakhstan">Kazakhstan</option> <option value="Kenya">Kenya</option> <option value="Kiribati">Kiribati</option> <option value="Korea North">Korea North</option> <option value="Korea Sout">Korea South</option> <option value="Kuwait">Kuwait</option> <option value="Kyrgyzstan">Kyrgyzstan</option> <option value="Laos">Laos</option> <option value="Latvia">Latvia</option> <option value="Lebanon">Lebanon</option> <option value="Lesotho">Lesotho</option> <option value="Liberia">Liberia</option> <option value="Libya">Libya</option> <option value="Liechtenstein">Liechtenstein</option> <option value="Lithuania">Lithuania</option> <option value="Luxembourg">Luxembourg</option> <option value="Macau">Macau</option> <option value="Macedonia">Macedonia</option> <option value="Madagascar">Madagascar</option> <option value="Malaysia">Malaysia</option> <option value="Malawi">Malawi</option> <option value="Maldives">Maldives</option> <option value="Mali">Mali</option> <option value="Malta">Malta</option> <option value="Marshall Islands">Marshall Islands</option> <option value="Martinique">Martinique</option> <option value="Mauritania">Mauritania</option> <option value="Mauritius">Mauritius</option> <option value="Mayotte">Mayotte</option> <option value="Mexico">Mexico</option> <option value="Midway Islands">Midway Islands</option> <option value="Moldova">Moldova</option> <option value="Monaco">Monaco</option> <option value="Mongolia">Mongolia</option> <option value="Montserrat">Montserrat</option> <option value="Morocco">Morocco</option> <option value="Mozambique">Mozambique</option> <option value="Myanmar">Myanmar</option> <option value="Nambia">Nambia</option> <option value="Nauru">Nauru</option> <option value="Nepal">Nepal</option> <option value="Netherland Antilles">Netherland Antilles</option> <option value="Netherlands">Netherlands (Holland, Europe)</option> <option value="Nevis">Nevis</option> <option value="New Caledonia">New Caledonia</option> <option value="New Zealand">New Zealand</option> <option value="Nicaragua">Nicaragua</option> <option value="Niger">Niger</option> <option value="Nigeria">Nigeria</option> <option value="Niue">Niue</option> <option value="Norfolk Island">Norfolk Island</option> <option value="Norway">Norway</option> <option value="Oman">Oman</option> <option value="Pakistan">Pakistan</option> <option value="Palau Island">Palau Island</option> <option value="Palestine">Palestine</option> <option value="Panama">Panama</option> <option value="Papua New Guinea">Papua New Guinea</option> <option value="Paraguay">Paraguay</option> <option value="Peru">Peru</option> <option value="Phillipines" selected>Philippines</option> <option value="Pitcairn Island">Pitcairn Island</option> <option value="Poland">Poland</option> <option value="Portugal">Portugal</option> <option value="Puerto Rico">Puerto Rico</option> <option value="Qatar">Qatar</option> <option value="Republic of Montenegro">Republic of Montenegro</option> <option value="Republic of Serbia">Republic of Serbia</option> <option value="Reunion">Reunion</option> <option value="Romania">Romania</option> <option value="Russia">Russia</option> <option value="Rwanda">Rwanda</option> <option value="St Barthelemy">St Barthelemy</option> <option value="St Eustatius">St Eustatius</option> <option value="St Helena">St Helena</option> <option value="St Kitts-Nevis">St Kitts-Nevis</option> <option value="St Lucia">St Lucia</option> <option value="St Maarten">St Maarten</option> <option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option> <option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option> <option value="Saipan">Saipan</option> <option value="Samoa">Samoa</option> <option value="Samoa American">Samoa American</option> <option value="San Marino">San Marino</option> <option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option> <option value="Saudi Arabia">Saudi Arabia</option> <option value="Senegal">Senegal</option> <option value="Serbia">Serbia</option> <option value="Seychelles">Seychelles</option> <option value="Sierra Leone">Sierra Leone</option> <option value="Singapore">Singapore</option> <option value="Slovakia">Slovakia</option> <option value="Slovenia">Slovenia</option> <option value="Solomon Islands">Solomon Islands</option> <option value="Somalia">Somalia</option> <option value="South Africa">South Africa</option> <option value="Spain">Spain</option> <option value="Sri Lanka">Sri Lanka</option> <option value="Sudan">Sudan</option> <option value="Suriname">Suriname</option> <option value="Swaziland">Swaziland</option> <option value="Sweden">Sweden</option> <option value="Switzerland">Switzerland</option> <option value="Syria">Syria</option> <option value="Tahiti">Tahiti</option> <option value="Taiwan">Taiwan</option> <option value="Tajikistan">Tajikistan</option> <option value="Tanzania">Tanzania</option> <option value="Thailand">Thailand</option> <option value="Togo">Togo</option> <option value="Tokelau">Tokelau</option> <option value="Tonga">Tonga</option> <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option> <option value="Tunisia">Tunisia</option> <option value="Turkey">Turkey</option> <option value="Turkmenistan">Turkmenistan</option> <option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option> <option value="Tuvalu">Tuvalu</option> <option value="Uganda">Uganda</option> <option value="Ukraine">Ukraine</option> <option value="United Arab Erimates">United Arab Emirates</option> <option value="United Kingdom">United Kingdom</option> <option value="United States of America">United States of America</option> <option value="Uraguay">Uruguay</option> <option value="Uzbekistan">Uzbekistan</option> <option value="Vanuatu">Vanuatu</option> <option value="Vatican City State">Vatican City State</option> <option value="Venezuela">Venezuela</option> <option value="Vietnam">Vietnam</option> <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option> <option value="Virgin Islands (USA)">Virgin Islands (USA)</option> <option value="Wake Island">Wake Island</option> <option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option> <option value="Yemen">Yemen</option> <option value="Zaire">Zaire</option> <option value="Zambia">Zambia</option> <option value="Zimbabwe">Zimbabwe</option>
									</select>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<label>Zip Code</label>
									<input type="text" name="zipcode">
								</td>
							</tr>
							<tr>
								<td>
									<label>Email Address</label>
									<input type="text" name="email">
								</td>
								<td>
									<label>Landline/Mobile No.</label>
									<input type="text" name="mobileno">
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<h4>Parents Information</h4>
								</td>
							</tr>
							<tr>
								<td>
									<label>Father's Name</label>
									<input type="text" name="fname">
								</td>
								<td>
									<label>Father's Occupation</label>
									<input type="text" name="foccupation">
								</td>
							</tr>
							<tr>
								<td>
									<label>Mother's Name</label>
									<input type="text" name="mname">
								</td>
								<td>
									<label>Mother's Occupation</label>
									<input type="text" name="moccupation">
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<h4>Guardian Information</h4>
								</td>
							</tr>
							<tr>
								<td>
									<label>Guardian's Name</label>
									<input type="text" name="gname">
								</td>
								<td>
									<label>Relationship</label>
									<select name="relationship">
										<option value="Father">Father</option>
										<option value="Mother">Mother</option>
										<option value="Other" selected>Other</option>
									</select>
								</td>
							</tr>
							<tr valign="top">
								<td>
									<label>Guardian's Address</label>
									<input type="text" name="gaddress">
									<label><input type="checkbox" name="sameaddress"><span></span>Use same address</label>
								</td>
								<td>
									<label>Landline/Mobile No.</label>
									<input type="text" name="gmobileno">
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<h4>Educational Information</h4>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<label>Grade School</label>
									<select name="gradeschool">
									</select>
								</td>
							</tr>
							<script>
							function showNameOfSchool() {
								$val = $("#frmApplication select[name=gradeschool]").val();
								if($val == "Other" && $("#frmApplication select[name=gradelevel]").val() != "0") 
									$("#frmApplication #row_nameofschool").show();
								else
									$("#frmApplication #row_nameofschool").hide();
							}
							$(document).ready(function() {
								$.ajax({
									type: "post",
									cache: true,
									url: "process.php?action=getgradeschool",
									success: function(html) {
										$("#frmApplication select[name=gradeschool]").html(html);
										showNameOfSchool();
									}
								});
								$("#frmApplication select[name=gradeschool").change(function() {
									showNameOfSchool();
								});
							})
							</script>
							<tr id="row_nameofschool">
								<td colspan="2">
									<label>Name of School</label>
									<input type="text" name="namegradeschool">
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<label>Address</label>
									<input type="text" name="gsaddress">
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<label>Year Graduated</label>
									<select name="yeargraduate">
									<?php
									for($i = 2016; $i >= 1900; $i--) {
										echo '<option value="'.$i.'">'.$i.'</option>';
									}
									?>
									</select>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<label><input type="checkbox" name="confirm"><span></span>I certify that all of the information above is to the best of my knowledge and belief true, correct and complete.</label>
									<br><br><ul class="button-container block center">
										<li><a id="btnSubmit" class="raised_button large_button">Register</a></li>
									</ul>
									<center><div class="loading" style="display: none;"></div></center>
								</td>
							</tr>
						</table>
						<script>
						$(document).ready(function() {
							$("input[type=text]:not([name=namegradeschool]):not([name=gaddress]), input[type=date]").focusout(function() {
								if($(this).val() == "") {
									$(this).css({
										"border-bottom": "1px solid red"
									});
								} else {
									$(this).css({
										"border-bottom": "1px solid #ccc"
									});
								}
							});
							$("#frmApplication input[name=fname]").change(function() {
								if($("#frmApplication select[name=relationship]").val() == "Father") {
									$("#frmApplication input[name=gname]").val($("#frmApplication input[name=fname]").val())
								}
							});
							$("#frmApplication input[name=mname]").change(function() {
								if($("#frmApplication select[name=relationship]").val() == "Mother") {
									$("#frmApplication input[name=gname]").val($("#frmApplication input[name=mname]").val())
								}
							});
							$("#frmApplication input[name=gname]").change(function() {
								if($("#frmApplication select[name=relationship]").val() == "Mother") {
									$("#frmApplication input[name=gname]").val($("#frmApplication input[name=mname]").val())
								}
							});
							$("#frmApplication select[name=relationship]").change(function() {
								if($(this).val() == "Father") {
									$("#frmApplication input[name=gname]").val($("#frmApplication input[name=fname]").val()).prop("disabled", true).css({
										"border-bottom": "1px solid #ccc"
									});
								} else if($(this).val() == "Mother") {
									$("#frmApplication input[name=gname]").val($("#frmApplication input[name=mname]").val()).prop("disabled", true).css({
										"border-bottom": "1px solid #ccc"
									});
								} else {
									$("#frmApplication input[name=gname]").prop("disabled", false);
								}
							});
							$("#frmApplication input[name=gaddress]").focusout(function() {
								if(!$("#frmApplication input[name=sameaddress]").is(":checked") && $(this).val() == "") {
									$(this).css({
										"border-bottom": "1px solid red"
									});
								} else {
									$(this).css({
										"border-bottom": "1px solid #ccc"
									});
								}
							});
							$("#frmApplication input[name=sameaddress]").change(function() {
								if(this.checked) {
									$("#frmApplication input[name=gaddress]").prop("disabled", true).val("").css({
										"border-bottom": "1px solid #ccc"
									});
								} else {
									$("#frmApplication input[name=gaddress]").prop("disabled", false);
								}
							});
							$("#frmApplication input[name=confirm]").change(function() {
								if(this.checked) {
									$(this).parent("label").css({
										"background": "none"
									})
								}
							});
							$("#frmApplication input[name=namegradeschool]").focusout(function() {
								if($("#frmApplication select[name=gradeschool]").val() == "Other" && $(this).val() == "") {
									$(this).css({
										"border-bottom": "1px solid red"
									});
								} else {
									$(this).css({
										"border-bottom": "1px solid #ccc"
									});
								}
							})
							$("#frmApplication #btnSubmit").click(function() {
								$gradelevel = $("#frmApplication select[name=gradelevel]").val();
								$firstname = $("#frmApplication input[name=firstname]").val();
								$middlename = $("#frmApplication input[name=middlename]").val();
								$lastname = $("#frmApplication input[name=lastname]").val();
								$auxname = $("#frmApplication select[name=auxname]").val();
								$gender = $("#frmApplication select[name=gender]").val();
								$birthdate = $("#frmApplication input[name=birthdate]").val();
								$birthplace = $("#frmApplication input[name=birthplace]").val();
								$religion = $("#frmApplication select[name=religion]").val();
								$status = $("#frmApplication select[name=status]").val();
								$citizenship = $("#frmApplication select[name=citizenship]").val();
								$nostreetbrgy = $("#frmApplication input[name=nostreetbrgy]").val();
								$city = $("#frmApplication input[name=city]").val();
								$province = $("#frmApplication input[name=province]").val();
								$country = $("#frmApplication select[name=country]").val();
								$zipcode = $("#frmApplication input[name=zipcode]").val();
								$email = $("#frmApplication input[name=email]").val();
								$mobileno = $("#frmApplication input[name=mobileno]").val();
								$fname = $("#frmApplication input[name=fname]").val();
								$foccupation = $("#frmApplication input[name=foccupation]").val();
								$mname = $("#frmApplication input[name=mname]").val();
								$moccupation = $("#frmApplication input[name=moccupation]").val();
								$gname = $("#frmApplication input[name=gname]").val();
								$relationship = $("#frmApplication select[name=relationship]").val();
								$gaddress = $("#frmApplication input[name=gaddress]").val();
								$gmobileno = $("#frmApplication input[name=gmobileno]").val();
								$gradeschool = $("#frmApplication select[name=gradeschool]").val();
								$namegradeschool = $("#frmApplication input[name=namegradeschool]").val();
								$gsaddress = $("#frmApplication input[name=gsaddress]").val();
								$yeargraduate = $("#frmApplication select[name=yeargraduate]").val();
								$sameaddress = $("#frmApplication input[name=sameaddress]");
								$confirm = $("#frmApplication input[name=confirm]");
								$complete = true;
								$("input[type=text]:not([name=namegradeschool]):not([name=gaddress]), input[type=date]").each(function() {
									if($(this).val() == "") {
										$(this).css({
											"border-bottom": "1px solid red"
										});
										$complete = false;
									} else {
										$(this).css({
											"border-bottom": "1px solid #ccc"
										});
									}
								});
								if(!$("#frmApplication input[name=sameaddress]").is(":checked") && $gaddress == "") {
									$complete = false;
									$("#frmApplication input[name=gaddress]").css({
										"border-bottom": "1px solid red"
									});
								} else {
									$("#frmApplication input[name=gaddress]").css({
										"border-bottom": "1px solid #ccc"
									});
								}
								if($gradeschool == "Other" && $namegradeschool == "") {
									$complete = false;
									$("#frmApplication input[name=namegradeschool]").css({
										"border-bottom": "1px solid red"
									});
								} else {
									$("#frmApplication input[name=namegradeschool]").css({
										"border-bottom": "1px solid #ccc"
									});
								}
								if(!$confirm.is(":checked") && $complete) {
									$("#frmApplication input[name=confirm]").parent("label").css({
										"background": "yellow"
									});
									$complete = false;
								}
								if($complete) {
									$("#frmApplication .loading").show("slow");
									$("#frmApplication ul.button-container").hide();
									showSnackbarMsg("Processing...");
									$.ajax({
										type: "post",
										cache: false,
										url: "process.php?action=register",
										data: {gradelevel: $gradelevel, firstname: $firstname, middlename: $middlename, lastname: $lastname, auxname: $auxname, gender: $gender, birthdate: $birthdate, birthplace: $birthplace, religion: $religion, status: $status, citizenship: $citizenship, nostreetbrgy: $nostreetbrgy, city: $city, province: $province, country: $country, zipcode: $zipcode, email: $email, mobileno: $mobileno, fname: $fname, foccupation: $foccupation, mname: $mname, moccupation: $moccupation, gname: $gname, relationship: $relationship, gaddress: $gaddress, sameaddress: $sameaddress.is(":checked"), gmobileno: $gmobileno, gradeschool: $gradeschool, namegradeschool: $namegradeschool, gsaddress: $gsaddress, yeargraduate: $yeargraduate},
										success: function(html) {
											$("#frmApplication").html(html);
										}
									})
								} else {
									$("#frmApplication input[name=confirm]").prop("checked", false);
								}
							});
							$("#frmApplication table.form-container tr:not(.nohide)").hide();
							$("#frmApplication select[name=gradelevel]").change(function() {
								$val = $(this).val();
								if($val == "0") {
									$("#frmApplication table.form-container tr:not(.nohide)").hide();
								} else {
									$.ajax({
										type: "post",
										cache: true,
										url: "process.php?action=checkenroll",
										data: {gradelevel: $val},
										success: function(html) {
											$("#snackbar .wrapper").html(html);
										}
									});
								}
							});
						});
						</script>
					</div>
					<?php
					} else {
					?>
					<div class="card">
						<h4>Message</h4>
						<p>Registration is currently close.</p>
					</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
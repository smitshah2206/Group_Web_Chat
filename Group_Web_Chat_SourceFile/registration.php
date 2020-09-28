<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="Css/styleregistration.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div id="outer">
		<div id="header">
			<div id="headerfirst">
				<div id="logo">
					<h2>Company Name</h2>					
				</div>
			</div>	
		</div>
	</div>
	<div id="outerbox">
		<div id="inner1">
			<h2>Sign Up</h2>
		</div>
		<div id="inner2">
			<form id="sample_form" method="POST">
				<div id="profilesection">
					<table>
						<tr>
							<td>
								<label><b>First Name</b></label>
								<input type="text" name="first_name" value="" autocomplete="off" required="required"  /><br>
								<span id="first_name_error"></span>
							</td>
							<td>
								<label><b>Last Name</b></label>
								<input type="text" name="last_name" value="" autocomplete="off" required="required"  /><br>
								<span id="last_name_error"></span>
							</td>
						</tr>
						<tr>
							<td>
								<label><b>User Name</b></label>
								<input type="text" name="user_name" value="" autocomplete="off" required="required"  /><br>
								<span id="user_name_error"></span>
							</td>
							<td>
								<label><b>Password</b></label><br>
								<input type="password" name="password" value="" autocomplete="off" required="required"  /><br>
								<span id="password_error"></span>
							</td>
						</tr>
					</table>
				</div>
				<div id="contactsection">
					<table>
						<tr>
							<td>
								<label><b>Contact Number</b></label>
								<input type="number" name="contact_number" value="" autocomplete="off" required="required"  /><br>
								<span id="contact_number_error"></span>
							</td>
							<td>
								<label><b>Contact Email</b></label>
								<input type="email" name="contact_email" value="" autocomplete="off" required="required"  /><br>
								<span id="contact_email_error"></span>
							</td>
						</tr>
					</table>
				</div>
				<div id="descriptionsection">
					<table>
						<tr>
							<td>
								<label><b>Date Of Birth</b></label>
								<input type="date" name="date_of_birth" value="" autocomplete="off" required="required"  /><br>
								<span id="date_of_birth_error"></span>
							</td>
							<td>
								<label><b>Location</b></label>
								<input type="text" name="location" value="" autocomplete="off" required="required"  /><br>
								<span id="location_error"></span>
							</td>
						</tr>
					</table>
					<div id="submitbutton">
						<input type="button" name="reset" value="Sign In" id="signin" />
						<input type="submit" name="submit" value="Sign Up"  />
					</div>
				</div>
			</form>
		</div>
	</div>
	<div id="footer">
			<div id="devlopername">
				<h2>Powered By</h2>
				<h3><a href="https://mobile.twitter.com/SmitShah2206" target="_blank">Smit Shah</a></h3>
				<ul>
					<li><a href="https://www.facebook.com/smitshah22050602" target="_blank"><i class="fa fa-facebook fa-1x" aria-hidden="true"></i></a></li>
					<li><a href="https://www.instagram.com/_king_kohli_018/" target="_blank"><i class="fa fa-instagram fa-1x" aria-hidden="true"></i></a></li>
					<li><a href="https://www.linkedin.com/in/smit-shah-60823514a" target="_blank"><i class="fa fa-linkedin fa-1x" aria-hidden="true"></i></a></li>
					<li><a href="https://github.com/smitshah2206" target="_blank"><i class="fa fa-github fa-1x" aria-hidden="true"></i></a></li>
				</ul>					
			</div>
		</div>
	</div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
	$(document).ready(function(){
		$('#signin').on('click', function(event){
			window.location='index.php';
		});
		$('#sample_form').on('submit', function(event){
			$('#first_name_error').text('');
			$('#last_name_error').text('');
			$('#user_name_error').text('');
			$('#password_error').text('');
			$('#contact_number_error').text('');
			$('#contact_email_error').text('');
			$('#date_of_birth_error').text('');
			$('#location_error').text('');
			event.preventDefault();
			$.ajax({
				url:"signup.php",
				method:"POST",
				data: new FormData(this),
				dataType:"json",
				contentType:false,
				cache:false,
				processData:false,
				success:function(data)
				{
					if(data.error==1)
					{
						alert("Account Created..!!!");
						window.location='index.php';
					}
					else
					{
						$('#first_name_error').text(data.first_name_message);
						$('#last_name_error').text(data.last_name_message);
						$('#user_name_error').text(data.user_name_message);
						$('#password_error').text(data.password_message);
						$('#contact_number_error').text(data.contact_number_message);
						$('#contact_email_error').text(data.contact_email_message);
						$('#date_of_birth_error').text(data.date_of_birth_message);
						$('#location_error').text(data.location_message);
					}
				}
			})
		});
	});
	</script>
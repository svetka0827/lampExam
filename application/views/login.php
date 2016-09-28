<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!DOCTYPE html>
<html>
<head>
	<title>Login / Registration </title>

	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  	<link rel="stylesheet" href="/resources/demos/style.css">
  	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
  	<script>

	  	$(document).ready(function()
	  	{
			$("#datepicker").datepicker( {
			    dateFormat: "yy-mm-dd",
			});
	  	});

  	</script>

	<style type="text/css">
	label{
		display:block;
	}

	</style>
</head>
<body>
	<div id="login">
<?php		if($this->session->flashdata("registration_errors"))
			{
				echo $this->session->flashdata("registration_errors");
			}

			if($this->session->flashdata("success"))
			{
				echo $this->session->flashdata("success");
			}
			if($this->session->flashdata("login_errors"))
			{
				echo $this->session->flashdata("login_errors");
			}



?>
		<form action="/Users/log_in" method="POST">
			<fieldset>
			<legend> Log In </legend>
				<input type="hidden" name="hide">
				<label>Email:
					<input type="text" name="email">
				</label>
				<label>Password:
					<input type="password" name="password">
				</label>
				<button>Log In</button>
				</fieldset>
		</form>
	</div>

	<div id="register">

		<form action="/Users/add_user" method="post">
		<fieldset>
		<legend> OR Register </legend>
			<input type="hidden" name="hide"> 
			<label>Name:
				<input type="text" name="name"> 
			</label>
			<label>Alias:
				<input type="text" name="alias">
			</label>
			<label>Email:
				<input type="text" name="email">
			</label>
			<label>Password:
				<input type="password" name="password">
			</label>
			<label>Confirm Password:
				<input type="password" name="confirm_password">
			</label>
			<label>
				<input type="text" id="datepicker" name="dob" placeholder="YYYY/mm/dd" >
			</label>
			<button>Register</button>
			</fieldset>
		</form>
	</div>

</body>
</html>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!DOCTYPE html>
<html>
<head>
	<title>Login / Registration </title>
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
		<form action="/Students/log_in" method="POST">
		<fieldset>
		<legend> Log In </legend>
			<input type="hidden" name="hide">
			<label>Email:
				<input type="text" name="email">
			</label>
			<label>Password:
				<input type="text" name="password">
			</label>
			<button>Log In</button>
			</fieldset>
		</form>
	</div>

	<div id="register">

		<form action="/Students/add" method="post">
		<fieldset>
		<legend> OR Register </legend>
			<input type="hidden" name="hide"> 
			<label>First Name:
				<input type="text" name="first_name"> 
			</label>
			<label>Last Name:
				<input type="text" name="last_name">
			</label>
			<label>Email Address:
				<input type="text" name="email">
			</label>
			<label>Password:
				<input type="password" name="password">
			</label>
			<label>Confirm Password:
				<input type="password" name="confirm_password">
			</label>
			<button>Register</button>
			</fieldset>
		</form>
	</div>

</body>
</html>
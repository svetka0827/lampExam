<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome page</title>
</head>
<body>
	<h3>Welcome!</h3>
	<fieldset>
	<legend> Student</legend>
	<p>First Name: <?=$this->session->userdata('first_name')?></p>
	<p>Last Name: <?=$this->session->userdata('last_name')?> </p>
	<p>Email: <?=$this->session->userdata('email')?> </p>
	<form action="/Students/logout" method="post">
		<button>LogOut</button>
	</form>
	</fieldset>
</body>
</html>
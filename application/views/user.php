<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h3><a href="/Users/logout">LogOut</a></h3>
	<p>This user has: <?= $user_qout_count['count']?> </p>

		<?php
		
			foreach($user_info as $info)
			{
		?>
				<p><?= $info['quote']?></p>

		<?php
			}
	    ?>
</body>
</html>
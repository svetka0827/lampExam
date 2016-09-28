<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome page</title>
	<style type="text/css">
		fieldset{
			width:400px;
			display: inline-block;
			vertical-align: top;
		}

		#quotable{
			overflow:scroll;
			width:400px;
			height:500px;
			display: inline-block;
			vertical-align: top;
			border: 1px solid black;
		}

		#quote{
			border: 1px solid black;

		}

		#favorites{
			width:400px;
			height:500px;
			display: inline-block;
			vertical-align: top;
		}

	</style>
</head>
<body>
	<h3><a href="/Users/logout">LogOut</a></h3>
	<h3> Quotable Quotes </h3>
	<div id="quotable">

		<?php
			foreach($quotes as $quote)
			{
		?>
				<div id="quote">
					<p><?= $quote['quote']?></p>
					<p>User name:<?= $quote['alias']?></p>
					<p>quote id:<?= $quote['quote_id']?></p>
					<button><a href="/Users/add_favorites/<?= $quote['quote_id']?>">Add to My List</a></button>
				</div>
		<?php
			}
	    ?>

	</div>

	<fieldset>
		<legend> Your Favorites </legend>
		<?php
			foreach($favorites as $favorite)
			{
		?>
				<div id="favorite">
					<p><?= $favorite['quote']?></p>
					<p>User name:<a href="/Users/display_user/<?= $favorite['posted_user_id']?>"><?= $favorite['posted_user_name']?></a></p>
					<button><a href="/Users/delete_favorite/<?= $favorite['favorites_id']?>">Delete from My List</a></button>
				</div>
		<?php
			}
	    ?>
	</fieldset>



 	<div id="contribute">
 		
		<h5>Contribute a quote:</h5>
		<form action="/Users/add_quote" method="post">
			<input type="hidden" name="hide">
			<label>Quoted by:
				<input type="text" name="name">
			</label>
			<label>Quote:
				<input type="text" name="quote">
			</label>
			<button>Save</button>
		</form>
		<br>
 	</div>




</body>
</html>
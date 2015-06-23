<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<title>Vigenere</title>
</head>

<body>
<div class="container">
	<div class="jumbotron">
    <h1><u>Vigenere Cypher</u></h1>
    <p>Uses the old vigenere algorithm.</p>
  </div>

	<form role="form" action="controler.php" method="POST" >
		<div class="form-group">
			<textarea name="usr_in" rows="8" placeholder="Type your text here" class="form-control"></textarea>
		</div>
		<div class="form-group">
			<input type="password" name="pwd" placeholder="Password" class="form-control"></input>
		</div>
		<div class="checkbox">
			<label><input type="checkbox" name="remember" />Remember password</label>
		</div>
		<button type="submit" name="hide">Crypt</button>
		<button type="submit" name="seek">Decrypt</button>
	</form>
	
</div><!-- Closing container -->
</body>

<footer>
	<p>Copyright - 2015 - <a href="http://keybase.io/codeartha">CodeArtha</p>
</footer>
</html>
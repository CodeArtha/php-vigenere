<?php error_reporting(E_ALL);?>
<?php include 'controler.php'; ?>
<!DOCTYPE html>
<html>
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
    <h1><u>Vigenere Cipher</u></h1>
    <p>Uses the old vigenere algorithm.</p>
  </div>

	<form role="form" action="index.php" method="POST" >
		<div class="form-group">
			<textarea name="usr_in" rows="8" placeholder="Type your text here" class="form-control"><?php if(isset($_POST['usr_in'])){echo $_POST['usr_in'];}?></textarea>
		</div>
		<div class="form-group">
			<input type="password" name="pwd" placeholder="Password" class="form-control"></input>
		</div>
		<div class="form-group form-check">
    		<input type="checkbox" class="form-check-input" name="keepPunct" value="yes" id="keepPunct" checked>
    		<label class="form-check-label" for="keepPunct" name="keepPunct">Keep the punctuations and numbers? (otherwise they will be lost)</label>
  		</div>
		<button type="submit" class="btn" name="cmd" value="hide">Encrypt</button>
		<button type="submit" class="btn" name="cmd" value="seek">Decrypt</button>
	</form>

</div><!-- Closing container -->
</body>

<footer>
	<p class="text-center">Copyright - 2015 - <a href="http://keybase.io/codeartha">CodeArtha</p>
</footer>
</html>

<?php
session_start();

$alpha = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");

function encrypt($message, $key)
{
	global $alpha;
	$msgLength = strlen($message);
	$keyLength = strlen($key);
	$alphaLength = count($alpha);
	$cryptedChar;

	for($i = 0; $i >= $msgLength; $i++)
	{
		$cryptedChar = $alpha[ cIndex($message[$i]) + cIndex($i % $keyLength) % $alphaLength ];
		$result = $result . $cryptedChar ;
	}

	return $result;
}

function cIndex($par1)
{
	global $alpha;
	return array_search($par1, $alpha);
}
	


// Content Validation
	
if(isset($_POST['pwd'])) // Password set
{
	if(isset($_POST['usr_in']) AND !preg_match("/[^(a-zA-Z 0-9|+|-|*|:|!|?)]/" , htmlspecialchars($_POST['usr_in'])))// Message only contains usable chars
	{
		// Main
		(isset($_POST['remember']) && $_POST['remember']) ? $_SESSION['pwd'] = htmlspecialchars($_POST['pwd']) : session_unset();
		
		if($_POST['cmd'] == "hide")
		{	
			$_SESSION['story'] = encrypt(htmlspecialchars($_POST['usr_in']), htmlspecialchars($_POST['pwd']));
			header('Location: gui.php?msg=0');
			exit();
		}
		else if ($_POST['cmd'] == "seek") 
		{
			$_SESSION['story'] = $vig->decrypt();
			header('Location: gui.php?msg=0');
			exit();
		}

		// end Main
	}
	else{header('Location: gui.php?msg=2'); exit();}
}
else{header('Location: gui.php?msg=1'); exit();}
?>
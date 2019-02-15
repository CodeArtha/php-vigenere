<?php

function encrypt(string $message, string $key): string
{
	$result = '';
	$alpha = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
	$msgLength = strlen($message);
	$keyLength = strlen($key);
	$alphaLength = count($alpha);
	$cryptedChar;

	for($i = 0; $i < $msgLength; $i++)
	{
		$msgLetterIndex = array_search($message[$i], $alpha);
		$keyLetterIndex = array_search($key[$i % $keyLength], $alpha);
		$cryptedChar = $alpha[ ($msgLetterIndex + $keyLetterIndex) % $alphaLength ];
		$result .= $cryptedChar ;
	}
	return $result;
}

function decrypt(string $message, string $key): string
{
	$result = '';
	$alpha = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
	$msgLength = strlen($message);
	$keyLength = strlen($key);
	$alphaLength = count($alpha);
	$plainChar;

	for($i = 0; $i < $msgLength; $i++)
	{
		$msgLetterIndex = array_search($message[$i], $alpha);
		$keyLetterIndex = array_search($key[$i % $keyLength], $alpha);
		$plainChar = $alpha[ ($msgLetterIndex + $keyLetterIndex) % $alphaLength ];
		$result .= $plainChar ;
	}
	return $result;
}

// Content Validation

if(isset($_POST['pwd']) && isset($_POST['usr_in'])) // Password set
{
	if(!preg_match("/[^(a-zA-Z 0-9|+|-|*|:|!|?)]/" , htmlspecialchars($_POST['usr_in'])))// Message only contains usable chars
	{
		if($_POST['cmd'] === "hide")
		{
			$_POST['usr_in'] = encrypt(htmlspecialchars($_POST['usr_in']), htmlspecialchars($_POST['pwd']));
		}
		else if ($_POST['cmd'] === "seek")
		{
			$_POST['usr_in'] = decrypt(htmlspecialchars($_POST['usr_in']), htmlspecialchars($_POST['pwd']));
		}
	}
}
?>

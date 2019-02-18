<?php
// stores the punctuations signs, numbers and spaces in the text and their position
$punctuations = [];

function save_punctuation(string $text): string
{
	global $punctuations;
	$punctuactions = [];
	for($i = 0; $i < strlen($text); $i++)
	{
		switch ($text[$i])
		{
			case '0':
				$punctuations[(string) $i] = '0';
				break;
			case '1':
				$punctuations[(string) $i] = '1';
				break;
			case '2':
				$punctuations[(string) $i] = '2';
				break;
			case '3':
				$punctuations[(string) $i] = '3';
				break;
			case '4':
				$punctuations[(string) $i] = '4';
				break;
			case '5':
				$punctuations[(string) $i] = '5';
				break;
			case '6':
				$punctuations[(string) $i] = '6';
				break;
			case '7':
				$punctuations[(string) $i] = '7';
				break;
			case '8':
				$punctuations[(string) $i] = '8';
				break;
			case '9':
				$punctuations[(string) $i] = '9';
				break;
			case ' ':
				$punctuations[(string) $i] = ' ';
				break;
			case '.':
				$punctuations[(string) $i] = '.';
				break;
			case ',':
				$punctuations[(string) $i] = ',';
				break;
			case '?':
				$punctuations[(string) $i] = '?';
				break;
			case '!':
				$punctuations[(string) $i] = '!';
				break;
			case ':':
				$punctuations[(string) $i] = ':';
				break;
			case ';':
				$punctuations[(string) $i] = ';';
				break;
			case '-':
				$punctuations[(string) $i] = '-';
				break;
			case '"':
				$punctuations[(string) $i] = '"';
				break;
			case "'":
				$punctuations[(string) $i] = "'";
				break;
		}
	}

	$text = str_replace(' ', '', $text);
	$text = str_replace('.', '', $text);
	$text = str_replace(',', '', $text);
	$text = str_replace('?', '', $text);
	$text = str_replace('!', '', $text);
	$text = str_replace(':', '', $text);
	$text = str_replace(';', '', $text);
	$text = str_replace('-', '', $text);
	$text = str_replace('"', '', $text);
	$text = str_replace("'", '', $text);
	$text = str_replace('0', '', $text);
	$text = str_replace('1', '', $text);
	$text = str_replace('2', '', $text);
	$text = str_replace('3', '', $text);
	$text = str_replace('4', '', $text);
	$text = str_replace('5', '', $text);
	$text = str_replace('6', '', $text);
	$text = str_replace('7', '', $text);
	$text = str_replace('8', '', $text);
	$text = str_replace('9', '', $text);

	return $text;
}

function restore_punctuation(string $text): string
{
	global $punctuations;
	if(!empty($punctuations))
	{
		foreach ($punctuations as $index => $punct) {
			$text = substr($text, 0, $index) . $punct . substr($text, $index);
		}
	}
	$punctuations = [];
	return $text;
}

function dump(mixed $in)
{
	echo '<pre>';
	var_dump($in);
	echo '</pre>';
}

function encrypt(string $message, string $key): string
{
	$message = strtolower($message);
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
		$cryptedChar = $alpha[ ($msgLetterIndex + $keyLetterIndex + 1) % $alphaLength ];
		$result .= $cryptedChar ;
	}
	return $result;
}

function decrypt(string $message, string $key): string
{
	$message = strtolower($message);
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
		$plainChar = $alpha[ ($msgLetterIndex - $keyLetterIndex + 2*26 - 1) % $alphaLength ]; // added 2*26 to make sur the modulus will be positive.
		$result .= $plainChar ;
	}
	return $result;
}

// Content Validation

if(isset($_POST['pwd']) && isset($_POST['usr_in']) && isset($_POST['cmd'])) // Password and message are set
{
	$_POST['pwd'] = strtolower(preg_replace("/(?:[^a-zA-Z]*)/" , '',$_POST['pwd'])); //password can't contain anything other than lowercase a-z

	//save's the punctuations if needed and/or removes them from the string
	if(isset($_POST['keepPunct']) && ($_POST['keepPunct'] = htmlspecialchars($_POST['keepPunct']) === "yes"))
	{
		$_POST['usr_in'] = strtolower(htmlspecialchars($_POST['usr_in']));
		$_POST['usr_in'] = preg_replace("/(?:[^a-z0-9\ \.\,\?\!\:\;\-\"\']*)/" , '',$_POST['usr_in']); //replaces everything that IS NOT alpha numeric or one of the punctuations we allow the user to keep in his messages like .,!? etc.
		$_POST["usr_in"] = save_punctuation($_POST["usr_in"]);
	}else{
		$_POST["usr_in"] = strtolower(preg_replace("/(?:[^a-zA-Z]*)/" , '', $_POST['usr_in']));
	}

	//do the magic the user requested
	if(htmlspecialchars($_POST['cmd']) === "hide")
	{
		$_POST['usr_in'] = ($_POST['keepPunct'] == "yes") ? restore_punctuation(encrypt($_POST['usr_in'], $_POST['pwd'])) : encrypt($_POST['usr_in'], $_POST['pwd']);
	}
	else if (htmlspecialchars($_POST['cmd']) === "seek")
	{
		$_POST['usr_in'] = ($_POST['keepPunct'] == "yes") ? restore_punctuation(decrypt($_POST['usr_in'], $_POST['pwd'])) : decrypt($_POST['usr_in'], $_POST['pwd']);
	}else{
		echo "Error: The form you submitted could not be parsed to an action";
	}
}
?>

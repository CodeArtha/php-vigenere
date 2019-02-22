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
	$index2alpha = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
	$alpha2index = ["a" => 0, "b" => 1, "c" => 2, "d" => 3, "e" => 4, "f" => 5, "g" => 6, "h" => 7, "i" => 8, "j" => 9, "k" => 10, "l" => 11, "m" => 12, "n" => 13, "o" => 14, "p" => 15, "q" => 16, "r" => 17, "s" => 18, "t" => 19, "u" => 20, "v" => 21, "w" => 22, "x" => 23, "y" => 24, "z" => 25];
	$msgLength = strlen($message);
	$keyLength = strlen($key);
	$alphaLength = count($index2alpha);
	$cryptedChar;

	for($i = 0; $i < $msgLength; $i++)
	{
		//array_search is inefficient
		//$msgLetterIndex = array_search($message[$i], $alpha);
		//$keyLetterIndex = array_search($key[$i % $keyLength], $alpha);
		$msgLetterIndex = $alpha2index[$message[$i]];
		$keyLetterIndex = $alpha2index[$key[$i % $keyLength]];
		$cryptedChar = $index2alpha[ ($msgLetterIndex + $keyLetterIndex + 1) % $alphaLength ];
		$result .= $cryptedChar ;
	}
	return $result;
}

function decrypt(string $message, string $key): string
{
	$message = strtolower($message);
	$result = '';
	$index2alpha = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
	$alpha2index = ["a" => 0, "b" => 1, "c" => 2, "d" => 3, "e" => 4, "f" => 5, "g" => 6, "h" => 7, "i" => 8, "j" => 9, "k" => 10, "l" => 11, "m" => 12, "n" => 13, "o" => 14, "p" => 15, "q" => 16, "r" => 17, "s" => 18, "t" => 19, "u" => 20, "v" => 21, "w" => 22, "x" => 23, "y" => 24, "z" => 25];
	$msgLength = strlen($message);
	$keyLength = strlen($key);
	$alphaLength = count($index2alpha);
	$plainChar;

	for($i = 0; $i < $msgLength; $i++)
	{
		$msgLetterIndex = $alpha2index[$message[$i]];
		$keyLetterIndex = $alpha2index[$key[$i % $keyLength]];
		$plainChar = $index2alpha[ ($msgLetterIndex - $keyLetterIndex + 2*26 - 1) % $alphaLength ]; // added 2*26 to make sur the modulus will be positive.
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
		$start_time = microtime(true);
		$var = encrypt($_POST['usr_in'], $_POST['pwd']);
		$stop_time = microtime(true);
		echo ($stop_time - $start_time); //0.001778 => 0.000477 = -73%
		$_POST['usr_in'] = ($_POST['keepPunct'] == "yes") ? restore_punctuation($var) : $var ;
	}
	else if (htmlspecialchars($_POST['cmd']) === "seek")
	{
		$start_time = microtime(true);
		$var = decrypt($_POST['usr_in'], $_POST['pwd']);
		$stop_time = microtime(true);
		echo ($stop_time - $start_time); //0.001169 => 0.0005269 = -55%
		$_POST['usr_in'] = ($_POST['keepPunct'] == "yes") ? restore_punctuation($var) : $var;
	}else{
		echo "Error: The form you submitted could not be parsed to an action";
	}
}
?>

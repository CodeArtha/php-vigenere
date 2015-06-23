<?php
session_start();

echo '<pre>';
print_r($_POST);
echo '</pre>';

/**else if(preg_match("/[^(a-zA-Z 0-9|+|-|*|:|!|?)]/" , htmlspecialchar($_POST['usr_in'])))*/
	
// Content Validation
	
if(isset($_POST['pwd'])) // Password set
{
	if(isset($_POST['usr_in']) AND !preg_match("/[^(a-zA-Z 0-9|+|-|*|:|!|?)]/" , htmlspecialchar($_POST['usr_in'])))// Message only contains usable chars
	{
		// Main
		(isset($_POST['remember'] && $_POST['remember']) ? $_SESSION['pwd'] = htmlspecialchar($_POST['pwd']) : unset($_SESSION['pwd']);
		
		
		// end Main
	}
	else{header('Location: gui.php?msg=2'); exit();}
}
else{header('Location: gui.php?msg=1'); exit();}


?>
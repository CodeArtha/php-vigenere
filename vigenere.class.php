class vigenere
{
	private $_message;
	private $_result;
	private $_key;
	private $_action;
	private $_alpha = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");


	public function encrypt()
	{
		private $msgLength = strlen(this->_message);
		private $keyLength = strlen(this->_password);
		private $alphaLenght = count(this->_alpha);
		private $cryptedChar;
		
		for($i = 0; $i <= $msgLength; $i++)
		{
			$cryptedChar = this->_alpha[ cIndex($_message[$i]) + cIndex($i % $keyLenght) % $_alphaLength ];
			this->_result = this->_restult . this->cryptedChar ;
		}


		this->_result
	
	}
	
	private function cIndex($par1)
	{
		return array_search($par1, this->_alpha);
	}
	
	public function setMessage($par1)
	{
		this->_message = htmlspecialchars($par1);
	}
	
	public function setKey($par1)
	{
		this->_key = htmlspecialchars($par1);
	}
}
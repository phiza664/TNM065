<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

// some code
?> 


<?php
class ConnectDB
{

    private $serverName;
    private $userName;
    private $password;
	private $password;
    
	function ConnectDB($serverName,$userName,$password) {
        $this->setServerName($serverName);
		$this->setUserName($userName);
		$this->setPassword($password);
    }
	
 
    
	public function connect()
	{
		$con = mysql_connect($serverName,$userName,$password);
		if (!$con)
		{
		  die('Could not connect: ' . mysql_error());
		}
		
	}
    
}

$person = new Person();
$person->setPrefix("Mr.");
$person->setGivenName("John");

echo($person->getPrefix());
echo($person->getGivenName());

?>
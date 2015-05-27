<?php 

/**
* 
*/
class connectDB
{
	public static $con = "";	
	function __construct()
	{
		// prepare database connection variables
		$db_host = 'localhost';
		$db_name = 'appdata';
		$db_user = 'root';
		$db_pass = 'root';

		self::$conn = new PDO("mysql:host=$db_host; dbname=$db_name", $db_user, $db_pass);
	}
}

?>
<?php
require "../vendor/ircmaxell/password-compat/lib/password.php";

class SingletonToken
{
    /**
     * Returns the *Singleton* instance of this class.
     *
     * @staticvar Singleton $instance The *Singleton* instances of this class.
     *
     * @return Singleton The *Singleton* instance.
     */
    private static $hash = "";
    private static $key = "";
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }
        
        return $instance;
    }

    /**
     * Protected constructor to prevent creating a new instance of the
     * *Singleton* via the `new` operator from outside of this class.
     */
    protected function __construct()
    {
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * Private unserialize method to prevent unserializing of the *Singleton*
     * instance.
     *
     * @return void
     */
    private function __wakeup()
    {
    }

    /*
    |--Genarate Hash
    */
    private function genarateToken($key){
    	$options = [
    	    'cost' => 10,
    	];
    	return password_hash($key, PASSWORD_BCRYPT, $options);
    }

    public function getToken() {
    	return self::$hash;
    }
    public function setKey($key) {
    	self::$key = $key;
    	self::$hash = self::genarateToken($key);
    }

    public function validateToken($token){
    	if (password_verify(self::$key, $token)) {
    		$options = [
    	    	'cost' => 10,
    		];
    		if (password_needs_rehash($token, PASSWORD_BCRYPT, $options)) {
            	self::$hash = password_hash(self::$key, PASSWORD_BCRYPT, $options);
            	/* Store new hash in db */      	
        	}
    		return true;
    	}else{
    		return false;
    	}
    }
}

// Create Object Singleton Token
$obj_token = SingletonToken::getInstance();

?>
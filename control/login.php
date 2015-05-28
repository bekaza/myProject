<?php

// Setup File
include_once "setupSentry.php";
include_once "token.php";

// function PDO connect DB
function connectDB_FindUserIDbyFBID($fb_id)
{
	// prepare database connection variables
	$db_host = 'localhost';
	$db_name = 'appdata';
	$db_user = 'root';
	$db_pass = 'root';
	 
	// connect
	try {
	    // If you change db server system, change this too!
	    $conn = new PDO("mysql:host=$db_host; dbname=$db_name", $db_user, $db_pass);

	    $feild = ["id","screen_name"];

	    $term = array(
	    	//'feild' 	=> "id",
	        'fb_id'   	=> $fb_id,
	    );
	     
	    // prepare query
	    $result = $conn->prepare("SELECT ".$feild[0]." FROM users WHERE FB_id=:fb_id");
	     
	    // bind statement and query it
	    $result->execute($term);

	    if ($result !== false) 
	    {            
	        $row = $result->fetch();
	        return $row['id'];
	    }else{
	    	return null;
	    }
	}
	catch (PDOException $e) 
	{
	    echo $e->getMessage();
	}
}



// Check Submit Form
if (isset($_POST['submit_SN']) || isset($_POST['submit_FB']))
{
	$error_msg = "";
	$username = "";
	// Check log in Facebook
	if(isset($_POST['FB_id']) && $_POST['FB_id'] !== "")
	{

		$fb_id = filter_var($_POST['FB_id'],FILTER_SANITIZE_NUMBER_INT);
		
		$user_id = connectDB_FindUserIDbyFBID($fb_id);

		if($user_id !== null)
		{
			try
			{
				$user = Sentry::findUserById($user_id);
				Sentry::login($user, false);
				$username = $user->screen_name;
			}
			catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
			{
			    $error_msg =  'Login field is required.';
			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
			    $error_msg =  'User not found.';
			}
			catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
			{
			    $error_msg =  'User not activated.';
			}

			// Following is only needed if throttle is enabled
			catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
			{
			    $time = $throttle->getSuspensionTime();

			    $error_msg =  "User is suspended for [$time] minutes.";
			}
			catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
			{
			    $error_msg =  'User is banned.';
			}

		}else{
			$error_msg = "User was not found.";
		}
		
	}else{

		// validate input
		$username = filter_var($_POST['screen_name'], FILTER_SANITIZE_STRING);
    	$password = strip_tags(trim($_POST['password']));

    	// set login credentials
	    try
	    {
	        // Login credentials
	        $credentials = array(
	            'screen_name'    => $username,
	            'password' => $password,
	        );
	        // Authenticate the user
	        $user = Sentry::authenticate($credentials, false);	        
	    }
	    catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
	    {
	        $error_msg = 'Login field is required.';
	    }
	    catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
	    {
	        $error_msg = 'Password field is required.';
	    }
	    catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
	    {
	        $error_msg = 'Wrong password, try again.';
	    }
	    catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
	    {
	        $error_msg = 'User was not found.';
	    }
	    catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
	    {
	        $error_msg = 'User is not activated.';
	    }

	    // The following is only required if the throttling is enabled
	    catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
	    {
	        $error_msg = 'User is suspended.';
	    }
	    catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
	    {
	        $error_msg = 'User is banned.';
	    }
	}
	
	// check Result
	if($error_msg == ""){
    	// generate Token
    	$obj_token->setKey($username);	    	
    	$result = [
    		'stauts' => true,
    		'token' => $obj_token->getToken(),
    	];
    }else{
    	$result = [
    		'stauts' => false,
    		'error_msg' => $error_msg,
    	];
    }

	print_r($result);
}else{
	//header("Location: ../Pages/login.php");
	die("No submit !!!");
}
?>
<br>
<a href="../Pages/profile.php" title="">Profile</a>
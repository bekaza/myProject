<?php
// Setup File
include_once "setupSentry.php";
include_once "token.php";

$obj_token = SingletonToken::getInstance();

if (isset($_POST['submit_SN']) !== null){
	// Check log in Facebook
	if(isset($_POST['FB_id'])){

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
	        echo 'Login field is required.';
	    }
	    catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
	    {
	        echo 'Password field is required.';
	    }
	    catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
	    {
	        echo 'Wrong password, try again.';
	    }
	    catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
	    {
	        echo 'User was not found.';
	    }
	    catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
	    {
	        echo 'User is not activated.';
	    }

	    // The following is only required if the throttling is enabled
	    catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
	    {
	        echo 'User is suspended.';
	    }
	    catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
	    {
	        echo 'User is banned.';
	    }
	    echo "Login Success";
	}   

}else{
	//header("Location: ../Pages/login.php");
	echo "No submit";
	die();
}
?>
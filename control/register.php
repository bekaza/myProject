<?php

// Setup Sentry
include_once "setupSentry.php";

// Check Submit Register
if (isset($_POST['submit_SN']) || isset($_POST['submit_FB']))
{
	$error_msg = "";
	$scree_name = "";
	$password = "";
	$email = "";
	$first_name = "";
	$last_name = "";

	// Check Register with Facebook
	if(isset($_POST['FB_id']) && $_POST['FB_id'] !== "")
	{
		$fb_id = filter_var($_POST['FB_id'], FILTER_SANITIZE_NUMBER_INT);

		// Get credentials FB
		echo "Facebook ID : " . $fb_id;
	}else{
		try
		{
			$credentials = array(
				'screen_name' 	=> 	filter_var($_POST['screen_name'], FILTER_SANITIZE_STRING),
				'password'		=> 	$_POST['password'],
				'email' 		=> 	filter_var($_POST['email'], FILTER_VALIDATE_EMAIL),
				'first_name'	=> 	filter_var($_POST['first_name'], FILTER_SANITIZE_STRING),
				'last_name'		=> 	filter_var($_POST['last_name'], FILTER_SANITIZE_STRING),
				'activated'		=> 	true,
			);
			$user = Sentry::createUser($credentials);
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    $error_msg = 'Login field is required.';
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
		    $error_msg = 'Password field is required.';
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
		    $error_msg = 'User with this login already exists.';
		}	
	}

	if($error_msg == ""){
		$result = [
			"status" => true,
		];
	}else{
		$result = [
			"status" 		=> true,
			"error_msg" 	=> $error_msg
		];
	}
	var_dump($result);
}else{
	die("No Submit !!!");
}

?>
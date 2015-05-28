<?php
// Setup Sentry
include_once "setupSentry.php";
include_once 'token.php';

if ( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ){
	
	if($obj_token->validateToken($_POST['token']) && Sentry::check()){
		
		// get Data
		$id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
		$category = $_POST['category'];

		try
		{	
		    $user = Sentry::findUserById($id);
		    $result_json = "";
		    //print_r($user);

			switch (intval($category)) {
				case 1:
					$result_json = [
						"screen_name" 	=> $user->screen_name,
						"fb_id" 		=> $user->FB_id,
						"fb_name" 		=> $user->FB_name,
						"email" 		=> $user->email,
						"first_name" 	=> $user->first_name,
						"last_name" 	=> $user->last_name,
						"image_avater" 	=> $user->image_avater,
						"respone_rate"	=> $user->respone_rate,
						"review_rate"	=> $user->review_rate,
					];
					break;
				case 2:
					$result_json = [
						"last_login" 	=> $user->last_login,
						"created_at" 	=> $user->created_at,
						"updated_at" 	=> $user->updated_at,
						"activated" 	=> $user->activated,
						"status"		=> $user->status,
					];
					break;
				case 3:
					$result_json = [
						"coin" 			=> $user->coin,
						"flag" 			=> $user->flag,
						"experience" 	=> $user->experience,
						"travel_score" 	=> $user->travel_score,
						"status"		=> $user->status,
					];
					break;		
				default:
					# code...
					break;
			}

			echo json_encode($result_json);
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e){
		    echo 'User was not found.';
		}
		catch (Exception $e){
			echo $e->getMessage();
		}

	}else{
		echo "Token incorrect !!!";
	}

}else{
	echo "For Ajax method";
}

?>
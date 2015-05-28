
<?php
	// Test System
	include_once "../control/setupSentry.php"; 
	include_once '../control/token.php';
	
	if(Sentry::check()){
		$user = Sentry::getUser();
		$obj_token->setKey($user->scree);
		$token = $obj_token->getToken();
	}else{
		echo "No login !!!";
	}	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
	<h1>ProFile</h1>

	<button type="button" value="1">Category 1</button>
	<button type="button" value="2">Category 2</button>
	<button type="button" value="3">Category 3</button>

	<pre class="result_ajax"></pre>
</body>
</html>

<script type="text/javascript" charset="utf-8">
	$("button").click(function(){
		$.ajax({
		 	method: "POST",
		  	url: "../control/getProfile.php",
		  	data: {
		  		id:"<?php echo $user->id;?>", 
		  		token:"<?php echo $token;?>",
		  		category:$(this).val()
		  	}
		}).done(function(result){
			$(".result_ajax").html(result);
		});
	});
	
</script>

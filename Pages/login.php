<?php include_once "../control/setupSentry.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Log in</title>
	<style type="text/css" media="screen">
		form{
			margin-left:10em;
		}
		.text-center{
			text-align:center;
		}
	</style>
</head>
<body>
	<h1 class="text-center">Log in</h1>

	<nav>
		<ul>
			<li><a href="../index.php" title="">Home</a></li>
			<!--Check User is logged in-->
			<?php if(Sentry::check()) {?>

				<li><a href="profile.php" title="">Profile</a></li>
				<li><a href="../control/logout.php" title="">Logout</a></li>

			<?php }else{ ?>	

				<li><a href="register.php" title="">Register</a></li>

			<?php } ?>
		</ul>
	</nav>

	<form action="../control/login.php" method="post">
		<input type="text" name="screen_name" value="" placeholder="Screen Name" required="required">
		<input type="password" name="password" value="" placeholder="Password" required="required">
		<input type="submit" name="submit_SN" value="Log in">
	</form>
	<br>
	<form action="../control/login.php" method="post">
		<input type="text" name="FB_id" value="" placeholder="Facebook ID" required="required">
		<input type="submit" name="submit_FB" value="Log in">
	</form>

	<?php var_dump(Sentry::getUser()); ?>

</body>
</html>
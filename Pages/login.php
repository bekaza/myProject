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
			<li><a href="index.php" title="">Home</a></li>
			<li><a href="register.php" title="">Register</a></li>
		</ul>
	</nav>

	<form action="../Authen/login.php" method="post">
		<input type="text" name="screen_name" value="" placeholder="Screen Name" required="required">
		<input type="password" name="password" value="" placeholder="Password" required="required">
		<input type="submit" name="" value="Log in">
	</form>
	<br>
	<form action="../Authen/login.php" method="post">
		<input type="text" name="FB_id" value="" placeholder="Facebook ID" required="required">
	</form>

</body>
</html>
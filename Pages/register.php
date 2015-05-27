<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<style type="text/css" media="screen">
		form{
			margin-left:15em;
		}
		form > input {
			margin-bottom:1em;
			padding:0.5em;
		}
		.text-center{
			text-align:center;
		}
	</style>
</head>
<body>
	<h1 class="text-center">Register</h1>
	<nav>
		<ul>
			<li><a href="../index.php" title="">Home</a></li>
			<li><a href="login.php" title="">Login</a></li>
			<li><a href="register.php" title="">Register</a></li>
		</ul>
	</nav>
	<form action="../control/register.php" method="post">
		<p>User Default</p>
		<input type="text" name="screen_name" value="" placeholder="Screen Name" required="required">*<br>
		<input type="password" name="password" value="" placeholder="Password" required="required">*<br>
		<input type="password" name="confirm_password" placeholder="Confirm Password" required="required">*<br>
		<input type="text" name="first_name" value="" placeholder="First Name"><br>
		<input type="text" name="last_name" value="" placeholder="Last Name"><br>
		<input type="email" name="email" value="" placeholder="E - mail" required="required">*<br>
		<input type="submit" name="submit_SN" value="Create Account">
	</form>
	<br>

	<form action="../control/register.php" method="post">
		<p>User facebook</p>
		<input type="text" name="FB_id" value="" placeholder="Facebook ID" required="required">
		<input type="submit" name="submit_FB" value="Create Account">
	</form>

</body>
</html>
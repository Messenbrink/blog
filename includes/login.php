<?php 
  session_start();
  include 'includes/header.inc.php';
  $_SESSION['form_token'] = md5(rand(time(), true));
?>

<h1>Login</h1>
<p>Please supply your username and password.</p>
<form action="login_submit.php" method="post">
	<input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
	<label for="blog_user_name">Username</label>
	<input type="text" name="blog_user_name" />
	<label for="blog_user_password">Password</label>
	<input type="password" name="blog_user_password" />
	<input type="submit" value="Login" />
</form>

<?php include 'includes/footer.inc.php'; ?>
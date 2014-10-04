<?php
	if(isset($_SESSION['access_level'])){
    $log_link = 'logout.php';
    $log_link_name = 'Log Out';
  } else {
    $log_link = 'login.php';
    $log_link_name = 'Log In';
  }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>PHP Blogging system</title>
		<link rel="stylesheet" href="stylesheets/general.css">
	</head>
	<body>
		<nav class="menu">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="<?php echo $log_link; ?>"><?php echo $log_link_name; ?></a></li> 
			</ul>
			<hr />
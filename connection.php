<?php

	$hostname = 'localhost';
	$username = 'blog_admin';
	$password = 'secret_password';

	$connection = @mysql_connect($hostname, $username, $password);
	$db = mysql_select_db('blog', $connection);

?>
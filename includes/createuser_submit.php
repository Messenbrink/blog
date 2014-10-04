<?php
  error_reporting(E_ALL);

  session_start();
  include 'includes/header.inc.php';
  $errors = array();

  if(!isset($_SESSION['form_token'])){
    $errors[] = 'Invalid Form Token';
  } else if (
    !isset($_POST['form_token'], $_POST['blog_user_name'], $_POST['blog_user_password'], $_POST['blog_user_password2'], $_POST['blog_user_email']))
  {
    $errors[] = 'All fields must be completed';
  } else if (
    $_SESSION['form_token'] != $_POST['form_token'])
  {
    $errors[] = 'You may only post once';
  } else if (
    strlen($_POST['blog_user_name']) < 2 || strlen($_POST['blog_user_name']) > 25)
  {
    $errors[] = 'Invalid User Name';
  } else if (
    strlen($_POST['blog_user_password']) <= 8 || strlen($_POST['blog_user_password']) > 25)
  {
    $errors[] = 'Invalid Password';
  } else if (
    strlen($_POST['blog_user_email']) < 4 || strlen($_POST['blog_user_email']) > 254)
  {
    $errors[] = 'Invalid Email';
  } else if (
    !preg_match("/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU", $_POST['blog_user_email']))
  {
    $errors[] = 'Email Invalid';
  } else {
      $blog_user_name = mysql_real_escape_string($_POST['blog_user_name']);
      $blog_user_password = sha1($_POST['blog_user_password']);
      $blog_user_password = mysql_real_escape_string($blog_user_password);
      $blog_user_email =  preg_replace( '((?:\n|\r|\t|%0A|%0D|%08|%09)+)i' , '', $_POST['blog_user_email'] );
      $blog_user_email = mysql_real_escape_string($blog_user_email);

      include 'includes/connection.php';

      if($db){
        $sql = "SELECT blog_user_name, blog_user_email FROM blog_users WHERE blog_user_name = '{$blog_user_name}' OR blog_user_email = '{$blog_user_email}'";
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);
        if($row[0] == $blog_user_name){
          $errors[] = 'User name is already in use';
        } else if (
          $row[1] == $blog_user_email)
        {
          $errors[] = 'Email address already subscribed';
        } else {
          $sql = "INSERT INTO blog_users(blog_user_name, blog_user_password, blog_user_email, blog_user_access_level)
                  VALUES ('{$blog_user_name}', '{$blog_user_password}', '{$blog_user_email}', 1)";
          }
      } else {
        $errors[] = 'Unable to process form';
      }
  }

  if(sizeof($errors) > 0){
    foreach($errors as $err){
      echo $err,'<br />';
    }
  } else {
    echo 'Sign up complete<br />';
    echo 'A verification email has been sent to '.$blog_user_email;
  }

  include 'includes/footer.inc.php';

?>
<?php

  ob_start();
  session_start();

  if(!isset($_SESSION['form_token'])){
    $location = 'login.php';
  } else if(!isset($_POST['form_token'], $_POST['blog_user_name'], $_POST['blog_user_password'])) {
    $location = 'login.php';
  } else if($_SESSION['form_token'] != $_POST['form_token']) {
    $location = 'login.php';
  } else if(strlen($_POST['blog_user_name']) < 2 || strlen($_POST['blog_user_name']) > 25) {
    $location = 'login.php';
  } else if(strlen($_POST['blog_user_password']) < 8 || strlen($_POST['blog_user_password']) > 25) {
    $location = 'login.php';
  } else {
    $blog_user_name = mysql_real_escape_string($_POST['blog_user_name']);
    $blog_user_password = sha1($_POST['blog_user_password']);
    $blog_user_password = mysql_real_escape_string($blog_user_password);

    include 'includes/connection.php';
    if($db) {
      $sql = "SELECT blog_user_name, blog_user_password, blog_user_access_level
              FROM blog_users
              WHERE blog_user_name = '{$blog_user_name}'
              AND blog_user_password = '{$blog_user_password}'
              AND blog_user_status=1";
      $result = mysql_query($sql);
      if(mysql_num_rows($result) != 1) {
        $location = 'login.php';
      } else {
        $row = mysql_fetch_row($result);
        $_SESSION['access_level'] = $row[2];
        unset($_SESSION['form_token']);
        $location = 'index.php';
      }
    }
  }

  header("Location: $location");
  ob_end_flush();

?>
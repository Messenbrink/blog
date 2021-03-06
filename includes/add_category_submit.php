<?php
  
  error_reporting(E_ALL);
  ob_start();

  include 'includes/header.inc.php';

  if(!isset($_SESSION['access_level']) || $_SESSION['access_level'] != 5) {
    header("Location: index.php");
    exit;
  } else {
  
  if(isset($_SESSION['form_token'], $_POST['form_token'], $_POST['blog_category_name']) && preg_match('/^[a-z][a-z\d_ ,]{2,49}$/i', $_POST['blog_category_name']) !== 0) {
    include 'includes/connection.php';

    if($db) {
      $blog_category_name = mysql_real_escape_string($_POST['blog_category_name']);
      $sql = "INSERT INTO blog_categories (blog_category_name) VALUES ('{$blog_category_name}')";

      if(mysql_query($sql)) {
        unset($_SESSION['form_token']);
        echo 'Category Added';
      } else {
        echo 'Category Not Added';
      }
    } else {
      echo 'Unable to process form';
    }
    } else {
      echo 'Invalid Submission';
    }
  }

  ob_end_flush();

?>
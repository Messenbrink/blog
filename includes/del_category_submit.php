<?php

  ob_start();
  include 'includes/header.inc.php';

  if(!isset($_SESSION['access_level']) || $_SESSION['access_level'] != 5) {
    header("Location: index.php");
    exit;
  } else {
    if(isset($_SESSION['form_token'], $_POST['blog_category_id']) && is_numeric($_POST['blog_category_id'])) {
      include 'includes/connection.php';
      if($db){
        $blog_category_id = mysql_real_escape_string($_POST['blog_category_id']);
        $sql = "DELETE FROM blog_categories WHERE blog_category_id = $blog_category_id";
        if(mysql_query($sql)) {
          unset($_SESSION['form_token']);
          $affected = mysql_affected_rows($link);
          echo "$affected Category Deleted";
        } else {
          echo 'Category Not Deleted';
        }
      } else {
        echo 'Unable to process form';
      }
    } else {
      echo 'Invalid Submission';
    }
  }

?>
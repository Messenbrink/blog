<?php
  
  ob_start();
  include 'includes/header.inc.php';

  if(!isset($_SESSION['access_level'], $_SESSION['blog_user_id'])) {
    header("Location: login.php");
    exit;
  } else {
    if(isset($_GET['bid']) && is_numeric($_GET['bid'])) {
      include 'includes/connection.php';

      if($db) {
        $blog_content_id = mysql_real_escape_string($_GET['bid']);
        $sql = "DELETE FROM blog_content WHERE blog_content_id = $blog_content_id";

        if($_SESSION['access_level'] == 1) {
          $blog_user_id = mysql_real_escape_string($_SESSION['blog_user_id']);
          $sql .= " AND blog_user_id = $blog_user_id";
        }
        if(mysql_query($sql)) {
          $affected = mysql_affected_rows($link);
          header("Location: list_blogs.php");
        } else {
          echo 'Blog Entry Not Deleted';
        }
      } else {
        echo 'Unable to process form';
      }
    } else {
      echo 'Invalid Submission';
    }
  }
  
?>
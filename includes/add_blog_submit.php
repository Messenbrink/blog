<?php

  ob_start();
  include 'includes/header.inc.php';

  if(!isset($_SESSION['access_level']) || $_SESSION['access_level'] < 1) {
    header("Location: login.php");
    exit;
  } else {
    if(isset($_SESSION['form_token'], $_POST['blog_category_id'], $_POST['blog_content_headline'], $_POST['blog_content_text'])) {
      if(!is_numeric($_POST['blog_category_id']) || $_POST['blog_category_id']==0) {
        echo 'Blog Category Name is Invalid';
      } else if(!is_string($_POST['blog_content_headline']) || strlen($_POST['blog_content_headline'])<3 || strlen($_POST['blog_content_headline'])>50) {
        echo 'Blog Headline is invalid';
      } else if(!is_string($_POST['blog_content_text']) || strlen($_POST['blog_content_text'])<3 || strlen($_POST['blog_content_text'])>4096) {
        echo 'Blog Text is Invalid';
      } else {    
        include 'includes/connection.php';
        if($db) {
          $blog_user_id = $_SESSION['blog_user_id'];
          $blog_category_id = mysql_real_escape_string($_POST['blog_category_id']);
          $blog_content_headline = mysql_real_escape_string($_POST['blog_content_headline']);
          $blog_content_text = mysql_real_escape_string($_POST['blog_content_text']);
          $sql = "INSERT INTO blog_content( blog_user_id, blog_category_id, blog_content_headline, blog_content_text)
                  VALUES ( '{$blog_user_id}', '{$blog_category_id}', '{$blog_content_headline}', '{$blog_content_text}')";
          
          if(mysql_query($sql)) {
            unset($_SESSION['form_token']);
            echo 'Blog Entry Added';
          } else {
            echo 'Blog Entry Not Added' .mysql_error();
          }
        } else {
          echo 'Unable to process form';
        }
      }
    } else{
      echo 'Invalid Submission';
    }
  }
?>
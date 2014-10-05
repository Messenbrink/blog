<?php

  ob_start();
  include 'includes/header.inc.php';

  if(!isset($_SESSION['access_level'])) {
    header("Location: login.php");
    exit;
  } else {
    include 'includes/connection.php';
    
    if($db) {
      $sql = "SELECT blog_content_id, blog_content_headline FROM blog_content";
      if($_SESSION['access_level'] == 1) {
        $blog_user_id = mysql_real_escape_string($_SESSION['blog_user_id']);
        $sql .= " WHERE blog_user_id = $blog_user_id";
      }

      $result = mysql_query($sql) or die(mysql_error());

      if(is_resource($result)) {
        if(mysql_num_rows($result) != 0) {
          $blog_array = array();
          while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $blog_array[] = $row;
          }
        } else {
          echo 'No Blog Entries Found';
        }
      } else {
        echo 'Blog Unavailable';
      }
    } else {
      echo 'No Blog Entries Available';
    }
  }

?>

<h3>My PHP Blog</h3>
<h4>Click a headline to edit a blog entry</h4>
<table>
  <thead>
    <tr>
      <td>ID</td>
      <td>Headline</td>
      <td>Edit</td>
      <td>Delete</td>
    </tr>
  </thead>
  <tfoot></tfoot>
  <tbody>
    <?php
      foreach($blog_array as $blog) {
        echo '<tr>
        <td>'.$blog['blog_content_id'].'</td>
        <td>'.$blog['blog_content_headline'].'</td>
        <td><a href="edit_blog.php?bid='.$blog['blog_content_id'].'">Edit</a></td>
        <td><a href="delete_blog.php?bid='.$blog['blog_content_id'].'" onclick="return confirm(\'Are you sure?\')">Delete</a></td>
        </tr>';
      }
    ?>
  </tbody>
</table>

<?php include 'includes/footer.inc.php'; ?>
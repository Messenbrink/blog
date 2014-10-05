<?php

  include 'includes/header.inc.php';
  include 'includes/connection.php';

 	if($db) {
    $sql = "SELECT blog_content_headline, blog_content_text, DATE_FORMAT(blog_content_date, '%b %d %Y') AS blog_content_date, blog_category_name, blog_user_name
            FROM blog_content JOIN blog_users USING(blog_user_id) JOIN blog_categories USING(blog_category_id) ORDER BY blog_content_id DESC LIMIT 5";
	  $result = mysql_query($sql) or die(mysql_error());
    $blog_array = array();

    if(is_resource($result)) {
      if(mysql_num_rows($result) != 0) {
        while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
          $blog_array[] = $row;
        }
      }
    } else {
      echo 'Blog Unavailable';
    }
  } else {
    echo 'No Blog Entries Available';
  }

?>

<h1>A Simple Blog build with PHP</h1>

<p>Welcome to the PHP blog</p>

<?php

    if(sizeof($blog_array) > 0) {
	    foreach($blog_array as $blog) {
        echo '<div class="blog_entry">';
        echo '<p><span class="category">'.$blog['blog_category_name'].': </span>
        <span class="blog_date">Added by '.$blog['blog_user_name'].' on '.$blog['blog_content_date'].'</p>';
        echo '<h2>'.$blog['blog_content_headline'].'</h2>';
        echo '<p>'.$blog['blog_content_text'].'</p>';
        echo '</div>';
      }
    } else {
      echo 'No Blogs Here';
    }

    include 'includes/footer.inc.php';
?>
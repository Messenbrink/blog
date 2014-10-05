<?php
  
  error_reporting(E_ALL);
  ob_start();
  include 'includes/header.inc.php';

  if(!isset($_SESSION['access_level']) || $_SESSION['access_level'] != 5) {
    header("Location: index.php");
    exit;
  } else {
    $form_token = uniqid();
    $_SESSION['form_token'] = $form_token;

    include 'includes/connection.php';
    if($db) {
      $sql = "SELECT blog_category_id, blog_category_name FROM blog_categories";
      $result = mysql_query($sql);

      if(!is_resource($result)) {
        echo 'Unable to get category listing';
      } else {
        $categories = array();
        while($row = mysql_fetch_array($result)) {
          $categories[$row['blog_category_id']] = $row['blog_category_name'];
        }
      }
    } else {
      echo 'Database connection failed';
    }
  }
        
?>

<h3>Delete a Category</h3>
<p>
  <?php
      if(sizeof($categories == 0)) {
        echo 'No Categories Available';
      } else {
        echo 'Select a category name for deletion';
      }
  ?>
</p>
<form action="del_category_submit.php" method="post">
  <select name="blog_category_id">
    <?php foreach($categories as $id=>$cat) { echo "<option value=\"$id\">$cat</option>\n"; } ?>
  </select>
  <input type="submit" value="Delete Category" onclick="return confirm('Are you sure?')"/>
</form>

<?php include 'includes/footer.inc.php'; ?>
<h3><?php echo $blog_heading; ?></h3>

<form action="<?php echo $blog_form_action; ?>" method="post">
	<input type="hidden" name="blog_content_id" value="<?php echo isset($blog_content_id) ? $blog_content_id : ''; ?>" />

	<label for="blog_content_headline">Headline</label>
	<input type="text" name="blog_content_headline" value="<?php echo isset($blog_content_headline) ? $blog_content_headline : ''; ?>"/></dd>

	<label for="blog_category_id">Category</label>
	<select name="blog_category_id">
		<?php
		  foreach($categories as $id=>$cat) {
	      echo "<option value=\"$id\"";
	      echo (isset($selected) && $id==$selected) ? ' selected' : '';
	      echo ">$cat</option>\n";
		  }
		?>
	</select>


	<label for="blog_content_text">Blog</dt>
	<textarea name="blog_content_text" rows="5" cols="45"><?php echo isset($blog_content_text) ? $blog_content_text : ''; ?></textarea>

	<input type="submit" value="<?php echo $blog_form_submit_value; ?>" />
</form>
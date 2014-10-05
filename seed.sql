DELIMITER //

CREATE PROCEDURE seed_sample_data
BEGIN
	-- Create default blog categories
	INSERT INTO blog_categories(blog_categorie_name) VALUES (Computer)
	INSERT INTO blog_categories(blog_categorie_name) VALUES (Health)
	INSERT INTO blog_categories(blog_categorie_name) VALUES (Lifestyle)

	-- Create default blog tags
	INSERT INTO blog_tags(blog_tag_name) VALUES (Windows)
	INSERT INTO blog_tags(blog_tag_name) VALUES (Recipes)
	INSERT INTO blog_tags(blog_tag_name) VALUES (Rawfood)
END //

DELIMITER ;
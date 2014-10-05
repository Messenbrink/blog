CREATE VIEW v_categories
AS
SELECT blog_category_name FROM blog_categories
AS Categories

CREATE VIEW v_cat_computer
AS
SELECT blog_category_name FROM blog_categories AS cat
JOIN blog_content AS cont ON cont.blog_category_id = cat.id

CREATE VIEW v_administrators
AS
SELECT blog_user_name FROM blog_users AS user
WHERE blog_user_access_level > 4

CREATE VIEW v_bloggers
AS
SELECT blog_user_name FROM blog_users AS user
WHERE blog_user_access_level <= 2
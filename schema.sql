CREATE TABLE blog_users (
  blog_user_id int(11) NOT NULL auto_increment,
  blog_user_name varchar(20) NOT NULL,
  blog_user_password char(40) NOT NULL,
  blog_user_email varchar(254) NOT NULL,
  blog_user_access_level int(1) NOT NULL default 0,
  PRIMARY KEY (blog_user_id),
  UNIQUE KEY blog_username (blog_user_name)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE blog_categories (
  blog_category_id int(11) NOT NULL AUTO_INCREMENT,
  blog_category_name varchar(50) NOT NULL,
  PRIMARY KEY (blog_category_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE blog_tags (
  blog_tag_id int(11) NOT NULL AUTO_INCREMENT,
  blog_tag_name varchar(50) NOT NULL,
  PRIMARY KEY (blog_tag_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE blog_content (
  blog_content_id int(11) NOT NULL AUTO_INCREMENT,
  blog_tag_id int(11) NOT NULL,
  blog_category_id int(11) NOT NULL,
  blog_user_id int(11) NOT NULL,
  blog_content_headline varchar(50) NOT NULL,
  blog_content_text text NOT NULL,
  blog_content_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  blog_publish int(1) NOT NULL default 0,
  PRIMARY KEY (blog_content_id),
  FOREIGN KEY (blog_user_id) REFERENCES blog_users(blog_user_id) ON DELETE CASCADE,
  FOREIGN KEY (blog_tag_id) REFERENCES blog_tags(blog_tag_id) ON DELETE CASCADE,
  FOREIGN KEY (blog_category_id) REFERENCES blog_categories(blog_category_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
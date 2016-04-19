SET FOREIGN_KEY_CHECKS=0; 
DROP TABLE IF EXISTS 'category'; 
CREATE TABLE 'category' ( 'ID' int(11) NOT NULL AUTO_INCREMENT, 
'category' varchar(255) DEFAULT NULL, 
PRIMARY KEY ('ID') ) 
ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS 'post'; 

CREATE TABLE 'post' ( 'post_ID' int(11) NOT NULL AUTO_INCREMENT, 
'post_title' varchar(255) DEFAULT NULL, 
'post_content' TEXT, 
'category_id' int(11) DEFAULT NULL, 
'date' datetime DEFAULT NULL, 
PRIMARY KEY ('post_ID'), 
KEY 'FK_post_cat' ('category_id'), 
CONSTRAINT 'FK_post_cat' FOREIGN KEY ('category_id') 
REFERENCES 'category' ('ID') ) 
ENGINE=InnoDB DEFAULT CHARSET=latin1;
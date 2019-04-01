<?php
	
require('functions.php');

$table_name = "th26tava_courses";

$sql = "CREATE TABLE $table_name (
	cid   INT(10)     NOT NULL AUTO_INCREMENT, 
	sub   VARCHAR(4)  NOT NULL COMMENT 'Subject Area', 
	num   VARCHAR(3)  NOT NULL COMMENT 'Course Number', 
	title VARCHAR(48) NULL     COMMENT 'Course Title', 
	descr TEXT        NULL     COMMENT 'Course Description', 
	year  INT(4)      NULL     COMMENT 'Year Taken', 
	sem   VARCHAR(6)  NULL     COMMENT 'Semester Taken', 
	uid   VARCHAR(10) NOT NULL COMMENT 'Userid', 
	PRIMARY KEY (cid)
)";
	
create_table($sql, $table_name);	
	
?>
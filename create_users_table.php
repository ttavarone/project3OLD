<?php
	
require('functions_database.php');

$table_name = "th26tava_users";

$sql = "CREATE TABLE $table_name (
	uid   INT(10)     NOT NULL AUTO_INCREMENT,
	email VARCHAR(24) NOT NULL COMMENT 'Email' UNIQUE,
	pwd   VARCHAR(64) NOT NULL COMMENT 'Password', 
	first VARCHAR(24) NOT NULL COMMENT 'First Name', 
	last  VARCHAR(24) NOT NULL COMMENT 'Last Name', 
   school VARCHAR(24) NULL     COMMENT 'College or University',
	major VARCHAR(24) NULL     COMMENT 'Major',
	gyear VARCHAR(4)  NULL     COMMENT 'Graduation year of college',
	bio   TEXT        NULL     COMMENT 'Biography', 
	PRIMARY KEY (uid)
)";
	
create_table($sql, $table_name);	
	
?>
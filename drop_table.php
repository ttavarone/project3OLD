<?php
	
	require('functions.php');
	require('functions_database.php');
	
	$table_name = 'th26tava_users';
	
	$db = db_connect();

	$sql = "DROP TABLE $table_name";
			
	$result = $db->query($sql);
	
	if ($result === TRUE) {
    $content = 'Table '.$table_name.' dropped';
	}
	else {
		$content = 'Error: '.$db->error;
	}
	
	
	make_page('Drop table', $content);
	
?>
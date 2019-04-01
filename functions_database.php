<?php
	
/* -----------------------------------------------------------------------
	Connect to database.  Return mysqli object
----------------------------------------------------------------------- */
function db_connect() {	
	$mysqli = new mysqli("localhost", "breimern_proj3", "Proj32019", "breimern_project3");
	if ($mysqli->connect_errno) {
	   die("Failed to connect to MySQL: ($mysqli->connect_errno) $mysqli->connect_error");
	}
	return $mysqli;	
}


/* ----------------------------------------------------------------------------
	 Run specified query and return result
---------------------------------------------------------------------------- */	
function run_query($sql) {
	$db = db_connect();
	$result = $db->query($sql);
	if (!$result) die('<p><b>Error:</b> '.$db->error.'</p><p><b>SQL:</b><br><pre>'.$sql.'</pre></p>');
	$db->close();
	return $result;		
}


/* ----------------------------------------------------------------------------
	 Runs the specified query and output success or error message as web page
---------------------------------------------------------------------------- */		
function create_table($sql, $table_name) {
	$result = run_query($sql);
	
	if ($result === TRUE) 
      $content = "Table <b>$table_name</b> was created successfully";
	else 
		$content = "Table <b>$table_name</b> was NOT created successfully";
	
	make_basic_page("Table $table_name", $content);		
}



/* -----------------------------------------------------------------------
	 Returns an HTML table from the specified table name
----------------------------------------------------------------------- */	
function show_table($table_name) {
	
	$cols = run_query("SHOW FULL COLUMNS FROM $table_name");
	$rows = run_query("SELECT * FROM $table_name");

	if ($cols) {
		while($col = $cols->fetch_assoc()) {
			$ths .= '<th>'.$col['Field']. '</th>';
		}
	}

	if ($rows) {
		while($row = $rows->fetch_assoc()) {
			$tds .=  '<tr>';
	    foreach($row as $value)
	    		$tds .=  '<td>'.$value.'</td>';
	    $tds .=  '</tr>';
		}
	}
	
	$out = '<h1>Table Data: <code>'.$table_name.'</code></h1>';
	$out .=  '
		<table class="table">
		 <thead>
		   <tr>'.$ths.'<tr>
		 </thead>
		 <tbody>
		 	'.$tds.'
		 </tbody>
		</table>';		

	return $out;
}


/* -----------------------------------------------------------------------
	 Returns all the column information from the specified table name
----------------------------------------------------------------------- */	
function show_table_columns($table_name) {
	$cols = run_query("SHOW FULL COLUMNS FROM $table_name");

	$out = '<h1>Column Info: <code>'.$table_name.'</code></h1>';
	$x = 0;
	while($col = $cols->fetch_assoc()) {
		$out .= '
			<h4>Field '.++$x.'</h4>
			<ul>';
			foreach ($col as $key=>$value) 
				$out .=  '
					<li><b>'.$key.':</b> '.$value.'</li>';
		$out .=  '	
			</ul>';
	}
	return $out;	
}


?>
<?php

require('functions.php');
require('functions_database.php');

$content = '<form method="post" action="create_table.php">
				<div class="row">
				  <div class="form-group col-md-8">
				    <label for="tableName">Table name</label>
				    <input type="text" class="form-control" id="tableName" aria-describedby="tableNameHelp" placeholder="Table name" name="tableName">
				    <small id="tableNameHelp" class="form-text text-muted">Enter a descriptive table name that is less than 20 characters</small>
				  </div>
				  <div class="form-group col-md-4">
				    <label for="colAmt">How many columns?</label>
				    <input type="number" class="form-control" id="colAmt" name="colAmt">
				  </div>
				</div>
				  <button type="submit" class="btn btn-primary">Submit table information</button>
			</form>';


make_page('Create Table', $content);

$table_name = $_POST['tableName'];
$table_column_amt = $_POST['colAmt'];

$content = '<form method="post" action="create_table.php>';

for ($x = 0; $x < $table_column_amt; $x++){
	$content .= '
		<div class="row">
			<div class="form-group col-md-3">
		 		<label for="colName'.$x.'">Column '.$x.'</label>
				<input type="text" class="form-control" id="colName" placeholder="Column name" name="colName">
			</div>
			<div class="form-group col-md-3">
				<input type="number" class="form-control" id="amtChar" placeholder="Amount of characters" name="amtChar">
			</div>
			<div class="form-group col-md-3">
				<select id="nullState" class="form-control">
			        <option selected>NULL</option>
			        <option>NOT NULL</option>
			    </select>
			</div>
			<div class="form-group col-md-3">
				<input type="text" class="form-control" id="comment" placeholder="Comment on field" name="comment">
			</div>
		</div>
	';
}
$content .= '
		<button type="submit" class="btn btn-primary">Create Table</button>
	</form>
';

make_page('Create table', $content)

?>
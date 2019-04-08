<?php

  require('functions.php');
  require('functions_database.php');

  $table_name = 'th26tava_users';

  $table = '<table class="table">
  <tr>
  <th>uid</th>
  <th>email</th>
  <th>first</th>
  <th>last</th>
  <th>school</th>
  <th>major</th>
  <th>gyear</th>
  <th>bio</th>
  </tr>';

  //$table_name = $_GET['table_name'];

  $db = db_connect();

  $sql = "SHOW COLUMNS FROM $table_name";

  $output = $db->query($sql);

  $table .= '<tr>';
  while($column = $output->fetch_array()) {
    $table .= '<td><b>'.column['Field'].'</b>, ';
    $table .= $column['Type'].'</td>';
  }
  $table .= '</tr></table>';
  

  make_page($table_name, $table);

?>
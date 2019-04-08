<?php

require('functions.php');
require('functions_database.php');

$table_options = array(
	'Create New Table' => 'create_table.php', // in progress 4/8
	'Drop Table' => 'drop_table.php', // in progress 4/8
	'Show Table' => 'show_table.php',
);
$user_options = array(
	'Add User' => 'add_user.php',
	'Edit User' => 'edit_user.php',
	'Show User' => 'show_user.php',
	'Create New User Table' => 'create_users_table.php',
);
$course_options = array(
	'Add Course' => 'add_course.php',
	'Edit Course Table' => 'edit_course_table.php',
	'Delete Single Course' => 'delete_course.php',
	'Create New Table' => 'create_courses_table.php',
);

//  for table options array
$content = '<div class="row"><div class="col"><h2>Table Options</h2><nav class="nav"><div class="list-group">';
foreach ($table_options as $option => $value) {
	$content .= '<a href="'.$value.'" class="list-group-item list-group-item-action">'.$option.'</a>';
}
$content .= '</div></nav></div>';

//  for user options array
$content .= '<div class="col"><h2>User Options</h2><nav class="nav"><div class="list-group">';
foreach ($user_options as $option => $value) {
	$content .= '<a href="'.$value.'" class="list-group-item list-group-item-action">'.$option.'</a>';
}
$content .= '</div></nav></div>';

//  for course table options array
$content .= '<div class="col"><h2>Course Table Options</h2><nav class="nav"><div class="list-group">';
foreach ($course_options as $option => $value) {
	$content .= '<a href="'.$value.'" class="list-group-item list-group-item-action">'.$option.'</a>';
}
$content .= '</div></nav></div></div>';

function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
}

$style = '.list-group {
	  margin: auto;
	  width: 25%;
	  padding: 1%;
	  border: 1px solid black;
	  border-radius: 2px;
	  }';

make_page('Admin', $content);

?>
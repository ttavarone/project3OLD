<?php

require('functions.php');

$page_name = 'Profile';
$uid = $_GET['uid'];

$result = run_query("SELECT * FROM th26tava_users WHERE uid='uid'");
  
$user_data = $result->fetch_assoc();

$content = make_card("Biography", $user_data['bio']);

make_basic_page($page_name, $content);

?>
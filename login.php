<?php
	
require('functions.php');

$this_script = basename(__FILE__);
$page_name = 'Login';
$link_to = 'user_profile.php';

// The content should be a login form
$content = '
<form method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="uid" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="pwd" id="exampleInputPassword1" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
</form>
';

// Here you can add embedded CSS for the login form
$style = 'form {
  margin: auto;
  width: 25%;
  padding: 1%;
  border: 1px solid black;
  border-radius: 2px;
  }';


// Process the form if any data was posted
if ($_POST) {
  $submitted_email = $_POST['uid'];
  // Here we have to fetch the stored password and uid
  $result = run_query("SELECT uid, pwd FROM th26tava_users WHERE email='$submitted_email'");
  $row = $result->fetch_assoc();
  $stored_pwd = $row['pwd'];
  $stored_uid = $row['uid'];
  
  $submitted_uid = $_POST['uid'];
  $submitted_pwd = $_POST['pwd'];
	// Check to see if a password was submitted and if if matches the stored password
	if ($submitted_pwd && $submitted_pwd == $stored_pwd) {
		session_start();
		$_SESSION['uid'] = $stored_uid;
//		redirect
		$content = '<p><a class="btn btn-primary" href="'.$link_to.'">Go to User Profile</a></p>';
	}
}

make_basic_page($page_name, $content, $style);

?>
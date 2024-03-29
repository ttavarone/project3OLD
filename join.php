<?php
	require('functions.php');

	$this_script = basename(__FILE__);
	$page_name = 'Join';
	$link_to = 'user_profile.php';
	$form_content = '<form method="post">';

	$text_fields = array(
		'fname' => 'First name',
		'lname' => 'Last name',
		'email' => 'Email',
		'school' => 'School',
		'major' => 'Major',
		'gyear' => 'Graduation Year',
		'bio' => 'Biography',
		'pwd' => 'Password',
		'repwd' => 'Re-type password'
	);

	$type = 'text';
	foreach($text_fields as $name => $label){
		
		if($name == 'pwd' || $name == 'repwd'){
			$type = 'password';
		}

		$form_content .= '<div class="form-row"><div class="form-group col-md-6">
			    <label for="'.$name.'">'.$label.'</label>
			    <input type="'.$type.'" class="form-control" name="'.$name.'" id="'.$name.'" aria-describedby="emailHelp">
			</div></div>';
	};
	$form_content .= '<input type="submit" class="btn btn-primary"></form>';

	$style = '.form-group {
	  margin: auto;
	  width: 25%;
	  padding: 1%;
	  border: 1px solid black;
	  border-radius: 2px;
	  }';

	make_page ($page_name, $form_content, $style);

	if ($_POST) {
		$submitted_fname = $_POST['fname'];
		$submitted_lname = $_POST['lname'];
	  	$submitted_email = $_POST['email'];
	  	$submitted_school = $_POST['school'];
	  	$submitted_major = $_POST['major'];
	  	$submitted_gyear = $_POST['gyear'];
	  	$submitted_bio = $_POST['bio'];
	  	$submitted_pwd = $_POST['pwd'];
	  	$submitted_repwd = $_POST['repwd'];

		if ($submitted_pwd == $submitted_repwd) {
			//add user to database
			$sql = "INSERT INTO $th26tava_users  (`uid`, `email`, `pwd`, `first`, `last`, `school`, `major`, `gyear`, `bio`) VALUES
			(1, ".$submitted_email.", ".$submitted_pwd.", ".$submitted_fname.", ".$submitted_lname.", ".$submitted_school.", ".$submitted_major.", ".$submitted_gyear.", ".$submitted_bio.")";
			session_start();
			$_SESSION['uid'] = $stored_uid;
	//		redirect
			//$content = '<p><a class="btn btn-primary" href="'.$link_to.'">Go to User Profile</a></p>';
		}
		
	}

?>
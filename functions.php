<?php
/* --------------------------
  Error checking
  ---------------------------*/

ini_set('display_errors', 'On');

/* -----------------------------------------------------------------------
   Global variables
----------------------------------------------------------------------- */
  
$author = 'Tucker Tavarone';

$pages = array ('index.php' => 'Home',
                'resume.php' => 'Resume',
                'courses.php' => 'Courses',
                'projects.php' => 'Projects');

$default_pages = array( 
  'login.php' => 'Login',
  'insert_user.php' => 'Join',
  'show_users.php' => 'Users');
                
$user_pages = array(  
  'user_profile.php' => 'Profile',
  'update_user.php' => 'Edit',
  'manage_courses.php' => 'Manage Courses',
  'insert_course.php' => 'Insert Course',
  'logout.php' => 'Logout');                
                
$admin_pages = array( 
  'manage_users.php' => 'Manage users',
  'manage_courses.php' => 'Manage courses',
  'show_table_data.php?table_name=users' => 'Show users',
  'show_table_data.php?table_name=courses' => 'Show courses',
  'show_table_columns.php?table_name=users' => 'Columns users',
  'show_table_columns.php?table_name=courses' => 'Columns courses',
  'logout.php' => 'Logout');

$proj_cards = array ('ttr.txt' => 'Ticket To Ride',
                     'lm.txt' => 'Lazer Maze',
                     'thisproj.txt' => 'This Project');

/* -----------------------------------------------------------------------
   Select menu
----------------------------------------------------------------------- */
function select_menu() {
  global $default_pages;
  global $user_pages;
  global $admin_pages;    
  
  session_start();
  if ($_SESSION['admin'])
    $pages = $admin_pages;
  elseif ($_SESSION['uid']) 
    $pages = $user_pages;
  else
    $pages = $default_pages;
    
  return $pages;
}

/* -----------------------------------------------------------------------
   Make top of the page
----------------------------------------------------------------------- */

function make_top($page_name, $ext_fonts = null, $style = null) {
  global $author;

  if ($style != null) {
    $style = '<style>'.file_get_contents($style).'</style>';
  }

  if ($ext_fonts != null) {
    $ext_fonts = file_get_contents(__DIR__ . '/assets/googleFonts');
  }

  return '
    <!DOCTYPE html>
    <html lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
    '.$ext_fonts.'
    <head>
      <title>'.$author.' | '.$page_name.'</title>
      <style type="text/css">
        '.$style.'
      </style>
    </head>
    <body>';
}

/* -----------------------------------------------------------------------
   Make bottom of the page
----------------------------------------------------------------------- */

function make_bottom($javascript = null) {
  return '
      <!-- javascript -->
      <style>'.$javascript.'</style>
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
    </body>
    </html>
  ';
}

/* -----------------------------------------------------------------------
   Makes a basic webpage, using $page_name and $page_content to get the
   page name and then any custom content for that webpage
----------------------------------------------------------------------- */

function make_page($page_name, $page_content, $add_content = null) {

  global $pages;
  global $author;
  global $proj_cards;
  $cards = null;

  if ($page_name == 'Courses') {
    $courses = make_courses();
  }
  else {
    $courses = null;
  }
  
  if ($add_content || ($page_name == 'Projects')) {      
    if($page_name == 'Projects') {
      foreach ($proj_cards as $proj_file => $proj_name) {
        if($proj_name == 'This Project') {
          $cards .= make_card($proj_name, file_get_contents(__DIR__ . '/assets/'.$proj_file.''), 'https://github.com/ttavarone', False, 'Github' );
        }
        else {
          $cards .= make_card($proj_name, file_get_contents(__DIR__ . '/assets/'.$proj_file.''), '/assets/'.$proj_file.'.zip', True, 'Download' );
        }
      }
    }
  }

  echo make_top($author, $page_name);
  echo make_navbar();
  
  
  echo '<main class="container">';
  echo file_get_contents($page_content);
  echo $cards;
  echo $courses;
  echo '</main>';

  echo make_footer();
  echo make_bottom();
}

/* -----------------------------------------------------------------------
   Makes the navigation bar at the top of all pages
----------------------------------------------------------------------- */

function make_navbar() {
  global $pages;
  
  $menu_item = '';
  
  foreach ($pages as $link => $name) {
    $menu_item .= '<a class="nav-link active" href="'.$link.'" style="color: #edf5e1">'.$name.'</a>';
  }
  
  return '
        <header style="background-color: #05386b">
          <!-- website navbar -->
          <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #05386b">
            <a class="navbar-brand" href="index.html" style="color: #edf5e1">Tucker Tavarone</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainnav" 
                          aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon" style="background-color: #05386b"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainnav">
              <div class="navbar-nav justify-content-end" >
                '.$menu_item.'
              </div>
            </div>
          </nav>
        </header>';
  }

  /* -----------------------------------------------------------------------
   Makes the footer on the bottom of all pages
----------------------------------------------------------------------- */

  function make_footer() {
    global $pages;
    global $author;

    $menu_item = '';

    foreach ( $pages as $link => $name) {
      $menu_item .= '<a href="'.$link.'" style="color: #05386b">'.$name.'</a>';
    }

    return '
    <footer>
      &copy; 2019 '.$author.'
        <nav>
          '.$menu_item.'
        </nav>
    </footer>';
  }

  /* -----------------------------------------------------------------------
   Makes the courses page, will be removed eventually for database 
   implementation
----------------------------------------------------------------------- */

  function make_courses() {

    $file = file('courses.csv');

    foreach ($file as $line) {
      
      $arr = explode(',', $line);      
      /* This creates an array called record
        Where the course title is the array index
        $arr[0] is the year
        $arr[1] is the semester
        $arr[2] is the course number, i.e., CSIS-110 */
        
      $record[$arr[2]] = array($arr[1], $arr[0]);
    }

    ksort($record);

    $course_table = '<table>';
      foreach ($record as $id => $details) {
      $course_table .= '<tr><th>'.$id.'</th>';
          foreach ($details as $value) {
            $course_table .= '<td>'.$value.'</td>';
          }
        $course_table .= '</tr>';
      }  
    $course_table .= '</table>';

    return $course_table;
  }

  /* -----------------------------------------------------------------------
   Makes bootstrap cards
----------------------------------------------------------------------- */

  function make_card($project_name, $content, $link = null, $downloadable = null, $link_name = null){
    if($downloadable){
      return '
        <div class="row"
          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">'.$project_name.'</h5>
                <p class="card-text">
                  '.$content.'
                </p>
                <a class="btn btn-primary btn-lg active" role="button" aria-pressed="true" href="'.$link.'" style="margin-left: 2%; background-color: #05386b; font-size: 100%;" download>Download</a>
              </div>
            </div>
          </div>
        </div>
        ';
    }
    else {
      return '
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">'.$project_name.'</h5>
                <p class="card-text">
                  '.$content.'
                </p>
                <a class="btn btn-primary btn-lg active" role="button" aria-pressed="true" href="'.$link.'" style="margin-left: 2%; background-color: #05386b; font-size: 100%;">'.$link_name.'</a>
              </div>
            </div>
          </div>
        ';
    }
  }
?>
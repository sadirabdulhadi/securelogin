<?php 
require ('../controller/HeaderController.php');

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    header('Location:../view/login.php');
}
$_SESSION['LAST_ACTIVITY'] = time();

$username = $_SESSION['username'];

if(isset($_SESSION['IPaddress']) && isset($_SESSION['userAgent']))
{
  if ($_SESSION['IPaddress'] != $_SERVER['REMOTE_ADDR'] || $_SESSION['userAgent'] != $_SERVER['HTTP_USER_AGENT'])
  {
    echo '<script>window.location = "invalid.php";</script>';
    die();
  }
}
 ?>

<head>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<style>
.button {
  float: right;
  vertical-align: middle;
}
</style>

<nav class="navbar navbar-inverse">
  <div class="container-fluid" style="font-family: 'Quicksand', sans-serif;">
    <div class="navbar-header">
     
      <a class="navbar-brand" href="#">Secure</a>
    </div>
    <ul class="nav navbar-nav">
    <li>
      <a class="navbar-brand" href="homepage.php">Home</a>
    </li>
    <li>
      <a class="navbar-brand" href="externalProfile.php">Profile</a>
    </li>
    
    <?php if ($status!=1) { ?>
    <li>
      <a class="navbar-brand" href="newsnippet.php">New Snippet</a>
    </li>
    <?php } ?>
    <li>
      <a class="navbar-brand" href="mysnippets.php">My Snippets</a>
    </li>
    <li>
      <a class="navbar-brand" href="myfiles.php">My Files</a>
    </li>
    <li>
    <form action="../controller/HeaderController.php" method="POST">
		<input class="button" type="submit" name="action" id="btn" value="logout" />
	</form>
</li>
</ul>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      
    </div>
  </div>
</nav>
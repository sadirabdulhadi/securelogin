<?php require ('../controller/ProfileController.php'); 

	if (isset($_GET['username'])){
		if($_GET['username']!=$_SESSION['username'])
		{
			if (!isset($_SESSION['status']) || $_SESSION['status']!=2)
			{
				echo '<script>window.location = "invalid.php";</script>';
				die();
			}
			$username = $_GET['username'];
			if (!$model->exists("users", "username = '$username'"))
			{
				echo '<script>window.location = "invalid.php";</script>';
				die();
			}
		}
		
		//echo "heyyy";
		$username = ($_GET['username']);
		$row = $model->getProfile($username);
		$password = "";
		$icon_url = $row['icon_url'];
		$homepage_url = $row['homepage_url'];
		$profile_color = $row['profile_color'];
		$private_snippet = $row['private_snippet'];
	}
	
	if (function_exists('mcrypt_create_iv')) {
    $_SESSION['token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
	} else {
	    $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
	}
	$token = $_SESSION['token'];
	
?>


<!DOCTYPE html>
<html>
<head>
	<title>Profile Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="css/bootstr4p.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<script> 
	$(function(){
	  $("#headerIn").load("headerIn.php"); 
      $("#headerOut").load("headerOut.html"); 
	  $("#footer").load("footer.html"); 
	});
	</script> 
</head>
<body>
	<?php 
if (isset($_SESSION['username'])) { ?> 
	<div id="headerIn"></div> <?php
	} else { ?>
	    
	    <div id="headerOut"></div> <?php
	} 
	?>

<div class="container"style="font-family: 'Quicksand', sans-serif;">
    <div class="span3 well" style="padding-left: 70px; padding-right:70px"  >
        <h1> Edit Details</h1><br>
	<div id="frm">
		<!-- <form action="../controller/ProfileController.php" method="POST">
			<p>
				<input type="submit" name="action" id="btn" value="logout" />
			</p>
		</form> -->
		<form action="../controller/ProfileController.php" method="POST">
			<input type="hidden" name="token" value="<?= $token ?>"/>
			<input type="hidden" name="newusername" value="<?= $username ?>"/>
			<h3>Username:</h3>
			<div class="row">
	            <div class="col-md-10">
	            	<input type="text" id="user" name="username" value="<?= $username ?>" />
	            	<br>
	            </div>
            
         	 </div>
				
			<h3>Password:</h3>
			<div class="row">
				<div class="col-md-10">
	            	<input type="text" id="pw" name="password" />
	            	<br>
	            </div>
        	</div>
				
			<h3>Icon_url:</h3>
			<div class="row">
				<div class="col-md-10">
	            	<input type="text" id="icon" name="iconurl" value="<?= $icon_url ?>" />
	            	<br>
	            </div>
        	</div>
				
			<h3>Homepage URL:</h3>
			<div class="row">
				<div class="col-md-10">
	            	<input type="text" id="homepage" name="homepageurl" value="<?= $homepage_url ?>" />
	            	<br>
	            </div>
        	</div>

			<h3>Profile Color:</h3>
			<div class="row">
				<div class="col-md-10">
	            	<input type="text" id="color" name="profilecolor" value="<?= $profile_color ?>" />
	            	<br>
	            </div>
        	</div>
			
			<h3>Private Snippet:</h3>
			<div class="row">
				<div class="col-md-10">
	            	<input type="text" id="snippet" name="privatesnippet" value="<?= $private_snippet ?>" />
	            	<br>
	            </div>
        	</div>

        	<br>
			<div class="col-md-2">
			<input class="btn btn-primary" type="submit" name="action" id="btn" value="submit" />
			</div>
			<br>
			<br>
		</form>
	</div>
</div>
		<div id="footer"></div>
</body>
<?php session_start(); 
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
	<title>Upload a file</title>
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
    <div class="span3 well" style="padding-left: 70px;padding-right: 70px">
	<div id="frm">
		<form action="../controller/upload.php" method="post" enctype="multipart/form-data">
		    <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>     Select file to upload:
		    <br><br>
		    <input type="file" name="fileToUpload" id="fileToUpload">
		    <br>
		    <input class="btn btn-success" type="submit" value="Upload File" name="submit">
		</form>
	</div>
</div>
</div>
</body>
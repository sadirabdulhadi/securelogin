<?php require ('../controller/MySnippetsController.php');
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
	<title>Signup Page</title>
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
<style>
.button {
	float: right;
	vertical-align: middle;
}
</style>
<body>
	<?php 
if (isset($_SESSION['username'])) { ?> 
	<div id="headerIn"></div> <?php
	} else { ?>
	    
	    <div id="headerOut"></div> <?php
	} 
	?>

	<div class="container" style="font-family: 'Quicksand', sans-serif;">

    <div class="well" style="padding-left: 70px; padding-right:70px">
	<p>Here is a list of all posts:</p>
		
	<form action="../controller/MySnippetsController.php" method="POST">
		<input type="hidden" name="token" value="<?= $token ?>"/>
		<?php foreach($snippets as $snippet) { ?>
		<div class="alert alert-dismissible alert-info">
	<?php echo htmlspecialchars($snippet['content']); ?>
	<button class="btn btn-danger button" type="submit" name="delete" value="<?= $snippet['id'] ?>" style="color:white">&times; Delete</button>
		</div>
		<?php } ?>

		</form>
	</div>
</div>
	<div id="footer"></div>
</body>
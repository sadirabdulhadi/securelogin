<!DOCTYPE html>
<html>
<head>
	<title>Invalid Request</title>
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
.Row
{
    display: table;
    width: 100%; /*Optional*/
    table-layout: fixed; /*Optional*/
    border-spacing: 10px; /*Optional*/
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
<div class="container"style="font-family: 'Quicksand', sans-serif;">
<div class="span3 well" style="padding-left: 70px;padding-right: 70px">
	<h1> Invalid Request </h1><br>
</div>
</div>

	<div id="footer"></div>
</body>
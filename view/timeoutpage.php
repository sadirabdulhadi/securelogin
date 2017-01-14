<!DOCTYPE html>
<html>
<head>
	<title>Timeout Page</title>
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
  // $("#headerIn").load("headerIn.php"); 
  $("#headerOut").load("headerOut.html");
  $("#footer").load("footer.html"); 
});
</script> 
</head>
<body>
	    
	    <div id="headerOut"></div>

<div class="container"style="font-family: 'Quicksand', sans-serif;">
    <div class="span3 well" style="padding-left: 70px;padding-right: 70px">
    <center><h1>You are banned from logging in for 10 minutes. Try again later</h1></center>
    </div>
  </div>

  

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

	<div id="footer"></div>
</body>
</html>
<?php require ('../model/FileUploadModel.php');
$model = new UploadFileModel();
session_start();
$files = $model->get_files($_SESSION['username']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Files Page</title>
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

	<div class="container" style="font-family: 'Quicksand', sans-serif;">

    <div class="well" style="padding-left: 70px; padding-right:70px">
	
	<button class="btn btn-primary" type="submit"><a href="uploadFile.php" style="color:white"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload File</a></button>
	<br><br>
	<h3><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>   Here is a list of your files:</h3>
		
	<form action="../controller/MySnippetsController.php" method="POST">

		<?php foreach($files as $file) { ?>
		
		<div class="alert alert-dismissible alert-info">
			<a href="<?= $file['url'] ?>">$file['filepath']</a>
	<!-- <button class="btn btn-primary" type="button" class="close" data-dismiss="alert">&times;</button> -->
	<?php echo $snippet['content']; ?>
		<!-- <button class="btn btn-primary close" type="submit" name="delete" value="<?= $snippet['id'] ?>">&times; Delete</button> -->
		</div>
		<?php } ?>

		</form>
	</div>
</div>
	<div id="footer"></div>
</body>
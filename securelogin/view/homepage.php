<?php require ('../controller/HomepageController.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
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
    float: right;
}
.buttons {
	display:inline-block;
   margin-right:5px;
}
.panel-heading{
	padding-left: 100px;
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
	<h1> Recent Snippets From All Users </h1><br>
	<?php if(!isset($_SESSION['status']) || $_SESSION['status']!=2) { ?>

		<?php foreach($snippets as $snippet) { ?>
		<?php 
			$url2 = "externalProfile.php?userid=" . $snippet['user_id']; ?>
		<div class="panel panel-info">
      <div class="panel-heading">
		  <a href= "<?= $url2 ?>"><?php echo $model2->getUsername($snippet['user_id']); ?></a>
		</div>
		<div class="panel-body">
		  <?php echo htmlspecialchars($snippet['content']); ?>
	    </div>
	</div>
		<?php } ?>

	<?php } ?>

	<?php if(isset($_SESSION['status']) && $_SESSION['status']==2) { ?>
	
		<?php foreach($snippets as $snippet) { ?>
			<?php 
			$url2 = "externalProfile.php?userid=" . $snippet['user_id']; ?>
		  	<div class="panel panel-info">
      			<div class="panel-heading">
      				<div class="row">
      					<div class="col-md-8">
      			<a href= "<?= $url2 ?>"><?php echo $model2->getUsername($snippet['user_id']); ?></a>
      		</div>
      			<div class="Row col-md-2">
      			<form action="../controller/HomepageController.php" method="POST">
			  	<?php if($model2->getStatus($snippet['user_id'])==0) { ?>
			  	<button class="btn btn-primary" type="submit" name="update_status" id="btn" value="<?= $snippet['user_id'] ?>"><span class="glyphicon glyphicon-edit"></span> Allowed</button>
			  	<?php } else if($model2->getStatus($snippet['user_id'])==1) { ?>
			  	<button class="btn btn-primary" type="submit" name="update_status" id="btn" value="<?= $snippet['user_id'] ?>"><span class="glyphicon glyphicon-edit"></span> Not Allowed</button>
			  	<?php } else { ?>
			  	<button type="button" disabled>Admin</button>
			  	<?php } ?>
			  	</form>
			  </div>
			  	<div class="Row col-md-2">
			  	<form action="../controller/MakeAdminController.php" method="POST">
			  	<?php if($model2->getStatus($snippet['user_id'])==2) { ?>
			  	<button type="button" disabled>Admin</button>
			  	<?php } else { ?>
			  	<button class="btn btn-primary" type="submit" name="update_status" id="btn" value="<?= $snippet['user_id'] ?>"><span class="glyphicon glyphicon-user"></span> Not Admin</button>
			  	<?php } ?>
			  	</form>
      			</div>
      		</div>
      		</div>
      			<div class="panel-body">
		 		<?php echo htmlspecialchars($snippet['content']); ?>
		 		</div>
		 	</div>
	    <?php } ?>
	<?php } ?>
</div>
</div>

	<div id="footer"></div>
</body>
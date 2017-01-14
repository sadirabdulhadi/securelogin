<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
	session_start();
	
	require ('../model/UserModel.php');
	$model2 = new UserModel();

	if($_POST){
		
		$chosen_id = $_POST['update_status'];
		$status = $model2->getStatus($chosen_id);
		$new_status = 2;
		$model2->update("users", "status = '$new_status'", "id = '$chosen_id'");
		
		header('Location:../view/homepage.php');
	}

	// $result = mysqli_query($con, "select * from snippets where username='$username' order by snippets.time_created");
	
?>
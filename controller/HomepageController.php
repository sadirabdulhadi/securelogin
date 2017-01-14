<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
	session_start();
	require ('../model/SnippetModel.php');

	$model = new SnippetModel();
	require ('../model/UserModel.php');
	$model2 = new UserModel();
	$snippets = $model->show_all_snippets();

	if($_POST){
		
		$chosen_id = $_POST['update_status'];
		$status = $model2->getStatus($chosen_id);
		if($status==0)
		{
			$new_status = 1;
			$model2->update("users", "status = '$new_status'", "id = '$chosen_id'");
		}
		else
		{
			$new_status = 0;
			$model2->update("users", "status = '$new_status'", "id = '$chosen_id'");
		}
		header('Location:../view/homepage.php');
	}

	// $result = mysqli_query($con, "select * from snippets where username='$username' order by snippets.time_created");
	
?>
<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
	session_start();
	if(!isset($_SESSION['userid']))
	{
		header('Location:../view/homepage.php');
	}
	require ('../model/SnippetModel.php');
	$username = $_SESSION['username'];
	$userid = $_SESSION['userid'];
	$model = new SnippetModel();
	require ('../model/UserModel.php');
	$model2 = new UserModel();
	$snippets = $model->show_my_snippets($userid);

	if($_POST){
		if (hash_equals($_SESSION['token'], $_POST['token'])) {
			$snippetid = $_POST['delete'];
			$model->delete_snippet($userid, $snippetid);
			header('Location:../view/mysnippets.php');
		}
		else {
	    	$_SESSION['error'] = "Error occured during form submission!";
			header('Location:../view/mysnippets.php');
	    }
	}
	// $result = mysqli_query($con, "select * from snippets where username='$username' order by snippets.time_created");
	
?>
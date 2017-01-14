<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
	session_start();
	if(isset($_SESSION['username'])) $username = $_SESSION['username'];
	if(isset($_SESSION['userid'])) $userid = $_SESSION['userid'];
	if(isset($_SESSION['status'])) $status = $_SESSION['status'];
	require ('../model/UserModel.php');
	$model = new UserModel();
	require ('../model/SnippetModel.php');
	$model3 = new SnippetModel();
	// $snippets = $model->show_my_snippets($userid);

	
?>
<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
	session_start();
	require ('../model/UserModel.php');
	$model = new UserModel();
	$username = $_SESSION['username'];
	$status = $_SESSION['status'];

	if($_POST){
		if($_POST['action']=='logout')
		{
			$model->logout();
			header('Location:../view/homepage.php');
		}
	}
?>
<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
	session_start();
	if(!isset($_SESSION['userid']))
	{
		header('Location:../view/homepage.php');
	}
	require ('../model/UserModel.php');
	$model = new UserModel();
	$username = $_SESSION['username'];
	// $result = mysqli_query($con, "select * from profiles where username = '$username'");
	// $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$row = $model->getProfile($username);
	// $password = $row['password'];
	$icon_url = $row['icon_url'];
	$homepage_url = $row['homepage_url'];
	$profile_color = $row['profile_color'];
	$private_snippet = $row['private_snippet'];

	if($_POST){
		if (hash_equals($_SESSION['token'], $_POST['token'])) {
			if($_POST['action']=='logout')
			{
				$model->logout();
				header('Location:../view/homepage.php');
			}
			else if($_POST['action']=='submit')
			{
				$to_use = $_POST['newusername'];
				$new_username = $_POST['username'];
				$password = $_POST['password'];
				$icon_url = $_POST['iconurl'];
				$homepage_url = $_POST['homepageurl'];
				$profile_color = $_POST['profilecolor'];
				$private_snippet = $_POST['privatesnippet'];
				$model->updateProfile($to_use, $new_username, $password, $icon_url, $homepage_url, $profile_color, $private_snippet);
				if ($to_use === $username)
				{
					$username = $new_username;
					$_SESSION['username'] = $username;
					header('Location:../view/profile.php');
				}
				else
				{
					$str = "Location:../view/profile.php?username=" . $new_username;
					header($str);
				}
				// $row = $model->getProfile($username);
				// $password = $row['password'];
				// $icon_url = $row['icon_url'];
				// $homepage_url = $row['homepage_url'];
				// $profile_color = $row['profile_color'];
				// $private_snippet = $row['private_snippet'];
			}
		}
		else {
	    	$_SESSION['error'] = "Error occured during form submission!";
			header('Location:../view/profile.php');
	    }
		
	}
?>
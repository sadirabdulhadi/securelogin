<?php session_start();
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
	require ('../model/UserModel.php');
	$model = new UserModel();
	$ip = $_SERVER["REMOTE_ADDR"];
	$attempt_count = $model->check_attempts($ip);

	

	
	if($_POST){
		include_once $_SERVER['DOCUMENT_ROOT'] . '/securelogin/securimage/securimage.php';
	$securimage = new Securimage();
		if ($securimage->check($_POST['captcha_code']) == false) {
  // the code was incorrect
  // you should handle the error so that the form processor doesn't continue

  // or you can use the following code if there is no validation or you do not know how
  // echo "The security code entered was incorrect.<br /><br />";
  // echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
			$_SESSION['error'] = "The security code you entered was invalid";
			header('Location:../view/login.php');
  exit;
}

		$model->delete_attempts();
		
		$attempt_count = $model->check_attempts($ip);

		if ($attempt_count>3)
		{
			header('Location:../view/timeoutpage.php');
			die();
		}

	if (!empty($_POST['token'])) {
	    if (hash_equals($_SESSION['token'], $_POST['token'])) {
	        
			$username = $_POST['username'];
			$password = $_POST['password'];

			$id = $model->authenticate($username, $password);
			if($id!=-1)
			{
				session_regenerate_id(true);
				// session_start();
				$_SESSION['userid'] = $id;
				$_SESSION['username'] = $username;
				$_SESSION['status'] = $model->getStatus($id);
				$_SESSION['IPaddress'] = $_SERVER['REMOTE_ADDR'];
         		$_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
				header('Location:../view/profile.php');
			}
			else
			{
				
				$count_attempts = $model->addAndCheck($ip);
				if ($count_attempts>3)
				{
					header('Location:../view/timeoutpage.php');
				}
				$_SESSION['error'] = "Invalid username or password";
				header('Location:../view/login.php');
			}
	    } else {
	    	$_SESSION['error'] = "Error occured during form submission!";
			header('Location:../view/login.php');
	    }
	}
		
		
		

	}

?>
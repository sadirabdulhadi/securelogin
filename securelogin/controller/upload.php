<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();
$username = $_SESSION['username'];
if (file_exists("../resources1/uploads/" . $username) == 0){
    mkdir("../resources1/uploads/" . $username);
}
$target_dir = "../resources1/uploads/". $username ."/";
$new_Filename =  str_replace(' ', '',basename($_FILES["fileToUpload"]["name"]));
$target_file = $target_dir . $new_Filename;
// echo "****";
// echo $target_file;
// echo "****";
$uploadOk = 1;
$fileType = pathinfo($target_file,PATHINFO_EXTENSION);

// echo $fileType;

// Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//     if($check !== false) {
//         echo "File is an image - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "File is not an image.";
//         $uploadOk = 0;
//     }
// }


if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

 // Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg"
&& $fileType != "gif" && $fileType != "txt" && $fileType != "pdf") {
    echo "Sorry, only JPG, JPEG, PNG, PDF, TXT, AND GIF files are allowed.";
    $uploadOk = 0;
}
//Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        require ('../model/FileUploadModel.php');
		$model = new UploadFileModel();
		$username = $_SESSION['username'];
        $url = "http://localhost:8888/securelogin/resources1/uploads/".$username. "/". $new_Filename;
		$model->create_fileentry($username, $target_file, $url);
		// echo "***Your file is accessible at http://localhost:8888/resources/uploads/".$username. "/". $new_Filename;
		header('Location:../view/myfiles.php');

    } else {
        $_SESSION['error'] = "Sorry, there was an error uploading your file.";
        header('Location:../view/uploadFile.php');
    }
 }
?>
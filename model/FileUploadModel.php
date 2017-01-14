<?php
require_once "Db.php";
class UploadFileModel extends Db{
    public function __construct() {
      // echo 'in model';
      parent::__construct();
    }
    public function create_fileentry($username, $filepath, $url){
      $this->create("files", "(username, filepath, url)", "('$username', '$filepath', '$url')");
      //       echo 'does not exist';
    }

    public function get_files($username)
    {
    	$rows = $this->select_all("files", "where username = '$username'");
    	return $rows;
    }
}
?>
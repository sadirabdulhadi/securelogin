<?php
require_once "Db.php";
  class ProfileModel extends Db{
    
    public function __construct() {
      // echo 'in model';
      parent::__construct();
    }
    
    public function getProfile($username)
    {
      // echo 'authenticating';
      $row = $this->select_where("users", "username = '$username'");
      
    }
  }
?>
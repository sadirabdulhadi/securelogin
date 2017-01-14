<?php
require_once "Db.php";
  class UserModel extends Db{
    
    public function __construct() {
      // echo 'in model';
      parent::__construct();
    }
    
    public function authenticate($username, $password)
    {
      $row = $this->select_where("users", "username = '$username'");
      $encrypted = $row['password'];
      if($row)
      {
        $verified = password_verify($password, $encrypted);
        if($verified){
          return $row['id'];
        } else {
          return -1;
        }
      }else{
        return -1;
      }
        
    } 

    public function logout()
    {
      session_destroy();
      header('Location:../view/loggedout.html');
    }

    public function create_user($username, $password)
    {
      // $sql = "insert into users (username, password) values ('$username', '$password');";
        $result = $this->create_user_return($username, $password);
        if ($result!=-1){
          $this->create_recent_snippet($result, $username);
          // $row = $this->select_where("users", "username = '$username'");
          return $result;
        }
        else
        {
          return -1;
        }
        // if($result){
        //   echo "Signup successful!!! Welcome ". $row['username'];
        // }else{
        //   echo 'empty query results';
        // }
    }

    public function updateProfile ($username, $new_username, $password, $icon_url, $homepage_url, $profile_color, $private_snippet)
    {
      if($password=="")
      {
        $this->update("users", "username = '$new_username', icon_url = '$icon_url', homepage_url = '$homepage_url', profile_color = '$profile_color', private_snippet = '$private_snippet'", "username='$username'");
      }
      else
      {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $this->update("users", "username = '$new_username', password = '$password', icon_url = '$icon_url', homepage_url = '$homepage_url', profile_color = '$profile_color', private_snippet = '$private_snippet'", "username='$username'");
      }
    }

    public function getProfile($username)
    {
      // echo 'authenticating';
      $row = $this->select_where("users", "username = '$username'");
      return $row;
    }

    public function getStatus($userid)
    {
      $row = $this->select_where("users", "id = '$userid'");
      return $row['status'];
    } 

    public function getUsername($userid)
    {
      $row = $this->select_where("users", "id = '$userid'");
      return $row['username'];
    }

    public function getPassword($username)
    {
      $row = $this->select_where("users", "username = '$username'");
      return $row['password'];
    }

    public function addAndCheck($ip)
    {
      $count = $this->create_attempt($ip);
      if ($count>3)
      {
        return false;
      }
      return true;
      // mysqli_query($connection, "insert into attempts (address)VALUES ('$ip')");
      // $result = mysqli_query("select count(*) from attempts WHERE address = $ip AND timestamp > (now() - interval 10 minute)");
      // $count = mysqli_fetch_array($result, MYSQLI_NUM));
    }

    public function delete_attempts()
    {
      // $current_time1 = new DateTime();
      // $current_time = $current_time1 - 10*60;
      $this->delete("attempts", "timestamp < NOW() - INTERVAL 10 MINUTE");
    }
  }
?>

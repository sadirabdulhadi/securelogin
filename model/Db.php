<?php
  class Db {
    protected $con;

    public function __construct() {
      $this->getInstance();
    }

    public function getInstance() {
      // if (!isset($this->con)) {
      //   $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
      //   $this->con = new PDO('mysql:host=localhost;dbname=website', 'root', 'root', $pdo_options);
      // }
      $user = 'root';
      $pass = 'root';
      $db = 'website';
      $host = 'localhost';

      // $this->con = mysqli_connect($host, $user, $pass, $db);
      $this->con = new PDO('mysql:dbname=website;host=localhost;charset=utf8', 'root', 'root');

$this->con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function select($table)
    {
      $sql = "select * from " . $table . ";";
      $stmt = $this->con->prepare($sql);
      $result = $stmt->execute();
      if ($result)
      {
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
      return $row;
      }

      // $result = mysqli_query($this->con, $sql);
      // $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      // return $row;
    }

    public function select_where($table, $where)
    {
      $sql = "select * from " . $table . " where " . $where . ";";
      $stmt = $this->con->prepare($sql);
      // echo $this->con==null; 
      // $result = mysqli_query($this->con, $sql);
      if ($stmt->execute())
      {
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
      return $row;
      }
      
    }

    public function select_all($table, $suffix)
    {
      $sql = "select * from " . $table . " " . $suffix . ";";
      $stmt = $this->con->prepare($sql);
      if ($stmt->execute())
      {
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      return $rows;
      }
      // $result = mysqli_query($this->con, $sql);
      // $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
      // return $rows;
    }

    public function update($table, $updates, $where)
    {
      $sql = "update " . $table . " set " . $updates . " where " . $where . ";";
      $stmt = $this->con->prepare($sql);
      $result = $stmt->execute();
      // echo $this->con==null; 
      // $result = mysqli_query($this->con, $sql);
    }

    public function create($table, $columns, $values)
    {
      $sql = "insert into " . $table . " " . $columns . " values " . $values . ";";
      $stmt = $this->con->prepare($sql);
      $result = $stmt->execute();
      // $result = mysqli_query($this->con, $sql);
    }

    public function get_snippet_id($username)
    {
      $sql = "select id FROM snippets WHERE time_created = (SELECT MAX(time_created) from snippets where username = :username)";
      $stmt = $this->con->prepare($sql);
      $stmt->bindParam(':username', $username, PDO::PARAM_STR);
      if ($stmt->execute())
      {
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
      return $row['id'];
      }
      // $result = mysqli_query($this->con, $sql);
      // $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      // return $row['id'];
    }

    public function create_snippet_return($user_id, $username, $content)
    {
      $sql = "insert into snippets (user_id, username, content) values (:user_id, :username, :content);";
      $stmt = $this->con->prepare($sql);
      $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
      $stmt->bindParam(':username', $username, PDO::PARAM_STR);
      $stmt->bindParam(':content', $content, PDO::PARAM_STR);
      // $stmt->bindParam("iss", $user_id, $username, $content);
      $result = $stmt->execute();
      // $result = mysqli_query($this->con, $sql);
      return $this->get_snippet_id($username);
    }

    public function create_recent_snippet($user_id, $username)
    {
      $sql = "insert into recent_snippets (user_id, username) values (:user_id, :username);";
      $stmt = $this->con->prepare($sql);
      $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
      $stmt->bindParam(':username', $username, PDO::PARAM_STR);
      $result = $stmt->execute();
    }

    public function create_user_return($username, $password)
    {
      $sql = "insert into users (username, password) values (:username, :password);";
      $stmt = $this->con->prepare($sql);
      $stmt->bindParam(':username', $username, PDO::PARAM_STR);
      $stmt->bindParam(':password', $password, PDO::PARAM_STR);
      // $stmt->bind_param("ss", $username, $password);
      $result = $stmt->execute();
      // $result = mysqli_query($this->con, $sql);
      if ($result)
      {
        $row = $this->select_where("users", "username = '$username'");
        return $row['id'];
      }
      else
      {
        return -1;
      }
    }

    public function check_attempts($ip)
    {
        $sql2 = "select count(*) AS count from attempts where address = '$ip' and timestamp > NOW() - INTERVAL 10 MINUTE";
        $stmt2 = $this->con->prepare($sql2);
        $count = $stmt2->execute();
        $rows = $stmt2->fetch(\PDO::FETCH_ASSOC);
        // echo $rows['count'];
        return $rows['count'];
    }

    public function create_attempt($ip)
    {
      $sql = "insert into attempts (address) values ('$ip');";
      $stmt = $this->con->prepare($sql);
      // $stmt->bindParam(':ip', $ip, PDO::PARAM_STR);
      // $stmt->bind_param("ss", $username, $password);
      $result = $stmt->execute();
      // $result = mysqli_query($this->con, $sql);
      if ($result)
      {
        // $current_time1 = new DateTime();
        // $current_time = $current_time1 - 10*60;
        $sql2 = "select count(*) AS count from attempts where address = '$ip' and timestamp > NOW() - INTERVAL 10 MINUTE";
        $stmt2 = $this->con->prepare($sql2);
        $count = $stmt2->execute();
        $rows = $stmt2->fetch(\PDO::FETCH_ASSOC);
      }
      return $rows['count'];
    }

    public function exists($table, $condition)
    {
      $sql = "select count(*) AS count FROM ". $table . " WHERE " . $condition;
      $stmt = $this->con->prepare($sql);
      $result = $stmt->execute();
      // $sql = "select 1 from " . $table . " where " . $condition;
      // echo 'in exists';
      // $result = mysqli_query($this->con, $sql);
      if ($result)
      {
        $rows = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($rows['count']>0)
          {
            return true;
          }          
      }
      // $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      // if($result)
      // {
        // $count=mysqli_num_rows($result);
        // if ($count==1)
        // {
          // if ($row['count']>0)
          // {
          //   return true;
          // }       
        // }
      // }
      return false;
    }

    public function delete($table, $condition)
    {
        $sql = "delete from " . $table . " where ". $condition . ";";
        $stmt = $this->con->prepare($sql);
        $result = $stmt->execute();
        // echo 'calling '. $sql;
        // $result = mysqli_query($this->con, $sql);
    }
}
    
?>
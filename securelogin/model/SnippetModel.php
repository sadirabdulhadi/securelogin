<?php
require_once "Db.php";
  class SnippetModel extends Db{
    
    public function __construct() {
      // echo 'in model';
      parent::__construct();
    }
    
    public function create_snippet($username, $content, $userid)
    {
      $id = $this->create_snippet_return($userid, $username, $content);

      // if ($this->exists("recent_snippets", "'$username'"))
      // {
          // $row = $this->select_where("snippets", "username = '$username'");
          
      $this->update("recent_snippets", "content = '$content', original_id = '$id'", "user_id = '$userid'");
      // }
      // else
      // {

      //     $this->create("recent_snippets", "(username, content)", "('$username', '$content')");
      //       echo 'does not exist';
      // }
          
          
        // if($result){
        //   echo "Signup successful!!! Welcome ". $row['username'];
        // }else{
        //   echo 'empty query results';
        // }
    }

    public function show_all_snippets()
    {
      $result = $this->select_all("recent_snippets", "limit 15");
      return $result;
      // foreach ($result->fetchAll() as $snippet)
      // {
      //   $this->snippets[] = new Snippet($snippet['id'], $snippet['username'], $snippet['content']);
      // }
    }

    public function show_my_snippets($userid)
    {
      $result = $this->select_all("snippets", "where user_id='$userid'");
      return $result;
    }

    public function delete_snippet($userid, $id)
    {
      $row = $this->select_where("recent_snippets", "user_id = '$userid'");
      $id2 = $row['original_id'];
      
      $this->delete("snippets", "id = '$id'");
      if ($id == $id2) 
      {
        // $sql = "select count(*) FROM products WHERE username = '$username'";
        if ($this->exists("snippets", "user_id = '$userid'"))
        {
          $rows = $this->select_all("snippets", "where user_id = '$userid' order by time_created desc");
          $row = $rows[0];
          $content = $row['content'];
          $original_id = $row['id'];
          $this->update("recent_snippets", "content = '$content', original_id = '$original_id'", "user_id = '$userid'");
        }

        else
        {
          $content = "";
          $original_id = -1;
          $this->update("recent_snippets", "content = '$content', original_id = '$original_id'", "user_id = '$userid'");
        }
        
      }
    }
  }
?>
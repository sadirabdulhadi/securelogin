<?php
	class Snippet{
		public $id;
		public $username;
		public $content;
		public function __construct($id, $username, $content)
		{
			$this->id = $id;
			$this->username = $username;
			$this->content = $content;
		}
	}
?>
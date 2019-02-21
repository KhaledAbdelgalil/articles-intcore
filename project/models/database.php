<?php
	class Database {
		protected $db = null;
		function __construct()
		                    {
							
								$this->connect('articles', 'root', '');
								//echo "database is connected";
							}

		
		/*public function connect($database, $uid, $pwd) {
			if(!empty(Database::$db)) return;

			$dsn = "mysql:host=localhost;dbname=$database";
			
			try {
		   		Database::$db = new PDO($dsn, $uid, $pwd);
			} catch(PDOException $e){
		   		echo $e->getMessage();
			}
		}*/
		public function connect($database, $uid, $pwd) {
			if(!empty($this->db)) return;

			$dsn = "mysql:host=localhost;dbname=$database";
			//echo $this->db;
			try {
		   		$this->db = new PDO($dsn, $uid, $pwd);
			} catch(PDOException $e){
		   		echo $e->getMessage();
			}
		}

		public function get($field) {
			if(isset($this->{$field}))
				return $this->{$field};
			return null;
		}
	}
?>
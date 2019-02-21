<?php
//the approved functions as complete generic till now is (get_by_id,delete)
	include_once('database.php');

	class generic extends Database{
		
public function get_by_id($id) 
		{
			//echo "user is connected <br>";

			
			//$data_base= new Database();
			$sql = "SELECT * FROM ".$this->table_name. " WHERE id = $id;";
			//$statement = Database::$db->prepare($sql);
			$statement=$this->db->prepare($sql);
			$statement->execute();
			$data = $statement->fetch(PDO::FETCH_ASSOC);
			//echo "yala hatr07<br>";
			//print_r($data);

			if(empty($data)){return;}
			foreach ($data as $key => $value) {
				$this->{$key} = $value;
			}
		} 
		public  function add($arr_fields) 
		{
			
			$sql = "INSERT INTO ".$this->table_name." (".implode(',',$this->arr_attributes).") VALUES (";
			$n=1;
			foreach ($this->arr_attributes as $a) {
				$sql=$sql.'?';
				if($n !=count($this->arr_attributes)) 
				{
					$sql=$sql." ,";
				}

					$n=$n+1;

			}

			$sql=$sql." )";


			$this->db->prepare($sql)->execute($arr_fields);
		}
		
		public  function delete() 
		{
			$sql = "DELETE FROM ".$this->table_name. " WHERE id = $this->id;";
			$this->db->query($sql);
		}

		public  function save($arr_fields,$number) {
			$sql = "UPDATE ".$this->table_name." SET ";
			
			$n=1;
			
			foreach ($this->arr_attributes  as $value) {
				$sql=$sql.$value;
				$sql=$sql." =  ?";
				if($n != $number)
				{ 
					$sql=$sql.", ";
				}
				$n=$n+1;
							}
			$sql=$sql." WHERE id = ?;";
			echo $sql;
			$this->db->prepare($sql)->execute($arr_fields);
		}

		public  function all($keyword) {
			//$data_base=new Database();

			$keyword = str_replace(" ", "%", $keyword);
			//echo $this->table_name.'<br>';
			$sql = "SELECT * FROM ".$this->table_name." WHERE name like ('%$keyword%');";
			//$statement = Database::$db->prepare($sql);
			//echo $sql.'<br>';
			$statement = $this->db->prepare($sql);
			$statement->execute();
			//echo $statement->fetch(PDO::FETCH_ASSOC).'<br>';
			$templates = [];
			//var_dump($this);
			while($row = $statement->fetch(PDO::FETCH_ASSOC)) 
			{
				$templates[]=$row;
				
				//$object->get_by_id($row['id']);
				/*$this->get_by_id($row['id']);
				$templates[]=$this;*/
				//echo $row['id']."<br>";
				/*echo "<br>";
				var_dump($this);*/
			}

			/*echo "<br>";
			print_r($templates);*/
			return $templates;
		}
	}
?>
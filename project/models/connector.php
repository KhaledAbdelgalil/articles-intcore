<?php
	//include_once('database.php');
	include_once('generic.php');

	class Connector extends generic
	  {
		protected  $table_name='connector';
	  	protected $arr_attributes =array('article_id','tag_id');
	  	
	  
	  public  function all($keyword) {
			

			
			$sql = "SELECT * FROM ".$this->table_name." WHERE id like ('%$keyword%');";
			
			$statement = $this->db->prepare($sql);
			$statement->execute();
			
			$templates = [];
			
			while($row = $statement->fetch(PDO::FETCH_ASSOC)) 
			{
				$templates[]=$row;
				
				
			}

			
			return $templates;
		}

		public function all_custom()
		{
			$sql = "SELECT article.name as article_name,article.description as article,tag.name as technology FROM connector JOIN tag ON connector.tag_id=tag.id JOIN article ON connector.article_id = article.id  ";

			$statement = $this->db->prepare($sql);
			$statement->execute();
			
			$templates = [];
			
			while($row = $statement->fetch(PDO::FETCH_ASSOC)) 
			{
				$templates[]=$row;
				
				
			}
			
						return $templates;

		}

		
	}
?>
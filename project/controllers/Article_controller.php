<?php
	header('Content-Type: application/json; charset=utf-8');
	include_once("../controllers/common.php");
	include_once("../models/article.php");
	
	class Article_controller
	{
		public function Article_delete()
		{
		$user=new Article();
		$user->get_by_id($_GET['id']);
		$user->delete();
		echo json_encode(['status'=>1]);
		}
		public function Article_add()
		{
			//$id = safeGet("id", 0);
			$name = safeGet("name");
			$description=safeGet("description");
			$user=new Article();
			$arr_fields=[];
			$arr_fields[]=$name;
			$arr_fields[]=$description;
			//$user->get_by_id($id);
			$user->add($arr_fields);
		}
		public function Article_edit()
		{
			$id = safeGet("id", 0);
			$user=new Article();
			$user->get_by_id($id);
			$user->name = safeGet("name");
			$user->description=safeGet("description");
			$arr_field=[];
			$arr_field[]=$user->name;
			$arr_field[]=$user->description;
			$arr_field[]=$user->id;
			$user->save($arr_field,2);
		}
	}

	
	$function=$_GET['do'];
	
	
	if ($function=="delete") 
	{
		Article_controller::Article_delete();
	}
	else
		{
		$id = safeGet("id", 0);
		if($id==0) 
		{
			Article_controller::Article_add();
		} 
		else 
		{
			Article_controller::Article_edit();
		}
		header('Location: ../articles.php');
		}
?>
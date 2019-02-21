<?php
	header('Content-Type: application/json; charset=utf-8');
	include_once("../controllers/common.php");
	include_once("../models/tag.php");
	
	class Tag_controller
	{
		public function Tag_delete()
		{
		$user=new Tag();
		$user->get_by_id($_GET['id']);
		$user->delete();
		echo json_encode(['status'=>1]);
		}
		public function Tag_add()
		{
			//$id = safeGet("id", 0);
			$name = safeGet("name");
			$description=safeGet("description");
			$user=new Tag();
			$arr_fields=[];
			$arr_fields[]=$name;
			//$user->get_by_id($id);
			$user->add($arr_fields);
		}
		public function Tag_edit()
		{
			$id = safeGet("id", 0);
			$user=new Tag();
			$user->get_by_id($id);
			$user->name = safeGet("name");
			$arr_field=[];
			$arr_field[]=$user->name;
			$arr_field[]=$user->id;
			$user->save($arr_field,1);
		}
	}

	
	$function=$_GET['do'];
	
	
	if ($function=="delete") 
	{
		Tag_controller::Tag_delete();
	}
	else
		{
		$id = safeGet("id", 0);
		if($id==0) 
			{
				Tag_controller::Tag_add();
			} 
		else 
			{
				Tag_controller::Tag_edit();
			}
		header('Location: ../tags.php');
		}
?>
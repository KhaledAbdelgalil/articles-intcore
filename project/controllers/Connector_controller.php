<?php
	header('Content-Type: application/json; charset=utf-8');
	include_once("../controllers/common.php");
	include_once("../models/Connector.php");
	
	class Connector_controller
	{
		public function Connector_delete()
		{
		$user=new Connector();
		$user->get_by_id($_GET['id']);
		$user->delete();
		echo json_encode(['status'=>1]);
		}
		public function Connector_add()
		{
			//$id = safeGet("id", 0);
			$article_id = safeGet("article_id");
			$tag_id=safeGet("tag_id");
			$user=new Connector();
			$arr_fields=[];
			$arr_fields[]=$article_id;
			$arr_fields[]=$tag_id;
			//$user->get_by_id($id);
			$user->add($arr_fields);
		}
		public function Connector_edit()
		{
			$id = safeGet("id", 0);
			$user=new Connector();
			$user->get_by_id($id);
			$user->article_id = safeGet("article_id");
			$user->tag_id=safeGet("tag_id");
			$arr_field=[];
			$arr_field[]=$user->article_id;
			$arr_field[]=$user->tag_id;
			$arr_field[]=$user->id;
			$user->save($arr_field,2);
		}
	}

	
	$function=$_GET['do'];
	
	
	if ($function=="delete") 
	{
		Connector_controller::Connector_delete();
	}
	else
		{
		$id = safeGet("id", 0);
		if($id==0) 
		{
			Connector_controller::Connector_add();
		} 
		else 
		{
			Connector_controller::Connector_edit();
		}
		header('Location: ../connectors.php');
		}
?>
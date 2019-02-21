<?php
	//include_once('database.php');
	include_once('generic.php');

	class Article extends generic
	  {
		protected  $table_name='article';
	  	protected $arr_attributes =array('name','description');
	  	
	  }

		
	
?>
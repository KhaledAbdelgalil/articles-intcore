<?php 
	include_once("./controllers/common.php");
	include_once('./components/head.php');
	include_once('./models/connector.php');
	$id = safeGet('id');
	//Database::connect('intcore(hello-world)', 'root', '');
	$user = new Connector();
	$user->get_by_id($id);
?>

    <h2 class="mt-4"><?=($id)?"Edit":"Add"?>Connector</h2>

    <form action="controllers/Connector_controller.php" method="post">
    	<input type="hidden" name="id" value="<?=$user->get('id')?>">
		<div class="card">
			<div class="card-body">
				<div class="form-group row gutters">
					<label for="inputEmail3" class="col-sm-2 col-form-label">Article_id</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="article_id" value="<?=$user->get('article_id')?>" required>
					</div>
					<br>
					<label for="inputEmail3" class="col-sm-2 col-form-label">tag_id</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="tag_id" value="<?=$user->get('tag_id')?>" required>
					</div>
				</div>
		    	<div class="form-group">
		    		<button class="button float-right" name="model" value="user" type="submit">Add</button>
		    	</div>
		    </div>
		</div>
    </form>

<?php include_once('./components/tail.php') ?>
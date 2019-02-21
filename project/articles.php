<?php 
	include_once('./controllers/common.php');
	include_once('./components/head.php');
	include_once('./models/article.php');
?>
 <form action="./articles.php" class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" name="keywords" placeholder="Search" aria-label="Search" value="<?=safeGet('keywords')?>">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
	<div style="padding: 10px 0px 10px 0px; vertical-align: text-bottom;">
		<span style="font-size: 125%;">Articles</span>
		<button class="button float-right edit_user" id="0">Add Article</button>
	</div>

    <table class="table table-striped">
    	<thead>
	    	<tr>
	      		<th scope="col">ID</th>
	      		<th scope="col">Name</th>
	      		<th scope="col">description</th>
	      		<th scope="col"></th>
	    	</tr>
	  	</thead>
	  	<tbody>
		  	<?php	
		  	$us=new Article();
				$users = $us->all(safeGet('keywords'));
				foreach ($users as $u) {
				$user =new Article();
				$user->get_by_id($u['id']);
			?>
    		<tr>
    			<td><?=$user->id?></td>
    			<td><?=$user->name?></td>
    			<td><?=$user->description?></td>
    			<td>
    				<button class="button edit_user" id="<?=$user->id?>">Edit</button>&nbsp;
    				<button class="button delete_user" id="<?=$user->id?>">Delete</button>
				</td>
    		</tr>
    		<?php } ?>
    	</tbody>
    </table>

<?php include_once('./components/tail.php') ?>

<script type="text/javascript">
	$(document).ready(function() {
		$('.edit_user').click(function(event) {
			window.location.href = "editarticle.php?id="+$(this).attr('id');
		});
	
		$('.delete_user').click(function(){
			var anchor = $(this);
			$.ajax({
				url: './controllers/Article_controller.php',
				type: 'GET',
				dataType: 'json',
				data: {"id": anchor.attr('id'),"do":"delete" },

			})
			.done(function(reponse) {
				if(reponse.status==1) {
					anchor.closest('tr').fadeOut('slow', function() {
						$(this).remove();
					});
				}
			})
			.fail(function() {
				alert("Connection error.");
			})
		});
	});
</script>
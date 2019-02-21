<?php 
	include_once('./controllers/common.php');
	include_once('./components/head.php');
	include_once('./models/tag.php');
	//Database::connect('intcore(hello-world)', 'root', '');
?>
 <form action="./tags.php" class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" name="keywords" placeholder="Search" aria-label="Search" value="<?=safeGet('keywords')?>">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>
    </header>
    <!-- Begin page content -->
    <main role="main" class="container">
	<div style="padding: 10px 0px 10px 0px; vertical-align: text-bottom;">
		<span style="font-size: 125%;">Tags</span>
		<button class="button float-right edit_user" id="0">Add Tag</button>
	</div>

    <table class="table table-striped">
    	<thead>
	    	<tr>
	      		<th scope="col">ID</th>
	      		<th scope="col">Name</th>
	      		<th scope="col"></th>
	    	</tr>
	  	</thead>
	  	<tbody>
		  	<?php	
		  	$us=new Tag();
				$users = $us->all(safeGet('keywords'));
				//var_dump($users);
				foreach ($users as $u) {
				$user =new Tag();
				$user->get_by_id($u['id']);
			?>
    		<tr>
    			<td><?=$user->id?></td>
    			<td><?=$user->name?></td>>
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
			window.location.href = "edittag.php?id="+$(this).attr('id');
		});
	
		$('.delete_user').click(function(){
			var anchor = $(this);
			$.ajax({
				url: './controllers/Tag_controller.php',
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
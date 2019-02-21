<?php 
	include_once('./models/tag.php');
	include_once('./models/article.php');
	include_once('./models/connector.php');
	include_once('./controllers/common.php');
	include_once('./components/head.php');
	

	
	
?>

    <main role="main" class="container">
	<div style="padding: 10px 0px 10px 0px; vertical-align: text-bottom;">
		<span style="font-size: 125%;">Tags</span>
		
	</div>

    <table class="table table-striped">
    	<thead>
	    	<tr>
	      		<th scope="col">Name</th>
	      		<th scope="col">description</th>
	      		<th scope="col">Technology</th>
	    	</tr>
	  	</thead>
	  	<tbody>
		  	<?php	
		  	$us=new Connector();
				$users = $us->all_custom();
				
				foreach ($users as $u) {
			?>
    		<tr>
    			<td><?=$u['article_name']?></td>
    			<td><?=$u['article']?></td>
    			<td><?=$u['technology']?></td>
    			
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
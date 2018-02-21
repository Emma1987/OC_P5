<?php $title = 'Liste des projets'; ?>

<div class="content">
	<h1 class="text-center">Liste des projets</h1>
	<hr class="star-primary">

	<?php
	foreach ($listPosts as $post)
	{
	?>
		<div class="panel panel-default list-posts">
			<div class="panel-heading">
				<h3><a href="post-<?= $post->getId(); ?>"><?php echo htmlspecialchars($post->getTitle()); ?></a></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<?php
					$match = 0;
					foreach ($images as $image)
					{
						if ($image->getPostId() == $post->getId())
						{
							$match ++;
						?>
								<div class="col-sm-3 listPostsImage">
									<img src="<?= '/z_blog/Web/uploads/img/' . $image->getTitle(); ?>" alt="<?= $image->getTitle(); ?>" />
								</div>
						<?php	
						}
					}
					if ($match != 1)
					{
					?>
						<div class="col-sm-3 listPostsImage">
							<img src="/z_blog/Web/uploads/img/noimage.png" alt="No Image" />
						</div>	
					<?php			
					}	
					?>
					<div class="col-sm-9">
						<em>Dernière modification, le <?php echo date_format(date_create($post->getLastDate()), 'd/m/Y à H:i'); ?></em>
						<p>
						Ecrit par <em><?= nl2br(htmlspecialchars($post->getAuthor())); ?></em><br />
						<p><?= nl2br(htmlspecialchars($post->getPreface())); ?></p>
						</p>
						<a href="post-<?= $post->getId(); ?>"><em>Voir plus</em></a>
					</div>
				<?php
				?>
			</div>
		</div>
	<?php
	}
	?>
</div>



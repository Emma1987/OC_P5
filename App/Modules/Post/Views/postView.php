<?php $title = 'Liste des projets'; ?>

<div class="content">

	<h1 class="text-center"><?= $post->getTitle(); ?></h1>
	<hr class="star-primary">

	<div class="panel panel-default post-unique">
		<!-- POST -->
		<p class="text-center"><i class="fa fa-user fa-fw"></i> <?= nl2br(htmlspecialchars($post->getAuthor())); ?></p>
		<p class="text-center"><em>Dernière modification, le <?php echo $post->getPublishedAt(); ?></em></p>

		<p class="justify">Chapô : <br /><?= nl2br(htmlspecialchars($post->getPreface())); ?></p>
		<p class="justify">Contenu : <br /> <?= nl2br($post->getPostContent()); ?></p>

		<!-- CATEGORIES -->
		<div class="panel-categories text-center">
			<p>Catégories associées :</p>
			<?php
			if (empty($categories))
			{
				echo 'Aucune catégorie associé à ce post.';
			}
			else {
				foreach ($categories as $category)
				{
					?>
					<div class="btn btn-default">
						<i class="glyphicon glyphicon-tag"></i>
						<?= htmlspecialchars($category->getName()); ?>
					</div><br />
				<?php
				}
			}
			?>
		</div>

		<!-- COMMENTAIRES -->
		<div class="panel-body">
			<?php
			if (empty($comments))
			{
			?>
				<p>Aucun commentaire n'a encore été posté sur cet article. Soyez le premier !</p>
			<?php
			}
			else {
				foreach ($comments as $comment)
				{
				?>
					<p>Publié par <?php echo htmlspecialchars($comment->getAuthor()); ?></p>
					<em>le <?php echo date_format(date_create($comment->getCommentDate()), 'd/m/Y à H:i'); ?></em>
						
					<p><?= nl2br(htmlspecialchars($comment->getCommentContent())); ?></p>
				<?php
				}
			}
			?>

			<!-- FORMULAIRE AJOUT COMMENTAIRE -->
			<h3>Ajouter un commentaire</h3>

			<div class="list-group-item">
				<form method="post" action="addComment-<?= $post->getId(); ?>">
					<div class="form-group">
						<label for="author">Auteur</label>
						<input class="form-control" type="text" id="author" name="author" />
					</div>
					<div class="form-group">
						<label for="commentContent">Contenu</label>
						<textarea class="form-control" name="commentContent" id="commentContent" rows="3"></textarea>
					</div>
					<input type="submit" class="btn btn-success" value="Valider" />
				</form>
			</div>
		</div>
	</div>

	<!-- BUTTONS -->
	<div class="post-buttons text-center">
		<a href="listPosts" class="btn btn-default">
			<i class="glyphicon glyphicon-chevron-left"></i> Retour à la liste
		</a>
		<a href="updatePost-<?= $post->getId(); ?>" class="btn btn-default">
			<i class="glyphicon glyphicon-edit"></i> Modifier
		</a>
		<a class="btn btn-danger" data-toggle="modal" data-target="#deleteConfirmation">
			<i class="glyphicon glyphicon-trash"></i> Supprimer
		</a>
	</div>

	<!-- MODAL DELETE CONFIRM -->
	<div class="modal fade" id="deleteConfirmation" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Confirmation</h4>
				</div>
				<div class="modal-body">
					<p>Confirmez vous la suppression de ce post et de ses commentaires ?</p>
				</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
						<button type="button" class="btn btn-primary"><a href="deletePost-<?= $post->getId(); ?>">Supprimer</a></button>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
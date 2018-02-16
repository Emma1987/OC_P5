<?php $title = 'Liste des projets'; ?>

<?php ob_start(); ?>

<div class="text-center">
	<!-- ARTICLE -->
    <h1>Article d'id : <?= $post->getId(); ?></h1>
	<div class="news">
		<h3>
			<?php echo htmlspecialchars($post->getTitle()); ?>
			<em>le <?php echo $post->getLastDate(); ?></em>
		</h3>
		<p>Auteur :<br /> <?= nl2br(htmlspecialchars($post->getAuthor())); ?> </p>
		<p>Preface :<br /> <?= nl2br(htmlspecialchars($post->getPreface())); ?></p>
		<p>Contenu :<br /> <?= nl2br(htmlspecialchars($post->getPostContent())); ?></p>
	</div>

	<p><a href="index.php?action=updatePost&id=<?= $post->getId(); ?>">Modifier</a></p>
	<p><a href="index.php?action=deletePost&id=<?= $post->getId(); ?>">Supprimer</a></p>

	<!-- COMMENTAIRES -->
	<h2>Liste des commentaires</h2>

	<?php
	if (empty($comments))
	{
		echo 'Aucun commentaire';
	}
	else {
		foreach ($comments as $comment)
		{
		?>
			<div class="comments">
				<h3>Publié par <?php echo htmlspecialchars($comment->getAuthor()); ?></h3>
				<em>le <?php echo date_format(date_create($comment->getCommentDate()), 'd/m/Y à H:i'); ?></em>
					
				<p><?= nl2br(htmlspecialchars($comment->getCommentContent())); ?></p>
			</div>
		<?php
		}
	}
	?>

	<!-- FORMULAIRE AJOUT COMMENTAIRE -->
	<h2>Ajouter un commentaire</h2>

	<form method="post" action="index.php?action=addComment&id=<?= $post->getId(); ?>">
		<label for="author">Auteur</label>
		<input type="text" id="author" name="author" /><br />

		<label for="commentContent">Commentaire</label>
		<textarea id="commentContent" name="commentContent"></textarea><br />

		<input type="submit" value="Valider" />
	</form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require(__DIR__ . '/../layout.php'); ?>
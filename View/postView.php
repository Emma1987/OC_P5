<?php $title = 'Liste des projets'; ?>

<?php ob_start(); ?>

<div class="text-center">
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

	<p><a href="index.php?action=getPostToUpdate&id=<?= $post->getId(); ?>">Modifier</a></p>
	<p><a href="index.php?action=deletePost&id=<?= $post->getId(); ?>">Supprimer</a></p>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>
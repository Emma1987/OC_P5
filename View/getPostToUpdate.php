<?= $title = 'Modifier un Post'; ?>

<?php ob_start(); ?>

<form method="post" action="index.php?action=updatePost&id=<?= $post->getId(); ?>">

	<p><label for="author">Auteur</label>
	<input type="text" id="author" name="author" value="<?= $post->getAuthor(); ?>" /></p>

	<p><label for="title">Titre</label>
	<input type="text" id="title" name="title" value="<?= $post->getTitle(); ?>" /></p>

	<p><label for="preface">Présentation de l'article</label>
	<textarea id="preface" name="preface"><?= $post->getPreface(); ?></textarea></p>

	<p><label for="postContent">Contenu</label>
	<textarea id="postContent" name="postContent"><?= $post->getPostContent(); ?></textarea></p>

	<input type="submit" value="Valider" />
</form>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>
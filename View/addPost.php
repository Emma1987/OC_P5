<?= $title = 'Ajouter un Post' ?>

<?php ob_start(); ?>

<form method="post" action="index.php?action=addPost">

	<label for="author">Auteur</label>
	<input type="text" id="author" name="author" /><br />

	<label for="title">Titre</label>
	<input type="text" id="title" name="title" /><br />

	<label for="preface">Présentation de l'article</label>
	<textarea id="preface" name="preface"></textarea><br />

	<label for="postContent">Contenu</label>
	<textarea id="postContent" name="postContent"></textarea><br />

	<input type="submit" value="Valider" />
</form>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>
<?php $title = 'Liste des projets'; ?>

<?php ob_start(); ?>

    <h1 class="text-center">Mon portfolio personnel</h1>
    <h2 class="text-center">Mes derniers projets :</h2>
    <hr class="star-primary" />
 
	<?php
	foreach ($posts as $post)
	{
	?>
		<div class="news text-center">
			<h3><a href="index.php?action=post&id=<?= $post->getId(); ?>"><?php echo htmlspecialchars($post->getTitle()); ?></a></h3>
			<em>Dernière modification, le <?php echo date_format(date_create($post->getLastDate()), 'd/m/Y à H:i'); ?></em>
			
			<p>Ecrit par <em><?= nl2br(htmlspecialchars($post->getAuthor())); ?></em><br />
				<?= nl2br(htmlspecialchars($post->getPreface())); ?></p><hr />
		</div>
	<?php
	}
	?>

<?php $content = ob_get_clean(); ?>

<?php require(__DIR__ . '/../layout.php'); ?>



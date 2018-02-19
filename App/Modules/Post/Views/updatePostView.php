<?= $title = 'Modifier un Post'; ?>

<div class="content">

	<h1 class="text-center">Modifier cet article</h1>
	<hr class="star-primary">

	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-file-text-o fa-fw"></i> Article
		</div>
		<div class="panel-body">
			<form method="post" action="" enctype="multipart/form-data" role="form">
				<!-- POST -->
				<div class="list-group-item">
					<p>Auteur : <?= $post->getAuthor(); ?></p>
					<div class="form-group">
						<label for="title">Titre</label>
						<input class="form-control" type="text" id="title" name="title" value="<?= $post->getTitle(); ?>" />
					</div>
					<div class="form-group">
						<label for="preface">Chapô</label>
						<textarea class="form-control" name="preface" id="preface" rows="3"><?= $post->getPreface(); ?></textarea>
					</div>
					<div class="form-group">
						<label for="postContent">Contenu de l'article</label>
						<textarea class="form-control" name="postContent" id="postContent" rows="10"><?= $post->getPostContent(); ?></textarea>
					</div>
				</div>

				<!-- SUBMIT BUTTON -->
				<input type="submit" class="btn btn-success" value="Valider" />
			</form>
		</div>
	</div>
</div>
<?= $title = 'Ajouter un Post'; ?>

<div class="content">

	<h1 class="text-center">Ajouter un nouvel article</h1>
	<hr class="star-primary">

	<!-- POST -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-file-text-o fa-fw"></i> Article
		</div>

		<div class="panel-body">
			<form method="post" action="" enctype="multipart/form-data" role="form">
				<div class="list-group-item">
					<div class="form-group">
						<label for="author">Auteur</label>
						<input class="form-control" type="text" id="author" name="author" placeholder="Auteur" />
					</div>
					<div class="form-group">
						<label for="title">Titre</label>
						<input class="form-control" type="text" id="title" name="title" placeholder="Titre de l'article" />
					</div>
					<div class="form-group">
						<label for="preface">Chapô</label>
						<textarea class="form-control" name="preface" id="preface" rows="3"></textarea>
					</div>
					<div class="form-group">
						<label for="postContent">Contenu de l'article</label>
						<textarea class="form-control" name="postContent" id="postContent" rows="10"></textarea>
					</div>
				</div>

				<input type="submit" class="btn btn-success" value="Valider" />
			</form>
		</div>
	</div>
</div>
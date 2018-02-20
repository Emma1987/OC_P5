<?= $title = 'Ajouter un Post'; ?>

<div class="content">

	<h1 class="text-center">Ajouter un nouvel article</h1>
	<hr class="star-primary">

	<!-- POST -->
	<div class="row">
		<div class="col-sm-offset-1 col-sm-7">
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

						<!-- CATEGORIES -->
						<div class="list-group-item">
							<p>Choisissez une catégorie</p>
							<?php
							foreach ($categories as $category)
							{
								?>
								<input type="checkbox" name="categoryName[]" id="categoryName" value="<?= $category->getId(); ?>" /><label for="categoryName"> <?= $category->getName(); ?></label><br />
								<?php
							}
							?>
						</div>
					<input type="submit" class="btn btn-success" value="Valider" />
					</form>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<!-- LIST CATEGORIES -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-comments fa-fw"></i> Liste des catégories
				</div>
				<div class="panel-body">
					<div class="list-group-item">
						<p>Catégories enregistrées</p>
						<?php	
						foreach ($categories as $category)
						{
							?>
							<div class="btn-group" role="group" aria-label="...">
								<div class="btn btn-default list-categories">
									<i class="glyphicon glyphicon-tag"></i>
									<?= htmlspecialchars($category->getName()); ?>
								</div>
								<div class="btn btn-default disabled" data-toggle="tooltip" data-placement="right" title="Supprimer cette catégorie">
									<a href="removeCategory-<?= $category->getId(); ?>" >X</a><br />
								</div>
							</div><br />
							<?php
						}
						?>
					</div>
					<div class="list-group-item">
						<p>Ajoutez une nouvelle catégorie</p>
							<form method="post" action="addCategoryNewPost">
								<input class="form-control" type="text" name="newCategory" />
								<input class="btn btn-success" type="submit" value="Valider" />
							</form>                
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
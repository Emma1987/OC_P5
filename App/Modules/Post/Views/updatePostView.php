<?= $title = 'Modifier un Post'; ?>

<div class="content">

	<h1 class="text-center">Modifier cet article</h1>
	<hr class="star-primary">

	<div class="row">
		<div class="col-lg-offset-1 col-lg-7">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-file-text-o fa-fw"></i> Article
				</div>
				<div class="panel-body">
					<form method="post" action="" role="form">
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

						<!-- IMAGES -->
						<div class="list-group-item">
						<?php
						if (!empty($image))
						{
							?>
							<div>
								<p>Image</p>
								<img src="<?= '/z_blog/Web/uploads/img/' . $image->getTitle(); ?>" alt="<?= $image->getTitle(); ?>" class="updateImage" /><br/>
								<a href="deleteImage-<?= $image->getId(); ?>-<?= $post->getId(); ?>">Supprimer cette image</a>
							</div>
							<?php
						}
						else {
						?>
							<p>Ajoutez une photo</p>
							<div class="form-group">
								<label for="imageTitle">Titre de l'image</label>
								<input class="form-control" type="text" id="imageTitle" name="imageTitle" placeholder="Titre de la photo" />
							</div>
							<label for="image">Image</label>
							<input type="file" name="image" id="image" /><br />
						<?php
						}
						?>
						</div>

						<!-- CATEGORIES -->
						<div class="list-group-item">
							<div class="row">
								<div class="col-lg-6">
									<p>Catégories associées</p>
									<?php
									if (!empty($selectedCategories))
									{
										foreach ($selectedCategories as $selectedCategory)
										{
										?>
											<div class="btn-group" role="group">
												<div class="btn btn-default list-categories">
													<i class="glyphicon glyphicon-tag"></i>
													<?= htmlspecialchars($selectedCategory->getName()); ?>
												</div>
												<div class="btn btn-default" data-toggle="tooltip" data-placement="right" title="Supprimer cette catégorie">
													<a href="removePostCategory-<?= $post->getId(); ?>-<?= $selectedCategory->getId(); ?>" >X</a>
												</div>
											</div><br />
										<?php
										}
									}
									?>
								</div>
								<div class="col-lg-6">
									<p>Sélectionner une ou plusieurs nouvelles catégories</p>
									<?php
									foreach ($categories as $category)
									{
										if (!empty($selectedCategories))
										{
											foreach ($selectedCategories as $selectedCategory)
											{
												$names[] = $selectedCategory->getName();
											}
										}
										else {
											$names = [];
										}
										if (!in_array($category->getName(), $names))
										{
										?>
											<p>
											<input type="checkbox" name="categoryName[]" id="categoryName" value="<?= $category->getId(); ?>" /><label for="categoryName"><?= $category->getName(); ?></label><br />
											</p>
										<?php
										}
									}
									?>
								</div>
							</div>
						</div>

						<!-- SUBMIT BUTTON -->
						<input type="submit" class="btn btn-success" value="Valider" />
					</form>
				</div>
			</div>

		<div class="col-lg-3">
			<!-- LIST CATEGORIES -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-tags fa-fw"></i> Gérer les catégories
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
								<div class="btn btn-default" data-toggle="tooltip" data-placement="right" title="Supprimer cette catégorie">
									<a href="removeCategory-<?= $category->getId(); ?>" >X</a><br />
								</div>
							</div><br />
							<?php
						}
						?>
					</div>
					<div class="list-group-item">
						<p>Ajoutez une nouvelle catégorie</p>
							<form method="post" action="addCategoryUpdate">
								<input type="hidden" name="postId" value="<?= $post->getId(); ?>" />
								<input class="form-control" type="text" name="newCategory" />
								<input class="btn btn-success" type="submit" value="Valider" />
							</form>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
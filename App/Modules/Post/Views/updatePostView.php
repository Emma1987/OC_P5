<!-- CONTENT -->
<div class="row">
    <form method="post" action="" enctype="multipart/form-data">
        <div class="col-lg-8">
            <div class="panel panel-default formPost">
                <div class="panel-heading">
                    <i class="fa fa-file-text-o fa-fw"></i> Article
                </div>
                <div class="panel-body">
                    <form method="post" action="" enctype="multipart/form-data" role="form">
                        <!-- POST -->
                        <div class="list-group-item">
                            <p>Auteur : <?= htmlspecialchars($post->getAuthor()); ?></p>
                            <div class="form-group">
                                <label for="title">Titre</label>
                                <input class="form-control" type="text" id="title" name="title" value="<?= $post->getTitle(); ?>" />
                            </div>
                            <div class="form-group">
                                <label for="link">Lien du site</label>
                                <input class="form-control" type="text" id="link" name="link" value="<?= $post->getLink(); ?>" />
                            </div>
                            <div class="form-group">
                                <label for="preface">Chapô</label>
                                <textarea class="form-control" name="preface" id="preface" rows="3"><?= htmlspecialchars($post->getPreface()); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="postContent">Contenu de l'article</label>
                                <textarea class="form-control" name="postContent" id="postContent" rows="10"><?= htmlspecialchars($post->getPostContent()); ?></textarea>
                            </div>
                        </div>

                    <!-- IMAGES -->
                    <div class="list-group-item">
                    <?php if (!empty($image)) : ?>
                        <div>
                            <p>Image</p>
                            <img src="<?= '/Web/uploads/img/' . $image->getTitle() ?>" alt="<?= $image->getTitle(); ?>" class="updateImage" /><br/>
                            <a href="deleteImage-<?= $image->getId(); ?>-<?= $post->getId(); ?>">
                                Supprimer cette image
                            </a>
                        </div>
                    <?php else: ?>
                        <p>Ajoutez une photo</p>
                        <div class="form-group">
                            <label for="imageTitle">Titre de l'image</label>
                            <input class="form-control" type="text" id="imageTitle" name="imageTitle" placeholder="Titre de la photo" />
                        </div>
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" /><br />
                    <?php endif; ?>
                    </div>

                    <!-- CATEGORIES -->
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>Catégories associées</h3>
                                <?php foreach ($categories as $category) : ?>
                                    <?php if (!empty($postCategories) && in_array($category->getName(), $postCategories)) : ?>
                                        <div class="btn-group" role="group">
                                            <div class="btn btn-default noClic list-categories">
                                                <i class="glyphicon glyphicon-tag"></i> <?= htmlspecialchars($postCategories[$category->getId()]); ?>
                                            </div>
                                            <a class="btn btn-default" data-toggle="tooltip" data-placement="right" title="Supprimer cette catégorie" href="removePostCategory-<?= $post->getId(); ?>-<?= $category->getId(); ?>" >
                                                <i class="fa fa-close fa-fw"></i>
                                            </a>
                                        </div><br />
                                    <?php else: ?>
                                        <?php $othersCategories[] = $category; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php if (empty($postCategories)) : ?>
                                    <p>Aucune catégorie n'est encore associée à ce post.</p>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-6">
                                <h3>Ajouter de nouvelles catégories</h3>
                                <?php foreach ($othersCategories as $otherCategory): ?>
                                    <p>
                                        <input type="checkbox" name="categoryName[]" id="categoryName" value="<?= $otherCategory->getId(); ?>" />
                                        <label for="categoryName">
                                            <?= htmlspecialchars($otherCategory->getName()); ?>
                                        </label><br />
                                    </p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- SUBMIT BUTTON -->
                    <input type="submit" class="btn btn-success validButton" value="Valider" />
                </div>
            </div>
        </div>
    </form>

        <div class="col-lg-4">
            <!-- LIST CATEGORIES -->
            <div class="panel panel-default formPost">
                <div class="panel-heading">
                    <i class="fa fa-tags fa-fw"></i> Gérer les catégories
                </div>
                <div class="panel-body">
                    <div class="list-group-item">
                        <p>Catégories enregistrées</p>
                        <?php foreach ($categories as $category) : ?>
                            <div class="btn-group" role="group" aria-label="...">
                                <div class="btn btn-default noClic list-categories">
                                    <i class="glyphicon glyphicon-tag"></i> <?= htmlspecialchars($category->getName()); ?>
                                </div>
                                <a class="btn btn-default" data-toggle="tooltip" data-placement="right" title="Supprimer cette catégorie" href="removeCategory-<?= $category->getId(); ?>" >
                                    <i class="fa fa-close fa-fw"></i>
                                </a>
                            </div><br />
                        <?php endforeach; ?>
                    </div>
                    <div class="list-group-item">
                        <p>Ajoutez une nouvelle catégorie</p>
                        <form method="post" action="addCategoryUpdate">
                            <input type="hidden" name="postId" value="<?= $post->getId(); ?>" />
                            <input class="form-control" type="text" name="newCategory" />
                            <input class="btn btn-success validButton" type="submit" value="Valider" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
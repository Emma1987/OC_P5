<!-- POST -->
<div class="row">
    <div class="col-sm-8">
        <div class="panel panel-default formPost">
            <div class="panel-heading">
                <i class="fa fa-file-text-o fa-fw"></i> Article
            </div>

            <div class="panel-body">
                <form method="post" action="" enctype="multipart/form-data" role="form">
                    <div class="list-group-item">
                        <div class="form-group">
                            <label for="author">Auteur</label>
                            <input class="form-control" type="text" id="author" name="author" value="<?= $user->getUsername(); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="title">Titre</label>
                            <input class="form-control" type="text" id="title" name="title" placeholder="Titre de l'article" />
                        </div>
                        <div class="form-group">
                            <label for="link">Lien du site</label>
                            <input class="form-control" type="text" id="link" name="link" placeholder="Lien du site" />
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

                <!-- IMAGES -->
                <div class="list-group-item">
                    <p>Ajoutez une photo</p>
                    <div class="form-group">
                        <label for="imageTitle">Titre de l'image</label>
                        <input class="form-control" type="text" name="imageTitle" placeholder="Titre de la photo" />
                    </div>
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" /><br />
                </div>

                <!-- CATEGORIES -->
                <div class="list-group-item">
                    <p>Choisissez une catégorie</p>
                    <?php foreach ($categories as $category) : ?>
                        <input type="checkbox" name="categoryName[]" value="<?= $category->getId(); ?>" />
                        <label for="categoryName"> 
                            <?= htmlspecialchars($category->getName()); ?>
                        </label><br />
                    <?php endforeach; ?>
                </div>

                <!-- SUBMIT BUTTON -->
                <input type="submit" class="btn btn-success validButton" value="Valider" />
                </form>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <!-- LIST CATEGORIES -->
        <div class="panel panel-default formPost">
            <div class="panel-heading">
                <i class="fa fa-comments fa-fw"></i> Liste des catégories
            </div>
            <div class="panel-body">
                <div class="list-group-item">
                    <p>Catégories enregistrées</p>
                    <?php foreach ($categories as $category) : ?>
                        <div class="btn-group" role="group">
                            <div class="btn btn-default noClic list-categories">
                                <i class="glyphicon glyphicon-tag"></i>
                                <?= htmlspecialchars($category->getName()); ?>
                            </div>
                            <a class="btn btn-default" data-toggle="tooltip" data-placement="right" title="Supprimer cette catégorie" href="removeCategoryNewPost-<?= $category->getId(); ?>" >
                                <i class="fa fa-close fa-fw"></i>
                            </a>
                        </div><br />
                    <?php endforeach; ?>
                </div>
                <div class="list-group-item">
                    <p>Ajoutez une nouvelle catégorie</p>
                        <form method="post" action="addCategoryNewPost">
                            <input class="form-control" type="text" name="newCategory" />
                            <input class="btn btn-success validButton" type="submit" value="Valider" />
                        </form>                
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ARTICLE -->
<h2 class="text-center"><?= $title; ?></h2>
<hr class="star-primary">

<!-- BUTTON -->
<div class="post-buttons text-center">
    <a href="listPosts" class="btn btn-default">
        <i class="glyphicon glyphicon-chevron-left"></i> Retour à la liste des articles
    </a>
</div>

<div class="panel panel-default postUnique">
    <!-- POST -->
    <p class="text-center"><i class="fa fa-user fa-fw"></i> <?= htmlspecialchars($post->getAuthor()); ?></p>
    <p class="text-center"><em>Dernière modification, le <?= $post->getPublishedAt(); ?></em></p>

    <h2>Chapô : </h2>
    <p><?= nl2br(htmlspecialchars($post->getPreface())); ?></p>
    <h2>Contenu : </h2>
    <p><?= nl2br(htmlspecialchars($post->getPostContent())); ?></p>

    <!-- CATEGORIES -->
    <div class="panel-categories text-center">
        <h2>Catégories associées :</h2>
        <?php if (empty($categories)) : ?>
            <p>Aucune catégorie associé à ce post.</p>
        <?php else: ?>
            <?php foreach ($categories as $category) : ?>
                <div class="btn btn-default noClic">
                    <i class="glyphicon glyphicon-tag"></i> <?= htmlspecialchars($category->getName()); ?>
                </div><br />
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- IMAGE -->
    <?php if (!empty($image)) : ?>
        <div class="imagePostUnique text-center">
            <img src="<?= '/Web/uploads/img/' . $image->getTitle() . $image->getPostId() . '.' . $image->getExtension() ?>" alt="<?= $image->getTitle(); ?>" />
        </div>
    <?php endif; ?>
</div>

<div class="panel panel-default comments">
    <div class="panel-heading">
        <i class="fa fa-comments fa-fw"></i> COMMENTAIRES
    </div>
    <!-- COMMENTAIRES -->
    <div class="panel-body">
        <?php if (empty($comments)) : ?>
            <p>Aucun commentaire n'a encore été posté sur cet article. Soyez le premier !</p>
        <?php else: ?>
            <?php foreach ($comments as $comment) : ?>
                <div class="list-group-item">
                    <i class="fa fa-user fa-fw"></i> <em>Posté par <?= htmlspecialchars($comment->getAuthor()); ?></em>
                    <i class="fa fa-clock-o fa-fw"></i> Ajouté le <?php echo date_format(date_create($comment->getCommentDate()), 'd/m/Y à H:i'); ?>
                    <p style="padding-top:10px;"><?= nl2br(htmlspecialchars($comment->getCommentContent())); ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- FORMULAIRE AJOUT COMMENTAIRE -->
        <h2>Ajouter un commentaire</h2>
        <?php if (empty($_SESSION['auth'])) : ?>
            <p>Vous devez être connecté pour laisser un commentaire.</p>
            <p><em><a class="btn btn-default" href="login">Connectez-vous</a></em></p>              
        <?php else: ?>
            <div class="list-group-item">
                <form method="post" action="addComment-<?= $post->getId(); ?>">
                    <div class="form-group">
                        <label for="author">Auteur</label>
                        <input class="form-control" type="text" id="author" name="author" value="<?= $user->getUsername(); ?>" disabled="disabled" />
                        <input type="hidden" name="authorValue" value="<?= $user->getUsername(); ?>" />
                    </div>
                    <div class="form-group">
                        <label for="commentContent">Contenu</label>
                        <textarea class="form-control" name="commentContent" id="commentContent" rows="3"></textarea>
                    </div>
                    <input type="submit" class="btn btn-success" value="Valider" />
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- BUTTON -->
<div class="post-buttons text-center">
    <a href="listPosts" class="btn btn-default">
        <i class="glyphicon glyphicon-chevron-left"></i> Retour à la liste des articles
    </a>
</div>
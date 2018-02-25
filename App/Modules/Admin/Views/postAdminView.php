<div class="panel panel-default post-unique">
    <!-- POST -->
    <p class="text-center"><i class="fa fa-user fa-fw"></i> <?= htmlspecialchars($post->getAuthor()); ?></p>
    <p class="text-center"><em>Dernière modification, le <?php echo $post->getPublishedAt(); ?></em></p>

    <p class="justify">Chapô : <br /><?= nl2br(htmlspecialchars($post->getPreface())); ?></p>
    <p class="justify">Contenu : <br /> <?= nl2br(htmlspecialchars($post->getPostContent())); ?></p>

    <!-- CATEGORIES -->
    <div class="panel-categories text-center">
        <p>Catégories associées :</p>
        <?php if (empty($categories)) : ?>
            <p>Aucune catégorie associé à ce post.</p>
        <?php else: ?>
            <?php foreach ($categories as $category) : ?>
                <div class="btn btn-default noClic">
                    <i class="glyphicon glyphicon-tag"></i>
                    <?= htmlspecialchars($category->getName()); ?>
                </div><br />
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php if (!empty($post->getLink())) : ?>
        <p class="text-center"><em><a href="<?php echo $post->getLink(); ?>">Voir le site</a></em></p>
    <?php endif; ?>

    <!-- IMAGE -->
    <?php if (!empty($image)) : ?>
        <div class="imagePostUnique text-center">
            <img src="<?= '/Web/uploads/img/'.$image->getTitle().$image->getPostId().'.'.$image->getExtension() ?>" alt="<?= $image->getTitle(); ?>" />
        </div>
    <?php endif; ?>
</div>

<!-- BUTTONS -->
<div class="post-buttons text-center">
    <a href="listPosts" class="btn btn-default">
        <i class="glyphicon glyphicon-chevron-left"></i> Retour à la liste
    </a>
    <a href="updatePost-<?= $post->getId(); ?>" class="btn btn-default">
        <i class="glyphicon glyphicon-edit"></i> Modifier
    </a>
    <a class="btn btn-danger" data-toggle="modal" data-target="#deleteConfirmation">
        <i class="glyphicon glyphicon-trash"></i> Supprimer
    </a>
</div>

<!-- MODAL DELETE CONFIRM -->
<div class="modal fade" id="deleteConfirmation" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="myModalLabel">Confirmation</h3>
            </div>
            <div class="modal-body">
                <p>Confirmez vous la suppression de ce post et de ses commentaires ?</p>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <a class="btn btn-danger" href="deletePost-<?= $post->getId(); ?>">Supprimer</a>
                </div>
            </div>
        </div>
    </div>
</div>
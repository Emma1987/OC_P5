<?php foreach ($listPosts as $post) : ?>
    <div class="panel panel-default list-posts">
        <div class="panel-heading">
            <h3><a href="post-<?= $post->getId(); ?>"><?= htmlspecialchars($post->getTitle()); ?></a></h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <?php if (!empty($postImage[$post->getId()])) : ?>
                    <!-- IMAGE -->
                    <div class="col-sm-3 col-xs-12 listPostsImage">
                        <img src="<?='/Web/uploads/img/' . $postImage[$post->getId()] ?>" alt="<?= $postImage[$post->getId()]; ?>" />
                    </div>
                <?php else: ?>
                    <div class="col-sm-3 col-xs-12 listPostsImage">
                        <img src="/Web/uploads/img/noimage.png" alt="No Image" />
                    </div>
                <?php endif; ?>

                <!-- CONTENT -->
                <div class="col-sm-9 listPostsAdmin">
                    <i class="fa fa-user fa-fw"></i> <em><?= htmlspecialchars($post->getAuthor()); ?> <i class="fa fa-clock-o fa-fw"></i> Dernière modification le <?= date_format(date_create($post->getLastDate()), 'd/m/Y à H:i'); ?></em>
                    <p><?= nl2br(htmlspecialchars($post->getPreface())); ?></p><hr />
                </div>

                <!-- BUTTONS -->
                <div class="listPostsButtons">
                    <a href="updatePost-<?= $post->getId(); ?>" class="btn btn-default">
                        <i class="glyphicon glyphicon-edit"></i> Modifier
                    </a>
                    <a class="btn btn-danger" data-toggle="modal" data-target="#deleteConfirmation">
                        <i class="glyphicon glyphicon-trash"></i> Supprimer
                    </a>
                </div>
            </div>
        </div>
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
<?php endforeach; ?>


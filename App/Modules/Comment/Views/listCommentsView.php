<?php foreach ($comments as $comment) : ?>
    <div class="panel panel-default listPosts">
        <div class="panel-heading">
            <h3>Publié sur l'article : 
                <a href="post-<?= $comment->getPostId(); ?>">
                    <?= htmlspecialchars($postArray[$comment->getPostId()]); ?>
                </a>
            </h3>
        </div>
        <div class="panel-body listComments">
            <div class="row">
                <div class="col-sm-9">
                    <p><i class="fa fa-user fa-fw"></i> <em>
                        <?= htmlspecialchars($comment->getAuthor()); ?> 
                        a posté ce commentaire le <?php echo date_format(date_create($comment->getCommentDate()), 'd/m/Y à H:i'); ?>
                    </em></p>
                    <p><?= nl2br(htmlspecialchars($comment->getCommentContent())); ?></p>
                </div>
                <div class="col-sm-3">
                    <?php if ($comment->getOnline() == false) : ?>
                        <a class="btn btn-default" href="validateComment-<?= $comment->getId(); ?>">
                            Valider le commentaire
                        </a>
                    <?php endif; ?>
                    <a class="btn btn-danger" href="deleteComment-<?= $comment->getId(); ?>">
                        Supprimer ce commentaire
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

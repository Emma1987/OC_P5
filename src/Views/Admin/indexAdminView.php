<div class="row">
    <!-- POSTS -->
    <div class="col-sm-8 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-files-o fa-fw"></i> Liste des articles
            </div>
            <div class="panel-body">
                <?php foreach ($posts as $post): ?>
                    <div class="row">
                        <div class="col-sm-10">
                            <h3><?= htmlspecialchars($post->getTitle()); ?></h3>
                            <i class="fa fa-user fa-fw"></i> <em><?= htmlspecialchars($post->getAuthor()); ?>
                            <i class="fa fa-clock-o fa-fw"></i> Ajouté le <?= date_format(date_create($post->getPublishedAt()), 'd/m/Y à H:i'); ?></em>
                            <?php if (!empty($post->getUpdatedAt())) : ?>
                                <em>et modifié le <?= date_format(date_create($post->getUpdatedAt()), 'd/m/Y à H:i'); ?></em>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-2 indexAdmin">
                            <a class="btn btn-default" href="post-<?= $post->getId(); ?>">Voir plus</a>
                        </div>  
                    </div><hr />
                <?php endforeach; ?>
            </div>
        </div>

        <!-- COMMENTS -->
        <div class="panel panel-default hidden-xs">
            <div class="panel-heading">
                <i class="fa fa-comments fa-fw"></i> Liste des commentaires
            </div>
            <div class="panel-body">
                <?php foreach ($comments as $comment) : ?>
                    <div class="row">
                        <div class="col-sm-10">
                            Publié sur l'article : 
                            <?php foreach ($posts as $post) : ?>
                                <?php if ($comment->getPostId() == $post->getId()) : ?>
                                    <a href="post-<?= $post->getId(); ?>"><?= htmlspecialchars($post->getTitle()); ?></a>
                                <?php endif; ?>
                            <?php endforeach; ?><br />
                            <i class="fa fa-user fa-fw"></i> <em><?= htmlspecialchars($comment->getAuthor()); ?></em>
                            <i class="fa fa-clock-o fa-fw"></i> Ajouté le <?= date_format(date_create($comment->getCommentDate()), 'd/m/Y à H:i'); ?>
                        </div>
                        <div class="col-sm-2 indexAdmin">
                            <a class="btn btn-default" href="listComments">Voir plus</a>
                        </div>
                    </div><hr />    
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="col-sm-4 col-xs-12">
        <!-- NOTIFICATIONS -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw"></i> Notifications
                </div>
                <div class="panel-body">
                    <?php if (!empty($newComments)) : ?>
                        <a href="listComments" style="color:red;">
                            <?= $newComments; ?> nouveau(x) commentaire(s) à valider !
                        </a>
                    <?php else: ?>
                        <p>Aucune nouvelle notification.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- CATEGORIES -->
            <div class="panel panel-default hidden-xs">
                <div class="panel-heading">
                    <i class="fa fa-tags fa-fw"></i> Liste des catégories
                </div>
                <div class="panel-body indexAdmin">
                    <?php foreach ($categories as $category) : ?>
                        <h3 class="text-center"> <?= htmlspecialchars($category->getName()); ?></h3>
                    <?php endforeach; ?>
                    <a class="btn btn-default" href="listCategories">Voir plus</a>
                </div>
            </div>
        </div>
    </div>
</div>  
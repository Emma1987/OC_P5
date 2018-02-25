<?php foreach ($listPosts as $post) : ?>
    <div class="panel panel-default list-posts">
        <div class="panel-heading">
            <h3><a href="post-<?= $post->getId(); ?>"><?php echo htmlspecialchars($post->getTitle()); ?></a></h3>
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
                <div class="col-sm-9">
                    <i class="fa fa-user fa-fw"></i> <em><?= htmlspecialchars($post->getAuthor()); ?> <i class="fa fa-clock-o fa-fw"></i> Dernière modification le <?php echo date_format(date_create($post->getLastDate()), 'd/m/Y à H:i'); ?></em><hr />
                    <p><?= nl2br(htmlspecialchars($post->getPreface())); ?></p>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

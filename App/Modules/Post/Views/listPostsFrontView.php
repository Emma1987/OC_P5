<h1 class="text-center toHide"><?= $title; ?></h1>
<hr class="star-primary toHide">

<?php foreach ($listPosts as $post) : ?>
    <div class="panel panel-default list-posts">
        <div class="panel-heading">
            <h2><a href="post-<?= $post->getId(); ?>"><?= htmlspecialchars($post->getTitle()); ?></a></h2>
        </div>
        <div class="panel-body">
            <div class="row">
                <!-- IMAGE -->
                <div class="col-sm-3 col-xs-12 listPostsImage">
                    <?php if (!empty($postImage[$post->getId()])) : ?>
                        <img src="<?= '/Web/uploads/img/' . $postImage[$post->getId()]; ?>" class="img-responsive" alt="<?= $postImage[$post->getId()]; ?>" />
                    <?php else: ?>
                        <img src="/Web/uploads/img/noimage.png" alt="No Image" />    
                    <?php endif; ?>
                </div>
                <div class="col-sm-9 col-xs-12">
                    <em><i class="fa fa-user fa-fw"></i> <?= htmlspecialchars($post->getAuthor()); ?> 
                        <i class="fa fa-clock-o fa-fw"></i> Dernière modification le <?= date_format(date_create($post->getLastDate()), 'd/m/Y à H:i'); ?></em><hr />
                    <p><?= nl2br(htmlspecialchars($post->getPreface())); ?></p>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
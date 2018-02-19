<?php $title = 'Liste des commentaires'; ?>

<div class="content">

    <h1 class="text-center">Liste des commentaires</h1>
    <hr class="star-primary">

    <?php
    foreach ($comments as $comment)
    {
    ?>
        <div class="panel panel-default listPosts">
            <div class="panel-heading">
                <p>Publié sur l'article : 
                <?php
                foreach ($posts as $post)
                {
                    if ($comment->getPostId() == $post->getId())
                    {
                    ?>
                        <a href="post-<?= $post->getId(); ?>"><?php echo htmlspecialchars($post->getTitle()); ?></a>
                    <?php   
                    }
                }  
                ?></p>
            </div>
            <div class="panel-body">
                <p><i class="fa fa-user fa-fw"></i> <?= htmlspecialchars($comment->getAuthor()); ?> a posté ce commentaire le <em><?php echo date_format(date_create($comment->getCommentDate()), 'd/m/Y à H:i'); ?></em></p>
                <p><?= nl2br(htmlspecialchars($comment->getCommentContent())); ?></p>

                <?php
                if ($comment->getOnline() == false)
                {
                ?>
                    <div class="btn btn-default">
                        <a href="validateComment-<?= $comment->getId(); ?>">Valider le commentaire</a>
                    </div>
                <?php
                }
                ?>
                <div class="btn btn-default">
                    <a href="deleteComment-<?= $comment->getId(); ?>">Supprimer ce commentaire</a>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

</div>

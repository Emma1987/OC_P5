<?php $title = 'Liste des commentaires'; ?>

<?php ob_start(); ?>

    <h1>Liste des commentaires</h1>

    <?php
    foreach ($comments as $comment)
    {
    ?>
        <div class="comments">
            <h3>Publié par <?php echo htmlspecialchars($comment->getAuthor()); ?></h3> sur l'article 
            <?php 
            $post = $postManager->getPostById($comment->getPostId());
            if (!empty($post))
            {
                echo htmlspecialchars($post->getTitle()); 
            }
            ?> 
            <em>Le <?php echo date_format(date_create($comment->getCommentDate()), 'd/m/Y à H:i'); ?></em>

            <p><?= nl2br(htmlspecialchars($comment->getCommentContent())); ?></p>
        </div>
        <div class="validateComments">
        <?php
            if ($comment->getOnline() == FALSE)
            {
            ?>
                <a href="index.php?action=validateComment&id=<?= $comment->getId(); ?>">Valider le commentaire</a>
            <?php
            }
            ?>
        </div>
        <div class="deleteComments">
            <a href="index.php?action=deleteComment&id=<?= $comment->getId(); ?>">Supprimer ce commentaire</a>
        </div>
    <?php
    }
    ?>

<?php $content = ob_get_clean(); ?>

<?php require(__DIR__ . '/../layout.php'); ?>
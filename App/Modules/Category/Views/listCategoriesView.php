<?php $title = 'Liste des catégories'; ?>

    <h1>Liste des catégories</h1>

    <?php
    if (empty($categories))
    {
        echo 'Aucune catégorie';
    }
    else {
        foreach ($categories as $category)
        {
        ?>
        <div class="btn-group" role="group" aria-label="...">
            <div class="btn btn-default">
                <i class="glyphicon glyphicon-tag"></i>
                <?= htmlspecialchars($category->getName()); ?>
            </div>
            <div class="btn btn-default">
                <a href="removeCategory-<?= $category->getId(); ?>" >X</a><br />
            </div> 
        </div>
        <br />         
        <?php
        }
    }
    ?>

    <p>Ajoutez une nouvelle catégorie :</p>
    <form method="post" action="addCategory">
        <input type="text" name="newCategory" />
        <input type="submit" value="Valider" />
    </form>

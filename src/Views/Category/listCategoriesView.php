<div class="row">
    <div class="col-md-5 col-xs-12 textAlignRight">
        <h3>Catégories enregistrées :</h3>
        <?php if (empty($categories)) : ?>
            <p>Aucune catégorie</p>
        <?php else: ?>
            <?php foreach ($categories as $category) : ?>
                <div class="btn-group" role="group">
                    <div class="btn btn-default list-categories noClic">
                        <i class="glyphicon glyphicon-tag"></i> <?= htmlspecialchars($category->getName()); ?>
                    </div>
                    <a class="btn btn-default" data-toggle="tooltip" data-placement="right" title="Supprimer cette catégorie" href="removeCategory-<?= $category->getId(); ?>" >
                        <i class="fa fa-close fa-fw"></i>
                    </a>
                </div><br />
            <?php endforeach; ?>
        <?php endif; ?> 
    </div>

    <div class="col-md-offset-2 col-md-5 col-xs-12 textAlign">
        <h3>Nouvelle catégorie :</h3>
        <form method="post" action="addCategory">
            <input class="form-control widthControl" type="text" name="newCategory" />
            <input class="btn btn-success validButton" type="submit" value="Valider" />
        </form> 
    </div>
</div>
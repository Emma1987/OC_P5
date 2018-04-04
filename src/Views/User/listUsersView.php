<div class="listUsers">
    <?php foreach ($users as $user) : ?>
        <div class="row">
            <div class="col-xs-12" style="padding-bottom:20px;">
                <div class="col-md-3">
                    <i class="fa fa-user fa-fw"></i> <?= htmlspecialchars($user->getUsername()); ?>
                </div>
                <?php if ($user->getRole() == 0) : ?>
                    <div class="col-md-9">
                        <button class="btn btn-default noClic">Compte en attente de confirmation par l'utilisateur</button>
                    </div>
                <?php elseif ($user->getRole() == 1) : ?>
                    <div class="col-md-3 addPadding">
                        <button class="btn btn-default noClic">ROLE : Visiteur</button>
                    </div>
                    <div class="col-md-3 addPadding">
                        <form method="post" action="setRole-<?= $user->getId(); ?>-<?= $user->getRole(); ?>">
                            <button class="btn btn-default">
                                <i class="glyphicon glyphicon-edit"></i> Passer administrateur
                            </button>
                        </form>
                    </div>
                    <div class="col-md-3 addPadding">
                        <a class="btn btn-danger" data-toggle="modal" data-target="#deleteConfirmation">
                            <i class="glyphicon glyphicon-trash"></i> Supprimer
                        </a>
                    </div>
                <?php elseif ($user->getRole() == 2) : ?>
                    <div class="col-md-3 addPadding">
                        <button class="btn btn-default noClic">ROLE : Administrateur</button>
                    </div>
                    <div class="col-md-3 addPadding">
                        <form method="post" action="setRole-<?= $user->getId(); ?>-<?= $user->getRole(); ?>">
                            <button class="btn btn-default">
                                <i class="glyphicon glyphicon-edit"></i> Passer visiteur
                            </button>
                        </form>
                    </div>
                    <div class="col-md-3 addPadding">
                        <a class="btn btn-danger" data-toggle="modal" data-target="#deleteConfirmation">
                            <i class="glyphicon glyphicon-trash"></i> Supprimer
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- MODAL DELETE CONFIRM -->
<div class="modal fade" id="deleteConfirmation" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="modal-title" id="myModalLabel">Confirmation</h2>
            </div>
            <div class="modal-body">
                <p>Confirmez vous la suppression de cet utilisateur ?</p>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Annuler
                    </button>
                    <button type="button" class="btn btn-default">
                        <a href="deleteUser-<?= $user->getId(); ?>">Supprimer</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
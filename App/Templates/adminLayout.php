<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Porfolio personnel d'Emmanuelle Mercadal, développeuse d'application PHP / Symfony">
        <meta name="author" content="E Mercadal">
        <link rel="shortcut icon" href="../Web/uploads/portfolio/logo.ico">

        <title><?= $title ?></title>

        <!-- Custom Font -->
        <link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
        <link href="../Web/style/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- Bootstrap Core CSS -->
        <link href="../Web/style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="../Web/style/css/startmin.css" rel="stylesheet">
        <link href="../Web/style/css/admin.css" rel="stylesheet" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <div id="wrapper">
            <!-- TOP NAV -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Emmanuelle Mercadal</a>
                </div>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <ul class="nav navbar-nav navbar-left navbar-top-links">
                    <li><a href="/" target="_blank"><i class="fa fa-home fa-fw"></i> Website</a></li>
                </ul>
                <ul class="nav navbar-right navbar-top-links">
                    <li class="dropdown">
                        <?php if (empty($userLogged)) : ?>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user fa-fw"></i> Bonjour, <?= $userLogged->getUsername(); ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="/logout"><i class="fa fa-sign-out fa-fw"></i> Se déconnecter</a></li>
                            </ul>
                        <?php else: ?>
                            <p>Comment êtes vous arrivé ici ?!</p>
                        <?php endif; ?>
                    </li>
                </ul>

                <!-- SIDEBAR NAV -->
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search hidden-xs">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Rechercher...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </li>
                            <li><a href="/admin/"><i class="fa fa-dashboard fa-fw"></i> Tableau de bord</a></li>
                            <li><a href="#"><i class="fa fa-file-text-o fa-fw"></i> Articles<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="/admin/listPosts">Tous les articles</a></li>
                                    <li><a href="/admin/addPost">Ajouter un article</a></li>
                                </ul>
                            </li>
                            <li><a href="/admin/listComments"><i class="fa fa-comment-o fa-fw"></i> Commentaires</a></li>
                            <li><a href="/admin/listCategories"><i class="fa fa-tags fa-fw"></i> Catégories</a></li>
                            <li><a href="/admin/listUsers"><i class="fa fa-user-md fa-fw"></i> Utilisateurs</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- DASHBORD -->
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tableau de bord</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?= $adminPosts; ?></div>
                                        <div>Article(s)</div>
                                    </div>
                                </div>
                            </div>
                            <a href="/admin/listPosts">
                                <div class="panel-footer">
                                    <span class="pull-left">Voir plus</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-files-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?= $adminComments; ?></div>
                                        <div>Commentaire(s)</div>
                                    </div>
                                </div>
                            </div>
                            <a href="/admin/listComments">
                                <div class="panel-footer">
                                    <span class="pull-left">Voir plus</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>  
                    </div>
                    <div class="col-sm-3">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tags fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?= $adminCategories ?></div>
                                        <div>Catégorie(s)</div>
                                    </div>
                                </div>
                            </div>
                            <a href="/admin/listCategories">
                                <div class="panel-footer">
                                    <span class="pull-left">Voir plus</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?= $adminUsers ?></div>
                                        <div>Utilisateur(s)</div>
                                    </div>
                                </div>
                            </div>
                            <a href="/admin/listUsers">
                                <div class="panel-footer">
                                    <span class="pull-left">Voir plus</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CONTENT -->
                <div class="content">
                    <h2 class="text-center"><?= $title ?></h2><hr />

                    <?php if ($session->hasFlashes()): ?>
                        <?php foreach ($session->getFlash() as $key => $value): ?>
                            <div class="alert alert-<?= $key; ?>">
                                <?= $value; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?= $content ?>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="../Web/style/js/jquery.min.js"></script>

        <!-- Plugin JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../Web/style/bootstrap/js/bootstrap.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../Web/style/js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../Web/style/js/startmin.js"></script>

        <!-- Tooltip -->
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>

    </body>
</html>

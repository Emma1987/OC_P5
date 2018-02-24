<!DOCTYPE html>
<html xmlns:og="http://ogp.me/ns#">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Porfolio personnel d'Emmanuelle Mercadal, développeuse d'application PHP / Symfony">
    <meta name="author" content="E Mercadal">
    <link rel="shortcut icon" href="Web/uploads/portfolio/logo.ico">

    <title><?= $title ?></title>
    <!-- Open Graph -->
    <meta property="og:url"     content="https://e-mercadal.com" />
    <meta property="og:title"   content="Mon portfolio personnel" />
    <meta property="og:description" content="Mon porfolio personnel. Emmanuelle Mercadal, développeuse d'application PHP / Symfony" />
    <meta property="og:image"   content="Web/uploads/portfolio/Portfolio.png" />

    <!-- Bootstrap Core CSS -->
    <link href="Web/style/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="Web/style/css/freelancer.min.css" rel="stylesheet">
    <link href="Web/style/css/style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="Web/style/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <!-- NAVIGATION
    ============================================================ -->
    <header id="page-top">
        <div class="nav"> <!-- Navigation -->
            <div class="row">
                <div class="col-sm-4 name">Emmanuelle Mercadal</div>
                <div class="col-sm-8 hidden-xs">
                    <ul class="pull-right">
                        <li><a href="/">ACCUEIL</a></li>
                        <li><a href="listPosts">ARTICLES</a></li>
                        <li><a href="contact">CONTACT</a></li>
                        <li class="dropdown drop-menu">
                            <?php if (!empty($_SESSION['auth'])): ?>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-user fa-fw"></i> <?= $_SESSION['auth']->getUsername() ?> <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel">
                                    <li><a href="/admin/"><i class="fa fa-gear fa-fw"></i> Administration</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="logout"><i class="fa fa-sign-out fa-fw"></i> Se déconnecter</a></li>
                                </ul>
                            <?php else: ?>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-gear fa-fw"></i> Connexion <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel">
                                <li><a href="login"><i class="fa fa-sign-out fa-fw"></i> Se connecter</a></li>
                            </ul>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <div class="col-xs-12 subMenu hidden-sm hidden-md hidden-lg">
        <ul class="nav nav-pills">
            <li role="presentation" class="dropdown">
                <a class="dropdown-toggle btn btn-primary" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    Menu de navigation <span class="caret pull-right"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/">Accueil</a></li>
                    <li><a href="listPosts">Articles</a></li>
                    <li><a href="contact">Contact</a></li>
                    <li role="separator" class="divider"></li>
                    <li class="dropdown drop-menu">
                        <?php if (!empty($_SESSION['auth'])): ?>
                            <li disabled="disabled" class="text-center"><i class="fa fa-user fa-fw"></i> <?= $_SESSION['auth']->getUsername() ?></li>
                            <li><a href="/admin/"><i class="fa fa-gear fa-fw"></i> Administration</a></li>
                            <li><a href="logout"><i class="fa fa-sign-out fa-fw"></i> Se déconnecter</a></li>
                        <?php else: ?>
                            <li disabled="disabled"><i class="fa fa-gear fa-fw"></i> Connexion <b class="caret"></b></li>
                            <li><a href="login"><i class="fa fa-sign-out fa-fw"></i> Se connecter</a></li>
                        <?php endif; ?>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

    <!-- CONTENT
    ============================================================ -->
    <div class="<?= $contentClass; ?>">

        <?php if ($session->hasFlashes()): ?>
            <?php foreach ($session->getFlash() as $key => $value): ?>
                <div class="alert alert-<?= $key; ?>">
                    <?= $value; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?= $content ?>
    </div>


    <div class="footer-below">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">Tous droits réservés &copy; 2018 - Emmanuelle Mercadal</div>
                <div class="col-lg-8" style="text-align:right;">
                    <a href="mentions-legales">Mentions légales</a>
                    <a href="/admin/">Administration</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll hidden-lg hidden-md">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- jQuery -->
    <script src="Web/style/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="Web/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="Web/style/js/jqBootstrapValidation.js"></script>
    <script src="Web/style/js/contact_me.js"></script>

    <!-- Theme Javascript -->
    <script src="Web/style/js/freelancer.min.js"></script>

    <!-- Font Awesome Icons -->
    <script src="https://use.fontawesome.com/7e4495273a.js"></script>
</body>
</html>
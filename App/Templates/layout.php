<!DOCTYPE html>
<html xmlns:og="http://ogp.me/ns#">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="" />
        <title><?= $title ?></title>
        <meta name="description" content="">

        <!-- Open Graph -->
        <meta property="og:url"		content="" />
        <meta property="og:type"	content="" />
        <meta property="og:title"	content="" />
        <meta property="og:description" content="" />
        <meta property="og:image"	content="" />

        <!-- Theme CSS -->
        <link rel="stylesheet" href="Web/css/freelancer.css" />
        <link rel="stylesheet" href="Web/style.css" />

        <!-- Bootstrap Core CSS -->
        <link href="Web/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="Web/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

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
        <header>
        <div class="nav"> <!-- Navigation -->
            <div class="row">
                <div class="col-sm-4 col-xs-12 name">Emmanuelle Mercadal</div>
                <div class="col-sm-8 col-xs-12">
                    <ul class="pull-right">
                        <li><a href="/">ACCUEIL</a></li>
                        <li><a href="listPosts">ARTICLES</a></li>
                        <li><a href="#">CONTACT</a></li>
                        <li class="dropdown drop-menu">
                            <?php
                            if (!empty($_SESSION['auth']))
                            {
                            ?>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-user fa-fw"></i> <?= $_SESSION['auth']->getUsername() ?> <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel">
                                    <li><a href="/admin/">Administration</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="logout"><i class="fa fa-sign-out fa-fw"></i> Se déconnecter</a></li>
                                </ul>
                            <?php
                            } else {
                                ?>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-gear fa-fw"></i> Connexion <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel">
                                <li><a href="login"><i class="fa fa-sign-out fa-fw"></i> Se connecter</a></li>
                            </ul>
                            <?php
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

        <!-- CONTENT
        ============================================================ -->
        <?php if ($session->hasFlashes()): ?>
            <?php foreach ($session->getFlash() as $key => $value): ?>
                <div class="alert alert-<?= $key; ?>">
                    <?= $value; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?= $content ?>


        <!-- FOOTER
        ============================================================ -->
        <footer class="text-center">
            <div class="footer-above">
                <div class="container">
                    <div class="row">
                        <div class="footer-col col-md-4"></div>
                        <div class="footer-col col-md-4">
                            <h3>Restons en contact</h3>
                            <ul class="list-inline">
                                <li>
                                    <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="footer-col col-md-4"></div>
                    </div>
                </div>
            </div>
            <div class="footer-below">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            Copyright &copy; Your Website 2016
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
        <div class="scroll-top page-scroll hidden-lg hidden-md">
            <a class="btn btn-primary" href="#page-top">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>

        <!-- jQuery -->
        <script src="Web/vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="Web/vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Plugin JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

        <!-- Theme Javascript -->
        <script src="Web/js/freelancer.min.js"></script>

        <!-- Font Awesome Icons -->
        <script src="https://use.fontawesome.com/7e4495273a.js"></script>

    </body>
</html>
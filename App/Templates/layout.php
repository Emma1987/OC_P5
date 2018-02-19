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
            <div class="row header-nav">
                <div class="col-sm-3 header-content" id="page-top">Emmanuelle MERCADAL</div>
                <div class="col-sm-9 header-content">
                    <ul>
                        <li><a href="/">Accueil</a></li>
                        <li><a href="listPosts">Liste des posts</a></li>
                        <li><a href="addPost">Ajouter un post</a></li>
                        <li><a href="listComments">Liste des commentaires</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- CONTENT
        ============================================================ -->
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
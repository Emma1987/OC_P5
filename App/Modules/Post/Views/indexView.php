<!-- BACKGROUND IMAGE -->
<div class="backgroundHomeImage hidden-xs">
</div>

<!-- CONTENT -->
<div class="panel panel-default introduction">
    <p>Bonjour, je m'appelle Emmanuelle.</p>
    <p>J'aime les voitures, le Mocca Blanc de chez Starbucks, 
    mais ce que j'aime vraiment, c'est vous aider à concrétiser vos projets !</p>
</div>

<section id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2>Dernières réalisations</h2>
                <hr class="star-primary">
            </div>
        </div>

        <div class="row">
            <?php foreach ($posts as $post) : ?>
                <div class="col-sm-4 col-xs-12 portfolio-item">
                    <a href="post-<?= $post->getId(); ?>" class="portfolio-link">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                                <p class="text-center"><?= $post->getTitle(); ?></p>
                            </div>
                        </div>
                        <!-- IMAGE -->
                        <?php if (!empty($postImage[$post->getId()])) : ?>
                            <div class="divImage">
                                <img src="<?= '/Web/uploads/img/' . $postImage[$post->getId()]; ?>" alt="<?= $postImage[$post->getId()]; ?>" />
                            </div>
                        <?php endif; ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

    <!-- CONTACT
============================================================ -->
<!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
<!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
<section id="contact">
    <div class="col-lg-12 text-center">
        <h2 class="text-center">Contactez-moi</h2>
        <hr class="star-primary">
    </div>
    <div class="row">
        <div class="col-sm-offset-2 col-sm-8">
            <form method="post" action="contactForm" role="form">
                <div class="list-group-item">
                    <div class="form-group">
                        <label for="firstname">Nom</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input class="form-control" type="text" id="firstname" name="firstname" placeholder="Votre nom" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Prénom</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user-md fa-fw"></i></span>
                            <input class="form-control" type="text" id="lastname" name="lastname" placeholder="Votre prénom" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <div class="input-group">
                            <span class="input-group-addon">@</span>
                            <input class="form-control" type="text" id="email" name="email" placeholder="Votre mail" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" name="message" id="message" rows="6"></textarea>
                    </div>
                    <input type="submit" class="btn btn-success homeButton" value="Envoyer" />
                </div>
            </form>
        </div>
    </div>
</section>

    <!-- FOOTER
============================================================ -->
<footer class="text-center">
    <div class="footer-above">
        <div class="container">
            <div class="row">
                <div class="footer-col col-sm-12">
                    <h2>Restons en contact</h2>
                    <ul class="list-inline">
                        <li>
                            <a href="https://www.linkedin.com/in/emmanuelle-mercadal-677448105/" target="_blank" class="btn-social btn-outline">
                                <i class="fa fa-fw fa-linkedin"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://github.com/Emma1987" target="_blank" class="btn-social btn-outline">
                                <i class="fa fa-fw fa-github-alt"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline">
                                <i class="fa fa-fw fa-skype"></i>
                            </a>
                        </li>
                        <li>
                            <a href="Web/uploads/E.Mercadal_CV.pdf" target="_blank" class="btn-social btn-outline">CV</a>
                        </li>
                    </ul>
                </div>
                </div>
            </div>
        </div>
    </div>
</footer>

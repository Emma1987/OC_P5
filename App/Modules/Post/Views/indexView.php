<?php $title = 'Emmanuelle Mercadal'; ?>

<div class="home-content">
    <p class="introduction">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>

    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Mes réalisations</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
            <?php
            foreach ($posts as $post)
            {
            ?>
                <div class="col-sm-4 portfolio-item">
                    <a href="post-<?= $post->getId(); ?>" class="portfolio-link">
                        <div class="caption">
                            <div class="caption-content">

                                <i class="fa fa-search-plus fa-3x"></i>
                                <p><?= $post->getTitle(); ?></p>
                            </div>
                        </div>
                        <img src="Web/img/portfolio/cake.png" class="img-responsive" alt="">
                    </a>
                </div>
            <?php
            }
            ?>
            </div>
        </div>
    </section>
</div>

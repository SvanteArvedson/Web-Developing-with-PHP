<?php include(dirname(__FILE__).'/slots/head.php'); ?>

<div class="hide-for-large">
    <div class="off-canvas-wrap" data-offcanvas>
        <div class="inner-wrap">
            <a id="toggle" class="right-off-canvas-toggle" href="#"><img src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/img/toggleMenu.png" /></a>
            <nav class="right-off-canvas-menu">
                <?php include(dirname(__FILE__).'/slots/menu.php'); ?>
            </nav>
            <div class="container">
                <div class="row">
                    <header class='small-8 medium-5 large-4 small-centered columns'>
                        <?php include(dirname(__FILE__) . '/slots/logo.php'); ?>
                    </header>
                </div>
                <div id="content">
                    <div class="row">
                        <div class="text-centered panel radius small-12 columns">
                            <h1><?php echo $user -> getUsername(); ?></h1>
                        </div>
                        <div class="small-12 columns">
                            <div class="text-centered">
                                <h2>Resultat</h2>
                                <ul class="presentation-list">
                                    <li>
                                        resultat
                                    </li>
                                    <li>
                                        resultat
                                    </li>
                                </ul>
                            </div>
                            <div class="text-centered">
                                <h2>Kurser</h2>
                                <ul class="presentation-list">
                                    <li>
                                        kurs
                                    </li>
                                    <li>
                                        kurs
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="exit-off-canvas"></a>
        </div>
    </div>
</div>
<div class="show-for-large">
    <div class="container">
        <div class="row">
            <div class="large-9 columns">
                <div class="row">
                    <div class="text-centered panel radius small-12 columns">
                        <h1><?php echo $user -> getUsername(); ?></h1>
                    </div>
                    <div class="text-centered large-6 columns">
                        <h2>Resultat</h2>
                        <ul class="presentation-list">
                            <li>
                                resultat
                            </li>
                            <li>
                                resultat
                            </li>
                        </ul>
                    </div>
                    <div class="text-centered large-6 columns">
                        <h2>Kurser</h2>
                        <ul class="presentation-list">
                            <li>
                                kurs
                            </li>
                            <li>
                                kurs
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="large-3 columns">
                <div class="row">
                    <header class='large-12 columns'>
                        <?php include(dirname(__FILE__) . '/slots/logo.php'); ?>
                    </header>
                    <nav class="large-12 columns">
                        <?php include(dirname(__FILE__).'/slots/menu.php'); ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
                
<?php include(dirname(__FILE__).'/slots/foot.php'); ?>
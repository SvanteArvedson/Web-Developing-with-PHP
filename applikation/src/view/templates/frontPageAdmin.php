<?php include (dirname(__FILE__) . '/slots/head.php'); ?>

<div class="off-canvas-wrap" data-offcanvas>
    <div class="inner-wrap">
        <a id="toggle" class="hide-for-large right-off-canvas-toggle" href="#"><img src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/img/toggleMenu.png" /></a>
        <nav class="right-off-canvas-menu">
            <?php include (dirname(__FILE__) . '/slots/menu.php'); ?>
        </nav>
        <div class="container">
            <div class=" hide-for-large">
                <div class="row">
                    <header class='small-8 medium-5 large-4 small-centered columns'>
                        <?php include (dirname(__FILE__) . '/slots/logo.php'); ?>
                    </header>
                </div>
            </div>
            <div id="content">
                <div class="row">
                    <div class="small-12 large-9 columns">
                        <div class="row">
                            <div class="text-centered panel radius small-12 columns">
                                <h1><?php echo $user -> getUsername(); ?> - Administratörsvy</h1>
                            </div>
                            <div class="small-12 columns">
                                <ul class="text-centered">
                                    <li>
                                        <a href="#">Administratörskommando</a>
                                    </li>
                                    <li>
                                        <a href="#">Administratörskommando</a>
                                    </li>
                                    <li>
                                        <a href="#">Administratörskommando</a>
                                    </li>
                                    <li>
                                        <a href="#">Administratörskommando</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="show-for-large large-3 columns">
                        <div class="row">
                            <header class='large-12 columns'>
                                <?php include (dirname(__FILE__) . '/slots/logo.php'); ?>
                            </header>
                            <nav class="large-12 columns">
                                <?php include (dirname(__FILE__) . '/slots/menu.php'); ?>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="exit-off-canvas"></a>
    </div>
</div>
             
<?php include (dirname(__FILE__) . '/slots/foot.php'); ?>
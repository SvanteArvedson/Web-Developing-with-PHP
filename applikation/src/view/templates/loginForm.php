<?php include(dirname(__FILE__) . '/slots/head.php'); ?>
    
<div class='container'>
    <div class='row'>
        <header class='small-8 medium-5 large-4 small-centered columns'>
            <?php include(dirname(__FILE__) . '/slots/logo.php'); ?>
        </header>
    </div>
    <div id='content'>
        <div class='row'>
            <form action='<?php echo $_SERVER['PHP_SELF'].'?'.\view\Action::KEY.'='.\view\Action::LOGIN; ?>' method='post' class='small-10 medium-6 large-4 small-centered columns'>
                
                <?php if($errorMessage !== null) { include(dirname(__FILE__) . '/slots/error.php'); } ?>
                
                <input class='radius' name='<?php echo \view\FrontPage::$nameUsername; ?>' type='text' placeholder='Användarnamn' autofocus='autofocus' />
                <input class='radius' name='<?php echo \view\FrontPage::$namePassword; ?>' type='password' placeholder='Lösenord' />
                <input class='button tiny radius expand' type='submit' value='Logga in' />
            </form>
        </div>
    </div>
</div>

<?php include(dirname(__FILE__) . '/slots/foot.php'); ?>
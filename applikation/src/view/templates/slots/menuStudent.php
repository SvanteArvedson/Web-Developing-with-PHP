<?php namespace view; ?>

<ul class="side-nav">
    <li>
        <a class="text-centered" href="<?php echo $_SERVER['PHP_SELF']; ?>">Startsidan</a>
    </li>
    <li>
        <a class="text-centered" href="<?php echo $_SERVER['PHP_SELF'].'?'.\view\Action::KEY.'='.\view\Action::SHOW_COURSES; ?>">Mina kurser</a>
    </li>
    <li>
        <a class="text-centered" href="<?php echo $_SERVER['PHP_SELF'].'?'.\view\Action::KEY.'='.\view\Action::LOGOUT; ?>">Logga ut</a>
    </li>
</ul>
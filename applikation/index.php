<?php

require_once 'src/controller/Program.php';

set_time_limit(0);

$program = new \controller\Program();
$program->run();
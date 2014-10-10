<?php

require_once 'src/controller/Program.php';

/*
foreach ($_SERVER as $key => $value) {
	echo "<p>$key => $value</p>";
}
die();
*/

$program = new \controller\Program();
$program->run();

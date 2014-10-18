<?php

$path = dirname(__FILE__)."/unit/";
$testFiles = scandir($path);

foreach ($testFiles as $testFile) {

	if (strpos($testFile, 'Test') === 0) {

	    require_once($path . $testFile);
        $testName = "\\test\\".substr($testFile, 0, strlen($testFile) - 4);

        $r = new ReflectionClass($testName);
        $testClass = $r -> newInstanceWithoutConstructor();

        $testClass->run();

	}
}

echo "All tests done!";
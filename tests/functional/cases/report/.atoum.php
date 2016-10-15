<?php

$runner->addTestsFromDirectory(__DIR__ . '/test');

$xunit = new \mageekguy\atoum\reports\sonar\xunit();
$writer = new \mageekguy\atoum\writers\file('./sonar-xunit.xml');
$xunit->addWriter($writer);
$runner->addReport($xunit);

$clover = new \mageekguy\atoum\reports\sonar\clover();
$writer = new \mageekguy\atoum\writers\file('./sonar-clover.xml');
$clover->addWriter($writer);
$runner->addReport($clover);

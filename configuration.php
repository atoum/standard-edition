<?php

$composerFile = new \mageekguy\atoum\standard_edition\composer\file(__DIR__ . '/../../../composer.json');

$telemetryEnabled = getenv('TELEMETRY_ENABLED');
if ($telemetryEnabled > 0) {
    $script->addDefaultReport();

    $telemetry = new mageekguy\atoum\reports\telemetry();
    $telemetry->addWriter(new mageekguy\atoum\writers\std\out());

    if ($composerFile->exists()) {
        if ($telemetryEnabled == 2) {
            $telemetry->readProjectNameFromComposerJson($composerFile);
            $telemetry->sendAnonymousProjectName();
        } elseif ($telemetry == 3) {
            $telemetry->readProjectNameFromComposerJson($composerFile);
        }
    }

    $runner->addReport($telemetry);
}


$xunitFile = getenv('XUNIT_REPORT_PATH');
if ($xunitFile) {
    $xunitFileDir = pathinfo($xunitFile, PATHINFO_DIRNAME);
    if (!is_dir($xunitFileDir)) {
        mkdir($xunitFileDir, 0777, true);
    }
    $xunit = new mageekguy\atoum\reports\asynchronous\xunit();
    $writer = new mageekguy\atoum\writers\file($xunitFile);
    $xunit->addWriter($writer);
    $runner->addReport($xunit);
}


$callback = function($script, $argument, $values) {
    $script->writeHelp('Available environment variables are:');
    $script->writeHelp('    TELEMETRY_ENABLED : If set, it sends information to telemetry.');
    $script->writeHelp('          More information about this on http://atoum.org/news/2016/05/17/here-comes-the-telemetry.html.');
    $script->writeHelp('          Available values are :');
    $script->writeHelp('            0 : no report will be sent (default)');
    $script->writeHelp('            1 : send report anonymously');
    $script->writeHelp('            2 : send report with your vendor name (from your composer.json file)');
    $script->writeHelp('            3 : send report with both vendor and projet name (from your composer.json file)');
    $script->writeHelp('    XUNIT_REPORT_PATH : Path to a file to write an xUnit report.');

};
$script->getArgumentsParser()->addHandler($callback, ['--help', '-h']);

if (class_exists('mageekguy\atoum\autoloop\extension') && $composerFile->exists()) {
    $runner
        ->getExtension(mageekguy\atoum\autoloop\extension::class)
        ->setWatchedFiles($composerFile->listAbsoluteAutoloadPaths())
    ;
}

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


if (class_exists('mageekguy\atoum\autoloop\extension') && $composerFile->exists()) {
    $runner
        ->getExtension(mageekguy\atoum\autoloop\extension::class)
        ->setWatchedFiles($composerFile->listAbsoluteAutoloadPaths())
    ;
}

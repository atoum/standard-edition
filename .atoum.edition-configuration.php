<?php

require_once __DIR__ . '/../../autoload.php';

$extension = new mageekguy\atoum\autoloop\extension($script);
$extension->addToRunner($runner);

$extension = new mageekguy\atoum\visibility\extension($script);
$extension->addToRunner($runner);

$runner->addExtension(new mageekguy\atoum\reports\extension($script));
$runner->addExtension(new mageekguy\atoum\config\extension($script));

$telemetryEnabled = getenv('TELEMETRY_ENABLED');
if ($telemetryEnabled > 0) {
    $script->addDefaultReport();

    $telemetry = new mageekguy\atoum\reports\telemetry();
    $telemetry->addWriter(new mageekguy\atoum\writers\std\out());

    $composerFile = __DIR__ . '/../../../composer.json';
    if (is_file($composerFile)) {
        if ($telemetryEnabled == 2) {
            $telemetry->readProjectNameFromComposerJson($composerFile);
            $telemetry->sendAnonymousProjectName();
        } elseif ($telemetry == 3) {
            $telemetry->readProjectNameFromComposerJson($composerFile);
        }
    }

    $runner->addReport($telemetry);
}

<?php

namespace mageekguy\atoum\standard_edition;

use mageekguy\atoum;
use mageekguy\atoum\scripts;

if (defined('mageekguy\atoum\scripts\runner') === true) {
    scripts\runner::addConfigurationCallable(function ($script, $runner) {
        include __DIR__ . DIRECTORY_SEPARATOR . 'configuration.php';
    });
}


atoum\autoloader::get()
    ->addNamespaceAlias('atoum\standard_edition', __NAMESPACE__)
    ->addDirectory(__NAMESPACE__, __DIR__ . DIRECTORY_SEPARATOR . 'classes')
;

<?php

use mageekguy\atoum;
use mageekguy\atoum\scripts;

if (defined('mageekguy\atoum\scripts\runner') === true) {
    scripts\runner::addAutorunnerConfigurationFile(__DIR__ . DIRECTORY_SEPARATOR . 'configuration.php');
}

# atoum standard edition [![Build Status](https://travis-ci.org/atoum/standard-edition.svg?branch=master)](https://travis-ci.org/atoum/standard-edition)

atoum standard edition is an opinionated packaging of atoum. It contains features that are not considered best practices in atoum's core, but could be usefull and used by many developpers. It is also aimed to ease the integration on ci environments and levreage the composer.json file to provide some automatic configuration.


## Install it

You just have to require `atoum/standard-edition` via composer. You don't need to install atoum manually.

```
composer require --dev atoum/standard-edition
```

## Features

* yml and php configuration for atoum,
* build-in IDE completion for your tests,
* build-in testing of protected methods,
* simplified integration in your ci environments,
* ...

See below for the full list of features.

## Detailled Features

### Features provided by extensions

For each of these features, the best is to read the documentation for each of them. Just remember they are ready to use, so you don't need to configure it in the configuration file or whatever.


* override the visibility of method to test protected methods (see [atoum/visibility-extension](https://github.com/atoum/visibility-extension))
* configure atoum via a YAML file instead of a PHP file see ([atoum/config-extension](https://github.com/jubianchi/atoum-config-extension)) (but you can continue to use the PHP file if you want a more customizable configuration)
* you IDE will provide you completion when writting your tests thanks to the [stubs](https://github.com/atoum/stubs)
* you can configure atoum to generate a branch and path coverage report thanks to [atoum/reports-extension](https://github.com/atoum/reports-extension)

### Generate an xUnit report with ease

To generate an Xunit report, add the environnement variable `XUNIT_REPORT_PATH` with the path to the xUnit file to generate as value.

If the directory were the file should be written does not exists,
il will be created.

### Participate in the Telemetry project

If you want to participate in the [telemetry project](http://atoum.org/news/2016/05/17/here-comes-the-telemetry.html), you just need to set the `TELEMETRY_ENABLED` environnment variable.

You can set multiple values
* 0 : no report will be sent (default)
* 1 : send report anonymously
* 2 : send report with your vendor name (from your composer.json file)
* 3 : send report with both vendor and projet name (from your composer.json file)

### Automatic configuration of the autoloop extension

If the autoloop extension is installed, files/folders defined in the autoload section of your composer.json file will be automaticly watch.

You must manually install the [autoloop extension](https://github.com/atoum/autoloop-extension) (because some of its dependancies may cause conflicts on your project).


## Links

* [atoum](http://atoum.org)
* [atoum's documentation](http://docs.atoum.org)
* [atoum-config-extension](https://github,.com/jubianchi/atoum-config-extension)
* [atoum-reports-extension](https://github.com/atoum/reports-extension)
* [atoum-visibility-extension](https://github.com/atoum/visibility-extension)
* [atoum stubs](https://github.com/atoum/stubs)
* [atoum-autoloop-extension](https://github.com/atoum/autoloop-extension)

## Licence

atoum standard edition is released under the MIT License. See the bundled LICENSE file for details.

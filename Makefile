.PHONY: install tests

install: vendor

vendor: composer.phar
	php composer.phar update $(COMPOSER_PREFER)

composer.phar:
	$(eval EXPECTED_SIGNATURE = "$(shell wget -q -O - https://composer.github.io/installer.sig)")
	$(eval ACTUAL_SIGNATURE = "$(shell php -r "copy('https://getcomposer.org/installer', 'composer-setup.php'); echo hash_file('SHA384', 'composer-setup.php');")")
	@if [ "$(EXPECTED_SIGNATURE)" != "$(ACTUAL_SIGNATURE)" ]; then echo "Invalid signature"; exit 1; fi
	php composer-setup.php
	rm composer-setup.php

tests: vendor
	./vendor/bin/atoum
	./tests/functional/launch_tests.sh

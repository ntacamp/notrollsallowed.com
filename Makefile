.PHONY: serve
serve: bootstrap
	php -S localhost:8080 web/index.php

.PHONY: boostrap
bootstrap: vendor
	php composer.phar install

composer.phar:
	curl -s https://getcomposer.org/installer | php
	touch composer.phar

vendor: composer.phar
	php composer.phar install
	touch vendor

SHELL := /bin/bash

## Fix the PHP code-style (phpcbf)
fix-phpcbf:
	./vendor/bin/phpcbf --standard=.dev/config/phpcs.xml --colors -ps || true

## Fix the PHP code-style (php-cs-fixer)
fix-cs-fixer:
	./vendor/bin/php-cs-fixer fix src --allow-risky=yes --config=.dev/config/php-cs-fixer.php || true

## Fix the PHP code statically (rector)
fix-rector:
	./vendor/bin/rector process --config=.dev/config/rector.php || true

## Validate the PHP code statically (phpstan)
stan:
	./vendor/bin/phpstan analyse --memory-limit=2G \
    	--configuration=.dev/config/phpstan.neon || true

## Run all code-style fixers
fix: fix-cs-fixer fix-phpcbf fix-rector
validate: fix stan

composer:
	composer install

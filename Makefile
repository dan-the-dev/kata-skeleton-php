.PHONY: test

install:
	docker-compose run main composer install

test:
	docker-compose run main vendor/phpunit/phpunit/phpunit

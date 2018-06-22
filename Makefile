server:
	php -S localhost:8001 -t public

unit:
	./bin/phpunit --testdox

coverage:
	./bin/phpunit --coverage-html /tmp/coverage/ && open /tmp/coverage/index.html

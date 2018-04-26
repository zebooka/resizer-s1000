
all: hooks imagick exiftool composer test install try

hooks:
	test ! -d .git || cp .git-pre-commit .git/hooks/pre-commit && chmod +x .git/hooks/pre-commit

imagick:
	convert -version

exiftool:
	exiftool -ver && \
	exiftool -ver | xargs php -r 'exit(intval(version_compare($$_SERVER["argv"][1], "9.33") < 0));'

composer:
	composer -v install --no-dev && \
	COMPOSER_VENDOR_DIR="vendor-dev" composer -v install

test:
	./tests/run.sh

install:
	./build-phar.php

try:
	./build/resizer-s1000.phar -h

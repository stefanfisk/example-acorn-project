#!/usr/bin/env bash

set -e

if [ -f "$PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini" ]; then
    echo "xdebug is already enabled."
    exit 0
fi

echo "Enabling xdebug."

docker-php-ext-enable xdebug

kill -USR2 1

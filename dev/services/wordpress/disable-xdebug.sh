#!/usr/bin/env bash

set -e

if [ ! -f "$PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini" ]; then
    echo "xdebug is already disabled."
    exit 0
fi

echo "Disabling xdebug."

rm $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini 2>/dev/null || true

kill -USR2 1

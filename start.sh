#!/bin/sh
set -e

curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

/bin/sh

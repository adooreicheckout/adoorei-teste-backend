#!/bin/sh
set -e

echo 'Starting deployment tasks ...'

./vendor/bin/sail composer update
./vendor/bin/sail php artisan key:generate
./vendor/bin/sail php artisan config:cache
./vendor/bin/sail php artisan migrate --seed

# more commands ...

echo 'Done!'


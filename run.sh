#!/bin/sh
cd /var/www
php artisan config:clear
php artisan serve --host=0.0.0.0 --port=8000

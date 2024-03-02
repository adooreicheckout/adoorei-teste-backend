# Set the base image to the official PHP 8.1 image
FROM php:8.1-fpm-alpine

# Install required PHP extensions and dependencies
RUN apk add --no-cache \
    && docker-php-ext-install pdo pdo_mysql

# Set working directory
WORKDIR /var/www

# Copy the Laravel application to the container
COPY .env.example .env
COPY . .

# Install Composer and run it to install dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install
RUN php artisan key:generate

# Set file permissions
RUN chown -R www-data:www-data storage bootstrap/cache

## Execute projectcopy ./run.sh /tmp
COPY ./run.sh /tmp
ENTRYPOINT ["/tmp/run.sh"]
EXPOSE 8000





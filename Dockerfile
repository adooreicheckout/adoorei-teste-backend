FROM php:8.2-fpm
ARG XDEBUG_VERSION=2.6.0

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/

# Install Xdebug
RUN pecl install xdebug
COPY 90-xdebug.ini "${PHP_INI_DIR}/conf.d"

# Set Timezone 
ENV TZ="America/Sao_Paulo"

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set COMPOSER_ALLOW_SUPERUSER
ENV COMPOSER_ALLOW_SUPERUSER=1

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

RUN chown -R www:www /var/www/storage
RUN chmod -R 777 /var/www/storage
RUN chmod -R 777 storage bootstrap/cache
RUN chmod -R 777 ./
RUN composer install
 
# Change current user to www
USER www
# Expose port 9000 and start php-fpm server
EXPOSE 9000
EXPOSE 9003
CMD ["php-fpm"]

FROM webdevops/php-nginx:8.1-alpine
WORKDIR /app

# ======================================== SET VARIABLES PHP
ENV WEB_DOCUMENT_ROOT /app/public
ENV APP_ENV production
ENV PHP_MEMORY_LIMIT 1024M
ENV PHP_MAX_EXECUTION_TIME 900
ENV PHP_UPLOAD_MAX_FILESIZE 100M
ENV PHP_POST_MAX_SIZE 100M
ENV FPM_PM_MAX_CHILDREN 10
ENV PHP_DISPLAY_ERRORS 1
ENV SERVICE_NGINX_CLIENT_MAX_BODY_SIZE 300M

# ======================================== UPDATE SHELL
RUN rm /bin/sh && ln -s /bin/bash /bin/sh

# ======================================== INSTALL DEPENDENCIES
RUN apk update
RUN apk add libpng libpng-dev libjpeg-turbo-dev libwebp-dev zlib-dev libxpm-dev gd libzip-dev gmp gmp-dev

RUN apk add jpeg-dev libpng-dev \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo pdo_mysql sockets
RUN docker-php-ext-install bcmath gmp

# ======================================== SET USER
RUN chown application:application /app -R && chown application:application /root -R

# ======================================== SET FILES
COPY --chown=application artisan composer.json ./
COPY --chown=application app app/
COPY --chown=application bootstrap bootstrap/
COPY --chown=application config config/
COPY --chown=application database database/
COPY --chown=application public public/
COPY --chown=application resources resources/
COPY --chown=application routes routes/
COPY --chown=application storage storage/
COPY --chown=application tests tests/

# ======================================== INSTALL COMPOSER DEPENDENCIES
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
USER application
RUN composer update
RUN composer install --no-dev && composer dumpautoload --optimize && composer clear-cache
RUN php artisan config:clear
RUN php artisan optimize
RUN php artisan optimize:clear
RUN composer dumpautoload
# ======================================== FINISH
USER root
EXPOSE 80

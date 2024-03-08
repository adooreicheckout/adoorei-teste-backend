FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip &&
    docker-php-ext-install zip pdo_mysql &&
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" &&
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer &&
    php -r "unlink('composer-setup.php');"

# Habilitar o módulo de reescrita do Apache
RUN a2enmod rewrite

# Copia os arquivos para o diretório de trabalho
COPY prj /var/www/html/

RUN cd /var/www/html && composer install
RUN cd /var/www/html && php artisan openapi:generate >openapi.json

RUN chmod -R 775 /var/www/html
RUN chown -R www-data:www-data /var/www/html

RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Define o diretório de trabalho
WORKDIR /var/www/html

# Exponha a porta 80 para o Apache
EXPOSE 80

# Comando padrão para iniciar o Apache
CMD ["apache2-foreground"]

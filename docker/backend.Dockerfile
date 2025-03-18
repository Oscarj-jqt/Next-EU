FROM php:8.3-fpm

ENV TZ=Europe/Berlin

RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    unzip \
    curl \
    && docker-php-ext-install pdo pdo_mysql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY backend .

RUN composer install --optimize-autoloader

RUN mkdir -p var/cache var/logs var/sessions && \
    chown -R www-data:www-data var/cache var/logs var/sessions

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]

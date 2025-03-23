FROM php:8.3-fpm AS builder

ENV TZ=Europe/Berlin

RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    curl

WORKDIR /var/www/html

COPY backend .

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader --no-scripts

RUN mkdir -p var/cache var/logs var/sessions

FROM php:8.3-fpm

ENV TZ=Europe/Berlin

RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    curl \
    && docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

COPY --from=builder /var/www/html .

RUN chown -R www-data:www-data var/cache var/logs var/sessions

EXPOSE ${PORT}

RUN sh -c "export $(grep -v '^#' .env.prod | xargs) && php /var/www/html/bin/console doctrine:migrations:migrate --no-interaction"

CMD ["sh", "-c", "export $(grep -v '^#' .env.prod | xargs) && php -S 0.0.0.0:${PORT} -t public"]

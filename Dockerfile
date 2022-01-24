FROM composer:latest as builder

COPY . /app
RUN composer install --optimize-autoloader --no-scripts


FROM php:8.1.2

WORKDIR /var/www/babyloans
COPY --from=builder /app /var/www/babyloans

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

CMD [ "symfony", "server:start", "--port=9000" ]
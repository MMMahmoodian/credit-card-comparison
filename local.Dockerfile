FROM webdevops/php-nginx:8.2-alpine

RUN apk add --no-cache oniguruma-dev zlib-dev libpng-dev libxml2-dev
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

#Nginx Config
COPY docker/local/nginx/conf/app.conf /opt/docker/etc/nginx/conf.d

WORKDIR /var/www/html

#Composer
COPY --from=composer:lts /usr/bin/composer /usr/local/bin/composer
COPY src/composer.* .
RUN composer install --no-interaction --optimize-autoloader --no-scripts

RUN chown -R application:application .

EXPOSE 8000
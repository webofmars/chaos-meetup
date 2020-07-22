FROM php:7.2-fpm-alpine

ENV PHP_COMPOSER_OPTIONS="--no-interaction --no-ansi"
ENV SF_FIXTURES=false
ENV APP_ENV=dev
ENV DATABASE_URL=mysql://root:root@mysql:3306/appdb/

RUN docker-php-ext-install pdo_mysql

RUN apk add --no-cache nginx && \
        mkdir /run/nginx && \
        chown -R nginx:nginx /run/nginx && \
        ln -sf /dev/stdout /var/log/nginx/access.log && \
        ln -sf /dev/stderr /var/log/nginx/error.log

RUN wget https://raw.githubusercontent.com/composer/getcomposer.org/1b137f8bf6db3e79a38a5bc45324414a6b1f9df2/web/installer -O - -q | php -- --quiet

COPY . /var/www/html
RUN mv /var/www/html/docker/symfony.conf /etc/nginx/conf.d/default.conf

RUN php ./composer.phar install $PHP_COMPOSER_OPTIONS && \
        chmod -R 777 var && \
        php bin/console assets:install

EXPOSE 80
WORKDIR /var/www/html
ENTRYPOINT ["/bin/sh", "entrypoint.sh"]
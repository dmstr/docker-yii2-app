FROM dmstr/php-yii2:7.1-fpm-3.0-beta2-alpine-nginx

WORKDIR /app

ADD composer.lock composer.json /app/
RUN composer install --prefer-dist --optimize-autoloader

ADD yii /app/
ADD ./web /app/web/
ADD ./src /app/src/
RUN cp src/app.env-dist src/app.env

RUN mkdir -p runtime web/assets && \
    chmod -R 775 runtime web/assets && \
    chown -R www-data:www-data runtime web/assets

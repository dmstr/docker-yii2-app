FROM yiisoftware/yii2-php:7.2-apache

WORKDIR /app

ADD composer.lock composer.json /app/
RUN composer install --prefer-dist --optimize-autoloader

ADD yii /app/
ADD ./config /app/config
ADD ./web /app/web/
ADD ./src /app/src/
RUN cp src/app.env-dist src/app.env

RUN mkdir -p runtime web/assets && \
    chmod -R 775 runtime web/assets && \
    chown -R www-data:www-data runtime web/assets

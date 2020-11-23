FROM php:7.3-fpm
COPY composer.lock composer.json /var/www/

RUN apt-get update -y && apt-get install -y libmcrypt-dev openssl libpq-dev libfreetype6-dev libpng-dev libjpeg62-turbo-dev jpegoptim optipng pngquant gifsicle libzip-dev

RUN docker-php-ext-install pdo pdo_pgsql zip exif pcntl
RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo pdo_pgsql
WORKDIR /app
COPY . /app
RUN composer install

CMD php artisan serve --host=0.0.0.0 --port=8000
EXPOSE 8000

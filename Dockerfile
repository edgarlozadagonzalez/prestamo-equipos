FROM php:8.0-apache
RUN apt-get update
# Install Postgre PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql
RUN a2enmod rewrite
RUN service apache2 restart
COPY ./ /var/www/html/
EXPOSE 80
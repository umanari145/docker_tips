#php+node
FROM php:7.2-apache
RUN apt-get update && \
  docker-php-ext-install pdo_mysql mysqli mbstring
RUN apt-get install zip unzip
RUN apt-get install -y \
    curl \
    gnupg
RUN curl -sL https://deb.nodesource.com/setup_11.x | bash -
RUN apt-get install -y nodejs
RUN npm install npm@latest -g
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

FROM composer:2.3.10 AS composer
FROM php:8.0.21-cli
RUN apt-get -y update && apt-get -y upgrade && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    vim \
    libpng-dev \
    supervisor \
    cron \
    htop

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /app

RUN echo "PHP_INI_DIR=$PHP_INI_DIR" >> /tmp/php_ini_dir.log
RUN cp "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
RUN echo "memory_limit=-1" >> "$PHP_INI_DIR/php.ini"

RUN echo "\n \
export LS_OPTIONS='--color=auto' \n \
alias ls='ls \$LS_OPTIONS'\n \
alias ll='ls \$LS_OPTIONS -l'\n \
alias l='ls \$LS_OPTIONS -lA'\n \
alias rm='rm -i'\n \
alias cp='cp -i'\n \
alias artisan='php artisan'\n \
alias a='php artisan'\n \
alias tt='php artisan test'\n \
alias mv='mv -i'" >> ~/.bashrc

COPY ./ops/php.sh /

CMD bash /php.sh

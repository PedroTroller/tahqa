FROM ubuntu:16.04

RUN apt-get update \
    && apt-get install -y \
        apt-transport-https \
        ca-certificates \
        curl \
        unzip \
        php7.0 \
        php7.0-curl \
    && apt-key adv --keyserver hkp://p80.pool.sks-keyservers.net:80 --recv-keys 58118E89F3A912897C070ADBF76221572C52609D \
    && echo "deb https://apt.dockerproject.org/repo ubuntu-xenial main" > /etc/apt/sources.list.d/docker.list

RUN apt-get update \
    && apt-get purge lxc-docker -y \
    && apt-get install linux-image-extra-$(uname -r) linux-image-extra-virtual -y \
    && apt-get install docker-engine -y

RUN curl -L https://github.com/docker/compose/releases/download/1.8.0/docker-compose-`uname -s`-`uname -m` > /usr/local/bin/docker-compose \
    && chmod +x /usr/local/bin/docker-compose

RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /usr/local/bin/composer \
    && composer global require hirak/prestissimo

COPY lib /app/lib

RUN (cd /app/lib/sanitizer; composer install)

WORKDIR /app

FROM ubuntu:latest
ENV DEBIAN_FRONTEND noninteractive
RUN apt-get update && apt-get install -y \
    composer \
    php \
    imagemagick \
    php-imagick \
    php-xml \
    php-curl \
    php-mbstring 


WORKDIR /usr/src/feedinkapp
COPY . .


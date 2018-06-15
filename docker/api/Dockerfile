FROM webdevops/php-apache-dev:7.1
RUN apt-get update  && apt-get install -y \
        librabbitmq-dev \
        libssh-dev \
    && pecl install amqp \
    && docker-php-ext-enable amqp

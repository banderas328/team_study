FROM php:7.2-apache
COPY memcached.php /memcached.php
RUN apt-get update && apt-get install -y libmemcached-dev zlib1g-dev \
	&& pecl install memcached-3.1.4 \
	&& docker-php-ext-enable memcached
RUN chmod +x /memcached.php
CMD [ "php", "/memcached.php" ]

#docker build -t memcached .

#docker run -p 8080:80 -d memcached
FROM php:8.1-apache

MAINTAINER robert.mueller@fatchip.de

# timezone / date
RUN echo "Europe/Berlin" > /etc/timezone && dpkg-reconfigure -f noninteractive tzdata

# install packages
RUN apt-get update -y && \
  apt-get install -y --no-install-recommends \
  less vim wget unzip dos2unix rsync git default-mysql-client libzip-dev ssl-cert sudo openssh-server \
  libcurl4-openssl-dev libfreetype6 libjpeg62-turbo libpng-dev libjpeg-dev libxml2-dev libxpm4 && \
  apt-get clean && \
  apt-get autoremove -y && \
  rm -rf /var/lib/apt/lists/* && \
  echo "export TERM=xterm" >> /root/.bashrc

#xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug \
  && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
  && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
  && echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
  && echo "xdebug.log_level=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
  && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
  && echo "xdebug.remote_handler=dbgp" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# install php extensions
RUN docker-php-ext-configure gd --with-jpeg=/usr/local/ && \
  docker-php-ext-install -j$(nproc) zip bcmath soap pdo_mysql mysqli gd

# composer stuff
RUN php -r 'readfile("https://getcomposer.org/installer");' > composer-setup.php \
  && php composer-setup.php --install-dir=/usr/local/bin --version=2.5.5 --filename=composer \
  && rm -f composer-setup.php \
  && chown www-data:www-data /var/www

# apache stuff
RUN /usr/sbin/a2enmod rewrite && /usr/sbin/a2enmod headers && /usr/sbin/a2enmod expires && /usr/sbin/a2enmod ssl

RUN ["/bin/bash", "-c", "chpasswd <<<'root:docker'"]

RUN chmod -R 777 /var/www/html

CMD ["apache2-foreground"]

FROM php:7.1-fpm

# adds a local user for compatibility
# updates the system and install main packages
RUN useradd -u 1000 local -d "/home/local" \
    && apt-get update \
    && apt-get install -y git \
    && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        apt-utils \
        libxml2-dev \
        zlib1g-dev \
        zip \
        libcurl3 \
        libpcre3-dev \
        libcurl4-openssl-dev \
        libicu-dev \
        libxml2-dev libxslt-dev \
        zlib1g-dev \
    && docker-php-ext-install -j$(nproc) iconv mcrypt pdo_mysql mbstring \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install soap \
    && docker-php-ext-configure bcmath \
    && docker-php-ext-install -j$(nproc) bcmath \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-configure xsl \
    && docker-php-ext-install xsl \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

# install xDebug
COPY xdebug-2.5.4.tgz /usr/src/php/ext/xdebug.tgz
RUN tar -xf /usr/src/php/ext/xdebug.tgz -C /usr/src/php/ext/ && \
    rm /usr/src/php/ext/xdebug.tgz && \
    docker-php-ext-install xdebug-2.5.4
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# adds Magento 2 PHP configs
COPY magento.ini /usr/local/etc/php/conf.d/90-magento.ini

# to include ioncube support, uncomment the next two lines
#COPY ioncube/ioncube_loader_lin_7.1.so /usr/local/lib/php/extensions/no-debug-non-zts-20160303/ioncube_loader_lin_7.1.so
#COPY ioncube.ini /usr/local/etc/php/php.ini
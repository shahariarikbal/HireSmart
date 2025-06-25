FROM php:8.2-apache

# -----------------------------
# Install system packages
# -----------------------------
RUN apt-get update && apt-get install -y \
    git curl unzip zip \
    libpng-dev libjpeg-dev libfreetype6-dev \
    zlib1g-dev libzip-dev \
    libpq-dev \
    libssh2-1-dev \
    libxml2-dev \
    openssh-client

# ----------------------------------
# Set Laravel's public directory
# ----------------------------------
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# -------------------------------
# Enable Apache modules
# -------------------------------
RUN a2enmod rewrite

# -----------------------------------
# Install required PHP extensions
# -----------------------------------
RUN pecl install ssh2-1.3.1 && docker-php-ext-enable ssh2

RUN docker-php-ext-configure gd --with-jpeg && \
    docker-php-ext-install \
        pdo \
        pdo_mysql \
        pdo_pgsql \
        mysqli \
        gd \
        zip \
        xml \
        soap

# ------------------------------
# Install Composer globally
# ------------------------------
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV COMPOSER_ALLOW_SUPERUSER 1

# -----------------------------
# Default working directory
# -----------------------------
WORKDIR /var/www/html

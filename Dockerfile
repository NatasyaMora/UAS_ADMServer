FROM php:8.1-apache

# Install ekstensi PHP untuk MySQL/MariaDB
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Aktifkan modul rewrite Apache (berguna jika ada routing)
RUN a2enmod rewrite

# Salin seluruh kode web dinamis ke direktori web Apache di dalam kontainer
COPY . /var/www/html/

# Atur hak akses folder agar bisa dibaca oleh Apache
RUN chown -R www-data:www-data /var/www/html/
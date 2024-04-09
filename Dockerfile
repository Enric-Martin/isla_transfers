# Utilizamos una imagen base de PHP
FROM php:8.2-apache

# Instalamos dependencias necesarias y el cliente MySQL
RUN apt-get update && \
    apt-get install -y \
        default-mysql-client \
        && \
    rm -rf /var/lib/apt/lists/*

# Instalamos el paquete PDO MySQL
RUN docker-php-ext-install pdo_mysql

# Configuramos el directorio de trabajo
WORKDIR /var/www/html

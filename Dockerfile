FROM php:8.3-apache

# Instalar extensión mysqli para conectar con MariaDB
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copiar los archivos del proyecto al servidor web
COPY . /var/www/html/

# Ajustar el puerto dinámico que asigna Render (por defecto 10000)
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf
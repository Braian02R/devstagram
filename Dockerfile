# 1. Utilizar una imagen base oficial de PHP con las extensiones necesarias
FROM php:8.2-fpm-alpine

# 2. Instalar dependencias del sistema y PHP
RUN apk add --no-cache \
    git \
    unzip \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    icu-dev \
    libpq \
    libpq-dev \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql pdo_pgsql intl

# 3. Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 4. Configurar directorio de trabajo
WORKDIR /var/www/html

# 5. Copiar el código fuente al contenedor
COPY . .

# 6. Instalar dependencias de PHP (Composer)
RUN composer install --no-dev --optimize-autoloader

# 7. Instalar dependencias de Node.js (Vite)
RUN npm install

# 8. Ejecutar Vite para la compilación de assets en producción
RUN npm run build

# 9. Configurar permisos para almacenamiento y caché
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# 10. Exponer el puerto para PHP-FPM
EXPOSE 9000

# 11. Comando por defecto
CMD ["php-fpm"]
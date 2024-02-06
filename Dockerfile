FROM php:8.3-apache

# Set the timezone from environment variable
RUN echo "date.timezone = '$PHP_DATE_TIMEZONE'" > /usr/local/etc/php/conf.d/timezone.ini

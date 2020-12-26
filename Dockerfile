FROM bylexus/apache-php56
LABEL maintainer="Huan <zixia@zixia.net>"

COPY conf/000-default.conf /etc/apache2/sites-available/

RUN a2enmod rewrite
COPY www /var/www

CMD ["apachectl -D FOREGROUND"]

EXPOSE 80/tcp

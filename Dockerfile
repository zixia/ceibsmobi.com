FROM bylexus/apache-php56

COPY conf/000-default.conf /etc/apache2/sites-available/

RUN a2enmod rewrite
COPY www /var/www

CMD ["apachectl", "-D", "FOREGROUND"]

EXPOSE 80/tcp

LABEL maintainer="Huan <zixia@zixia.net>"
LABEL org.opencontainers.image.source https://github.com/zixia/ceibsmobi.com

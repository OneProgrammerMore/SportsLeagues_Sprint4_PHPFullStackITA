FROM debian:bookworm-20250113-slim

RUN apt update
RUN apt -y install nano lsof
RUN apt -y install apache2
RUN apt -y install php php-common 
RUN apt -y install php-dev 
RUN apt -y install php-cli php-pear composer php-mysql php-pdo-mysql
RUN apt -y install php-curl
RUN apt -y install npm

#to enabled PHP PDO and mysqli extensions to connect with MySQL add in Dockerfile : 
#RUN docker-php-ext-install pdo pdo_mysql


RUN sed -i "s/;extension=pdo_mysql/extension=pdo_mysql/g" /etc/php/8.2/cli/php.ini
RUN sed -i "s/;extension=pdo_mysql/extension=pdo_mysql.so/g" /etc/php/8.2/apache2/php.ini
RUN sed -i "s/;extension=curl/extension=curl/g" /etc/php/8.2/cli/php.ini
RUN sed -i "s/;extension=curl/extension=curl/g" /etc/php/8.2/apache2/php.ini


RUN rm /var/www/html/index.html
COPY ./docker/config/apache2/000-default.conf /etc/apache2/sites-enabled/
COPY ./docker/config/apache2/apache2.conf /etc/apache2/apache2.conf

RUN a2enmod rewrite

CMD chmod -R a+wr /var/www/html/data/

EXPOSE 80

WORKDIR /var/www/html






#debian系
FROM mysql:5.7

EXPOSE 3306
COPY my.cnf /etc/mysql/mysql.conf.d/mysqld.cnf

RUN apt-get update
RUN apt-get install -y vim

RUN touch /var/log/mysql/mysqld.log

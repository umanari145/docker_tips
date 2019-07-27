FROM centos:centos7
RUN yum -y update && yum clean all

#基本モジュール
RUN yum -y install man sudo vim-enhanced wget git gcc gcc-c++ make autoconf patch curl-devel \
openssl-devel mod_ssl mysql-devel httpd-devel automake zip unzip

#リポジトリ
RUN yum -y install epel-release
RUN yum -y install http://rpms.famillecollet.com/enterprise/remi-release-7.rpm

#php&node
RUN yum -y install --enablerepo=remi-php72  php php-devel php-mbstring php-pdo php-gd php-xml php-mcrypt
RUN curl -sS https://getcomposer.org/installer | php --install-dir=/usr/local/bin --filename=composer
RUN yum -y install httpd

RUN curl -sL https://rpm.nodesource.com/setup_11.x | bash -
RUN yum install -y nodejs
RUN npm install npm@latest -g

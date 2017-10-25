FROM centos:7

# Software
RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY*
RUN yum -y install epel-release && yum clean all
RUN yum -y update && yum clean all
RUN yum -y install yum-utils && yum -y update
RUN yum -y install \
    curl curl-devel \
    zip unzip


# PHP
RUN rpm -Uvh http://rpms.remirepo.net/enterprise/remi-release-7.rpm
RUN yum-config-manager --enable remi-php71
RUN yum -y install \
    php-cli \
    php-mbstring \
    php-pdo \
    php-mysql \
    php-pgsql \
    php-xml \
    php-xmlrpc \
    php-zip

# Non-root user
RUN groupadd -g 1000 yii2 && \
    useradd -u 1000 -g yii2 -m yii2 && \
   chown yii2:yii2 /home/yii2/ -R

ARG INSTALL_NODE=false
ENV INSTALL_NODE ${INSTALL_NODE}
RUN if [ ${INSTALL_NODE} = true ]; then \
        yum install -y nodejs npm \
    ;fi

# Composer
RUN curl -s http://getcomposer.org/installer | php
RUN chmod +x composer.phar
RUN mv composer.phar /usr/local/bin/composer
RUN composer self-update

USER yii2

# Yii2 dependencies
RUN composer global require "fxp/composer-asset-plugin:^1.4.1"

# Yii2 installation
ARG INSTALL_YII2=false
ENV INSTALL_YII2 ${INSTALL_YII2}
RUN if [ ${INSTALL_NODE} != false ]; then \
        composer create-project --prefer-dist yiisoft/${INSTALL_YII2} \
    ;fi

# Almost done
WORKDIR /var/www

# Then connect to your container
# cd /var/www
# composer create-project --prefer-dist yiisoft/yii2-app-basic .

USER root
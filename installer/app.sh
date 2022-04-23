#!/bin/sh

### install php ###
# https://serverfault.com/questions/1047405/how-to-install-php-8-in-oracle-linux-with-apache
dnf repolist | grep remi-modular || {
    dnf -y install https://rpms.remirepo.net/enterprise/remi-release-8.rpm
    dnf -y module reset php
    dnf -y module enable php:remi-8.1
}
dnf -y install php php-fpm php-curl

### install composer ###
# https://getcomposer.org/doc/faqs/how-to-install-composer-programmatically.md
get_composer() {
    EXPECTED_CHECKSUM="$(php -r 'copy("https://composer.github.io/installer.sig", "php://stdout");')"
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    ACTUAL_CHECKSUM="$(php -r "echo hash_file('sha384', 'composer-setup.php');")"

    if [ "$EXPECTED_CHECKSUM" != "$ACTUAL_CHECKSUM" ]
    then
	>&2 echo 'ERROR: Invalid installer checksum'
	rm composer-setup.php
	exit 1
    fi

    php composer-setup.php --quiet
    RESULT=$?
    rm composer-setup.php
    return $RESULT
}

test -e composer.phar || {
    get_composer || ( rm composer.phar; echo 'hash err'; )
}

cp composer.phar /usr/local/bin/composer

### install symfony cil ###
# https://symfony.com/download
echo '[symfony-cli]
name=Symfony CLI
baseurl=https://repo.symfony.com/yum/
enabled=1
gpgcheck=0' | sudo tee /etc/yum.repos.d/symfony-cli.repo

dnf -y install symfony-cli

# oci8
# https://blog.remirepo.net/post/2020/05/18/Installation-of-Oracle-extensions-for-PHP
# Using the package manager causes conflicts with libraries required for Oracle DB.
ORA_ICB_ZIP=instantclient-basic-linux.x64-21.5.0.0.0dbru.zip
ORA_ICB_URL=https://download.oracle.com/otn_software/linux/instantclient/215000/${ORA_ICB_ZIP}
ORA_ICB_DIR=instantclient_21_5
ORA_ICB_DIST=/opt/oracle
ORA_ICB_PATH=${ORA_ICB_DIST}/${ORA_ICB_DIR}

dnf install -y php-oci8
test -e $ORA_ICB_ZIP || {
    echo "download $ORA_ICB_ZIP"
    wget --quiet $ORA_ICB_URL
}
test -e ${ORA_ICB_PATH} || unzip $ORA_ICB_ZIP -d ${ORA_ICB_DIST}
echo ${ORA_ICB_PATH} > /etc/ld.so.conf.d/oracle.conf
ldconfig

systemctl restart php-fpm

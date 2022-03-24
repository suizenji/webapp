#!/bin/sh

# https://serverfault.com/questions/1047405/how-to-install-php-8-in-oracle-linux-with-apache
dnf -y install https://rpms.remirepo.net/enterprise/remi-release-8.rpm
dnf -y module reset php
dnf -y module enable php:remi-8.1
dnf -y install php php-fpm php-curl


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

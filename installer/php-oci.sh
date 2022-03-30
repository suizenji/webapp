#!/bin/sh

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

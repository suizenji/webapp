#!/bin/sh
dnf install -y nginx

cp /vagrant/nginx/server.conf /etc/nginx/conf.d/

SSL_PKI=/etc/pki/nginx
SSL_KEY=${SSL_PKI}/private/server.key
SSL_CRT=${SSL_PKI}/server.crt

mkdir -p ${SSL_PKI}/private
openssl genrsa -out $SSL_KEY 2>/dev/null
openssl req -new -x509 -key $SSL_KEY -batch -out $SSL_CRT

systemctl restart nginx

[[ "$(getenforce)" == "Disabled" ]] || { sed -i 's/SELINUX=enforcing/SELINUX=disabled/' /etc/selinux/config; setenforce 0; }

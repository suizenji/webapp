# coding: utf-8
# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  config.vm.box = "oraclelinux/8"
  config.vm.box_url = "https://oracle.github.io/vagrant-projects/boxes/oraclelinux/8.json"

  config.vm.network "private_network", ip: "192.168.56.78"
  # config.vm.synced_folder "../data", "/vagrant_data"
#  config.vm.synced_folder "./app", "/app", type: "rsync"

  # config.vm.provider "virtualbox" do |vb|
  #   vb.memory = "1024"
  # end

  config.vm.provision "shell", inline: <<-SHELL
    dnf upgrade -y
    dnf install -y git

    ( cd /vagrant/installer && sh php.sh; )
    ( cd /vagrant/installer && sh php-oci.sh; )

    ( cd /vagrant/installer && sh nginx.sh; )

    ( cd /vagrant/installer && sh oracle.sh; )

    # for nginx
    [[ "$(getenforce)" == "Disabled" ]] || { sed -i 's/SELINUX=enforcing/SELINUX=disabled/' /etc/selinux/config; setenforce 0; }

    # setup app
    cd /vagrant/app && su vagrant -c '/usr/local/bin/composer install'
    chmod -R 777 /vagrant/app/var

    # https://docs.oracle.com/cd/F39414_01/xeinl/starting-and-stopping-oracle-database.html
    systemctl daemon-reload
    systemctl enable nginx oracle-xe-21c
    systemctl restart php-fpm nginx oracle-xe-21c
  SHELL
end

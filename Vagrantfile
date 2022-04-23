# coding: utf-8
# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  config.vm.box = "oraclelinux/8"
  config.vm.box_url = "https://oracle.github.io/vagrant-projects/boxes/oraclelinux/8.json"

  config.vm.network "private_network", ip: "192.168.56.78"
  # config.vm.synced_folder "../data", "/vagrant_data"
#  config.vm.synced_folder "./app", "/app", type: "rsync"
  config.vm.synced_folder "./", "/vagrant", mount_options: ['dmode=777','fmode=777']

  # config.vm.provider "virtualbox" do |vb|
  #   vb.memory = "1024"
  # end

  config.vm.provision "shell", inline: <<-SHELL
    dnf upgrade -y
    dnf install -y git unzip

    (
      cd /vagrant/installer && sh oracle.sh
      which sqlplus 2>/dev/null || source ~/.bash_profile
      sqlplus system/Passw0rd@localhost:1521/XEPDB1 @oracle-create-user.sql
    )

    (
      cd /vagrant/installer && sh nginx.sh

      [[ "$(getenforce)" == "Disabled" ]] || {
        sed -i 's/SELINUX=enforcing/SELINUX=disabled/' /etc/selinux/config
        setenforce 0
      }
    )

    (
      cd /vagrant/installer && sh app.sh

      cd /vagrant/app && su vagrant -c '/usr/local/bin/composer install'
      # https://symfony.com/doc/current/setup/file_permissions.html
      # chmod -R 777 /vagrant/app/var
    )
  SHELL
end

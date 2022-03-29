# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  config.vm.box = "oraclelinux/8"
  config.vm.box_url = "https://oracle.github.io/vagrant-projects/boxes/oraclelinux/8.json"

  config.vm.network "private_network", ip: "192.168.56.78"
  # config.vm.synced_folder "../data", "/vagrant_data"

  # config.vm.provider "virtualbox" do |vb|
  #   vb.memory = "1024"
  # end

  config.vm.provision "shell", inline: <<-SHELL
    dnf -y upgrade
    dnf -y install git

    ( cd /vagrant/installer && sh oracle.sh; )

    ( cd /vagrant/installer && sh php.sh; )
    cd /vagrant/app && su vagrant -c /usr/local/bin/composer install
  SHELL
end

# my webapp

## vagrant init
```
$ # https://yum.oracle.com/boxes/
$ vagrant init oraclelinux/8 https://oracle.github.io/vagrant-projects/boxes/oraclelinux/8.json
```

## create project
```
$ composer create-project symfony/skeleton app
$ cd app
$ composer require webapp # docker:no
```

## vagrant error
[ip addr](https://stackoverflow.com/questions/69728426/e-accessdenied-when-creating-a-host-only-interface-on-virtualbox-via-vagrant)
```
VBoxManage: error: Context: "EnableStaticIPConfig(Bstr(pszIp).raw(), Bstr(pszNetmask).raw())" at line 242 of file VBoxManageHostonly.cpp
```

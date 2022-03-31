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

## oci8
```
[vagrant@localhost ~]$ dnf install php-oci8
...

# https://ganecchi.net/gari/php8-oci.html#4-1._phpモジュールの確認
[vagrant@localhost ~]$ php -m
PHP Warning:  PHP Startup: Unable to load dynamic library 'oci8' (tried: /usr/lib64/php/modules/oci8 (/usr/lib64/php/modules/oci8: cannot open shared object file: No such file or directory), /usr/lib64/php/modules/oci8.so (libclntsh.so.21.1: cannot open shared object file: No such file or directory)) in Unknown on line 0
PHP Warning:  PHP Startup: Unable to load dynamic library 'pdo_oci' (tried: /usr/lib64/php/modules/pdo_oci (/usr/lib64/php/modules/pdo_oci: cannot open shared object file: No such file or directory), /usr/lib64/php/modules/pdo_oci.so (libclntsh.so.21.1: cannot open shared object file: No such file or directory)) in Unknown on line 0
...

# https://qiita.com/sengoku/items/16c12b459dddf3a14e19#トラブルシュート
[vagrant@localhost ~]$ ldd /usr/lib64/php/modules/oci8.so
        linux-vdso.so.1 (0x00007ffc951df000)
        libclntsh.so.21.1 => not found
        libc.so.6 => /lib64/libc.so.6 (0x00007fd6cea99000)
        /lib64/ld-linux-x86-64.so.2 (0x00007fd6cf08b000)
```

## link
[Oracle Linux 8でWordPressサーバを立てる](https://blog.osakana.net/archives/11232)

[php-oci8とPDO-OCIについて](https://teratail.com/questions/65932)

## TODO
selinux, oracle dba, git, lint and etc

---
title: "Install PhpMyAdmin on centOS"
date: 2017-02-22T13:56:12-05:00
showDate: true
draft: false
categories: [mysql]
tags: [centos, database, mysql, phpmyadmin, tools]
---
#### What is PhpMyAdmin?
PhpMyAdmin is one of the most popular applications for MySQL databases management. It is a free tool written in PHP. Through this software you can create, alter, drop, delete, import and export MySQL database tables. You can run MySQL queries, optimize, repair and check tables, change collation and execute other database management commands. Install PhpMyAdmin isn’t an easy task. You need to do several configuration after installation.

#### How to install PhpMyAdmin?

```sh 
$ rpm -iUvh http://dl.fedoraproject.org/pub/epel/7/x86_64/e/epel-release-7-5.noarch.rpm #Adding repository
$ yum -y update
$ yum -y install phpmyadmin #Install PhpMyAdmin
```

That’s it. You can start using it by url `http:///phpMyAdmin`, Ex. http://example.com/phpMyAdmin

#### Do following changes if you face 403 forbidden issue
```sh 
$ sudo nano /etc/httpd/conf.d/phpMyAdmin.conf
```

```apacheconfig
<Directory /usr/share/phpMyAdmin/>
   AddDefaultCharset UTF-8
   <IfModule mod_authz_core.c>
     # Apache 2.4
     <RequireAny>
       Require all granted
     </RequireAny>
   </IfModule>
   <IfModule !mod_authz_core.c>
     # Apache 2.2
     Order Deny,Allow
     Deny from All
     Allow from 127.0.0.1
     Allow from ::1
   </IfModule>
</Directory>
```

In order to reinitialising changes, we need to restart the apache server.

```sh 
$ sudo apachectl restart #or:
$ /sbin/service httpd restart
```

I hope that some of this is useful to a few of you. There is always room for an improvements, find out another unix commands and make best use of it. Leave a note in the comments if you have any cool tricks to install PhpMyAdmin. Also checkout my another blog on [installing Apache, php and mysql on Ubuntu server](/posts/installing-lamp-stack-ubuntu/).

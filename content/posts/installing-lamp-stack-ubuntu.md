---
title: "Installing LAMP stack on Ubuntu"
date: 2017-03-29T13:56:12-05:00
showDate: true
draft: false
categories: [web]
tags: [apache, lamp, mysql, php, php5, php7, ubuntu]
description: "This tutorial shows how you can install LAMP stack (Apache, PHP and MySQL) on an Ubuntu server. This will help you in speed up installation."
---

LAMP is short for **L**inux, **A**pache, **M**ySQL, **P**HP. This tutorial shows how you can install LAMP stack (Apache2, PHP and MySQL) on an Ubuntu 16.04 server.

#### Apache
To install Apache you must install the Metapackage apache2. This can be done by searching for and installing in the Software Centre, or by running the following command.

```sh
sudo apt-get install apache2
```

#### MySQL
To install MySQL you must install the Metapackage mysql-server. This can be done by searching for and installing in the Software Centre, or by running the following command.

```sh
sudo apt-get install mysql-server
```
#### PHP
To install PHP you must install the Metapackages php5 and libapache2-mod-php5. This can be done by searching for and installing in the Software Centre, or by running the following command.
Install PHP 5:

```sh 
sudo apt-get update
sudo apt-get install php5 libapache2-mod-php5
```

##### Or Install PHP 7:
```sh 
sudo apt-get install python-software-properties
sudo add-apt-repository ppa:ondrej/php 
sudo apt-get update 
sudo apt-get install -y php7.1 
# Optional modules 
sudo apt-get -y install php7.1-mcrypt php7.1-curl php7.1-cli php7.1-mysql php7.1-gd libapache2-mod-php7.1 
# check installed version 
php -v
```

#### Restart Server
Your server should restart Apache automatically after the installation of both MySQL and PHP. If it doesn’t, execute this command.

```sh 
sudo service apache2 restart
```

#### Check Apache

Open a web browser and navigate to [http://localhost](http://localhost/). You should see a message saying It works!

#### Check PHP
You can check your PHP installation by executing any PHP file from within /var/www/. Alternatively you can execute the following command, which will make PHP run the code without the need for creating a file.

```sh 
php -r 'echo "\n\nYour PHP installation is working fine.\n\n\n";'
```
##### Or:

```sh 
php -v
```

Congratulations, you have just Installed a LAMP Server!

I hope that some of this is useful to a few of you. There is always an room for improvements. Leave a note in the comments if you have any cool tricks for the LAMP installation. I’m always on the lookout for fun hacks.

I have wrote another article on [How to install PhpMyAdmin on centOS](http://imyuvii.com/install-phpmyadmin-on-centos/). Checkout related articles section to find more relevant content.


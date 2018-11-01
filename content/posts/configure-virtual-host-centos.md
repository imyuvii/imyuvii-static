---
title: "Configure virtual hosts on CentOS"
date: 2017-01-26T13:56:12-05:00
showDate: true
draft: false
categories: [apache]
tags: [centos, host, virtual]
description: "This article explains step by step guid to create a virtual hosts on CentOs using Apache’s virtual hosts. It can be useful in hosting multiple sites."
---

About to host websites on linux server? Using Apache? Great. This article will show you how to do exactly that using Apache’s virtual hosts.

In Apache, you can use virtual hosts to direct http traffic for a given domain name to a particular directory (i.e. the root directory of the website for the domain in the request). This feature is commonly used to host multiple websites, but we recommend using it for every website on your server including the first.

Throughout this article, we’ll use an example domain – example.com – but you should replace it with the domain name or subdomain you want to host on your server.

### Install the Apache web server
To get Apache on your server, you can either install it as part of a LAMP stack, or you can install Apache by itself:

- Update your packages using yum 

```sh
$ sudo yum update
```
- Install Apache

```sh
$ sudo yum install httpd
```

- Enable Apache Service

```sh
$ sudo systemctl enable httpd.service
```

- Start up Apache

```sh
$ sudo service httpd start
```

### Set up the virtual hosts

- Create the virtual directories for your domain

```sh
$ sudo mkdir -p /var/www/example.com/public_html
```

- Change the ownership to the Apache group

```sh
$ sudo chown -R apache:apache /var/www/example.com/public_html
# This lets Apache modify files in your web directories
```

- Change the directory’s permissions so they can be read from the internet

```sh
$ sudo chmod -R 755 /var/www/
```

### Create content for the website
- Create the index file

```sh 
$ sudo nano /var/www/example.com/public_html/index.html
```
- Add some content to the file

```html 
<html>
<head>
    <title>Welcome to Example.com!</title>
</head>
<body>
    <h1>Success! The example.com virtual host is working!</h1>
</body>
</html>
```
- Save and close the file

```sh 
Ctrl + o (Save File)
Ctrl + x (Exit)
```

### Configure your virtual host directories
We’re going to copy a configuration usually used in Ubuntu/Debian and create two directories: one to store the virtual host files (sites-available) and another to hold symbolic links to virtual hosts that will be published (sites-enabled).

#### Create sites-available and sites-enabled directories
- Create the directories

```sh 
$ sudo mkdir /etc/httpd/sites-available
$ sudo mkdir /etc/httpd/sites-enabled
```

#### Edit your Apache configuration file
Edit the main configuration file (httpd.conf) so that Apache will look for virtual hosts in the sites-enabled directory.

- Open your config file

```sh 
sudo nano /etc/httpd/conf/httpd.conf
```

- Add this line at the very end of the file

```sh 
IncludeOptional sites-enabled/*.conf
# This way, we’re telling Apache to look for additional config files in the sites-enabled directory
```

- Save and close the file

```sh 
Ctrl + o (Save File)
Ctrl + x (Exit)
```

### Create virtual host file
We’re going to build it from a new file in your sites-available directory.

- Create a new config file

```sh 
$ sudo nano /etc/httpd/sites-available/example.com.conf
```

- Paste this code in, replacing your own domain for example.com.conf. Here’s what the whole file could look like after your changes.

```apacheconfig 
<VirtualHost *:80>
    ServerAdmin webmaster@dummy-host.example.com    
    ServerName www.example.com
    ServerAlias example.com 
    DocumentRoot /var/www/example.com/public_html 
    ErrorLog /var/www/example.com/error.log 
    CustomLog /var/www/example.com/requests.log combined 
</VirtualHost>
```

The lines ErrorLog and CustomLog are not required to set up your virtual host, but we’ve included them, in case you do want to tell Apache where to keep error and request logs for your site.

- Save and close the file

```sh 
Ctrl + o (Save File)
Ctrl + x (Exit)
```

- Enable your virtual host file with a sym link to the sites-enabled directory

```sh 
$ sudo ln -s /etc/httpd/sites-available/example.com.conf /etc/httpd/sites-enabled/example.com.conf
```

- Restart Apache

```sh 
$ sudo service httpd restart
```
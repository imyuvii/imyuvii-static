---
title: "How to start, stop and restart apache"
date: 2017-02-21T13:56:12-05:00
showDate: true
draft: false
categories: [apache]
tags: [apache, httpd, macos, server, web, webServer]
---
Apache is primarily used to serve both static content and dynamic Web pages on the World Wide Web. Many web applications are designed expecting the environment and features that Apache provides.It can be started or restarted using any one of the following methods

#### Apache on MacOS

Use following commands to start/stop/restart apache

```sh
$ sudo /usr/sbin/apachectl start
$ sudo /usr/sbin/apachectl stop
$ sudo /usr/sbin/apachectl restart
```

#### On CentOS
The httpd RPM installs the `/etc/init.d/httpd` script, which can be accessed using the /sbin/service command.

Starting httpd using the **apachectl** control script sets the environmental variables in /etc/sysconfig/httpd and starts httpd. You can also set the environment variables using the init script.

To start the server using the **apachectl** control script as root type

```sh 
$ sudo apachectl start
```

You can also start httpd using /sbin/service httpd start. This starts httpd but does not set the environment variables. If you are using the default Listen directive in httpd.conf, which is port 80, you will need to have root privileges to start the apache server.

To stop the server, as root type

```sh 
$ sudo apachectl stop
```

You can also stop httpd using `/sbin/service` httpd stop. The restart option is a shorthand way of stopping and then starting the Apache HTTP Server.

You can restart the server as root by typing

```sh 
$ apachectl restart # or:
$ /sbin/service httpd restart
```

Apache will display a message on the console or in the ErrorLog if it encounters an error while starting.

#### Debian/Ubuntu Specific commands

```sh 
$ sudo service apache2 start
$ sudo service apache2 stop
$ sudo service apache2 restart
```



---
title: "MySQL Import/Export large databases"
date: 2017-03-15T13:56:12-05:00
showDate: true
draft: false
categories: [mysql]
tags: [	mysql, mysqldump]
description: "This article contains information on mysql import, specifically large databases using command line. It also explain how to export database using mysqldump."
---

When working with MySQL I often use tools like [PhpMyAdmin](/posts/install-phpmyadmin-on-centos/) or sequelPro, which is a nice GUI way to manipulate MySQL database. But it won’t work sometime while importing/exporting larger databases. So sometimes you need to do mysql import on the command line.

##### Export a Large Database

```sh 
$ mysqldump -u [USERNAME] -p [DBNAME] | gzip > [/path_to_file/DBNAME].sql.gz
```

##### MySQL Import a Large Database
```sh 
# First, unzip the file.
$ gzip -d [/path_to_file/DBNAME].sql.gz
```

##### Login to mysql

```sh
$ [/path_to_mysql/]mysql -u [USERNAME] -p
```

##### Wipe out the old database and replace it with the new dump

```sh
SHOW DATABASES;
DROP DATABASE [DBNAME];
CREATE DATABASE [DBNAME];
USE [DBNAME];
SOURCE [/path_to_file/DBNAME].sql;
```
      
####  Final Words

Well, that was it! I hope this will help you. of course, you can always have a quick look at this tutorial again if you forget something. Intention of my blog is to provide quick helps to the developers. I generally does not go much into the theories. I believe, the more you practice the more you learn.     
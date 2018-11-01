---
title: "Website deployment using GIT"
date: 2017-04-10T13:56:12-05:00
showDate: true
draft: false
categories: [web]
tags: [deployment, git, ssh, website]
description: "Web Deployment is a fancy word for getting your website on the web, This article explains step by step Website deployment guid through GIT."
---

Once you’ve put in all the hard work of creating a website, you need to get it on the web so people can navigate to it and access its content. This process is called deployment. Deployment is a fancy word for “getting your website on the web,”.  Website deployment isn’t a simple process, mainly because there are so many different ways to do it. In this article I don’t aim to document all possible methods. Rather, I will walk you through one method that will work for now.

This tutorial assumes that you have following things ready:

- A local git repo with an online remote repository (github / bitbucket etc)
- A cloud server (Digitalocean, Google cloud, Amazon EC2 etc)
    - Your (PHP) scripts are served from your web root (in my case /var/www/html/)
    - Webpages are executed by apache
    - Apache’s home directory is `/var/www/`
    - (this describes a pretty standard apache setup on Redhat / Ubuntu / CentOS / Amazon AMI etc)
    
you should be able to do the same with Java, Perl, RoR, JSP etc. however you’ll need to recreate the (rather simple) PHP script.

#### 1. On your local machine
Here we add the [deployment script](https://gist.github.com/oodavid/1809044#file-deploy-php) and push it to the origin, the deployment script runs git commands to PULL from the origin thus updating your server.
In case if you miss the link: [deploy.php](https://gist.github.com/oodavid/1809044#file-deploy-php)

Add, commit and push this to github
```sh 
$ git add deploy.php
$ git commit -m 'Added the git deployment script' 
$ git push -u origin master
```
#### 2. On your server
Here we install and setup git on the server, we also create an SSH key so the server can talk to the origin without using passwords etc

Install git…

On CentOS
```sh 
$ sudo yum install git
```

On Ubuntu
```sh 
$ sudo apt-get install git
```
After you’ve installed git, make sure it’s a relatively new version – old scripts quickly become problematic as github / bitbucket / whatever will have the latests and greatest, if you don’t have a recent version you’ll need to figure out how to upgrade it 🙂

Setup git
```sh 
$ git config --global user.name "Server"
$ git config --global user.email "server@server.com"
```
Create an ssh directory for the apache user
```sh 
$ sudo mkdir /var/www/.ssh
# ubuntu
$ sudo chown -R www-data:www-data /var/www/.ssh/
#CentOs
$ sudo chown -R apache:apache /var/www/.ssh/ Generate a deploy key for apache user
```
Generate a deploy key for apache user
```sh
$ sudo -Hu apache ssh-keygen -t rsa # choose "no passphrase"
$ sudo cat /var/www/.ssh/id_rsa.pub
```
#### 3. On your GIT server (github, gitlab, bitbucket etc.)
Here we add the SSH key to the origin to allow your server to talk without passwords. In the case of GitHub we also setup a post-receive hook which will automatically call the deploy URL thus triggering a PULL request from the server to the origin.

GitHub instructions

Add the SSH key to your user

- [https://github.com/settings/ssh](https://github.com/settings/ssh)
- Create a new key
- Paste the deploy key you generated on the server
- Set up service hook
- [https://github.com/your_username/server.com/settings/hooks](https://github.com/your_username/server.com/settings/hooks)
- Select the Post-Receive URL service hook
- Enter the URL to your deployment script – http://server.com/deploy.php
- Click Update Settings
- Bitbucket instructions

#### 4. Deployment on the Server
Here we clone the origin repo into a chmodded `/var/www/html` folder

```sh 
$ sudo chown -R apache:apache /var/www/html
$ sudo -Hu apache git clone git@github.com:you/server.git /var/www/html
```

That’s it, you’re ready to go 🙂

##### Notes:

- Navigate the the deployment script to trigger a pull and see the output:
    - [http://server.com/deploy.php](http://server.com/deploy.php)
    - This is useful for debugging too 😉
- When you push to GitHub your site will automatically ping the above url (and pull your code)
- When you push to Bitbucket you will need to manually ping the above url
- It would be trivial to setup another repo on your server for different branches (develop, release-candidate etc) – repeat most of the steps but checkout a branch after pulling the repo down



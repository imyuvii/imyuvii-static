---
title: "SCP command to transferring files between servers"
date: 2017-03-18T13:56:12-05:00
showDate: true
draft: false
tags: ["scp","filecopy"]
---

In this tutorial, you will learn how to copy files or folders between hosts. The command we will be using is SCP command. SCP (Secure Copy) is a command line tool to copy or transfer files across hosts. It uses the same kind of security mechanism like the ssh program. Infact it uses an ssh connection in the background to perform the file transfer. scp refers both to the “protocol” that defines how secure copy should work and the “program” (command) which is installed as a part of OpenSSH suite of tools.

#### SCP Command
Secure copy or `SCP` command, copy files and directories between remote hosts without starting an FTP session or logging into the remote systems explicitly. The SCP command uses SSH to transfer data, so it requires a password or passphrase for authentication. SCP encrypts both the file and any passwords exchanged so that anyone snooping on the network cannot view them.

##### Uploading file to a remote server
```sh 
scp ~/Desktop/phpinfo.php user1@example.com:/var/www/html/
```

##### Basic syntax
```sh
scp source_file_name username@destination_host:destination_folder
```

##### Downloading file from a remote server

```sh
scp user1@example.com:/var/www/html/phpinfo.php ~/Desktop/
```

##### Transferring file between remote servers
   
```sh
scp user1@example1.com:/var/www/html/phpinfo.php user2@example2.com:/var/www/html/
```
   
##### Specifying a port with SCP

```sh
scp -P 8080 ~/Desktop/phpinfo.php user1@example.com:/var/www/html/
```
      
##### Using private key (.pem)

```sh
scp -i ~/Desktop/example.pem user1@example.com:/var/www/html ~/Desktop/.
```
      
##### Copy whole directory

```sh
scp -r user1@example.com:/var/www/html/* ~/Desktop/example/.
```
      
Linux administrator should be familiar with CLI environment. Since GUI mode in Linux servers is not a common to be installed. [SSH](/ssh-config-file-rescue/) may the most popular protocol to enable Linux administrator to manage the servers via remote in secure way. Built-in with SSH command there is SCP command. SCP is used to copy file(s) between servers in secure way.

#### Final Words.

Well, that was it! I hope this will help you. of course, you can always have a quick look at this tutorial again if you forget something. Intention of my blog is to provide quick helps to the developers. I generally does not go much into the theories. I believe, the more you practice the more you learn.
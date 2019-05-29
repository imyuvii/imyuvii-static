---
title: "Watch a directory for creation of new files and notify on slack"
date: 2019-05-29T13:27:11+05:30
showDate: true
draft: false
categories: [web]
tags: ["inotify","shell","slack"]
description: "This article helps to watch a directory for creation of new files and notify on slack."
---
How did I came up with this? simply because, I needed to inform marketing team whenever there is a new csv uploaded. So initially we used to watch directory on daily bases whether new CSV uploaded. That was super boring so I thought to automate this process.

I found out that [inotify](https://en.wikipedia.org/wiki/Inotify) can help me to achieve this.
 
So, let's do it.

### Install inotify
[This library](https://github.com/rvoicilas/inotify-tools/wiki#info) provides a thin layer on top of the basic inotify interface. The primary use is to easily set up watches on files, potentially many files at once, and read events without having to deal with low-level I/O. There are also several utility functions for inotify-related string formatting.

#### Debian/Ubuntu
inotify-tools is available in Debian’s official repositories. You can install it by:

```sh 
sudo apt-get install inotify-tools
Ryan Niebur is the Debian package maintainer.
```

#### CentOS/RHEL 7
inotify-tools is available through the EPEL repository. Install EPEL :

```sh
yum install -y epel-release && yum update
```
Then install package:
```sh
yum install inotify-tools
# In case of CentOS-7
yum --enablerepo=epel install inotify-tools
```
To install on any other linux distro follow [this url](https://github.com/rvoicilas/inotify-tools/wiki#getting-inotify-tools)

### Write a shell script
In order to watch a directory we'll write a shell script which will sends notifications whenever there is new file uploaded to directory.

```sh
sudo nano watchdirectory.sh
```
Above script will create a file in ``/home/ubuntu/watchdirectory.sh``
```sh
inotifywait -m /tmp/test -e create -e moved_to |
    while read path action file; do
    	echo 'The file $file appeared in directory $path via $action'
    done
```
Test the bash script.
```sh 
sh /home/ubuntu/watchdirectory.sh
# output
Setting up watches.
Watches established.
```

Keep the command running. Open new terminal and SSH to your host then create a file ``/tmp/test/test.txt``
You'll receive message in a terminal where we execute bash script. Output will be

```sh
The file test.txt appeared in directory /tmp/test/ via CREATE
```

### Sending slack notifications
Get your slack API credentials, We'll need slack webhook URL and a slack channel name. Which you'll get it from [here](https://api.slack.com/incoming-webhooks).

To test your slack endpoint run following command in your terminal, Make sure you replace the required attribute.
```sh
curl -X POST \
  --data-urlencode "payload={'channel': '#your_channel_name', 'username': 'newfilebot', 'text': 'This is a test call', 'icon_emoji': ':ghost:'}" \
  https://hooks.slack.com/services/XXXXXXXXX/XXXXXXXXX/XXXXXXXXXXXXXXXXXXXXXXXX
```

You will get slack notification in ``#your_channel_name`` channel.

### Now let's modify bash script 
We'll add slack notification snippet in ``/home/ubuntu/watchdirectory.sh`` bash script.

```sh 
inotifywait -m /tmp/test -e create -e moved_to |
    while read path action file; do
    	curl -X POST \
    		--data-urlencode "payload={'channel': '#your_channel_name', 'username': 'newfilebot', 'text': 'This is a test call', 'icon_emoji': ':ghost:'}" \
    		https://hooks.slack.com/services/XXXXXXXXX/XXXXXXXXX/XXXXXXXXXXXXXXXXXXXXXXXX
    done
```

Re-run the bash script you'll get slack notification.

```sh 
sh /home/ubuntu/watchdirectory.sh
# output
Setting up watches.
Watches established.
```

Keep the command running. Open new terminal and SSH to your host then create a file ``/tmp/test/test2.txt``
You'll get notification in your slack.

```sh
The file test2.txt appeared in directory /tmp/test/ via CREATE
```

### Running script in background
So above script will needs to run in background to watch directory continuously. In order to achieve that I'll use the [nohup](https://en.wikipedia.org/wiki/Nohup).

Run script using nohup
```sh 
nohup bash /home/ubuntu/watchdirectory.sh </dev/null >/dev/null 2>&1 &
```  

This will keep script running in background and trigger the notification whenever there is a new file in the ``/tmp/test`` directory.

We done here. I've used slack because it was a requirement for me. But in your case you can modify based on your need, It could be email notification, sms or any api call. Possibilities are endless. 


Cheers!! 
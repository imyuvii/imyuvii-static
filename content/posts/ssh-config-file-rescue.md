---
title: "SSH Config to the rescue"
date: 2017-04-01T13:56:12-05:00
showDate: true
draft: false
tags: ["sshconfig","config"]
---

How often do you need to logged into a remote server? that to using ssh credentials. In my case I have to log in and out dozens of servers daily. And if you’re like me, you have trouble remembering all of the various usernames, remote addresses and command line options for things like specifying a non-standard connection port or forwarding local ports to the remote machine. Hence, I thought to use SSH Config file.

#### SSH Config to the rescue

`~/.ssh/config` file is a much elegant and flexible solution to this problem. It helps you to become productive and focus on your goal rather than worrying about SSH credentials. Enter the SSH config file using `sudo nano ~/.ssh/config`

```sh 
# contents of $HOME/.ssh/config
Host example:dev
    HostName dev.example.com
    Port 22000
    User imyuvii
```

Now to login

```sh 
ssh example:dev
```

And the options will be read from the configuration file. Easy peasy. Let’s see what else we can do with just a few simple configuration directives.

Personally, I user private/public keys to access servers. The use of `IdentityFile` allows me to specify exactly which private key I wish to use for authentication with the given host.

```sh 
Host example:dev
    Hostname dev.example.com
    Port 22000
    User imyuvii
Host example:pro
    Hostname example.com
    User imyuvii
    IdentityFile ~/.ssh/example.pem
```

Make sure you have read only permission `chmod 400 ~/.ssh/example.pem` for your `.pem` files.
I hope that some of this is useful to a few of you. There is always a room for improvements, find out another options and make best use of it. Leave a note in the comments if you have any cool tricks for the SSH config file. I’m always on the lookout for fun hacks. I have wrote another article on [securely transferring computer files](/posts/transferring-files-between-servers/) between a local host and a remote host or between two remote hosts. You can  It is based on the Secure Shell (SSH) protocol.
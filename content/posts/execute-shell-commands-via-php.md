---
title: "Execute Shell commands via PHP"
date: 2017-11-20T13:56:12-05:00
showDate: true
draft: false
tags: ["php","scp","ssh","terminal","remote"]
---
Not everyone aware about [PHP](/tags/php/)‘s capabilities of making SSH connections and executing remote commands, but it can be very handy. I’ve been using it a lot in PHP CLI applications that I run from cronjobs, but initially it was a pain to get it to work. The [PHP manual on Secure Shell2 Functions](http://www.php.net/manual/en/ref.ssh2.php) is not very practical or methodical for that matter, so I would like to share my understandings on how to make setting this up in less time.

In this article I’m going to assume that:

- You’re running Debian / [Ubuntu](/tags/ubuntu/) If not, you will have to substitute the package manager aptitude with whatever your distribution provides
- You’re running [PHP7](/posts/last-flight-php7/) or at least PHP 5+ If not
- You have basic knowledge of PHP & server administration
- There are two method I would like to explain:

#### Using shell_exec and exec

shell_exec and exec both functions used for execute command via shell. shell_exec returns all of the output stream as a string. exec returns the last line of the output by default, but can provide all output as an array specifed as the second parameter.

```sh 
shell_exec("SSH user@host.com mkdir /testing");
```

shell_exec or exec can be very effective when you have a very small task to perform. But now when you have to execute a many task.

#### Using phpseclib Library

phpseclib is designed to be ultra-compatible. It works on PHP4+ (PHP4, assuming the use of [PHP_Compat](http://pear.php.net/package/PHP_Compat)) and doesn’t require any extensions. For purposes of speed, mcrypt is used if it’s available as is gmp or bcmath (in that order), but they are not required.

Here is how to use the **phpseclib** library.

```php
<?php
include('Net/SSH2.php');
$ssh = new Net_SSH2('www.example.com');
if (!$ssh->login('username', 'password')) {
    exit('Could not logged in');
}
echo $ssh->exec('pwd');
echo $ssh->exec('ls -la');
?>
```

If you needed to upload or download files to remote server ([SCP](/tags/scp/))  command than the phpseclib now supports the SCP in recent versions (since version 0.3.5, released in June 2013). Here is the example.

```php 
<?php
include('Net/SFTP.php');
$sftp = new Net_SFTP('www.domain.tld');
if (!$sftp->login('username', 'password')) {
    exit('Login Failed');
}
// puts a three-byte file named filename.remote on the SFTP server
$sftp->put('filename.remote', 'xxx');
?>
```

I hope that some of this is useful to a few of you. There is always an room for improvements. Leave a note in the comments if you have any cool tricks for the LAMP installation. I’m always on the lookout for fun hacks.
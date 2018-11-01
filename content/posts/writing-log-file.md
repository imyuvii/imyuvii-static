---
title: "Writing output to your own log file"
date: 2017-02-02T13:56:12-05:00
showDate: true
draft: false
categories: [web]
tags: ["wordpress","log"]
description: "This article is about writing output in a log file. It explains how to create a log file in php where one can log desired part of code."
---

Not able to trace issue in production environment? There are many ways to do so, XDEBUG is one of preferred way to debug php website remotely. However, installing and configuring it can be a lengthy process, Specially when web hosting is not in your control. In order to fix the issue in one of my client’s website, I came up with a solution where I can output desired part of code in my own log file. Well, It is not a perpetual solution but it does the trick.

### Writing your own log file
    
- Copy and paste following method in end of the file

```php
function custom_logs($message) { 
    if(is_array($message)) { 
        $message = json_encode($message); 
    } 
    $file = fopen("../custom_logs.log","a"); 
    echo fwrite($file, "\n" . date('Y-m-d h:i:s') . " :: " . $message); 
    fclose($file); 
}
```

- Call method from anywhere in the file, For example add following code to `wp-content/themes/<your_theme>/header.php`

```php
custom_logs("Hey! I am in a header");
$array_value = array("foo","bar");
custom_logs($array_value);
```

- find the custom_logs.log in web root of your WordPress installation. Assume you have access your website three times than output will be

```composer log
2017-02-01 09:41:49 :: Hey! I am in a header
2017-02-01 09:41:49 :: ["foo","bar"]
2017-02-01 11:14:19 :: Hey! I am in a header
2017-02-01 11:14:19 :: ["foo","bar"]
2017-02-01 07:10:32 :: Hey! I am in a header
2017-02-01 07:10:32 :: ["foo","bar"]
```

Congratulations, you have just created your own log file. I am sure this is one of the compelling thing to do as a developer!

I hope this is useful to a few of you. There is always an room for improvements. Leave a note in the comments if you have any cool tricks for writing log file. I’m always on the lookout for fun hacks.

Checkout other article written on [SSH config file](/posts/ssh-config-file-rescue/).
---
title: "Display code on your WordPress post"
date: 2017-01-27T13:56:12-05:00
showDate: true
draft: false
tags: ["wordpress"]
---
[this one]: https://www.web2generators.com/html-based-tools/online-html-entities-encoder-and-decoder
[Configure virtual host on CentOS]: /posts/configure-virtual-host-centos/
Many bloggers do not run a development blog, so they don’t need to add sample code snippets in their posts very often. For rare occasions, you can add code by encoding the code into HTML entities. Like this `&gt;?php echo "Hello World"; ?&lt;`

### Why Displaying Code is Difficult
To understand why displaying code is difficult you need to know some basic HTML. The code for making some bold text is to surround it in a tag. To create the bold text in that sentence I actually wrote `<strong>bold text</bold>` into my WordPress editor.

Showing code on your site can be tricky if you don’t know how.
So far so good, but now for the hard part: What if I want to show you how I did it?

Any time I type `<strong>` into the editor it gets interpreted as **HTML** code, which means it will disappear and instead be used to embolden the text.

### How to display code block
The problem with converting code into HTML entities is that it is difficult to do manually. You can use online tools like [this one], to convert code into HTML entities.

By converting PHP, HTML, JavaScript code into HTML entities, you can paste them into your WordPress posts. For additional styling you can wrap code between `<code>` and `</code>` tags.

Here is the tutorial on how I added a code block in my previous blog [Configure virtual host on CentOS].

- Copy your code and encode it from [this one].

- Switch your editor to text from visual and paste encoded code in between `<pre></pre>` tags.

- Add following css to enhance code block styling

```css
pre { background: #fafafa; border: 1px solid #eaeaea; padding: 10px; }
```

- This is how your code block will look like

```html
<html> 
<head><title>Welcome to Example.com!</title></head> 
<body>
    <h1>Success! The example.com virtual host is working!</h1>
</body>
</html>
``` 

We hope this article helped you find the best syntax highlighter plugin for WordPress. If you like this article than please follow me on [twitter](https://twitter.com/imyuvii)
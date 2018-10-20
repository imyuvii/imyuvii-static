---
title: "How to optimize website performance"
date: 2017-02-19T13:56:12-05:00
showDate: true
draft: false
tags: ["web"]
---

### What is website optimization?
Website optimization (often referred to as conversion optimization) is the process of systematically improving the performance of your website to meet your business objectives. Read full article to understand importance of website optimization, And if you are in hurry than jump to [Optimise website section](#optimise-tips).

Whether your goal is to get more leads, sales, or reduce customer service phone calls, website optimization can be used to make your website more effective at meeting those goals.

### Why is website optimization important?
Website optimization is important because it helps your website visitors be more successful with their visits to your website. Every visitor comes to your site hoping to answer a question, find a solution to their problem, or complete a task of one kind or another. When you optimize your website you are making it easier for your site visitors to accomplish those tasks.

For example, if you are an e-commerce website that sells shoes, you can optimize your website to increase the number purchases made by people visiting your website. You can do this through conversion rate optimization, which is focused on systematically a/b testing different parts of your website to increase this conversion rate.

When you optimize your website, your site becomes more effective for your business. A more effective website can increase revenue for your business through new sales or leads, and reduce cost, through better conversion rates on existing marketing spend, or by reducing customer support needs through better information and clarity for visitors with questions.

![website-optimization](/posts/images/website-optimization.png)

### Optimise website performance
Now that you have run some tests on your website to see where the delay or load is, it is now time to start optimizing, follow these optimization tips below.

#### 1. Image Optimization
Here are some other 3rd party tools you can also utilize for image compression.

##### Image mini-fy plugins for the automated task systems
> According to a 2016 report from HTTP Archive, on average, 64 percent of a website’s page weight is made up of images. – HTTP Archive

- Grunt: [grunt-contrib-imagemin](https://www.npmjs.com/package/grunt-contrib-imagemin)
- Gulp: [gulp-imagemin](https://www.npmjs.com/package/gulp-imagemin/)

##### 3rd Party Online Tools
- [TinyPNG](https://tinypng.com/?utm_source=KeyCDN&utm_medium=link)
- [Kraken.io](https://kraken.io/?utm_source=KeyCDN&utm_medium=link)
- [JPEGmini](http://www.jpegmini.com/?utm_source=KeyCDN&utm_medium=link) (app available for OSX, iOS, Windows)

##### Local Tools
- [ImageAlpha](http://pngmini.com/?utm_source=KeyCDN&utm_medium=link) (Mac)

Also make sure to take advantage of responsive images using HTML `srcset` and `sizes` attributes to serve different scaled images based on the size of the display.

#### 2. Minify CSS and Javascript
Minification of resources means removing unnecessary characters from your HTML, Javascript, and CSS that are not required to load, such as:

- White space characters
- New line characters
- Comments
- Block delimiters

This speeds up your load times as it reduces the amount of code that has to be requested from the server.

##### Minify plugins for the automated task systems
###### JavaScript
- Grunt: [grunt-contrib-uglify](https://www.npmjs.com/package/grunt-contrib-uglify/?utm_source=KeyCDN&utm_medium=link)
- Gulp: [gulp-uglify](https://www.npmjs.com/package/gulp-uglify/?utm_source=KeyCDN&utm_medium=link)

###### CSS

- Grunt: [grunt-contrib-cssmin](https://www.npmjs.com/package/grunt-contrib-cssmin/?utm_source=KeyCDN&utm_medium=link)
- Gulp: [gulp-minify-css](https://www.npmjs.com/package/gulp-minify-css/?utm_source=KeyCDN&utm_medium=link)

If you are using WordPress you can also minify your CSS and Javascript with [WordPress Cache Enabler](https://wordpress.org/plugins/cache-enabler/).

#### 3. Reduce HTTP Requests
When your browser fetches data from a server it does so using HTTP (Hypertext Transfer Protocol). It is a request/response between a client and a host. In general the more HTTP requests your web page makes the slower it will load.

There are many ways you can reduce the number of requests such as:

- Inline your Javascript (only if it is very small)
- Using CSS Sprites
- Reducing assets such as 3rd party plugins that make a large number of external requests
- Don’t use 3rd party frameworks unless they are absolutely needed
- Use less code!
- Combining your CSS and JS files (with HTTP/2 concatenation is no longer as important)

The number of requests a particular website must make varies greatly from site to site. Running a site speed test will tell you how many requests were needed in order to generate a particular page.

#### 4. Render Blocking Resources (CSS + JS)
When it comes to analyzing the speed of your web pages you always need to take into consideration what might be blocking the DOM, causing delays in your page load times. These are also referred to as render blocking resources, such as HTML, CSS (this can include web fonts), and Javascript. Here are a few recommendations on how to prevent your CSS and Javascript from blocking the DOM by optimizing your critical rendering path.

##### CSS
- Properly call your CSS files
- Use media queries to mark some CSS resources as non-render blocking
- Lessen the amount of CSS files (concatenate your CSS files into one file)
- Minify Your CSS (remove extra spaces, characters, comments, etc)
- Use less CSS overall

##### Javascript
When it comes to Javascript there are some best practices to always keep in mind.

- Move your scripts to the bottom of the page right before your `</body>` tag.
- Use the async or defer directive to avoid render blocking.
- Concatenate your JS files into one file (with HTTP/2 this is no longer as important)
- Minify your Javascript (remove extra spaces, characters, etc)
- Inline your javascript if it is small

Async allows the script to be downloaded in the background without blocking. Then, the moment it finishes downloading, rendering is blocked and that script executes. Render resumes when the script has executed.

```html
<script src="foobar.js" async></script>
```

Your other option is to defer javascript. This directive does the same thing as async, except it guarantees that scripts execute in the order they were specified on the page. Patrick Sexton has a good example of [how to defer loading of javascript](https://varvy.com/pagespeed/defer-loading-javascript.html) properly.

We also discuss your options for  web fonts further down in this post.

#### 5. PHP7 and HHVM
Keeping the various components of a web server up to date is critical for reasons such as security patches, performance upgrades, and so on. If you are using PHP, upgrading to PHP7 can help greatly improve performance as compared to PHP 5.6. As well as taking advantage of HHVM.

![PHP 7](/posts/images/php7-2.png)

Based on the results from the above image, PHP7 is able to handle 204 requests per seconds compared to PHP 5.6’s 96 in WordPress 3.6 Additionally, PHP7 is able to handle 183 more requests than PHP5.6 in WordPress 4.1.

HHVM, an open-source VM used by websites like Facebook also been shown to produce good results. When testing PHP 7 and HHVM Kinsta got slightly different results from Zend. From their conclusions [HHVM wins hands down](https://kinsta.com/blog/the-definitive-php-7-final-version-hhvm-benchmark/).

#### 6. Enable Gzip Compression
Gzip is another form of compression which compresses web pages, CSS, and javascript at the server level before sending them over to the browser. You can check if your site is already compressed by using [Check GZIP Compression](http://checkgzipcompression.com/). This website performance optimization is easy to implement and can make a big difference.

> GZIP compression saves 50% to 80% bandwidth and will therefore significantly increase the website’s loading speed. –Check GZIP compression

#### 7. Infrastructure
Having a fast web host is equally as important as any website performance optimization you could make, as it is the backbone of your site. Stay away from cheap shared hosting. We suggest going with a VPS or if you are running WordPress or Drupal, a managed host, depending upon your level of expertise and time.

[Digital Ocean](https://m.do.co/c/eb1e6a3d8243) is a great cloud VPS provider and you can get started running your website for as little as $5/month. They feature SSDs, 1Gbps network, a dedicated IP address, and you can easily scale up or down in a matter of seconds.

### Summary
As you can see there are hundreds of different website performance optimization tweaks you can implement to further improve on the delivery and speed of your content. From image optimization, to implementing a CDN, to browser and server caching, taking advantage of HTTP/2, Gzip, PHP7, HHVM, and much more!

Are there some website performance optimization tips that we left out? If so feel free to let us know below.


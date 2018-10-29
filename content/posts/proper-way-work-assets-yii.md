---
title: "Proper way to work with assets in Yii"
date: 2017-05-02T13:56:12-05:00
showDate: true
draft: false
categories: [web]
tags: [optimization, performance, website]
---
Did you notice? Yii creates strange set of directories names like 8523d23 or 10s89b92 in assets directory, and this even happens at runtime.

#### Yii Assets

Many applications are entirely self contained, and there’s no trouble or conflict putting necessary resources (images, CSS files, Javascript files, etc.) under the webroot:

- webroot/css/*
- webroot/js/*
- webroot/images/*

and so on. If a module needs to add one more resources, it’s added directly and referenced by the path down from webroot.

But if one creates a module intended for widespread reuse elsewhere, naming conflicts start to emerge: How do you insure that your filename `css/foo.css` won’t conflict with some unrelated application’s attempt to use a file of the same name? Likewise with Javascript, images, and all the rest. This gets more difficult the more popular the module gets: it’s going to eventually conflict with something.

#### Asset Manager

Yii addresses this by use of CAssetManager, available as `Yii::app()->assetManager`, which can take a module’s private resource files and automatically publish them to the web-visible area (typically, webroot/assets/) on demand, giving the assets a non-conflicting unique name that can be later referenced in the code.

Module’s resources will be used first time once publishing is done and returning a URL to the application to use when generating HTML.

By calling `Yii::app()->assetManager->publish()` some stylesheets, images, scripts, or even entire directories can be put into a web-visible folder.

pager.css and other non-familiar files are produced by widgets (CLinkPager for example) and other components (such as CClientScript publishes jQuery whenever you need that).

During deployment, this folder should be empty, but it doesn’t really matter.

Adding plugins should never be done through framework folders. You can place them either in components dir and publish it runtime if necessary, or into any other convenient visible directory (like as images or css).

#### Example

To embed `jquery.charcounter.js`, put it in components directory, then call

```php 
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->assetManager->publish(
        Yii::getPathOfAlias('application.components').'/jquery.charcounter.js'
    ),
    CClientScript::POS_END
);
```

Regarding weird folder names, I firmly believe they are unique hashes (or part of), so they can be differentiated if application uses several extensions.

#### Maintenance

- It’s important that the directory be writable by the webserver user so that Yii can publish the resources there when needed.
- When a project has multiple versions (production, testing, development, etc.) do not copy the assets/folders from one area to another; allow Yii to deploy them automatically in each area.
- Do not manually edit any file under assets/ – if you have a real need to make a change, find the publishing module, edit the source, delete the subfolder under assets/, and let Yii re-publish the updated files.
- Do not reference names under the assets/ folder directly (say, to get at some other module’s assets). If you need to use that
- Do not add the contents of the assets/ folder to any source-code control system; these files have master source in other places.
- It is safe to delete everything under assets/. Yii will re-publish the assets if they are not found under assets/.

I hope this article will help you in understanding one of the core area of Yii Framework. I will be writing few more articles on Yii as it is one of my favourite MVC framework. [Write me](/contact-me) if you have any queries regarding this or simply comment below.
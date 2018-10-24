---
title: "Distribute your iPhone app over the air"
date: 2017-08-05T13:56:12-05:00
showDate: true
draft: false
tags: ["distribution", "ipa", "manifest", "web"]
---

Do you need to download and install an ipa directly from an URL? Is it possible? The answer is yes, to distribute your app over-the-air (OTA, this means without using TestFlight or the official App Store), you may need to create 3 different files, namely:

- your_App.ipa (The .ipa file using an ad-hoc provisioning profile)
- index.html
- manifest.plist

There are two ways of generating above mentioned files:

1. Using Beta Builder (MacOS only)
2. Manually

#### Using Beta Builder

- Archive your build.
- Save the .ipa on the Desktop.
- Download a small utility [Beta Builder](http://www.hanchorllc.com/betabuilder-for-ios/) from here. This does most of the required task.
- Open the tool and select your .ipa file, then provide the path you will be placing the build on https://myWeb.com/MY_TEST_APP in the beta builder.
- Generate all the files.
- Now upload index.html, your_App.ipa, & manifest.plist to your server path https://myWeb.com/MY_TEST_APP
- Now share the link of index.html. Once you open this file, you will be asked to Tap on install.
- It will install your_App.ipa on your device.

You can also do this more manually.

#### Manually

First create index.html file

```html
<a href="itms-services://?action=download-manifest&url=https://myWeb.com/MY_TEST_APP/manifest.plist">
Tap Here to Install<br />Your App 1.0 <br />Directly On Your Device
</a>
```

Create manifest.plist
```xml
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
    <key>items</key>
    <array>
        <dict>
            <key>assets</key>
            <array>
                <dict>
                    <key>kind</key>
                    <string>software-package</string>
                    <key>url</key>
                    <string>https://myWeb.com/MY_TEST_APP/your_App.ipa</string>
                </dict>
            </array>
            <key>metadata</key>
            <dict>
                <key>bundle-identifier</key>
                <string>com.domain.your_app</string>
                <key>bundle-version</key>
                <string>1.0 (4)</string>
                <key>kind</key>
                <string>software</string>
                <key>title</key>
                <string>Your App</string>
            </dict>
        </dict>
    </array>
</dict>
</plist>
```

Host these files on an HTTPS server. You can use Dropbox for this if necessary.

**Notes:** If the app refuses to install or run, you may need to check the following items:

- The provisioning profile you’ve used when compiling/archiving your app
- The URLs in both _index.html_ and _manifest.plist_
- The plist file may possibly need to be hosted on an HTTPS server. You can use Dropbox for this if necessary.
- Your device UUIDs may need to be registered inside Apple Developer Center unless you have an Enterprise licence
- You may need to manually enable access to the app within `Settings > Profiles`
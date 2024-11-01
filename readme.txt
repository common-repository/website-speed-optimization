=== Website Speed Optimization ===
Contributors: thanminhtu
Tags: Website Speed Optimization
Donate link: https://www.paypal.me/tutm
Requires at least: 4.7
Tested up to: 5.4.1
Stable tag: 0.1.3
Requires PHP: 5.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/license-list.html#GPLCompatibleLicenses

Website Speed Optimization will help your website speed up page loading.

== Description ==
Website Speed Optimization will help your website speed up page loading.

= Main Fuction =
= CSS Optimization =

* Inline all CSS ==> One method to speed up the load times of web pages is to optimize the CSS delivery by inlining CSS scripts instead of requesting them through external files.
* Minify all CSS ==> CSS scripts found on web pages are usually not minimized, they usually contain extra characters, or extra lines, or unnecessary spaces.
* Move all CSS to footer ==> Page Speed measurement tools will usually recommend that you remove render-blocking JavaScript and CSS out of the <head> tag. This will prioritize loading other resources first to increase page loading speed.

= JS Optimization =

* Move all JS to footer ==> Page Speed measurement tools will usually recommend that you remove render-blocking JavaScript and CSS out of the <head> tag. This will prioritize loading other resources first to increase page loading speed.
* Inline all JS ==> Inline JS will reduce the number of requests to the server, and Inline JS will avoid blocking the initial page load to help the website be more appreciated.
* Minify all JS ==> Minify JS will eliminate unnecessary characters, making it less expensive to load the page

= Html Optimizations =

* Minify HTML

Minification refers to the process of removing unnecessary or redundant data without affecting how the resource is processed by the browser - e.g. code comments and formatting, removing unused code, using shorter variable and function names, and so on.

= Add Expires headers =

* Set expires header CSS
* Set expires header JS
* Set expires header Media

Expires headers tell the browser whether they should request a specific file from the server or whether they should grab it from the browser's cache.

The whole idea behind Expires Headers is not only to reduce the load of downloads from the server (constantly downloading the same file when it's unmodified is wasting precious load time) but rather to reduce the number of HTTP requests for the server.

When you visit a website your browser is responsible for communicating with the web server to download all the required files. It then compiles those files to display the web page. As web pages become richer in graphics and content, more and more files are being transferred between your machine and the web server.

In the past you would have an HTML file and maybe a few images to serve for your website, however many modern websites might have 50+ files per page to transfer. The files themselves can be a huge load increase by themselves but for each file you must create a request and even if requests are fractions of a second, they can soon add up. [Source](https://gtmetrix.com/add-expires-headers.html)

= Cache CSS JS =

* Cache Css
* Cache Js

Help website handle faster during page loading.

---

== Installation ==
* PHP version 5.4 or greater (PHP 5.6 or greater is recommended)
* MySQL version 5.5 or greater (MySQL 5.6 or greater is recommended)

Install from the wordpress plugin repository. After installation and activation.
Website Speed Optimization Menu is installed for the plugin.

== Frequently Asked Questions ==

= Why CSS, JS, HTML Optimization =
* Minification refers to the process of removing unnecessary or redundant data without affecting how the resource is processed by the browser - e.g. code comments and formatting, removing unused code, using shorter variable and function names, and so on.

= Why Add Expires headers =
* Expires headers tell the browser whether they should request a specific file from the server or whether they should grab it from the browser's cache.

* The whole idea behind Expires Headers is not only to reduce the load of downloads from the server (constantly downloading the same file when it's unmodified is wasting precious load time) but rather to reduce the number of HTTP requests for the server.

* When you visit a website your browser is responsible for communicating with the web server to download all the required files. It then compiles those files to display the web page. As web pages become richer in graphics and content, more and more files are being transferred between your machine and the web server.

* In the past you would have an HTML file and maybe a few images to serve for your website, however many modern websites might have 50+ files per page to transfer. The files themselves can be a huge load increase by themselves but for each file you must create a request and even if requests are fractions of a second, they can soon add up. [Source](https://gtmetrix.com/add-expires-headers.html)

== Screenshots ==

1. Website Speed Optimization
2. Website Speed Optimization
3. Website Speed Optimization

== Changelog ==

= 0.1.3 =
* Release date: 2020/05/07
* Fix icon dashicons
* Inline Jquery library

= 0.1.2 =
* Release date: 2019/10/31
* Update Logo, banner
* Add Option CDN Jquery
* Add Option Cache Css, Js
* Fix code Inline Js

= 0.1 =
Plugin Beta

== Upgrade Notice ==
= 0.1 =
No Upgrade
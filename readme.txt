=== Sliding Image Gallery XML v6 ===
Contributors: flashblue
Tags: banner, rotator, xml, slide, slideshow, as3, flashblue, html, content, x, y, position, jpg, gif, png, swf, random, radius, url, link, timer, target, order, clock, left, center, right
Requires at least: 2.8.0
Tested up to: 3.0.1
Stable tag: trunk

Dynamic sliding image gallery for product showcase / banner rotators.

== Description ==

Features included:

* First visible item
* Rounded corner radius
* Transition type to x, y or alpha. (Default value is x)
* Duration / delay time of each item
* Show / hide buttons
* Show / hide content
* Set blur values (0 to not blur)
* Content background alpha, bgcolor, bottom padding
* Rollover, rollout, selected color of texts on buttons
* Color - font size of title & description contents
* CSS file path
* You can change button positions to left or right by XML
* Auto-scroll just appears if you enter more than 5 items
* Includes WordPress plugin & Joomla module
* Supports HTML formatting
* Includes a html swfObject embed example with parameters
* Help file is included

== Installation ==

Make sure your Wordpress version is greater than 2.8 and your hosting provider is using PHP5.

1. Create a new folder inside your **wp-content** folder called **flashdo**, inside this folder create a new one called **flashblue**, inside this folder create a new one called **sliding-image-gallery-xml-v6** and copy files under **deploy** folder there
2. If you copied the **deploy** to a location different than the one above, go to **Sliding Image Gallery XML v6** from the **Settings** tab in your **WordPress Dashboard** and update the path accordingly
3. Add `[sliding-image-gallery-xml-v6][/sliding-image-gallery-xml-v6]` where you want the Flash to show up in your post/page
4. If you want to make the Sliding Image Gallery XML v6 part of your theme, edit the template files and add `<?php slidingimagegalleryxmlv6_echo_embed_code(); ?>` where you want it to show up
5. Modify the `banner.xml` content and use it to overwrite `wp-content/flashdo/flashblue/sliding-image-gallery-xml-v6/xml/banner.xml`
6. To use your own images / swf, upload them to `wp-content/flashdo/flashblue/sliding-image-gallery-xml-v6/images/`

= Additional settings file =

To embed the Sliding Image Gallery XML v6 more than once, you will need another settings file and (probably) another set of images. Let's assume your new file is called `banner2.xml`. Add `[sliding-image-gallery-xml-v6 xmlUrl="xml/banner2.xml"][/sliding-image-gallery-xml-v6]` where you want the Flash to show up in your post/page. If you made the Flash part of your theme, add the file name as **the first argument** of the `slidingimagegalleryxmlv6_echo_embed_code()` function call (for example `<?php slidingimagegalleryxmlv6_echo_embed_code("banner2.xml"); ?>`).

= No Flash support text =

To support visitors without Adobe Flash Player, you can provide alternative content by adding the text between `[sliding-image-gallery-xml-v6]` and `[/sliding-image-gallery-xml-v6]`. If you made the Flash part of your theme, add the text as **the second argument** of the `slidingimagegalleryxmlv6_echo_embed_code()` function call (for example `<?php slidingimagegalleryxmlv6_echo_embed_code("","Alternative content"); ?>`).

= If you have PHP4 =

To make it work with PHP4, add `[sliding-image-gallery-xml-v6 width="700" height="299"][/sliding-image-gallery-xml-v6]` where you want the Flash to show up in your post/page. If you made the Flash part of your theme, add the width and height as **the third and fourth argument** of the `slidingimagegalleryxmlv6_echo_embed_code()` function call. Don't forget to provide your own width and height values, since 700 and 299 are just examples.

== Screenshots ==

1. You can view the live demo on [flashdo.com](http://www.flashdo.com/item/sliding-image-gallery-xml-v6/93 "Sliding Image Gallery XML v6") for Sliding Image Gallery XML v6.
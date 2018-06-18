=== Shortodes Ultimate: Extra Shortcodes ===
Requires at least: 3.5
Tested up to: 5.0
Author: Vladimir Anokhin
License: license.txt
Stable tag: trunk
Contributors: Vladimir Anokhin
Tags: shortcodes-ultimate-add-on


== Description ==

Extra set of shortcodes for Shortcodes Ultimate. [Add-on page](https://getshortcodes.com/add-ons/extra-shortcodes/).

= System requirements =

* WordPress 3.5 or higher
* Shortcodes Ultimate 5.0 or higher
* PHP 5.2 or higher

= Support =

* [Getting started](http://docs.getshortcodes.com/category/27-common-questions)
* [Add-on documentation](http://docs.getshortcodes.com/category/29-extra-shortcodes-add-on)
* [Get support](https://getshortcodes.com/support/)


== Installation ==

This add-on is distributed as a regular zipped plugin. You can install it like any other plugin. Navigate to Dashboard -> Plugins -> Add New -> Upload plugin. Then select downloaded zip-archive and click on "Install now" button. [Learn more](http://docs.getshortcodes.com/article/56-how-to-install-add-on).


== Changelog ==

= 1.5.11 =
* Fixed: scrolling issue with progress bars/pies in Samsung Internet Browser
* Changed: Inview.js library replaced with [jQuery.Inview](https://github.com/protonet/jquery.inview)
* Added: [su_panel], [su_photo_panel], [su_icon_panel] and [su_icon_text] gets new attribute 'target', which allow to open panel links in a new window

= 1.5.10 =
* [Important change] Updated: OwlCarousel to version 2.2
* Improved: compatibility with 'Plugin Organizer'
* Added: 'Install core plugin' notice
* Fixed: panels width (panels were too wide on some themes)

= 1.5.9 =
* Fixed: section's parallax is now disabled on mobile devices
* Fixed: PHP warning at settings page, when license key is saved

= 1.5.8 =
__IMPORTANT:__ this add-on requires __Shortcodes Ultimate version 5.0.0__ (or higher). Please update Shortcodes Ultimate before updating this add-on. [Upgrade guide](http://docs.getshortcodes.com/article/77-full-guidance-for-update-of-shortcodes-ultimate-from-version-4-to-version-5).

* Fixed: 'Invalid license key' error;
* Fixed: license key deactivation error;
* Added: saved license key is now hidden at plugin settings page;
* Added: new attribute 'background_position' for Section shortcode, [section background_position="left top"];
* Added: new attribute 'cover' for Section shortcode, [section cover="yes"];
* Updated: 'ru_RU' translation.

= 1.5.7 =
* Fixed: minor bugs in parallax section
* Improved: compatibility with Shortcodes Ultimate 5+
* Text domain changed from 'sue' to 'shortcodes-ultimate-extra'
* Languages folder renamed from 'lang' to 'languages'

= 1.5.6 =
* Added: alt attribute for photo panels
* Tested compatibility with WordPress 4.4

= 1.5.5 =
* Fixed: JS error blocking multiple progress bars
* Fixed: parallax can now be disabled for iPad tablets

= 1.5.4 =
* Added: new shortcode [exit_popup]

= 1.5.3 =
* Added: new option for [section nomobile="yes"]. Parallax effect can now be disabled for mobile devices (screen width less than 768px)

= 1.5.2 =
* Images and headings support for pricing tables
* Updated Russian translation

= 1.5.1 =
* Fixed: [pie_chart] is now animated only when scrolled in

= 1.5.0 =
* Auto-updates that works!

= 1.2.2 =
* Responsive pricing tables

= 1.2.1 =
* Fixed issue with YouTube shortcode inside of content slider (Firefox)
* Fixed pricing tables height
* New attribute for [splash]screen once="yes|no" - determines whether to show splashscreen only once per user visit

= 1.1.0 =
* Added source files links to the settings page
* Added examples under settings menu (Dashboard -> Shortcodes -> Examples)

= 1.0.1 =
* Added touchmove event handling for mobile devices (parallax sections)
* New option btn_target for [plan]
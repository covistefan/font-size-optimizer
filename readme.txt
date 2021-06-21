=== Font Size Optimizer ===
Contributors: appleuser
Tags: fontsize, font-size, optimize-font-size, optimize, schriftgroesse, optimieren, jquery, schriftgröße
Requires at least: 4.0
Tested up to: 5.7
Stable tag: 3.4
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=5762TWVRT6RQ4
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Optimize font size to parent element width

== Description ==
If text would overflow parent element and you dont like the css word-wrap feature, because it breaks the words on the false position, this function optimizes font size down to a minimum font size that can be defined to fit in the parent element

== Frequently Asked Questions ==
= Can I use deep combinations of selectors? =
Of cause you can. For example, if you set the element-list to `.post-content h1, .post-content h2, .post-content h3`, only the headlines in elements with class `post-content` will be affected

== Screenshots ==

== Installation ==
1. Upload `font-size-optimizer` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Define options from settings panel

== Changelog ==
= 3.4 =
* fixed an error when reloading admin page caused removal of all definitions 
= 3.3 = 
* added some sanitizing
* fixed the error, where last set in list could not be removed
* added some markup when duplicating a set
= 3.2.2 =
* german language pack added
= 3.2.1 =
* fixed an error where execution was loaded before initialization
= 3.2 =
* added some helping descriptions when removing an allocation
* updated stylesheet 
* updated script
= 3.1.1 =
* fixed an error where script was loaded before jquery so it couldn't access jquery-functions 

= 3.1 =
* changed debug mode output
* updated/fixed stylesheet loading

= 3.0 =
* added debug mode
* changed calculation of font size

= 2.2 =
* added feature of spanning single or multiple lines of text to container width by changing font size for every single line
* added feature of autochanging line height for multiple lines of text

= 2.0 =
* added ability to support different selectors with different options
* preview of jquery-function, that will be added to your page
* minimized js-files
* minor translation fixes
= 1.0 =
* first release
=== Subscribe / Connect / Follow Widget ===
Contributors: SriniG
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=XYTQW7TUDMU66
Tags: widget, subscribe, connect, follow, buttons, icons, image links, feed, rss, rss-feed, email, feedburner, twitter, facebook, behance, blogger, delicious, diaspora, digg, deviant-art, flickr, foursquare, friendfeed, google, google plus, identica, lastfm, linkedin, myspace, picasa, pinterest, podcast, posterous, reddit, skype, slashdot, soundcloud, stumbleupon, technorati, tumblr, vimeo, xing, youtube
Requires at least: 2.8
Tested up to: 4.2.2
Stable tag: trunk
License: GNU General Public License

The widget displays image links (icon buttons) to various subscription services and social networking sites. More than 40 services supported.

== Description ==

This plugin provides a widget that displays image links (icon buttons) to various subscription services and social networking sites in your sidebar (or any widget holder). Helps users in easily finding links to subscription services like RSS feed, email subscriptions, podcast, etc., follow the website's Facbeook and Twitter pages, etc., and connect via various social networking sites.

= Features =

* More than 40 services supported
* The widget can display upto 5 links at a time, though this number can be extended easily (see other notes).
* Output format for the links can be one of these five:
	* 32px images (default) 
	* 24px images 
	* 16px images
	* text links with image
	* text links.
* Other widget options include
	* Widget title
	* Option to select an alignment for images
	* Option to open the links in new window
	* Number of items *(new in 1.0)*
* Multiple instances of the widget can be had at the same time
* Uses WP_Widget class

= Supported subscription services and social sites =

* Behance *(new in 1.0)*
* Blogger Blog
* Delicious
* Diaspora
* Digg
* deviantART
* Dribbble
* Email *(new in 1.0)*
* Etsy
* Facebook
* Feedburner Email Subscription
* Feedburner Feed
* Flickr
* Foursquare *(new in 1.0)*
* FriendFeed
* GitHub
* Goodreads
* Google Profile
* Google Plus
* identi.ca
* Instagram
* Last.fm
* LinkedIn
* Myspace
* Picasa Web Albums
* Pinterest
* Podcast
* Posterous
* Quora
* reddit
* RSS Feed
* RSS Feed for Posts
* RSS Feed for Comments
* Skype *(new in 1.0)*
* Slashdot
* SlideShare
* SoundCloud
* StumbleUpon
* Technorati
* Tumblr
* Twitter
* Vimeo
* WordPress.org Profiles
* WordPress.com Blog
* XING
* YouTube

= Credits =

* The plugin uses [Social Media Icons](http://icondock.com/free/vector-social-media-icons) from IconDock.
* Diaspora icons by [CreativeKaizen](http://creativekaizen.deviantart.com/art/Diaspora-Icon-Set-257241499).
* Goodreads icons by [Paul Robert Lloyd](http://paulrobertlloyd.com/2009/06/social_media_icons/).

== Installation ==

**Method 1**

1. Go to *Plugins -> Add New* in your WordPress admin area
1. Type 'subscribe connect follow widget' in the search box available and hit the 'Enter' key
1. Locate the 'Subscribe / Connect / Follow Widget' plugin authored by Srini G, and click 'Install Now'

**Method 2**

1. Dowload the latest version of the plugin from WordPress plugin directory
1. Go to *Plugins -> Add New* in your WordPress admin area
1. Click on the 'Upload Plugin' button at the top, near 'Add Plugins'
1. Browse and select the zip file you just downloaded, and click 'Install Now'

**Method 3**

1. Dowload the latest version of the plugin from WordPress plugin directory
1. Extract the zip file
1. Using a FTP client or something similar, upload the `subscribe-connect-follow-widget` directory to the `~/wp-content/plugins/` directory of your WordPress installation.

After installation, the plugin can be activated from *Plugins -> Installed Plugins* in your WordPress admin area. Once activated, the widget can be found and added from the *Widgets* menu.

== Frequently Asked Questions ==

= What is the difference between the 'Feedburner Feed' and 'RSS Feed' options? =

There are two differences. 

1. The 'Feedburner Feed' option displays the Feedburner icon while the 'RSS Feed' option displays the standard RSS icon (as do 'RSS Feed for Posts' and 'RSS Feed for Comments' options).

2. For 'Feedburner Feed' you only need to provide the Feedburner feed name in the widget options and the URL for the link will be automatically generated, whereas for 'RSS Feed' you need to provide the full URL. 

The general 'RSS Feed' option (or 'RSS Feed for Posts' / 'RSS Feed for Comments', as applicable) can be used for a Feedburner feed when the standard RSS icon is preferred over the Feedburner icon.

= The number of items that can be added is 5 by default. How to add more items? =

Simply change the value of the 'Number of items' field in the widget options, for example, to 7, and *Save* your options. After saving you will find that you will have two more fields added and the total number of items you can now add is 7.

== Screenshots ==

1. Output when the '32px images' output format is selected
2. Output when the 'text links with image' output format is selected
3. Widget options

== Changelog ==

= 1.0.1 (2015-07-08) =
* Updating to PHP5 style constructor

= 1.0 (2015-04-24) =
* Added: Behance, Email, Foursquare, Skype
* New widget option field to specify the number of items
* Other improvements and fixes

= 0.5.7 (2012-12-15) =
* Fix for issues with multi-site and mapped domains
* Added: Dribbble, Etsy, GitHub, Goodreads, Instagram, Quora, SlideShare, WordPress.org Profiles
* Updated: Twitter, Google Plus, Stumbleupon
* Removed: Google buzz

= 0.5.6 (2011-12-29) =
* Pinterest and Diaspora added
* Google+ images updated to the new red icon

= 0.5.5 (2011-08-31) =
* SoundClound added
* Google+ images updated to icondock images
* Styling fixes

= 0.5.4 (2011-07-12) =
* Google+ added
* `height` and `width` attributes added to the `<img>` tags
* Fixes, mainly for notices that crop up in debug mode

= 0.5.3 (2011-06-10) =
* Xing added to the list of networks

= 0.5.2 (2011-03-29) =
* Styling fix, other minor changes

= 0.5.1 (2011-03-25) =
* Fix

= 0.5 (2011-03-21) =
* Public release

== Upgrade Notice ==

= 1.0.1 =
v1.0 adds Behance, Email, Foursquare and Skype + new widget option field to specify the number of items + other fixes and improvements. v1.0.1 updates to PHP5 style constructor.
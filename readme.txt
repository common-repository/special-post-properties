=== Special Post Properties ===
Contributors: dhoppe
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=1220480
Tags: post, posts, admin, featured, gallery, image, images, theme  
Requires at least: 3.0
Tested up to: 3.3
Stable tag: trunk

This Plug-in enables you to add some special properties like "featured post", "portfolio post" and "gallery post" to your posts.

== Description ==
With the "Special Post Properties" Plug-in you can easily mark your posts as

* "featured post",
* "portfolio post" and
* "gallery post".

Just tick the properties you want to add to your post in the "edit post" section.


= Requirements =
* **Special Post Properties Plug-in requires PHP5!**
* WordPress 3.0 or higher


= Widgets =
The plug-in comes with some useful widgets to show the special marked posts.

1. "Featured posts" Widget to show your featured posts,
1. "Gallery" Widget to show your gallery posts,
1. "Portfolio" Widget to show your portfolio posts,
1. "Random images" Widget to show random images out of your gallery posts.


= Customizations =

You can customize the appearance of the widgets by adding a template file to your theme directory. The php file defines the architecture and the css file defines the style information. You can find working example files of the templates in each widget directory in the plug-in folder. Just copy these files (or only the one you will overwrite) to your theme directory and customize it until it fit your needs.

* "Featured posts" Widget: *featured-posts-widget.php*, *featured-posts-widget.css*
* "Gallery" Widget: *gallery-posts-widget.php*, *gallery-posts-widget.css*
* "Portfolio" Widget: *portfolio-items-widget.php*, portfolio-items-widget.css*
* "Random images" Widget: *random-images-widget.php*, random-images-widget.css*

If you have question let me know. For a small fee i can help you writing a template.


= For developers =
Of course you can also talk with the plug-in. Here is a short documentation about the build in functions.

= Featured Posts =
<code>
Function wp_plugin_special_post_properties::get_featured_posts ($limit = -1){
/* This function returns an WP_Query object with all featured posts.
   $limit: The max number of posts you want to have.
           If $limit == -1 you get all featured posts.
   return: WP_Query object with the posts or
           (bool) False if there are no featured posts. 
*/
}

Function wp_plugin_special_post_properties::is_featured ($post_id = Null){
/* This function checks if a post is a featured post.
   $post_id: The id of the post you want to check.
             If $post_id == Null, the function reads from the current
             post in the loop.
   return: (bool) True if the post is a featured one or
           (bool) False if not.
*/
}
</code>


= Gallery Posts =
<code>
Function wp_plugin_special_post_properties::get_gallery_posts ($limit = -1){
/* This function returns an WP_Query object with all gallery posts.
   $limit: The max number of posts you want to have.
           If $limit == -1 you get all gallery posts.
   return: WP_Query object with the posts or
           (bool) False if there are no gallery posts. 
*/
}

Function wp_plugin_special_post_properties::is_gallery ($post_id = Null){
/* This function checks if a post is a gallery post.
   $post_id: The id of the post you want to check.
             If $post_id == Null, the function reads from the current
             post in the loop.
   return: (bool) True if the post is a gallery post or
           (bool) False if not.
*/
}
</code>


= Portfolio Posts =
<code>
Function wp_plugin_special_post_properties::get_portfolio_posts ($limit = -1){
/* This function returns an WP_Query object with all portfolio items.
   $limit: The max number of items you want to have.
           If $limit == -1 you get all portfolio items.
   return: WP_Query object with the posts or
           (bool) False if there are no portfolio items. 
*/
}

Function wp_plugin_special_post_properties::is_portfolio_item ($post_id = Null){
/* This function checks if a post is a portfolio item.
   $post_id: The id of the post you want to check.
             If $post_id == Null, the function reads from the current
             post in the loop.
   return: (bool) True if the post is a portfolio item or
           (bool) False if not.
*/
}
</code>

= Questions =
If you have any questions feel free to leave a comment in my blog. But please think about this: I will not add features, write customizations or write tutorials for free. Please think about a donation. I'm a human and to write code is hard work.

= Language =
* This Plug-in is available in English.
* Diese Erweiterung ist in Deutsch verfügbar. ([Dennis Hoppe](http://dennishoppe.de/))
* Acest plugin este disponibil în limba Română. ([Anunturi Jibo](http://www.jibo.ro/))

If you have translated this plug-in in your language feel free to send me the language file (.po file) via E-Mail with your name and this sentence translated in your language: "This plug-in is available in %YOUR_LANGUAGE_NAME%." So i can add it to the plug-in and link to your website from the plug-in page if you want.

You can find the *Translation.pot* file in the *language/* folder in the plug-in directory.

* Copy it.
* Rename it (to your language code).
* Translate everything.
* Send it via E-Mail to mail@DennisHoppe.de.
* Thats it. Thank you! =)


== Installation ==

Installation as usual.

1. Unzip and Upload all files to a sub directory in "/wp-content/plugins/".
1. Activate the plug-in through the 'Plugins' menu in WordPress.
1. Choose a post and go to the "Edit post" section.
1. Now you can choose some special options for this post.


== Changelog ==

= 1.1.4 =
* Added Romanian translation by [Anunturi Jibo](http://www.jibo.ro/).

= 1.1.3 =
* Fixed: Widget ignored the typed in limit. 


= 1.1.2 =
* Fixed: Random Images Widget will not output an error if there are no galleries.


= 1.1.1 =
* Read template directory with get_query_template()
* Read style sheet directory with get_stylesheet_directory()
* Template Engine should now work with child themes
* Fixed: You can hide the title of the posts in widgets now


= 1.1 =
* Added template engine
* Added Portfolio property
* Rewrite main class
* Inheritable Widget class


= 1.0.1 =
* Replaced constants by translatable strings in Featured posts Widget.
* Added Thumbnail support for gallery posts


= 1.0 =
* Everything works fine.
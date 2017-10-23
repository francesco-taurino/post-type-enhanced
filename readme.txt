=== Post Type Enhanced ===
Contributors: francescotaurino
Donate link: https://www.paypal.me/francescotaurino
Tags: post type, featured images, archive description
Requires at least: 4.7.0
Tested up to: 4.8.2
Requires PHP: 5.2.4
Stable tag: 1.0.4
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

== Description ==

Post Type Enhanced allows you to add a nice and helpful Post Type description. Includes the TinyMCE editor, featured images, and other features.

Post Type Enhanced Works like a taxonomy term description.
**Automatically works** for any theme that uses `the_archive_description()` like [Twenty Fifteen](https://wordpress.org/themes/twentyfifteen/), [Twenty Sixteen](https://wordpress.org/themes/twentysixteen/), [Twenty Seventeen](https://wordpress.org/themes/twentyseventeen/) or recent [underscores based themes](https://underscores.me).

By default, all post types registered with the has_archive argument set to true will be available. 

Post Type Enhanced comes with a lot of templates tags.

= Template tags =

    // Get post type description.
    // This is optimized for all .php theme template files
    pte_get_post_type_description(string $post_type );

    // The Post Type description
    // This is optimized for all .php theme template files
    pte_the_post_type_description( string $post_type );

    // Get Post Type Archive Description.
    // This is optimized for archive.php and archive-{posttype}.php template files 
    pte_get_post_type_archive_description();

    // The Post Type Archive Description.
    // This is optimized for archive.php and archive-{posttype}.php template files 
    pte_the_post_type_archive_description();

    // Get post type Image.
    // This is optimized for all .php theme template files
    pte_get_post_type_image( string $post_type, string|array $size = 'thumbnail' );

    // The post type Image.
    // This is optimized for all .php theme template files
    pte_the_post_type_image( string $post_type, string|array $size = 'thumbnail' );

    // Get post type Archive Image.
    // This is optimized for archive.php and archive-{posttype}.php template files 
    pte_get_post_type_archive_image( string|array $size = 'thumbnail' );

    // The post type Archive Image.
    // This is optimized for archive.php and archive-{posttype}.php template files 
    pte_the_post_type_archive_image( string|array $size = 'thumbnail' );


== Installation ==
 
1. Upload the `Post Type Enhanced` plugin to your WordPress site in the `/wp-content/plugins` folder or install via the WordPress admin.
2. Activate it from the WordPress plugin admin screen.

== View Settings ==

You need to click on the name of your custom post type to expand it and then click on the `Post Type Enhanced`. You will see a settings page.

== Note ==

Note: Post Type Enhanced is available only for admin users.
More info in [Italian language](https://www.francescotaurino.com/wordpress/post-type-enhanced)


== Screenshots ==

1. Screenshot 1
2. Screenshot 2
3. Screenshot 3
4. Screenshot 4
5. Screenshot 5
6. Screenshot 6
7. Screenshot 7

== Changelog ==

View a list of all plugin changes in [CHANGELOG.md](https://plugins.svn.wordpress.org/post-type-enhanced/trunk/CHANGELOG.md).




<?php if ( ! defined( 'ABSPATH' ) ) exit; 
/**
 * Post_Type_Enhanced_Public
 *
 * @package     Post_Type_Enhanced\Public
 * @author      Francesco Taurino <dev.francescotaurino@gmail.com>
 * @copyright   Copyright (c) 2017, Francesco Taurino
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
 */

if( !class_exists('Post_Type_Enhanced_Public') ) :

	add_filter('get_the_archive_description', array( 'Post_Type_Enhanced_Public', 'get_the_archive_description') );

	class Post_Type_Enhanced_Public implements iPost_Type_Enhanced  {

		/**
		 * Filters the post type archive description.
		 *
		 * @param 	string $description Archive description to be displayed.
		 * 
		 * @global 	$post_type;
		 * @access 	private
		 * 
		 * @return 	string $description Post Type Enhanced description or Archive description 
		 */
		public static function get_the_archive_description( $description ) {
			
			if( is_post_type_archive( Post_Type_Enhanced_Utils::get_post_types() ) ) :
				
				global $post_type;
				
				$description = Post_Type_Enhanced_Options::get_description( $post_type, 'display' );
				
			endif;

			return $description;

		}


	}

endif;
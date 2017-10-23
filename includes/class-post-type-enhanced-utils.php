<?php if ( ! defined( 'ABSPATH' ) ) exit; 
/**
 * Post_Type_Enhanced_Utils
 *
 * @package     Post_Type_Enhanced\Includes
 * @author      Francesco Taurino <dev.francescotaurino@gmail.com>
 * @copyright   Copyright (c) 2017, Francesco Taurino
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
 */
if( !class_exists('Post_Type_Enhanced_Utils') ) :


	class Post_Type_Enhanced_Utils implements iPost_Type_Enhanced  {


	  /**
		 * Get post types
		 * 
		 * @return array
		 */
		public static function get_post_types() {
			
			$args = array(
				'_builtin' => false,
				'has_archive' => true
			);
		
			return get_post_types( $args );
		
		}


		/**
		 * Does the logged-in user have the required capability?
		 * 
		 * @return bool
		 */
		public static function is_user_authorized() {

			foreach ( self::get_required_capability() as $cap ) {
			  if( ! current_user_can( $cap ) ) {
					return false;
			  }
			}

			return true;
		}


		/**
		 * Get required capabilities
		 *
		 * @see https://codex.wordpress.org/Roles_and_Capabilities
		 * @return array
		 */
		private static function get_required_capability() {
		  return array( self::REQUIRED_CAPABILITY );
		}

		
		/**
		 * WP 'the_content' filter
		 * 
		 * @param  string $original_text
		 * 
		 * @return string $original_text filtered
		 */
		public static function the_content_filter( $original_text ) {
			return apply_filters( 'the_content', $original_text );
		}


		/**
		 * Validate Boolean
		 *  
		 * @param  mixed  $val
		 * 
		 * @return bool  $val
		 */
		public static function validate_boolean( $val ) {
			return filter_var( $val, FILTER_VALIDATE_BOOLEAN );
		}


		/**
		 * Make sure $post_type is a valid post type
		 * 
		 * @param  string $post_type     	Post type name
		 * 
		 * @return bool           				True if valid
		 */
		public static function is_valid_post_type( $post_type ) {
		
			if( !post_type_exists( $post_type )  ) {

				return false;

			}

			if( !get_post_type_object( $post_type )->has_archive ) {

				return false;

			}

			return true;
			

		}


	}

endif;  
<?php if ( ! defined( 'ABSPATH' ) ) exit; 
/**
 * Public user functions.
 * 
 * @package     Post_Type_Enhanced
 * @author      Francesco Taurino <dev.francescotaurino@gmail.com>
 * @copyright   Copyright (c) 2017, Francesco Taurino
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
 */
if( !function_exists('pte_get_post_type_description') ):
	
	
	/**
	 * Get Post Type Description.
	 *
	 * @param 	string       $post_type 		Post type name
	 * @access 	public
	 * 
	 * @return 	string Post Type Enhanced or false
	 */
	function pte_get_post_type_description( $post_type = NULL ) {
		return Post_Type_Enhanced_Options::get_description( $post_type, 'display' );
	}


endif;


if( !function_exists('pte_the_post_type_description') ):

	
	/**
	 * The Post Type Description.
	 *
	 * @param 	string       $post_type 		Post type name
	 * @access 	public
	 * 
	 * @return 	void
	 */
	function pte_the_post_type_description( $post_type = NULL ) {
		echo pte_get_post_type_description( $post_type );
	}


endif;


if( !function_exists('pte_get_post_type_archive_description') ):

	
	/**
	 * Get post type archive description.
	 * 
	 * This is optimized for archive.php and archive-{posttype}.php template files 
	 * 
	 * @access 	public
	 * 
	 * @return 	string Post Type Enhanced 
	 */
	function pte_get_post_type_archive_description() {
				
		if( is_post_type_archive( Post_Type_Enhanced_Utils::get_post_types() ) ) :

			$post_type = get_query_var( 'post_type' );
			if ( is_array( $post_type ) )
				$post_type = reset( $post_type );
			
			return pte_get_post_type_description( $post_type );
				
		endif;

	}


endif;


if( !function_exists('pte_the_post_type_archive_description') ):


	
	/**
	 * The post type archive description.
	 * 
	 * This is optimized for archive.php and archive-{posttype}.php template files 
	 * 
	 * @access 	public
	 * 
	 * @return 	void
	 */
	function pte_the_post_type_archive_description() {
		echo pte_get_post_type_archive_description();
	}


endif;


if( !function_exists('pte_get_post_type_image') ):


	/**
	 * Get an HTML img element representing a Post type
	 *
	 * @param string       $post_type 		Post type name
	 * @param string|array $size					Optional. Image size. Accepts any valid image size, or an array of width
	 * 
	 * @return string HTML img element or empty string on failure.
	 */
	function pte_get_post_type_image( $post_type = NULL , $size = 'thumbnail' ) {
		return Post_Type_Enhanced_Options::get_image( $post_type, $size );
	}


endif;


if( !function_exists('pte_the_post_type_image') ):


	/**
	 * The Post type Image
	 *
	 * @param string       $post_type 		Post type name
	 * @param string|array $size					Optional. Image size. Accepts any valid image size, or an array of width
	 * 
	 * @return void 	HTML img element or empty string on failure.
	 */
	function pte_the_post_type_image( $post_type = NULL , $size = 'thumbnail' ) {
		echo pte_get_post_type_image( $post_type, $size );
	}


endif;


if( !function_exists('pte_get_post_type_archive_image') ):


	/**
	 * Get an HTML img element representing a Post type
	 *
	 * This is optimized for archive.php and archive-{posttype}.php template files 
	 * 
	 * @param string|array $size					Optional. Image size. Accepts any valid image size, or an array of width
	 * 
	 * @return string HTML img element or empty string on failure.
	 */
	function pte_get_post_type_archive_image( $size = 'thumbnail' ) {
				
		if( is_post_type_archive( Post_Type_Enhanced_Utils::get_post_types() ) ) :
			
			$post_type = get_query_var( 'post_type' );
			if ( is_array( $post_type ) )
				$post_type = reset( $post_type );
			
			return pte_get_post_type_image( $post_type, $size );

		endif;

	}


endif;


if( !function_exists('pte_the_post_type_archive_image') ):


	/**
	 * Get an HTML img element representing a Post type
	 *
	 * This is optimized for archive.php and archive-{posttype}.php template files 
	 * 
	 * @param string|array $size					Optional. Image size. Accepts any valid image size, or an array of width
	 * 
	 * @return void HTML img element or empty string on failure.
	 */
	function pte_the_post_type_archive_image( $size = 'thumbnail' ) {
				
		echo pte_get_post_type_archive_image( $size );

	}


endif;
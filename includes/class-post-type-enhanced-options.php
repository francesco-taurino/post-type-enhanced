<?php if ( ! defined( 'ABSPATH' ) ) exit; 
/**
 * Post_Type_Enhanced_Options
 *
 * @package     Post_Type_Enhanced\Includes
 * @author      Francesco Taurino <dev.francescotaurino@gmail.com>
 * @copyright   Copyright (c) 2017, Francesco Taurino
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
 */
if( !class_exists('Post_Type_Enhanced_Options') ) :


	class Post_Type_Enhanced_Options implements iPost_Type_Enhanced  {


		/**
		 * Default fields
		 * 
		 * @param  string 				$key
		 * 
		 * @return array|false 		array or false if the key does not exist
		 */
		public static function get_default_fields( $key = false ) {

			$fields = array(
				
				'description' => array( 

					'type'=> 'string', 
					'input_name'=> 'description', 
					'input_type'=> 'textarea',
					'input_value'=> '', // default value
					'sanitize_callback' => 'wp_kses_post', // input
					'escape_callback' => array( 'Post_Type_Enhanced_Utils', 'the_content_filter'), // output
					'label_for' => 'Post type Description', 
					'description' => 'Post type Description', 
					'section' => 'main',

				),

				'attachment_id' => array(

					'type'=> 'integer', 
					'input_name'=> 'attachment_id', 
					'input_type'=> 'hidden',
					'input_value'=> 0, 
					'sanitize_callback' => 'absint',
					'label_for' => '',
					'description' => '',
					'section' => 'main',

				),

				/* Addons
				'example_id' => array(
					'type'=> 'boolean', 
					'input_name'=> 'example_id', 
					'input_type'=> 'select',
					'input_value'=> 0, 
					'sanitize_callback' => array( __CLASS__, 'validate_boolean'),
					'label_for' => '',
					'description' => '',
					'section' => 'addons',
				),
				*/
				
			);

			if( $key ){

				return isset( $fields[$key] ) ? $fields[ $key ] : false;

			} else{

				return $fields;

			}

		}


		
		/**
		 * Default options
		 * 
		 * @param  string $field
		 * 
		 * @return array
		 */
		public static function get_default_options( $field = 'input_value' ) {

			foreach ( Post_Type_Enhanced_Utils::get_post_types() as $index ) {
				
				foreach ( self::get_default_fields() as $key => $args ) {
				
					$defaults[$index][$key] = ( $field && isset( $args[ $field ] ) ) ? $args[ $field ] : $args;	
				
				}

			}

			return $defaults;

		}


		/**
		 * Sanitize
		 * 
		 * @param  string $key     	A key of the $fields
		 * @param  mixed 	$value   	The value to be sanitized
		 * @param  string $context 	(optional). Possible values are: '', 'display', 'raw'. Default empty
		 * @return mixed           	Sanitized value
		 */
		public static function sanitize( $key = null, $value = null, $context = '' ) {
		
			$field = self::get_default_fields( $key );
			
			$sanitize_callback = isset( $field['sanitize_callback'] ) ? $field['sanitize_callback'] : false;
			
			$escape_callback = isset( $field['escape_callback'] ) ? $field['escape_callback'] : false;
			
			$default = isset( $field['input_value'] ) ? $field['input_value'] : null;

			if( $context == 'display' ){

				$callback = $escape_callback ? $escape_callback : $sanitize_callback;

			} elseif( $context == 'raw' ){

				return $value;

			} else {

				$callback = $sanitize_callback;

			}


			if ( $callback && is_callable( $callback ) ) {
		
				return call_user_func( $callback, $value );
			
			} else {
			
				return $default;

			}

		}


		/**
		 * Get Options
		 * 
		 * @param  string 	$post_type 	(optional)	Post Type name
		 * @param  string 	$key  			(optional)	A key of the $fields
		 * @param  string 	$context  	(optional). Possible values are: '', 'display', 'raw'. Default display
		 * 
		 * @return mixed 		$value 			Options
		 */
		public static function get_options( $post_type = NULL, $key = NULL, $context = 'display' ) {

			$post_type = is_array($post_type) ? reset($post_type) : $post_type;
			
			if( !empty($post_type) && !Post_Type_Enhanced_Utils::is_valid_post_type( $post_type ) ) return false;

			if( !empty($key) && !in_array( $key, array_keys( self::get_default_fields() ) )  ) return false;

			$default = self::get_default_options();

			$db_options = get_option( self::OPTION_NAME, array() );

			$options = array_merge( $default, !is_array($db_options) ? array() : $db_options );

			$filtered = array();
			
			foreach ( $options as $_index => $_args ) :
				if( is_array($_args) ):
					foreach ( $_args as $_key => $_val ) {
						$filtered[$_index][$_key] = self::sanitize( $_key , $_val, $context );
					}
				endif;
			endforeach;

			if( $post_type && $key ){
				
				$value = isset($filtered[$post_type][$key]) ? $filtered[$post_type][$key] : $default[$post_type][$key];

			} elseif( $post_type ){

				$value = isset($filtered[$post_type]) ? $filtered[$post_type] : $default[$post_type];
			
			} else{

				$value = $filtered;

			}

			return $value;

		}


		/**
		 * Get Option
		 * 
		 * @param  string $post_type
		 * @param  string $key
		 * @param  string $context
		 * 
		 * @return mixed $value
		 */
		public static function get_option( $post_type = NULL, $key = NULL, $context = 'display' ) {
			if( empty($post_type) || !Post_Type_Enhanced_Utils::is_valid_post_type( $post_type ) ) return false;
			if( empty($key) || !in_array( $key, array_keys( self::get_default_fields() ) )  ) return false;
			return self::get_options( $post_type, $key, $context );
		}


		/**
		 * Get Post Type Description
		 * 
		 * @param  string $post_type
		 * @param  string $context
		 * @return string|false		The description, false otherwise
		 */
		public static function get_description( $post_type = NULL, $context = 'display' ) {
			return self::get_option( $post_type, 'description', $context );
		}

		
		/**
		 * Get attachment id
		 * 
		 * @param string $post_type
		 * @return integer|false The attachment id, false otherwise
		 */
		public static function get_attachment_id( $post_type = NULL ) {
			return (int) self::get_option( $post_type, 'attachment_id' );
		}


		/**
		 * Get an HTML img element representing a Post type
		 *
		 * @param string       $post_type 		Post type name
		 * @param string|array $size					Optional. Image size. Accepts any valid image size, or an array of width
		 * @param bool         $icon          Optional. Whether the image should be treated as an icon. Default false.
		 * @param string|array $attr          Optional. Attributes for the image markup. Default empty.
		 * @uses wp_get_attachment_image
		 * 
		 * @return string HTML img element or empty string on failure.
		 */
		public static function get_image( $post_type = NULL , $size = 'thumbnail', $icon = false, $attr = '' ) {
			$id = self::get_attachment_id( $post_type );			
			return ( $id > 0 ) ? wp_get_attachment_image( $id, $size, $icon, $attr ) : '';
		}


		/**
		 * Sanitize value inputs before saving option
		 * 
		 * @param array $input
		 * 
		 * @return array
		 */
		public static function sanitize_options( $input = array() ) {

			$sanitized = array();
	
			if( !empty($input) && is_array($input) ):

				foreach( $input as $post_type => $args ) :
					
					$post_type = sanitize_key( $post_type );

					if( Post_Type_Enhanced_Utils::is_valid_post_type( $post_type ) ):
							
						if( is_array($args) ){
							
							foreach ( $args as $key => $value ) {
							
								$key = sanitize_key( $key );

								if( in_array( $key, array_keys( self::get_default_fields() ) ) ){

									if( self::is_valid_value( $key, $value ) ){

										$sanitized[$post_type][$key] = self::sanitize( $key, $value );

									}

								}
								
							}

						}

					endif;

				endforeach;

			endif;


			return array_merge( self::get_options( null, null, 'raw' ), $sanitized );

		}

		/**
		 * Validate
		 * 
		 * @param  string $key     	A key of the $fields
		 * @param  mixed 	$value   	The value to be checked
		 * 
		 * @return bool           	true if valid
		 */
		private static function is_valid_value( $key, $value ) {
			
			if ( $key == 'attachment_id' ){
				
				// Store the attachment_id only if it is an image.
				// Obviously, this does not exclude the uploading of the image.
				if ( !empty($value) && !wp_attachment_is_image( $value ) ) {
				
					return false;
				
				}

			}

			return true;

		}


	}

endif;
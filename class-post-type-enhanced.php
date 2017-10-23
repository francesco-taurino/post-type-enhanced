<?php if ( ! defined( 'ABSPATH' ) ) exit; 
/**
 * Post_Type_Enhanced
 *
 * @package     Post_Type_Enhanced\Includes
 * @author      Francesco Taurino <dev.francescotaurino@gmail.com>
 * @copyright   Copyright (c) 2017, Francesco Taurino
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
 */
if( !class_exists('Post_Type_Enhanced') ) :

	
	/**
	 * This hook is called once any activated plugins have been loaded. 
	 * Is generally used for immediate filter setup, or plugin overrides.
	 * The plugins_loaded action hook fires early, and 
	 * precedes the setup_theme, after_setup_theme, init and wp_loaded action hooks.
	 */
	add_action('plugins_loaded', array( 'Post_Type_Enhanced', 'plugins_loaded'), 0 );


	class Post_Type_Enhanced implements iPost_Type_Enhanced  {

		private function __construct() {}

		public static function plugins_loaded() {
						
			self::includes();

			load_plugin_textdomain( 
				self::PLUGIN_SLUG, 
				false, 
				basename( dirname( self::FILE ) ) . '/languages' 
			); 
	
		}

		/**
		 * Admin&Public files
		 * 
		 * @return void
		 */
		private static function includes() {
	
			$array = array(
				'includes/class-post-type-enhanced-*.php'
			);

			// Admin&Public
			foreach ( $array as $key ) {
				foreach ( glob( plugin_dir_path( self::FILE ) . $key ) as $filename ){
					require_once ($filename);
				}
			}

			if( is_admin() ) {
				
				// Admin
				if( Post_Type_Enhanced_Utils::is_user_authorized() ) {
					require_once( plugin_dir_path( self::FILE ).'admin/class-post-type-enhanced-admin.php' );
				}

			} else {

				// Public
				require_once( plugin_dir_path( self::FILE ).'public/class-post-type-enhanced-public.php' );

			}


			// Public User Functions
			require_once( plugin_dir_path( self::FILE ).'includes/post-type-enhanced-functions.php' );

		}

	}


endif;
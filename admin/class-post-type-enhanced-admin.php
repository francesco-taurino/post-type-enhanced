<?php if ( ! defined( 'ABSPATH' ) ) exit; 
/**
 * Post_Type_Enhanced_Admin
 *
 * @package     Post_Type_Enhanced\Admin
 * @author      Francesco Taurino <dev.francescotaurino@gmail.com>
 * @copyright   Copyright (c) 2017, Francesco Taurino
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
 */
if( !class_exists('Post_Type_Enhanced_Admin') ) :


	add_action('plugins_loaded', array( 'Post_Type_Enhanced_Admin', 'plugins_loaded') );


	class Post_Type_Enhanced_Admin implements iPost_Type_Enhanced  {

		
		private function __construct() {}


		public static function plugins_loaded() {
			
			self::includes();
		
			// Settings
			add_action( 'admin_menu', array( 'Post_Type_Enhanced_Admin_Settings', 'admin_menu' ) );
			add_action( 'admin_init', array( 'Post_Type_Enhanced_Admin_Settings', 'admin_init' ) );
			add_action( 'admin_enqueue_scripts', array( 'Post_Type_Enhanced_Admin_Settings', 'admin_enqueue_scripts' ) );

		}


		private static function includes() {

			$array = array(
				'admin/includes/class-post-type-enhanced-admin-*.php'
			);

			foreach ( $array as $key ) {
				foreach ( glob( plugin_dir_path( self::FILE ) . $key ) as $filename ){
					require_once ($filename);
				}
			}

		}

	}


endif;
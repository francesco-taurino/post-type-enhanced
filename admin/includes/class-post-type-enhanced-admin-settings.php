<?php if ( ! defined( 'ABSPATH' ) ) exit; 
/**
 * Post_Type_Enhanced_Admin_Settings
 *
 * @package     Post_Type_Enhanced\Admin\Includes
 * @author      Francesco Taurino <dev.francescotaurino@gmail.com>
 * @copyright   Copyright (c) 2017, Francesco Taurino
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
 */

if( !class_exists('Post_Type_Enhanced_Admin_Settings') ) : 
		
	
	class Post_Type_Enhanced_Admin_Settings implements iPost_Type_Enhanced  {
		

		/**
		 * Get Option
		 * 
		 * @param  string 	$key  			A key of the $fields
		 * @param  string 	$context  	Possible values are: '', 'display', 'raw'. Default display
		 * 
		 * @return mixed 								The Option
		 */
		private static function get_option( $option = null, $context = 'display' ) {
			return Post_Type_Enhanced_Options::get_option( self::get_current_post_type(), $option, $context );
		}


		/**
		 * Get the field id
		 * 
		 * @param  string 	$key  			A key of the $fields
		 * 
		 * @return string 							The key with the prefix.
		 */
		public static function field_id( $key = '' ) {
			return self::OPTION_NAME. '-' . self::get_current_post_type() . '-' . $key;
		}

		
		/**
		 * Get the field name
		 * 
		 * @param  string 	$key  			A key of the $fields
		 * 
		 * @return string 							The key with the prefix.
		 */
		public static function field_name( $key = '' ) {
			return self::OPTION_NAME. '[' . self::get_current_post_type() . '][' . $key . ']';
		}

		
		/**
		 * Get the current post type in admin 
		 * 
		 * @return string post type name or null
		 */
		public static function get_current_post_type() {
			
			// Note: get_current_screen returns null if called from the admin_init hook. 
			// It should be OK to use in a later hook such as current_screen.
			$screen = get_current_screen();
		
			if( isset( $screen->post_type ) && $screen->post_type ) {
				
				return $screen->post_type;
			
			} elseif( isset( $screen->id ) && $screen->id == 'posts_page_'.self::PLUGIN_SLUG.'-post' ){
	 			
	 			return 'post';
			
			} else {
			
				return null;
			
			}
		
		}


		/**
		 * Add a submenu page.
		 * 
		 * @return void
		 */
		public static function admin_menu() {
			
				foreach ( Post_Type_Enhanced_Utils::get_post_types() as $post_type ) :
					
					if( $post_type == 'post' ){
						
						$parent_slug = 'edit.php';
					
					} else{
						
						$parent_slug = 'edit.php?post_type=' . $post_type;
					
					}

					$data = get_post_type_object( $post_type );

					add_submenu_page(
						$parent_slug,
						self::PLUGIN_TITLE,
						self::PLUGIN_TITLE,
						self::REQUIRED_CAPABILITY,
						self::PLUGIN_SLUG .'-'. $post_type,
						array( __CLASS__, 'page' )
					);

				endforeach;

		}


		/**
		 * Enqueue scripts|styles
		 * 
		 * @return void
		 */
		public static function admin_enqueue_scripts( $hook = '' ) {

			$post_type = self::get_current_post_type();
			
			// WP_Screen id - Esempio: {wordpress}_page_post-type-enhanced-{wordpress}
			$page = $post_type .'_page_post-type-enhanced-'. $post_type;

			if( $hook !== $page ) return;
	   
	    wp_enqueue_media();

			$plugin_data = get_plugin_data( self::FILE );

			wp_enqueue_style(
				self::PLUGIN_SLUG.'-css', 
				plugins_url('admin/assets/css/css.css', self::FILE ), 
				array(), 
				$plugin_data['Version']
			);

			wp_enqueue_script(
				self::PLUGIN_SLUG.'-js', 
				plugins_url('admin/assets/js/js.js', self::FILE ), 
				array(), 
				$plugin_data['Version'],
				true
			);

		}


	/**
	 * Register settings
	 * 
	 * @return void
	 * 
	 */
		public static function admin_init() {
			
			register_setting(
				self::OPTION_NAME.'_option_group',
				self::OPTION_NAME,
				array( 'Post_Type_Enhanced_Options', 'sanitize_options' )
			);

			$addons = wp_filter_object_list( 
				Post_Type_Enhanced_Options::get_default_fields(), 
				array('section' => 'addons'), 
				'and' 
			);

			if( !empty($addons) ){

				add_settings_section(
					self::OPTION_NAME.'_section_addons',
					null,
					null,
					self::PLUGIN_SLUG.'-admin-page'
				);

				foreach ( $addons as $field_name => $args ) {

					add_settings_field(
						$field_name,
						$args['label_for'],
						array( __CLASS__, 'render_addons' ),
						self::PLUGIN_SLUG.'-admin-page',
						self::OPTION_NAME.'_section_'. $args['section'],
						$args
					);
			
				}

			}
		
		}


		/**
		 * Wp editor
		 * 
		 * @param string			A key of the $fields
		 * 
		 * @return void
		 */
		private static function wp_editor( $field = '' ) {
		 			 	
			wp_editor( 
				
				// Content
				self::get_option( $field, 'raw' ),
				
				// Id
				str_replace( '-', '', self::PLUGIN_SLUG . self::get_current_post_type() ), 
				
				// Settings
				array(
					'textarea_name' => self::field_name( $field ),
					'textarea_rows' => 20,
					'media_buttons' => true,
					'classes' 			=> 'wp-editor-area wp-editor'
				)
			);
			
		}


		/**
		 * Prints the select options
		 * 
		 * @param  array $args 	the $fields
		 * @return void
		 */
		public static function render_addons( $args ) {
			$input_name = isset( $args['input_name'] ) ? $args['input_name'] : false ;
			$description = isset( $args['description'] ) ? $args['description'] : false ;
			$y = esc_attr_x('Yes', 'select option', 'post-type-enhanced');
			$n = esc_attr_x('No', 'select option', 'post-type-enhanced');
			?>
			<select id='<?php echo esc_attr( self::field_id( $input_name ) ) ; ?>' name='<?php echo esc_attr( self::field_name( $input_name ) ) ; ?>' > 
		    <option value="0" <?php selected( self::get_option( $input_name ), false ); ?>><?php echo $n; ?></option>
		    <option value="1" <?php selected( self::get_option( $input_name ), true ); ?>><?php echo $y; ?></option>
			</select>
			<span class="description"><?php echo Post_Type_Enhanced_Utils::the_content_filter( $description ); ?></span>
			<br />
		<?php
		}


		/**
		 * Prints out all settings sections
		 * 
		 * @return void
		 */
		public static function do_settings_addons() { 
		
			$addons = wp_filter_object_list( 
				Post_Type_Enhanced_Options::get_default_fields(), 
				array('section' => 'addons'), 
				'and' 
			);

			if( empty($addons) ) return;

			?>
			<div id="pte-wpseo_metadesc" class="postbox">
				<h3 class="hndle">
					<span>
						Addons
					</span>
				</h3>
				<div class="inside">
					<?php do_settings_sections( self::PLUGIN_SLUG.'-admin-page' ); ?>
			  </div>
			</div>
			<!-- /.postbox -->
		<?php
		}


		/**
		 * The input field
		 * 
		 * @param  string 	$key  			A key of the $fields
		 * @param  string 	$type  			Input type. Default text
		 * 
		 * @return string 							The key with the prefix.
		 */
		private static function input_field( $field = '', $type = 'text' ) {
			 echo '<input class="pte-input-' . esc_attr( $field ) . '" type="' . esc_attr( $type ) . '" id="' . esc_attr( self::field_id( $field ) ) . '" name="' . esc_attr( self::field_name( $field ) ) .'" value="' . esc_attr( self::get_option( $field, 'raw' ) ) . '" />';
		}


		/**
		 * Addons
		 * 
		 * @return void
		 */
		private static function include_addons() {
			$array = array(
				'admin/templates/addons/post-type-enhanced-admin-templates-addons-*.php'
			);

			foreach ( $array as $key ) {
				foreach ( glob( plugin_dir_path( self::FILE ) . $key ) as $filename ){
					include_once ($filename);
				}
			}

		}


		/**
		 * Sidebar
		 * 
		 * @return void
		 */
		private static function include_sidebar() {
			include_once( plugin_dir_path( self::FILE ) . 'admin/templates/post-type-enhanced-admin-templates-settings-page-sidebar.php' );
		}


		/**
		 * Settings Page (Main)
		 * 
		 * @return void
		 */
		public static function page() {
			include_once( plugin_dir_path( self::FILE ) . 'admin/templates/post-type-enhanced-admin-templates-settings-page.php' );
		}

		

		/**
		 * Parses the plugin contents to retrieve plugin's metadata.
		 *
		 * @return array {
		 *     Plugin data. Values will be empty if not supplied by the plugin.
		 *
		 *     @type string $Name        Name of the plugin. Should be unique.
		 *     @type string $Title       Title of the plugin and link to the plugin's site (if set).
		 *     @type string $Description Plugin description.
		 *     @type string $Author      Author's name.
		 *     @type string $AuthorURI   Author's website address (if set).
		 *     @type string $Version     Plugin version.
		 *     @type string $TextDomain  Plugin textdomain.
		 *     @type string $DomainPath  Plugins relative directory path to .mo files.
		 *     @type bool   $Network     Whether the plugin can only be activated network-wide.
		 * }
		 */
		public static function get_plugin_data( $value ) {
			$data = get_plugin_data( self::FILE );
			return isset( $data[ $value ] ) ? $data[ $value ] : false;
		}
	
		/**
		 * Plugins
		 * 
		 * @return void
		 */
		public static function other_plugins() {
		
			$plugins = array();

			$plugins[] = array(
				'name' => 'Ga Tracking Code',
				'url' => 'https://wordpress.org/plugins/ga-tracking-code/',
				'desc' => 'Ga Tracking Code plugin makes Google Analytics tracking easier.'
			);

			$plugins[] = array(
				'name' => 'WP Head Footer',
				'url' => 'https://wordpress.org/plugins/post-type-enhanced/',
				'desc' => 'WP Head Footer allows administrators to add code to the head and/or footer of an individual post (or any post type) and/or site-wide.'
			);

			$AuthorName = sprintf( 
				__( 'Other plugins by %s', 'post-type-enhanced' ), 
				self::get_plugin_data('AuthorName')
			);

			?>

			<div class="postbox">
				<h3 class="hndle">
					<span><?php echo esc_html( $AuthorName ) ?></span>
				</h3>
				
				<div class="inside">
					<?php foreach ($plugins as $plugin ) : ?>
						<p>
							<a href="<?php echo $plugin['url']; ?>" target="_blank">
								<?php echo esc_html($plugin['name']); ?>
							</a> - <?php echo esc_html($plugin['desc']); ?>
						</p>
					<?php endforeach; ?>
				</div>

			</div>
			<!-- /.postbox -->
			<?php

		}


	}

endif;
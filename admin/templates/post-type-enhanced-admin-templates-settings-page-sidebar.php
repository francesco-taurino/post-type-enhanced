<?php if ( ! defined( 'ABSPATH' ) ) exit; 
/**
 * Sidebar
 *
 * @package     Post_Type_Enhanced\Templates
 * @author      Francesco Taurino <dev.francescotaurino@gmail.com>
 * @copyright   Copyright (c) 2017, Francesco Taurino
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
 * @Last Modified time: 2017-10-21 23:32:20
 */


?>

<?php self::include_addons() ?>

<div class="postbox">
	
	<h3 class="hndle">
		<span>
			Plugin
		</span>
	</h3>
	
	<div class="inside">

		<ul>
			
			<li class="version">
				<span class="dashicons dashicons-admin-plugins"></span> 
				<?php echo esc_html_x( 'Name', 'Name of the plugin', 'post-type-enhanced' ); ?> 
				<?php echo ( self::get_plugin_data('Title') ); ?>
			</li>	

			<li class="version">
				<span class="dashicons dashicons-admin-generic"></span> 
				<?php echo esc_html_x( 'Version', 'Plugin version', 'post-type-enhanced' ); ?> 
				<code><?php echo esc_html( self::get_plugin_data('Version') ); ?></code>
			</li>	

			<li>
				<span class="dashicons dashicons-admin-users"></span>
				<?php echo esc_html_x('Created by', 'Author\'s name', 'post-type-enhanced' ); ?> 
				<a href="<?php echo esc_attr( self::get_plugin_data('AuthorURI') ); ?>" target="_blank" title="<?php echo esc_attr( self::get_plugin_data('AuthorURI') ); ?>"><?php echo esc_html( self::get_plugin_data('AuthorName') ); ?>
				</a>
			</li>
		
			<li>
				<span class="dashicons dashicons-media-text"></span> 
				<a target="_blank" href="https://plugins.svn.wordpress.org/<?php echo self::PLUGIN_SLUG; ?>/trunk/CHANGELOG.md">
					<?php echo esc_html_x( 'Changelog', 'Changelog of the plugin', 'post-type-enhanced' ); ?>
				</a>
			</li>

			<li>
				<span class="dashicons dashicons-star-filled"></span> 
				<a href="https://wordpress.org/support/plugin/<?php echo self::PLUGIN_SLUG; ?>/reviews/#new-post" target="_blank">
					<?php echo esc_html_x( 'Vote', 'Vote the plugin', 'post-type-enhanced' ); ?>
				</a>
			</li>

			<li title="<?php echo esc_attr__( 'If you find this plugin useful, please consider making a donation', 'post-type-enhanced' ); ?>">
				<span style="color: red" class="dashicons dashicons-heart"></span> 
				<a href="https://www.paypal.me/francescotaurino" target="_blank">
					<?php echo esc_html_x( 'Donate', 'Making a donation', 'post-type-enhanced' ); ?>
				</a>
			</li>

		</ul>

	</div>

</div>
<!-- /.postbox -->

<?php self::other_plugins() ?>
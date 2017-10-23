<?php if ( ! defined( 'ABSPATH' ) ) exit; 
/**
 * Settings
 *
 * @package     Post_Type_Enhanced\Templates
 * @author      Francesco Taurino <dev.francescotaurino@gmail.com>
 * @copyright   Copyright (c) 2017, Francesco Taurino
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
 */
?>
<div class="wrap">

	<h2 class="title"><?php echo esc_html(get_admin_page_title() ); ?></h2>  
	
	<form method="post" action="options.php">

		<?php settings_fields( self::OPTION_NAME.'_option_group' ); ?>

		<div id="poststuff">
			
			<div id="post-body" class="metabox-holder columns-2">
			
				<!-- Content -->
				<div id="post-body-content">
					
					<div id="no-normal-sortables" class="no-meta-box-sortables no-ui-sortable">
						
						<!-- Feature: Description -->
						<div class="no-postbox">
							<?php /*<h3 class="hndle"></h3> */?>
							<div class="inside">
								<?php self::wp_editor( 'description' ); ?>
							</div> <!-- /inside -->
						</div> <!-- /postbox -->

					</div> <!-- /normal-sortables -->
				
				</div> <!-- /post-body-content -->
				
				<!-- /Content -->

				<!-- Sidebar -->
				<div id="postbox-container-1" class="postbox-container">
				
					<div class="pte-submit postbox">
						
						<h3 class="hndle">
							<span>
								<?php echo esc_html_x('Save', 'Box Title', 'post-type-enhanced'); ?>
							</span>
						</h3>
						
						<div class="inside">
						 	
						 	<?php submit_button( esc_html_x('Save', 'Submit button', 'post-type-enhanced'), 'primary', null,false ); ?>
							
							<a style="float: right;" class="button button-large button-secondary" target="_blank" href="<?php echo get_post_type_archive_link( self::get_current_post_type() ); ?>">
								<?php echo esc_html_x( 'View Archive', 'View the post type archive', 'post-type-enhanced' ); ?>
							</a>

					  </div>

					</div>
					<!-- /.postbox -->

					<?php self::include_sidebar() ?>
					
				</div>  <!-- /#postbox-container-1 -->

				<div id="postbox-container-2" class="postbox-container">
					<?php self::do_settings_addons(); ?>
				</div> <!-- /#postbox-container-2 -->

			</div> <!-- /#post-body -->

			<br class="clear" />

		</div> <!-- /#poststuff -->

	</form> <!-- /form -->

</div> <!-- /.wrap -->
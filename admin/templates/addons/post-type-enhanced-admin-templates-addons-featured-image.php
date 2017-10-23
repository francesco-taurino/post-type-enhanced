<?php if ( ! defined( 'ABSPATH' ) ) exit; 
/**
 * Featured Image
 * 
 * @package     Post_Type_Enhanced\Templates\Addons
 * @author      Francesco Taurino <dev.francescotaurino@gmail.com>
 * @copyright   Copyright (c) 2017, Francesco Taurino
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
 */

if( !Post_Type_Enhanced_Options::get_default_fields( 'attachment_id' ) ) {
	return;
}

?>
<div id="pte-featured-image" class="postbox">
	
	<h3 class="hndle">
		<span>
			<?php echo esc_html_x( 'Featured Image', 'Box Title', 'post-type-enhanced' ); ?>
		</span>
	</h3>
	
	<div class="inside">
	 	
	 	<?php echo self::input_field( 'attachment_id', 'hidden' ); ?>
	 	
	  <div class="pte-attachment-image">
	      <?php echo Post_Type_Enhanced_Options::get_image( self::get_current_post_type() ); ?>
	  </div>

    <button class="button pte-add-media" id="pte-add-media">
    	<?php echo esc_html_x('Select', 'Button to select a Featured Image', 'post-type-enhanced'); ?>
    </button>
    <button class="button pte-remove-media">
    	<?php echo esc_html_x('Remove', 'Button to remove a Featured Image', 'post-type-enhanced'); ?>
    </button>
	 
  </div>

</div>
<!-- /.postbox -->
<?php if ( ! defined( 'ABSPATH' ) ) exit; 
/**
 * Plugin Name:   Post Type Enhanced
 * Plugin URI:    https://www.francescotaurino.com/wordpress/post-type-enhanced
 * Description:   Post Type Enhanced allows you to add a nice and helpful Post Type description. Includes The TinyMCE editor, featured images, and other features.
 * Author:        Francesco Taurino
 * Author URI:    https://www.francescotaurino.com
 * Version:       1.0.4
 * Text Domain:   post-type-enhanced
 * Domain Path: 	/languages
 * License: GPL v3
 *
 * @package     Post_Type_Enhanced
 * @author      Francesco Taurino <dev.francescotaurino@gmail.com>
 * @copyright   Copyright (c) 2017, Francesco Taurino
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
 *
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see http://www.gnu.org/licenses/gpl-3.0.html.
 */

	
interface iPost_Type_Enhanced{
	const PLUGIN_SLUG = 'post-type-enhanced';
	const PLUGIN_TITLE = 'Post Type Enhanced';
	const PLUGIN_URI = 'https://www.francescotaurino.com/wordpress/post-type-enhanced';
	const REQUIRED_CAPABILITY = 'manage_options';
	const FILE = __FILE__;
	const OPTION_NAME = 'pte_site_settings';
}


require_once( plugin_dir_path( __FILE__ ).'class-post-type-enhanced.php' );
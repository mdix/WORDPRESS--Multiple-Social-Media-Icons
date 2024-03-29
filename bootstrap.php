<?php
/*
Plugin Name: Multiple Social Media Icons
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Include multiple sets of social media icons into posts / pages via shortcodes.
Version: 0.1
Author: Marc Dix
Author URI: http://www.dixpix.de
License: GPL2

    Copyright 2012  Marc Dix  (email : marcdix@marcdix.de)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

require_once dirname(__FILE__) . '/class/MultipleSocialMediaIcons.php';

// Uncomment this if you want to use the widget boilerplate
// require_once(dirname(__FILE__) . '/widgets.php');

/**
 * Register the plugin
 */
add_action("init", create_function('', 'new MultipleSocialMediaIcons();'));
register_activation_hook(__FILE__, array('MultipleSocialMediaIcons', 'install'));
<?php
require_once 'Icon.php';
require_once 'IconSet.php';
require_once dirname(__FILE__) . '/../pages/AdminMain.php';
require_once dirname(__FILE__) . '/../pages/ViewCreateIconSets.php';
require_once dirname(__FILE__) . '/../pages/ViewEditIconSets.php';
require_once dirname(__FILE__) . '/../pages/ViewDeleteIconSets.php';
/**
 * This is where you add comments for your plugin class
 * @author Your Name <your@name.tld>
 * @todo Add your name here
 * @todo Change class name to something more appropriate
 */
class MultipleSocialMediaIcons {
    /**
     * This value will be used for
     * - the gettext textdomain
     * - the subfolder when adding scripts and styles
     * - the handle for scripts and styles
     * Please make sure that this value corresponds to the folder name where your plugin resides.
     * @var string
     * @todo Change this value to your plugin name
     */
    private $plugin_name = "multiplesocialmediaicons";

    /**
     * The constructor is executed when the class is instatiated and the plugin gets loaded.
     * @return void
     */
    function __construct() {
        // Uncomment any of these calls to add the functionality that you need.
        
        //add_action('init', array($this, 'init_custom_post_types'), 20);
        //add_action('init', array($this, 'init_localization'), 20);
        //add_action('init', array($this, 'init_scripts'), 20);
        //add_action('init', array($this, 'init_styles'), 20);
        //add_action('init', array($this, 'init_shortcodes'), 20);
        add_action('admin_menu', array($this,'init_admin_menu'));
    }

    /**
     * This function is executed when the plugin is activated. To activate it just uncomment
     * the line at the bottom of this file with the register_activation_hook( ... ) function
     * @return void
     */
    static function install() {
        /**
         * Uncomment this if you need database tables.
         */
        
        MultipleSocialMediaIcons::install_db();

        // Perform your activation tasks in here.
    }
    
    /**
     * This function is executed from install( ) and is used if you need database tables.
     * @return void
     */
    static function install_db() {
        global $wpdb;
        global $table_prefix;
        /**
         * This value represent the current version of the layout of the database tables. This value
         * needs to be increased every time you change something in your database layout.
         * @var integer
         */
        $db_version = 3;

        /**
         * To create tables, dbDelta from wp-admin/includes/upgrade.php is needed
         */
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        /**
         * @todo Change myplugin to your plugin name
         * @var integer
         */
        $current_version = null;
        $current_version = get_option('myplugin-db-version');
        
        // Check if the latest version is already installed
        /*
        if($current_version == $db_version) {
            return;
        }*/

        // In this example two tables is defined, 'table1' and 'table2'. This example tries
        // to illustrate how the tables gets upgraded. The layout of the tables is currently at
        // version three and two upgrade routines are defined for upgrading the tables from the
        // first and second version. Note that the changes in the database layout needs to be added
        // to the $structure[ ] array _and_ to the $upgrade[ ] array. $structure[ ] is used when the
        // plugin is installed on a new system and $upgrade[ ] is used for upgrading.

        // Define tables
        $tables = array($table_prefix . 'msmi_iconset');
        $structure = array(
            // Definition for prefix.'msmi_iconset'
            "(`id` int(11) unsigned NOT NULL auto_increment,
            `field1` varchar(255) NOT NULL,
            `field2` varchar(255) NOT NULL,
            `field3` varchar(255) default NULL,
            `field4` tinyint(3) unsigned NOT NULL default '0',
            `field5` timestamp NOT NULL default CURRENT_TIMESTAMP,
            PRIMARY KEY  (`id`) )"
        );

        // Routines for upgrading, the structure is
        // $upgrade[ from db version ][ table name ]
        // Routine should include %s for table prefix.
        // Upgrade routines are applied in order from current version to the newer version. Routines for upgrading
        // only has to be defined once.

        // Example of an upgrade routine which will add two fields to table1 when the plugin gets upgraded from
        // DB version 1 to a later version.
        $upgrade[1] = array("table1" => "ALTER TABLE %stable1 ADD `field3` varchar(255) default NULL, ADD `field4` tinyint(3) unsigned NOT NULL default '0'");

        // Example of an upgrade routine which will add one field to table1 and one field to table2 when the plugin
        // gets upgraded from DB version 2 to a later version.
        $upgrade[2] = array("table1" => "ALTER TABLE %stable1 ADD `field5` timestamp NOT NULL default CURRENT_TIMESTAMP", "table2" => "ALTER TABLE %stable2 ADD `field3` varchar(255) NOT NULL" );

        // Iterate tables and create them
        foreach ($tables as $key => $table) {
            if($wpdb->get_var(sprintf("SHOW TABLES LIKE '%s%s'", $wpdb->prefix, $table)) != $wpdb->prefix . $table) {
                // Table doesn't exist, create it.

                $sql = sprintf("CREATE TABLE %s%s %s DEFAULT CHARSET=utf8", $wpdb->prefix, $table, $structure[$key]);
                dbDelta($sql);
            } else {
                // Table exists, check if there's any upgrade routines defined.
                // The upgrade routines are applied in order from previous to current version

                for ($i = $current_version; $i < MD_DB_VERSION; $i++) {
                    if (strlen($upgrade[ $i ][ $table ]) > 0) {
                        $sql = sprintf($upgrade[ $i ][ $table ], $wpdb->prefix);
                        $wpdb->query($sql);
                    }
                }
            }
        }

        /**
         * @todo Change myplugin to your plugin name
         */
        if ($current_version === false) {
            add_option('myplugin-db-version', $db_version);
        } else {
            update_option('myplugin-db-version', $db_version);
        }
    }

    /**
     * Loading the gettext textdomain first from the WP languages directory,
     * and if that fails try the subfolder /languages/ in the plugin directory.
     * @return void
     */
    function init_localization() {
        if(!load_plugin_textdomain($this->plugin_name, '/wp-content/languages/')) {
            load_plugin_textdomain($this->plugin_name, '/wp-content/plugins/' . $this->plugin_name . '/languages/');
        }
    }

    /**
     * Loading the javascripts, first using jquery using the CDN and then the file
     * /scripts/script.js from the plugin directory. By default the script is enqueued
     * in the page footer for faster page loading.
     * @return void
     */
    function init_scripts() {
        // Only enqueue scripts on frontend.
        if(!is_admin()) {
            // Use jQuery from Google CDN
            wp_deregister_script('jquery');
            wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js');
            wp_enqueue_script('jquery');

            // Only enqueue the script if it actually exists.
            if(file_exists(dirname(__FILE__) . '/scripts/script.js')) {
                if(function_exists('plugins_url')) {
                    wp_enqueue_script($this->plugin_name . '-script', plugins_url('/scripts/script.js', __FILE__), array('jquery'), '1.0', true);
                } else {
                    wp_enqueue_script($this->plugin_name . '-script', WP_PLUGIN_URL . '/' . $this->plugin_name . '/scripts/script.js', array('jquery'), '1.0', true);
                }
            }
        }
    }

    /**
     * Loading the stylesheet for this plugin.
     * @return void
     */
    function init_styles() {
        // Only enqueue styles on frontend and if the stylesheet actually exists.
        if(!is_admin() && file_exists(dirname(__FILE__) . '/styles/style.css')) {
            if(function_exists('plugins_url')) {
                wp_enqueue_style($this->plugin_name . '-stylesheet', plugins_url('/styles/style.css', __FILE__), array(), '1.0', 'all');
            } else {
                wp_enqueue_style($this->plugin_name . '-stylesheet', WP_PLUGIN_URL . '/' . $this->plugin_name . '/styles/styles.css', array(), '1.0', 'all');
            }
        }
    }

    /**
     * Add a shortcode for this plugin. It's recommended to change the code
     * to prevent from collisions. (The second value in the array)
     * @return void
     */
    function init_shortcodes() {
        add_shortcode('shortcode', array($this, 'plugin_boilerplate_shortcode'));
    }

    /**
     * This function will be executed when the plugin shortcode is used in a page
     * or post. This is where you put the code to be executed
     * @param array $atts
     */
    function plugin_boilerplate_shortcode($atts, $contents = '') {
        // Extracting all the values sent as arguments with this shortcode
        extract(shortcode_atts(array(
            'attribute' => 'default',
        ), $atts));

        // It's recommended to use output buffering to catch the contents and then return it.
        ob_start();

        // Perform the tasks of this function in here, and echo everything that you want to
        // output to the browser.

        // Fetch the output that you just echoed, and put it into the $content variable.
        $content = ob_get_clean();

        // Remember to always RETURN the content from the shortcode function, otherwise
        // the result won't be placed in the correct part of the page.
        return $content;
    }

    /**
     * Loading custom post types and taxonomies for this plugin.
     * @return void
     */
    function init_custom_post_types() {
        // Register post_type as custom post type with post_type taxonomy as a taxanomy
        register_post_type('post_type', array(
            'labels' => array(
                'name' => __('Post Types', 'plugin-boilerplate'),
                'singular_name' => 'Post type',
                'add_new' => 'Add new',
                'add_new_item' => 'Add new post type',
                'edit_item' => 'Edit post type',
                'new_item' => 'New post type',
                'view_item' => 'Show post type',
                'search_items' => 'Search post type',
                'not_found' =>  'Not found',
                'not_found_in_trash' => 'No post type was found in trash',
                'parent_item_colon' => 'Parent:'
            ),
            'public' => true,
            'exclude_from_search' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'show_in_nav_menus' => false,
            'menu_position' => null,
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
        ));

        register_taxonomy('post_type_taxonomy', 'taxonomy', array(
            'hierarchical' => true,
            'labels' => array(
                'name' => 'Taxonomies',
                'singular_name' => 'Taxonomy',
                'search_items' => 'Search taxonomy',
                'all_items' => 'All taxonomies',
                'parent_item' => 'Parent taxonomy',
                'parent_item_colon' => 'Parent taxonoy:',
                'edit_item' => 'Edit taxonomy',
                'update_item' => 'Update taxonomy',
                'add_new_item' => 'Add new taxonomy',
                'new_item_name' => 'Taxonomy name',
                'menu_name' => 'Taxonomies',
            ),
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'taxonomy')
        ));
    }
    
    /**
     * Adds a new menu with the name "My Admin Menu" and let's anyone that
     * can publish posts be able to use it.
     * @return void
     */
    function init_admin_menu() {
        // Add the menu page
        add_menu_page('Multiple Social Media Icons', 'Multiple SMIcons', 'publish_posts', $this->plugin_name . '-admin-menu', array($this,'viewAdminMain'));

        // Also let's add a submenu
        add_submenu_page($this->plugin_name . '-admin-menu', 'Create IconSets', 'Create IconSets', 'publish_posts', $this->plugin_name . '-admin-submenu-create', array($this, 'viewCreateIconSets'));
        add_submenu_page($this->plugin_name . '-admin-menu', 'Edit IconSets',   'Edit IconSets',   'publish_posts', $this->plugin_name . '-admin-submenu-edit',   array($this, 'viewEditIconSets'));
        add_submenu_page($this->plugin_name . '-admin-menu', 'Delete IconSets', 'Delete IconSets', 'publish_posts', $this->plugin_name . '-admin-submenu-delete', array($this, 'viewDeleteIconSets'));
    }

    /**
     * This function will be executed when the admin page is to be loaded
     * @return void
     */
    function viewAdminMain() {
        new AdminMain();
    }

    /**
     * This function will be executed when the admin sub page is to be loaded
     * @return void
     */
    function viewCreateIconSets() {
        // Include the HTML from a separate file to keep the plugin class clean
        new ViewCreateIconSets($_POST);
    }
    function viewEditIconSets() {
        // Include the HTML from a separate file to keep the plugin class clean
        new ViewEditIconSets($_POST);
    }
    function viewDeleteIconSets() {
        // Include the HTML from a separate file to keep the plugin class clean
        new ViewDeleteIconSets($_POST);
    }
}
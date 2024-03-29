<?php
require_once dirname(__FILE__) . '/../../class/MultipleSocialMediaIcons.php';
/**
 * Test class for MultipleSocialMediaIcons.
 * Generated by PHPUnit on 2012-03-31 at 11:18:16.
 */
class MultipleSocialMediaIconsTest extends PHPUnit_Framework_TestCase {
    // MultipleSocialMediaIcons object
    protected $msmi;
    protected $tableNames = array();

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        global $table_prefix;
        $this->prefix = $table_prefix;
        $this->tableNames = array('iconset' => $this->prefix . 'msmi_iconset');

        // has to be global because wordpress calls a static function and utilizes $wpdb
        $GLOBALS['wpdb']         = new wpdb(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
        $GLOBALS['table_prefix'] = $table_prefix;
        $this->msmi              = new MultipleSocialMediaIcons();
    }

    /**
     * Removes the Database-Object to have a clean one on every testrun. 
     */
    protected function tearDown() {
        global $wpdb;
        
        $wpdb->query(sprintf('DROP TABLE IF EXISTS `%s`', $this->tableNames['iconset']));
    }
    
    /**
     * We wan't to make sure that, when the plugin is activated in the wordpress backend
     * and thus static install() is called, the table for our plugin is created.
     * @covers MultipleSocialMediaIcons::install_db()
     */
    public function testInstallDbCreatesTableAndSchema() {
        global $wpdb;
        // check for the table, it shouldn't exist
        $this->assertEquals(0, $wpdb->query(sprintf('SHOW TABLES LIKE "%s"', $this->tableNames['iconset'])), 'Table already exists!');
        // create table via install which calls install_db()
        MultipleSocialMediaIcons::install_db();
        // check for the table, it should exist
        $this->assertEquals(1, $wpdb->query(sprintf('SHOW TABLES LIKE "%s"', $this->tableNames['iconset'])), 'Table does not exist!');
    }

    /**
     * @covers MultipleSocialMediaIcons::init_localization
     * @todo Implement testInit_localization().
     */
    public function testInit_localization() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers MultipleSocialMediaIcons::init_scripts
     * @todo Implement testInit_scripts().
     */
    public function testInit_scripts() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers MultipleSocialMediaIcons::init_styles
     * @todo Implement testInit_styles().
     */
    public function testInit_styles() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers MultipleSocialMediaIcons::init_shortcodes
     * @todo Implement testInit_shortcodes().
     */
    public function testInit_shortcodes() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers MultipleSocialMediaIcons::plugin_boilerplate_shortcode
     * @todo Implement testPlugin_boilerplate_shortcode().
     */
    public function testPlugin_boilerplate_shortcode() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers MultipleSocialMediaIcons::init_custom_post_types
     * @todo Implement testInit_custom_post_types().
     */
    public function testInit_custom_post_types() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers MultipleSocialMediaIcons::init_admin_menu
     * @todo Implement testInit_admin_menu().
     */
    public function testInit_admin_menu() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    public function testAdminMainPageReturnsMarkup() {
        ob_start();
        $this->msmi->viewAdminMain();
        $output = ob_get_clean();
        
        $this->assertInternalType('string', $output);
    }
    
    public function testCreateIconSetsReturnsMarkup() {
        ob_start();
        $this->msmi->viewCreateIconSets();
        $output = ob_get_clean();
        
        $this->assertInternalType('string', $output);
    }
    
    public function testEditIconSetsReturnsMarkup() {
        ob_start();
        $this->msmi->viewEditIconSets();
        $output = ob_get_clean();
        
        $this->assertInternalType('string', $output);
    }
    
    public function testDeleteIconSetsReturnsMarkup() {
        ob_start();
        $this->msmi->viewDeleteIconSets();
        $output = ob_get_clean();
        
        $this->assertInternalType('string', $output);
    }

    public function testAdminMainPageShowsListOfAllPossibleIcons() {
        ob_start();
        $this->msmi->viewAdminMain();
        $output = ob_get_clean();
        
        $this->markTestIncomplete('not fully implemented');
    }
    /**
     * @covers MultipleSocialMediaIcons::sub_menu_page
     * @todo Implement testSub_menu_page().
     */
    public function testSub_menu_page() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

}

?>

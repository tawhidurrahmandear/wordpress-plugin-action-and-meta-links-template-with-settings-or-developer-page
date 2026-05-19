<?php
/*
Plugin Name: Plugin Name, may be XYZ
Plugin URI: https://www.example.com/wordpress/plugin-name/free-version/
Description: Write a Description here. Also change Author name, and both URIs. 
Version: 1.0
Author: Type your name or business name here
Author URI: https://www.example.com
Requires at least: 6.0
Requires PHP: 7.4
Domain Path: /languages
License: GPL 2.0 or later
Text Domain: text-domain
*/



// Prevent direct file access
if (!defined('ABSPATH')) {
    exit;
}



/**
 * Plugin Action Links, (LEFT SIDE - next to Activate/Deactivate)
 */

	function uniqueprefix_action_links($actions) {
		
		$main_menu_settings_link = '<a href="' . esc_url(admin_url('admin.php?page=plugin-name-options&tab=settings')) . '">' . esc_html__('Plugin Settings', 'text-domain') . '</a>';
		
		$second_level_settings_link = '<a href="' . esc_url(admin_url('tools.php?page=plugin-name-options-tools&tab=settings')) . '">' . esc_html__('Plugin Settings Page as Example under Tool Menu', 'text-domain') . '</a>';
				
		$permalink_settings_page_link = '<a href="' . esc_url(admin_url('options-permalink.php')) . '">' . esc_html__('Permalink Settings Page', 'text-domain') . '</a>';
		
		$documentation_link = '<a href="' . esc_url('https://www.example.com/wordpress/plugin-name/free-version/documentation') . '" target="_blank">' . esc_html__('External Documentation Link', 'text-domain') . '</a>';
		
		// Add all links to the beginning
		array_unshift(
			$actions,
			$main_menu_settings_link,
			$second_level_settings_link,
			$permalink_settings_page_link,
			$documentation_link
		);
		
		return $actions;
	}

	add_filter(
		'plugin_action_links_' . plugin_basename(__FILE__),
		'uniqueprefix_action_links',
		10,
		1
	);


/**
 * Plugin Row Meta Links, (RIGHT SIDE - under plugin description)
 */


function uniqueprefix_row_meta($plugin_meta, $plugin_file) {
    if (plugin_basename(__FILE__) !== $plugin_file) {
        return $plugin_meta;
    }
	
    $plugin_meta[] = '<a href="' . esc_url('https://www.example.com/wordpress/plugin-name/free-version/live-preview') . '" target="_blank">' . esc_html__('Live Preview', 'text-domain') . '</a>';
    
    $plugin_meta[] = '<a href="' . esc_url('https://wordpress.org/plugins/plugin-name#reviews') . '" target="_blank">' . esc_html__('Rate this free plugin on WordPress.org', 'text-domain') . '</a>';
	
    $plugin_meta[] = '<a href="' . esc_url('https://www.example.com/wordpress/plugin-name/pro-version/') . '" target="_blank">' . esc_html__('Buy Pro Version', 'text-domain') . '</a>';
	
    $plugin_meta[] = '<a href="' . esc_url('https://www.tawhidurrahmandear.com') . '" target="_blank">' . esc_html__('Plugin Developer', 'text-domain') . '</a>';
	
    $plugin_meta[] = '<a href="' . esc_url(admin_url('admin.php?page=plugin-name-options&tab=settings')) . '">' . esc_html__('Plugin Settings', 'text-domain') . '</a>';
	
    $plugin_meta[] = '<a href="' . esc_url(admin_url('tools.php?page=plugin-name-options-tools&tab=settings')) . '">' . esc_html__('Plugin Settings Page as Example under Tool Menu', 'text-domain') . '</a>';
    
    return $plugin_meta;
}
add_filter('plugin_row_meta', 'uniqueprefix_row_meta', 10, 2);



/**
 * Special Page for Plugin. You can use as Settings page or Developer introduction page.
 * Or, you can delete the separate page, and delete the section below. Your choice. 
 */


class uniqueprefix_admin_page {

    public function __construct() {
        add_action('admin_menu', array($this, 'register_page'));
    }

    public function register_page() {

        add_menu_page(
            'Plugin Name',              // Page title
            'Plugin Name',              // Menu title
            'manage_options',           // Capability
            'plugin-name-options',      // page=
            array($this, 'settings_page'),
            plugin_dir_url(__FILE__) . 'assets/icon.png',  // Icon
            65                          // Position
        );
    }

    public function settings_page() {

	$tab = isset($_GET['tab'])
		? sanitize_key(wp_unslash($_GET['tab']))
		: 'settings';

        switch ($tab) {

            case 'settings':
                include plugin_dir_path(__FILE__) . 'text-domain-settings.php';
                break;

            case 'tutorial':
                include plugin_dir_path(__FILE__) . 'text-domain-tutorial.php';
                break;

            default:
                include plugin_dir_path(__FILE__) . 'text-domain-settings.php';
        }
    }
}

new uniqueprefix_admin_page();



/**
 * Special Page under Tools Menu. 
 */



class uniqueprefix_tools_page {

    public function __construct() {
        add_action('admin_menu', array($this, 'register_tools_page'));
    }

    public function register_tools_page() {

        add_submenu_page(
            'tools.php',
            'Plugin Name Tools',
            'Plugin Name Example',
            'manage_options',
            'plugin-name-options-tools',
            array($this, 'settings_page')
        );
    }

    public function settings_page() {
        include plugin_dir_path(__FILE__) . 'text-domain-settings.php';
    }
}

new uniqueprefix_tools_page();



/**
 * Every option, functions, constants, classes, hooks, filter should use the same prefix,
 * and that prefix should be unique across the entire WordPress ecosystem.
 * No other theme or plugin should use the same prefix.
 *
 * I used "uniqueprefix" as an example unique prefix here.
 *
 * If your WordPress.org username is abc and your plugin name initials are xyz,
 * you could use abcxyz as your prefix.
 */



/**
 * developed by Tawhidur Rahman Dear, https://www.tawhidurrahmandear.com
 * Released under GPL-2.0 license on Github at https://github.com/tawhidurrahmandear/wordpress-plugin-action-and-meta-links-template-with-settings-or-developer-page 
 */



/**
 * Plugin Code starts from here. 
 */
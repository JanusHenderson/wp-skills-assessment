<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.janushenderson.com/
 * @since             1.0.0
 * @package           Jh_Nyt_Top_Stories
 *
 * @wordpress-plugin
 * Plugin Name:       Janus Henderson NYT Top Stories
 * Plugin URI:        https://github.com/JanusHenderson/wp-skills-assessment
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Janus Henderson
 * Author URI:        https://www.janushenderson.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       jh-nyt-top-stories
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'JH_NYT_TOP_STORIES_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-jh-nyt-top-stories-activator.php
 */
function activate_jh_nyt_top_stories() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-jh-nyt-top-stories-activator.php';
	Jh_Nyt_Top_Stories_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-jh-nyt-top-stories-deactivator.php
 */
function deactivate_jh_nyt_top_stories() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-jh-nyt-top-stories-deactivator.php';
	Jh_Nyt_Top_Stories_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_jh_nyt_top_stories' );
register_deactivation_hook( __FILE__, 'deactivate_jh_nyt_top_stories' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-jh-nyt-top-stories.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_jh_nyt_top_stories() {

	$plugin = new Jh_Nyt_Top_Stories();
	$plugin->run();

}
run_jh_nyt_top_stories();

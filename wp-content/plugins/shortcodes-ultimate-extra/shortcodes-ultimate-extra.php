<?php
/*
  Plugin Name: Shortcodes Ultimate: Extra Shortcodes
  Plugin URI: https://getshortcodes.com/add-ons/extra-shortcodes/
  Version: 1.5.12
  Author: Vladimir Anokhin
  Author URI: https://vanokhin.com/
  Description: Extra set of shortcodes for Shortcodes Ultimate
  Text Domain: shortcodes-ultimate-extra
  Domain Path: /languages
  License: license.txt
 */

/**
 * Begins execution of the plugin.
 *
 * @since 1.5.7
 */
function run_shortcodes_ultimate_extra() {

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-shortcodes-ultimate-extra.php';

	$plugin = new Shortcodes_Ultimate_Extra( __FILE__, '1.5.12' );

	do_action( 'su/extra/ready', $plugin );

}

add_action( 'plugins_loaded', 'run_shortcodes_ultimate_extra' );

/**
 * Run plugin updater.
 *
 * @since  1.5.12
 */
function update_shortcodes_ultimate_extra() {

	require_once plugin_dir_path( __FILE__ ) . 'admin/plugin-update-check.php';

	$updater = new PluginUpdateChecker_2_0 (
		'https://kernl.us/api/v1/updates/59b6716884b8d004d060e153/',
		__FILE__,
		'shortcodes-ultimate-extra',
		24
	);

	add_action(
		'puc_manual_check_link-shortcodes-ultimate-extra',
		'__return_empty_string'
	);

}

update_shortcodes_ultimate_extra();

/**
 * The code that runs during plugin activation.
 *
 * @since  1.5.7
 */
function activate_shortcodes_ultimate_extra() {

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-shortcodes-ultimate-extra-activator.php';

	Shortcodes_Ultimate_Extra_Activator::activate();

}

register_activation_hook( __FILE__, 'activate_shortcodes_ultimate_extra' );

/**
 * The code that runs during plugin deactivation.
 *
 * @since  1.5.7
 */
function deactivate_shortcodes_ultimate_extra() {

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-shortcodes-ultimate-extra-deactivator.php';

	Shortcodes_Ultimate_Extra_Deactivator::deactivate();

}

register_deactivation_hook( __FILE__, 'deactivate_shortcodes_ultimate_extra' );

/**
 * Make plugin meta available for translation via POEdit.
 */
if ( false ) {
	__( 'Vladimir Anokhin', 'shortcodes-ultimate-extra' );
	__( 'Shortcodes Ultimate: Extra Shortcodes', 'shortcodes-ultimate-extra' );
	__( 'Extra set of shortcodes for Shortcodes Ultimate', 'shortcodes-ultimate-extra' );
}

<?php

/**
 * The plugin updater class.
 *
 * @since        1.5.5
 * @version      1.0.1
 * @package      Shortcodes_Ultimate_Extra
 * @subpackage   Shortcodes_Ultimate_Extra/admin
 */
final class Shortcodes_Ultimate_Addon_Updater {

	/**
	 * The path to the main plugin file.
	 *
	 * @since    1.5.5
	 * @access   private
	 * @var      string    $plugin_file   The path to the main plugin file.
	 */
	private $plugin_file;

	/**
	 * The slug of the plugin (for remote API).
	 *
	 * @since    1.5.5
	 * @access   private
	 * @var      string    $plugin_slug   The slug of the plugin (for remote API).
	 */
	private $plugin_slug;

	/**
	 * The url of the remote updates API.
	 *
	 * @since    1.5.5
	 * @access   private
	 * @var      string    $api_url   The url of the remote updates API.
	 */
	private $api_url;

	/**
	 * The option with plugin license key.
	 *
	 * @since    1.5.5
	 * @access   private
	 * @var      string    $license_key_option   The option with plugin license key.
	 */
	private $license_key_option;

	/**
	 * Define the functionality of the updater.
	 *
	 * @since   1.5.5
	 * @param string  $plugin_file    The path to the main plugin file.
	 * @param string  $plugin_version The current version of the plugin.
	 * @param string  $addon_id       The ID of the add-on.
	 */
	public function __construct( $plugin_file, $plugin_slug, $plugin_uuid, $addon_id ) {

		$this->plugin_file        = $plugin_file;
		$this->plugin_slug        = $plugin_slug;
		$this->api_url            = "https://kernl.us/api/v1/updates/{$plugin_uuid}/";
		$this->license_key_option = "su_option_{$addon_id}_license";

	}

	/**
	 * Run the updater.
	 *
	 * @since  1.5.5
	 */
	public function check_for_updates() {

		if ( ! $this->is_license_key_active() ) {
			return;
		}

		$plugin_update_checker = new PluginUpdateChecker_2_0 (
			$this->api_url,
			$this->plugin_file,
			$this->plugin_slug,
			24
		);

	}

	/**
	 * Check if license key activated.
	 *
	 * @since  1.5.5
	 * @access private
	 * @return bool    True if license key activated, False otherwise.
	 */
	private function is_license_key_active() {

		$key = get_option( $this->license_key_option, '' );

		return ! empty( $key );

	}

}

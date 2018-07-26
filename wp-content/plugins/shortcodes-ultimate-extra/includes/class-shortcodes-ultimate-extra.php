<?php

/**
 * The core plugin class.
 *
 * This is used to define internationalization and hooks.
 *
 * @since        1.5.7
 * @package      Shortcodes_Ultimate_Extra
 * @subpackage   Shortcodes_Ultimate_Extra/includes
 */
final class Shortcodes_Ultimate_Extra {

	/**
	 * The path to the main plugin file.
	 *
	 * @since    1.5.7
	 * @access   private
	 * @var      string      $plugin_file   The path to the main plugin file.
	 */
	private $plugin_file;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.5.7
	 * @access   private
	 * @var      string      $plugin_version   The current version of the plugin.
	 */
	private $plugin_version;

	/**
	 * The path to the plugin folder.
	 *
	 * @since    1.5.7
	 * @access   private
	 * @var      string      $plugin_path   The path to the plugin folder.
	 */
	private $plugin_path;

	/**
	 * The URL of the plugin folder.
	 *
	 * @since    1.5.7
	 * @access   private
	 * @var      string    $plugin_url    The URL of the plugin folder.
	 */
	private $plugin_url;

	/**
	 * The text domain for i18n.
	 *
	 * @since    1.5.7
	 * @access   private
	 * @var      string    $textdomain    The text domain for i18n.
	 */
	private $textdomain;

	/**
	 * The ID of the add-on.
	 *
	 * @since    1.5.7
	 * @access   private
	 * @var      string    $addon_id   The ID of the add-on.
	 */
	private $addon_id;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * @since   1.5.7
	 * @param string  $plugin_file    The path to the main plugin file.
	 * @param string  $plugin_version The current version of the plugin.
	 */
	public function __construct( $plugin_file, $plugin_version ) {

		$this->plugin_file    = $plugin_file;
		$this->plugin_version = $plugin_version;
		$this->plugin_path    = plugin_dir_path( $plugin_file );
		$this->plugin_url     = plugin_dir_url( $plugin_file );
		$this->textdomain     = 'shortcodes-ultimate-extra';
		$this->addon_id       = 'extra-shortcodes';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_common_hooks();
		$this->define_admin_hooks();

	}

	/**
	 * Load the required dependencies for the plugin.
	 *
	 * @since    1.5.7
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		if ( ! class_exists( 'Shortcodes_Ultimate_Addon_i18n' ) ) {
			require_once $this->plugin_path . 'includes/class-shortcodes-ultimate-addon-i18n.php';
		}

		/**
		 * Classes responsible for displaying admin notices.
		 */
		if ( ! class_exists( 'Shortcodes_Ultimate_Addon_Notice' ) ) {
			require_once $this->plugin_path . 'admin/class-shortcodes-ultimate-addon-notice.php';
		}

		if ( ! class_exists( 'Shortcodes_Ultimate_Addon_License_Notice' ) ) {
			require_once $this->plugin_path . 'admin/class-shortcodes-ultimate-addon-license-notice.php';
		}

		if ( ! class_exists( 'Shortcodes_Ultimate_Addon_Core_Notice' ) ) {
			require_once $this->plugin_path . 'admin/class-shortcodes-ultimate-addon-core-notice.php';
		}

		/**
		 * Static class containing shortcode handlers.
		 */
		require_once $this->plugin_path . 'includes/class-shortcodes-ultimate-extra-shortcodes.php';

		/**
		 * Include the class responsible for plugin settings.
		 */
		require_once $this->plugin_path . 'admin/class-shortcodes-ultimate-extra-settings.php';

		/**
		 * Include the class responsible for plugin upgrade procedures.
		 */
		require_once $this->plugin_path . 'includes/class-shortcodes-ultimate-extra-upgrade.php';

	}

	/**
	 * Define the locale for the plugin for internationalization.
	 *
	 * @since    1.5.7
	 * @access   private
	 */
	private function set_locale() {

		$i18n = new Shortcodes_Ultimate_Addon_i18n( $this->plugin_file, $this->textdomain );

		$i18n->load_plugin_textdomain();

	}

	/**
	 * Register all of the hooks related to both admin and public areas of the
	 * site.
	 *
	 * @since    1.5.7
	 * @access   private
	 */
	private function define_common_hooks() {

		/**
		 * Register scripts and stylesheets.
		 */
		add_action( 'init', array( $this, 'register_assets' ) );

		/**
		 * Register new shortcodes.
		 */
		add_filter( 'su/data/shortcodes', array( $this, 'register_shortcodes' ) );

		/**
		 * Validate license before updating.
		 */
		add_filter(
			'puc_pre_inject_update-shortcodes-ultimate-extra',
			array( $this, 'validate_license_before_updating' )
		);

	}

	/**
	 * Register all of the hooks related to the admin area functionality of the
	 * plugin.
	 *
	 * @since    1.5.7
	 * @access   private
	 */
	private function define_admin_hooks() {

		/**
		 * Run upgrade procedures.
		 */
		$upgrade = new Shortcodes_Ultimate_Extra_Upgrade( $this->plugin_file, $this->plugin_version );

		add_action( 'admin_init', array( $upgrade, 'upgrade' ) );

		/**
		 * Register new shortcodes group.
		 */
		add_filter( 'su/data/groups', array( $this, 'register_group' ) );

		/**
		 * The 'Activate license key' notice.
		 */
		$license_notice = new Shortcodes_Ultimate_Addon_License_Notice( $this->addon_id, $this->plugin_path . 'admin/partials/notices/license.php' );

		add_action( 'admin_notices',                array( $license_notice, 'display_notice' ) );
		add_action( 'admin_post_su_dismiss_notice', array( $license_notice, 'dismiss_notice' ) );


		/**
		 * The 'Install Core' notice.
		 */
		$core_notice = new Shortcodes_Ultimate_Addon_Core_Notice( $this->addon_id, $this->plugin_path . 'admin/partials/notices/core.php' );

		add_action( 'admin_notices',                array( $core_notice, 'display_notice' ) );
		add_action( 'admin_post_su_dismiss_notice', array( $core_notice, 'dismiss_notice' ) );

		/**
		 * Add plugin settings.
		 */
		$settings = new Shortcodes_Ultimate_Extra_Settings( $this->plugin_file );

		add_action( 'admin_init',     array( $settings, 'register_settings' ) );
		add_action( 'current_screen', array( $settings, 'add_help_tab' )      );

	}

	/**
	 * Register add-on assets.
	 *
	 * @since  1.5.7
	 */
	public function register_assets() {

		wp_register_style( 'shortcodes-ultimate-extra', $this->plugin_url . 'public/css/shortcodes.css', false, $this->plugin_version, 'all' );

		wp_register_script( 'shortcodes-ultimate-extra', $this->plugin_url . 'public/js/shortcodes.js', array( 'jquery' ), $this->plugin_version, true );

	}

	/**
	 * Register new shortcodes group.
	 *
	 * @since  1.5.7
	 * @param mixed   $groups Groups collection.
	 * @return mixed          Modified groups collection.
	 */
	public function register_group( $groups ) {

		$groups['extra'] = _x( 'Extra Shortcodes', 'Custom shortcodes group name', 'shortcodes-ultimate-extra' );

		return $groups;

	}

	/**
	 * Register new shortcodes.
	 *
	 * @since  1.5.7
	 * @param mixed   $shortcodes Shortcodes collection.
	 * @return mixed              Modified shortcodes collection.
	 */
	public function register_shortcodes( $shortcodes ) {

		$images_url = $this->plugin_url . 'admin/images/shortcodes/';

		$shortcodes['splash'] = array(
			'name'     => __( 'Splash screen', 'shortcodes-ultimate-extra' ),
			'type'     => 'wrap',
			'group'    => 'extra box',
			'content'  => __( 'Splash screen content', 'shortcodes-ultimate-extra' ),
			'desc'     => __( 'Fully customizable splash screen', 'shortcodes-ultimate-extra' ),
			'icon'     => 'bullhorn',
			'image'    => $images_url . 'splash.svg',
			'function' => array( 'Shortcodes_Ultimate_Extra_Shortcodes', 'splash' ),
			'atts'     => array(
				'style' => array(
					'type'    => 'select',
					'default' => 'dark',
					'name'    => __( 'Style', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Choose splash screen style', 'shortcodes-ultimate-extra' ),
					'values'   => array(
						'dark'               => __( 'Dark', 'shortcodes-ultimate-extra' ),
						'dark-boxed'         => __( 'Dark boxed', 'shortcodes-ultimate-extra' ),
						'light'              => __( 'Light', 'shortcodes-ultimate-extra' ),
						'light-boxed'        => __( 'Light boxed', 'shortcodes-ultimate-extra' ),
						'blue-boxed'         => __( 'Blue boxed', 'shortcodes-ultimate-extra' ),
						'light-boxed-blue'   => __( 'Light boxed blue', 'shortcodes-ultimate-extra' ),
						'light-boxed-green'  => __( 'Light boxed green', 'shortcodes-ultimate-extra' ),
						'light-boxed-orange' => __( 'Light boxed orange', 'shortcodes-ultimate-extra' ),
						'maintenance'        => __( 'Maintenance', 'shortcodes-ultimate-extra' )
					)
				),
				'width' => array(
					'type'    => 'slider',
					'min'     => 100,
					'max'     => 1600,
					'step'    => 20,
					'default' => 480,
					'name'    => __( 'Width', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Width of splash screen content', 'shortcodes-ultimate-extra' )
				),
				'opacity' => array(
					'type'    => 'slider',
					'min'     => 0,
					'max'     => 100,
					'step'    => 5,
					'default' => 80,
					'name'    => __( 'Opacity', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Background opacity in percents', 'shortcodes-ultimate-extra' )
				),
				'onclick' => array(
					'type'    => 'select',
					'default' => 'close-bg',
					'name'    => __( 'Action on click', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Choose splash screen behavior when it is clicked', 'shortcodes-ultimate-extra' ),
					'values'  => array(
						'none'     => __( 'Do nothing', 'shortcodes-ultimate-extra' ),
						'close'    => __( 'Close splash screen (click anywhere)', 'shortcodes-ultimate-extra' ),
						'close-bg' => __( 'Close on background click', 'shortcodes-ultimate-extra' ),
						'url'      => __( 'Go to specified url', 'shortcodes-ultimate-extra' )
					)
				),
				'url' => array(
					'name'    => __( 'URL', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Enter url to go when splash screen is clicked (this option must selected in dropdown list above)', 'shortcodes-ultimate-extra' ),
					'default' => get_bloginfo( 'url' )
				),
				'delay' => array(
					'type'    => 'slider',
					'min'     => 0,
					'max'     => 120,
					'step'    => 1,
					'default' => 0,
					'name'    => __( 'Delay', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Specify the time in which the splash screen will be shown (in seconds)', 'shortcodes-ultimate-extra' )
				),
				'esc' => array(
					'type'    => 'bool',
					'default' => 'yes',
					'name'    => __( 'Esc hotkey', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Close the screen by pressing Esc', 'shortcodes-ultimate-extra' )
				),
				'close' => array(
					'type'    => 'bool',
					'default' => 'yes',
					'name'    => __( 'Close button', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Show Close button', 'shortcodes-ultimate-extra' )
				),
				'once' => array(
					'type'    => 'bool',
					'default' => 'no',
					'name'    => __( 'Show once', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Show this splash screen only once on this page', 'shortcodes-ultimate-extra' )
				),
				'class' => array(
					'type' => 'extra_css_class',
					'name' => __( 'Extra CSS class', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Additional CSS class name(s) separated by space(s)', 'shortcodes-ultimate-extra' ),
					'default' => '',
				),
			)
		);
		$shortcodes['exit_popup'] = array(
			'name'     => __( 'Exit popup', 'shortcodes-ultimate-extra' ),
			'type'     => 'wrap',
			'group'    => 'extra box',
			'content'  => __( 'Exit popup content', 'shortcodes-ultimate-extra' ),
			'desc'     => __( 'Fully customizable exit popup', 'shortcodes-ultimate-extra' ),
			'icon'     => 'bullhorn',
			'image'    => $images_url . 'exit_popup.svg',
			'function' => array( 'Shortcodes_Ultimate_Extra_Shortcodes', 'exit_popup' ),
			'atts'     => array(
				'style' => array(
					'type'    => 'select',
					'default' => 'dark',
					'name'    => __( 'Style', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Choose exit popup style', 'shortcodes-ultimate-extra' ),
					'values'   => array(
						'dark'               => __( 'Dark', 'shortcodes-ultimate-extra' ),
						'dark-boxed'         => __( 'Dark boxed', 'shortcodes-ultimate-extra' ),
						'light'              => __( 'Light', 'shortcodes-ultimate-extra' ),
						'light-boxed'        => __( 'Light boxed', 'shortcodes-ultimate-extra' ),
						'blue-boxed'         => __( 'Blue boxed', 'shortcodes-ultimate-extra' ),
						'light-boxed-blue'   => __( 'Light boxed blue', 'shortcodes-ultimate-extra' ),
						'light-boxed-green'  => __( 'Light boxed green', 'shortcodes-ultimate-extra' ),
						'light-boxed-orange' => __( 'Light boxed orange', 'shortcodes-ultimate-extra' ),
						'maintenance'        => __( 'Maintenance', 'shortcodes-ultimate-extra' )
					)
				),
				'width' => array(
					'type'    => 'slider',
					'min'     => 100,
					'max'     => 1600,
					'step'    => 20,
					'default' => 480,
					'name'    => __( 'Width', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Width of exit popup content', 'shortcodes-ultimate-extra' )
				),
				'opacity' => array(
					'type'    => 'slider',
					'min'     => 0,
					'max'     => 100,
					'step'    => 5,
					'default' => 80,
					'name'    => __( 'Opacity', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Background opacity in percents', 'shortcodes-ultimate-extra' )
				),
				'onclick' => array(
					'type'    => 'select',
					'default' => 'close-bg',
					'name'    => __( 'Action on click', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Choose exit popup behavior when it is clicked', 'shortcodes-ultimate-extra' ),
					'values'  => array(
						'none'     => __( 'Do nothing', 'shortcodes-ultimate-extra' ),
						'close'    => __( 'Close exit popup (click anywhere)', 'shortcodes-ultimate-extra' ),
						'close-bg' => __( 'Close on background click', 'shortcodes-ultimate-extra' ),
						'url'      => __( 'Go to specified url', 'shortcodes-ultimate-extra' )
					)
				),
				'url' => array(
					'name'    => __( 'URL', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Enter url to go when exit popup is clicked (this option must selected in dropdown list above)', 'shortcodes-ultimate-extra' ),
					'default' => get_bloginfo( 'url' )
				),
				'esc' => array(
					'type'    => 'bool',
					'default' => 'yes',
					'name'    => __( 'Esc hotkey', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Close popup by pressing Esc', 'shortcodes-ultimate-extra' )
				),
				'close' => array(
					'type'    => 'bool',
					'default' => 'yes',
					'name'    => __( 'Close button', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Show Close button', 'shortcodes-ultimate-extra' )
				),
				'once' => array(
					'type'    => 'bool',
					'default' => 'no',
					'name'    => __( 'Show once', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Show this exit popup only once on this page', 'shortcodes-ultimate-extra' )
				),
				'class' => array(
					'type' => 'extra_css_class',
					'name' => __( 'Extra CSS class', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Additional CSS class name(s) separated by space(s)', 'shortcodes-ultimate-extra' ),
					'default' => '',
				),
			)
		);

		$shortcodes['panel'] = array(
			'name'     => __( 'Panel', 'shortcodes-ultimate-extra' ),
			'type'     => 'wrap',
			'group'    => 'extra box',
			'content'  => __( 'Panel content', 'shortcodes-ultimate-extra' ),
			'desc'     => __( 'Colorful box with custom content', 'shortcodes-ultimate-extra' ),
			'icon'     => 'pencil-square-o',
			'image'    => $images_url . 'panel.svg',
			'function' => array( 'Shortcodes_Ultimate_Extra_Shortcodes', 'panel' ),
			'atts'     => array(
				'background' => array(
					'type' => 'color',
					'default' => '#ffffff',
					'name' => __( 'Background', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Panel background color', 'shortcodes-ultimate-extra' )
				),
				'color' => array(
					'type' => 'color',
					'default' => '#333333',
					'name' => __( 'Color', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Panel text color', 'shortcodes-ultimate-extra' )
				),
				'border' => array(
					'type'    => 'border',
					'default' => '1px solid #cccccc',
					'name'    => __( 'Border', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Panel border', 'shortcodes-ultimate-extra' )
				),
				'shadow' => array(
					'type'    => 'shadow',
					'default' => '0px 1px 2px #eeeeee',
					'name'    => __( 'Shadow', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Panel shadow', 'shortcodes-ultimate-extra' )
				),
				'radius' => array(
					'type' => 'slider',
					'min' => 0,
					'max' => 60,
					'step' => 1,
					'default' => 0,
					'name' => __( 'Border radius', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Panel border radius (px)', 'shortcodes-ultimate-extra' )
				),
				'text_align' => array(
					'type'    => 'select',
					'default' => 'left',
					'values' => array(
						'left' => __( 'Left', 'shortcodes-ultimate-extra' ),
						'center' => __( 'Center', 'shortcodes-ultimate-extra' ),
						'right' => __( 'Right', 'shortcodes-ultimate-extra' )
					),
					'name'    => __( 'Text align', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Text alignment for panel content', 'shortcodes-ultimate-extra' )
				),
				'url' => array(
					'default' => '',
					'name'    => __( 'URL', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'You can type here any hyperlink to make this panel clickable', 'shortcodes-ultimate-extra' )
				),
				'class' => array(
					'type' => 'extra_css_class',
					'name' => __( 'Extra CSS class', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Additional CSS class name(s) separated by space(s)', 'shortcodes-ultimate-extra' ),
					'default' => '',
				),
			)
		);

		$shortcodes['photo_panel'] = array(
			'name'     => __( 'Photo panel', 'shortcodes-ultimate-extra' ),
			'type'     => 'wrap',
			'group'    => 'extra box',
			'content'  => __( 'Panel content', 'shortcodes-ultimate-extra' ),
			'desc'     => __( 'Colorful box with image', 'shortcodes-ultimate-extra' ),
			'icon'     => 'pencil-square-o',
			'image'    => $images_url . 'photo_panel.svg',
			'function' => array( 'Shortcodes_Ultimate_Extra_Shortcodes', 'photo_panel' ),
			'atts'     => array(
				'background' => array(
					'type' => 'color',
					'default' => '#ffffff',
					'name' => __( 'Background', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Panel background color', 'shortcodes-ultimate-extra' )
				),
				'color' => array(
					'type' => 'color',
					'default' => '#333333',
					'name' => __( 'Color', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Panel text color', 'shortcodes-ultimate-extra' )
				),
				'border' => array(
					'type'    => 'border',
					'default' => '1px solid #cccccc',
					'name'    => __( 'Border', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Panel border', 'shortcodes-ultimate-extra' )
				),
				'shadow' => array(
					'type'    => 'shadow',
					'default' => '0 1px 2px #eeeeee',
					'name'    => __( 'Shadow', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Panel shadow', 'shortcodes-ultimate-extra' )
				),
				'radius' => array(
					'type' => 'slider',
					'min' => 0,
					'max' => 60,
					'step' => 1,
					'default' => 0,
					'name' => __( 'Border radius', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Panel border radius (px)', 'shortcodes-ultimate-extra' )
				),
				'text_align' => array(
					'type'    => 'select',
					'default' => 'left',
					'values' => array(
						'left' => __( 'Left', 'shortcodes-ultimate-extra' ),
						'center' => __( 'Center', 'shortcodes-ultimate-extra' ),
						'right' => __( 'Right', 'shortcodes-ultimate-extra' )
					),
					'name'    => __( 'Text align', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Text alignment for panel content', 'shortcodes-ultimate-extra' )
				),
				'photo' => array(
					'type' => 'upload',
					'default' => 'http://lorempixel.com/400/300/food/',
					'name'    => __( 'Photo', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Select the photo for this panel', 'shortcodes-ultimate-extra' )
				),
				'alt' => array(
					'default' => '',
					'name'    => __( 'Alternative image text', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Alternative image text (alt attribute)', 'shortcodes-ultimate-extra' )
				),
				'url' => array(
					'default' => '',
					'name'    => __( 'URL', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'You can type here any hyperlink to make this panel clickable', 'shortcodes-ultimate-extra' )
				),
				'class' => array(
					'type' => 'extra_css_class',
					'name' => __( 'Extra CSS class', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Additional CSS class name(s) separated by space(s)', 'shortcodes-ultimate-extra' ),
					'default' => '',
				),
			)
		);

		$shortcodes['icon_panel'] = array(
			'name'     => __( 'Icon panel', 'shortcodes-ultimate-extra' ),
			'type'     => 'wrap',
			'group'    => 'extra box',
			'content'  => __( 'Panel content', 'shortcodes-ultimate-extra' ),
			'desc'     => __( 'Colorful box with icon', 'shortcodes-ultimate-extra' ),
			'icon'     => 'pencil-square-o',
			'image'    => $images_url . 'icon_panel.svg',
			'function' => array( 'Shortcodes_Ultimate_Extra_Shortcodes', 'icon_panel' ),
			'atts'     => array(
				'background' => array(
					'type'    => 'color',
					'default' => '#ffffff',
					'name'    => __( 'Background', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Panel background color', 'shortcodes-ultimate-extra' )
				),
				'color' => array(
					'type'    => 'color',
					'default' => '#333333',
					'name'    => __( 'Color', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Panel text color', 'shortcodes-ultimate-extra' )
				),
				'border' => array(
					'type'    => 'border',
					'default' => '1px solid #cccccc',
					'name'    => __( 'Border', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Panel border', 'shortcodes-ultimate-extra' )
				),
				'shadow' => array(
					'type'    => 'shadow',
					'default' => '0 1px 2px #eeeeee',
					'name'    => __( 'Shadow', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Panel shadow', 'shortcodes-ultimate-extra' )
				),
				'radius' => array(
					'type'    => 'slider',
					'min'     => 0,
					'max'     => 60,
					'step'    => 1,
					'default' => 0,
					'name'    => __( 'Border radius', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Panel border radius (px)', 'shortcodes-ultimate-extra' )
				),
				'text_align' => array(
					'type'    => 'select',
					'default' => 'center',
					'name'    => __( 'Text align', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Text alignment for panel content', 'shortcodes-ultimate-extra' ),
					'values'  => array(
						'left'   => __( 'Left', 'shortcodes-ultimate-extra' ),
						'center' => __( 'Center', 'shortcodes-ultimate-extra' ),
						'right'  => __( 'Right', 'shortcodes-ultimate-extra' )
					)
				),
				'icon' => array(
					'type'    => 'icon',
					'default' => 'icon: heart',
					'name'    => __( 'Icon', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Select the icon for this panel', 'shortcodes-ultimate-extra' )
				),
				'icon_color' => array(
					'type'    => 'color',
					'default' => '#333333',
					'name'    => __( 'Icon color', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Select icon color. This color will be aplied only to built-in icons. Does not works for uploaded icons', 'shortcodes-ultimate-extra' )
				),
				'icon_size' => array(
					'type'    => 'slider',
					'min' => 10,
					'max' => 320,
					'step' => 1,
					'default' => 24,
					'name'    => __( 'Icon size', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Select icon size (px)', 'shortcodes-ultimate-extra' )
				),
				'url' => array(
					'default' => '',
					'name'    => __( 'URL', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'You can type here any hyperlink to make this panel clickable', 'shortcodes-ultimate-extra' )
				),
				'class' => array(
					'type' => 'extra_css_class',
					'name' => __( 'Extra CSS class', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Additional CSS class name(s) separated by space(s)', 'shortcodes-ultimate-extra' ),
					'default' => '',
				),
			)
		);

		$shortcodes['icon_text'] = array(
			'name'     => __( 'Text with icon', 'shortcodes-ultimate-extra' ),
			'type'     => 'wrap',
			'group'    => 'extra content',
			'content'  => __( 'Content', 'shortcodes-ultimate-extra' ),
			'desc'     => __( 'Text block with customizable icon', 'shortcodes-ultimate-extra' ),
			'icon'     => 'pencil',
			'image'    => $images_url . 'icon_text.svg',
			'function' => array( 'Shortcodes_Ultimate_Extra_Shortcodes', 'icon_text' ),
			'atts'     => array(
				'color' => array(
					'type'    => 'color',
					'default' => '#333333',
					'name'    => __( 'Color', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Text color', 'shortcodes-ultimate-extra' )
				),
				'icon' => array(
					'type'    => 'icon',
					'default' => 'icon: heart',
					'name'    => __( 'Icon', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Select the icon for this text block', 'shortcodes-ultimate-extra' )
				),
				'icon_color' => array(
					'type'    => 'color',
					'default' => '#333333',
					'name'    => __( 'Icon color', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Select icon color. This color will be aplied only to built-in icons. Does not works for uploaded icons', 'shortcodes-ultimate-extra' )
				),
				'icon_size' => array(
					'type'    => 'slider',
					'min' => 10,
					'max' => 320,
					'step' => 1,
					'default' => 24,
					'name'    => __( 'Icon size', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Select icon size (px)', 'shortcodes-ultimate-extra' )
				),
				'url' => array(
					'default' => '',
					'name'    => __( 'URL', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'You can type here any hyperlink to make this panel clickable', 'shortcodes-ultimate-extra' )
				),
				'class' => array(
					'type' => 'extra_css_class',
					'name' => __( 'Extra CSS class', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Additional CSS class name(s) separated by space(s)', 'shortcodes-ultimate-extra' ),
					'default' => '',
				),
			)
		);

		$shortcodes['progress_pie'] = array(
			'name'     => __( 'Progress pie', 'shortcodes-ultimate-extra' ),
			'type'     => 'single',
			'group'    => 'extra other',
			'desc'     => __( 'Customizable pie chart with counter', 'shortcodes-ultimate-extra' ),
			'icon'     => 'star-half-o',
			'image'    => $images_url . 'progress_pie.svg',
			'function' => array( 'Shortcodes_Ultimate_Extra_Shortcodes', 'progress_pie' ),
			'atts'     => array(
				'percent' => array(
					'type' => 'slider',
					'min' => 0,
					'max' => 100,
					'step' => 1,
					'default' => 75,
					'name' => __( 'Percent', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Specify percentage', 'shortcodes-ultimate-extra' )
				),
				'text' => array(
					'default' => '',
					'name'    => __( 'Text', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'You can show custom text instead of percent. Leave this field empty to show the percent', 'shortcodes-ultimate-extra' )
				),
				'before' => array(
					'default' => '',
					'name'    => __( 'Before', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'This content will be shown before the percent', 'shortcodes-ultimate-extra' )
				),
				'after' => array(
					'default' => '',
					'name'    => __( 'After', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'This content will be shown after the percent', 'shortcodes-ultimate-extra' )
				),
				'size' => array(
					'type' => 'slider',
					'min' => 20,
					'max' => 1200,
					'step' => 20,
					'default' => 200,
					'name' => __( 'Size', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Pie size (pixels)', 'shortcodes-ultimate-extra' )
				),
				'pie_width' => array(
					'type' => 'slider',
					'min' => 0,
					'max' => 100,
					'step' => 5,
					'default' => 30,
					'name' => __( 'Pie width', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Pie border width (percents)', 'shortcodes-ultimate-extra' )
				),
				'text_size' => array(
					'type' => 'slider',
					'min' => 10,
					'max' => 120,
					'step' => 5,
					'default' => 40,
					'name' => __( 'Text size', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Pie text size (pixels)', 'shortcodes-ultimate-extra' )
				),
				'align' => array(
					'type' => 'select',
					'values' => array(
						'none'   => __( 'None', 'shortcodes-ultimate-extra' ),
						'left'   => __( 'Left', 'shortcodes-ultimate-extra' ),
						'center' => __( 'Center', 'shortcodes-ultimate-extra' ),
						'right'  => __( 'Right', 'shortcodes-ultimate-extra' ),
					),
					'default' => 'center',
					'name' => __( 'Align', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Pie alignment', 'shortcodes-ultimate-extra' )
				),
				'pie_color' => array(
					'type' => 'color',
					'default' => '#f0f0f0',
					'name' => __( 'Pie color', 'su' ),
					'desc' => __( 'Unfilled pie background color', 'shortcodes-ultimate-extra' )
				),
				'fill_color' => array(
					'type' => 'color',
					'default' => '#97daed',
					'name' => __( 'Fill color', 'su' ),
					'desc' => __( 'Filled pie background color', 'shortcodes-ultimate-extra' )
				),
				'text_color' => array(
					'type' => 'color',
					'default' => '#cccccc',
					'name' => __( 'Text color', 'su' ),
					'desc' => __( 'Select pie text color', 'shortcodes-ultimate-extra' )
				),
				'class' => array(
					'type' => 'extra_css_class',
					'name' => __( 'Extra CSS class', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Additional CSS class name(s) separated by space(s)', 'shortcodes-ultimate-extra' ),
					'default' => '',
				),
			)
		);

		$shortcodes['progress_bar'] = array(
			'name'     => __( 'Progress bar', 'shortcodes-ultimate-extra' ),
			'type'     => 'single',
			'group'    => 'extra other',
			'desc'     => __( 'Customizable progress bar', 'shortcodes-ultimate-extra' ),
			'icon'     => 'star-half-o',
			'image'    => $images_url . 'progress_bar.svg',
			'function' => array( 'Shortcodes_Ultimate_Extra_Shortcodes', 'progress_bar' ),
			'atts'     => array(
				'style' => array(
					'type' => 'select',
					'values' => array(
						'default' => __( 'Default', 'shortcodes-ultimate-extra' ),
						'fancy'   => __( 'Fancy', 'shortcodes-ultimate-extra' ),
						'thin'    => __( 'Thin', 'shortcodes-ultimate-extra' )
					),
					'default' => 'default',
					'name' => __( 'Style', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Select progress bar style', 'shortcodes-ultimate-extra' )
				),
				'percent' => array(
					'type' => 'slider',
					'min' => 0,
					'max' => 100,
					'step' => 1,
					'default' => 75,
					'name' => __( 'Percent', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Specify percentage', 'shortcodes-ultimate-extra' )
				),
				'text' => array(
					'default' => '',
					'name'    => __( 'Text', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'You can show custom text instead of percent. Leave this field empty to show the percent', 'shortcodes-ultimate-extra' )
				),
				'bar_color' => array(
					'type' => 'color',
					'default' => '#f0f0f0',
					'name' => __( 'Bar color', 'su' ),
					'desc' => __( 'Unfilled bar background color', 'shortcodes-ultimate-extra' )
				),
				'fill_color' => array(
					'type' => 'color',
					'default' => '#97daed',
					'name' => __( 'Fill color', 'su' ),
					'desc' => __( 'Filled bar background color', 'shortcodes-ultimate-extra' )
				),
				'text_color' => array(
					'type' => 'color',
					'default' => '#555555',
					'name' => __( 'Text color', 'su' ),
					'desc' => __( 'Select bar text color', 'shortcodes-ultimate-extra' )
				),
				'class' => array(
					'type' => 'extra_css_class',
					'name' => __( 'Extra CSS class', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Additional CSS class name(s) separated by space(s)', 'shortcodes-ultimate-extra' ),
					'default' => '',
				),
			)
		);

		$shortcodes['member'] = array(
			'name'     => __( 'Member', 'shortcodes-ultimate-extra' ),
			'type'     => 'wrap',
			'group'    => 'extra box content',
			'content'  => __( 'Type here some info about this team member', 'shortcodes-ultimate-extra' ),
			'desc'     => __( 'Team member', 'shortcodes-ultimate-extra' ),
			'icon'     => 'users',
			'image'    => $images_url . 'member.svg',
			'function' => array( 'Shortcodes_Ultimate_Extra_Shortcodes', 'member' ),
			'atts'     => array(
				'background' => array(
					'type' => 'color',
					'default' => '#ffffff',
					'name' => __( 'Background', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Panel background color', 'shortcodes-ultimate-extra' )
				),
				'color' => array(
					'type' => 'color',
					'default' => '#333333',
					'name' => __( 'Color', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Panel text color', 'shortcodes-ultimate-extra' )
				),
				'border' => array(
					'type'    => 'border',
					'default' => '1px solid #cccccc',
					'name'    => __( 'Border', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Panel border', 'shortcodes-ultimate-extra' )
				),
				'shadow' => array(
					'type'    => 'shadow',
					'default' => '0 1px 2px #eeeeee',
					'name'    => __( 'Shadow', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Panel shadow', 'shortcodes-ultimate-extra' )
				),
				'radius' => array(
					'type' => 'slider',
					'min' => 0,
					'max' => 60,
					'step' => 1,
					'default' => 0,
					'name' => __( 'Border radius', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Panel border radius (px)', 'shortcodes-ultimate-extra' )
				),
				'text_align' => array(
					'type'    => 'select',
					'default' => 'left',
					'values'  => array(
						'left' => __( 'Left', 'shortcodes-ultimate-extra' ),
						'center' => __( 'Center', 'shortcodes-ultimate-extra' ),
						'right' => __( 'Right', 'shortcodes-ultimate-extra' )
					),
					'name'    => __( 'Text align', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Text alignment for panel content', 'shortcodes-ultimate-extra' )
				),
				'photo' => array(
					'type' => 'upload',
					'default' => 'http://lorempixel.com/400/300/business/',
					'name'    => __( 'Photo', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Select the photo for this member', 'shortcodes-ultimate-extra' )
				),
				'name' => array(
					'default' => __( 'John Doe', 'shortcodes-ultimate-extra' ),
					'name'    => __( 'Name', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Member name', 'shortcodes-ultimate-extra' )
				),
				'role' => array(
					'default' => __( 'Designer', 'shortcodes-ultimate-extra' ),
					'name'    => __( 'Role', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Member role', 'shortcodes-ultimate-extra' )
				),
				'icon_1' => array(
					'type'    => 'icon',
					'default' => '',
					'name'    => sprintf( __( 'Icon %d', 'shortcodes-ultimate-extra' ), 1 ),
					'desc'    => __( 'Select social icon for this member', 'shortcodes-ultimate-extra' )
				),
				'icon_1_url' => array(
					'default' => '',
					'name'    => sprintf( __( 'Icon %d URL', 'shortcodes-ultimate-extra' ), 1 ),
					'desc'    => __( 'Enter here social profile URL', 'shortcodes-ultimate-extra' )
				),
				'icon_1_color' => array(
					'type'    => 'color',
					'default' => '#333333',
					'name'    => sprintf( __( 'Icon %d color', 'shortcodes-ultimate-extra' ), 1 ),
					'desc'    => __( 'Choose color for this icon. This color will only be applied to the built-in icons', 'shortcodes-ultimate-extra' )
				),
				'icon_1_title' => array(
					'default' => '',
					'name'    => sprintf( __( 'Icon %d title', 'shortcodes-ultimate-extra' ), 1 ),
					'desc'    => __( 'This text will be shown as icon tooltip', 'shortcodes-ultimate-extra' )
				),
				'icon_2' => array(
					'type'    => 'icon',
					'default' => '',
					'name'    => sprintf( __( 'Icon %d', 'shortcodes-ultimate-extra' ), 2 ),
					'desc'    => __( 'Select social icon for this member', 'shortcodes-ultimate-extra' )
				),
				'icon_2_url' => array(
					'default' => '',
					'name'    => sprintf( __( 'Icon %d URL', 'shortcodes-ultimate-extra' ), 2 ),
					'desc'    => __( 'Enter here social profile URL', 'shortcodes-ultimate-extra' )
				),
				'icon_2_color' => array(
					'type'    => 'color',
					'default' => '#333333',
					'name'    => sprintf( __( 'Icon %d color', 'shortcodes-ultimate-extra' ), 2 ),
					'desc'    => __( 'Choose color for this icon. This color will only be applied to the built-in icons', 'shortcodes-ultimate-extra' )
				),
				'icon_2_title' => array(
					'default' => '',
					'name'    => sprintf( __( 'Icon %d title', 'shortcodes-ultimate-extra' ), 2 ),
					'desc'    => __( 'This text will be shown as icon tooltip', 'shortcodes-ultimate-extra' )
				),
				'icon_3' => array(
					'type'    => 'icon',
					'default' => '',
					'name'    => sprintf( __( 'Icon %d', 'shortcodes-ultimate-extra' ), 3 ),
					'desc'    => __( 'Select social icon for this member', 'shortcodes-ultimate-extra' )
				),
				'icon_3_url' => array(
					'default' => '',
					'name'    => sprintf( __( 'Icon %d URL', 'shortcodes-ultimate-extra' ), 3 ),
					'desc'    => __( 'Enter here social profile URL', 'shortcodes-ultimate-extra' )
				),
				'icon_3_color' => array(
					'type'    => 'color',
					'default' => '#333333',
					'name'    => sprintf( __( 'Icon %d color', 'shortcodes-ultimate-extra' ), 3 ),
					'desc'    => __( 'Choose color for this icon. This color will only be applied to the built-in icons', 'shortcodes-ultimate-extra' )
				),
				'icon_3_title' => array(
					'default' => '',
					'name'    => sprintf( __( 'Icon %d title', 'shortcodes-ultimate-extra' ), 3 ),
					'desc'    => __( 'This text will be shown as icon tooltip', 'shortcodes-ultimate-extra' )
				),
				'url' => array(
					'default' => '',
					'name'    => __( 'URL', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'You can type here any hyperlink to make this panel clickable', 'shortcodes-ultimate-extra' )
				),
				'class' => array(
					'type' => 'extra_css_class',
					'name' => __( 'Extra CSS class', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Additional CSS class name(s) separated by space(s)', 'shortcodes-ultimate-extra' ),
					'default' => '',
				),
			)
		);

		$shortcodes['section'] = array(
			'name'     => __( 'Section', 'shortcodes-ultimate-extra' ),
			'type'     => 'wrap',
			'group'    => 'extra box',
			'content'  => __( 'Section content', 'shortcodes-ultimate-extra' ),
			'desc'     => __( 'Content section with customizable background, dimensions and optional parallax effect', 'shortcodes-ultimate-extra' ),
			'icon'     => 'arrows-alt',
			'image'    => $images_url . 'section.svg',
			'function' => array( 'Shortcodes_Ultimate_Extra_Shortcodes', 'section' ),
			'atts'     => array(
				'background' => array(
					'type'    => 'color',
					'default' => '#ffffff',
					'name'    => __( 'Background color', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Section background color', 'shortcodes-ultimate-extra' )
				),
				'image' => array(
					'type' => 'upload',
					'default' => '',
					'name'    => __( 'Background image', 'shortcodes-ultimate-extra' ),
					'desc'    => sprintf( __( 'Select background image for this section. Example value: %s', 'shortcodes-ultimate-extra' ), '<b%value>http://lorempixel.com/1200/600/abstract/</b>' )
				),
				'background_position' => array(
					'type'    => 'select',
					'default' => 'left top',
					'values'  => array(
						'left top'   => __( 'Left Top', 'shortcodes-ultimate-extra' ),
						'center top' => __( 'Center Top', 'shortcodes-ultimate-extra' ),
						'right top'  => __( 'Right Top', 'shortcodes-ultimate-extra' ),
						'left center'   => __( 'Left Center', 'shortcodes-ultimate-extra' ),
						'center center' => __( 'Center Center', 'shortcodes-ultimate-extra' ),
						'right center'  => __( 'Right Center', 'shortcodes-ultimate-extra' ),
						'left bottom'   => __( 'Left Bottom', 'shortcodes-ultimate-extra' ),
						'center bottom' => __( 'Center Bottom', 'shortcodes-ultimate-extra' ),
						'right bottom'  => __( 'Right Bottom', 'shortcodes-ultimate-extra' ),
					),
					'name'    => __( 'Background image position', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'This option determines position of the background image', 'shortcodes-ultimate-extra' )
				),
				'parallax' => array(
					'type'    => 'bool',
					'default' => 'yes',
					'name'    => __( 'Parallax', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Enable parallax effect. Parallax effect may not work in Live preview mode', 'shortcodes-ultimate-extra' )
				),
				'cover' => array(
					'type'    => 'bool',
					'default' => 'yes',
					'name'    => __( 'Cover', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Enable cover mode for background image. Image will fit into the section', 'shortcodes-ultimate-extra' )
				),
				'max_width' => array(
					'type'    => 'slider',
					'min'     => 0,
					'max'     => 1600,
					'step'    => 10,
					'default' => 960,
					'name'    => __( 'Content width', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Maximum width for this section content (px)', 'shortcodes-ultimate-extra' )
				),
				'margin' => array(
					'default' => '0px 0px 0px 0px',
					'name'    => __( 'Margin', 'shortcodes-ultimate-extra' ),
					'desc'    => sprintf( '%s (px), [%s]', __( 'Section margin', 'shortcodes-ultimate-extra' ), __( 'top right bottom left', 'shortcodes-ultimate-extra' ) )
				),
				'padding' => array(
					'default' => '30px 0px 30px 0px',
					'name'    => __( 'Padding', 'shortcodes-ultimate-extra' ),
					'desc'    => sprintf( '%s (px), [%s]', __( 'Section padding', 'shortcodes-ultimate-extra' ), __( 'top right bottom left', 'shortcodes-ultimate-extra' ) )
				),
				'border' => array(
					'type'    => 'border',
					'default' => '1px solid #cccccc',
					'name'    => __( 'Border', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Top and bottom section borders', 'shortcodes-ultimate-extra' )
				),
				'color' => array(
					'type'    => 'color',
					'default' => '#333333',
					'name'    => __( 'Text color', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Section text color', 'shortcodes-ultimate-extra' )
				),
				'text_align' => array(
					'type'    => 'select',
					'default' => 'left',
					'values'  => array(
						'left'   => __( 'Left', 'shortcodes-ultimate-extra' ),
						'center' => __( 'Center', 'shortcodes-ultimate-extra' ),
						'right'  => __( 'Right', 'shortcodes-ultimate-extra' )
					),
					'name'    => __( 'Text align', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Text alignment for panel content', 'shortcodes-ultimate-extra' )
				),
				'text_shadow' => array(
					'type'    => 'shadow',
					'default' => '0 1px 10px #ffffff',
					'name'    => __( 'Text shadow', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Pick a shadow for section text', 'shortcodes-ultimate-extra' )
				),
				'url' => array(
					'default' => '',
					'name'    => __( 'URL', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'You can type here any hyperlink to make this section clickable', 'shortcodes-ultimate-extra' )
				),
				'class' => array(
					'type' => 'extra_css_class',
					'name' => __( 'Extra CSS class', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Additional CSS class name(s) separated by space(s)', 'shortcodes-ultimate-extra' ),
					'default' => '',
				),
			)
		);

		$shortcodes['pricing_table'] = array(
			'name'     => __( 'Pricing table', 'shortcodes-ultimate-extra' ),
			'type'     => 'wrap',
			'group'    => 'extra box',
			'required_child' => 'plan',
			'desc'     => __( 'Wrapper for pricing plans', 'shortcodes-ultimate-extra' ),
			'icon'     => 'table',
			'image'    => $images_url . 'pricing_table.svg',
			'function' => array( 'Shortcodes_Ultimate_Extra_Shortcodes', 'pricing_table' ),
			'atts'     => array(
				'class' => array(
					'default' => '',
					'name'    => __( 'Class', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Extra CSS class', 'shortcodes-ultimate-extra' )
				)
			),
			'content' => array(
				'id'     => 'plan',
				'number' => 3,
				'nested' => true,
			),
		);

		$shortcodes['plan'] = array(
			'name'     => __( 'Pricing plan', 'shortcodes-ultimate-extra' ),
			'type'     => 'wrap',
			'group'    => 'extra box',
			'required_parent' => 'pricing_table',
			'desc'     => __( 'Single pricing plan', 'shortcodes-ultimate-extra' ),
			'icon'     => 'table',
			'image'    => $images_url . 'pricing_plan.svg',
			'function' => array( 'Shortcodes_Ultimate_Extra_Shortcodes', 'plan' ),
			'atts'     => array(
				'name' => array(
					'default' => '',
					'name'    => __( 'Plan name', 'shortcodes-ultimate-extra' ),
					'desc'    => sprintf( '%s<br>%s: <b_>%s</b>, <b_>%s</b>, <b_>%s</b>', __( 'Type here the name of this pricing plan', 'shortcodes-ultimate-extra' ), __( 'Example values', 'shortcodes-ultimate-extra' ), __( 'Starter', 'shortcodes-ultimate-extra' ), __( 'Business', 'shortcodes-ultimate-extra' ), __( 'Professional', 'shortcodes-ultimate-extra' ) )
				),
				'price' => array(
					'default' => '',
					'name'    => __( 'Price', 'shortcodes-ultimate-extra' ),
					'desc'    => sprintf( '%s<br>%s: <b_>%s</b>, <b_>%s</b>, <b_>%s</b>', __( 'Specify the price for this plan (without currency).', 'shortcodes-ultimate-extra' ), __( 'Example values', 'shortcodes-ultimate-extra' ), __( 'Free', 'shortcodes-ultimate-extra' ), '10', '29' )
				),
				'before' => array(
					'default' => '',
					'name'    => __( 'Before price', 'shortcodes-ultimate-extra' ),
					'desc'    => sprintf( '%s<br>%s<br>%s: %s', __( 'This text will be shown right before plan price.', 'shortcodes-ultimate-extra' ), __( 'It is a good place to add currency.', 'shortcodes-ultimate-extra' ), __( 'Example values', 'shortcodes-ultimate-extra' ), '<b_>$</b>, <b_>€</b>, <b_>¥</b>, <b_>euro</b>, <b_>dollars</b>' )
				),
				'after' => array(
					'default' => '',
					'name'    => __( 'After price', 'shortcodes-ultimate-extra' ),
					'desc'    => sprintf( '%s<br>%s<br>%s: %s', __( 'This text will be shown right after plan price.', 'shortcodes-ultimate-extra' ), __( 'It is a good place to add currency.', 'shortcodes-ultimate-extra' ), __( 'Example values', 'shortcodes-ultimate-extra' ), '<b_>$</b>, <b_>€</b>, <b_>¥</b>, <b_>euro</b>, <b_>dollars</b>' )
				),
				'period' => array(
					'default' => '',
					'name'    => __( 'Period', 'shortcodes-ultimate-extra' ),
					'desc'    => sprintf( '%s<br>%s: <b_>%s</b>, <b_>%s</b>, <b_>%s</b>', __( 'Specify plan period. Leave this field empty to hide this text.', 'shortcodes-ultimate-extra' ), __( 'Example values', 'shortcodes-ultimate-extra' ), __( 'weekly', 'shortcodes-ultimate-extra' ), __( 'per month', 'shortcodes-ultimate-extra' ), __( '1 year', 'shortcodes-ultimate-extra' ) )
				),
				'featured' => array(
					'type'    => 'bool',
					'default' => 'no',
					'name'    => __( 'Featured', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Show this plan as featured', 'shortcodes-ultimate-extra' )
				),
				'background' => array(
					'type'    => 'color',
					'default' => '#f9f9f9',
					'name'    => __( 'Background color', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'This color will be applied to the pricing plan head (plan name, price and period area)', 'shortcodes-ultimate-extra' )
				),
				'color' => array(
					'type'    => 'color',
					'default' => '#333333',
					'name'    => __( 'Text color', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'This color will be applied to the pricing plan head (plan name, price and period area)', 'shortcodes-ultimate-extra' )
				),
				'border' => array(
					'type'    => 'color',
					'default' => '#eeeeee',
					'name'    => __( 'Border color', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Pick an border color for this plan', 'shortcodes-ultimate-extra' )
				),
				'shadow' => array(
					'type'    => 'shadow',
					'default' => '0px 0px 25px #eeeeee',
					'name'    => __( 'Featured plan shadow', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Adjust box shadow value. Shadow will be only applied to the featured plans', 'shortcodes-ultimate-extra' )
				),
				'icon' => array(
					'type'    => 'icon',
					'default' => '',
					'name'    => __( 'Icon', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'You can add an icon to each pricing plan. Leave this field empty to hide icon', 'shortcodes-ultimate-extra' )
				),
				'icon_color' => array(
					'type'    => 'color',
					'default' => '#333333',
					'name'    => __( 'Icon color', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Pick an icon color. This color will only be applied to the built-in icons', 'shortcodes-ultimate-extra' )
				),
				'icon_size' => array(
					'type'    => 'slider',
					'min'     => 8,
					'max'     => 256,
					'step'    => 8,
					'default' => 48,
					'name'    => __( 'Icon size', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Specify icon size (px)', 'shortcodes-ultimate-extra' )
				),
				'btn_url' => array(
					'default' => '',
					'name'    => __( 'Button URL', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Enter here the URL for button', 'shortcodes-ultimate-extra' )
				),
				'btn_target' => array(
					'type'    => 'select',
					'default' => 'self',
					'name'    => __( 'Button link target', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Choose button link target', 'shortcodes-ultimate-extra' ),
					'values'   => array(
						'self' => __( 'Open link in same window/tab', 'shortcodes-ultimate-extra' ),
						'blank' => __( 'Open link in new window/tab', 'shortcodes-ultimate-extra' )
					)
				),
				'btn_text' => array(
					'default' => '',
					'name'    => __( 'Button text', 'shortcodes-ultimate-extra' ),
					'desc'    => sprintf( '%s<br>%s: <b_>%s</b>', __( 'Enter here the text for button.', 'shortcodes-ultimate-extra' ), __( 'Example value', 'shortcodes-ultimate-extra' ), __( 'Sign Up', 'shortcodes-ultimate-extra' ) )
				),
				'btn_background' => array(
					'type'    => 'color',
					'default' => '#999999',
					'name'    => __( 'Button background color', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Choose button background color', 'shortcodes-ultimate-extra' )
				),
				'btn_color' => array(
					'type'    => 'color',
					'default' => '#ffffff',
					'name'    => __( 'Button text color', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Choose button text color', 'shortcodes-ultimate-extra' )
				),
				'class' => array(
					'type' => 'extra_css_class',
					'name' => __( 'Extra CSS class', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Additional CSS class name(s) separated by space(s)', 'shortcodes-ultimate-extra' ),
					'default' => '',
				),
			),
			'content' => sprintf( "<ul>\n<li>%s</li>\n<li>%s</li>\n<li>%s</li>\n</ul>", __( 'Option 1', 'shortcodes-ultimate-extra' ), __( 'Option 2', 'shortcodes-ultimate-extra' ), __( 'Option 3', 'shortcodes-ultimate-extra' ) )
		);

		$shortcodes['testimonial'] = array(
			'name'     => __( 'Testimonial', 'shortcodes-ultimate-extra' ),
			'type'     => 'wrap',
			'group'    => 'extra box',
			'desc'     => __( 'Styled testimonial box', 'shortcodes-ultimate-extra' ),
			'icon'     => 'comments-o',
			'image'    => $images_url . 'testimonial.svg',
			'function' => array( 'Shortcodes_Ultimate_Extra_Shortcodes', 'testimonial' ),
			'atts'     => array(
				'name' => array(
					'default' => '',
					'name'    => __( 'Person name', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Type here a testimonial author name', 'shortcodes-ultimate-extra' )
				),
				'photo' => array(
					'type'    => 'upload',
					'default' => '',
					'name'    => __( 'Person photo', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Choose testimonial author photo', 'shortcodes-ultimate-extra' )
				),
				'company' => array(
					'default' => '',
					'name'    => __( 'Company', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Type here a company name. Leave this field empty to hide company name', 'shortcodes-ultimate-extra' )
				),
				'url' => array(
					'default' => '',
					'name'    => __( 'Company URL', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Type here a company URL. Leave this field empty to disable link', 'shortcodes-ultimate-extra' )
				),
				'target' => array(
					'type'    => 'select',
					'default' => 'blank',
					'name'    => __( 'Link target', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Choose link target', 'shortcodes-ultimate-extra' ),
					'values'   => array(
						'self' => __( 'Open link in same window/tab', 'shortcodes-ultimate-extra' ),
						'blank' => __( 'Open link in new window/tab', 'shortcodes-ultimate-extra' )
					)
				),
				'border' => array(
					'type'    => 'bool',
					'default' => 'yes',
					'name'    => __( 'Show border', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Show grey border around this testimonial', 'shortcodes-ultimate-extra' )
				),
				'class' => array(
					'type' => 'extra_css_class',
					'name' => __( 'Extra CSS class', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Additional CSS class name(s) separated by space(s)', 'shortcodes-ultimate-extra' ),
					'default' => '',
				),
			),
			'content' => __( 'Testimonial text', 'shortcodes-ultimate-extra' )
		);

		$shortcodes['icon'] = array(
			'name'     => __( 'Icon', 'shortcodes-ultimate-extra' ),
			'type'     => 'wrap',
			'group'    => 'extra content media',
			'desc'     => __( 'Fully customizable icon', 'shortcodes-ultimate-extra' ),
			'icon'     => 'rocket',
			'image'    => $images_url . 'icon.svg',
			'function' => array( 'Shortcodes_Ultimate_Extra_Shortcodes', 'icon' ),
			'atts'     => array(
				'icon' => array(
					'type'    => 'icon',
					'default' => '',
					'name'    => __( 'Icon', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Choose icon shape', 'shortcodes-ultimate-extra' )
				),
				'background' => array(
					'type'    => 'color',
					'default' => '#eeeeee',
					'name'    => __( 'Background', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Icon background color', 'shortcodes-ultimate-extra' )
				),
				'color' => array(
					'type'    => 'color',
					'default' => '#333333',
					'name'    => __( 'Color', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Icon shape color. This color be only applied to the built-in icons', 'shortcodes-ultimate-extra' )
				),
				'text_color' => array(
					'type'    => 'color',
					'default' => '#333333',
					'name'    => __( 'Text color', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Pick a color for icon text', 'shortcodes-ultimate-extra' )
				),
				'size' => array(
					'type'    => 'slider',
					'default' => '32',
					'min'     => '4',
					'max'     => '256',
					'step'    => '4',
					'name'    => __( 'Size', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Icon size (px)', 'shortcodes-ultimate-extra' )
				),
				'shape_size' => array(
					'type'    => 'slider',
					'default' => '16',
					'min'     => '4',
					'max'     => '256',
					'step'    => '4',
					'name'    => __( 'Shape size', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Background shape size (px)', 'shortcodes-ultimate-extra' )
				),
				'radius' => array(
					'type'    => 'slider',
					'default' => '256',
					'min'     => '0',
					'max'     => '256',
					'step'    => '4',
					'name'    => __( 'Radius', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Icon background shape radius (px)', 'shortcodes-ultimate-extra' )
				),
				'text_size' => array(
					'type'    => 'slider',
					'default' => '16',
					'min'     => '4',
					'max'     => '80',
					'step'    => '2',
					'name'    => __( 'Text size', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Icon text size (px)', 'shortcodes-ultimate-extra' )
				),
				'margin' => array(
					'default' => '0px 20px 20px 0px',
					'name'    => __( 'Margin', 'shortcodes-ultimate-extra' ),
					'desc'    => sprintf( '%s (px), [%s]', __( 'Icon margin', 'shortcodes-ultimate-extra' ), __( 'top right bottom left', 'shortcodes-ultimate-extra' ) )
				),
				'url' => array(
					'default' => '',
					'name'    => __( 'URL', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Icon link', 'shortcodes-ultimate-extra' )
				),
				'target' => array(
					'type'    => 'select',
					'default' => 'blank',
					'name'    => __( 'Link target', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Choose icon link target', 'shortcodes-ultimate-extra' ),
					'values'   => array(
						'self' => __( 'Open link in same window/tab', 'shortcodes-ultimate-extra' ),
						'blank' => __( 'Open link in new window/tab', 'shortcodes-ultimate-extra' )
					)
				),
				'class' => array(
					'type' => 'extra_css_class',
					'name' => __( 'Extra CSS class', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Additional CSS class name(s) separated by space(s)', 'shortcodes-ultimate-extra' ),
					'default' => '',
				),
			)
		);

		$shortcodes['content_slider'] = array(
			'name'     => __( 'Content slider', 'shortcodes-ultimate-extra' ),
			'type'     => 'wrap',
			'group'    => 'extra gallery',
			'required_child' => 'content_slide',
			'desc'     => __( 'Advanced responsive content slider', 'shortcodes-ultimate-extra' ),
			'icon'     => 'desktop',
			'image'    => $images_url . 'content_slider.svg',
			'function' => array( 'Shortcodes_Ultimate_Extra_Shortcodes', 'content_slider' ),
			'atts'     => array(
				'style' => array(
					'type'    => 'select',
					'default' => 'default',
					'name'    => __( 'Style', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Choose slider skin', 'shortcodes-ultimate-extra' ),
					'values'   => array(
						'default' => __( 'Default', 'shortcodes-ultimate-extra' ),
						'dark'    => __( 'Dark', 'shortcodes-ultimate-extra' ),
						'light'   => __( 'Light', 'shortcodes-ultimate-extra' )
					)
				),
				'effect' => array(
					'type'    => 'select',
					'default' => 'slide',
					'name'    => __( 'Effect', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Choose transition animation', 'shortcodes-ultimate-extra' ),
					'values'   => array(
						'slide'     => __( 'Slide', 'shortcodes-ultimate-extra' ),
						'fade'      => __( 'Fade', 'shortcodes-ultimate-extra' ),
						'fadeUp'    => __( 'Fade Up', 'shortcodes-ultimate-extra' ),
						'backSlide' => __( 'Back Slide', 'shortcodes-ultimate-extra' ),
						'goDown'    => __( 'Go Down', 'shortcodes-ultimate-extra' )
					)
				),
				'arrows' => array(
					'type'    => 'select',
					'default' => 'yes',
					'name'    => __( 'Show arrows', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Show left/right arrows navigation', 'shortcodes-ultimate-extra' ),
					'values'   => array(
						'no'    => __( 'Never', 'shortcodes-ultimate-extra' ),
						'hover' => __( 'On hover', 'shortcodes-ultimate-extra' ),
						'yes'   => __( 'Always', 'shortcodes-ultimate-extra' )
					)
				),
				'pages' => array(
					'type'    => 'select',
					'default' => 'no',
					'name'    => __( 'Show pages', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Show pagination navigation', 'shortcodes-ultimate-extra' ),
					'values'   => array(
						'no'    => __( 'Never', 'shortcodes-ultimate-extra' ),
						'hover' => __( 'On hover', 'shortcodes-ultimate-extra' ),
						'yes'   => __( 'Always', 'shortcodes-ultimate-extra' )
					)
				),
				'autoplay' => array(
					'type'    => 'slider',
					'default' => '5',
					'min'     => '0',
					'max'     => '60',
					'step'    => '0.5',
					'name'    => __( 'Autoplay', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Specify autoplay interval (seconds). Set to 0 to disable autoplay', 'shortcodes-ultimate-extra' )
				),
				// 'speed' => array(
				// 	'type'    => 'slider',
				// 	'default' => '0.5',
				// 	'min'     => '0',
				// 	'max'     => '10',
				// 	'step'    => '0.1',
				// 	'name'    => __( 'Speed', 'shortcodes-ultimate-extra' ),
				// 	'desc'    => __( 'Specify animation speed (in seconds). This speed will be only used for slide transitions', 'shortcodes-ultimate-extra' ),
				// ),
				'class' => array(
					'type' => 'extra_css_class',
					'name' => __( 'Extra CSS class', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Additional CSS class name(s) separated by space(s)', 'shortcodes-ultimate-extra' ),
					'default' => '',
				),
			),
			'content' => array(
				'id'     => 'content_slide',
				'number' => 3,
				'nested' => true,
			),
			// 'content' => sprintf( '[__content_slide] %1$s [/__content_slide]%2$s[__content_slide] %1$s [/__content_slide]%2$s[__content_slide] %1$s [/__content_slide]', __( 'Slide content', 'shortcodes-ultimate-extra' ), "\n" )
		);

		$shortcodes['content_slide'] = array(
			'name'     => __( 'Content slide', 'shortcodes-ultimate-extra' ),
			'type'     => 'wrap',
			'group'    => 'extra gallery',
			'required_parent' => 'content_slider',
			'desc'     => __( 'Single content slide', 'shortcodes-ultimate-extra' ),
			'icon'     => 'desktop',
			'image'    => $images_url . 'content_slide.svg',
			'function' => array( 'Shortcodes_Ultimate_Extra_Shortcodes', 'content_slide' ),
			'atts'     => array(
				'class' => array(
					'type' => 'extra_css_class',
					'name' => __( 'Extra CSS class', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Additional CSS class name(s) separated by space(s)', 'shortcodes-ultimate-extra' ),
					'default' => '',
				),
			),
			'content' => __( 'Slide content', 'shortcodes-ultimate-extra' ),
		);

		$shortcodes['shadow'] = array(
			'name'     => __( 'Shadow', 'shortcodes-ultimate-extra' ),
			'type'     => 'wrap',
			'group'    => 'extra other',
			'desc'     => __( 'Adds shadow to any nested element', 'shortcodes-ultimate-extra' ),
			'icon'     => 'moon-o',
			'image'    => $images_url . 'shadow.svg',
			'function' => array( 'Shortcodes_Ultimate_Extra_Shortcodes', 'shadow' ),
			'atts'     => array(
				'style' => array(
					'type'    => 'select',
					'default' => 'default',
					'name'    => __( 'Style', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Choose shadow style', 'shortcodes-ultimate-extra' ),
					'values'   => array(
						'default'    => __( 'Default', 'shortcodes-ultimate-extra' ),
						'left'       => __( 'Left corner', 'shortcodes-ultimate-extra' ),
						'right'      => __( 'Right corner', 'shortcodes-ultimate-extra' ),
						'horizontal' => __( 'Horizontal', 'shortcodes-ultimate-extra' ),
						'vertical'   => __( 'Vertical', 'shortcodes-ultimate-extra' ),
						'bottom'     => __( 'Bottom', 'shortcodes-ultimate-extra' ),
						'simple'     => __( 'Simple', 'shortcodes-ultimate-extra' )
					)
				),
				'inline' => array(
					'type'    => 'bool',
					'default' => 'no',
					'name'    => __( 'Inline', 'shortcodes-ultimate-extra' ),
					'desc'    => __( 'Display shadow container as an inline element. This option can be useful for small images and other inline elements', 'shortcodes-ultimate-extra' )
				),
				'class' => array(
					'type' => 'extra_css_class',
					'name' => __( 'Extra CSS class', 'shortcodes-ultimate-extra' ),
					'desc' => __( 'Additional CSS class name(s) separated by space(s)', 'shortcodes-ultimate-extra' ),
					'default' => '',
				),
			)
		);

		return $shortcodes;

	}

	/**
	 * Validate license key before plugin update.
	 *
	 * @since 1.5.12
	 */
	public function validate_license_before_updating( $update ) {

		if (
			! get_option( "su_option_{$this->addon_id}_license" )
			&& isset( $update->download_url )
		) {
			$update->download_url = '';
		}

		return $update;

	}

}

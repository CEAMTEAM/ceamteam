<?php defined( 'ABSPATH' ) or exit; ?>

<div class="notice notice-warning shortcodes-ultimate-skins-notice-core">
	<p><?php _e( 'Please install and activate Shortcodes Ultimate core plugin in order to use <strong>Additional Skins</strong> add-on.', 'shortcodes-ultimate-skins' ); ?></p>
	<p class="shortcodes-ultimate-skins-notice-core-actions">
		<a href="<?php echo add_query_arg( array( 'tab' => 'plugin-information', 'plugin' => 'shortcodes-ultimate', 'TB_iframe' => 'true', 'width' => '600', 'height' => '550' ), admin_url( 'plugin-install.php' ) ); ?>" class="thickbox open-plugin-details-modal"><strong><?php _e( 'Install Shortcodes Ultimate', 'shortcodes-ultimate-skins' ); ?></strong></a>
		<a href="<?php echo esc_url( $this->get_dismiss_link() ); ?>"><?php _e( 'Dismiss', 'shortcodes-ultimate-skins' ); ?></a>
	</p>
</div>
<style>
	.shortcodes-ultimate-skins-notice-core-actions a {
		text-decoration: none;
	}
	.shortcodes-ultimate-skins-notice-core-actions a + a {
		margin-left: 20px;
	}
</style>

<?php
	// This theme uses wp_nav_menu()

  add_action( 'init', 'theme_register_menus' );

	function theme_register_menus() {
		register_nav_menus(
			array(
				'primary-menu' => __( 'main-nav' )
			)
		);
	}

?>

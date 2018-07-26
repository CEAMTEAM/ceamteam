<?php

/**
 * Static class containing shortcode handlers.
 *
 * @since        1.5.7
 * @package      Shortcodes_Ultimate_Extra
 * @subpackage   Shortcodes_Ultimate_Extra/includes
 */
final class Shortcodes_Ultimate_Extra_Shortcodes {

	static $plans = array();

	public static function splash( $atts = null, $content = null ) {
		$atts = shortcode_atts( array(
				'style'    => 'dark',
				'width'    => 480,
				'opacity'  => 80,
				'onclick'  => 'close-bg',
				'url'      => get_bloginfo( 'url' ),
				'delay'    => 0,
				'esc'      => 'yes',
				'close'    => 'yes',
				'once'     => 'no',
				'class'    => ''
			), $atts, 'splash' );
		// Don't show splash screen in preview mode
		if ( did_action( 'su/generator/preview/before' ) ) return __( 'This shortcode doesn\'t work in live preview. Please insert it into editor and preview on the site.', 'shortcodes-ultimate-extra' );
		// Prepare cookie name for current page
		$cookie = 'sue_splash_' . md5( $_SERVER['REQUEST_URI'] );
		// Don't show splash screen twice
		if ( $atts['once'] === 'yes' && isset( $_COOKIE[$cookie] ) ) return;
		// Prepare opacity
		$atts['opacity'] = ( !is_numeric( $atts['opacity'] ) || $atts['opacity'] > 100 || $atts['opacity'] < 0 ) ? 0.8 : $atts['opacity'] / 100;
		// Request assets
		su_query_asset( 'css', 'magnific-popup' );
		su_query_asset( 'css', 'shortcodes-ultimate-extra' );
		su_query_asset( 'js', 'jquery' );
		su_query_asset( 'js', 'magnific-popup' );
		su_query_asset( 'js', 'shortcodes-ultimate-extra' );
		return '<div class="sue-splash" data-once="' . $atts['once'] . '" data-cookie="' . $cookie . '" data-esc="' . $atts['esc'] . '" data-close="' . $atts['close'] . '" data-onclick="' . $atts['onclick'] . '" data-url="' . $atts['url'] . '" data-opacity="' . (string) $atts['opacity'] . '" data-width="' . $atts['width'] . '" data-style="sue-splash-style-' . $atts['style'] . '" data-delay="' . (string) $atts['delay'] . '"><div class="sue-splash-screen sue-content-wrap' . su_ecssc( $atts ) . '">' . do_shortcode( $content ) . '</div></div>';
	}

	public static function exit_popup( $atts = null, $content = null ) {
		$atts = shortcode_atts( array(
				'style'    => 'dark',
				'width'    => 480,
				'opacity'  => 80,
				'onclick'  => 'close-bg',
				'url'      => get_bloginfo( 'url' ),
				'esc'      => 'yes',
				'close'    => 'yes',
				'once'     => 'no',
				'class'    => ''
			), $atts, 'splash' );
		// Don't show splash screen in preview mode
		if ( did_action( 'su/generator/preview/before' ) ) return __( 'This shortcode doesn\'t work in live preview. Please insert it into editor and preview on the site.', 'shortcodes-ultimate-extra' );
		// Prepare cookie name for current page
		$cookie = 'sue_exit_popup_' . md5( $_SERVER['REQUEST_URI'] );
		// Don't show splash screen twice
		if ( $atts['once'] === 'yes' && isset( $_COOKIE[$cookie] ) ) return;
		// Prepare opacity
		$atts['opacity'] = ( !is_numeric( $atts['opacity'] ) || $atts['opacity'] > 100 || $atts['opacity'] < 0 ) ? 0.8 : $atts['opacity'] / 100;
		// Request assets
		su_query_asset( 'css', 'magnific-popup' );
		su_query_asset( 'css', 'shortcodes-ultimate-extra' );
		su_query_asset( 'js', 'jquery' );
		su_query_asset( 'js', 'magnific-popup' );
		su_query_asset( 'js', 'shortcodes-ultimate-extra' );
		return '<div class="sue-exit-popup" data-once="' . $atts['once'] . '" data-cookie="' . $cookie . '" data-esc="' . $atts['esc'] . '" data-close="' . $atts['close'] . '" data-onclick="' . $atts['onclick'] . '" data-url="' . $atts['url'] . '" data-opacity="' . (string) $atts['opacity'] . '" data-width="' . $atts['width'] . '" data-style="sue-exit-popup-style-' . $atts['style'] . '"><div class="sue-exit-popup-screen sue-content-wrap' . su_ecssc( $atts ) . '">' . do_shortcode( $content ) . '</div></div>';
	}

	public static function panel( $atts = null, $content = null ) {
		$atts = shortcode_atts( array(
				'background' => '#ffffff',
				'color'      => '#333333',
				'shadow'     => '0px 1px 2px #eeeeee',
				'border'     => '1px solid #cccccc',
				'radius'     => '0',
				'text_align' => 'left',
				'url'        => '',
				'target'     => 'self',
				'class'      => ''
			), $atts, 'panel' );
		if ( $atts['url'] ) {
			$atts['class'] .= ' sue-panel-clickable';
			su_query_asset( 'js', 'shortcodes-ultimate-extra' );
		}
		if ( $atts['target'] !== 'self' ) {
			$atts['target'] = 'blank';
		}
		su_query_asset( 'css', 'shortcodes-ultimate-extra' );
		$return = '<div class="sue-panel' . su_ecssc( $atts ) . '" data-url="' . $atts['url'] . '" data-target="' . $atts['target'] . '" style="background-color:' . $atts['background'] . ';color:' . $atts['color'] . ';border-radius:' . $atts['radius'] . 'px;-moz-border-radius:' . $atts['radius'] . 'px;-webkit-border-radius:' . $atts['radius'] . 'px;box-shadow:' . $atts['shadow'] . ';-moz-box-shadow:' . $atts['shadow'] . ';-webkit-box-shadow:' . $atts['shadow'] . ';border:' . $atts['border'] . '"><div class="sue-panel-content sue-content-wrap" style="text-align:' . $atts['text_align'] . '">' . do_shortcode( $content ) . '</div></div>';
		return $return;
	}

	public static function photo_panel( $atts = null, $content = null ) {
		$atts = shortcode_atts( array(
				'background' => '#ffffff',
				'color'      => '#333333',
				'shadow'     => '0 1px 2px #eeeeee',
				'border'     => '1px solid #cccccc',
				'radius'     => '0',
				'text_align' => 'left',
				'photo'      => 'http://lorempixel.com/400/300/food/' . rand( 0, 10 ) . '/',
				'alt'        => '',
				'url'        => '',
				'target'     => 'self',
				'class'      => ''
			), $atts, 'photo_panel' );
		if ( $atts['url'] ) {
			$atts['class'] .= ' sue-panel-clickable';
			su_query_asset( 'js', 'shortcodes-ultimate-extra' );
		}
		if ( $atts['target'] !== 'self' ) {
			$atts['target'] = 'blank';
		}
		su_query_asset( 'css', 'shortcodes-ultimate-extra' );
		$return = '<div class="sue-photo-panel' . su_ecssc( $atts ) . '" data-url="' . $atts['url'] . '" data-target="' . $atts['target'] . '" style="background-color:' . $atts['background'] . ';color:' . $atts['color'] . ';border-radius:' . $atts['radius'] . 'px;-moz-border-radius:' . $atts['radius'] . 'px;-webkit-border-radius:' . $atts['radius'] . 'px;box-shadow:' . $atts['shadow'] . ';-moz-box-shadow:' . $atts['shadow'] . ';-webkit-box-shadow:' . $atts['shadow'] . ';border:' . $atts['border'] . '"><div class="sue-photo-panel-head"><img src="' . $atts['photo'] . '" alt="' . $atts['alt'] . '" style="-webkit-border-top-left-radius:' . $atts['radius'] . 'px;-webkit-border-top-right-radius:' . $atts['radius'] . 'px;-moz-border-radius-topleft:' . $atts['radius'] . 'px;-moz-border-radius-topright:' . $atts['radius'] . 'px;border-top-left-radius:' . $atts['radius'] . 'px;border-top-right-radius:' . $atts['radius'] . 'px;" /></div><div class="sue-photo-panel-content sue-content-wrap" style="text-align:' . $atts['text_align'] . '">' . do_shortcode( $content ) . '</div></div>';
		return $return;
	}

	public static function icon_panel( $atts = null, $content = null ) {
		$atts = shortcode_atts( array(
				'background' => '#ffffff',
				'color'      => '#333333',
				'shadow'     => '0 1px 2px #eeeeee',
				'border'     => '1px solid #cccccc',
				'radius'     => '0',
				'text_align' => 'center',
				'icon'       => 'icon: heart',
				'icon_color' => '#333333',
				'icon_size'  => 24,
				'url'        => '',
				'target'     => 'self',
				'class'      => ''
			), $atts, 'icon_panel' );
		if ( $atts['url'] ) {
			$atts['class'] .= ' sue-panel-clickable';
			su_query_asset( 'js', 'shortcodes-ultimate-extra' );
		}
		if ( $atts['target'] !== 'self' ) {
			$atts['target'] = 'blank';
		}
		if ( strpos( $atts['icon'], 'icon:' ) !== false ) {
			$atts['icon'] = '<i class="fa fa-' . trim( str_replace( 'icon:', '', $atts['icon'] ) ) . '" style="font-size:' . $atts['icon_size'] . 'px;color:' . $atts['icon_color'] . '"></i>';
			su_query_asset( 'css', 'font-awesome' );
		}
		else $atts['icon'] = '<img src="' . $atts['icon'] . '" style="width:' . $atts['icon_size'] . 'px" alt="" />';
		su_query_asset( 'css', 'shortcodes-ultimate-extra' );
		$return = '<div class="sue-icon-panel' . su_ecssc( $atts ) . '" data-url="' . $atts['url'] . '" data-target="' . $atts['target'] . '" style="background-color:' . $atts['background'] . ';color:' . $atts['color'] . ';border-radius:' . $atts['radius'] . 'px;-moz-border-radius:' . $atts['radius'] . 'px;-webkit-border-radius:' . $atts['radius'] . 'px;box-shadow:' . $atts['shadow'] . ';-moz-box-shadow:' . $atts['shadow'] . ';-webkit-box-shadow:' . $atts['shadow'] . ';border:' . $atts['border'] . '"><div class="sue-icon-panel-head">' . $atts['icon'] . '</div><div class="sue-icon-panel-content sue-content-wrap" style="text-align:' . $atts['text_align'] . '">' . do_shortcode( $content ) . '</div></div>';
		return $return;
	}

	public static function icon_text( $atts = null, $content = null ) {
		$atts = shortcode_atts( array(
				'color'      => '#333333',
				'icon'       => 'icon: heart',
				'icon_color' => '#333333',
				'icon_size'  => 24,
				'url'        => '',
				'target'     => 'self',
				'class'      => ''
			), $atts, 'icon_text' );
		if ( $atts['url'] ) {
			$atts['class'] .= ' sue-panel-clickable';
			su_query_asset( 'js', 'shortcodes-ultimate-extra' );
		}
		if ( $atts['target'] !== 'self' ) {
			$atts['target'] = 'blank';
		}
		if ( strpos( $atts['icon'], 'icon:' ) !== false ) {
			$atts['icon'] = '<i class="fa fa-' . trim( str_replace( 'icon:', '', $atts['icon'] ) ) . '" style="font-size:' . $atts['icon_size'] . 'px;color:' . $atts['icon_color'] . '"></i>';
			su_query_asset( 'css', 'font-awesome' );
		}
		else $atts['icon'] = '<img src="' . $atts['icon'] . '" style="width:' . $atts['icon_size'] . 'px" alt="" />';
		su_query_asset( 'css', 'shortcodes-ultimate-extra' );
		$return = '<div class="sue-icon-text' . su_ecssc( $atts ) . '" data-url="' . $atts['url'] . '" data-target="' . $atts['target'] . '" style="min-height:' . ( $atts['icon_size'] + 10 ) . 'px;padding-left:' . ( $atts['icon_size'] + round( $atts['icon_size'] / 2 ) ) . 'px;color:' . $atts['color'] . '"><div class="sue-icon-text-icon" style="color:' . $atts['icon_color'] . ';font-size:' . $atts['icon_size'] . 'px;width:' . $atts['icon_size'] . 'px;height:' . $atts['icon_size'] . 'px">' . $atts['icon'] . '</div><div class="sue-icon-text-content sue-content-wrap" style="color:' . $atts['color'] . '">' . do_shortcode( $content ) . '</div><div style="clear:both;height:0"></div></div>';
		return $return;
	}

	public static function progress_pie( $atts = null, $content = null ) {
		$atts = shortcode_atts( array(
				'percent'    => 75,
				'text'       => '',
				'before'     => '',
				'after'      => '',
				'size'       => 200,
				'pie_width'  => 30,
				'text_size'  => 40,
				'align'      => 'center',
				'pie_color'  => '#f0f0f0',
				'fill_color' => '#97daed',
				'text_color' => '#cccccc',
				'class'      => ''
			), $atts, 'progress_pie' );
		su_query_asset( 'css', 'shortcodes-ultimate-extra' );
		su_query_asset( 'js', 'jquery' );
		su_query_asset( 'js', 'chartjs' );
		su_query_asset( 'js', 'jquery-inview' );
		su_query_asset( 'js', 'shortcodes-ultimate-extra' );
		if ( !$atts['text'] ) $atts['text'] = $atts['percent'];
		$return = '<div class="sue-progress-pie sue-progress-pie-align-' . $atts['align'] . su_ecssc( $atts ) . '" style="width:' . $atts['size'] . 'px;height:' . $atts['size'] . 'px" data-percent="' . $atts['percent'] . '" data-size="' . $atts['size'] . '" data-pie_width="' . $atts['pie_width'] . '" data-pie_color="' . $atts['pie_color'] . '" data-fill_color="' . $atts['fill_color'] . '"><canvas width="' . $atts['size'] . '" height="' . $atts['size'] . '"></canvas><div style="color:' . $atts['text_color'] . ';line-height:' . $atts['size'] . 'px;font-size:' . $atts['text_size'] . 'px"><span class="sue-progress-pie-before">' . $atts['before'] . '</span><span class="sue-progress-pie-text">' . $atts['text'] . '</span><span class="sue-progress-pie-after">' . $atts['after'] . '</span></div></div>';
		return $return;
	}

	public static function progress_bar( $atts = null, $content = null ) {
		$atts = shortcode_atts( array(
				'style'      => 'default',
				'percent'    => 75,
				'text'       => '',
				'bar_color'  => '#f0f0f0',
				'fill_color' => '#97daed',
				'text_color' => '#555555',
				'class'      => ''
			), $atts, 'progress_bar' );
		su_query_asset( 'css', 'shortcodes-ultimate-extra' );
		su_query_asset( 'js', 'jquery' );
		su_query_asset( 'js', 'jquery-inview' );
		su_query_asset( 'js', 'shortcodes-ultimate-extra' );
		if ( !$atts['text'] ) $atts['text'] = $atts['percent'];
		$return = '<div class="sue-progress-bar sue-progress-bar-style-' . $atts['style'] . su_ecssc( $atts ) . '" style="background-color:' . $atts['bar_color'] . ';border-color:' . su_hex_shift( $atts['bar_color'], 'darker', 10 ) . '" data-percent="' . $atts['percent'] . '"><span style="width:0;background-color:' . $atts['fill_color'] . ';color:' . $atts['text_color'] . '"><span>' . $atts['text'] . '</span></span></div>';
		return $return;
	}

	public static function member( $atts = null, $content = null ) {
		$atts = shortcode_atts( array(
				'background'   => '#ffffff',
				'color'        => '#333333',
				'shadow'       => '0 1px 2px #eeeeee',
				'border'       => '1px solid #cccccc',
				'radius'       => '0',
				'text_align'   => 'left',
				'photo'        => 'http://lorempixel.com/400/300/business/' . rand( 0, 10 ) . '/',
				'name'         => __( 'John Doe', 'shortcodes-ultimate-extra' ),
				'role'         => __( 'Designer', 'shortcodes-ultimate-extra' ),
				'icon_1'       => '',
				'icon_1_url'   => '',
				'icon_1_color' => '#333333',
				'icon_1_title' => '',
				'icon_2'       => '',
				'icon_2_url'   => '',
				'icon_2_color' => '#333333',
				'icon_2_title' => '',
				'icon_3'       => '',
				'icon_3_url'   => '',
				'icon_3_color' => '#333333',
				'icon_3_title' => '',
				'url'          => '',
				'class'        => ''
			), $atts, 'member' );
		if ( $atts['url'] ) {
			$atts['class'] .= ' sue-panel-clickable';
			su_query_asset( 'js', 'shortcodes-ultimate-extra' );
		}
		su_query_asset( 'css', 'shortcodes-ultimate-extra' );
		$icons = array();
		for ( $i = 1; $i <= 3; $i++ ) {
			if ( !$atts['icon_' . $i] || !$atts['icon_' . $i . '_url'] ) continue;
			if ( strpos( $atts['icon_' . $i], 'icon:' ) !== false ) {
				$icon = '<i class="fa fa-' . trim( str_replace( 'icon:', '', $atts['icon_' . $i] ) ) . '" style="color:' . $atts['icon_' . $i . '_color'] . '"></i>';
				su_query_asset( 'css', 'font-awesome' );
			}
			else $icon = '<img src="' . $atts['icon_' . $i] . '" width="16" height="16" alt="" />';
			$icons[] = '<a href="' . $atts['icon_' . $i . '_url'] . '" title="' . $atts['icon_' . $i . '_title'] . '" class="sue-memeber-icon" target="_blank">' . $icon . '</a>';
		}
		$icons = ( count( $icons ) ) ? '<div class="sue-member-icons" style="text-align:' . $atts['text_align'] . ';border-top:' . $atts['border'] . '">' . implode( '', $icons ) . '</div>' : '';
		return '<div class="sue-member' . su_ecssc( $atts ) . '" data-url="' . $atts['url'] . '" style="background-color:' . $atts['background'] . ';color:' . $atts['color'] . ';border-radius:' . $atts['radius'] . 'px;-moz-border-radius:' . $atts['radius'] . 'px;-webkit-border-radius:' . $atts['radius'] . 'px;box-shadow:' . $atts['shadow'] . ';-moz-box-shadow:' . $atts['shadow'] . ';-webkit-box-shadow:' . $atts['shadow'] . ';border:' . $atts['border'] . '"><div class="sue-member-photo"><img src="' . $atts['photo'] . '" alt="" style="-webkit-border-top-left-radius:' . $atts['radius'] . 'px;-webkit-border-top-right-radius:' . $atts['radius'] . 'px;-moz-border-radius-topleft:' . $atts['radius'] . 'px;-moz-border-radius-topright:' . $atts['radius'] . 'px;border-top-left-radius:' . $atts['radius'] . 'px;border-top-right-radius:' . $atts['radius'] . 'px;" /></div><div class="sue-member-info" style="text-align:' . $atts['text_align'] . '"><span class="sue-member-name">' . $atts['name'] . '</span><span class="sue-member-role">' . $atts['role'] . '</span><div class="sue-member-desc sue-content-wrap">' . do_shortcode( $content ) . '</div></div>' . $icons . '</div>';
	}

	public static function section( $atts = null, $content = null ) {
		$atts = shortcode_atts( array(
				'background'          => '#ffffff',
				'background_position' => 'left top',
				'cover'               => 'yes',
				'image'               => '',
				'repeat'              => 'repeat',
				'parallax'            => 'yes',
				'speed'               => '10',
				'max_width'           => '960',
				'margin'              => '0px 0px 0px 0px',
				'padding'             => '30px 0px 30px 0px',
				'border'              => '1px solid #cccccc',
				'color'               => '#333333',
				'text_align'          => 'left',
				'text_shadow'         => '0 1px 10px #ffffff',
				'url'                 => '',
				'class'               => ''
			), $atts, 'section' );

		// Make section clickable
		if ( $atts['url'] ) {
			$atts['class'] .= ' sue-panel-clickable';
			su_query_asset( 'js', 'jquery' );
			su_query_asset( 'js', 'shortcodes-ultimate-extra' );
		}

		// Apply background color
		$background = 'background-color:' . $atts['background'] . ';';

		// Apply background position
		$background .= sprintf(
			'background-position:%s;',
			preg_replace( '/[^a-z0-9\s]/i', '', $atts['background_position'] )
		);

		// Apply background-size: cover
		if ( $atts['cover'] === 'yes' ) {
			$background .= 'background-size:cover;';
		}

		// Apply background image
		if ( $atts['image'] ) {
			$background .= 'background-image:url(\'' . esc_url( $atts['image'] ) . '\');';
		}

		// Query parallax script and add special class
		if ( $atts['image'] && $atts['parallax'] === 'yes' ) {
			su_query_asset( 'js', 'jquery' );
			su_query_asset( 'js', 'shortcodes-ultimate-extra' );
			$atts['class'] .= ' sue-section-parallax';
		}

		// Query stylesheet
		su_query_asset( 'css', 'shortcodes-ultimate-extra' );

		// Output
		return '<div class="sue-section' . su_ecssc( $atts ) . '" data-url="' . $atts['url'] . '" style="margin:' . $atts['margin'] . ';border-top:' . $atts['border'] . ';border-bottom:' . $atts['border'] . '"><div class="sue-section-background" style="' . $background . '"></div><div class="sue-section-content sue-content-wrap" style="padding:' . $atts['padding'] . ';max-width:' . $atts['max_width'] . 'px;text-align:' . $atts['text_align'] . ';color:' . $atts['color'] . ';text-shadow:' . $atts['text_shadow'] . '">' . do_shortcode( $content ) . '</div></div>';

	}

	public static function pricing_table( $atts = null, $content = null ) {
		$atts = shortcode_atts( array(
				'class' => ''
			), $atts, 'pricing_table' );
		// Prepare global static variable self::$plans
		do_shortcode( $content );
		// Prepare local function variables
		$plans = array();
		$count = count( self::$plans );
		// Show message if no plans added
		if ( !$count ) return __( 'You need to add pricing plans to this pricing table. Use shortcode Pricing plan to do that.', 'shortcodes-ultimate-extra' );
		// Render plans
		foreach ( self::$plans as $plan ) $plans[] = self::_plan( $plan['atts'], $plan['content'] );
		// Reset global static variable
		self::$plans = array();
		// Return result
		return '<div class="sue-pricing-table sue-clearfix sue-pricing-table-size-' . $count . su_ecssc( $atts ) . '">' . implode( '', $plans ) . '</div>';
	}

	public static function plan( $atts = null, $content = null ) {
		// Render single pricing plan in preview mode
		if ( did_action( 'su/generator/preview/before' ) ) return self::_plan( $atts, $content );
		// Add new plan to the pricing table
		self::$plans[] = array( 'atts' => $atts, 'content' => $content );
	}

	public static function _plan( $atts = null, $content = null ) {
		$atts = shortcode_atts( array(
				'name'           => '',
				'price'          => '',
				'before'         => '',
				'after'          => '',
				'period'         => '',
				'featured'       => 'no',
				'background'     => '#f9f9f9',
				'color'          => '#333333',
				'border'         => '#eeeeee',
				'shadow'         => '0px 0px 25px #eeeeee',
				'icon'           => '',
				'icon_color'     => '#333333',
				'icon_size'      => '48',
				'btn_url'        => '',
				'btn_target'     => 'self',
				'btn_text'       => '',
				'btn_background' => '#999999',
				'btn_color'      => '#ffffff',
				'class'          => ''
			), $atts, 'plan' );
		// Prepare icon
		if ( $atts['icon'] ) $atts['icon'] = '<div class="sue-plan-icon">' . su_get_icon( array( 'icon' => $atts['icon'], 'size' => $atts['icon_size'], 'color' => $atts['icon_color'] ) ) . '</div>';
		// Prepare markup
		if ( $atts['before'] ) $atts['before'] = '<span class="sue-plan-price-before">' . $atts['before'] . '</span>';
		if ( $atts['after'] ) $atts['after'] = '<span class="sue-plan-price-after">' . $atts['after'] . '</span>';
		if ( $atts['period'] ) $atts['period'] = '<div class="sue-plan-period">' . $atts['period'] . '</div>';
		// Add featured class
		if ( $atts['featured'] === 'yes' ) $atts['class'] .= ' sue-plan-featured';
		// Prepare box-shadow style
		$atts['shadow'] = ( $atts['featured'] === 'yes' )
			? ';-webkit-box-shadow:' . $atts['shadow'] . ';-moz-box-shadow:' . $atts['shadow'] . ';box-shadow:' . $atts['shadow']
			: '';
		// Query stylesheet and scripts
		su_query_asset( 'css', 'shortcodes-ultimate-extra' );
		su_query_asset( 'js', 'jquery' );
		su_query_asset( 'js', 'shortcodes-ultimate-extra' );
		// Clean-up options list
		$content = trim( strip_tags( do_shortcode( $content ), '<br><ul><li><a><b><strong><i><em><span><img><h1><h2><h3><h4><h5><h6>' ) );
		// Prepare button markup
		$button = ( $atts['btn_text'] && $atts['btn_url'] ) ? '<a href="' . $atts['btn_url'] . '" class="sue-plan-button" style="background-color:' . $atts['btn_background'] . ';color:' . $atts['btn_color'] . ';border:2px solid ' . $atts['btn_background'] . '" target="_' . $atts['btn_target'] . '">' . $atts['btn_text'] . '</a>' : '';
		// Prepare footer markup
		$footer = ( $button ) ? '<div class="sue-plan-footer" style="background-color:' . $atts['background'] . ';color:' . $atts['btn_background'] . ';border-color:' . su_hex_shift( $atts['border'], 'lighter', 40 ) . '">' . $button . '</div>' : '';
		// Return result
		return '<div class="sue-plan' . su_ecssc( $atts ) . '" style="border-color:' . $atts['border'] . $atts['shadow'] . '"><div class="sue-plan-head" style="background-color:' . $atts['background'] . ';color:' . $atts['color'] . ';border-color:' . su_hex_shift( $atts['border'], 'lighter', 40 ) . '"><div class="sue-plan-name">' . $atts['name'] . '</div><div class="sue-plan-price">' . $atts['before'] . '<span class="sue-plan-price-value">' . $atts['price'] . '</span>' . $atts['after'] . '</div>' . $atts['period'] . $atts['icon'] . '</div><div class="sue-plan-options">' . $content . '</div>' . $footer . '</div>';
	}

	public static function testimonial( $atts = null, $content = null ) {
		$atts = shortcode_atts( array(
				'name'    => '',
				'photo'   => '',
				'company' => '',
				'url'     => '',
				'target'  => 'blank',
				'border'  => 'yes',
				'class'   => ''
			), $atts, 'testimonial' );
		// Query stylesheet
		su_query_asset( 'css', 'shortcodes-ultimate-extra' );
		// Add photo
		if ( $atts['photo'] ) {
			// Add class
			$atts['class'] .= ' sue-testimonial-has-photo';
			// Add markup
			$atts['photo'] = '<img src="' . $atts['photo'] . '" alt="' . esc_attr( $atts['name'] ) . '" class="sue-testimonial-photo" width="40" height="40" />';
		}
		// Prepare company name
		if ( $atts['company'] ) {
			// Add hyperlink
			$atts['company'] = ( $atts['url'] )
			// Company name with hyperlink
			? '<a href="' . $atts['url'] . '" class="sue-testimonial-company" target="_' . $atts['target'] . '">' . $atts['company'] . '</a>'
			// Company name without link
			: '<span class="sue-testimonial-company">' . $atts['company'] . '</span>';
			// Add hyphen
			if ( $atts['name'] ) $atts['company'] = ', ' . $atts['company'];
		}
		// Add border class
		if ( $atts['border'] === 'yes' ) $atts['class'] .= ' sue-testimonial-bordered';
		// Return result
		return '<div class="sue-testimonial' . su_ecssc( $atts ) . '"><div class="sue-testimonial-text sue-content-wrap">' . do_shortcode( $content ) . '</div><div class="sue-testimonial-cite"><span class="sue-testimonial-name">' . $atts['name'] . '</span>' . $atts['company'] . '</div>' . $atts['photo'] . '</div>';
	}

	public static function icon( $atts = null, $content = null ) {
		$atts = shortcode_atts( array(
				'icon'       => '',
				'background' => '#eeeeee',
				'color'      => '#333333',
				'text_color' => '#333333',
				'size'       => '32',
				'shape_size' => '16',
				'radius'     => '256',
				'text_size'  => '16',
				'margin'     => '0px 20px 20px 0px',
				'url'        => '',
				'target'     => 'blank',
				'class'      => ''
			), $atts, 'icon' );
		// Query stylesheet
		su_query_asset( 'css', 'shortcodes-ultimate-extra' );
		// Prepare URL
		if ( !$atts['url'] ) {
			// Add class
			$atts['class'] .= ' sue-icon-no-url';
			// Change URL
			$atts['url'] = 'javascript:;';
		}
		// <img> icon
		if ( strpos( $atts['icon'], '/' ) !== false ) {
			$atts['icon'] = '<img src="' . $atts['icon'] . '" alt="" width="' . $atts['size'] . '" height="' . $atts['height'] . '" style="width:' . $atts['size'] . 'px;height:' . $atts['size'] . 'px;background:' . $atts['background'] . ';-webkit-border-radius:' . $atts['radius'] . 'px;-moz-border-radius:' . $atts['radius'] . 'px;border-radius:' . $atts['radius'] . 'px;padding:' . $atts['shape_size'] . 'px" />';
		}
		// Font-Awesome icon
		else if ( strpos( $atts['icon'], 'icon:' ) !== false ) {
				$atts['icon'] = '<i class="fa fa-' . trim( str_replace( 'icon:', '', $atts['icon'] ) ) . '" style="font-size:' . $atts['size'] . 'px;line-height:' . $atts['size'] . 'px;background:' . $atts['background'] . ';color:' . $atts['color'] . ';-webkit-border-radius:' . $atts['radius'] . 'px;-moz-border-radius:' . $atts['radius'] . 'px;border-radius:' . $atts['radius'] . 'px;padding:' . $atts['shape_size'] . 'px"></i>';
				su_query_asset( 'css', 'font-awesome' );
			}
		// Prepare text
		if ( $content ) $content = '<span class="sue-icon-text">' . $content . '</span>';
		// Return result
		return '<a href="' . $atts['url'] . '" class="sue-icon' . su_ecssc( $atts ) . '" style="font-size:' . $atts['text_size'] . 'px;color:' . $atts['text_color'] . ';margin:' . $atts['margin'] . '" target="_' . $atts['target'] . '">' . $atts['icon'] . do_shortcode( $content ) . '</a>';
	}

	public static function content_slider( $atts = null, $content = null ) {

		$atts = shortcode_atts( array(
				'style'    => 'default',
				'effect'   => 'slide',
				'arrows'   => 'yes',
				'pages'    => 'no',
				'autoplay' => '5',
				'speed'    => '0.5',
				'class'    => ''
			), $atts, 'content_slider' );

		su_query_asset( 'css', 'animate' );
		su_query_asset( 'css', 'owl-carousel' );
		su_query_asset( 'css', 'shortcodes-ultimate-extra' );
		su_query_asset( 'js', 'jquery' );
		su_query_asset( 'js', 'owl-carousel' );
		su_query_asset( 'js', 'shortcodes-ultimate-extra' );

		$atts['autoplay'] = is_numeric( $atts['autoplay'] ) ? $atts['autoplay'] * 1000 : 0;
		$atts['speed'] = is_numeric( $atts['speed'] ) ? $atts['speed'] * 1000 : 0;

		$effects = array(
			'slide'     => array( 'false', 'false' ),
			'fade'      => array( 'fadeIn', 'fadeOut' ),
			'fadeUp'    => array( 'zoomIn', 'zoomOut' ),
			// 'fadeUp'    => array( 'fadeInDown', 'fadeOutUp' ),
			'backSlide' => array( 'zoomInRight', 'zoomOutLeft' ),
			'goDown'    => array( 'slideInDown', 'zoomOutDown' ),
		);

		if ( ! isset( $effects[ $atts['effect'] ] ) ) {
			$atts['effect'] = 'slide';
		}

		return sprintf(
			'<div class="sue-content-slider sue-content-slider-arrows-%1$s sue-content-slider-pages-%2$s sue-content-slider-style-%3$s %4$s owl-carousel" data-animatein="%5$s" data-animateout="%6$s" data-autoplay="%7$s" data-speed="%8$s" data-arrows="%9$s" data-pages="%10$s">%11$s</div>',
			$atts['arrows'],
			$atts['pages'],
			$atts['style'],
			su_ecssc( $atts ),
			$effects[ $atts['effect'] ][0],
			$effects[ $atts['effect'] ][1],
			$atts['autoplay'],
			$atts['speed'],
			$atts['arrows'] === 'yes' || $atts['arrows'] === 'hover' ? 'true' : 'false',
			$atts['pages'] === 'yes' || $atts['pages'] === 'hover' ? 'true' : 'false',
			do_shortcode( $content )
		);

	}

	public static function content_slide( $atts = null, $content = null ) {
		$atts = shortcode_atts( array(
				'class' => ''
			), $atts, 'content_slide' );
		return '<div class="sue-content-slide sue-clearfix sue-content-wrap' . su_ecssc( $atts ) . '">' . do_shortcode( $content ) . '</div>';
	}

	public static function shadow( $atts = null, $content = null ) {
		$atts = shortcode_atts( array(
				'style'  => 'default',
				'inline' => 'no',
				'class'  => ''
			), $atts, 'shadow' );
		su_query_asset( 'css', 'shortcodes-ultimate-extra' );
		return '<div class="sue-shadow-wrap sue-content-wrap sue-shadow-inline-' . $atts['inline'] . su_ecssc( $atts ) . '"><div class="sue-shadow sue-shadow-style-' . $atts['style'] . '">' . do_shortcode( $content ) . '</div></div>';
	}
}

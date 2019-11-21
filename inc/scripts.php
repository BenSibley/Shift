<?php

// Front-end scripts
function ct_shift_load_scripts_styles() {

	$font_args = array(
		'family' 	=> urlencode( 'Lato:400,400i,700,900' ),
		'subset' 	=> urlencode( 'latin,latin-ext' ),
		'display' => 'swap'
	);
	$fonts_url = add_query_arg( $font_args, '//fonts.googleapis.com/css' );

	wp_enqueue_style( 'ct-shift-google-fonts', $fonts_url );

	wp_enqueue_script( 'ct-shift-js', get_template_directory_uri() . '/js/build/production.min.js', array( 'jquery' ), '', true );
	wp_localize_script( 'ct-shift-js', 'ct_shift_objectL10n', array(
		'openMenu'       => esc_html_x( 'open menu', 'verb: open the menu', 'shift' ),
		'closeMenu'      => esc_html_x( 'close menu', 'verb: close the menu', 'shift' ),
		'openChildMenu'  => esc_html_x( 'open dropdown menu', 'verb: open the dropdown menu', 'shift' ),
		'closeChildMenu' => esc_html_x( 'close dropdown menu', 'verb: close the dropdown menu', 'shift' )
	) );

	wp_enqueue_style( 'ct-shift-font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/all.min.css' );

	wp_enqueue_style( 'ct-shift-style', get_stylesheet_uri() );

	// enqueue comment-reply script only on posts & pages with comments open ( included in WP core )
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ct_shift_load_scripts_styles' );

// Back-end scripts
function ct_shift_enqueue_admin_styles( $hook ) {

	if ( $hook == 'appearance_page_shift-options' ) {
		wp_enqueue_style( 'ct-shift-admin-styles', get_template_directory_uri() . '/styles/admin.min.css' );
	}
	if ( $hook == 'post.php' || $hook == 'post-new.php' ) {

		$font_args = array(
			'family' => urlencode( 'Lato:400,400i,700,900' ),
			'subset' => urlencode( 'latin,latin-ext' )
		);
		$fonts_url = add_query_arg( $font_args, '//fonts.googleapis.com/css' );
	
		wp_enqueue_style( 'ct-shift-google-fonts', $fonts_url );
	}
}
add_action( 'admin_enqueue_scripts', 'ct_shift_enqueue_admin_styles' );

// Customizer scripts
function ct_shift_enqueue_customizer_scripts() {
	wp_enqueue_style( 'ct-shift-customizer-styles', get_template_directory_uri() . '/styles/customizer.min.css' );
	wp_enqueue_script( 'ct-shift-customizer-js', get_template_directory_uri() . '/js/build/customizer.min.js', array( 'jquery' ), '', true );

	wp_localize_script( 'ct-shift-customizer-js', 'ct_shift_customizer', array(
		'templateDir' => get_template_directory_uri()
	) );
}
add_action( 'customize_controls_enqueue_scripts', 'ct_shift_enqueue_customizer_scripts' );

/*
 * Script for live updating with customizer options. Has to be loaded separately on customize_preview_init hook
 * transport => postMessage
 */
function ct_shift_enqueue_customizer_post_message_scripts() {
	wp_enqueue_script( 'ct-shift-customizer-post-message-js', get_template_directory_uri() . '/js/build/postMessage.min.js', array( 'jquery' ), '', true );

}
add_action( 'customize_preview_init', 'ct_shift_enqueue_customizer_post_message_scripts' );
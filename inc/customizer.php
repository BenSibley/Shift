<?php

/* Add customizer panels, sections, settings, and controls */
add_action( 'customize_register', 'ct_shift_add_customizer_content' );

function ct_shift_add_customizer_content( $wp_customize ) {

	/***** Reorder default sections *****/

	$wp_customize->get_section( 'title_tagline' )->priority = 2;

	// check if exists in case user has no pages
	if ( is_object( $wp_customize->get_section( 'static_front_page' ) ) ) {
		$wp_customize->get_section( 'static_front_page' )->priority = 5;
		$wp_customize->get_section( 'static_front_page' )->title    = __( 'Front Page', 'shift' );
	}

	/***** Add PostMessage Support *****/

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	/***** Shift Pro Control *****/

	class ct_shift_pro_ad extends WP_Customize_Control {
		public function render_content() {
			$link = 'https://www.competethemes.com/shift-pro/';
			echo "<a href='" . $link . "' target='_blank'><img src='" . get_template_directory_uri() . "/assets/images/shift-pro.png' srcset='" . get_template_directory_uri() . "/assets/images/shift-pro-2x.png 2x' /></a>";
			echo "<p class='bold'>" . sprintf( __('<a target="_blank" href="%s">Shift Pro</a> is the plugin that makes advanced customization simple - and fun too!', 'shift'), $link) . "</p>";
			echo "<p>" . __('Shift Pro adds the following features to Shift:', 'shift') . "</p>";
			echo "<ul>
					<li>" . __('6 new layouts', 'shift') . "</li>
					<li>" . __('Custom colors', 'shift') . "</li>
					<li>" . __('New fonts', 'shift') . "</li>
					<li>" . __('+ 10 more features', 'shift') . "</li>
				  </ul>";
			echo "<p class='button-wrapper'><a target=\"_blank\" class='shift-pro-button' href='" . $link . "'>" . __('View Shift Pro', 'shift') . "</a></p>";
		}
	}

	/***** Shift Pro Section *****/

	// don't add if Shift Pro is active
	if ( !function_exists( 'ct_shift_pro_init' ) ) {
		// section
		$wp_customize->add_section( 'ct_shift_pro', array(
			'title'    => __( 'Shift Pro', 'shift' ),
			'priority' => 1
		) );
		// Upload - setting
		$wp_customize->add_setting( 'shift_pro', array(
			'sanitize_callback' => 'absint'
		) );
		// Upload - control
		$wp_customize->add_control( new ct_shift_pro_ad(
			$wp_customize, 'shift_pro', array(
				'section'  => 'ct_shift_pro',
				'settings' => 'shift_pro'
			)
		) );
	}
	
	/***** Social Media Icons *****/

	// get the social sites array
	$social_sites = ct_shift_social_array();

	// set a priority used to order the social sites
	$priority = 5;

	// section
	$wp_customize->add_section( 'ct_shift_social_media_icons', array(
		'title'       => __( 'Social Media Icons', 'shift' ),
		'priority'    => 25,
		'description' => __( 'Add the URL for each of your social profiles.', 'shift' )
	) );

	// create a setting and control for each social site
	foreach ( $social_sites as $social_site => $value ) {
		// if email icon
		if ( $social_site == 'email' ) {
			// setting
			$wp_customize->add_setting( $social_site, array(
				'sanitize_callback' => 'ct_shift_sanitize_email'
			) );
			// control
			$wp_customize->add_control( $social_site, array(
				'label'    => __( 'Email Address', 'shift' ),
				'section'  => 'ct_shift_social_media_icons',
				'priority' => $priority
			) );
		} else {

			$label = ucfirst( $social_site );

			if ( $social_site == 'google-plus' ) {
				$label = 'Google Plus';
			} elseif ( $social_site == 'rss' ) {
				$label = 'RSS';
			} elseif ( $social_site == 'soundcloud' ) {
				$label = 'SoundCloud';
			} elseif ( $social_site == 'slideshare' ) {
				$label = 'SlideShare';
			} elseif ( $social_site == 'codepen' ) {
				$label = 'CodePen';
			} elseif ( $social_site == 'stumbleupon' ) {
				$label = 'StumbleUpon';
			} elseif ( $social_site == 'deviantart' ) {
				$label = 'DeviantArt';
			} elseif ( $social_site == 'hacker-news' ) {
				$label = 'Hacker News';
			} elseif ( $social_site == 'whatsapp' ) {
				$label = 'WhatsApp';
			} elseif ( $social_site == 'qq' ) {
				$label = 'QQ';
			} elseif ( $social_site == 'vk' ) {
				$label = 'VK';
			} elseif ( $social_site == 'wechat' ) {
				$label = 'WeChat';
			} elseif ( $social_site == 'tencent-weibo' ) {
				$label = 'Tencent Weibo';
			} elseif ( $social_site == 'paypal' ) {
				$label = 'PayPal';
			} elseif ( $social_site == 'email-form' ) {
				$label = 'Contact Form';
			}

			if ( $social_site == 'skype' ) {
				// setting
				$wp_customize->add_setting( $social_site, array(
					'sanitize_callback' => 'ct_shift_sanitize_skype'
				) );
				// control
				$wp_customize->add_control( $social_site, array(
					'type'        => 'url',
					'label'       => $label,
					'description' => sprintf( __( 'Accepts Skype link protocol (<a href="%s" target="_blank">learn more</a>)', 'shift' ), 'https://www.competethemes.com/blog/skype-links-wordpress/' ),
					'section'     => 'ct_shift_social_media_icons',
					'priority'    => $priority
				) );
			} else {
				// setting
				$wp_customize->add_setting( $social_site, array(
					'sanitize_callback' => 'esc_url_raw'
				) );
				// control
				$wp_customize->add_control( $social_site, array(
					'type'     => 'url',
					'label'    => $label,
					'section'  => 'ct_shift_social_media_icons',
					'priority' => $priority
				) );
			}
		}
		// increment the priority for next site
		$priority = $priority + 5;
	}

	/***** Search Bar *****/

	// section
	$wp_customize->add_section( 'shift_search_bar', array(
		'title'    => __( 'Search Bar', 'shift' ),
		'priority' => 37
	) );
	// setting
	$wp_customize->add_setting( 'search_bar', array(
		'default'           => 'hide',
		'sanitize_callback' => 'ct_shift_sanitize_show_hide'
	) );
	// control
	$wp_customize->add_control( 'search_bar', array(
		'type'    => 'radio',
		'label'   => __( 'Show search bar at top of site?', 'shift' ),
		'section' => 'shift_search_bar',
		'setting' => 'search_bar',
		'choices' => array(
			'show' => __( 'Show', 'shift' ),
			'hide' => __( 'Hide', 'shift' )
		),
	) );

	/***** Layout *****/

	// section
	$wp_customize->add_section( 'shift_layout', array(
		'title'       => __( 'Layout', 'shift' ),
		'priority'    => 40,
		'description' => sprintf( __( 'Want more layouts? Check out the <a target="_blank" href="%s">Shift Pro plugin</a>.', 'shift' ), 'https://www.competethemes.com/shift-pro/' )
	) );
	// setting
	$wp_customize->add_setting( 'layout', array(
		'default'           => 'right',
		'sanitize_callback' => 'ct_shift_sanitize_layout_settings',
		'transport'         => 'postMessage'
	) );
	// control
	$wp_customize->add_control( 'layout', array(
		'label'    => __( 'Choose your layout', 'shift' ),
		'section'  => 'shift_layout',
		'settings' => 'layout',
		'type'     => 'radio',
		'choices'  => array(
			'right' => __( 'Right sidebar', 'shift' ),
			'left'  => __( 'Left sidebar', 'shift' )
		)
	) );

	/***** Blog *****/

	// section
	$wp_customize->add_section( 'shift_blog', array(
		'title'    => __( 'Blog', 'shift' ),
		'priority' => 45
	) );
	// setting
	$wp_customize->add_setting( 'full_post', array(
		'default'           => 'no',
		'sanitize_callback' => 'ct_shift_sanitize_yes_no_settings'
	) );
	// control
	$wp_customize->add_control( 'full_post', array(
		'label'    => __( 'Show full posts on blog?', 'shift' ),
		'section'  => 'shift_blog',
		'settings' => 'full_post',
		'type'     => 'radio',
		'choices'  => array(
			'yes' => __( 'Yes', 'shift' ),
			'no'  => __( 'No', 'shift' )
		)
	) );
	// setting
	$wp_customize->add_setting( 'excerpt_length', array(
		'default'           => '25',
		'sanitize_callback' => 'absint'
	) );
	// control
	$wp_customize->add_control( 'excerpt_length', array(
		'label'    => __( 'Excerpt word count', 'shift' ),
		'section'  => 'shift_blog',
		'settings' => 'excerpt_length',
		'type'     => 'number'
	) );
	// Read More text - setting
	$wp_customize->add_setting( 'read_more_text', array(
		'default'           => __( 'Continue Reading', 'shift' ),
		'sanitize_callback' => 'ct_shift_sanitize_text'
	) );
	// Read More text - control
	$wp_customize->add_control( 'read_more_text', array(
		'label'    => __( 'Read More button text', 'shift' ),
		'section'  => 'shift_blog',
		'settings' => 'read_more_text',
		'type'     => 'text'
	) );

	/***** Display Controls *****/

	// section
	$wp_customize->add_section( 'shift_display', array(
		'title'       => __( 'Display Controls', 'shift' ),
		'priority'    => 55,
		'description' => sprintf( __( 'Want more options like these? Check out the <a target="_blank" href="%s"> Shift Pro plugin</a>.', 'shift' ), 'https://www.competethemes.com/shift-pro/' )
	) );
	// setting - post author
	$wp_customize->add_setting( 'display_post_author', array(
		'default'           => 'show',
		'sanitize_callback' => 'ct_shift_sanitize_show_hide'
	) );
	// control - post author
	$wp_customize->add_control( 'display_post_author', array(
		'type'    => 'radio',
		'label'   => __( 'Post author in byline', 'shift' ),
		'section' => 'shift_display',
		'setting' => 'display_post_author',
		'choices' => array(
			'show' => __( 'Show', 'shift' ),
			'hide' => __( 'Hide', 'shift' )
		)
	) );
	// setting - post date
	$wp_customize->add_setting( 'display_post_date', array(
		'default'           => 'show',
		'sanitize_callback' => 'ct_shift_sanitize_show_hide'
	) );
	// control - post author
	$wp_customize->add_control( 'display_post_date', array(
		'type'    => 'radio',
		'label'   => __( 'Post date in byline', 'shift' ),
		'section' => 'shift_display',
		'setting' => 'display_post_date',
		'choices' => array(
			'show' => __( 'Show', 'shift' ),
			'hide' => __( 'Hide', 'shift' )
		)
	) );
	// setting - post date
	$wp_customize->add_setting( 'display_post_comments', array(
		'default'           => 'show',
		'sanitize_callback' => 'ct_shift_sanitize_show_hide'
	) );
	// control - post author
	$wp_customize->add_control( 'display_post_comments', array(
		'type'    => 'radio',
		'label'   => __( 'Post comments in byline', 'shift' ),
		'section' => 'shift_display',
		'setting' => 'display_post_comments',
		'choices' => array(
			'show' => __( 'Show', 'shift' ),
			'hide' => __( 'Hide', 'shift' )
		)
	) );

	/***** Custom CSS *****/

	if ( function_exists( 'wp_update_custom_css_post' ) ) {
		// Migrate any existing theme CSS to the core option added in WordPress 4.7.
		$css = get_theme_mod( 'custom_css' );
		if ( $css ) {
			$core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
			$return = wp_update_custom_css_post( $core_css . $css );
			if ( ! is_wp_error( $return ) ) {
				// Remove the old theme_mod, so that the CSS is stored in only one place moving forward.
				remove_theme_mod( 'custom_css' );
			}
		}
	} else {
		// section
		$wp_customize->add_section( 'shift_custom_css', array(
			'title'    => __( 'Custom CSS', 'shift' ),
			'priority' => 75
		) );
		// setting
		$wp_customize->add_setting( 'custom_css', array(
			'sanitize_callback' => 'ct_shift_sanitize_css',
			'transport'         => 'postMessage'
		) );
		// control
		$wp_customize->add_control( 'custom_css', array(
			'type'     => 'textarea',
			'label'    => __( 'Add Custom CSS Here:', 'shift' ),
			'section'  => 'shift_custom_css',
			'settings' => 'custom_css'
		) );
	}
}

/***** Custom Sanitization Functions *****/

/*
 * Sanitize settings with show/hide as options
 * Used in: search bar
 */
function ct_shift_sanitize_show_hide( $input ) {

	$valid = array(
		'show' => __( 'Show', 'shift' ),
		'hide' => __( 'Hide', 'shift' )
	);

	return array_key_exists( $input, $valid ) ? $input : '';
}

/*
 * sanitize email address
 * Used in: Social Media Icons
 */
function ct_shift_sanitize_email( $input ) {
	return sanitize_email( $input );
}

// sanitize yes/no settings
function ct_shift_sanitize_yes_no_settings( $input ) {

	$valid = array(
		'yes' => __( 'Yes', 'shift' ),
		'no'  => __( 'No', 'shift' )
	);

	return array_key_exists( $input, $valid ) ? $input : '';
}

function ct_shift_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

function ct_shift_sanitize_skype( $input ) {
	return esc_url_raw( $input, array( 'http', 'https', 'skype' ) );
}

function ct_shift_sanitize_css( $css ) {
	$css = wp_kses( $css, array( '\'', '\"' ) );
	$css = str_replace( '&gt;', '>', $css );

	return $css;
}

function ct_shift_sanitize_layout_settings( $input ) {

	/*
	 * Also allow layouts only included in the premium plugin.
	 * Needs to be done this way b/c sanitize_callback cannot by updated
	 * via get_setting()
	 */
	$valid = array(
		'right'      => __( 'Right sidebar', 'shift' ),
		'left'       => __( 'Left sidebar', 'shift' ),
		'narrow'     => __( 'No sidebar - Narrow', 'shift' ),
		'wide'       => __( 'No sidebar - Wide', 'shift' ),
		'two-right'  => __( 'Two column - Right sidebar', 'shift' ),
		'two-left'   => __( 'Two column - Left sidebar', 'shift' ),
		'two-narrow' => __( 'Two column - No Sidebar - Narrow', 'shift' ),
		'two-wide'   => __( 'Two column - No Sidebar - Wide', 'shift' )
	);

	return array_key_exists( $input, $valid ) ? $input : '';
}
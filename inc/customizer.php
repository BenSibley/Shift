<?php

/* Add customizer panels, sections, settings, and controls */
add_action( 'customize_register', 'ct_shift_add_customizer_content' );

function ct_shift_add_customizer_content( $wp_customize ) {

	/***** Reorder default sections *****/

	$wp_customize->get_section( 'title_tagline' )->priority = 2;

	// check if exists in case user has no pages
	if ( is_object( $wp_customize->get_section( 'static_front_page' ) ) ) {
		$wp_customize->get_section( 'static_front_page' )->priority = 5;
	}

	/***** Add PostMessage Support *****/

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	
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

			if ( $social_site == 'rss' ) {
				$label = __('RSS', 'shift');
			} elseif ( $social_site == 'researchgate' ) {
				$label = __('ResearchGate', 'shift');
			} elseif ( $social_site == 'soundcloud' ) {
				$label = __('SoundCloud', 'shift');
			} elseif ( $social_site == 'slideshare' ) {
				$label = __('SlideShare', 'shift');
			} elseif ( $social_site == 'codepen' ) {
				$label = __('CodePen', 'shift');
			} elseif ( $social_site == 'stumbleupon' ) {
				$label = __('StumbleUpon', 'shift');
			} elseif ( $social_site == 'deviantart' ) {
				$label = __('DeviantArt', 'shift');
			} elseif ( $social_site == 'hacker-news' ) {
				$label = __('Hacker News', 'shift');
			} elseif ( $social_site == 'google-wallet' ) {
				$label = __('Google Wallet', 'shift');
			} elseif ( $social_site == 'whatsapp' ) {
				$label = __('WhatsApp', 'shift');
			} elseif ( $social_site == 'qq' ) {
				$label = __('QQ', 'shift');
			} elseif ( $social_site == 'vk' ) {
				$label = __('VK', 'shift');
			} elseif ( $social_site == 'ok-ru' ) {
				$label = __('OK.ru', 'shift');
			} elseif ( $social_site == 'wechat' ) {
				$label = __('WeChat', 'shift');
			} elseif ( $social_site == 'tencent-weibo' ) {
				$label = __('Tencent Weibo', 'shift');
			} elseif ( $social_site == 'paypal' ) {
				$label = __('PayPal', 'shift');
			} elseif ( $social_site == 'stack-overflow' ) {
				$label = __('Stack Overflow', 'shift');
			} elseif ( $social_site == 'artstation' ) {
				$label = __('ArtStation', 'shift');
			} elseif ( $social_site == 'email-form' ) {
				$label = __('Contact Form', 'shift');
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
			} else if ( $social_site == 'phone' ) {
				// setting
				$wp_customize->add_setting( $social_site, array(
					'sanitize_callback' => 'ct_shift_sanitize_phone'
				) );
				// control
				$wp_customize->add_control( $social_site, array(
					'type'        => 'text',
					'label'       => $label,
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
		'description' => sprintf( __( 'Want more layouts? Check out the <a target="_blank" href="%1$s">%2$s Pro plugin</a>.', 'shift' ), 'https://www.competethemes.com/shift-pro/', wp_get_theme( get_template() ) )
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
		'title'    => _x( 'Blog', 'noun: the blog section', 'shift' ),
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
		'description' => sprintf( __( 'Want more options like these? Check out the <a target="_blank" href="%1$s"> %2$s Pro plugin</a>.', 'shift' ), 'https://www.competethemes.com/shift-pro/', wp_get_theme( get_template() ) )
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

	/***** Additional Options  *****/

	// section
	$wp_customize->add_section( 'ct_shift_additional_options', array(
		'title'    => __( 'Additional Options', 'shift' ),
		'priority' => 60
	) );
	// setting - scroll-to-top arrow
	$wp_customize->add_setting( 'scroll_to_top', array(
		'default'           => 'no',
		'sanitize_callback' => 'ct_shift_sanitize_yes_no_settings'
	) );
	// control - scroll-to-top arrow
	$wp_customize->add_control( 'scroll_to_top', array(
		'label'    => __( 'Display Scroll-to-top arrow?', 'shift' ),
		'section'  => 'ct_shift_additional_options',
		'settings' => 'scroll_to_top',
		'type'     => 'radio',
		'choices'  => array(
			'yes' => __( 'Yes', 'shift' ),
			'no'  => __( 'No', 'shift' )
		)
	) );
	// setting - last updated
	$wp_customize->add_setting( 'last_updated', array(
		'default'           => 'no',
		'sanitize_callback' => 'ct_shift_sanitize_yes_no_settings'
	) );
	// control - last updated
	$wp_customize->add_control( 'last_updated', array(
		'label'    => __( 'Display the date each post was last updated?', 'shift' ),
		'section'  => 'ct_shift_additional_options',
		'settings' => 'last_updated',
		'type'     => 'radio',
		'choices'  => array(
			'yes' => __( 'Yes', 'shift' ),
			'no'  => __( 'No', 'shift' )
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

function ct_shift_sanitize_phone( $input ) {
	if ( $input != '' ) {
		return esc_url_raw( 'tel:' . $input, array( 'tel' ) );
	} else {
		return '';
	}
}

function ct_shift_customize_preview_js() {
	if ( !function_exists( 'ct_shift_pro_init' ) && !(isset($_GET['mailoptin_optin_campaign_id']) || isset($_GET['mailoptin_email_campaign_id'])) ) {
		$url = 'https://www.competethemes.com/shift-pro/?utm_source=wp-dashboard&utm_medium=Customizer&utm_campaign=Shift%20Pro%20-%20Customizer';
		$content = "<script>jQuery('#customize-info').prepend('<div class=\"upgrades-ad\"><a href=\"". $url ."\" target=\"_blank\">Customize Colors with Shift Pro <span>&rarr;</span></a></div>')</script>";
		echo apply_filters('ct_shift_customizer_ad', $content);
	}
}
add_action('customize_controls_print_footer_scripts', 'ct_shift_customize_preview_js');
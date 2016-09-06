<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
	<?php wp_head(); ?>
</head>

<body id="<?php print get_stylesheet(); ?>" <?php body_class(); ?>>
<?php do_action( 'ct_shift_body_top' ); ?>
<a class="skip-content" href="#main"><?php _e( 'Press "Enter" to skip to content', 'shift' ); ?></a>
<div id="overflow-container" class="overflow-container">
	<?php do_action( 'ct_shift_before_header' ); ?>
	<header class="site-header" id="site-header" role="banner">
		<div class="max-width">
			<div id="title-container" class="title-container <?php if ( get_bloginfo( 'description' ) ) { echo 'has-tagline'; } ?>">
				<?php get_template_part( 'logo' ) ?>
				<?php if ( get_bloginfo( 'description' ) ) {
					echo '<p class="tagline">' . esc_html( get_bloginfo( 'description' ) ) . '</p>';
				} ?>
			</div>
			<button id="toggle-navigation" class="toggle-navigation" name="toggle-navigation" aria-expanded="false">
				<span class="screen-reader-text"><?php _e( 'open menu', 'shift' ); ?></span>
				<?php echo ct_shift_svg_output( 'toggle-navigation' ); ?>
			</button>
			<div id="menu-primary-container" class="menu-primary-container">
				<div class="menu-inner-container">
					<?php get_template_part( 'menu', 'primary' ); ?>
					<?php get_template_part( 'content/search-bar' ); ?>
					<?php ct_shift_social_icons_output(); ?>
				</div>
			</div>
		</div>
	</header>
	<div class="max-width main-max-width">
		<?php do_action( 'ct_shift_after_header' ); ?>
		<section id="main" class="main" role="main">
			<?php do_action( 'ct_shift_main_top' );
			if ( function_exists( 'yoast_breadcrumb' ) ) {
				yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
			}

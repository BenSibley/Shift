<?php

function ct_shift_register_theme_page() {
	add_theme_page( __( 'Shift Dashboard', 'shift' ), __( 'Shift Dashboard', 'shift' ), 'edit_theme_options', 'shift-options', 'ct_shift_options_content', 'ct_shift_options_content' );
}
add_action( 'admin_menu', 'ct_shift_register_theme_page' );

function ct_shift_options_content() {

	$customizer_url = add_query_arg(
		array(
			'url'    => site_url(),
			'return' => add_query_arg( 'page', 'shift-options', admin_url( 'themes.php' ) )
		),
		admin_url( 'customize.php' )
	);
	$support_url = 'https://www.competethemes.com/documentation/shift-support-center/';
	?>
	<div id="shift-dashboard-wrap" class="wrap">
		<h2><?php _e( 'Shift Dashboard', 'shift' ); ?></h2>
		<?php do_action( 'ct_shift_theme_options_before' ); ?>
		<div class="content-boxes">
			<div class="content content-support">
				<h3><?php _e( 'Get Started', 'shift' ); ?></h3>
				<p><?php _e( "Not sure where to start? The Shift Support Center is filled with tutorials that will take you step-by-step through every feature in Shift.", "shift" ); ?></p>
				<p>
					<a target="_blank" class="button-primary"
					   href="https://www.competethemes.com/documentation/shift-support-center/"><?php _e( 'Visit Support Center', 'shift' ); ?></a>
				</p>
			</div>
			<?php if ( !function_exists( 'ct_shift_pro_init' ) ) : ?>
				<div class="content content-premium-upgrade">
					<h3><?php _e( 'Shift Pro', 'shift' ); ?></h3>
					<p><?php _e( 'Download the Shift Pro plugin and unlock custom colors, new layouts, sliders, and more', 'shift' ); ?>...</p>
					<p>
						<a target="_blank" class="button-primary"
						   href="https://www.competethemes.com/shift-pro/"><?php _e( 'See Full Feature List', 'shift' ); ?></a>
					</p>
				</div>
			<?php endif; ?>
			<div class="content content-review">
				<h3><?php _e( 'Leave a Review', 'shift' ); ?></h3>
				<p><?php _e( 'Help others find Shift by leaving a review on wordpress.org.', 'shift' ); ?></p>
				<a target="_blank" class="button-primary" href="https://wordpress.org/support/theme/shift/reviews/"><?php _e( 'Leave a Review', 'shift' ); ?></a>
			</div>
			<div class="content content-delete-settings">
				<h3><?php _e( 'Reset Customizer Settings', 'shift' ); ?></h3>
				<p>
					<?php printf( __( "<strong>Warning:</strong> Clicking this button will erase the Shift theme's current settings in the <a href='%s'>Customizer</a>.", 'shift' ), esc_url( $customizer_url ) ); ?>
				</p>
				<form method="post">
					<input type="hidden" name="shift_reset_customizer" value="shift_reset_customizer_settings"/>
					<p>
						<?php wp_nonce_field( 'shift_reset_customizer_nonce', 'shift_reset_customizer_nonce' ); ?>
						<?php submit_button( __( 'Reset Customizer Settings', 'shift' ), 'delete', 'delete', false ); ?>
					</p>
				</form>
			</div>
		</div>
		<?php do_action( 'ct_shift_theme_options_after' ); ?>
	</div>
<?php }